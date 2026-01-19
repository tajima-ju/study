<?php

declare(strict_types=1);

namespace Encoding;

use InvalidArgumentException;
use SplPriorityQueue;

class CharacterDate
{

    public string $character;
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
            if (!(isset($count["$chara"]))) {
                $count["$chara"] = 0;
                $first_position["$chara"] = $key + 1;
            }
            $count["$chara"] = $count["$chara"] + 1;
        }

        foreach ($count as $chara => $count_value) {
            $unsorted_character_date[] = [
                "count" => $count_value,
                "first_position" => $first_position["$chara"],
                "character" => "$chara",
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

    public function get_character_list(): array
    {
        return $this->character_list;
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

        foreach ($huffmantree_date as $charakey => $count) {
            $chara = (string)$charakey;
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
    public array $character_code_list = [];
    public function __construct(Huffman_tree_date $huffman_tree_date)
    {

        $insertion_number = 1;
        $splpriorityqueue = new SplPriorityQueue();
        foreach ($huffman_tree_date->huffmantree_date as $charakey => $count) { //受け取った配列データをもとにノードを作成し、優先度つきキューに格納していく
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

class Encode
{
    public  string $character_code = "";
    public function __construct(array $character_list, array $character_code_list)
    {
        $character_code = "";
        $character_code = $this->encode($character_list, $character_code_list);


        if ($character_code === "") {
            throw new InvalidArgumentException('character_code must not be empty');
        }

        $split_character_code = mb_str_split($character_code, 1, 'UTF-8');
        foreach ($split_character_code as $key => $chara) {
            if (!($chara === "0" || $chara === "1")) {
                throw new InvalidArgumentException('character_code must be 0 or 1');
            }
        }
        $this->character_code = $character_code;
    }

    public function encode(array $character_list, array $character_code_list): string
    {
        $character_code = "";
        foreach ($character_list as $key => $chara) {
            $character_code .= $character_code_list[$chara];
        }
        return $character_code;
    }

    public function show_character_code(): string
    {
        return $this->character_code;
    }
}




try {
    $character_date = new CharacterDate("");
    $huffman_tree_date = new Huffman_tree_date($character_date->get_count_date());
} catch (InvalidArgumentException $exception) {
    echo "入力された値が不正です:" . $exception->getMessage();
}




$huffmantree = new Huffmantree($huffman_tree_date);



$encode  = new Encode($character_date->get_character_list(), $huffmantree->get_character_code_list());

echo $encode->show_character_code();
