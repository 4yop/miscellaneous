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
     * @return TreeNode
     */
    function flatten($root) {
        $this->helper($root);
        return $this->helper1($root);
    }

    function helper($root)
    {
        if ($root === null)
        {
            return null;
        }
        if ($root->left !=null && $root->left->left != null)
        {
            $this->helper($root->left);
        }else
        {


            $right = $root->right;
            $left = $root->left;
            $root->right = $left;
            if ($root->right !== null) {
                $root->right->right = $right;
            }
            $root->left = null;
        }
    }

    function helper1($root)
    {
        if ($root === null || $root->left === null)
        {
            return $root;
        }

        $left = $root->left;
        $right = $root->right;

        $temp = $root;
        $temp->right = $left;
        $temp->left = null;
        while ($temp->right != null )
        {
            $temp = $temp->right;
        }
        $temp->right = $right;
        return $root;
    }

}
$arr =  [1,null,2];
$b = new Base();
$root = $b->buildTreeNodeByArr($arr);



$res = (new Solution())->flatten($root);

print_r($res);
