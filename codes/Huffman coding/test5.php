<?php
function add()
{
    static $num1 = 1;
    if ($num1 <= 100) {
        $num1++;
        add();
    }
    return $num1;
}
// echo add();




// $num2 =1;
// function add2(){
