<?php declare(strict_types=1);

$input = require_once __DIR__ . '/input.php';

$windows = [];

foreach ($input as $index => $item) {
    if ($index < 2) {
        continue;
    }

    $windows[] = $input[$index] + $input[$index - 1] + $input[$index - 2];
}


$windowIncreaseCount = 0;

$lastWindow = null;
foreach ($windows as $window) {
    if ($lastWindow === null) {
        $lastWindow = $window;
        continue;
    }

    if ($lastWindow < $window) {
        $windowIncreaseCount++;
    }

    $lastWindow = $window;
}

echo 'Answer: ' . $windowIncreaseCount . PHP_EOL;
