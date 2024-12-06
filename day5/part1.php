<?php

require 'general.php';

$sum = 0;
foreach ($updates as $update)
{
    if (isValidUpdate($update))
        $sum += $update[count($update) / 2];
}

echo "Sum: $sum";
