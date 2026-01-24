<?php
//昇順にする
$base_array = [3, 2, 5, 4]; //0-3
$base_array_size = count($base_array); //4
$tmp_min_index = null;
$tmp = null;

for ($i = 0; $i < $base_array_size - 1; $i++) { //3回まで行う
    $tmp_min_index = $i; //先頭を暫定最小値にする
    for ($j = $i + 1; $j < $base_array_size; $j++) {
        if ($base_array[$tmp_min_index] > $base_array[$j]) {
            $tmp_min_index = $j;
        }
    }
    if ($i !== $tmp_min_index) {
        $tmp = $base_array[$i];
        $base_array[$i] = $base_array[$tmp_min_index];
        $base_array[$tmp_min_index] = $tmp;
    }
}
print_r($base_array);
