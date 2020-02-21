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

    /**每个节点的高度差不超过一就是平衡二叉树
     * @param $root
     */
    public $leftDepth = 0;
    public $rightDepth = 0;
    function isBalanced($root) {
        if($root == NULL){
            return true;
        }

        $queue = [$root];

        while(!empty($queue)){
            $curr = array_shift($queue);
            //return $curr->left;
            $left = $curr->left;
            $right = $curr->right;
            $leftDepth = $this->maxDepth($curr->left);


            print_r($curr->right);exit;
            $rightDepth = $this->maxDepth($curr->right);



            if(abs($leftDepth -$rightDepth) > 1){
                return false;
            }
            if($left !== NULL){
                $queue[] = $left;
            }
            if($right !== NULL){
                $queue[] = $right;
            }
        }
        return true;
    }


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
}


$arr = [1,null,2,null,3];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->isBalanced($root);

var_dump($res);