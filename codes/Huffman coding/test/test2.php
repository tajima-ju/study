<?php
$a = [
    ["age" => 10, "sex" => "male", "color" => "white"],
    ["age" => 9, "sex" => "female", "color" => "white"],
    ["age" => 14, "sex" => "male", "color" => "black"]
];

// print_r(array_column($a, 'color', 'age')); 
// [10] => white、引数でキーを指定、 第二引数の値を値とし,第三引数の値をキーとする


$test = new SplPriorityQueue();

for ($i = 0; $i < count($a); $i++) {
    $test->insert($a[$i]['age'], -$a[$i]['age']);
}

while (!($test->isEmpty())) {
    echo $test->extract(); //14 10 9
}
