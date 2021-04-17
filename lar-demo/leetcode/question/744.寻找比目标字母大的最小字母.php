<?php






class Solution {

    /**
     * @param String[] $letters
     * @param String $target
     * @return String
     */
    function nextGreatestLetter($letters, $target) {
        $left = 0;
        $right = count($letters) - 1;
        while($left <= $right){
            $mid = $left + (int)( ($right - $left) /2 );

            if($target == $letters[$left]){
                return  $left + 1 >=  count($letters) ?  $letters[0] :  $letters[$left + 1];
            }elseif($target < $letters[$left]){
                return $letters[$left];
            }elseif($target > $letters[$mid]){
                $left = $mid + 1;
            }else{
                $right = $mid - 1;
            }
        }
        return  $left >=  count($letters) ?  $letters[0] :  $letters[$left];
    }
}

$so = new Solution();
$res = $so->nextGreatestLetter(["c", "f", "j"],"c");
print_r($res);