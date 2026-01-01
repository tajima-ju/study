<?php
$num = [13, 15, 1222, 19, 21, 46];
$max = 0;
//最初に最大値を格納する変数を確保
$max = $num[0];
//先頭を最大と仮定
for ($i = 1; $i < count($num); $i++) {
    if ($max <= $num[$i]) {
        $max = $num[$i];
    } else {;
    }
}
//配列の要素数の数だけくりかえす

echo "{$max}が最大です。";
//配列の最大値を探すアルゴリズム

$num2 = [12, 13, 23, 17, 19, 21, 4, 64];

$choice_num = 16;
$find_num = "";

for ($j = 0; $j < count($num2); $j++) {
    if ($choice_num === $num2[$j]) {
        $find_num = $choice_num;
    } else {;
    }
}
if ($find_num) {
    echo "{$find_num}は見つかりました。";
} else {
    echo "{$choice_num}は見つかりませんでした。";
}



//バイナリサーチ
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




$first_array = range(1, 100);
$sieve_array = [];
$Sieve_of_eratosthenes = [];
function make_sieve_array($sieve_num)
{
    $base_num = $sieve_num;
    $i = 1;
    while ($base_num <= 100) {
        $sieve_array[] = $base_num;
        $i++;
        $base_num *= $i;
    }
    return $sieve_array;
}
print_r(make_sieve_array(2));


//ハッシュ関数
$base_array = [11, 12, 13, 72, 16]; //添え字は0-4
$hash_array = [];


$hash_array = array_fill(0, 10, 0); //test_array 要素数10の中身全て数値の0 添え字は0-9

$base_array_size = count($base_array); //5
$hash_array_size = count($hash_array); //10




for ($i = 0; $i < $base_array_size; $i++) {
    $hash_num = $base_array[$i] % $hash_array_size;
    if ($hash_array[$hash_num] === 0) { //未格納なら
        $hash_array[$hash_num] = $base_array[$i]; //格納
    } else { //格納済みなら
        $j = 1;
        $hash_num = ($hash_num + $j) % $hash_array_size;
        $base_hash_num = $hash_num;

        while ($hash_array[$hash_num] !== 0) { //格納済みなのか？
            $j++;
            if ($j > $hash_array_size - 1) {
                echo "格納できません。";
                break;
            }
            $hash_num = ($base_hash_num + $j) % $hash_array_size;
        }

        $hash_array[$hash_num] = $base_array[$i];
    }
}



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



//クイックソート
function quick_sort($base_array)
{
    if (count($base_array) < 2)
        return $base_array; //要素が0になるまで繰り返す

    $left_array = [];
    $right_array = [];


    $head_num = array_shift($base_array); //先頭要素を取り出す 

    foreach ($base_array as $num) {
        if ($num <=  $head_num) { //先頭よりも小さい場合
            $left_array[] = $num;
        } else {
            $right_array[] = $num;
        }
    }
    $left = quick_sort($left_array);
    $right = quick_sort($right_array);

    return $new_array = array_merge($left, [$head_num], $right);
}

$test_array = [2, 5, 6, 1, 9, 7, 5, 6, 2];

print_r(quick_sort($test_array));


//  $left = quick_sort($left_array);
//  これはfunction quick_sort($base_array)に渡される、しかし
//  $base_arrayが$left_arrayに置き換わるのではなく、
//  $left_arrayの中身が$base_arrayに渡される
// 関数内に$left_arrayが引数として入るのではなく
// $left_arrayの中身が入っている$base_array


//エラトステネスの篩（修正版）
//素数、合成数判定を0，1で判定し、配列$prime_numに取り出す

$base_array = array_fill(0, 101, 1);

for ($i = 2; $i * $i <= 100; $i++) { //素数判定を行う
    if (!$base_array[$i]) {
        continue;
    } else {
        for ($j = 2; $j <= floor(100 / $i); $j++) { //判定された素数の倍数を取り除いていく
            $base_array[$i * $j] = 0;
        }
    }
}
$prime_num = [];

for ($k = 2; $k <= 100; $k++) {
    if ($base_array[$k]) {
        $prime_num[] = $k;
    } else {
        continue;
    }
}


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