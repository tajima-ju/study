<?php
//挿入ソート
$base_array = [9, 5, 6, 1, 2, 8, 7, 9];
$tmp_num = null;
$base_array_size = count($base_array);

for ($i = 1; $i < $base_array_size; $i++) {
    $tmp_num = $base_array[$i];
    for ($j = $i - 1; $j >= 0; $j--) {
        if ($tmp_num <= ($base_array[$j])) {
            $base_array[$j + 1] = $base_array[$j];
        } else {
            break;
        }
    }
    $base_array[$j + 1] = $tmp_num;
    //$jは最後-1になる。条件式はfalseになるので実行されないが$jの値は最後更新されたままになる
    //breakで抜けた場合、強制終了なのでカウンター変数の更新は行われない
    //条件がfalseで抜けた場合、はカウンター変数の更新は既に行われている
}
print_r($base_array);
