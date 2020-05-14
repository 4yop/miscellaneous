<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/30
 * Time: 10:36
 */
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
     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */

    public $res = [];
    function levelOrderBottom1($root) {
        $this->helper($root);
        return $this->res;
    }

    function helper($root,$index = 0){
        if($root === NULL){
            return;
        }
        if(!array_key_exists($index,$this->res)){
            array_unshift($this->res,[]);
        }
        $i = count($this->res) - $index - 1;
        $this->res[$i][] = $root->val;
        $this->helper($root->left,$index+1);
        $this->helper($root->right,$index+1);
    }

    function levelOrderBottom($root){
        if($root === NULL){
            return [];
        }
        $res = [];
        $queue = [$root];
        while(!empty($queue)){
            $count = count($queue);
            $tmp = [];
            for($i = 0;$i < $count;$i++){
                $node = array_shift($queue);
                $tmp[] = $node->val;
                if($node->left !== NULL){
                    $queue[] = $node->left;
                }
                if($node->right !== NULL){
                    $queue[] = $node->right;
                }
            }
            array_unshift($res,$tmp);
        }
        return $res;
    }
}

$arr =[1,2];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->levelOrderBottom($root);

var_dump($res);