<?php

function part1($input)
{
    $coverage = [];
    foreach ($input as $row) {
        $coords = explode(',', substr($row, strpos($row, '@') + 2, strpos($row, ':') - (strpos($row, '@') + 2)));
        $size = explode('x', substr($row, strpos($row, ':') + 2));
        for ($x = $coords[0]; $x < ($coords[0] + $size[0]); $x++) {
            for ($y = $coords[1]; $y < ($coords[1] + $size[1]); $y++) {
                if (isset($coverage[$x][$y])) {
                    $coverage[$x][$y] += 1;
                } else {
                    $coverage[$x][$y] = 1;
                }
            }
        }
    }
    $sum = 0;
    foreach ($coverage as $row) {
        foreach ($row as $column) {
            if ($column > 1) {
                $sum += 1;
            }
        }
    }
    return $sum;
}
function part2($input)
{
    $coverage = [];
    foreach ($input as $row) {
        $coords = explode(',', substr($row, strpos($row, '@') + 2, strpos($row, ':') - (strpos($row, '@') + 2)));
        $size = explode('x', substr($row, strpos($row, ':') + 2));
        $hasOverlap = false;
        for ($x = $coords[0]; $x < ($coords[0] + $size[0]); $x++) {
            for ($y = $coords[1]; $y < ($coords[1] + $size[1]); $y++) {
                if (isset($coverage[$x][$y])) {
                    $hasOverlap = true;
                    $coverage[$x][$y] += 1;
                } else {
                    $coverage[$x][$y] = 1;
                }
            }
        }
    }
    foreach ($input as $row) {
        $coords = explode(',', substr($row, strpos($row, '@') + 2, strpos($row, ':') - (strpos($row, '@') + 2)));
        $size = explode('x', substr($row, strpos($row, ':') + 2));
        $hasOverlap = false;
        for ($x = $coords[0]; $x < ($coords[0] + $size[0]); $x++) {
            for ($y = $coords[1]; $y < ($coords[1] + $size[1]); $y++) {
                if ($coverage[$x][$y] > 1) {
                    $hasOverlap = true;
                }
            }
        }
        if (! $hasOverlap) {
            return $row;
        }
    }
}

$input = array_filter(explode("\n", file_get_contents('input_day3.txt')));
echo part1($input) . "\n";
echo part2($input) . "\n";
