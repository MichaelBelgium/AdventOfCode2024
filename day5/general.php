<?php

$input = fopen('input.txt', 'r');

$rules = $updates = [];

$switchToUpdates = false;

while(!feof($input))
{
    $line = trim(fgets($input));

    if (strlen($line) == 0)
    {
        $switchToUpdates = true;
        continue;
    }

    if ($switchToUpdates)
        $updates[] = array_map('intval', explode(',', $line));
    else
    {
        [$before, $after] = array_map('intval', explode('|', $line));

        // The $rules array maps a number (key) to a list of numbers (value)
        // Each key must come before all numbers in its corresponding value list
        if (!array_key_exists($before, $rules))
            $rules[$before] = [];

        $rules[$before][] = $after;
    }
}

fclose($input);

function isValidUpdate(array $update, int &$incorrectNumber = -1): bool
{
    global $rules;

    for($i = 0; $i < count($update) - 1; $i++)
    {
        $number = $update[$i];
        $afterChunk = array_slice($update, $i + 1);

        //check if $number comes before all the numbers in the after chunk as specified in the rules
        foreach ($afterChunk as $after)
        {
            if (!in_array($after, $rules[$number]))
            {
                $incorrectNumber = $after;
                return false;
            }
        }
    }

    return true;
}
