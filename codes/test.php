<?php
$students = [
    '1' => [
        'name' => 'taro',
        'age' => 15,
    ]
];

$id = $_GET['id'] ?? 1;
$student = $students[$id];
$name = $student['name'];
$age = $student['age'];
?>
<!-- $id = $_GET['id'] ?? 1;　初期値1はURLに末尾に書かれている
students[1]で配列を指定,studentに格納
$nameにstudent[’name’]でtaroを格納
$ageにstudent[’age’]で15を格納 -->
<div><?php echo "{$name}は{$age}才です。"; ?></div>