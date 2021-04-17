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
        $res = new TreeNode($root->val);
        $curr = $res;
        $queue = [];
        if ($root->left !== null) {
            array_push($queue,$root->left);
        }
        if ($root->right !== null) {
            array_push($queue,$root->right);
        }

        while (!empty($queue)) {
            $node = array_shift($queue);

            $curr->right = $node;
            $curr->left = null;

            if ($node->left !== null) {
                array_push($queue,$node->left);
            }
            if ($node->right !== null) {
                array_push($queue,$node->right);
            }

        }
        return $res;
    }


}
$arr = [1,2,5,3,4,6];
$tree = new BinaryTree();
$root = $tree->create($arr);

print_r($root);

$res = (new Solution())->flatten($root);

print_r($res);