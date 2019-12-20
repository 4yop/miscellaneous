<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/25
 * Time: 14:20
 */
//结点
class ListNode{

    public $id = NULL;
    public $name = NULL;
    public $next = NULL;
    public function __construct($id = NULL,$name = NULL)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

class LinkedList{

    private $_firstNode = NULL;
    //添加结点
    public function add($id,$name){
        $listNode = new ListNode($id,$name);//待加入的结点
        if($this->_firstNode  === NULL){
            $this->_firstNode = $listNode;
        }else{
            $currentNode = $this->_firstNode;
            //遍历到最后 在加入 结点
            while($currentNode->next != NULL){
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $listNode;
        }
    }

    //删除结点 根据id
    public function del($id){
        $currentNode = $this->_firstNode;

        $tempNode = NULL;
        $flag = false;
        while($currentNode != NULL){
            if($currentNode->id = $id){
                $flag = true;
                break;
            }
            $currentNode = $currentNode->next;
        }
        if($flag){
            $currentNode->next = $currentNode->next->next;
        }

        return $flag ? "删除id:{$id}成功" : "删除id:{$id}失败";
    }

    //全部显示出来
    public function getAll(){
        $currentNode = $this->_firstNode;//print_r($currentNode);
        while($currentNode != NULL){
            echo "id:{$currentNode->id},name:{$currentNode->name}\n";
            $currentNode = $currentNode->next;
        }
    }
    //是否为空
    public function isEmpty(){
        return $this->_firstNode === NULL;
    }
    //打印 私有变量
    public function dump(){
        var_dump($this->_firstNode);
    }
    //获取结点长度
    public function length(){
        $currentNode = $this->_firstNode;
        $length = 0;
        while($currentNode != NULL){
            $length++;
            $currentNode = $currentNode->next;
        }
        return $length;
    }
    //排序
    public function order($rule = "asc"){
        $currentNode = $this->_firstNode;
        $tempNode = NULL;
        while($currentNode != NULL){
            if($tempNode == NULL){
                $tempNode = $currentNode;
            }else{
                $temp = $tempNode;
                while($temp != NULL){

                }
            }
            $currentNode = $currentNode->next;
        }
    }
}

$linkedList = new LinkedList();

$linkedList->add(2,'第一个');
$linkedList->add(1,'名字2');
$linkedList->getAll();
$length = $linkedList->length();
echo "结点长度为:{$length}\n";
$isEmpty = $linkedList->isEmpty();
echo $isEmpty ? "空\n" : "有东西\n";

echo "--------删除后----------\n";
echo $linkedList->del(1)."\n";
echo $linkedList->del(2)."\n";
$linkedList->getAll();
$length = $linkedList->length();
echo "结点长度为:{$length}\n";
$isEmpty = $linkedList->isEmpty();
echo $isEmpty ? "空\n" : "有东西\n";
//$linkedList->dump();
