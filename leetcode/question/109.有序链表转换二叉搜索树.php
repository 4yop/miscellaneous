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
    function sortedArrayToBST($nums)
    {
        return $this->helper($nums,0,count($nums)-1);
    }

    function helper($nums, $left, $right)
    {
        if ($left > $right) {
            return null;
        }
        $mid = $left + floor(($right - $left) / 2);
        $node = new TreeNode($nums[$mid]);
        $node->left = $this->helper($nums,$left,$mid-1);
        $node->right = $this->helper($nums,$mid+1,$right);
        return $node;
    }

}

$arr = [-10,-3,0,5,9];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->isSymmetric1($root);

var_dump($res);