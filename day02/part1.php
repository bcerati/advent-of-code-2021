<?php

$rs = fopen(dirname(__FILE__) . '/puzzle.txt', 'r');

$x = 0;
$y = 0;

if ($rs) {
    while ($line = fgets($rs)) {
        [$move, $size] = explode(' ', trim($line));

        switch ($move) {
            case 'forward':
                $x += (int)$size;
                break;
            case 'down':
                $y += (int)$size;
                break;
            case 'up':
                $y -= (int)$size;
                break;
        }
    }
}

echo sprintf('Position of the submarine : (x, y) = (%s, %s). Multiplication is %s.', $x, $y, $x * $y);