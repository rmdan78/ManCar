<?php

namespace App\Helpers;

use Carbon\{CarbonPeriod};

class DateHelper{
    static public function range($start, $end, $format='d M y', $stepBy='day') {
        $items  = [];
        $period = CarbonPeriod::create($start, $end)->stepBy($stepBy);

        foreach($period as $item)
            $items[] = $item->format($format);

        return $items;
    }
}
