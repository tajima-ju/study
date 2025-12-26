<?php
$base_array = [];
for ($i = 0; $i < 5; $i++) {
    $base_array[] = $i;
}
echo $i; //5  インクリメントのタイミングは

print_r($base_array); //0-4までの配列

$base_array2 = [];

for ($j = 0; $j < 100; $j++) {

    if ($j > 5) {
        break;
    } else {
        $base_array2[] = $j;
    }
}
echo $j; //6 $j=6になったら、breakで強制終了。for文抜けてもインクリメントされない。
print_r($base_array2);
