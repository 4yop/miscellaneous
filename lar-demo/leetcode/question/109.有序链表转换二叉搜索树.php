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
use leetcode\common\{ListNode,TreeNode,Base};

class Solution {

    /**
     * @param ListNode $head
     * @return TreeNode
     */
    function sortedListToBST($head) {
        $fast = $head;
        $slow = $head;
        $tree = null;
        while ($fast !== null )
        {


            $node = new TreeNode($slow->val);
            $node->left = $tree;
            $tree = $node;
            $slow = $slow->next;
            if ($fast->next === null)
            {
                break;
            }else
            {
                $fast = $fast->next->next;
            }
        }
        $temp = $tree;
        while ($slow !== null)
        {
            $temp->right = new TreeNode($slow->val);
            $temp = $temp->right;
            $slow = $slow->next;
        }
        return $tree;
    }



}

$arr = [-10,-3,0,5,9];


$root = Base::buildListNodeByArr($arr);

$res = (new Solution())->sortedListToBST($root);

var_dump($res);
