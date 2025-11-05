<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Vehicle\Transaction\{Status, Transaction};
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{App, Lang};
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard home view handler
     *
     * @return \Illuminate\View\View
     */
    public function index() :View
    {
        $vehicles   = Vehicle::get();
        $locale     = App::currentLocale();

        $topUsers   = User::withCount([
                'transactions' => fn($query) => $query->whereRelation('status', 'codename', 'COMPLETED'),
            ])
            ->whereHas('transactions.status', fn($query) => (
                $query->where('codename', 'COMPLETED')
            ))
            ->orderBy('transactions_count', 'DESC')
            ->take(10)
            ->get();

        $charts = [
            'allRequests' => Transaction::monthlyChartByCreatedAt(now()->subMonths(5), now(), 'M'),

            'completedRequests' => Transaction::whereRelation('status', 'codename', 'COMPLETED')
                ->monthlyChartByCreatedAt(now()->subMonths(5), now(), 'M'),

            'rejectedRequests' => Transaction::whereRelation('status', 'codename', 'REJECTED')
                ->monthlyChartByCreatedAt(now()->subMonths(5), now(), 'M'),
        ];

        $langs = collect([
                'globals.all',
                'globals.daily',
                'globals.monthly',
                'globals.today',
                'globals.week',
                'globals.weekly',
                'pages.requests.status.completed',
                'pages.requests.status.rejected',
                'pages.dashboard.completedRequests',
                'pages.dashboard.topUsers',
            ])
            ->mapWithKeys(fn($langKey) => (
                [$langKey => Lang::get($langKey)]
            ));

        return view('pages.dashboard.index', compact([
            'charts',
            'langs',
            'locale',
            'topUsers',
            'vehicles',
        ]));
    }

    /**
     * Transaction list for dashboard home view handler
     *
     * @return \Illuminate\View\View
     */
    public function apiTransactions() :JsonResponse
    {
        $APPROVED_IDS = Status::whereIn('codename', ['APPROVED', 'ONGOING', 'COMPLETED'])->get()->pluck('id');
        $transactions = Transaction::whereIn('status_id', $APPROVED_IDS)->get();

        $transactions = $transactions->map(fn($item) => ([
            'url'   => route('vehicles.transactions'),
            'title' => $item->destination,
            'start' => $item->used_on,
            'end' => $item->ends_on,
        ]));

        return response()->json($transactions);
    }
}
