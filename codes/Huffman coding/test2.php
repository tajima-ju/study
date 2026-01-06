<?php
$a = [
    ["A" => 2],
    ["A" => 1],
    ["A" => 4],
    ["A" => 2],
    ["A" => 1],
];

// var_dump($a);

$sum = 0;


for ($i = 0; $i < count($a); $i++) {
    $sum += $a[$i]["A"];
}
echo $sum;


foreach ($a as $key => $rate) {
    $a[$key]["rate"] = $rate["A"] / $sum;
}

var_dump($a);


    
//     $a[$key][] = 
// }



// array(5) {
//   [0]=>
//   array(3) {

//     ["character"]=>
//     string(1) "b"

//     ["count"]=>
//     int(3)

//     ["first_position"]=>
//     int(2)