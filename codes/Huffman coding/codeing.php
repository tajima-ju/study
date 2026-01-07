<?php

declare(strict_types=1);

class symbol_date
{
    public int|string $symbol;
    public array $symbol_array;
    public array $symbol_date;

    final public function __construct($symbol)
    {
        $this->symbol = $symbol;
        $this->make_symbol_array($this->symbol);
        $this->make_symbol_date($this->symbol_array);
    }

    final public function make_symbol_array($symbol): array //入力された文字列を１文字に区切って配列として戻す
    {
        $this->symbol_array = mb_str_split($symbol, 1, 'UTF-8');

        return $this->symbol_array;
    }


    final public function make_symbol_date($symbol_array): array //シンボルデータを作成、$resultに受け取った配列のデータを作成、格納する
    {
        $cnt  = []; //出現回数
        $first_position = []; //初登場した位置
        $results = [];

        foreach ($symbol_array as $key => $chara) { //$cnt[$chara]で出現回数を、$first_position[$chara] で初登場位置を返す。
            if (!isset($cnt[$chara])) { //文字が初登場なら
                $cnt[$chara] = 0;
                $first_position[$chara] = $key; //初登場位置は$symbol_arrayのキー
            }
            $cnt[$chara]++;
        }



        foreach ($cnt as $character => $count) {
            $results[] = [
                'character' => $character,
                'count' => $count,
                'first_position' => $first_position[$character]
            ];
        }

        $sum = 0;
        for ($i = 0; $i < count($results); $i++) {
            $sum += $results[$i]['count'];
        }
        foreach ($results as $key => $rate) {
            $results[$key]['Appearance_rate'] = round($results[$key]['count'] / $sum, 2);
        }

        usort($results, function ($a, $b) { //$resultの要素を一つずつ取り出し、$a,$bに格納、
            $tmp = $b['Appearance_rate'] <=> $a['Appearance_rate']; //降順
            if ($tmp === 0) {
                $tmp = $a['first_position'] <=> $b['first_position']; //昇順
            }
            return $tmp;
        });


        return  $this->symbol_date = $results;
    }
}

class Huffmantree_date
{
    private array $huffmantree_date;
    public function __construct(symbol_date $src)
    {
        $this->huffmantree_date = array_column($src->symbol_date, 'Appearance_rate', 'character');
    }

    public function get_huffmantree_date(): array
    { //$huffmantree_dateのゲッター
        return $this->huffmantree_date;
    }
}

class Node
{
    public ?string $character;
    public ?float $weight = 0;
    public ?Node $left = null;
    public ?Node $right = null;


    public function __construct($character, $weight)
    {

        $this->character = $character;
        $this->weight = $weight;
    }
}

class Huffmantree
{
    public ?Node $root = null;
    public SplPriorityQueue $priorityQueue;
    public array $tmp;
    public  ?Node $cur = null;

    public function __construct(Huffmantree_date $huff)
    {
        $sequence = 0;
        $this->priorityQueue = new SplPriorityQueue();
        $this->tmp = $huff->get_huffmantree_date();
        foreach ($this->tmp as $character => $weight) {
            $node = new Node($character, $weight);
            $this->priorityQueue->insert($node, [-$node->weight, $sequence]);
            $sequence++;
        }
    }

    public function make_tree()
    {
        if ($this->priorityQueue->isEmpty()) {
            return;
        }

        $node = new Node(null, null);


        if (!isset($this->root)) {
            $this->root = $node;
            $this->make_tree();
            $this->cur = $this->root;
        }

        $compare = [];
        $compare_node1 = null;
        $compare_node2 = null;
        $compare[] = $compare_node1;
        $compare[] = $compare_node2;
        $tmp = null;





        for ($i = 0; $i <= 1; $i++) {
            if ($i === 0) {
                $tmp[] = $this->priorityQueue->extract();
                $compare[$i] = $tmp;
            } else {
                $tmp[] = $this->priorityQueue->extract();
                $compare[$i] = $tmp;
            }
        }
    }
}


$symbol_date = new symbol_date("abbbcc  d");
var_dump($symbol_date->symbol_date);

$huff = new Huffmantree_date($symbol_date);
$Huffmantree = new Huffmantree($huff);


// var_dump($a->symbol_array);
// var_dump($a->test);

// print_r($huff->huffmantree_date);
//  $priorityQueue->insert($this->tmp[$i],-$this->tmp[$i][]);