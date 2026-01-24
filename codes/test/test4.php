<?php
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
print_r($hash_array);

// for ($i = 0; $i < 5; $i++) {
//     $hash_num = $base_array[$i] % $hash_array_size;
//     if ($hash_array[$hash_num] === 0) { //未格納なら
//         $hash_array[$hash_num] = $base_array[$i]; //格納
//     } else { //格納済みなら
//         $new_hash_num = ($hash_num + 1) % 10; //次に進んでくれ
//         if ($hash_array[$new_hash_num] === 0) { //進んだ先が未格納なら
//             $hash_array[$new_hash_num] = $base_array[$i]; //格納
//         } else {
//         }
//     }
// }