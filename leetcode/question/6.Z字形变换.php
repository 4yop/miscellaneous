<?php








class Solution {

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        $arr = [];
        $row = 0;


        $direction = 'down';//方向向上 还是下  down up
        for ($i = 0;$i < strlen($s);$i++) {

            $arr[$row][] = $s[$i];

            if ($row == $numRows-1) {
                $direction = 'up';
            }else if ($row == 0) {
                $direction = 'down';
            }

            if ($direction == 'down') {
                $row++;
            }else {
                $row--;
            }
        }

        foreach ($arr as $k=>$v){
            $arr[$k] = implode('',$v);
        }
        return implode("\n",$arr);
    }

}



$so = new Solution();
$nums = "1a4baa2";
$val = 3;
$res = $so->convert("LEETCODEISHIRING",4);
echo $res;