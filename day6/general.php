<?php

enum Direction {
    case UP;
    case RIGHT;
    case DOWN;
    case LEFT;
}

$map = fopen('input.txt', 'r');

$mapGrid = [];
$guard = null;

while(!feof($map))
{
    $line = trim(fgets($map));
    $lineArr = str_split($line);

    if($y = array_search('^', $lineArr))
    {
        $x = count($mapGrid);
        $guard = (object)['x' => $x, 'y' => $y];
    }

    $mapGrid[] = $lineArr;
}

fclose($map);

echo 'The guard starts at ' . $guard->x . ', ' . $guard->y . '<br/>';