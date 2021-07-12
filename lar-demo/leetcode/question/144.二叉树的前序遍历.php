<?php


class Solution {

    //递归
    public $data = [];
    function preorderTraversal1($root) {
        if ($root === null)
        {
            return $this->data;
        }
        $this->data[] = $root->val;
        $this->preorderTraversal($root->left);
        $this->preorderTraversal($root->right);
        return $this->data;
    }

    //迭代
    function preorderTraversal($root) {
        if ($root === null) {
            return [];
        }
        $stack = [$root];
        $res = [];
        while (!empty($stack)) {
            $curr = array_shift($stack);
            array_push($res,$curr->val);

            if ($curr->right !== null) {
                array_unshift($stack,$curr->right);
            }
            if ($curr->left !== null) {
                array_unshift($stack,$curr->left);
            }
        }
        return $res;
    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->preorderTraversal($root);

echo $res;

