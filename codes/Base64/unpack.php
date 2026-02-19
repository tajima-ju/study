<?php
//unpack(string $format, string $string, int $offset = 0): array|false
//$string が「バイナリ文字列（= バイト列）」として扱えるか確認 
//$offset（第3引数、省略可）が指定されていれば、読み取り開始位置を $offset バイト目に設定（デフォルト0）
//$formatを左から解析していく

$chara = "舞浜歩";

$result = unpack('C*', $chara); //入力された文字バイト列として扱い、8bitの整数値にして配列で返す

var_dump($result);
