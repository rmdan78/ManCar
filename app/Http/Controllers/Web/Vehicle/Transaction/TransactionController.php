<?php

namespace App\Http\Controllers\Web\Vehicle\Transaction;

use App\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\Models\User\User;
use App\Models\Vehicle\Transaction\{Status, Transaction};
use App\Models\Vehicle\{Vehicle, Status as VehicleStatus};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = session('user');
        $statuses = Status::get();
        $page = request()->query('page') ?? 1;
        $perPage = request()->query('per_page') ?? 5;
        $statusIds = request()->query('status_ids');
        $fromDate = request()->query('from_date');
        $untilDate = request()->query('until_date');

        // dd($perPage, $page);
        $transactions = Transaction::with(['user', 'vehicle'])
            ->when(!$user->isAdministrator(), fn($query) => (
                $query->where('user_id', $user->id)
            ))
            ->when($statusIds, fn($query) => (
                $query->whereIn('status_id', $statusIds)
            ))
            ->when($fromDate, fn($query) => (
                $query->whereDate('created_at', '>=', $fromDate)
            ))
            ->when($untilDate, fn($query) => (
                $query->whereDate('created_at', '<=', $untilDate)
            ))
            ->latest()
            ->paginate(perPage: $perPage, page: $page);

        return view('pages.transactions.index', compact([
            'statuses',
            'transactions',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::with(['kind', 'status', 'thumbnail'])
            ->latest()
            ->get();

        return view('pages.transactions.create.index', compact([
            'vehicles',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);
            $usedOn = now()->parse("{$request->date_used_on} {$request->time_used_on}:00");
            $endsOn = now()->parse("{$request->date_used_on} {$request->time_ends_on}:00");

            Transaction::create([
                'user_id'       => Auth::user()->id,
                'vehicle_id'    => $vehicle->id,
                'status_id'     => Status::where('codename', 'PENDING')->first()->id,
                'destination'   => $request->destination,
                'description'   => $request->description,
                'used_on'       => $usedOn,
                'ends_on'       => $endsOn,
                'amount'        => 0,
                'detail'        => json_encode((object) []),
            ]);

            return redirect()
                ->route('vehicles.transactions')
                ->with('success', 'Successfully created transaction');
        } catch (\Exception $err) {
            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $transactionId)
    {
        $transaction = Transaction::with(['status', 'vehicle'])->find($transactionId);
        $vehicles = Vehicle::with(['kind', 'status', 'thumbnail'])
            ->latest()
            ->get();

        return view('pages.transactions.edit.index', compact([
            'transaction',
            'vehicles',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $transactionId)
    {
        try {
            $transaction = Transaction::findOrFail($transactionId);
            $data = CollectionHelper::getOrOld($request, $transaction);
            $usedOn = $request->time_used_on ? now()->parse("{$request->date_used_on} {$request->time_used_on}:00") : null;
            $endsOn = $request->time_used_on ? now()->parse("{$request->date_used_on} {$request->time_ends_on}:00") : null;

            if ($data) {
                $data = $data->only([
                    'vehicle_id',
                    'destination',
                    'description',
                ])->merge([
                    'edited_at' => now(),
                ]);

                if($usedOn) $data->put('used_on', $usedOn);
                if($endsOn) $data->put('ends_on', $endsOn);

                $transaction->update($data->toArray());
            }

            return back()
                ->with('success', 'Successfully edited transaction');
        } catch (\Exception $err) {
            return back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(string $transactionId)
    {
        try {
            $transaction = Transaction::with(['vehicle'])->whereRelation('status', 'codename', 'PENDING')->findOrFail($transactionId);
            $APPROVED_ID = Status::where('codename', 'APPROVED')->first()->id;
            $INUSED_ID = VehicleStatus::where('codename', 'INUSED')->first()->id;
            $AVAILABLE_ID = VehicleStatus::where('codename', 'AVAILABLE')->first()->id;

            DB::beginTransaction();

            $transaction->update([
                'approver_id'   => Auth::user()->id,
                'status_id'     => $APPROVED_ID,
                'approved_at'   => now(),
            ]);

            DB::commit();

            Jobs\Vehicle\SetStatus::dispatch(
                $transaction->vehicle,
                $INUSED_ID
            )->delay($transaction->used_on);

            Jobs\Vehicle\SetStatus::dispatch(
                $transaction->vehicle,
                $AVAILABLE_ID
            )->delay($transaction->ends_on);

            return back()
                ->with('success', 'Successfully approved transaction');
        } catch (\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Reject the specified resource from storage.
     */
    public function reject(string $transactionId)
    {
        try {
            $transaction = Transaction::whereRelation('status', 'codename', 'PENDING')->findOrFail($transactionId);
            $REJECTED_ID = Status::where('codename', 'REJECTED')->first()->id;
            $AVAILABLE_ID = VehicleStatus::where('codename', 'AVAILABLE')->first()->id;

            DB::beginTransaction();

            $transaction->update([
                'approver_id'   => Auth::user()->id,
                'status_id'     => $REJECTED_ID,
                'rejected_at'   => now(),
            ]);

            DB::commit();

            return back()
                ->with('success', 'Successfully rejected transaction');
        } catch (\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Approves the specified list resource from storage.
     */
    public function approves(Request $request)
    {
        try {
            $transactionIds = $request->transactionIds;
            $transactions = Transaction::whereIn('id', $transactionIds)->whereRelation('status', 'codename', 'PENDING')->get();
            $INUSED_ID = VehicleStatus::where('codename', 'INUSED')->first()->id;
            $AVAILABLE_ID = VehicleStatus::where('codename', 'AVAILABLE')->first()->id;
            $T_APPROVED_ID = Status::where('codename', 'APPROVED')->first()->id;
            $T_COMPLETED_ID = Status::where('codename', 'COMPLETED')->first()->id;
            $T_ONGOING_ID = Status::where('codename', 'ONGOING')->first()->id;

            $transactions->each(function ($transaction) use ($AVAILABLE_ID, $INUSED_ID, $T_APPROVED_ID, $T_COMPLETED_ID, $T_ONGOING_ID) {
                DB::beginTransaction();

                $transaction->update([
                    'approver_id'   => Auth::user()->id,
                    'status_id'     => $T_APPROVED_ID,
                    'approved_at'   => now(),
                ]);

                DB::commit();

                Jobs\Vehicle\Transaction\SetStatus::dispatch(
                    $transaction,
                    $T_ONGOING_ID
                )->delay($transaction->used_on);

                Jobs\Vehicle\Transaction\SetStatus::dispatch(
                    $transaction,
                    $T_COMPLETED_ID
                )->delay($transaction->ends_on);

                Jobs\Vehicle\SetStatus::dispatch(
                    $transaction->vehicle,
                    $INUSED_ID
                )->delay($transaction->used_on);

                Jobs\Vehicle\SetStatus::dispatch(
                    $transaction->vehicle,
                    $AVAILABLE_ID
                )->delay($transaction->ends_on);
            });

            return back()
                ->with('success', 'Successfully approved transactions');
        } catch (\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Rejects the specified list resource from storage.
     */
    public function rejects(Request $request)
    {
        try {
            $transactionIds = $request->transactionIds;

            DB::beginTransaction();

            Transaction::whereIn('id', $transactionIds)
                ->whereRelation('status', 'codename', 'PENDING')
                ->update([
                    'approver_id'   => Auth::user()->id,
                    'status_id'     => Status::where('codename', 'REJECTED')->first()->id,
                    'rejected_at'   => now(),
                ]);

            DB::commit();

            return back()
                ->with('success', 'Successfully rejected transactions');
        } catch (\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Completes the specified list resource from storage.
     */
    public function completes(Request $request)
    {
        try {
            $transactionIds = $request->transactionIds;
            $T_ONGOING_ID = Status::where('codename', 'ONGOING')->first()->id;
            $transactions = Transaction::whereIn('id', $transactionIds)->where('status_id', $T_ONGOING_ID)->get();
            $AVAILABLE_ID = VehicleStatus::where('codename', 'AVAILABLE')->first()->id;
            $T_COMPLETED_ID = Status::where('codename', 'COMPLETED')->first()->id;

            $transactions->each(function ($transaction) use ($AVAILABLE_ID, $T_COMPLETED_ID) {
                DB::beginTransaction();

                $transaction->update([
                    'completer_id'  => Auth::user()->id,
                    'status_id'     => $T_COMPLETED_ID,
                    'completed_at'  => now(),
                ]);

                $transaction->vehicle()->update([
                    'status_id'     => $AVAILABLE_ID,
                ]);

                DB::commit();
            });

            return back()
                ->with('success', 'Successfully completed transactions');
        } catch (\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }

    /**
     * Export transaction report
     */
    public function export()
    {
        $filename = __('pages.requests.title') . ' - ' . env('APP_NAME') . '.xlsx';
        $statusesTableName = (new Status)->getTable();
        $usersTableName = (new User)->getTable();
        $transactionsTableName = (new Transaction)->getTable();
        $vehiclesTableName = (new Vehicle)->getTable();

        $transactions = DB::table("$transactionsTableName AS A")
            ->join("$statusesTableName AS B", 'A.status_id', '=', 'B.id')
            ->join("$usersTableName AS C", 'A.user_id', '=', 'C.id')
            ->join("$vehiclesTableName AS D", 'A.vehicle_id', '=', 'D.id')
            ->join("$usersTableName AS E", 'A.approver_id', '=', 'E.id')
            ->latest()
            ->select([
                'A.code AS CODE',
                'A.destination AS DESTINATION',
                'A.description AS DESCRIPTION',
                'A.used_on AS USED ON',
                'A.ends_on AS ENDS ON',
                'B.codename AS STATUS.CODENAME',
                'C.name AS USER.NAME',
                'C.email AS USER.EMAIL',
                'D.name AS VEHICLE.NAME',
                'D.color AS VEHICLE.COLOR',
                'D.number_plate AS VEHICLE.NUMBER PLATE',
                'E.name AS APPROVER.NAME',
                'E.email AS APPROVER.EMAIL',
                'A.created_at AS CREATED_AT',
                'A.approved_at AS APPROVED_AT',
                'A.rejected_at AS REJECTED_AT',
                'A.completed_at AS COMPLETED_AT',
            ]);

        function transactionsGenerator($transactions) {
            foreach($transactions->cursor() as $transaction) {
                yield $transaction;
            }
        }

        return (new FastExcel(transactionsGenerator($transactions)))
            ->headerStyle((new Style)
                ->setBorder((new Border(
                    new BorderPart(Border::LEFT, '65a30d', Border::WIDTH_THIN),
                    new BorderPart(Border::RIGHT, '65a30d', Border::WIDTH_THIN),
                    new BorderPart(Border::BOTTOM, '65a30d', Border::WIDTH_THIN),
                )))
                ->setBackgroundColor('f0fdf4')
                ->setFontColor('16A34A')
                ->setFontSize(14)
                ->setFontBold()
            )
            ->rowsStyle((new Style)
                ->setBorder((new Border(
                    new BorderPart(Border::LEFT, '65a30d', Border::WIDTH_THIN),
                    new BorderPart(Border::RIGHT, '65a30d', Border::WIDTH_THIN),
                )))
                ->setFontSize(14)
            )
            ->download($filename);
    }
}
