<?php

namespace redzjovi\fertility;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;

class FertilityCalculator
{
    /**
     * example calculate('2017-12-18', 20)
     * return [
     *      '0' => [background_color => '#e9f6da', 'class_name' => ['fertile', 'fertile-check'], date' => '2017-12-18'],
     *      '1' => [background_color => '#ddefc8', 'class_name' => ['fertile', 'fertile-check'], 'date' => '2017-12-19'],
     *      '2' => [background_color => '#d4ebb8', 'class_name' => ['fertile', 'fertile-check'], 'date' => '2017-12-20'],
     *      '3' => [background_color => '#c0e496', 'class_name' => ['fertile', 'fertile-check'], 'date' => '2017-12-21'],
     *      '4' => [background_color => '#99d453', 'class_name' => ['fertile', 'fertile-love'], 'date' => '2017-12-22'],
     *      '5' => [background_color => '#c0e496', 'class_name' => ['fertile', 'fertile-check'], 'date' => '2017-12-23'],
     * ];
     *
     * @param date $lastPeriod Y-m-d
     * @param integer $cycle
     * @return array $dates
     */
    public function calculate($lastPeriod, $cycle = 20, $month = 6)
    {
        $colors = ['#e9f6da', '#ddefc8', '#d4ebb8', '#c0e496', '#99d453', '#c0e496'];
        $dates = [];

        $lastPeriod = Carbon::createFromFormat('Y-m-d', $lastPeriod);
        $rangePeriod = 6;
        $startFertility = $cycle - 18;
        $endFertility = $cycle - 18 + $rangePeriod;

        $interval = new DateInterval('P1D');
        $startDate = (new Carbon($lastPeriod))->subMonths($month)->startOfMonth();
        $endDate = (new Carbon($lastPeriod))->addMonths($month)->endOfMonth();


        // from next month
        $periods = new DatePeriod($startDate, $interval, $lastPeriod);
        $j = 0;
        foreach ($periods as $date) {
            $diffInDays = $lastPeriod->diffInDays($date);

            if ($diffInDays >= $startFertility && $diffInDays % $startFertility == 0) {
                $j = 0;
            }

            if (
                $diffInDays >= $startFertility &&
                $diffInDays % $startFertility >= 0 &&
                $diffInDays % $startFertility < $rangePeriod
            ) {
                $dates[] = ['background_color' => $colors[$j], 'class_name' => ($j == 1 ? ['fertile', 'fertile-love'] : ['fertile', 'fertile-check']), 'date' => $date->format('Y-m-d')];
                $j++;
            }
        }

        // until next month
        $periods = new DatePeriod($lastPeriod, $interval, $endDate);
        $j = 0;
        foreach ($periods as $date) {
            $diffInDays = $lastPeriod->diffInDays($date);

            if ($diffInDays >= $startFertility && $diffInDays % $startFertility == 0) {
                $j = 0;
            }

            if ($diffInDays >= $startFertility && $diffInDays % $startFertility >= 0 && $diffInDays % $startFertility < $rangePeriod) {
                $dates[] = ['background_color' => $colors[$j], 'class_name' => ($j == 4 ? ['fertile', 'fertile-love'] : ['fertile', 'fertile-check']), 'date' => $date->format('Y-m-d')];
                $j++;
            }
        }

        return $dates;
    }

    public function calculate_motherandbaby($lastPeriod, $cycle = 20, $month = 6)
    {
        // $colors = ['#e9f6da', '#ddefc8', '#d4ebb8', '#c0e496', '#99d453', '#c0e496'];
        $colors = ['#e9f6da', '#e9f6da', '#e9f6da', '#e9f6da', '#ddefc8', '#d4ebb8', '#c0e496', '#99d453', '#c0e496'];
        $dates = [];

        $lastPeriod = Carbon::createFromFormat('Y-m-d', $lastPeriod);
        $rangePeriod = 9;
        $interval = new DateInterval('P1D');
        $startDate = (new Carbon($lastPeriod))->subMonths($month)->startOfMonth();
        $endDate = (new Carbon($lastPeriod))->addMonths($month)->endOfMonth();

        // from next month
        $startFertility = $cycle;
        $periods = new DatePeriod($startDate, $interval, $lastPeriod);
        $j = 0;
        foreach ($periods as $date) {
            $diffInDays = $lastPeriod->diffInDays($date) - 1;

            if ($diffInDays % $startFertility == 0) {
                $j = 0;
            }

            if ($diffInDays % $startFertility > 0 && $diffInDays % $startFertility >= ($cycle - $rangePeriod)) {
                $dates[] = ['background_color' => $colors[$j], 'class_name' => ($j == 7 ? ['fertile', 'fertile-love'] : ['fertile', 'fertile-check']), 'date' => $date->format('Y-m-d')];
                $j++;
            }
        }

        // until next month
        $startFertility = $cycle;
        $periods = new DatePeriod($lastPeriod, $interval, $endDate);
        $j = 0;
        foreach ($periods as $date) {
            $diffInDays = $lastPeriod->diffInDays($date);

            if ($diffInDays % $startFertility == 0) {
                $j = 0;
            }

            if ($diffInDays % $startFertility >= 0 && $diffInDays % $startFertility < $rangePeriod) {
                $dates[] = ['background_color' => $colors[$j], 'class_name' => ($j == 7 ? ['fertile', 'fertile-love'] : ['fertile', 'fertile-check']), 'date' => $date->format('Y-m-d')];
                $j++;
            }
        }

        return $dates;
    }
}
