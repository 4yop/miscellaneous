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

    public $maxDepth = -1;
    public $sum = 0;
    function deepestLeavesSum($root) {
        $this->helper($root);
        return $this->sum;
    }

    function helper($root,$depth = 0){
        if($root === NULL){
            return;
        }
        if($depth > $this->maxDepth){
            $this->maxDepth = $depth;
            $this->sum = $root->val;
        }else if($depth == $this->maxDepth){
            $this->sum += $root->val;
        }
        $this->helper($root->left,$depth+1);
        $this->helper($root->right,$depth+1);
    }


}

$arr = [1,2,3,4,5,null,6,7,null,null,null,null,8];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->deepestLeavesSum($root);

print_r($res);