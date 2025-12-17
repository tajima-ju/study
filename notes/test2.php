<?php

$tail_num = rand(1, 50);
$num = range(0, $tail_num); //0から最大50までの配列


$num2 = 0;
for ($i = 0; $i < 100; $i++) { //1+2+3+4+...
    $num2 += $i;
    if ($num2 > 100) { //最終的に100を超えたらbreakでfor文を停止
        break;
    }
}
echo $num2;
echo "<br>";

$num3 = 0;
for ($j = 1; $j < 10; $j++) {
    if (($j % 2) !== 0) {
        continue;
    } else {
        $num3 += $j;
    }
}
echo $num3;
