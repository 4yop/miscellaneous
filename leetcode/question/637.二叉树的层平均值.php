<?php

//
// class TreeNode {
//      public $val = null;
//      public $left = null;
//      public $right = null;
//      function __construct($value) { $this->val = $value; }
//  }
require_once "../../learn/data/tree.php";
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
     * @return Float[]
     */
    public $arr = [];
    function averageOfLevels($root) {
        $this->helper($root);
        if ( empty($this->arr) ) {
            return [];
        }
        $res = array_map(function($value){
            return array_sum($value)/count($value);
        },$this->arr);
        return $res;
    }

    function helper($root,int $index = 0) {
        if ( $root === null ) {
            return;
        }
        $this->arr[$index][] = $root->val;
        $this->helper($root->left,$index+1);
        $this->helper($root->right,$index+1);
    }
}





$s = [3,9,20,15,7];
$s = (new BinaryTree())->create($s);
$res = (new Solution())->averageOfLevels($s);

var_dump($res);

