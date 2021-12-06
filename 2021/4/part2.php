<?php declare(strict_types=1);

class Board {
    /** @var Number[][] $numberMatrix */
    public function __construct(
        public array $numberMatrix = [],
    ) {
    }

    public function markNumber(int $numberToMark): void
    {
        foreach ($this->numberMatrix as $numberRow) {
            foreach ($numberRow as $number) {
                if ($number->value === $numberToMark) {
                    $number->isMarked = true;
                }
            }
        }
    }

    public function hasCompleteLine(): bool
    {
        foreach ($this->numberMatrix as $numberRow) {
            $completeNumbers = array_filter($numberRow, fn (Number $number): bool => $number->isMarked === true);

            if (count($completeNumbers) === count($numberRow)) {
                return true;
            }
        }

        for ($i = 0; $i<5; $i++) {
            $column = array_column($this->numberMatrix, $i);
            $completeNumbers = array_filter($column, fn (Number $number): bool => $number->isMarked === true);

            if (count($completeNumbers) === count($column)) {
                return true;
            }
        }

        return false;
    }

    public function getUnmarkedSum(): int
    {
        $sum = 0;

        foreach ($this->numberMatrix as $numberRow) {
            foreach ($numberRow as $number) {
                if ($number->isMarked === false) {
                    $sum += $number->value;
                }
            }
        }

        return $sum;
    }
}

class Number {
    public function __construct(
        public int $value,
        public bool $isMarked = false,
    ) {
    }
}



$input = require __DIR__ . '/input.php';

$inputLines = explode("\n", $input);

$drawnNumbers = explode(',', array_shift($inputLines));
$drawnNumbers = array_map(fn ($drawnNumber): int => intval($drawnNumber), $drawnNumbers);



$boards = [];
$i = 0;
foreach (array_filter($inputLines) as $line) {
    if ($line === '') {
        continue;
    }

    $index = floor($i / 5);

    if (isset($boards[$index]) === false) {
        $boards[$index] = new Board();
    }


    $numbers = str_split($line, 3);
    $numbers = array_map(fn (string $number): Number => new Number((int)$number), $numbers);

    $boards[$index]->numberMatrix[] = $numbers;

    $i++;
}

$boardsComplete = [];

foreach ($drawnNumbers as $drawnNumber) {
    foreach ($boards as $boardIndex => $board) {
        if (in_array($boardIndex, $boardsComplete)) {
            continue;
        }

        $board->markNumber($drawnNumber);

        if ($board->hasCompleteLine()) {
            array_push($boardsComplete, $boardIndex);
        }

        if (count($boardsComplete) === count($boards)) {
            $unmarkedSum = $board->getUnmarkedSum();
            $lastNumber = $drawnNumber;

            break 2;
        }
    }
}

echo 'Answer: ' . $unmarkedSum * $lastNumber . PHP_EOL;
