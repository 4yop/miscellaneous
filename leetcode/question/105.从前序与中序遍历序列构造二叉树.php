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
     * @param $preorder 前序
     * @param $inorder 中序
     */
    public $res =NULL;
    function buildTree($preorder, $inorder) {
        if(empty($preorder)){
            return NULL;
        }
        //如果 左边没有  p[0] = i[0]
        //如果 右边没有  p[0] = i[end]
       $this->res = new TreeNode($preorder[0]);
    }


}

$arr = [];

$tree = new BinaryTree();
$root = $tree->create($arr);
/**
 *    1
 *  2   3
 * 4 5 6 7
 *
 */
$preorder = [1,2,3,4,5,6,7];
$inorder = [4,2,5,1,6,3,7];
$res = (new Solution())->buildTree($preorder,$inorder);

print_r($res);