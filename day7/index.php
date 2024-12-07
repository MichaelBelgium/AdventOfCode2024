<?php
$input = fopen('input.txt', 'r');

$equations = [];

while (!feof($input)) {
    $line = trim(fgets($input));

    [$testValue, $numbers] = explode(': ', $line);
    $numbers = explode(' ', $numbers);

    $equations[] = (object)[
        'testValue' => (int)$testValue,
        'numbers' => array_map('intval', $numbers)
    ];
}

fclose($input);

$sum = 0;
foreach ($equations as $equation)
{
//    echo 'Test value: ' . $equation->testValue . '<br/><br/>';

    if (calculate($equation->testValue, $equation->numbers, null))
        $sum += $equation->testValue;
}
echo "Sum: $sum<br/>";

function calculate(int $result, array $values, ?int $a = null): bool
{
//    echo '-------------------<br/>';
//    echo 'Values: ' . implode(' ', $values) . '<br/>';

    if ($a === null)
        $a = array_shift($values);

//    echo 'A: ' . $a . '<br/>';

    if ($a > $result)
        return false;

    if (empty($values))
        return $a == $result;

    $b = array_shift($values);

//    echo 'B: ' . $b . '<br/><br/>';
//
//    echo 'Sum: ' . ($a + $b) . ' (new A)<br/>';
//    echo 'Multiply: ' . ($a * $b) . ' (new A)<br/>';
//    echo 'Concat: ' . ($a . $b) . ' (new A)<br/><br/>';

    $success = calculate($result, $values, $a + $b) || calculate($result, $values, $a * $b);

    if(isset($_GET['part2']))
        return $success || calculate($result, $values, $a . $b);

    return $success;
}