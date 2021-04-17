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


    //迭代
    function isSubtree($s, $t) {
        if($t === NULL){
            return true;
        }
        $val = $t->val;
        $t = serialize($t);
        $queue = [$s];
        while(!empty($queue)){
            $node = array_shift($queue);
            if($node->val == $val && serialize($node) == $t){
                return true;
            }
            if($node->left !== NULL){
                $queue[] = $node->left;
            }
            if($node->right !== NULL){
                $queue[] = $node->right;
            }
        }
        return false;
    }
    //递归
    function isSubtree1($s, $t) {
        if($t === NULL){
            return true;
        }

        if(serialize($s) == serialize($t)){
            return true;
        }

        return ($s->left !== NULL && $this->isSubtree1($s->left,$t) ) || ($s->right !== NULL && $this->isSubtree1($s->right,$t) );
    }
}






$s = [4,1,2];
$t = [4,1,2];
$s = (new BinaryTree())->create($s);
$t = (new BinaryTree())->create($t);
$res = (new Solution())->isSubtree1($s,$t);

var_dump($res);

