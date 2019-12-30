<?php

//
// class TreeNode {
//      public $val = null;
//      public $left = null;
//      public $right = null;
//      function __construct($value) { $this->val = $value; }
//  }
require_once "../../../learn/data/tree.php";
class Solution {


    function isValidBST($root) {
        $queue = [$root];

        while(!empty($queue)){
            $current = array_pop($queue);



            if($current->left !== NULL){

                if($current->val <= $current->left->val){
                    return false;
                }

                array_unshift($queue,$current->left);
            }
            if($current->right !== NULL){

                if($current->val >= $current->right->val){
                    return false;
                }

                array_unshift($queue,$current->right);
            }



        }
        return true;
    }
}




$arr = [5,1,4,null,null,3,6];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->isValidBST($root);

var_dump($res);

