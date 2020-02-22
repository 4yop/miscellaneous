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

    public $res = [];
    function kthSmallest($root, $k) {
        if($root == NULL){
            return;
        }
        $this->helper($root);
        sort($this->res);
        return $this->res[$k-1];
    }

    public function helper($root = NULL){
        if($root == NULL || $root->val === NULL){
            return;
        }
        $this->res[] = $root->val;
        $this->helper($root->left);
        $this->helper($root->right);
    }
    
}

$arr =  [5,3,6,2,4,null,null,1];

$tree = new BinaryTree();
$root = $tree->create($arr);
/**
 *    1
 *  2   3
 * 4 5 6 7
 *
 */

$res = (new Solution())->kthSmallest($root,3);

print_r($res);