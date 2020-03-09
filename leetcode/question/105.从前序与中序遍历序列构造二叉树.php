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

        $val = array_shift($preorder);
        $res = new TreeNode($val);
        $queue = [$res];

        $index = array_search($val,$inorder);
        $left = array_splice($inorder,0,$index);
        $right = array_splice($inorder,$index+1);
        $que2 = [$left,$right];
        while(!empty($preorder)){


            $node = array_shift($queue);
            if($node === NULL){
                continue;
            }
            $val = array_shift($preorder);
            $left = array_shift($que2);
            if(empty($left) ){
                $node->left = NULL;
            }else{
                $node->left = new TreeNode($val);

                $index = array_search($val,$left);
                $l = array_splice($left,0,$index);
                $r = array_splice($left,$index+1);
                array_push($que2,$l,$r);

            }
            $queue[] = $node->left;

            if(!empty($preorder)){

                $val = array_shift($preorder);
                $right = array_shift($que2);

                if(empty($right) ){
                    $node->right = NULL;
                }else{
                    $node->right = new TreeNode($val);

                    $index = array_search($val,$right);
                    $l = array_splice($right,0,$index);
                    $r = array_splice($right,$index+1);
                    array_push($que2,$l,$r);

                }
                $queue[] = $node->right;
            }

        }

        return $res;

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