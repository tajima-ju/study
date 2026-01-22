<?php

declare(strict_types=1);

namespace Decoding;

use InvalidArgumentException;

class Decode
{
    private array $flipped_character_code_list;
    private string $character_code;

    public string $decoded_character = "";

    public function __construct(array $character_code_list, string $character_code)
    {


        $this->flipped_character_code_list = array_flip($character_code_list);
        $this->character_code = $character_code;
    }

    public function decoding(): void
    {
        $character = "";
        $tmp_code = "";
        $character_code_length = strlen($this->character_code);

        for ($i = 0; $i < $character_code_length; $i++) {
            $tmp_code .= $this->character_code[$i]; //文字列の先頭から取り出していく

            if (isset($flipped_character_code_list[$tmp_code])) {
                $character .= $this->flipped_character_code_list[$tmp_code];
                $tmp_code = "";

                continue;
            }
        }
        if ($tmp_code !== "") {
            throw new InvalidArgumentException("Encode is failed");
        }
        $this->character = $character;
    }

    fun
}


$character_code_list = [
    "a" => "10",
    "b" => "11",
    "c" => "00"
];

$character_code = "0010111100";
$decode = new Decode($character_code_list, $character_code);

var_dump($decode->decoded_character);
