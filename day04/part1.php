<?php

[$numbers, $boards] = require(dirname(__FILE__) . '/data.php');

$triedNumbers = [];
foreach ($numbers as $number) {
  $triedNumbers[] = $number;

  foreach ($boards as &$board) {
    foreach ($board as &$boardLine) {
      foreach ($boardLine as &$value) {
        if ($value === $number) {
          $value = null;
        }
      }
    }

    $win = isBoardWin($board);

    if ($win) {
      $sum = array_sum(array_map('array_sum', $board));

      echo 'Result = ' . (array_pop($triedNumbers) * $sum);die;
    }
  }
}

function isBoardWin(array $board): bool
{
  foreach ($board as $boardLine) {
      if (isWinningLine($boardLine)) {
          return true;
      }
  }

  return isWinningOnColumns($board);
}

function isWinningLine(array $line): bool
{
    $newLine = array_filter($line);

    return count($newLine) === 0;
}

function isWinningOnColumns(array $board): bool
{
    for ($c = 0 ; $c < 5 ; $c++) {
        $areSameValues = true;
        for ($l = 1 ; $l < 5 ; $l++) {
            $areSameValues = $areSameValues && $board[$l - 1][$c] === $board[$l][$c];
        }

        if ($areSameValues) {
            return true;
        }
    }


    return false;
}
