<?php
class Node
{
    public $value; //値を格納するプロパティ
    public ?Node $next = null; //$nextにNode型指定、もしくはnull。初期値をnullとする

    public  function __construct($value) //インスタンス生成時初期値をセット
    {
        $this->value = $value;
    }
}

class LinkedList
{

    public ?Node $head = null; //先頭要素への参照を格納する

    public function push_front($value)
    {
        $node = new Node($value);
        $node->next = $this->head;
        $this->head = $node;
    }

    public function push_tail($value)
    {
        $node = new Node($value);
        if ($this->head === null) {
            $this->head = $node;
            return;
        }
        $list_cursor = $this->head;
        while ($list_cursor->next !== null) {
            $list_cursor = $list_cursor->next;
        }
        $list_cursor->next = $node;
    }
}
