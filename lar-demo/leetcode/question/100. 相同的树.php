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
class Solution {

    /**
     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */

    function isSameTree($p, $q) {
        if($p === NULL && $q === NULL){
            return true;
        }
        if($p->val !== $q->val){
            return false;
        }
        return $this->isSameTree($p->left,$q->left) && $this->isSameTree($p->right,$q->right);
    }
}