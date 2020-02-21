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
     * @return Integer[][]
     */
    public $sum = 0;
    function hasPathSum($root, $sum) {
        if($root === NULL || ( $root->val >= $sum && ($root->left !== NULL || $root->right !== NULL) ) ){
            return false;
        }
        if($root->val >= $sum && $root->left === NULL && $root->right === NULL){
            return true;
        }
        $this->sum = $sum;
        return $this->helper($root);
    }

    /**
     * @param TreeNode|NULL $curr
     * @param int $currSum 当前和
     * @return bool|void
     */
    function helper(TreeNode $curr = NULL,$currSum = 0){
        if($curr === NULL || $curr->val === NULL){
            return;
        }
        $currSum += $curr->val;
        if($currSum === $this->sum){
            return true;
        }
        if($this->helper($curr->left,$currSum) === true){
            return true;
        }
        if($this->helper($curr->right,$currSum) === true){
            return true;
        }
        return false;
    }
}

$arr = [1,2];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->hasPathSum($root,1);


var_dump($res);