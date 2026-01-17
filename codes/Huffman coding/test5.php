<?php
class Test
{
    public $a = 10;

    public function test()
    {
        $this->a = 15;
        return;
    }
}

$test = new Test();
$test->test();
echo $test->a;
