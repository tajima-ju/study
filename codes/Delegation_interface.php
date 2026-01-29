<?php

interface SquareCalculator //squareメソッドの実装を強制
{
    public function square(float $radius): float;
}

class SimpleSquarer implements SquareCalculator //継承元　squareメソッドの中身を持つ
{

    public function square(float $radius): float
    {
        return $radius * $radius;
    }
}

class CircleArea
{


    public function __construct(private SquareCalculator $squarer, private float $radius) {}

    public function square(float $radius): float
    {
        return $this->squarer->square($radius);
    }


    public function area(): float //
    {
        return $this->square($this->radius) * M_PI;
    }
}
//SquareCalculator型はsquareメソッドを持っているクラスのみを受け入れる。という型制約
//平方計算ロジックは$simpleSquarerインスタンスが持っている
//実装してあるロジックを使いたい（＝委譲したい）のでcircle_area_1インスタンスの引数に代入している

//これにより、生成するインスタンスによって出力する値を容易に変更できる。

//委譲の書き方
//使いたいメソッド（委譲先）を持つクラスを
//委譲元（メソッドを再利用したいクラス）のコンストラクタに委譲先のインスタンスを注入する。




$simpleSquarer = new SimpleSquarer();


$circle_area_1 = new CircleArea($simpleSquarer, 10);

$circle_area_2 = new CircleArea($simpleSquarer, 100);

var_dump($circle_area_1->area());

var_dump($circle_area_2->area());
