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
class Solution {

    /**
     * @param TreeNode $root
     * @param Integer $k
     * @return Boolean
     */
    function findTarget($root, $k) {
        $cha = [];
        $queue = [$root];
        while(!empty($queue)){
            $node = array_shift($queue);
            if(isset($cha[$node->val])){
                return true;
            }
            $cha[$k - $node->val] = 1;
            if($node->left !== null){
                $queue[] = $node->left;
            }
            if($node->right !== null){
                $queue[] = $node->right;
            }
        }
        return false;
    }
}