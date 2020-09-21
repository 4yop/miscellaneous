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
        $stack = [];
        $res = [];
        while ($root !== null || !empty($stack)) {
            while ($root !== null) {
                $stack[] = $root;
                $root = $root->left;
            }
            $root = array_pop($stack);
            $res[] = $root->val;
            $root = $root->right;
        }
        return $res;
    }



    //递归
    public $res = [];
    function inorderTraversal1($root) {
        if ($root === null) {
            return [];
        }
        $this->helper($root);
        return $this->res;
    }

    function helper($root) {
        if ($root->left !== null) {
            $this->helper($root->left);
        }
        $this->res[] = $root->val;
        if ($root->right !== null) {
            $this->helper($root->right);
        }
    }
}

$arr = [1,2,3,4,5,6,NULL];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->inorderTraversal1($root);

print_r($res);