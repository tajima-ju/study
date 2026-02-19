<?php
$path = __DIR__ . '\base64_table.json';

$json_string = file_get_contents($path);

$json_data = json_decode($json_string, true);

$character = "舞波歩";

$character_dec_data = unpack("C*", $character); //文字を8bit整数値として配列化
$character_dec_data_size = count($character_dec_data); //配列の要素数

$character_bin = "";
foreach ($character_dec_data as $key => $value) { //数値を2進数に変換、連結
    $bin = decbin($value);

    if (strlen($bin) !== 8) {
        $bin = str_pad($bin, 8, "0", STR_PAD_LEFT);
    }
    $character_bin .= $bin;
}
$character_bin_size = strlen($character_bin); //2進数の長さ
$character_bin_data = str_split($character_bin, 6); //6文字ずつに分解、配列化
$character_bin_data_last_index_num = count($character_bin_data) - 1; //最後の添え字番号

if ($character_bin_size % 6 === 2) { //6文字区切りで足りない0を補う
    $character_bin_data[$character_bin_data_last_index_num] .= '0000';
} elseif ($character_bin_size % 6 === 4) {
    $character_bin_data[$character_bin_data_last_index_num] .= '00';
}

$character_bin_data_size = count($character_bin_data);

$base64_char = "";
for ($i = 0; $i < $character_bin_data_size; $i++) { //jsonテーブルから合致する文字をとってくる
    $base64_char .= $json_data["standard"]["binary_to_char"][$character_bin_data[$i]];
}

$base64_chara_size = strlen($base64_char);


$mod = $base64_chara_size % 4;
if ($mod === 2) { //4文字区切りで足りない箇所を=で補う
    $base64_char .= '==';
} elseif ($mod === 3) {
    $base64_char .= '=';
}




// var_dump($character_bin_data);
var_dump($base64_char);
