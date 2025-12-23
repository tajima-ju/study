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
