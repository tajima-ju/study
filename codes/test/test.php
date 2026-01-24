<?php
// $test_array = [0, 1, 2];

// $test_array[] = 3;
// print_r($test_array);
// echo "<br>";

// function array_add(int $add_num, array $add_array)
// {
//     $add_array[] = $add_num;
//     return $add_array;
// }

// $result_array = array_add(4, $test_array);
// print_r($result_array);
// echo "<br>";


// $test_array[] = $result_array;

// print_r($test_array);

$user_date_1 = [
    "sex" => "male",
    "id" => 1,
    "age" => 15,
    "country" => "japan"
];

$user_date_2 = [
    "sex" => "female",
    "id" => 2,
    "age" => 15,
    "country" => "america"
];

print_r(array_merge($user_date_1, $user_date_2));
//Array ( [sex] => female [id] => 2 [age] => 15 [country] => america ) 後ろのuserdate2に上書き
echo "<br>";

$user_date_3 = [];
array_push($user_date_3, $user_date_1);
array_push($user_date_3, $user_date_2);
print_r($user_date_3); //連想配列として$user_date3に格納


//可変関数
function add($a, $b)
{
    return $a + $b;
};

function sub($a, $b)
{
    return $a - $b;
};

$mode = "add";

echo $mode(1, 2); //3 modeがaddに置き換わり、function addが実行 文字列で関数を指定する



//無名関数
$add_clo = function ($a, $b) {  //変数の中に関数をいれる 名前はつけない
    return $a + $b;
};

echo $add_clo(2, 4); //6 変数として関数を呼び出す、変数として処理を持ち出せる

//アロー関数 無名関数を短く書く方法
$add_arr = fn($a, $b) => $a + $b;  //returnを=>に置き換える、fn表記
echo $add_arr(2, 5); //7
