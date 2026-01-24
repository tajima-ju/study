<?php

$graph = [
    'A' => ['B', 'C'],
    'B' => ['D', 'E'],
    'C' => ['F'],
    'D' => [],
    'E' => ['F'],
    'F' => [],
];
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
