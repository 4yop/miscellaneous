<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
require_once "../../learn/data/tree.php";
class Solution {

    /**
     * @param TreeNode $root
     * @param Integer $sum
     * @return Integer[][]
     */
    public $res = [];
    //递归
    function pathSum($root, $sum) {
        $this->helper($root,$sum);
        return $this->res;
    }

    function helper ($root,$sum,$arr = []) {
        if ($root === null) {
            return ;
        }
        $sum -= $root->val;
        $arr[] = $root->val;
        if ($root->left === null && $root->right === null && $sum == 0) {
            $this->res[] = $arr;
            return ;
        }
        $this->helper($root->left,$sum,$arr);
        $this->helper($root->right,$sum,$arr);

    }
    
}

$arr = [5,4,8,11,null,13,4,7,2,5,1];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->pathSum($root,22);


var_dump($res);