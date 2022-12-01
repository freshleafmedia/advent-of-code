<?php declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input');

$maxCalories = 0;

foreach (explode("\n\n", $input) as $elfSnackCalorieList) {
    $totalCalories = array_sum(explode("\n", $elfSnackCalorieList));

    if ($totalCalories > $maxCalories) {
        $maxCalories = $totalCalories;
    }
}

echo 'Answer: ' . $maxCalories . PHP_EOL;
