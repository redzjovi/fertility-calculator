## Synopsis
PHP fertility calculator.

## Installation
```
composer require redzjovi/fertility-calculator
```

## How to use
```
use redzjovi\fertility\Tiki;

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
$fertilicyCalculator = new FertilityCalculator();
$dates = $fertilicyCalculator->calculate(date('Y-m-d'), 25);

var_dump($track);
```