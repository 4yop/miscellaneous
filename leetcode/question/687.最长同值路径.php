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
     * @param TreeNode $root
     * @return Integer[][]
     */
    public $res = 0;
    function longestUnivaluePath($root) {
        if($root === NULL){
            return 0;
        }
        $this->helper($root->val);
        return $this->res;
    }

    public function helper($root,$num=0){
        if($num > $this->res){
            $this->res = $num;
        }
        if($root->left === NULL && $root->right === NULL){
            return;
        }

        if($root->left !== NULL){
            $n1 = $root->left->val == $root->val ? ($num + 1) : 0;
            $this->helper($root->left,$n1);
        }

        if($root->right !== NULL){
            $n2 = $root->right->val == $root->val ? ($num + 1) : 0;
            $this->helper($root->right,$n2);
        }
    }

}

$arr = [5,4,5,1,1,5];

$tree = new BinaryTree();
$root = $tree->create($arr);
print_r($root);
$res = (new Solution())->longestUnivaluePath($root);


var_dump($res);