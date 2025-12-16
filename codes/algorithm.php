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

$num3 = [1, 2, 3, 4, 5, 7, 9, 10, 13, 15, 19, 21, 23];
$head = 0;
$tail = count($num3) - 1;
$center = floor(($head + $tail) / 2);
function make_center($head, $tail)
{
    $center = floor(($head + $tail) / 2);
}

while (!($head < $tail)) {
    if ($choice_num < $num3[$center]) { //右側には存在しない tail更新
        $tail = $center - 1;
    } else { //右側に存在 head更新
        $head++;
    }
}



// if ($choice_num < $num3[$center]) {
// } elseif ($choice_num > $num3[$center]) {
//     $head++;
//     make_center($head, $tail);
// } else {
//     echo "{$choice_num}が存在しています。";
// }
