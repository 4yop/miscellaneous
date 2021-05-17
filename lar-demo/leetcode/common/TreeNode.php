<?php


namespace leetcode\common;


class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;
    public function __construct($value = null,$left = null, $right = null)
    {
        $this->val = $value;
        $this->left = $left;
        $this->right = $right;
    }


}
