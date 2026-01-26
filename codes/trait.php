<?php

trait Squared //共通処理をtraitとして切り出しせる！　今回は2乗処理
{
    public function squared(int $num): int
    {
        return $num * $num;
    }
}

interface Area //面積処理は必ず持っている事！
{
    public function area(): float;
}

class Circle implements Area
{
    use Squared; //trait使用する宣言

    private  int $radius;
    public const  PI = 3.14;


    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function area(): float
    {
        return  $this->squared($this->radius) * self::PI; //$this->trait関数名で使用
    }
}

class Square implements Area
{
    use Squared;

    private int $side_length;

    public function __construct(int $side_length)
    {
        $this->side_length = $side_length;
    }

    public function area(): float
    {
        return $this->squared($this->side_length);
    }
}


$circle = new Circle(10); //314
echo $circle->area();



$square = new Square(5);
