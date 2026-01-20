<?php

declare(strict_types=1);
spl_autoload_register(function (string $class): void { //$charaはEncoding\ファイル名
    $base_dir = __DIR__ . "/../src/";
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});
//spl_autoload_registerは使用できないクラスを使ったときに実行されるエラーハンドラ
//$classには　名前空間/クラス名　でわたってくる
//パスとして使うならバックスラッシュをスラッシュ変換する必要がある