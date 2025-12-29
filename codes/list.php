<?php

declare(strict_types=1);
//単方向リスト
//配列を用いて疑似的に再現
$node3 = ['value' => 'C', 'next' => null];
$node2 = ['value' => 'B', 'next' => $node3];
$node1 = ['value' => 'A', 'next' => $node2];
$head =  ['next' => $node1];

for ($current = $head['next']; $current !== null; $current = $current = $current['next']) {
    echo $current['value'];
}

//$current =$head['next]によって$current=$node1 
// => $current=['value' => 'A', 'next' => $node2]となる
//$current['value']が実行されAが出力されると
//$current  = $current['next']で $current=$node2となり、更新される




final class Node
{
    public mixed $value;
    public ?Node $next = null;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }
}

final class SinglyLinkedList
{
    private ?Node $head = null;

    public function pushFront(mixed $value): void
    {
        $node = new Node($value);
        $node->next = $this->head;
        $this->head = $node;
    }

    public function pushBack(mixed $value): void
    {
        $node = new Node($value);

        if ($this->head === null) {
            $this->head = $node;
            return;
        }

        $cur = $this->head;
        while ($cur->next !== null) {
            $cur = $cur->next;
        }
        $cur->next = $node;
    }

    public function traverse(callable $fn): void
    {
        for ($cur = $this->head; $cur !== null; $cur = $cur->next) {
            $fn($cur->value);
        }
    }
}
