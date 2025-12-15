<?php

if (!isset($_GET["select"])) {
    return;
}

$hands = [
    "グー" => 0,
    "チョキ" => 1,
    "パー" => 2,
];


$get_user_hand = $_GET["select"];
$get_user_hand_num = $hands[$_GET["select"]];
$set_cpu_hand_num = rand(0, 2);

$_POST = [
    "result" => "",
];

if ($get_user_hand_num === $set_cpu_hand_num) {
    $_POST["result"] = 0;
} elseif (
    $get_user_hand_num === 0 && $set_cpu_hand_num === 1 ||
    $get_user_hand_num === 1 && $set_cpu_hand_num === 2 ||
    $get_user_hand_num === 2 && $set_cpu_hand_num === 0
) {
    $_POST["result"] = 0;
} else {
    $_POST["result"] = 0;
}
