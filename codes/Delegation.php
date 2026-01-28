<?php

class Delegation_source //委譲元、使いまわしたい処理があるクラス
{


    public function run(): string //使いまわしたいクラス
    {
        return "run!";
    }
}

class To_delegation //委譲先、ここで処理を使いたい
{
    private Delegation_source $delegation_source; //クラスのプロパティとして委譲元を保持する

    public function __construct(Delegation_source $delegation_source)
    {
        $this->delegation_source = $delegation_source;
    }

    public function run(): string
    {
        return $this->delegation_source->run();
    }
}

$delegation_source = new Delegation_source();

$to_delegation = new To_delegation($delegation_source);
echo $to_delegation->run();
