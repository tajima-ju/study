<?php
$a = [
    0 => ["cnt" => 2, "char" => "a"],
    1 => ["cnt" => 4, "char" => "C"],
    2 => ["cnt" => 1, "char" => "B"],
];

$b = [];

// print_r($a);
foreach ($a as $key => $value) {
    $b[] = $value['cnt'];
}

print_r($b);
