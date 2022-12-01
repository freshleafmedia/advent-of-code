<?php declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input');

$calorieTotals = [];

foreach (explode("\n\n", $input) as $elfSnackCalorieList) {
    $calorieTotals[] = array_sum(explode("\n", $elfSnackCalorieList));
}

rsort($calorieTotals);

$topThreeCalorieTotals = $calorieTotals[0] + $calorieTotals[1] + $calorieTotals[2];

echo 'Answer: ' . $topThreeCalorieTotals . PHP_EOL;
