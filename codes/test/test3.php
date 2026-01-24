<?php
$base_array = range(1, 100);
$sieve_array = [];
$Sieve_of_eratosthenes = [];
function make_sieve_array($sieve_num)
{
    $add_num = $sieve_num;
    $i = 1;
    while ($add_num <= 100) {
        $sieve_array[] = $add_num;
        $i++;
        $add_num =  $sieve_num * $i;
    }
    return $sieve_array;
}


$Sieve_of_eratosthenes = array_diff($base_array, make_sieve_array(2));

$Sieve_of_eratosthenes = array_diff($Sieve_of_eratosthenes, make_sieve_array(3));

$Sieve_of_eratosthenes = array_diff($Sieve_of_eratosthenes, make_sieve_array(5));

$Sieve_of_eratosthenes = array_diff($Sieve_of_eratosthenes, make_sieve_array(7));

$result = array_values($Sieve_of_eratosthenes);
print_r($result);
