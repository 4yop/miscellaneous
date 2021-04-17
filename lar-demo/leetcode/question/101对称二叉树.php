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
    function isSymmetric($root) {
        return $this->helper($root->left,$root->right);
    }
    //递归
    function helper(TreeNode $one = NULL,TreeNode $two = NULL){
        if($one === NULL && $two === NULL){
            return true;
        }
        if($one->val !== $two->val){
            return false;
        }

        if(!$this->helper($one->left,$two->right)){
            return false;
        }

        if(!$this->helper($one->right,$two->left)){
            return false;
        }
        return true;
    }
    //迭代
    function isSymmetric1($root) {
        if($root === NULL){
            return true;
        }
        $queue = [];
        array_unshift($queue,$root->left,$root->right);

        while(!empty($queue)){
            $one = array_shift($queue);
            $two = array_shift($queue);

            if($one === NULL && $two === NULL){
                continue;
            }
            if($one->val !== $two->val){
                return false;
            }
            array_unshift($queue,$one->left,$two->right,$one->right,$two->left);
        }
        return true;
    }
}

$arr = [1,2,2,3,4,4,3];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->isSymmetric1($root);

var_dump($res);