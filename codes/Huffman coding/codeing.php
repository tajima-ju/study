<?php

declare(strict_types=1);

class symbol_date
{
    public int|string $symbol;
    public array $symbol_array;
    public array $result;

    public function __construct($symbol)
    {
        $this->symbol = $symbol;
        $this->make_symbol_array($this->symbol);
        $this->make_symbol_date($this->symbol_array);
    }

    public function make_symbol_array($symbol_array): array //入力された文字列を１文字に区切って配列として戻す
    {
        $this->symbol_array = mb_str_split($this->symbol, 1, 'UTF-8');

        return $this->symbol_array;
    }


    public function make_symbol_date($symbol_array) //シンボルデータを作成、$resultに受け取った配列のデータを作成、格納する
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

        usort($results, function ($a, $b) { //$resultの要素を一つずつ取り出し、$a,$bに格納、
            $tmp = $b['count'] <=> $a['count']; //降順
            if ($tmp === 0) {
                $tmp = $a['first_position'] <=> $b['first_position']; //昇順
            }
            return $tmp;
        });
        $this->result = $results;
    }
}

$a = new symbol_date("aabbbC 1");
var_dump($a->result);
// var_dump($a->symbol_array);
// var_dump($a->test);
