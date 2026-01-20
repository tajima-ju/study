<?php

declare(strict_types=1);

namespace Encoding;

use InvalidArgumentException;


class HuffmanTreedata
{
    public array $huffmantree_data;


    public function __construct(array $huffmantree_data)
    {
        if ($huffmantree_data === []) {
            throw new InvalidArgumentException('huffmantree_data must not be empty');
            //  throw new \InvalidArgumentException と書くことでグローバル空間のクラスを使うと明示的に宣言できる
        }

        foreach ($huffmantree_data as $charakey => $count) {
            $chara = (string)$charakey;
            if ($chara === '') {
                throw new InvalidArgumentException('huffmantree_data key must not be empty');
            }
            if (mb_strlen($chara, 'UTF-8') !== 1) {
                throw new InvalidArgumentException('huffmantree_data key must be exactly 1 character');
            }

            if (!is_int($count)) {
                throw new InvalidArgumentException('huffmantree_data value must be an int got:' . gettype($count));
            }
            if ($count <= 0) {
                throw new InvalidArgumentException("huffmantree_data value must be greater than 0.key='{$chara}'");
            }
        }
        $this->huffmantree_data = $huffmantree_data;
    }
}
