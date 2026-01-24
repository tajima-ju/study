<?php
class Myparent
{
    public function greeting()
    {
        echo "親";
    }
}
$parent = new Myparent();
$parent->greeting();

class Child extends MyParent
{
    public function child_greeting()
    {
        echo "子供";
    }
}
$child = new Child();
$child->child_greeting();
$parent->greeting();
