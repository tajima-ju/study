<?php 

{

get_num()
{
       $num = 1;
    while ($num < 10) {
     
        if ($num === 5) {
            return $num;
        } else {
            $num++;
        }
    }
}

function  get_num2($num2)
{
    while ($num2 < 10) {
        if ($num2 === 5) {
            return $num2;
        } else {
            $num2++;
        }
    }
}

echo get_num();
