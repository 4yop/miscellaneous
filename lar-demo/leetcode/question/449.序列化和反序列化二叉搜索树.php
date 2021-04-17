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
class Codec {
    function __construct() {

    }

    /**
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
        $res = [];
        $queue = [$root];
        while(!empty($queue)){
            $node = array_pop($queue);
            $res[] = $node->val;echo $node->val;
            if($node->left !== NULL){
                array_push($queue,$node->left);
            }
            if($node->right !== NULL){
                array_push($queue,$node->right);
            }
        }

        return $res;
    }

    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {

    }
}

$arr = [1,2,3,null,null,4,5];

$tree = new BinaryTree();
$root = $tree->create($arr);


$res = (new Codec())->serialize($root);

print_r($res);