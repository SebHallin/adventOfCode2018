<?php

function part1($input)
{
    $asleepTime = [];
    $asleepMinutes = [];

    foreach ($input as $row) {
        if (strpos($row, 'Guard ')) {
            $guardId = substr($row, strpos($row, 'Guard ') + 7, -13);
            continue;
        }

        if (strpos($row, 'falls ')) {
            if (substr($row, 12, 2) != 0) {
                $sleepStart = 0;
            } else {
                $sleepStart = substr($row, 15, 2);
            }
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

    $guardId = implode(', ', array_keys($asleepTime, max($asleepTime)));

    $mostOftenAsleep = implode(', ', array_keys($asleepMinutes[$guardId], max($asleepMinutes[$guardId]))). "\n";

    return $guardId . ' x ' . $mostOftenAsleep;
}

function part2($input)
{
    $asleepMinutes = [];

    foreach ($input as $row) {
        if (strpos($row, 'Guard ')) {
            $guardId = substr($row, strpos($row, 'Guard ') + 7, -13);
            continue;
        }

        if (strpos($row, 'falls ')) {
            if (substr($row, 12, 2) != 0) {
                $sleepStart = 0;
            } else {
                $sleepStart = substr($row, 15, 2);
            }
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

    $currMax = 0;
    $currGuardId = 0;
    foreach ($asleepMinutes as $guardId => $row) {
        if (max($row) > $currMax) {
            $currGuardId = $guardId;
            $currMax = implode(', ', array_keys($row, max($row)));
        }
    }

    return $currGuardId . ' x ' . $currMax;
}

$input = array_filter(explode("\n", file_get_contents('input_day4.txt')));

asort($input);


echo part1($input) . "\n";
echo part2($input) . "\n";
