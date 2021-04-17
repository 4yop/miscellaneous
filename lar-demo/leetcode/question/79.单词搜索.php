<?php






class Solution {

    /**
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word) {
        if (empty($board) || empty($word))
        {
            return false;
        }
        $start_arr = $this->findStart($board,$word[0]);
        if (empty($start_arr))
        {
            return false;
        }
        $strlen = strlen($word);
        foreach ($start_arr as $position)
        {
            $queue = [$position];
            for($i = 1;$i < $strlen;$i++)
            {
                if (empty($queue)) {
                    break;
                }

                $position = array_shift($queue);
                $near_positions = $this->findNear($board,$position,$word[$i]);
                if (!empty($near_positions)) {
                    if ($i = $strlen - 1)
                    {
                        return true;
                    }
                    $queue = array_merge($queue,$near_positions);
                }
            }
        }

        return false;
    }

    /**找附近的点
     * @param $board
     * @param $position
     * @param $str
     * @return array
     */
    function findNear($board,$position,$str)
    {
        //list($row,$col) = $position;
        $row = $position[0];
        $col = $position[1];

        /**
         * $row + 1 ,$col
         * $row - 1, $col
         * $row , $col + 1
         * $row, $col - 1
         */
        $res = [];
        if ($row + 1 < count($board) && $str === $board[$row+1][$col]) {
            $res[] = [
                0 =>  $row + 1 ,
                1 => $col,
            ];
        }
        if ($row - 1 >= 0 && $str === $board[$row-1][$col]) {
            $res[] = [
                0 =>  $row - 1 ,
                1 => $col,
            ];
        }

        if ($col + 1 < count($board[$row]) && $str === $board[$row][$col+1]) {
            $res[] = [
                0 =>  $row,
                1 => $col + 1,
            ];
        }
        if ($col - 1 >= 0 && $str === $board[$row][$col - 1]) {
            $res[] = [
                0 =>  $row,//
                1 => $col - 1,
            ];
        }
        return $res;
    }

    /**获取起点
     * @param $board
     * @param $str
     * @return array
     */
    function findStart($board,$str)
    {
        $positions = [];

        foreach ($board as $k => $v)
        {
            $count = count($v);
            for ($i = 0;$i < $count;$i++)
            {
                if ($v[$i] == $str)
                {
                    $positions[] = [
                        0 => $k,//row
                        1 => $i,//col
                    ];
                }
            }
        }
        return $positions;
    }

}

$so = new Solution();
$board =
    [
        ["A","B","C","E"],
        ["S","F","C","S"],
        ["A","D","E","E"]
    ];
$word = "ABCB";
$res = $so->exist($board,$word);
var_dump($res);