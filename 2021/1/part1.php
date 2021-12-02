<?php declare(strict_types=1);

$input = require_once __DIR__ . '/input.php';

$increaseCount = 0;

$lastItem = null;
foreach ($input as $item) {
    if ($lastItem === null) {
        $lastItem = $item;
        continue;
    }

    if ($lastItem < $item) {
        $increaseCount++;
    }

    $lastItem = $item;
}

echo 'Answer: ' . $increaseCount . PHP_EOL;
