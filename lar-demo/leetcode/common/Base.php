<?php

namespace leetcode\common;


use leetcode\common\{TreeNode,ListNode};
class Base
{

    /**根据数组生成二叉树
     * @param array $arr
     * @return TreeNode|null
     */
    public static function buildTreeNodeByArr(array $arr = [])
    {
        if ($arr[0] === null)
        {
            return null;
        }
        $treeNode = new TreeNode($arr[0]);
        $queue = [$treeNode];
        $i = 1;
        while (!empty($queue) && $i < count($arr))
        {
            $curr = array_shift($queue);

            if ($arr[$i] !== null)
            {
                $curr->left = new TreeNode($arr[$i]);
                $queue[] = $curr->left;
            }
            $i++;

            if ($arr[$i] !== null)
            {
                $curr->right = new TreeNode($arr[$i]);
                $queue[] = $curr->right;
            }
            $i++;
        }
        return $treeNode;
    }


    /**根据数组生成链表
     * @param array $head
     * @return \leetcode\common\ListNode|null
     */
    function buildListNodeByArr(array $head = [])
    {
        if ($head[0] === null) {
            return null;
        }
        $node = new ListNode($head[0]);
        $current = $node;
        $i = 1;
        while($i < count($head)){
            $val = $head[$i++];
            $current->next = new ListNode($val);
            $current = $current->next;
        }
        return $node;
    }
}






