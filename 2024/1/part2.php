<?php

declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input');

$lines = explode("\n", trim($input));

$left = [];
$rightOccurrences = [];

foreach ($lines as $line) {
    $dataPoints = explode('   ', $line, 2);

    $left[] = (int)$dataPoints[0];

    if (array_key_exists($dataPoints[1], $rightOccurrences) === false) {
        $rightOccurrences[$dataPoints[1]] = 0;
    }

    $rightOccurrences[$dataPoints[1]]++;
}

$totalSimilarity = 0;

foreach ($left as $value) {
    $totalSimilarity += ($rightOccurrences[$value] ?? 0) * $value;
}

echo $totalSimilarity;
