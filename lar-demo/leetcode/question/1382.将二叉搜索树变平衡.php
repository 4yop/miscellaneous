<?php

require_once '../common/base.php';
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
     * @param TreeNode $root
     * @return TreeNode
     */
    public $arr = [];
    function balanceBST($root) {
        $this->inorder_traversal($root);

        return $this->build_tree(0,count($this->arr));
    }
    //中序遍历
    function inorder_traversal($root)
    {
        if ($root === null)
        {
            return;
        }
        if ($root->left !== null) {
            $this->inorder_traversal($root->left);
        }
        $this->arr[] = $root->val;
        if ($root->right !== null) {
            $this->inorder_traversal($root->right);
        }
    }

    //二分查找 遍历
    function build_tree($left,$right)
    {
        $mid =floor(($right-$left)/2)+$left;;

        if (!isset($this->arr[$mid]))
        {
            return;
        }

        $treeNode = new TreeNode($this->arr[$mid]);

        if ($mid > $left)
        {
            $treeNode->left = $this->build_tree($left,$mid-1);
        }
        if ($mid < $right)
        {
            $treeNode->right = $this->build_tree($mid+1,$right);
        }
        return $treeNode;
    }

}


$so = new Solution();
$root = buildTreeNodeByArr([1,null,2,null,3,null,4,null,null]);
$res = $so->balanceBST($root);
print_r($res);