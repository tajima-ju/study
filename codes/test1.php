<?php
$num_list = [2, 5, 7, 9, 12, 18, 23, 26];
$target = 9;
$head = 0;
$tail = count($num_list) - 1;
function make_c($head, $tail)
{
    $center = floor(($head + $tail) / 2);
    return $center;
}
$center = make_c($head, $tail);

while ($head <= $tail) {
    $center = make_c($head, $tail);
    if ($num_list[$center] < $target) {
        $head = $center + 1;
    } elseif ($num_list[$center] > $target) {
        $tail = $center - 1;
    } elseif ($num_list[$center] === $target) {
        echo "{$target}は存在しています";
        exit;
    }
}
echo "{$target}は存在してません";
