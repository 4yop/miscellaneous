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

    function isValidBST($root) {
        return $this->helper($root,NULL,NULL);
    }

    function helper($root,$lower,$upper){
        if($root === NULL){
            return true;
        }
        $val = $root->val;
        //如果最小值不为空，就是在判断右子节点和父节点比较
        if($lower !== NULL && $val <= $lower){
            return false;
        }
        //如果最大值不为空，就是在判断左子节点和父节点比较
        if($upper !== NULL && $val >= $upper){
            return false;
        }
        if(!$this->helper($root->right,$val,$upper)){
            return false;
        }
        if(!$this->helper($root->left,$lower,$val)){
            return false;
        }
        return true;
    }

    //中序遍历为升序
    function isValidBST($root) {
        if ($root === null)
        {
            return true;
        }
        $this->last = PHP_INT_MIN;
        return $this->helper($root);
    }

    function helper($root)
    {
        if ($root === null)
        {
            return true;
        }



        if ( !$this->helper($root->left) ) {
            return false;
        }

        if ($this->last >= $root->val) {
            return false;
        }

        $this->last = $root->val;
        if ( !$this->helper($root->right) ) {
            return false;
        }
        return true;

    }


}

$arr = [1,1];
$root = (new BinaryTree())->create($arr);


$res = (new Solution())->isValidBST($root);

var_dump($res);
