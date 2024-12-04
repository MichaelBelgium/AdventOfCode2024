<?php

require 'general.php';

$file = fopen('input.txt', 'r');

$reports = [];

while(!feof($file))
{
    $line = fgets($file);

    $levels = explode(' ', $line);
    $levels = array_map('intval', $levels);

    $reports[] = $levels;
}

fclose($file);

$amountValid = 0;

foreach ($reports as $report)
{
    if (isSafe($report))
        $amountValid++;
}

echo "Amount of valid reports: $amountValid";
