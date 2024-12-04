<?php

$input = fopen('input.txt', 'r');

$grid = [];

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
        //has to be an X - positions in the grid should exist
        if (isset(
            $grid[$i][$y + 2], //top right
            $grid[$i + 1][$y + 1], //middle
            $grid[$i + 2][$y], //bottom left
            $grid[$i + 2][$y + 2] //bottom right
        )) {
            //always start from upper left corner, either starts with an M or an S (if reversed)
            if ($grid[$i][$y] == 'M')
            {
                /**
                 * M.S
                 * .A.
                 * M.S
                 */
                if (
                    $grid[$i][$y + 2] == 'S' &&
                    $grid[$i + 1][$y + 1] == 'A' &&
                    $grid[$i + 2][$y] == 'M' &&
                    $grid[$i + 2][$y + 2] == 'S'
                ) {
//                    echo "Found X-MAS on [$i,$y]<br/>";
                    $amountFound++;
                }

                /**
                 * M.M
                 * .A.
                 * S.S
                 */
                if (
                    $grid[$i][$y + 2] == 'M' &&
                    $grid[$i + 1][$y + 1] == 'A' &&
                    $grid[$i + 2][$y] == 'S' &&
                    $grid[$i + 2][$y + 2] == 'S'
                ) {
//                    echo "Found X-MAS on [$i,$y]<br/>";
                    $amountFound++;
                }
            }
            else if ($grid[$i][$y] == 'S')
            {
                /**
                 * S.S
                 * .A.
                 * M.M
                 */

                if (
                    $grid[$i][$y + 2] == 'S' &&
                    $grid[$i + 1][$y + 1] == 'A' &&
                    $grid[$i + 2][$y] == 'M' &&
                    $grid[$i + 2][$y + 2] == 'M'
                ) {
//                    echo "Found SAM-X on [$i,$y]<br/>";
                    $amountFound++;
                }

                /**
                 * S.M
                 * .A.
                 * S.M
                 */
                if (
                    $grid[$i][$y + 2] == 'M' &&
                    $grid[$i + 1][$y + 1] == 'A' &&
                    $grid[$i + 2][$y] == 'S' &&
                    $grid[$i + 2][$y + 2] == 'M'
                ) {
//                    echo "Found SAM-X on [$i,$y]<br/>";
                    $amountFound++;
                }
            }
        }
    }
}

echo "Amount found: $amountFound";