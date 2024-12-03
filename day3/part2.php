<?php

$content = file_get_contents('input.txt');

preg_match_all('/mul\((\d+),(\d+)\)|do\(\)|don\'t\(\)/', $content, $matches);

$instructions = $matches[0];

$sum = 0;
$skip = false;

for($i = 0; $i < count($instructions); $i++)
{
    $instruction = substr($instructions[$i], 0, strpos($instructions[$i], '('));

    if ($instruction == 'do')
    {
        $skip = false;
        continue;
    }
    else if ($instruction == 'don\'t')
    {
        $skip = true;
        continue;
    }

    if ($skip)
        continue;

    $multiplication = str_replace(['mul(', ')'], '', $instructions[$i]);
    $values = explode(',', $multiplication);;

    $sum += $values[0] * $values[1];
}

echo "Sum of all multiplications: $sum";
