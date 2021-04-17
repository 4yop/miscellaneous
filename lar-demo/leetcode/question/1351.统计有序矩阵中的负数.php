<?php






class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function countNegatives($grid) {
        $res = 0;
        foreach($grid as $arr){
            $res += $this->search($arr);
        }
        return $res;
    }

    function search($arr){
        $left = 0;
        $right = count($arr) - 1;

        while($left < $right){
            $mid = (int)(($left+$right)/2);
            echo "l:$left,r:$right,m:$mid\n";
            if($arr[$mid] >= 0){
                if($arr[$mid+1] < 0){
                    return count($arr) - $mid - 1;
                }
                $left = $mid + 1;
            }else{
                if($mid == 0){
                    return count($arr) - $mid;
                }
                $right = $mid - 1;
            }
        }

        return 0;
    }

}

$so = new Solution();
$nums =    [[4,3,2,-1],[3,2,1,-1],[1,1,-1,-2],[-1,-1,-2,-3]];
$val = 3;
//$res = $so->countNegatives($nums);
$res = $so->search([-1,-1,-2,-3]);
print_r($res);