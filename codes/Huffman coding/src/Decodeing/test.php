<?php

//
$char = ""; //string(0) ""

$str = "A";

$num = 1;

$char .= $num;
var_dump($char); //string(1) "1"



$char2 = "";

// $char2 += $num; //error　string+intはダメ！

$null = null;

$null .= $num;
var_dump($null);


$long_char = "あいう";

$first_char = $long_char[0];

var_dump($first_char);
