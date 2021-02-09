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
     * @return Boolean
     */
    public $arr = [];
    function isEvenOddTree($root)
    {
        return $this->helper($root);
    }

    function helper($root,$level = 0)
    {
        if ($root === null || $root->val === null)
        {
            return true;
        }


        if ($root->val % 2 == $level % 2)
        {
            print_r(['val'=>$root->val,'level'=>$level,'line'=>__LINE__]);
            return false;
        }

        if (isset($this->arr[$level])) {
            if (count($this->arr[$level]) > $level + 1)
            {
                print_r(['val'=>$root->val,'level'=>$level,'line'=>__LINE__]);
                return false;
            }
            $end = end($this->arr[$level]);
            if ($level % 2 == 0)
            {
                if ($root->val <= $end)
                {
                    print_r(['val'=>$root->val,'level'=>$level,'line'=>__LINE__]);
                    return false;
                }
            }else
            {
                if ($root->val >= $end)
                {
                    print_r(['val'=>$root->val,'level'=>$level,'line'=>__LINE__]);
                    return false;
                }
            }
        }else{
            $this->arr[$level][] = $root->val;
        }





        if (
            !$this->helper($root->left,$level + 1)
            || !$this->helper($root->right,$level + 1)
        )
        {
            print_r(['val'=>$root->val,'level'=>$level,'line'=>__LINE__]);
            return false;
        }




//        if (count($this->arr[$level]) <= $level + 1)
//        {
//            return false;
//        }
        return true;

    }
}

$arr =  [1,10,4,3,null,7,9,12,8,6,null,null,2];

$tree = new BinaryTree();
$root = $tree->create($arr);


$res = (new Solution())->isEvenOddTree($root);

var_dump($res);