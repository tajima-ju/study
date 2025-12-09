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


<?php
$test_array = [
    "moka" => 1,
    "ueno" => 2,
];

var_dump($test_array);

echo $test_array["moka"];
echo "<br>";
$test_array["niki"] = 3; //連想配列test_array1に niki => 3 を追加
echo $test_array["niki"]; //3



$test_array2 = [
    "ユーザー1" => [
        "苗字" => "田中",
        "誕生日" => "1月2日",
        "性別" => "男",
    ],
    "ユーザー2" => [
        "苗字" => "佐藤",
        "誕生日" => "5月6日",
        "性別" => "女",
    ]
];

var_dump($test_array2);

echo "私は{$test_array2["ユーザー1"]["苗字"]}です。";
echo "<br>";

$test_array2["ユーザー3"]["苗字"] = "佐々木";
//多次元連想配列test_array2に ユーザー=>苗字=>佐々木を追加
echo $test_array2["ユーザー3"]["苗字"]; 
//佐々木
