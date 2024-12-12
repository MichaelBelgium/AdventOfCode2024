<?php

require 'Region.php';

$input = fopen('input.txt', 'r');

$garden = [];

while(!feof($input))
{
    $line = fgets($input);
    $garden[] = str_split(trim($line));
}

fclose($input);

$areas = $visited = [];
foreach ($garden as $y => $plots)
{
    foreach ($plots as $x => $plotLabel)
    {
        if (isset($visited[$y][$x]))
            continue;

        $region = new Region($plotLabel);
        $queue = [[$x, $y]];

        while (!empty($queue))
        {
            [$cx, $cy] = array_shift($queue);

            if (isset($visited[$cy][$cx]) || $garden[$cy][$cx] !== $plotLabel)
                continue;

            $visited[$cy][$cx] = true;
            $region->addPlot($cx, $cy);

            $directions = [
                [-1, 0], // left
                [1, 0], // right
                [0, -1], // up
                [0, 1] // down
            ];

            foreach ($directions as [$dx, $dy])
            {
                $nx = $cx + $dx;
                $ny = $cy + $dy;

                if (isset($garden[$ny][$nx]) && !isset($visited[$ny][$nx]))
                    $queue[] = [$nx, $ny];
            }
        }

        $areas[] = $region;
    }
}

$totalPrice = 0;
foreach ($areas as $region)
{
    $region->calculate();
    $totalPrice += $region->price;
}

echo "Total price: $totalPrice";