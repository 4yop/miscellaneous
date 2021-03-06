<?php

namespace leetcode\common;


use leetcode\common\{TreeNode,ListNode};
class Base
{

    /**根据数组生成二叉树
     * @param array $arr
     * @return TreeNode|null
     */
    public function buildTreeNodeByArr(array $arr = [])
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
    public static function buildListNodeByArr(array $head = [])
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

    /**链表转数组
     * @param ListNode|null $head
     * @return array
     */
    public static function listNodetoArr(ListNode|null $head):array
    {
        $arr = [];
        $node = $head;
        while ($node !== null)
        {
            $arr[] = $node->val;
            $node = $node->next;
        }
        return $arr;
    }

    /**链表转json
     * @param ListNode|null $head
     * @return string|bool
     */
    public static function listNodetoJson(ListNode|null $head):string|bool
    {
        $arr = self::listNodetoArr($head);
        return json_encode($arr);
    }

}






