<?php
$self_url = $_SERVER["PHP_SELF"];
?>

<form action="<?php echo $self_url; ?>" method="GET">
    <h1>選んでください</h1>
    <select name="select">
        <option value="グー">グー</option>
        <option value="チョキ">チョキ</option>
        <option value="パー">パー</option>
    </select>
    <input type="submit" value="送信">
</form>

<?php



if (isset($_POST["result"])) {
    if ($_POST["result"] === 0) {
        echo "引き分けです";
    } elseif ($_POST["result"] === 1) {
        echo "勝ちです";
    } else {
        echo "負けです";
    }
}

?>