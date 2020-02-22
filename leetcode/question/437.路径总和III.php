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

}

$arr = [5,4,8,11,null,13,4,7,2,5,1];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->pathSum($root,22);


var_dump($res);