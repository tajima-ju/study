<?php

declare(strict_types=1);

namespace Encoding;

use InvalidArgumentException; //use クラス名とすることでグローバル空間にあるクラスを使える
// use無いと Encoding\InvalidArgumentExceptionを探してしまい、見つからない！


class Encode
{
    public  string $character_code = "";
    private array $character_list = [];
    private array $character_code_list = [];

    public function __construct(array $character_list, array $character_code_list)
    {
        $character_code = "";
        $character_code = $this->encode($character_list, $character_code_list);
    }

    public function encode(array $character_list, array $character_code_list): void
    {
        $character_code = "";
        foreach ($character_list as $key => $chara) {
            $character_code .= $character_code_list[$chara]; //エンコード処理を行う
        }
        if ($character_code === "") { //コードが空ではない事の検証
            throw new InvalidArgumentException('character_code must not be empty');
        }
        $this->character_code = $character_code;
        $split_character_code = mb_str_split($character_code, 1, 'UTF-8'); //分割された文字が0，1かどうか検証する
        foreach ($split_character_code as $key => $chara) {
            if (!($chara === "0" || $chara === "1")) {
                throw new InvalidArgumentException('character_code must be 0 or 1');
            }
        }
        $this->character_code = $character_code;
    }

    public function show_character_code(): string
    {
        return $this->character_code;
    }
}
