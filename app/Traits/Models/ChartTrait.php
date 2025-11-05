<?php

namespace App\Traits\Models;

use App\Helpers\DateHelper;
use Carbon\Carbon;

trait ChartTrait{
    /**
     * Retrieve labels and data for chart usages
     *
     *  @return array<string, array>
     */
    public function scopeMonthlyChartByCreatedAt($query, $startDate, $endDate, $format='M y'): array
    {
        $labels = DateHelper::range($startDate, $endDate, $format, '1 month');
        $result = $query->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("DATE_FORMAT(created_at, '%m-%Y') as month, COUNT(*) as total")
            ->groupByRaw('month')
            ->get();

        $data = collect($labels)->map(function($item) use($result, $format) {
            $month = Carbon::createFromFormat($format, $item)->format('m-Y');
            $data = $result->where('month', $month)->first();
            return $data->total ?? 0;
        });

        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }
}
