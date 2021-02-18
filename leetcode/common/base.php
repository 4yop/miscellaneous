<?php

    class ListNode {
        public $val = 0;
        public $next = null;
        function __construct($val) { $this->val = $val; }
    }
    //通过数组生成链表
    function buildListNodeByArr($head = [])
    {
        if (empty($head)) {
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

    /**
     * Definition for a binary tree node.
     * Class TreeNode
     */
    class TreeNode {
        public $val = null;
        public $left = null;
        public $right = null;
        function __construct($value) { $this->val = $value; }
    }
    //通过数组生成二叉树
    function buildTreeNodeByArr($arr = []) {
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