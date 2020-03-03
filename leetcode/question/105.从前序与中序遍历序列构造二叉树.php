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

    function buildTree($preorder, $inorder) {
        if(empty($preorder)){
            return NULL;
        }
        $val = array_shift($preorder);
        $res = new TreeNode($val);

        $queue = [$res];

        $index = array_search($val,$inorder);

        $left = array_slice($inorder,0,$index);
        $right = array_key_exists($index+1,$inorder)? array_slice($inorder,$index+1) : [];
        $queue2 = [$left,$right];
        while(!empty($preorder)){
            $curr = array_shift($preorder);
            $q = array_shift($queue);

            $left = array_shift($queue2);
            if( empty($left) ){
                $q->left = null;
            }else{
                $q->left = new TreeNode($curr);
                $index = array_search($curr,$left);
                $queue2[] = array_slice($left,0,$index);
                $queue2[] = array_key_exists($index+1,$left)? array_slice($left,$index+1) : [];
                $queue[] = $q;
            }

            $curr = array_shift($preorder);
            $q = array_shift($queue);
            $right = array_shift($queue2);
            if( empty($right) ){
                $q->right = null;
            }else{
                $q->left = new TreeNode($curr);
                $index = array_search($curr,$right);
                $queue2[] = array_slice($right,0,$index);
                $queue2[] = array_key_exists($index+1,$right)? array_slice($right,$index+1) : [];
                $queue[] = $q;
            }

        }
        return $p;




       // $this->helper();

    }

    function helper($inorder){

    }
}

$arr = [];

$tree = new BinaryTree();
$root = $tree->create($arr);

/**
 *    1
 *  2   3
 * null 5 6 7
 *
 */
$preorder = [1,2,3,5,6,7];
$inorder = [2,5,1,6,3,7];
$res = (new Solution())->buildTree($preorder,$inorder);

print_r($res);