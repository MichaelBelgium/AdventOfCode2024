<?php

$inputfile = fopen('input1.txt', 'r');

$columns = (object)[
    'a' => [],
    'b' => [],
];

while (!feof($inputfile))
{
    $line = fgets($inputfile);

    $input = explode('   ', $line);
    $input = array_map('intval', $input);

    $columns->a[] = $input[0];
    $columns->b[] = $input[1];
}

fclose($inputfile);

sort($columns->a);
sort($columns->b);

$sum = 0;

for ($i = 0; $i < count($columns->a); $i++)
{
    $diff = $columns->a[$i] - $columns->b[$i];

    if ($diff < 0)
        $diff = abs($diff);

    $sum += $diff;
}

echo 'Total: ' . $sum;