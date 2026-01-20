<?php

declare(strict_types=1);

namespace Encoding;

use SplPriorityQueue;

class HuffmanTree


{
    public SplPriorityQueue $storedpriorityqueue;

    public int $insertion_number = 1;

    public ?Node $result = null;
    public array $character_code_list = [];
    public function __construct(HuffmanTreedata $huffman_tree_data)
    {

        $insertion_number = 1;
        $splpriorityqueue = new SplPriorityQueue();
        foreach ($huffman_tree_data->huffmantree_data as $charakey => $count) { //受け取った配列データをもとにノードを作成し、優先度つきキューに格納していく
            $chara = (string)$charakey;
            $node = new Node($chara, $count);
            $node->insertion_number = $insertion_number; //登録順番号を付与
            $splpriorityqueue->insert($node, [-$node->weight, -$node->insertion_number]);
            $insertion_number++;
        }
        $this->storedpriorityqueue = $splpriorityqueue;
        $this->insertion_number = $insertion_number;
        $this->make_huffmantree($this->storedpriorityqueue);
        $this->add_code($this->result);
    }

    public function make_huffmantree(SplPriorityQueue $storedpriorityqueue)
    {
        if ($storedpriorityqueue->count() === 1) {
            $this->result = $storedpriorityqueue->extract();
            return;
        }
        $node = new Node(null, 0); //親ノード作成
        $child_node1 = $storedpriorityqueue->extract(); //子ノードを2つ作成
        $child_node2 = $storedpriorityqueue->extract();

        $node->left_child_node = $child_node1; //左右に子ノード登録
        $node->right_child_node = $child_node2;
        $node->weight = $child_node1->weight + $child_node2->weight;

        $child_node1->parent_node = $node; //子ノードに親ノード登録
        $child_node2->parent_node = $node;
        $node->insertion_number = $this->insertion_number;
        $storedpriorityqueue->insert($node, [-$node->weight, -$node->insertion_number]); //作成ノードをキューに戻す
        $this->insertion_number++;

        return $this->make_huffmantree($storedpriorityqueue);
    }

    public function isleaf(Node $node): bool //葉かどうか確認する
    {
        if ($node->left_child_node === null && $node->right_child_node === null) {
            return true;
        } else {
            return false;
        }
    }

    public function add_code(Node $node)
    {
        if ($this->isleaf($node)) { //nodeが葉だった場合は停止する
            if ($node->code === "") { //最初のnodeが一つのみ（葉）だった場合（入力された文字が１文字）
                $node->code = "0";
            }
            $this->character_code_list[$node->character] = $node->code; //[a]=>00のような配列を作成
            return;
        }
        $node->left_child_node->code = $node->code . "0"; //左なら、左の子のcodeに0を追加していく
        $this->add_code($node->left_child_node);

        $node->right_child_node->code = $node->code . "1";
        $this->add_code($node->right_child_node);
    }

    public function get_character_code_list(): array
    {
        return $this->character_code_list;
    }
}
