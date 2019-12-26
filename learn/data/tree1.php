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
     function __construct($value) { $this->val = $value; }
 }


 $arr = [1,2,3,4,5,6];


$node0 = new TreeNode($arr[0]);
$node1 = new TreeNode($arr[1]);
$node2 = new TreeNode($arr[2]);
$node3 = new TreeNode($arr[3]);
$node4 = new TreeNode($arr[4]);
$node5 = new TreeNode($arr[5]);





$node2->left = $node5;
$node1->right = $node4;
$node1->left = $node3;
$node0->right = $node2;
$node0->left = $node1;

print_r($node0);