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
 class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($value) { $this->val = $value; }
 }
class Solution {

    /**
     * @param $preorder 前序
     * @param $inorder 中序
     */

    function buildTree($preorder, $inorder) {
        if (count($preorder) == 0) {
            return null;
        }
        $root = new TreeNode($preorder[0]);
        $stk = [];
        array_push($stk,$root);
        $inorderIndex = 0;
        for ($i = 0;$i < count($preorder);++$i) {
            $preorderVal = $preorder[$i];
            $node = array_shift($stk);
            if ($node->val != $inorder[$inorderIndex]) {
                $node->left = new TreeNode($preorderVal);
                array_push($stk,$node->left);
            }
            else{
                while (!empty($stk) && array_shift($stk)->val == $inorder[$inorderIndex]) {
                    $node = array_shift($stk);
                    array_pop($stk);
                    ++$inorderIndex;
                } //end while
                $node->right = new TreeNode($preorderVal);
                array_push($stk,$node->right);
            }//end if
        }//end for
        return $root;
    }//end  buildTree()


}



/**
 *    1
 *  2   3
 * 4 5 6 7
 *
 */
$preorder = [3,9,20,15,7];
$inorder =  [9,3,15,20,7];

$res = (new Solution())->buildTree($preorder,$inorder);

print_r($res);