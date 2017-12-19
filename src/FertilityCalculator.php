<?php

namespace redzjovi\fertility;

class FertilityCalculator
{
    /**
     * example calculate('2017-12-18', 20)
     * return [
     *      '0' => [background_color => '#e9f6da', 'date' => '2017-12-18'],
     *      '1' => [background_color => '#ddefc8', 'date' => '2017-12-19'],
     *      '2' => [background_color => '#d4ebb8', 'date' => '2017-12-20'],
     *      '3' => [background_color => '#c0e496', 'date' => '2017-12-21'],
     *      '4' => [background_color => '#99d453', 'date' => '2017-12-22'],
     *      '5' => [background_color => '#c0e496', 'date' => '2017-12-23'],
     * ];
     * 
     * @param date $lastPeriod
     * @param integer $lengthCycle
     * @return array $dates
     */
    public function calculate($lastPeriod, $lengthCycle = 20)
    {
        $colors = ['#e9f6da', '#ddefc8', '#d4ebb8', '#c0e496', '#99d453', '#c0e496'];
        $dates = [];
        $fertilityDate = date('Y-m-d', strtotime($lastPeriod.' + '.($lengthCycle - 18).' days'));
        
        for ($i = 0; $i < 6; $i++) {
            $dates[] = [
                'background_color' => $colors[$i],
                'date' => date('Y-m-d', strtotime($fertilityDate.' + '.$i.' days')),
            ];
        }

        return $dates;
    }
}
