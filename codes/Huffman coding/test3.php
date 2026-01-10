<?php
$a = [
    0 => ["cnt" => 2, "char" => "a"],
    1 => ["cnt" => 4, "char" => "C"],
    2 => ["cnt" => 1, "char" => "B"],
];

print_r($a);
print_r(asort($a["cnt"]));
