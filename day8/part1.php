<?php

$input = fopen('input.txt', 'r');

$map = [];

while (!feof($input))
{
    $line = fgets($input);
    $map[] = str_split(trim($line));
}
$antennas = [];

for ($x = 0; $x < count($map); $x++)
{
    for ($y = 0; $y < count($map[$x]); $y++)
    {
        $cell = $map[$x][$y];

        if ($cell == '.') continue;

        if (!array_key_exists($cell, $antennas))
            $antennas[$cell] = [];

        $antennas[$cell][] = (object)['x' => $x, 'y' => $y];
    }
}

$sum = 0;
foreach ($antennas as $antenna => $positions)
{
//    $strPositions = array_map(fn ($position) => ' [' . $position->x . ',' . $position->y . '] ', $positions);
//
//    echo "-------------------<br>";
//    echo "Antenna $antenna <br>";
//    echo "-------------------<br>";
//    echo "Positions: " . implode(' ', $strPositions) . '<br>';

    for($i = 0; $i < count($positions); $i++)
    {
        for ($j = count($positions) - 1; $j > $i; $j--)
        {
            $a = $positions[$i];
            $b = $positions[$j];

            $dx = $b->x - $a->x;
            $dy = $b->y - $a->y;

//            echo "Diff between antennas A ([$a->x, $a->y]) and B ([$b->x, $b->y]) = [$dx, $dy]<br/>";

            $antinodeA = (object)['x' => $a->x - $dx, 'y' => $a->y - $dy];
            $antinodeB = (object)['x' => $b->x + $dx, 'y' => $b->y + $dy];

//            echo "Antinode A: [$antinodeA->x, $antinodeA->y] <br>";
//            echo "Antinode B: [$antinodeB->x, $antinodeB->y] <br>";

            if (array_key_exists($antinodeA->x, $map) && array_key_exists($antinodeA->y, $map[$antinodeA->x]))
            {
                if ($map[$antinodeA->x][$antinodeA->y] != '#')
                {
                    $map[$antinodeA->x][$antinodeA->y] = '#';
                    $sum++;
                }
            }

            if (array_key_exists($antinodeB->x, $map) && array_key_exists($antinodeB->y, $map[$antinodeB->x]))
            {
                if ($map[$antinodeB->x][$antinodeB->y] != '#')
                {
                    $map[$antinodeB->x][$antinodeB->y] = '#';
                    $sum++;
                }
            }
        }
    }
}

echo "Sum: $sum <br>";