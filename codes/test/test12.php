<?php
// //エラトステネスの篩
// $base_array = array_fill(0, 101, 1);

// for ($i = 2; $i * $i <= 100; $i++) { //素数判定を行う
//     if (!$base_array[$i]) {
//         continue;
//     } else {
//         for ($j = $i * $i; $j <= floor(100 / $i); $j++) { //判定された素数の倍数を取り除いていく
//             $base_array[$i * $j] = 0;
//         }
//     }
// }
// $prime_num = [];

// for ($k = 2; $k <= 100; $k++) {
//     if ($base_array[$k]) {
//         $prime_num[] = $k;
//     } else {
//         continue;
//     }
// }
// print_r($prime_num);
echo 5 % 3;
