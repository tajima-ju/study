<?php
// $now = new Datetime();
// echo $now->format('Y年m月j日G時i分s秒');

class Person
{
    public string $firstname;
    public string $lastname;
    public int $age = 10;
    public function introduce()
    {
        echo "私は{$this->firstname}{$this->lastname}です。";
    }



    public static function greeting()
    {
        echo "ohayo!!";
    }


    public function aisatu()
    {
        echo "おはよう";
    }
}

class Dog
{
    public static $spicies = "dog";
    public const LIFE = "animal";
    public static function bow()
    {
        echo "ワン!!";
    }
}

$p1 = new Person();
$p1->firstname = "田島";
$p1->lastname = "健太";

$p1->introduce();

Dog::bow(); //クラス名::静的メソッド ワン インスタンスを作らなくても実行可能
echo Dog::$spicies; // dog
echo Dog::LIFE; //animal クラス定数にアクセス



class  Night_person extends Person
{
    public int  $age = 30;
    public function aisatu()
    {
        echo "こんばんわ";
    }
}
echo $p1->age; //10
echo $p1->aisatu();


$Night_person = new Night_person;

echo $Night_person->age;
echo $Night_person->aisatu();










// class Triangle
// {
//     public $base;
//     public $height;

//     public function __construct($base, $height)
//     {
//         $this->base = $base;
//         $this->height = $height;
//     }

//     public  function  getArea()
//     {
//         return ($this->base * $this->height) / 2;
//     }
// }

// $Triangle = new Triangle(5, 10); //底辺5，高さ10を持つ三角形
// echo $Triangle->getArea();
