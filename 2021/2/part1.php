<?php declare(strict_types=1);

$input = require_once __DIR__ . '/input.php';

$positionHorizontal = 0;
$positionDepth = 0;

foreach ($input as $direction) {
    [$action, $distance] = explode(' ', $direction);

    if ($action === 'forward') {
        $positionHorizontal += (int)$distance;
    } elseif ($action === 'up') {
        $positionDepth -= (int)$distance;
    } elseif ($action === 'down') {
        $positionDepth += (int)$distance;
    } else {
        throw new Exception('Unknown action ' . $action);
    }
}

echo 'Position: ' . $positionHorizontal . PHP_EOL;
echo 'Depth: ' . $positionDepth . PHP_EOL;
echo 'Answer ' . $positionHorizontal * $positionDepth . PHP_EOL;
