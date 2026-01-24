<?php
//バブルソート
$bubble_array = [2, 3, 4, 5, 1];

$bubble_array_size = count($bubble_array); //5

$tmp = null;
for ($j = 1; $j <= $bubble_array_size - 1; $j++) {
    for ($i = $bubble_array_size - $j; $i > 0; $i--) { //$iは4から1まで1ずつ減っていく
        if ($bubble_array[$i - 1] > $bubble_array[$i]) { //昇順じゃなかったら入れ替え 5>1なの入れ替え
            $tmp = $bubble_array[$i - 1];
            $bubble_array[$i - 1] = $bubble_array[$i];
            $bubble_array[$i] = $tmp;
        }
    }
}
print_r($bubble_array);
