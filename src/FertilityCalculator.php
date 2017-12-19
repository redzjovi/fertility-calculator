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

        $interval = new DateInterval('P1D');
        $startDate = (new Carbon($lastPeriod))->subMonths($month)->startOfMonth();
        $endDate = (new Carbon($lastPeriod))->addMonths($month)->endOfMonth();


        $periods = new DatePeriod($startDate, $interval, $endDate);
        foreach ($periods as $date) {
            $diffInDays = (new Carbon($lastPeriod))->diffInDays($date);

            if ($diffInDays % $cycle == 0) {
                $ovulationPeriod = (new Carbon($date))->subDays(14);
                $startFertility = (new Carbon($date))->subDays(14)->subDays(5);
                // $endFertility = (new Carbon($startDate))->subDays(14)->addDays(1);

                $lastPeriod = (new Carbon($date))->addDays($cycle);

                $rangePeriod = 6;

                $i = 0;
                for ($i = 0; $i < $rangePeriod; $i++) {
                    $dates[] = [
                        'background_color' => $colors[$i],
                        'class_name' => ($i == 4 ? ['fertile', 'fertile-love'] : ['fertile', 'fertile-check']),
                        'date' => $startFertility->addDays(1)->toDateString(),
                    ];
                }
            }
        }

        return $dates;
    }
}
