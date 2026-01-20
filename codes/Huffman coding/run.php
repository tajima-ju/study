<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap/autoload.php'; //まずオートロードを読み込む

use Encoding\HuffmanTreedata;
use Encoding\CharacterData;
use Encoding\Node;
use Encoding\HuffmanTree;
use Encoding\Encode;

try {
    $character_data = new CharacterData("sss");
    $huffman_tree_data = new HuffmanTreeData($character_data->get_count_data());
} catch (InvalidArgumentException $exception) {
    echo "入力された値が不正です:" . $exception->getMessage();
}

$huffmantree = new HuffmanTree($huffman_tree_data);

$encode  = new Encode($character_data->get_character_list(), $huffmantree->get_character_code_list());

echo $encode->show_character_code();
