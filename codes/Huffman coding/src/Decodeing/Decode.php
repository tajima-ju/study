<?php

declare(strict_types=1);

class Decode
{

    public $character = "";
    public function __construct(array $character_code_list, string $character_code)
    {
        $flipped_character_code_list = array_flip($character_code_list);

        $split_character_code = str_split($character_code, 1);

        $character = "";
        $tmp_code = null;
        for ($i = 0; $i < count($split_character_code); $i++) {
            $tmp_code .= $split_character_code[$i];
            for ($j = 0; $j < count($flipped_character_code_list); $j++) {
                if (isset($flipped_character_code_list[$tmp_code])) {
                    $character .= $flipped_character_code_list[$tmp_code];
                    $tmp_code = null;
                }
            }
        }
        $this->character = $character;
    }
}


$character_code_list = [
    "a" => "10",
    "b" => "11",
    "c" => "00"
];

$character_code = "0010111100";
$decode = new Decode($character_code_list, $character_code);

var_dump($decode->character);
