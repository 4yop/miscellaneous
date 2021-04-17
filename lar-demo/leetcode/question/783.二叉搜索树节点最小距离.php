<?php
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
use  leetcode\common\Base;
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function minDiffInBST($root) {
        $this->helper($root);
        return $this->res;
    }
    private $res = PHP_INT_MAX;
    private $last_val = PHP_INT_MIN;
    function helper($root)
    {
        if ($root === null)
        {
            return ;
        }
        $this->helper($root->left);

        $cha = $root->val - $this->last_val;
        $this->last_val = $root->val;
        if ($cha < $this->res)
        {
            $this->res = $cha;
        }
        $this->helper($root->right);
    }

}

$root = [4,2,6,1,3];

$root = Base::buildTreeNodeByArr($root);

$s = new Solution();

$r = $s->minDiffInBST($root);

var_dump($r);