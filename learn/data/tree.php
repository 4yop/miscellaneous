<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/25
 * Time: 16:51
 */

 class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     public $parent = null;
     function __construct($value) { $this->val = $value; }
 }

 class BinaryTree{

     public $tree = NULL;

     /**数组 创建二叉树
      * @param array $arr
      * @return null|TreeNode
      */
     public function create(array $arr=[]){
        if(empty($arr)){
            return NULL;
        }

        if($this->tree == NULL){
            $this->tree = new TreeNode($arr[0]);
        }

        $len = count($arr);
        for($i = 1;$i < $len;$i++){
            $node = new TreeNode($arr[$i]);
            $this->tree = $this->insert($this->tree,$node);
        }
        return $this->tree;
     }

     /**二叉树中插入节点
      * @param TreeNode|NULL $tree 树
      * @param TreeNode|NULL $node 节点
      * @return TreeNode
      */
     public function insert(TreeNode $tree = NULL,TreeNode $node = NULL){
        if($node == NULL){
            return $tree;
        }
        if($tree == NULL){
            return $node;
        }
        $queue = [];

        array_unshift($queue,$tree);

        while(!empty($queue)){
            $currentNode = array_pop($queue);
            if($currentNode->left == NULL){
                $currentNode->left = $node;
                $node->parent = $currentNode;
                return $tree;
            }else{
                array_unshift($queue,$currentNode->left);
            }
            if($currentNode->right == NULL){
                $currentNode->right = $node;
                $node->parent = $currentNode;
                return $tree;
            }else{
                array_unshift($queue,$currentNode->right);
            }


        }

        return $tree;
     }

     /**
      * 输出二叉树的值
      */
     public function display(){
        $queue = [];
         array_unshift($queue, $this->tree);

         while (!empty($queue)) {
             $currentNode = array_pop($queue);
             echo "{$currentNode->val}\n";
             if ($currentNode->left !== null) {
                 array_unshift($queue, $currentNode->left);
             }
             if ($currentNode->right !== null) {
                 array_unshift($queue, $currentNode->right);
             }
         }

         echo "输出完毕\n";

     }
 }



 $arr = [1,2,3,4,5,6];


$tree = new BinaryTree();
$res  = $tree->create($arr);
print_r($tree->tree);
$tree->display();