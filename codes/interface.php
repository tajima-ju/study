<?php
interface Speaker
{
    public function speak(): string;
}
//インターフェースはこのメソッドは必ずもつように！という約束
//インスタンスのように生成しなくてもいい
//型指定のように扱う

class Dog implements Speaker //DogクラスにはSpeakerインターフェイスが存在
{
    private $animal = "dog";
    public function speak(): string
    {
        return "ワン！";
    }
}

class Cat implements Speaker
{
    private $animal = "cat";
    public function speak(): string
    {
        return "にゃー！";
    }
}

function say(Speaker $speaker): void //インターフェイスは型のように使う。
//Speakerインターフェイスを実装しているオブジェクトを引数に指定
{
    echo $speaker->speak();
}

say(new Dog()); //$speaker = new Dog が行われ、Dogインスタンスが生成される

//function sayの中身（機能）はDogを知らなくても関数が動作することが重要
//sayの中身で判断するロジックを書く必要がなくなる
//引数のSpeaker指定により、spake()が確実に存在しているから。
