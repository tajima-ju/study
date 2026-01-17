<?php

declare(strict_types=1);

namespace Encoding;

use InvalidArgumentException;
use SplPriorityQueue;

class CharacterDate
{

    private string $character;
    public array $character_list = [];   // [0] => a....
    public array $character_date = [];


    public function __construct(int|string|null $symbol)
    {
        if ($symbol === null) {
            throw new InvalidArgumentException('symbol must not contain null');
        } elseif (is_int($symbol)) {
            $this->character = strval($symbol); //数値であれば文字列に変換
        } else {
            $this->character = $symbol;
        }
        $this->Split_Into_Character($this->character);
        $this->Create_Character_Date($this->character_list);
    }

    public function Split_Into_Character(string $character): void //受け取った記号（文字）を１文字単位に分割。配列に格納
    {
        $this->character_list = mb_str_split($character, 1, 'UTF-8');
    }

    public function Create_Character_Date(array $character_list): void //文字配列を受け取り、データを作成、配列を作成する
    {
        $count = []; //文字=>出現回数 a=>1など...
        $first_position = []; //文字=>出現位置 
        $unsorted_character_date = []; //未整列データを一時格納




        foreach ($character_list as $key => $chara) { //文字配列から出現回数、出現位置、該当の文字の配列データを生成する
            if (!(isset($count[$chara]))) {
                $count[$chara] = 0;
                $first_position[$chara] = $key + 1;
            }
            $count[$chara] = $count[$chara] + 1;
        }

        foreach ($count as $chara => $count_value) {
            $unsorted_character_date[] = [
                "count" => $count_value,
                "first_position" => $first_position[$chara],
                "character" => $chara,
            ];
        }
        //上記の処理によってこのような配列が作られる
        //  [0] => Array
        //         (
        //             [count] => 3
        //             [first_position] => 1
        //             [character] => a
        //         )
        usort($unsorted_character_date, function ($a, $b) { //第一優先count降順、第二優先first_position昇順
            $tmp = $a['count'] <=> $b['count'];
            if ($tmp === 0) {
                $tmp = $a['first_position'] <=> $b['first_position'];
            }
            return $tmp;
        });

        $this->character_date = $unsorted_character_date;
    }

    public function get_count_date(): array //huffmantree_dateに a=>4のような配列を生成して渡す
    {
        return array_column($this->character_date, 'count', 'character');
    }
}

class Huffman_tree_date
{
    public array $huffmantree_date;

    public function __construct(array $huffmantree_date)
    {
        if ($huffmantree_date === []) {
            throw new InvalidArgumentException('huffmantree_date must not be empty');
        }

        foreach ($huffmantree_date as $chara => $count) {

            if (!is_string($chara)) {
                throw new InvalidArgumentException('huffmantree_date key must be a string got:' . gettype($chara));
            }
            if ($chara === '') {
                throw new InvalidArgumentException('huffmantree_date key must not be empty');
            }
            if (mb_strlen($chara, 'UTF-8') !== 1) {
                throw new InvalidArgumentException('huffmantree_date key must be exactly 1 character');
            }

            if (!is_int($count)) {
                throw new InvalidArgumentException('huffmantree_date value must be an int got:' . gettype($count));
            }
            if ($count <= 0) {
                throw new InvalidArgumentException("huffmantree_date value must be greater than 0.key='{$chara}'");
            }
        }
        $this->huffmantree_date = $huffmantree_date;
    }
}

class Node
{
    public ?string $character = null;
    public int $weight = 0;
    public ?Node $left_child_node = null;
    public ?Node $right_child_node = null;

    public ?Node $parent_node = null;
    public string $code = "";
    public ?int $insertion_number = null;

    public function __construct(?string $character, int $weight)
    {
        if ($character === "") {
            throw new InvalidArgumentException('character must not be empty');
        }
        if ($weight < 0) {
            throw new InvalidArgumentException('weight must be greater than 0');
        }

        $this->character = $character;
        $this->weight = $weight;
    }
}

class Huffmantree

{
    public SplPriorityQueue $storedpriorityqueue;

    public int $insertion_number = 1;

    public ?Node $result = null;
    public function __construct(Huffman_tree_date $huffman_tree_date)
    {

        $insertion_number = 1;
        $splpriorityqueue = new SplPriorityQueue();
        foreach ($huffman_tree_date->huffmantree_date as $chara => $count) {
            $node = new Node($chara, $count);
            $node->insertion_number = $insertion_number;
            $splpriorityqueue->insert($node, [-$node->weight, -$node->insertion_number]);
            $insertion_number++;
        }
        $this->storedpriorityqueue = $splpriorityqueue;
        $this->insertion_number = $insertion_number;
        $this->make_huffmantree();
    }

    public function make_huffmantree()
    {
        if ($this->storedpriorityqueue->count() === 1) {
            $this->result = $this->storedpriorityqueue->extract();
            return;
        }
        $node = new Node(null, 0); //親ノード作成
        $child_node1 = $this->storedpriorityqueue->extract(); //子ノードを2つ作成
        $child_node2 = $this->storedpriorityqueue->extract();

        $node->left_child_node = $child_node1;
        $node->right_child_node = $child_node2;
        $node->weight = $child_node1->weight + $child_node2->weight;

        $child_node1->parent = $node;
        $child_node2->parent = $node;
        $node->insertion_number = $this->insertion_number;
        $this->storedpriorityqueue->insert($node, [-$node->weight, -$node->insertion_number]);
        $this->insertion_number++;

        return $this->make_huffmantree();
    }

    public function isleaf(Node $node)
    {
        if ($node->left_child_node === null && $node->right_child_node === null) {
            return true;
        } else {
            return false;
        }
    }

    public function search(Node $node)
    {
        if ($this->isleaf($node)) {
        }
    }
}






try {
    $character_date = new CharacterDate('aacccccbdddeeee');
    $huffman_tree_date = new Huffman_tree_date($character_date->get_count_date());
} catch (InvalidArgumentException $exception) {
    echo "入力された値が不正です:" . $exception->getMessage();
}
// print_r($character_date->character_list);
// print_r($character_date->character_date);

// print_r($huffman_tree_date->huffmantree_date);

$huffmantree = new Huffmantree($huffman_tree_date);

// print_r($huffmantree->storedpriorityqueue);
var_dump($huffmantree->result);
