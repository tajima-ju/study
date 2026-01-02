<?php
var_dump(class_exists('SplQueue')); // true
//Standard PHP Library (SPL)    phpではクラスとしてすでに提供されている機能がある
//SplQueueはキューを実装しているクラス

$queue = new SplQueue(); //インスタンス生成、メソッドを使える状態にする

$queue->enqueue('A');
$queue->enqueue('B');
$queue->enqueue('C');
$queue->enqueue('D');

while (!$queue->isEmpty()) { //キューが空になるまで
    echo $queue->dequeue(); //ABCD
}
//SplQueueクラスにはisEmptyメソッドは存在していない。isEmptyメソッドは親から継承して使っている


//幅優先探索法
function BFS($array, $value)
{

    $visited_flag = []; //閉路による無限ループ防止
    $order = [];

    $queue = new SplQueue();

    $queue->enqueue($value);
    $visited_flag[$value] = true;

    while (!($queue->isEmpty())) { //キューに入っている間
        $node = $queue->dequeue(); //キューの先頭$nodeに格納
        $order[] = $node;

        foreach ($array[$node] ?? [] as $next) { //$array[$node]がnullの場合空配列、それ以外$nextに格納していく 
            if (!isset($visited_flag[$next])) { //flagのキーが存在しているなら
                $queue->enqueue($next);
                $visited_flag[$next] = true;
            }
        }
    }
    return $order;
}

print_r(BFS($graph, 'A'));
