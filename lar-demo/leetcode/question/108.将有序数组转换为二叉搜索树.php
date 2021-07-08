<?php

use leetcode\common\{TreeNode,Base};

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
     * @param Integer[] $nums
     * @return TreeNode
     */
    function sortedArrayToBST($nums) {
        $mid = floor(count($nums)/2)+1;
        $tree = null;
        for ($i = 0;$i < $mid;$i++)
        {
            $node = new TreeNode($nums[$i]);
            $node->left = $tree;
            $tree = $node;
        }

        $tree1 = null;
        while ($i < count($nums))
        {
            $node = new TreeNode($nums[$i]);
            $node->left = $tree1;
            $tree1 = $node;
            $i++;
        }

        $tree->right = $tree1;
        return $tree;
    }

}

$root = [0,1,2,3,4,5];



$res = (new Solution())->sortedArrayToBST($root);

var_dump($res);
