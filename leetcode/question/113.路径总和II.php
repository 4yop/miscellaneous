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
    public $res = [];
    function pathSum($root, $sum) {
        if($root === NULL){
            return [];
        }
        $this->helper($root,[$root->val],$sum);
        return $this->res;
    }

    function helper($root,$path,$sum){
        if($root->left === NULL && $root->right === NULL){
            if(array_sum($path) == $sum){
                $this->res[] = $path;
            }
            return;
        }
        if($root->left !== NULL){
            $p1 = $path;
            $p1[] = $root->left->val;
            $this->helper($root->left,$p1,$sum);
        }
        if($root->right !== NULL){
            $p2 = $path;
            $p2[] = $root->right->val;
            $this->helper($root->right,$p2,$sum);
        }
    }
}

$arr = [5,4,8,11,null,13,4,7,2,5,1];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->pathSum($root,22);


var_dump($res);