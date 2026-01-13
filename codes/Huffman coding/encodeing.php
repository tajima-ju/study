<?php

declare(strict_types=1);

namespace Encoding;

use Exception;

class CharacterDate
{

    private string $character;
    public array $character_list = [];   // [0] => a....
    public array $character_date = [];


    public function __construct(int|string|null $symbol)
    {
        if ($symbol === null) {
            throw new Exception('nullが入っています');
        } elseif (is_int($symbol)) {
            $this->character = strval($symbol);
        } else {
            $this->character = $symbol;
        }
        $this->Split_Into_Character($symbol);
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
            $tmp = $b['count'] <=> $a['count'];
            if ($tmp === 0) {
                $tmp = $a['first_position'] <=> $b['first_position'];
            }
            return $tmp;
        });

        $this->character_date = $unsorted_character_date;
    }
}



try {
    $character_date = new CharacterDate('aaaccccbbb');
} catch (Exception $exception) {
    echo "値が不正です:" . $exception->getMessage();
}
// print_r($character_date->character_list);
print_r($character_date->character_date);
