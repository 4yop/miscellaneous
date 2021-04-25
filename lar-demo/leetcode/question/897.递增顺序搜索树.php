<?php
use leetcode\common\{Base,TreeNode};
class Solution {

    /**递归中序遍历+重新创树
     * 时间复杂度:O(n),其中 n 是二叉搜索树的节点总数。
     * 空间复杂度:O(n),其中 n 是二叉搜索树的节点总数。需要长度为 n 的列表保存二叉搜索树的所有节点的值。
     * @param TreeNode $root
     * @return TreeNode
     */
    public $temp;
    function increasingBST($root)
    {
        $res = new TreeNode(-1);
        $this->temp = $res;
        $this->helper($root);
        return $res->right;
    }

    function helper ($root)
    {
        if ($root === null)
        {
            return ;
        }
        $this->helper($root->left);
        $this->temp->right = new TreeNode($root->val);
        $this->temp = $this->temp->right;
        $this->helper($root->right);
    }
}

$arr = [5,3,6,2,4,null,8,1,null,null,null,7,9];
$base = new \leetcode\common\Base();
$root = $base->buildTreeNodeByArr($arr);


$s = new Solution();

$r = $s->increasingBST($root);
var_dump($r);
