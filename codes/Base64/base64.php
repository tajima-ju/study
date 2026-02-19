<?php
$path = __DIR__ . '\Base64\base64_table.json';

$json_string = file_get_contents($path);


$json_data = json_decode($json_string, true);

$character = "h";

$character_size = strlen($character);

$split_chara_data = str_split($character); //1文字ずつ分解、配列化

$date_size = count($split_chara_data) - 1;

for ($i = 0; $i <= $date_size; $i++) { //2進数に変換、配列化
    $chara_dec_data[] = unpack("C", $split_chara_data[$i]);
}
for ($i = 0; $i <= $date_size; $i++) { //キーを0からに整形
    $normalized_chara_dec_data[] = $chara_dec_data[$i]["1"];
}

for ($i = 0; $i <= $date_size; $i++) {
    if ($normalized_chara_dec_data[$i] < 128) {
        $bin = str_pad(decbin($normalized_chara_dec_data[$i]), 8, "0", STR_PAD_LEFT); //左に0を詰める
        $chara_bin_data[] = $bin;
        continue;
    }
    $bin = decbin($normalized_chara_dec_data[$i]);
    $chara_bin_data[] = $bin;
}



$seq_chara_bin = "";
for ($i = 0; $i <= $date_size; $i++) { //一つの文字列に連結
    $seq_chara_bin .= $chara_bin_data[$i];
}

$divide_bits = str_split($seq_chara_bin, 6);
$divide_bits_size = count($divide_bits);

if ($character_size % 3 === 1) { //6文字ずつ分解、足りない箇所に0を補い配列化
    $divide_bits[$divide_bits_size - 1] .= "0000";
} elseif ($character_size % 3 === 2) {
    $divide_bits[$divide_bits_size - 1] .= "00";
}

$base64_char = "";
for ($i = 0; $i < $divide_bits_size; $i++) { //base64のビット列と合致した文字列を取り出す
    if (isset($json_data["standard"]["binary_to_char"][$divide_bits[$i]])) {
        $base64_char .= $json_data["standard"]["binary_to_char"][$divide_bits[$i]];
    }
}

$base64_char_size = strlen($base64_char); //4文字ずつ区切り足りない箇所に=を補う
if ($base64_char_size % 4 === 1) {
    $base64_char .= '===';
} elseif ($base64_char_size % 4 === 2) {
    $base64_char .= '==';
} elseif ($base64_char_size % 4 === 3) {
    $base64_char .= '=';
}

echo $base64_char;
