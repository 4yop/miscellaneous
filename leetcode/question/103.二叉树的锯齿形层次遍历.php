<?php

//
// class TreeNode {
//      public $val = null;
//      public $left = null;
//      public $right = null;
//      function __construct($value) { $this->val = $value; }
//  }
require_once "../../learn/data/tree.php";
class Solution {

    //递归
    public $res = [];
    function zigzagLevelOrder($root) {
        $this->helper($root);
        return $this->res;
    }

    function helper(TreeNode $curr = NULL,$key = 0,$flag = true){
        if($curr === NULL || $curr->val === NULL){
            return;
        }
        if($curr === NULL){
            return;
        }
        $this->res[$key][] = $curr->val;
        if($flag){

            $this->helper($curr->right,$key+1,!$flag);
            $this->helper($curr->left,$key+1,!$flag);
        }else{
            $this->helper($curr->left,$key+1,!$flag);
            $this->helper($curr->right,$key+1,!$flag);
        }

    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->zigzagLevelOrder($root);

var_dump($res);

