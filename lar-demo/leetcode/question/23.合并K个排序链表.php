<?php

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    //拿头节点逐一合并
    function mergeKLists($lists) {

        $res = new ListNode(-1);
        $curr = $res;
        $lists = array_filter($lists);//将null 删了

        while(!empty($lists)){

            $min = key($lists);//最小的值的key
            foreach($lists as $k => $v){
                if($v->val < $lists[$min]->val){
                    $min = $k;
                }
            }
            $curr->next = $lists[$min];
            $curr = $curr->next;

            if($lists[$min]->next === null){
                unset($lists[$min]);
            }else{
                $lists[$min] = $lists[$min]->next;
            }
        }
        return $res->next;
    }
}



$solution = new Solution();

$list = [
    [1,4,5],
    [1,3,4],
    [2,6],
];
$list = [[],[1]];

/**数组生成链表
 * @param array $arr
 * @return array
 */
function create_lists(array $arr){
    $res = [];

    foreach ($arr as $key => $value)
    {
        $head = new ListNode(-1);
        $curr = $head;
        foreach($value as $k=>$v){
            $curr->next = new ListNode($v);
            $curr = $curr->next;
        }
        $res[] = $head->next;
    }
    return $res;
};

$list = create_lists($list);
$res = $solution->mergeKLists($list);
var_dump($res);