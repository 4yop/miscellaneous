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

     function sortedArrayToBST($nums) {
         // 定义变量在赋值严重影响性能 $len = count($nums) - 1;
         return $this->buildBST($nums, 0, count($nums) - 1);
     }

     public function buildBST($nums, $front, $rear)
     {
         if ($front > $rear) {
             return null;
         }

         $mid = floor(($front + $rear) / 2);
         // 很多人喜欢下面的写法，个人认为上面的写法更好理解
         //$mid = $front + floor(($rear - $front) / 2);
         $node = new TreeNode($nums[$mid]);
         $node->left  = $this->buildBST($nums, $front, $mid - 1);
         $node->right = $this->buildBST($nums, $mid + 1, $rear);

         return $node;
     }



     /**
      * 迭代 输出二叉树的值
      */
     public function display($type = ''){
         if($type){
             $this->digui($this->tree);
         }else{
             $this->diedai();
         }
     }

     /**
      * 迭代 输出二叉树的值
      */
     public function diedai(){
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

     /**
      * 递归 输出二叉树的值
      */
     public function digui($tree){
        if($tree == NULL){
            //echo "输出完毕\n";
            return;
        }
        echo "{$tree->val}\n";
        $this->digui($tree->left);
        $this->digui($tree->right);
     }
 }



 $arr = [1,2,3,4,5,6];


$tree = new BinaryTree();
$res  = $tree->create($arr);
//print_r($res);
$tree->display(0);