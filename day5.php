<?php

function getReactors()
{
    return array_merge(
        array_map(function($letter) {
            return $letter . strtoupper($letter);
        }, range('a', 'z')),
        array_map(function($letter) {
            return strtoupper($letter) . $letter;
        }, range('a', 'z')));
}

function part1($input, $reactors)
{
    do {
        $input = str_replace($reactors, '', $input, $replacements);
    } while ($replacements > 0);

    return strlen($input);
}

function part2($input, $reactors)
{
    return min(array_map(function ($letter) use ($input, $reactors) {
        return part1(str_replace([$letter, strtoupper($letter)], '', $input), $reactors);
    }, range('a', 'z')));
}

$input = trim(file_get_contents('input_day5.txt'));
$reactors = getReactors();

echo part1($input, $reactors) . "\n";
echo part2($input, $reactors) . "\n";
