<?php

declare(strict_types=1);

namespace Encoding;

use Exception;

class SymbolDate
{

    private string $symbol;
    public array $symbol_char_array;

    public function __construct(int|string|null $symbol_date)
    {
        if ($symbol_date === null) {
            throw new Exception('nullが入っています');
        } elseif (is_int($symbol_date)) {
            $this->symbol = strval($symbol_date);
        } else {
            $this->symbol = $symbol_date;
        }
        $this->make_symbol_array($symbol_date);
    }

    public function make_symbol_array(string $symbol_date): void
    {
        $this->symbol_char_array = mb_str_split($symbol_date, 1, 'UTF-8');
    }

    public function make_symbol_date(array $symbol_array):array;{
        
    }
}
try {
    $symbol_date = new SymbolDate('aaabbbccc');
} catch (Exception $exception) {
    echo "値が不正です:" . $exception->getMessage();
}
print_r($symbol_date->symbol_char_array);
