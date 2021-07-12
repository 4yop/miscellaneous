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



    public $data = [];
    function inorderTraversal1($root) {
        if ($root === null)
        {
            return $this->data;
        }
        $this->inorderTraversal($root->left);
        $this->data[] = $root->val;
        $this->inorderTraversal($root->right);
        return $this->data;
    }
}

$arr = [1,2,3,4,5,6,NULL];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->inorderTraversal1($root);

print_r($res);
