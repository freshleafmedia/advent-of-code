<?php

declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input');

$lines = explode("\n", trim($input));

$left = [];
$right = [];

foreach ($lines as $line) {
    $dataPoints = explode('   ', $line, 2);

    $left[] = (int)$dataPoints[0];
    $right[] = (int)$dataPoints[1];
}

asort($left, SORT_NUMERIC);
asort($right, SORT_NUMERIC);

$left = array_values($left);
$right = array_values($right);

$distances = [];

for ($i = 0; $i < count($lines); $i++) {
    $distances[] = abs($right[$i] - $left[$i]);
}

echo array_sum($distances);
