<?php

function part1($input)
{
    $asleepTime = $asleepMinutes = [];

    foreach ($input as $row) {
        if (strpos($row, 'Guard ')) {
            $guardId = substr($row, 26, -13);
            continue;
        } elseif (strpos($row, 'falls ')) {
            $sleepStart = substr($row, 12, 2) != 0 ? 0 : substr($row, 15, 2);
        } elseif (strpos($row, 'wakes ')) {
            if (! isset($asleepTime[$guardId])) {
                $asleepTime[$guardId] = 0;
            }

            $sleepEnd = substr($row, 15, 2);
            $asleepTime[$guardId] += $sleepEnd - $sleepStart;

            for ($i = $sleepStart; $i < $sleepEnd; $i++) {
                if (! isset($asleepMinutes[$guardId][$i])) {
                    $asleepMinutes[$guardId][$i] = 0;
                }
                $asleepMinutes[$guardId][$i] += 1;
            }
        }
    }

    $guardId = current(array_keys($asleepTime, max($asleepTime)));
    $mostOftenAsleep = current(array_keys($asleepMinutes[$guardId], max($asleepMinutes[$guardId])));

    return $guardId * $mostOftenAsleep;
}

function part2($input)
{
    $asleepMinutes = [];

    foreach ($input as $row) {
        if (strpos($row, 'Guard ')) {
            $guardId = substr($row, 26, -13);
            continue;
        } elseif (strpos($row, 'falls ')) {
            $sleepStart = substr($row, 12, 2) != 0 ? 0 : substr($row, 15, 2);
        } elseif (strpos($row, 'wakes ')) {
            $sleepEnd = substr($row, 15, 2);

            for ($i = $sleepStart; $i < $sleepEnd; $i++) {
                if (! isset($asleepMinutes[$guardId][$i])) {
                    $asleepMinutes[$guardId][$i] = 0;
                }
                $asleepMinutes[$guardId][$i] += 1;
            }
        }
    }

    $currMaxSum = $currMaxMinute = 0;
    foreach ($asleepMinutes as $guardId => $row) {
        if (max($row) > $currMaxMinute) {
            $currMaxMinute = max($row);
            $currMaxSum = $guardId * current(array_keys($row, max($row)));
        }
    }

    return $currMaxSum;
}

$input = array_filter(explode("\n", file_get_contents('input_day4.txt')));

asort($input);

echo part1($input) . "\n";
echo part2($input) . "\n";
