<?php

function part1 ($input)
{
    $count2 = $count3 = 0;

    foreach ($input as $row) {
        $rowLetters = [];
        foreach (str_split($row) as $letter) {
            if (isset($rowLetters[$letter])) {
                $rowLetters[$letter] += 1;
            } else {
                $rowLetters[$letter] = 1;
            }
        }
        if (array_search(2, $rowLetters)) {
            $count2 += 1;
        }
        if (array_search(3, $rowLetters)) {
            $count3 += 1;
        }
    }
    return $count2 * $count3;
}

function part2($input)
{
    $prevStrings = [];

    foreach ($input as $row) {
        $rowLetters = str_split($row);
        foreach ($prevStrings as $prevString) {
            $diffCount = 0;
            foreach ($prevString as $i => $letter) {
                if ($prevString[$i] != $rowLetters[$i]) {
                    $diffCount += 1;
                    $lastErrorPos = $i;
                }
            }
            if ($diffCount == 1) {
                unset($prevString[$lastErrorPos]);
                return implode('', $prevString);
            }
        }
        $prevStrings[] = $rowLetters;
    }
}

$input = array_filter(explode("\n", file_get_contents('input_day2.txt')));
echo part1($input) . "\n";
echo part2($input) . "\n";
