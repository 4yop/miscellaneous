<?php
use leetcode\common\TreeNode;

class Solution {

    /**
     * @param TreeNode $root
     * @param Integer $val
     * @return TreeNode
     */
    function insertIntoBST($root, $val) {
        if ($root === null)
        {
            return new TreeNode($val);
        }
        if ($root->val > $val)
        {
            $root->left = $root->left === null ? new TreeNode($val) : $this->insertIntoBST($root->left,$val);
        }else
        {
            $root->right = $root->right === null ? new TreeNode($val) : $this->insertIntoBST($root->right,$val);
        }
        return $root;
    }
}
