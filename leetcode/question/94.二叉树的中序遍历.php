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
    function inorderTraversal($root) {
        $res = [];
        $stack = [];
        $curr = $root;
        while( ($curr->val !== NULL && $curr !== NULL) || !empty($stack) ){
            while($curr->val !== NULL && $curr !== NULL){
                array_push($stack,$curr);
                $curr = $curr->left;
            }

            $curr = array_pop($stack);
            $res[] = $curr->val;
            $curr = $curr->right;
        }
        return $res;
    }

    public $res = [];
    public $stack = [];
    function inorderTraversal1($root){
        $this->re($root);
        return $this->res;
    }
    //递归 recursion
    function re($curr = NULL){
        if($curr !== NULL){
            if($curr->left !== NULL){
                $this->re($curr->left);
            }
            $this->res[] = $curr->val;
            if($curr->right !== NULL){
                $this->re($curr->right);
            }
        }

    }
}

$arr = [1,2,3,4,5,6,NULL];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->inorderTraversal1($root);

print_r($res);