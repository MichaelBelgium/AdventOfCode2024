<?php

$input = fopen('input.txt', 'r');

$grid = [];
$wordSearch = 'XMAS';

while(!feof($input))
{
    $line = fgets($input);

    $grid[] = str_split(trim($line));
}

fclose($input);

$amountFound = 0;

for ($i = 0; $i < count($grid); $i++)
{
    for ($y = 0; $y < count($grid[$i]); $y++)
    {
        //don't start looking if it's not the first letter
        if ($grid[$i][$y] != $wordSearch[0])
            continue;

        //horizontal ➡️
        if (isset($grid[$i][$y + strlen($wordSearch) - 1]))
        {
            $word = array_slice($grid[$i], $y, strlen($wordSearch));

            if (implode('', $word) == $wordSearch)
            {
//                echo "Found horizontal on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //horizontal ⬅️
        if (isset($grid[$i][$y - strlen($wordSearch) + 1]))
        {
            $word = array_slice($grid[$i], $y - strlen($wordSearch) + 1, strlen($wordSearch));
            $word = array_reverse($word);

            if (implode('', $word) == $wordSearch)
            {
//                echo "Found horizontal reverse on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //vertical ⬇️
        if (isset($grid[$i + strlen($wordSearch) - 1][$y]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i + $x][$y];

            if ($word == $wordSearch)
            {
//                echo "Found vertical on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //vertical ⬆️
        if (isset($grid[$i - strlen($wordSearch) + 1][$y]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i - $x][$y];

            if ($word == $wordSearch)
            {
//                echo "Found vertical reverse on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //diagonal ↘️
        if (isset($grid[$i + strlen($wordSearch) - 1][$y + strlen($wordSearch) - 1]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i + $x][$y + $x];

            if ($word == $wordSearch)
            {
//                echo "Found diagonal on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //diagonal ↗️
        if (isset($grid[$i - strlen($wordSearch) + 1][$y + strlen($wordSearch) - 1]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i - $x][$y + $x];

            if ($word == $wordSearch)
            {
//                echo "Found diagonal on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //diagonal ↙️
        if (isset($grid[$i + strlen($wordSearch) - 1][$y - strlen($wordSearch) + 1]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i + $x][$y - $x];

            if ($word == $wordSearch)
            {
//                echo "Found diagonal on [$i,$y]<br/>";
                $amountFound++;
            }
        }

        //diagonal ↖️
        if (isset($grid[$i - strlen($wordSearch) + 1][$y - strlen($wordSearch) + 1]))
        {
            $word = '';

            for ($x = 0; $x < strlen($wordSearch); $x++)
                $word .= $grid[$i - $x][$y - $x];

            if ($word == $wordSearch)
            {
//                echo "Found diagonal on [$i,$y]<br/>";
                $amountFound++;
            }
        }
    }
}

echo "Amount found: $amountFound";