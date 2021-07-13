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
use leetcode\common\{TreeNode,Base};
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


    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    public $res = [];
    function levelOrder1($root,$level=0) {
        if ($root === null)
        {
            return $this->res;
        }
        $this->res[$level][] = $root->val;
        $this->levelOrder1($root->left,$level+1);
        $this->levelOrder1($root->right,$level+1);
        return $this->res;
    }
}

$arr = [3,9,20,null,null,15,7];

$tree = new Base();
$root = $tree->buildTreeNodeByArr($arr);

$res = (new Solution())->levelOrder($root);

print_r($res);
