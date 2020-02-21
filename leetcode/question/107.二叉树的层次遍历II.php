<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/30
 * Time: 10:36
 */
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
     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */

    public $res = [];
    function levelOrderBottom($root) {
        $this->helper($root);
        return $this->res;
    }

    function helper($root,$index = 0){
        if($root === NULL){
            return;
        }
        if(!array_key_exists($index,$this->res)){
            array_unshift($this->res,[]);
        }
        $i = count($this->res) - $index - 1;
        $this->res[$i][] = $root->val;
        $this->helper($root->left,$index+1);
        $this->helper($root->right,$index+1);
    }
}

$arr = [];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->levelOrderBottom($root);

var_dump($res);