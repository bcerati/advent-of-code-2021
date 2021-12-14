<?php

$rs = fopen(dirname(__FILE__) . '/puzzle.txt', 'r');

if ($rs) {
    $previous = PHP_INT_MAX;
    $result = 0;
    while ($line = fgets($rs)) {
        $currentValue = (int)$line;

        if ($currentValue > $previous) {
            $result++;
        }

        $previous = $currentValue;
    }
}

echo sprintf('%s measurements are larger than the previous measurement !', $result);