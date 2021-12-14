<?php

$rs = fopen(dirname(__FILE__) . '/puzzle.txt', 'r');

$gammaBinary = '';
$epsilonBinary = '';
if ($rs) {
    $lines = [];

    $zeroBit = [];
    $oneBit = [];
    while ($line = fgets($rs)) {
        $line = trim($line);
        for ($i = 0 ; $i < strlen($line) ; $i++) {
            $zeroBit[$i] = $zeroBit[$i] ?? 0;
            $oneBit[$i] = $oneBit[$i] ?? 0;

            if ($line[$i] === '0') {
                $zeroBit[$i]++;
            } else {
                $oneBit[$i]++;
            }
        }
    }

    foreach ($zeroBit as $k => $value) {
        $gamaBit = $value > $oneBit[$k] ? 0 : 1;
        $epsilonBit = $value <= $oneBit[$k] ? 0 : 1;

        $gammaBinary .= $gamaBit;
        $epsilonBinary .= $epsilonBit;
    }
    $result = bindec($gammaBinary);
}

echo sprintf(
    'Gamma = %s. Epsilon = %s. g * e = %s in decimal model!',
    $gammaBinary,
    $epsilonBinary,
    bindec($gammaBinary) * bindec($epsilonBinary)
);