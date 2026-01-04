<?php

declare(strict_types=1);


//下記はChatgptに生成してもらったbst.phpのテストコードです。

// 1) あなたの最終コードを読み込む（ファイル名は適宜合わせてください）
require_once __DIR__ . '/bst.php';

/**
 * ===== テスト用ユーティリティ =====
 */

// inorder（中間順巡回）で値を配列にする：BSTなら昇順になる
function inorder(?Node $node, array &$out): void
{
    if ($node === null) return;
    inorder($node->left, $out);
    $out[] = $node->value;
    inorder($node->right, $out);
}

function inorderList(Tree $t): array
{
    $out = [];
    inorder($t->root, $out);
    return $out;
}

// BST条件検証：min < node < max を再帰で確認（重複を入れない仕様に対応）
function isValidBST(?Node $node, ?int $min = null, ?int $max = null): bool
{
    if ($node === null) return true;

    if ($min !== null && $node->value <= $min) return false;
    if ($max !== null && $node->value >= $max) return false;

    return isValidBST($node->left, $min, $node->value)
        && isValidBST($node->right, $node->value, $max);
}

// ある値が木にあるか（テスト側で実装。Treeにcontainsが無くても検証できる）
function contains(Tree $t, int $value): bool
{
    $cur = $t->root;
    while ($cur !== null) {
        if ($value === $cur->value) return true;
        $cur = ($value < $cur->value) ? $cur->left : $cur->right;
    }
    return false;
}

// 簡易アサーション
function assertTrue(bool $cond, string $msg): void
{
    if (!$cond) {
        throw new RuntimeException("ASSERT FAILED: {$msg}");
    }
}

function assertSameArray(array $actual, array $expected, string $msg): void
{
    if ($actual !== $expected) {
        throw new RuntimeException(
            "ASSERT FAILED: {$msg}\nExpected: " . json_encode($expected) . "\nActual:   " . json_encode($actual)
        );
    }
}

/**
 * ===== テスト本体 =====
 */
function runTests(): void
{
    // ---- 1) あなたの入力と同じ配列でテスト ----
    $test_array = [2, 5, 1, 6, 7, 11, 5, 2, 4, 6];
    $tree = new Tree($test_array);

    // inorderが昇順＋重複排除になっていることを確認
    $in = inorderList($tree);

    $expected = $test_array;
    sort($expected);
    $expected = array_values(array_unique($expected)); // 重複は入らない仕様なのでunique

    assertSameArray($in, $expected, "Inorder should be sorted unique values");

    // BSTの条件を満たすか
    assertTrue(isValidBST($tree->root), "Tree should satisfy BST property");

    // contains テスト
    assertTrue(contains($tree, 1) === true, "contains(1) should be true");
    assertTrue(contains($tree, 11) === true, "contains(11) should be true");
    assertTrue(contains($tree, 999) === false, "contains(999) should be false");

    // ---- 2) 空配列でも落ちないこと ----
    $empty = new Tree([]);
    assertTrue($empty->root === null, "Empty tree should have null root");
    assertSameArray(inorderList($empty), [], "Inorder of empty tree should be []");
    assertTrue(isValidBST($empty->root), "Empty tree should be valid BST");

    // ---- 3) ランダムテスト（複数回） ----
    for ($i = 0; $i < 10; $i++) {
        $arr = [];
        for ($j = 0; $j < 30; $j++) {
            $arr[] = random_int(0, 50);
        }
        $t = new Tree($arr);

        $in = inorderList($t);
        $expected = $arr;
        sort($expected);
        $expected = array_values(array_unique($expected));

        assertSameArray($in, $expected, "Random test #{$i}: inorder should match sorted unique");
        assertTrue(isValidBST($t->root), "Random test #{$i}: should be valid BST");
    }

    echo "ALL TESTS PASSED\n";
}

runTests();
