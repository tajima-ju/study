<?php

interface Squared
{
    public function squared($num): float;
}

class Circle implements Squared
{

    public function squared($num): float
    {
        return $num * $num;
    }
}

class Circle_Area implements Squared
{
    public const PI = 3.14;


    public function __construct(private Squared $squared, float $num) {}

    public function squared($num): float
    {
        $this->Squared->squared();
    }

    public function area(): float
    {
        return $this->squared($this->num) * self::PI;
    }
}
$circle = new Circle;
$circle_area = new Circle_Area($circle, 10);
var_dump($circle_area->area());
