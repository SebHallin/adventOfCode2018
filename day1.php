<?php

function part1 ($input)
{
    return array_sum($input);
}

function part2 ($input)
{
    $history = [];
    $frequency = 0;

    while (true) {
        foreach ($input as $row) {
            if (array_key_exists($frequency, $history)) {
                return $frequency;
            }
            $history[$frequency] = true;
            $frequency += $row;
        }
    }
}

$input = array_filter(explode("\n", file_get_contents('input_day1.txt')));
echo part1($input) . "\n";
echo part2($input) . "\n";
