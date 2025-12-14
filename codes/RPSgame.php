<?php
$self_url = $_SERVER["PHP_SELF"];
?>
<form action="<?php echo $self_url; ?>" method="POST">
    <h1>選んでください</h1>
    <select name="select">
        <option value="グー">グー</option>
        <option value="チョキ">チョキ</option>
        <option value="パー">パー</option>
    </select>
    <input type="submit" value="送信">
</form>




<?php
if (!isset($_POST["select"])) {
    echo "選択してください";
    return;
}


$hands = [
    "グー" => 0,
    "チョキ" => 1,
    "パー" => 2,
];
$get_user_hand = $_POST["select"];
$get_user_hand_num = $hands[$_POST["select"]];
$set_cpu_hand_num = rand(0, 2);








if ($get_user_hand_num === $set_cpu_hand_num) {
    echo "あいこです";
} elseif (
    $get_user_hand_num === 0 && $set_cpu_hand_num === 1 ||
    $get_user_hand_num === 1 && $set_cpu_hand_num === 2 ||
    $get_user_hand_num === 2 && $set_cpu_hand_num === 0
) {
    echo "あなたの勝ちです。";
} else {
    echo "あなたの負けです";
}
