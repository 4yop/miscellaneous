<?php

include "../base/binary-tree.php";

class Solution {

    public $arr = [];
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function balanceBST($root) {
        $this->LDR($root);
        return $this->build(0,count($this->arr) -1 );
    }

    //中序遍历 获取所有 值 存数组
    function LDR($root)
    {
        if ( $root === null )
        {
            return;
        }
        $this->LDR($root->left);
        $this->arr[] = $root->val;
        $this->LDR($root->right);
    }
    //再将数组里的值，类似二分查找 组成 二叉树
    function build($L,$R)
    {
        if ($L == $R)
        {
            return new TreeNode($L);
        }
        if ($L > $R)
        {
            return null;
        }
        $mid=floor(($R-$L)/2)+$L;
        $curr = new TreeNode($this->arr[$mid]);

        $curr->left = $this->build($L,$mid - 1);


        $curr->right = $this->build($mid + 1,$R);

        return $curr;
    }

}


$root = deserialize([1,null,2,null,3,null,4,null,null]);
$s = new Solution();
$r = $s->balanceBST($root);

var_dump($r);
