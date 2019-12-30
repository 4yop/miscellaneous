<?php
//栈和深度优先搜索


/*
 * Return true if there is a path from cur to target.
 */
//boolean DFS(Node cur, Node target, Set<Node> visited) {
//    return true if cur is target;
//    for (next : each neighbor of cur) {
//        if (next is not in visited) {
//            add next to visted;
//            return true if DFS(next, target, visited) == true;
//        }
//    }
//    return false;
//}

class TreeNode{
    public $val = NULL;
    public $left = NULL;
    public $right = NULL;
    public function __construct($val)
    {
        $this->val = $val;
    }
}

function DFS(TreeNode $cur,TreeNode $target,$visted=[]){
    if($cur->val == $cur->val){
        return true;
    }
    foreach($cur as $v){
        if(!in_array($v->val,$visted)){
            $visted[] = $v;
            if($this->DFS($v,$target,$visted) == true){
                return true;
            }
        }
    }
    return false;

}