<?php

include '../common/base.php';
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxSumBST($root) {
        $this->last = PHP_INT_MIN;
        $this->isValidBST($root);
        return $this->res;
    }

    public $res = 0;
    function isValidBST($root)
    {
        if ($root === null)
        {
            return true;
        }

        $root->is_bst = true;

        if ( !$this->isValidBST($root->left) && $root->left->is_bst == false) {

            $root->is_bst = false;
        }


        if ($this->last >= $root->val) {
            $root->is_bst = false;
        }

        $this->last = $root->val;
        if ( !$this->isValidBST($root->right) && $root->left->is_bst == false) {
            $root->is_bst = false;
        }

        $root->sum = $root->val + intval($root->left->sum) + intval($root->right->sum);

        if ($root->is_bst == true) {
            $this->res = max($this->res,$root->sum);
        }

        echo $root->val.":".($root->is_bst?'true':'false')."\n";

    }
}


$s = new Solution();
$arr = [4,3,null,1,2];
$root = buildTreeNodeByArr($arr);

$r = $s->maxSumBST($root);
var_dump($r);