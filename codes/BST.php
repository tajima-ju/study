<?php
class Node
{
    public int $value;
    public ?Node $left = null;
    public ?Node $right = null;
    public int $height;
}

class Tree
{
    public ?Node $root = null;
    public array $array;
    public function __construct(array $array)
    {
        $this->$array = $array;
    }

    public function insert(int $value)
    {
        $node = new Node($value);
        if ($tree->root === null) {
        }
    }
}
