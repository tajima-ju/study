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


$graph = [
    'A' => ['B', 'C'],
    'B' => ['D', 'E'],
    'C' => ['F'],
    'D' => [],
    'E' => ['F'],
    'F' => [],
];
