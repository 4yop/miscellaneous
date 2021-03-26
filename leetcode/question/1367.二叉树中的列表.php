<?php
require_once '../common/base.php';
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @param TreeNode $root
     * @return Boolean
     */
    public $has = false;
    function isSubPath($head, $root) {
        return $this->helper($head, $root);
    }

    function helper($head, $root)
    {
        if ($root->val != $head->val)
        {
            if ($root->left !== null)
            {
                $this->helper($head,$root->left);
            }
            if ($root->right !== null)
            {
                $this->helper($head,$root->right);
            }
        }

        if ($this->has == true)
        {
            return true;
        }
        if ($root->val == $head->val && $head->next === null)
        {
            return true;
        }
    }

}

$head = buildListNodeByArr([4,2,8]);
$root = buildTreeNodeByArr([1,4,4,null,2,2,null,1,null,6,8,null,null,null,null,1,3]);


$s = new Solution();

$r = $s->isSubPath($head,$root);
var_dump($r);