<?php

declare(strict_types=1);

namespace Encoding;

use InvalidArgumentException;

class Node
{
    public ?string $character = null;
    public int $weight = 0;
    public ?Node $left_child_node = null;
    public ?Node $right_child_node = null;

    public ?Node $parent_node = null;
    public string $code = "";
    public ?int $insertion_number = null;



    public function __construct(?string $character, int $weight)
    {
        if ($character === "") {
            throw new InvalidArgumentException('character must not be empty');
        }
        if ($weight < 0) {
            throw new InvalidArgumentException('weight must be greater than 0');
        }

        $this->character = $character;
        $this->weight = $weight;
    }
}
