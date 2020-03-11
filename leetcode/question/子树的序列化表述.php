<?php

require_once "../../learn/data/tree.php";
class Solution {

    public $sum = 0;
    function serializeTree($root) {
        //return json_encode($root);
       //return  unserialize( serialize($root) );

    }


}

$arr = [1,2,3,4,5,null,6,7,null,null,null,null,8];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->serializeTree($root);

print_r($res);