<?php

$user_list = ["田中", "男", 12];

echo $user_list[0]; //田中
echo "<br>";

$user_list[] = "イケメン"; //配列の最後にイケメンを追加

echo $user_list[3]; //イケメンと出力
echo "<br>";

echo count($user_list); //4 配列の要素数を出力
echo "<br>";




for ($i = 0; $i < count($user_list); $i++) {
    $get_array_number = $i + 1;
    echo "配列の{$get_array_number}番目の要素は{$user_list[$i]}となっています。";
    echo "<br>";
}
echo "<br>";
//配列の1番目の要素は田中となっています。を要素の数だけ繰り返す
//スマートに書くなら変数定義せず、
//echo "配列の".($i +1)."番目の要素は{$user_list[$i]}となっています。";
//余談 for文はスコープを作らない


$dogtype = ["shiba", "tiwawa", "pagu", "pome"];
array_splice($dogtype, 1);
//配列dogtypeの添え字１以降を削除

//echo $dogtype; このまま取り出すとエラー発生！配列はそのまま出力すると型変換される
var_dump($dogtype); //0 => string 'shiba' (length=5)


$colors = "red-green-blue-black-white";

$color_list = explode("-", $colors, 4); //文字列→配列 要素数は4つまで

print_r($color_list); //Array ( [0] => red [1] => green [2] => blue [3] => black-white )
echo "<br>";

$new_color = implode(",", $color_list); //配列→文字列
echo $new_color; //red,green,blue,black-white
echo "<br>";

$place_date = "札幌、大阪、名古屋、東京、鹿児島、名古屋";
$place_list =  explode("、", $place_date);
$new_place_list = array_unique($place_list); //重複削除
print_r($new_place_list); //Array ( [0] => 札幌 [1] => 大阪 [2] => 名古屋 [3] => 東京 [4] => 鹿児島 )
echo "<br>";


if (is_array($new_place_list)) {
    echo "これ配列";
} else {
    echo "配列ちゃう！";
}
echo "<br>";

$custmer_list = [
    ["id" => 1, "name" => "吉田"],
    ["id" => 2, "name" => "松本"],
    ["id" => 3, "name" => "菊池"],
];

if (is_array($custmer_list)) {
    $custmer_name_list = array_column($custmer_list, "name");
    print_r($custmer_name_list);
} else {
    echo "配列じゃないから無理！";
}
//Array ( [0] => 吉田 [1] => 松本 [2] => 菊池 ) キー名nameの 値を取り出し、配列化
echo "<br>";

$custmer_key_list = array_keys($custmer_list[0]);
print_r($custmer_key_list); // 配列のキー名を取り出し配列化 Array ( [0] => id [1] => name ) 
echo "<br>";

$number_list1 = [1, 2, 3, 4, 5];
$number_list2 = [1, 3, 5];

$diff_number_list = array_diff($number_list1, $number_list2);
print_r($diff_number_list); //配列同士の差分を配列化 Array ( [1] => 2 [3] => 4 )

$sum = array_sum($diff_number_list);
echo $sum; //6 配列内を合計
echo "<br>";

$number_list3 = array_merge($number_list1, $diff_number_list);
print_r($number_list3); //Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 2 [6] => 4 ) [1,2,3,4,5,2,4]
echo "<br>"; // 配列同士を結合

$number_list4 = array_unique($number_list3);
print_r($number_list4); //重複を削除、重なりを消すだけ
