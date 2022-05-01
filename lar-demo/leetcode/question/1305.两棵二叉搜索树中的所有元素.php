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
class Solution {

    /**
     * @param TreeNode $root1
     * @param TreeNode $root2
     * @return Integer[]
     */
    public $res = [];
    function getAllElements($root1, $root2)
    {
        $this->helper($root1,$root2);
    }

    function helper($root1, $root2)
    {
        if ($root1->left != null)
        {
            $this->helper($root1->left,$root2);
        }
        echo $root1->val."\n";
    }

}

$s = new Solution();

$root1 = [2,1,4];
$root2 = [1,0,3];

$root1 = \leetcode\common\Base::buildTreeNodeByArr($root1);
$root2 = \leetcode\common\Base::buildTreeNodeByArr($root2);


var_dump($root1);

$s->getAllElements($root1,$root2);
