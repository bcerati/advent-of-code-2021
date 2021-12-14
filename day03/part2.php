<?php

$rs = fopen(dirname(__FILE__) . '/puzzle.txt', 'r');

$gammaBinary = '';
$epsilonBinary = '';
if ($rs) {
    $lines = [];

    while ($line = fgets($rs)) {
        $lines[] = trim($line);
    }

    $oxyRating = findOxygenGeneratorRating($lines);
    $co2Rating = findCo2ScrubberRating($lines);

    echo sprintf('%s', bindec($oxyRating) * bindec($co2Rating));
}

function findOxygenGeneratorRating (array $lines): string {
    $col = 0;
    while (count($lines) !== 1) {
        $nb0 = 0;
        $nb1 = 0;
        foreach ($lines as $line) {
            if ((int)$line[$col] === 0) {
                $nb0++;
            } else {
                $nb1++;
            }
        }

        removeElementWhenPositionMatch($col, $nb1 >= $nb0 ? '1' : '0', $lines);
        $col++;
    }

    return array_shift($lines);
}

function findCo2ScrubberRating (array $lines): string {
    $col = 0;
    while (count($lines) !== 1) {
        $nb0 = 0;
        $nb1 = 0;
        foreach ($lines as $line) {
            if ((int)$line[$col] === 0) {
                $nb0++;
            } else {
                $nb1++;
            }
        }

        removeElementWhenPositionMatch($col, $nb0 <= $nb1 ? '0' : '1', $lines);
        $col++;
    }

    return array_shift($lines);
}

function removeElementWhenPositionMatch(int $pos, string $str, array &$values)
{
    foreach ($values as $k => $value) {
        if ($value[$pos] !== $str) {
            unset($values[$k]);
        }
    }

    $values = array_values($values);
}