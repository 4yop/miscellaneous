<?php
    class Node {
        public $data = null;
        public $parent = null;
        public $left = null;
        public $right = null;
    }

    #使用数组构造完全二叉树
    function build_cbtree($a) {
        $root = new Node();
        $root->data = $a[0];

        for ($i = 1; $i < count($a); $i++) {
            $node = new Node();
            $node->data = $a[$i];
            insert_node($root, $node);
        }

        return $root;
    }

    #插入完全二叉树节点
    function insert_node($root, $inode) {
        #使用树的广度优先遍历顺序取出节点，直到找到第一个左右子节点没满的节点，将待插入节点插入节点左边或右边
        $queue = array();
        array_unshift($queue, $root);

        while (!empty($queue)) {
            $cnode = array_pop($queue);
            if ($cnode->left == null) {
                $cnode->left = $inode;
                $inode->parent = $cnode;
                return $root;
            } else {
                array_unshift($queue, $cnode->left);
            }
            if ($cnode->right == null) {
                $cnode->right = $inode;
                $inode->parent = $cnode;
                return $root;
            } else {
                array_unshift($queue, $cnode->right);
            }
        }

        return $root;
    }

    #树的广度优先遍历
    function bf_traverse($root) {
        $queue = array();
        array_unshift($queue, $root);
        $arr = [];
        while (!empty($queue)) {
            $cnode = array_pop($queue);
            echo $cnode->data . " ";$arr[] = $cnode->data;
            if ($cnode->left !== null) array_unshift($queue, $cnode->left);
            if ($cnode->right !== null) array_unshift($queue, $cnode->right);
        }

        echo "\n";
        return $arr;
    }

    $a = array(1,2,3,4,5);
    $root = build_cbtree($a);
    //print_r($root);
$arr = bf_traverse($root); #广度优先遍历
print_r($arr);
