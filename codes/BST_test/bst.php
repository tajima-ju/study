<?php

declare(strict_types=1);

class Node
{
    public int $value;
    public ?Node $left = null;
    public ?Node $right = null;
    public int $height = 0;
    public function __construct(int $value)
    {
        $this->value = $value;
    }
}

class Tree
{
    public ?Node $root = null;

    public array $array;

    public function __construct(array $array)
    {
        $this->array = $array;
        foreach ($this->array as $tmp_val) {
            if (!(is_int($tmp_val))) {
                continue;
            }
            $this->insert($tmp_val);
        }
    }

    public function insert(int $value) //渡された値を木構造に挿入する
    {
        $node = new Node($value); // ノードを作成

        $cur = $this->search($node); //作成したnodeを引数にして、$curに挿入可能ノードの参照を格納する
        if ($cur === null) { // $curがルートだった場合、木構造にはなにもないことになる
            $this->root = $node; //今作成したノードがルートになる
            return;
        }
        if ($cur->value === $node->value) {
            return;
        } elseif ($cur->value > $node->value) {
            $cur->left = $node;
        } else {
            $cur->right = $node;
        }
    }

    public  function set_root() //   curの初期位置をルートにする処理
    {
        $cur = $this->root;
        return $cur;
    }

    public function search(Node $node) //調べたいノードを渡し、潜れるか確認する処理
    {
        if ($this->set_root() === null) { //初期位置の根の存在を確認
            return;
        }
        $cur = $this->set_root(); //curの初期位置をルートに決定
        return $this->Research($node, $cur); //実際に潜っていく
    }





    private function Research(Node $child_node, Node $cur) //searchで調べたいnodeをchild_nodeとして受け取り、$cur(初期位置ルート)に挿入できる可能ノードの参照を格納し返す
    {
        if ($cur->value === $child_node->value) { //同値ならスルー。
            return $cur;
        } elseif ($cur->value > $child_node->value) { //valueの大小比較により、左を調べていく
            if ($cur->left !== null) { //さらに潜れるなら(nullでない)$curを更新、以降は更新された$curの値と$child_node->valueを再帰で比較し潜っていく

                $cur = $cur->left;

                return $this->Research($child_node, $cur); //再帰でさらに左へ潜る
            } else {
                return $cur; //$curに挿入可能ノードの参照を返す
            }
        } else { //valueの大小比較により、右を調べていく
            if ($cur->right !== null) { //さらに潜れる(nullでない)なら$curを更新

                $cur = $cur->right;

                return $this->Research($child_node, $cur); //再帰でさらに右へ潜る
            } else {
                return $cur; //$curに挿入可能ノードの参照を返す
            }
        }
    }
}
