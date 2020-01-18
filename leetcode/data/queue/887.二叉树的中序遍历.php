<?php

require_once "../../../learn/data/tree.php";

class Solution {
    function inorderTraversal($root) {
        if($root == NULL){
            return ;
        }
        echo $root->val;
        $this->inorderTraversal($root->left);
        $this->inorderTraversal($root->right);
    }


}


$arr = ['A','B','C','D','E','F'];


$root = (new BinaryTree())->create($arr);

$res = (new Solution())->inorderTraversal($root);

var_dump($res);
