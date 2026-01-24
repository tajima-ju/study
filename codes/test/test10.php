 <?php

    function quick_sort($base_array)
    {
        if (count($base_array) < 2)
            return $base_array; //要素が0になるまで繰り返す

        $left_array = [];
        $right_array = [];


        $head_num = array_shift($base_array); //先頭要素を取り出す 

        foreach ($base_array as $num) {
            if ($num <=  $head_num) { //先頭よりも小さい場合
                $left_array[] = $num;
            } else {
                $right_array[] = $num;
            }
        }
        $left = quick_sort($left_array);
        $right = quick_sort($right_array);

        return $new_array = array_merge($left, [$head_num], $right);
    }

    $test_array = [2, 5, 6, 1, 9, 7, 5, 6, 2];

    print_r(quick_sort($test_array));


    //  $left = quick_sort($left_array);
    //  これはfunction quick_sort($base_array)に渡される、しかし
    //  $base_arrayが$left_arrayに置き換わるのではなく、
    //  $left_arrayの中身が$base_arrayに渡される
    // 関数内に$left_arrayが引数として入るのではなく
    // $left_arrayの中身が入っている$base_array
