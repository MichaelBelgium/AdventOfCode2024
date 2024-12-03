<?php

$content = file_get_contents('input.txt');

preg_match_all('/mul\((\d+),(\d+)\)/', $content, $matches);

$multiplications = $matches[0];

$sum = 0;

foreach ($multiplications as $multiplication)
{
    $multiplication = str_replace(['mul(', ')'], '', $multiplication);
    $values = explode(',', $multiplication);;

    $sum += $values[0] * $values[1];
}

echo "Sum of all multiplications: $sum";