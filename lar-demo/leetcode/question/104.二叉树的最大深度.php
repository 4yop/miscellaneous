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
    function maxDepth($root) {
        if($root == NULL){
            return 0;
        }
        $root->depth = 1;
        $queue = [$root];
        $depth = 0;
        while(!empty($queue)){
            $current = array_pop($queue);
            $currentDepth = $current->depth;//当前深度
            if($depth < $currentDepth){
                $depth = $currentDepth;
            }
            if($current->left !== NULL){
                $current->left->depth = $currentDepth+1;
                array_unshift($queue,$current->left);
            }
            if($current->right !== NULL){
                $current->right->depth = $currentDepth+1;
                array_unshift($queue,$current->right);
            }

        }


        return $depth;
    }

    public $depth = 0;
    function maxDepth1($root){
        $this->re($root);
        return $this->depth;
    }
    //递归 recursion
    function re($tree = NULL,$depth = 1){
        if($tree === NULL ){
            return;
        }
        if($this->depth < $depth){
            $this->depth = $depth;
        }
        $this->re($tree->left,$depth+1);
        $this->re($tree->right,$depth+1);
    }
}

$arr = [3,9,20,null,null,15,7];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->maxDepth1($root);

print_r($res);