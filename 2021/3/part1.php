<?php declare(strict_types=1);

$input = require __DIR__ . '/input.php';

$bitCommonalities = array_fill(0, strlen($input[0]), 0);

foreach ($input as $reading) {
    foreach (str_split($reading) as $index => $bit) {
        if ($bit === '1') {
            $bitCommonalities[$index]++;
        }
    }
}

$gammaRate = '';
$epsilonRate = '';

foreach ($bitCommonalities as $bitCommonallity) {
    if ($bitCommonallity >= (count($input) / 2)) {
        $gammaRate .= 1;
        $epsilonRate .= 0;
    } else {
        $gammaRate .= 0;
        $epsilonRate .= 1;
    }
}

echo 'Gamma rate: ' . $gammaRate . ' (' . bindec($gammaRate) . ')' . PHP_EOL;
echo 'Epsilon rate: ' . $epsilonRate . ' (' . bindec($epsilonRate) . ')' . PHP_EOL;

echo 'Answer: ' . bindec($gammaRate) * bindec($epsilonRate) . PHP_EOL;
