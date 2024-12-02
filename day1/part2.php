<?php

$inputfile = fopen('input2.txt', 'r');

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

$sum = 0;

for ($i = 0; $i < count($columns->a); $i++)
{
    $filtered = array_filter($columns->b, fn ($value) => $value == $columns->a[$i]);

    $similarityScore = $columns->a[$i] * count($filtered);

    $sum += $similarityScore;
}

echo 'Total: ' . $sum;