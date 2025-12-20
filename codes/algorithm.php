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
$sieve_num = 1;
function make_sieve_array($sieve_num)
{
    while ($sieve_num <= 100) {
        $sieve_array = [] = $sieve_num;
        $sieve_num = $sieve_num * 2;
    }
    return $sieve_array;
}
