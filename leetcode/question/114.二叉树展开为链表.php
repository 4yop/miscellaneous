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
 class ListNode {
      public $val = null;
      public $left = null;
      public $right = null;
      function __construct($value) { $this->val = $value; }
 }
require_once "../../learn/data/tree.php";
class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function flatten($root) {
        $head = new TreeNode(-1);
        $this->curr = $head;
        $this->helper($root);
        return $head->right;
    }

    function helper($root){
        if($root === null) return;
        $this->curr->left = null;
        $this->curr->right = new TreeNode($root->val);
        $this->curr = $this->curr->right;
        $this->helper($root->left);
        $this->helper($root->right);
    }
}
$arr = [1,2,5,3,4,6];
$tree = new BinaryTree();
$root = $tree->create($arr);

print_r($root);

$res = (new Solution())->flatten($root);

print_r($res);