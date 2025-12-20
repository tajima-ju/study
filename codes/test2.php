<?php

$tail_num = rand(1, 50);
$num = range(0, $tail_num); //0から最大50までの配列


$num2 = 0;
for ($i = 0; $i < 100; $i++) { //1+2+3+4+...
    $num2 += $i;
    if ($num2 > 100) { //最終的に100を超えたらbreakでfor文を停止
        break;
    }
}
echo $num2;
echo "<br>";

$num3 = 0;
for ($j = 1; $j < 10; $j++) {
    if (($j % 2) !== 0) {
        continue;
    } else {
        $num3 += $j;
    }
}
echo $num3;
echo "<br>";

//指定した値の階乗を計算する関数
// まず停止条件を書く
// 次に関数が小さくなっているか確認

function factorial(int $n): int  //引数int、戻り値int指定
{
    if ($n === 0) {  //終了条件
        return 1;
    }
    return $n * factorial($n - 1); // 引数-1で減少していっている
}
echo factorial(5);
echo "<br>";





// function listFilesRecursive(string $dir): array
// {
//     $result = [];
//     $items = @scandir($dir); //ディレクトリ直下のみが配列として格納、配下は無理！
//     if ($items === false) {
//         return $result;
//     }

//     foreach ($items as $item) { //一つ取り出して$itemに格納
//         if ($item === '.' || $item === '..') continue;

//         $path = $dir . DIRECTORY_SEPARATOR . $item; // 指定したパスに /と、foreachで取り出したパスを結合　　
//         // $pathは$dir(パス文字列)に/と$item(文字列)を結合した文字列

//         if (is_dir($path)) {
//             // foreachで取り出し、結合した最後がフォルダで終わる文字列なら「中身を再帰で取る」
//             $result = array_merge($result, listFilesRecursive($path));
//         } else {
//             // ファイルなら結果に追加
//             $result[] = $path;
//         }
//     }

//     return $result;
// }

// $files = listFilesRecursive(__DIR__);
// print_r($files);


// function listflie_get(string $dir2): array
// {
//     $result = [];
//     $items = @scandir($dir2);
//     if ($items === false) {
//         return $result;
//     }
//     foreach ($items as $item) {
//         if ($item === '..' || $item === '.') {
//             continue;
//         }
//         $path = $dir2 . DIRECTORY_SEPARATOR . $item;

//         if (is_dir($path)) {
//             $child = listflie_get($path);
//             $result = array_merge($result, $child);
//         } else {
//             $result[] = $path;
//         }
//     }

//     return $result;
// }
// $files = listflie_get(__DIR__);
// print_r($files);


function myGen() //returnのようなもの 呼び出したらmyGenの戻り値としてaaaを返す、２回目の呼び出しはbbbをかえす
{
    echo "開始";
    echo "<br>";

    yield "aaa"; //yieldを読んだ時点で関数が止まる myGenの戻り値としてaaaが返る
    echo "<br>";

    yield "bbb";
    echo "<br>";

    yield "ccc";
    echo "<br>";

    echo "終了";
}
//echo myGen(); エラー Generator は「値の列を順に取り出せる仕組み」であり、直接 echo $myGen(); はできません。

$generater = myGen();

// foreach ($generater as $value) {
//     echo $value;
// }
// 開始
// aaa
// bbb
// ccc
// 終了
//ジェネレータを使うことで配列を作らなくてもいい　メモリ節約となる、途中で止められる。
//ジェネレータは一度しか使えない

// foreach ($generater as $value) {
//     echo $value;
//     if ($value === "bbb") {
//         break;
//     }
// }
//bbbを見つけたら処理終了

foreach ($generater as $value) {
    if ($value === "bbb") {
        continue;
    }
    echo $value;
}
