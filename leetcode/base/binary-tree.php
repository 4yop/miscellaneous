<?php
class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($value) { $this->val = $value; }
}

//二叉树 反序列化
function deserialize($data) {
    $arr = $data;
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