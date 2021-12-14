<?php

$rs = fopen(dirname(__FILE__) . '/puzzle.txt', 'r');

if ($rs) {
    $lines = [];

    $previous = PHP_INT_MAX;
    $result = 0;

    $i = 0;
    while ($line = fgets($rs)) {
        ++$i;

        $lines[] = (int)$line;

        if ($i > 2) {
            $currentSum = $lines[$i - 1] + $lines[$i - 2] + $lines[$i - 3];
            if ($currentSum > $previous) {
                $result++;
            }

            $previous = $currentSum;
        }
    }
}

echo sprintf('%s measurements are larger than the previous measurement !', $result);