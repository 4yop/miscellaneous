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
     * @return TreeNode
     */
    //递归
    public $sum = 0;
    function convertBST($root) {
        if ($root === null) {
            return $root;
        }

        if ($root->right !== null) {
            $this->convertBST($root->right);
        }
        $val = $root->val;
        $root->val = $this->sum + $val;
        $this->sum += $val;
        if ($root->left !== null) {
            $this->convertBST($root->left);
        }

        return $root;
    }

    //迭代
    public function convertBST1 ($root) {
        $stack = [];
        $node = $root;
        $sum = 0;
        while (!empty($stack) || $node !== null) {

            while ($node !== null) {
                array_push($stack,$node);
                $node = $node->right;
            }

            $node = array_pop($stack);
            $val = $node->val;

            $node->val = $val + $sum;

            $sum += $val;
            $node = $node->left;
        }
        return $root;
    }
}

$arr = [5,2,13,1,3,10,14];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->convertBST1($root);

print_r($res);