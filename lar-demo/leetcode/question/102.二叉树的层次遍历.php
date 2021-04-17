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
    function levelOrder2($root) {
        if($root == NULL){
            return [];
        }
        $root->index = 0;
        $queue = [$root];
        $res = [];

        while(!empty($queue)){
            $current = array_pop($queue);
            $i = $current->index;
            $res[$i][] = $current->val;
            if($current->left != NULL){
                $current->left->index = $i + 1;
                array_unshift($queue,$current->left);
            }
            if($current->right != NULL){
                $current->right->index = $i + 1;
                array_unshift($queue,$current->right);
            }
        }
        return $res;
    }

    function levelOrder($root){
        if($root === NULL){
            return [];
        }
        $res = [];
        $queue = [$root];
        $level = 0;
        while(!empty($queue)){
            $count = count($queue);

            for($i = 0;$i < $count;$i++){
                $node = array_shift($queue);
                $res[$level][] = $node->val;
                if($node->left !== NULL){
                    $queue[] = $node->left;
                }
                if($node->right !== NULL){
                    $queue[] = $node->right;
                }
            }

            $level++;
        }
        return $res;
    }


    public $res = [];
    function levelOrder1($root){
        $this->re($root);
        return $this->res;
    }
    //递归 recursion
    function re($tree = NULL,$index = 0){
        if($tree === NULL || $tree->val === NULL){
            return;
        }
        if($tree === NULL){
            return;
        }
        $this->res[$index][] = $tree->val;
        $this->re($tree->left,$index+1);
        $this->re($tree->right,$index+1);
    }
}

$arr = [3,9,20,null,null,15,7];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->levelOrder($root);

print_r($res);