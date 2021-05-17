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
use leetcode\common\Base;
class Solution {

    /**
     * @param TreeNode $root
     * @param Integer $x
     * @param Integer $y
     * @return Boolean
     */

    public $arr = [];
    function isCousins($root, $x, $y) {
        return $this->helper($root,0,$x,$y);
    }

    function helper($root = null,$depth = 0,$parent_val = null,$x,$y)
    {
        if ($root === null)
        {
            return false;
        }

        $this->arr[$depth][$root->val] = $parent_val;
        if (  isset($this->arr[$depth][$x]) && $this->arr[$depth][$y] )
        {
            var_dump($this->arr[$depth]);
            return true;
        }

        $r1 = $this->helper($root->left,$depth+1,$root->val,$x,$y);
        $r2 = $this->helper($root->right,$depth+1,$root->val,$x,$y);
        if ($r1 == true || $r2 == true)
        {
            return true;
        }
        return false;
    }

}

$root = [1,2,3,null,4,null,5];
$x = 5;
$y = 4;

$root = Base::buildTreeNodeByArr($root);

$res = (new Solution())->isCousins($root,$x,$y);

var_dump($res);
