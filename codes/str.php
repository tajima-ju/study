<?php
$chara = "ﾓｶちゃん";

echo mb_strlen($chara); // Multi Bite String Length  5 文字の長さ
echo "<br>";

echo mb_strwidth($chara); // 8 半角1全角2 半角全角を分ける
echo "<br>";



$chara2 = "田島家のモカちゃん";

echo mb_substr($chara2, 4, 2); //モカ 4番目から２文字    文字列の～番目から～個文字を取り出す
echo mb_substr($chara2, -5, 2); //モカ 後ろから5番目から２文字     上の逆から
echo "<br>";

echo mb_strstr($chara2, 'モ'); //モカちゃん 'モ'が見つかった後ろまで 
echo mb_strstr($chara2, 'ち', true); //田島家のモカ 引数３つ目にtrue指定で'ち'より前を切り取る
echo "<br>";

echo str_replace('モカ', 'ラテ', $chara2, $cnt); //田島家のラテちゃん
echo $cnt; //1
echo "<br>";

$blank_chara = "モ カ ち ゃ ん";
echo str_replace(' ', '', $blank_chara); //モカちゃん 半角空白を空文字に置き換え
echo "<br>";


$chara3 = "１モカ２モカ３モカ４モカ";

var_dump(mb_strpos($chara3, "ラテ")); //false chara3にラテが存在するか しないのでfalse
echo "<br>";

if (mb_strpos($chara2, 'ラテ')) //chara2(田島家のモカちゃん)にラテは存在していないのでfalseを返す
    echo "ラテが存在してる";
else {
    echo "ラテが存在していない";
}
echo "<br>";


echo mb_strpos($chara3, 'モカ', 3); //4  先頭を0として 3番目からスタート、モカが現れた位置を返す
echo "<br>";

$chara4 = " \nモカちゃん\0";
echo trim($chara4);
