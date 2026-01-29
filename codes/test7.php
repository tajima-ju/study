<?php


interface Runner
{
    public function run(): string;
}

class DelegationSource implements Runner
{
    public function run(): string
    {
        return "run!";
    }
}

class ToDelegation implements Runner
{
    // 委譲先を interface 型で保持
    public function __construct(private Runner $runner) {}

    public function run(): string
    {
        // interface のメソッドに委譲（転送）
        return $this->runner->run();
    }
}

$source = new DelegationSource();
$delegator = new ToDelegation($source);

echo $delegator->run();
