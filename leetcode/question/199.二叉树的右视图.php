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
     * @param TreeNode $t1
     * @param TreeNode $t2
     * @return TreeNode
     */
    function rightSideView($root) {

        $queue = [ [$root] ];
        $res = [];
        while (!empty($queue))
        {
            $node = array_shift($queue);
            $res[] = end($node)->val;
            $arr = [];
            foreach ($node as $value)
            {
                if ($value->left !== null)
                {
                    $arr[] = $value->left;
                }
                if ($value->right !== null)
                {
                    $arr[] = $value->right;
                }
            }
            if (!empty($arr))
            {
                $queue[] = $arr;
            }

        }
        return $res;
    }
    public $res = [];
    function rightSideView1($root){
        $this->helper($root);
        return $this->res;
    }

    function helper($root,$index = 0){
        if(!array_key_exists($index,$this->res)){
            $this->res[$index] = $root->val;
        }
        if($root->right !== null) {
            $this->helper($root->right, $index + 1);
        }
        if($root->left !== null) {
            $this->helper($root->left, $index + 1);
        }
    }
}

$arr = [1,2,3,null,5,null,4];

$tree = new BinaryTree();
$root = $tree->create($arr);
/**
 *    1
 *  2   3
 * 4 5 6 7
 *
 */

$res = (new Solution())->rightSideView($root);

print_r($res);