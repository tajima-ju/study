<?php
$self_url = $_SERVER["PHP_SELF"]; //自身のURLを取得
?>

<form action="<?php echo $self_url; ?>" method="POST">
    <input type="text" name="message">
    <input type="submit" value="メモに書き込む！">
    <h1>メモに書くよ</h1>
</form>

<?php

$contents = $_POST["message"];　
$date = file_get_contents("test.txt"); // 元の内容
$append_date = $date . $contents;

function h($contents)
{
    return htmlspecialchars($contents, ENT_QUOTES, 'UTF-8');
}

if (
    isset($contents)
    && $contents !== "" // 変数が存在かつ、空文字ではない
) {

    file_put_contents("test.txt", $append_date);
    echo "書き込みに成功しました。";
    echo "<br>";

    $contents = h($contents);
    echo "書き込んだ内容は{$contents}です。";
} else {
    echo "書き込んでください。";
}
$contents = "";
?>