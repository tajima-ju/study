<?php
//二分探索法
$array = [2, 4, 7, 8, 13, 46];


$low_index = 0;
$high_index = count($array) - 1;
$guess_num = 6; //探す数字

$found_flag = false;

while ($low_index <= $high_index) {
    $mid_index = floor(($low_index + $high_index) / 2);
    $mid_num = $array[$mid_index];
    if ($mid_num === $guess_num) {
        $found_flag = true;
        break;
    } elseif ($mid_num > $guess_num) {
        $high_index = $mid_index - 1;
    } else {
        $low_index = $mid_index + 1;
    }
}
echo $found_flag ? "見つかりました" : "見つかりませんでした"; //三項演算子 ? 条件 true時:false時
