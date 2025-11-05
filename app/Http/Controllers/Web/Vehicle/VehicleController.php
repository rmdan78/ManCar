<?php

namespace App\Http\Controllers\Web\Vehicle;

use App\Exceptions\ResponseException;
use App\Helpers\CollectionHelper;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Vehicle\{IndexRequest, CreateRequest, EditRequest};
use App\Models\Vehicle\Kind;
use App\Models\Vehicle\Thumbnail;
use App\Models\Vehicle\Vehicle;
use ErrorException;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $vehicles = Vehicle::latest()->get();

        return view('pages.vehicles.index', compact([
            'vehicles',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        $kinds = Kind::get();

        return view('pages.vehicles.create.index', compact([
            'kinds',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $thumbnail = $request->file('thumbnail');
            $kind = Kind::findOrFail($request->kind_id);

            if(!$thumbnail->isReadable())
                throw new ErrorException('Thumbnail is unreadable', 422);

            $thumbnail = Thumbnail::create([
                'uri' => StorageHelper::putPublic('/vehicles/thumbnails', $thumbnail),
            ]);

            Vehicle::create([
                'thumbnail_id'  => $thumbnail->id,
                'kind_id'       => $kind->id,
                'name'          => $request->name,
                'description'   => $request->description,
                'color'         => $request->color,
                'number_plate'  => $request->number_plate,
                'bought_on'     => $request->bought_on,
            ]);

            return back()
                ->with('success', 'Successfully created vehicle');
        } catch(\Exception $err) {
            return back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditRequest $request, string $vehicleId)
    {
        $kinds = Kind::get();
        $vehicle = Vehicle::with(['kind', 'thumbnail'])->find($vehicleId);

        return view('pages.vehicles.edit.index', compact([
            'kinds',
            'vehicle',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $vehicleId)
    {
        try {
            $vehicle = Vehicle::with(['thumbnail'])->findOrFail($vehicleId);
            $data = CollectionHelper::getOrOld($request, $vehicle);
            $kind = Kind::findOrFail($request->kind_id);

            if($data) $data = $data->only([
                'kind_id',
                'name',
                'description',
                'color',
                'number_plate',
                'bought_on',
            ]);

            if($thumbnail = $request->file('thumbnail')) {
                if($oldThumbnail = $vehicle->thumbnail) {
                    StorageHelper::deletePublic($oldThumbnail->uri);
                    $oldThumbnail->delete();
                }

                $thumbnail = $vehicle->thumbnail()->create([
                    'uri' => StorageHelper::putPublic('/vehicles/thumbnails', $thumbnail),
                ]);

                $data->put('thumbnail_id', $thumbnail->id);
            }

            $vehicle->update($data->toArray());

            return back()
                ->with('success', 'Successfully edited vehicle');
        } catch(\Exception $err) {
            return back()
                ->withInput()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $vehicleId)
    {
        try {
            $vehicle = Vehicle::with('thumbnail')
                ->withCount(['transactions'])
                ->findOrFail($vehicleId);

            if($vehicle->transactions_count)
                throw new ResponseException('Cannot delete, vehicle already used', 422);

            if($vehicle->thumbnail) {
                StorageHelper::deletePublic($vehicle->thumbnail);
                $vehicle->thumbnail->delete();
            }

            $vehicle->delete();

            return back()
                ->with('success', 'Successfully deleted vehicle');;
        } catch(\Exception $err) {
            return back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }
}
