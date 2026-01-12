<?php
function inverse($x)
{
    if ($x === 0) {
        throw new Exception('ゼロによる除算です');
    }
    return 1 / $x;
}

try {
    echo inverse(5) . PHP_EOL;   // 0.2
    echo inverse(0) . PHP_EOL;   // ここで例外 -> 下の行には進まない
    echo "ここは実行されない" . PHP_EOL;
} catch (Exception $e) {
    echo "捕捉した例外: " . $e->getMessage() . PHP_EOL;
}

echo "Hello World" . PHP_EOL;    // 例外を捕まえていれば続行できる

 
//  try句の中のinverse(0)が実行されると,if ($x === 0)が真なため throwが起動する
//  throwが実行された時点で関数inverseの残り、try句の残りの処理は実行されなくなる
// throw new Exception('ゼロによる除算です');が実行されExceptionインスタンスが作られる
// 'ゼロによる除算です'はExceptionクラスのgetMessage内に渡されている
// スタックを巻き戻しながらcatch見つける
// catch (Exception $e)　$eはExceptionクラス型なので型一致する。よってこのcatchを実行する（例外補足）
// $e= new Exception のような状態
