<?php declare(strict_types=1);

$input = require __DIR__ . '/input.php';


function findMostCommonBit($readings): array
{
    $bitCommonalities = array_fill(0, strlen(reset($readings)), 0);

    foreach ($readings as $reading) {
        foreach (str_split($reading) as $index => $bit) {
            if ($bit === '1') {
                $bitCommonalities[$index]++;
            }
        }
    }

    return array_map(fn ($bitCount): string => $bitCount >= (count($readings) / 2) ? '1':'0', $bitCommonalities);
}


// O2 Reading

$readings = $input;
$bitToConsider = 0;
while (count($readings) > 1) {
    $commonReadingBits = findMostCommonBit($readings);

    $readings = array_filter($readings, fn ($reading): bool => $reading[$bitToConsider] === $commonReadingBits[$bitToConsider]);

    $bitToConsider++;
}

$oxygenReading = reset($readings);


// CO2 Reading

$readings = $input;
$bitToConsider = 0;
while (count($readings) > 1) {
    $commonReadingBits = findMostCommonBit($readings);

    $readings = array_filter($readings, fn ($reading): bool => $reading[$bitToConsider] !== $commonReadingBits[$bitToConsider]);

    $bitToConsider++;
}

$co2Reading = reset($readings);


echo 'Oxygen reading: ' . $oxygenReading . ' (' . bindec($oxygenReading) . ')' . PHP_EOL;
echo 'CO2 reading: ' . $co2Reading . ' (' . bindec($co2Reading) . ')' . PHP_EOL;

echo 'Answer: ' . bindec($oxygenReading) * bindec($co2Reading) . PHP_EOL;
