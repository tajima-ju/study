<?php
$custmer_list = [
    ["id" => 1, "name" => "吉田"],
    ["id" => 2, "name" => "松本"],
    ["id" => 3, "name" => "菊池"],
];

$custmer_key_list = array_keys($custmer_list);
print_r($custmer_key_list);//

//0 => ["id"=>1,"name"=>"吉田"]　こうなっているので
//これだと外側配列のキーを取得してしまう Array ( [0] => 0 [1] => 1 [2] => 2 )
