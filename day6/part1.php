<?php

require 'general.php';

$direction = Direction::UP;

$positionChanged = 1;

while (true)
{
    $nextX = match($direction)
    {
        Direction::UP => $guard->x - 1,
        Direction::DOWN => $guard->x + 1,
        default => $guard->x,
    };

    $nextY = match($direction)
    {
        Direction::LEFT => $guard->y - 1,
        Direction::RIGHT => $guard->y + 1,
        default => $guard->y,
    };

    if(!array_key_exists($nextX, $mapGrid) || !array_key_exists($nextY, $mapGrid[$nextX]))
    {
        //guard is at the edge of the map
        break;
    }

    if ($mapGrid[$nextX][$nextY] == '#')
    {
        $direction = match($direction)
        {
            Direction::UP => Direction::RIGHT,
            Direction::RIGHT => Direction::DOWN,
            Direction::DOWN => Direction::LEFT,
            Direction::LEFT => Direction::UP,
        };
    }
    else
    {
        if ($mapGrid[$nextX][$nextY] != 'X')
        {
            $mapGrid[$nextX][$nextY] = 'X';
            $positionChanged++;
        }

        $guard->y = $nextY;
        $guard->x = $nextX;
    }
}

echo "The guard ended up at $guard->x, $guard->y<br/>";
echo "The guard has changed position $positionChanged times";
