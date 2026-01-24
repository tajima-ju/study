<?php

// $a['A'] = true;
// $a['B'] = true;
// print_r($a);


$add_value[] = 1;
print_r($add_value);   //0=>1, 空いている箇所が自動で補填される

$add_key[1] = "value";
print_r($add_key);  //1=>value,

$c = null;
$c = [];
var_dump($c);
