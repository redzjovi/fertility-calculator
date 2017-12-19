<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use redzjovi\fertility\FertilityCalculator;

$fertilicyCalculator = new FertilityCalculator();
// $dates = $fertilicyCalculator->calculate(date('Y-m-d'), 25);
$dates = $fertilicyCalculator->calculate('2017-12-01', 28);

echo '<pre>';
var_dump($dates);
