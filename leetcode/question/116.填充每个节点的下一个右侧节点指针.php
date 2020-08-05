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
    //递归
    public $temp = [];
    public function connect($root) {

        $this->helper($root);
        return $root;
    }

    public function helper($root,$level = 0) {
        $next = array_key_exists($level,$this->temp) ? $this->temp[$level] : null;
        $this->temp[$level] = $root;
        $root->next = $next;
        if ($root->right !== null) {
            $this->helper($root->right,$level + 1);
        }
        if ($root->left !== null) {
            $this->helper($root->left,$level + 1);
        }
    }


    
}
$arr = [1,2,5,3,4,6];
$tree = new BinaryTree();
$root = $tree->create($arr);

print_r($root);

$res = (new Solution())->flatten($root);

print_r($res);