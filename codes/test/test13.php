<?php

declare(strict_types=1);
//単方向リスト
//配列を用いて疑似的に再現
$node3 = ['value' => 'C', 'next' => null];
$node2 = ['value' => 'B', 'next' => $node3];
$node1 = ['value' => 'A', 'next' => $node2];
$head =  ['next' => $node1];

for ($current = $head['next']; $current !== null; $current = $current = $current['next']) {
    echo $current['value'];
}

//$current =$head['next]によって$current=$node1 
// => $current=['value' => 'A', 'next' => $node2]となる
//$current['value']が実行されAが出力されると
//$current  = $current['next']で $current=$node2となり、更新される





final class Node
{
    public mixed $value; //nodeインスタンスが保持するデータをvalueプロパティに格納
    public ?Node $next = null; // nextプロパティにはNodeインスタンス、もしくはnullのみを格納

    public function __construct(mixed $value) //生成されたインスタンスにコンストラクタでvalueプロパティに値をセット
    {
        $this->value = $value;
    }
}

final class SinglyLinkedList //リストにおける基本的な要素の設計書
{
    private ?Node $head = null; //$headプロパティにはNodeインスタンスもしくはnullのみを格納

    public function pushFront(mixed $value): void //リストの先頭に要素を追加するメソッド。
    {
        $node = new Node($value); //新たなNodeインスタンスを作成
        $node->next = $this->head; //作成したNodeインスタンスのnextプロパティに、SinglyLinkedListクラスのheadプロパティが指定しているNodeインスタンスが格納される。
        $this->head = $node; //headプロパティに新たに作成したNodeインスタンスを格納
    }

    public function pushBack(mixed $value): void //リストの末尾に要素を追加するメソッド
    {
        $node = new Node($value); //新たなNodeインスタンスを作成

        if ($this->head === null) { //SinglyLinkedListクラスのheadプロパティがnullなら（末尾が先頭になる）
            $this->head = $node; //headプロパティに新たに作成したNodeインスタンスを格納する
            return;
        }

        $cur = $this->head; //$curにSinglyLinkedListクラスのheadプロパティを格納。$cyrはインスタンスではないが、インスタンスへの参照が格納されている。
        while ($cur->next !== null) { //$curはインスタンスへの参照が格納されているので、インスタンスでなくても->でメソッドやプロパティにアクセスできる。nullチェックを行う
            $cur = $cur->next; //nullでなければ、nextプロパティを格納して、次のNodeへアクセスする
        }
        $cur->next = $node; //今の$curには末尾要素のNodeインスタンスが格納されている。そのnextプロパティに新たなNodeインスタンスを格納する。
    }

    public function traverse(callable $fn): void
    {
        for ($cur = $this->head; $cur !== null; $cur = $cur->next) {
            $fn($cur->value);
        }
    }
}
