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

    function postorderTraversal($root) {
        $res = [];
        if($root === NULL){
            return $res;
        }
        $stack = [$root];

        while(!empty($stack)){
            $node = array_pop($stack);
            array_unshift($res,$node->val);
            if($node->left !== NULL){
                $stack[] = $node->left;
            }
            if($node->right !== NULL){
                $stack[] = $node->right;
            }
        }
        return $res;
    }


}

$arr = [1,2,3,4,5,6,7];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->postorderTraversal($root);

print_r($res);