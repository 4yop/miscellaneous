<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/10/26
 * Time: 11:21
 */
 class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val) { $this->val = $val; }
 }

function func($l1,$l2){

   $node1 = new ListNode($l1[0]);
   $node2 = new ListNode($l2[0]);
   $len = count($l1);
   $i = 1;
   while($i < $len){
       $t1 = new ListNode($l1[$i]);
       $tmp1 = $node1;
       while($tmp1->next != null){
           $tmp1 = $tmp1->next;
       }
       $tmp1->next = $t1;

       $t2 = new ListNode($l2[$i]);
       $tmp2 = $node2;
       while($tmp2->next != null){
           $tmp2 = $tmp2->next;
       }
       $tmp2->next = $t2;

       $i++;
   }

   $l1 = $node1;
   $l2 = $node2;

   //print_r($l1);print_r($l2);exit;
   $listNode = new ListNode(0);
   $currentNode = $listNode;

   while($l1 != null && $l2 != null){
        if($l1->val < $l2->val){
            $currentNode->next = $l1;
            $currentNode = $currentNode->next;
            $l1 = $l1->next;
        }else{
            $currentNode->next = $l2;
            $currentNode = $currentNode->next;
            $l2 = $l2->next;
        }
   }

   $currentNode->next = $l1 == null ? $l2 : $l1;
   return $listNode->next;
}


function func1($head){
    $node1 = new ListNode($head[0]);

    $len = count($head);
    $i = 1;
    while($i < $len){
        $t1 = new ListNode($head[$i]);
        $tmp1 = $node1;
        while($tmp1->next != null){
            $tmp1 = $tmp1->next;
        }
        $tmp1->next = $t1;

        $i++;
    }

    $head = $node1;
    $currentNode = $head;
    $tempNode = $head;

    while($currentNode != null){



        $currentNode = $currentNode->next;
    }
    return $head;
}



$head = [4,2,1,3];



//$res = func1($head);
//print_r($res);

