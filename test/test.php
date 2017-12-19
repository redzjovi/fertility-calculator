<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use redzjovi\fertility\FertilityCalculator;

$fertilicyCalculator = new FertilityCalculator();
// $dates = $fertilicyCalculator->calculate(date('Y-m-d'), 25);
$dates = $fertilicyCalculator->calculate('2017-10-20', 28);

echo '<pre>';
var_dump($dates);
