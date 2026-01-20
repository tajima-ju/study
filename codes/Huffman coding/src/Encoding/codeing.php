<?php

declare(strict_types=1);

class symbol_data
{
    public int|string $symbol;
    public array $symbol_array;
    public array $symbol_data;

    final public function __construct($symbol)
    {
        $this->symbol = $symbol;
        $this->make_symbol_array($this->symbol);
        $this->make_symbol_data($this->symbol_array);
    }

    public function get_symbol_array()
    {
        return $this->symbol_array;
    }

    final public function make_symbol_array($symbol): array //入力された文字列を１文字に区切って配列として戻す
    {
        $this->symbol_array = mb_str_split($symbol, 1, 'UTF-8');

        return $this->symbol_array;
    }


    final public function make_symbol_data($symbol_array): array //シンボルデータを作成、$resultに受け取った配列のデータを作成、格納する
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


        return  $this->symbol_data = $results;
    }
}

class Huffmantree_data
{
    private array $huffmantree_data;
    public function __construct(symbol_data $src)
    {
        $this->huffmantree_data = array_column($src->symbol_data, 'Appearance_rate', 'character');
    }

    public function get_huffmantree_data(): array
    { //$huffmantree_dataのゲッター
        return $this->huffmantree_data;
    }
}

class Node
{
    public ?string $character;
    public float $weight = 0;
    public ?Node $left = null;
    public ?Node $right = null;
    public bool $visited_flag = false;
    public ?Node $parent = null;
    public string $code = "";
    public array $result = [];


    public function __construct(?string $character, float $weight)
    {

        $this->character = $character;
        $this->weight = $weight;
    }
}

class Huffmantree
{
    public SplPriorityQueue $priorityQueue;
    public array $tmp;
    public  ?Node $cur = null;
    public int $sequence = 0;
    public ?Node $result = null;
    public array $code_array = [];


    public function __construct(Huffmantree_data $huff)
    {
        $sequence = 0;
        $this->priorityQueue = new SplPriorityQueue();
        $this->tmp = $huff->get_huffmantree_data();
        foreach ($this->tmp as $character => $weight) {
            $node = new Node($character, $weight);
            $this->priorityQueue->insert($node, [-$node->weight, -$sequence]); //キューに入れるデータ：優先順位（大きい値が先頭にくる）マイナスをつけることで小さい値から取り出す。配列にすることで第二優先順位
            $sequence++; //先に入った順から0->1...のように重みづけしていく
        }
        $this->sequence = $sequence;
    }

    public function make_tree()
    {
        $child_node1 = null;
        $child_node2 = null;

        if ($this->priorityQueue->count() === 1) { //キューが1(全て結合した)なら停止
            $this->result = $this->priorityQueue->extract();
            return $this->result;
        }


        $node = new Node(null, 0); //ノード作成

        for ($i = 0; $i <= 1; $i++) {
            if ($i === 0) {
                $child_node1 = $this->priorityQueue->extract(); //キューの先頭から取り出し$node1に格納
            } else {
                $child_node2 = $this->priorityQueue->extract(); //キューの先頭から取り出し$node2に格納
            }
        }

        $child_node1->parent = $node; //親ノード登録
        $child_node2->parent = $node;

        $node->left = $child_node1;
        $node->right = $child_node2; //取り出したノードを左右にくっつける

        $node->weight = $child_node1->weight + $child_node2->weight; //子の重みの合計を親に格納する

        $this->priorityQueue->insert($node, [-$node->weight, -$this->sequence]); //キューに戻す
        $this->sequence++;

        return $this->make_tree();
    }


    public function is_leaf(Node $node) //leafならtrueを返す
    {
        if ($node->left === null && $node->right === null) {
            return true;
        }
    }

    public function search($node): void //戻り値を持たない＝どこかに格納した処理のみ。
    {
        if ($node->left === null && $node->right === null) { // leafなら停止
            if ($node->code === "") {
                $node->code = "0";
            }
            $this->code_array[$node->character] = $node->code;
            return;
        }
        $node->left->code = $node->code . "0";
        $this->search($node->left);

        $node->right->code = $node->code . "1";
        $this->search($node->right);
    }

    public function  add_code(array $symbol_data): array
    {
        foreach ($this->code_array as $key => $value) {
            for ($i = 0; $i < count($symbol_data); $i++) {
                if ($symbol_data[$i]["character"] === $key) {
                    $symbol_data[$i]["code"] =  $value;
                    break;
                }
            }
        }
        return $symbol_data;
    }
}

class Encode
{
    public ?string $character_code = null;
    public ?array $character_data = null;
    public ?array $sort_character_data = null;
    public string $encode_data = "";
    public function __construct($character_data)
    {
        $this->character_data = $character_data;
    }



    public function sort_character_code()
    {
        usort($this->character_data, function ($a, $b) {
            $tmp = $a['first_position'] <=> $b['first_position'];
            return $tmp;
        });
        $this->sort_character_data = $this->character_data;
        return;
    }


    public function encode(array $symbol_data)
    {
        $encode  = '';

        for ($i = 0; $i < count($symbol_data); $i++) {
            foreach ($this->sort_character_data as $key => $value) {
                if ($value['character'] === $symbol_data[$i]) {
                    $encode .= $value['code'];
                    break;
                }
            }
        }
        $this->encode_data = $encode;
        return;
    }

    public function get_character_data()
    {
        return $this->character_data;
    }
}

class Decode
{
    public $encode_data = ""; //0011...

    public function __construct($encode_data)
    {
        $this->encode_data = $encode_data;
    }
    public function decode($encode_data)
    {
        $character_data = $encode_data;
    }
}







$symbol_data = new symbol_data("aaabbbccc");
// var_dump($symbol_data->symbol_data);


$huff = new Huffmantree_data($symbol_data);
$Huffmantree = new Huffmantree($huff);
$Huffmantree->make_tree();
$Huffmantree->search($Huffmantree->result);
$new_symbol_data = $Huffmantree->add_code($symbol_data->symbol_data);

$encode = new Encode($new_symbol_data);
$encode->sort_character_code();
print_r($encode->character_data);

$encode->encode($symbol_data->get_symbol_array());
echo $encode->encode_data;

$decode = new Decode($encode->encode_data);

$decode->decode($encode->get_character_data());

// print_r($symbol_data->symbol_array);




    //  

// var_dump($a->symbol_array);
// var_dump($a->test);

// print_r($huff->huffmantree_data);
//  $priorityQueue->insert($this->tmp[$i],-$this->tmp[$i][]);


// if ($this->is_leaf($this->cur)) { c
//             $this->cur = $this->cur->parent; //上へ
//             if ($this->cur->right->visited_flag) {//訪れた事あるのなら
//                 
//             }
//         } else { //leafじゃないなら


// usort($results, function ($a, $b) { //$resultの要素を一つずつ取り出し、$a,$bに格納、
//     $tmp = $b['Appearance_rate'] <=> $a['Appearance_rate']; //降順
//     return $tmp;
// });
