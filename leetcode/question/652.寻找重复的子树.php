<?php

require_once "../../learn/data/tree.php";
class Solution {

    public $hash = [];
    function findDuplicateSubtrees($root) {
        $this->helper($root);
        $res = [];
        foreach($this->hash as $k=>$v){
            if($v > 1){
                $res[] = unserialize($k);
            }
        }
        return $res;
    }

    function helper($node){
        if($node === NULL){
            return;
        }

        $this->hash[serialize($node)]++;

        $this->helper($node->left);
        $this->helper($node->right);
    }


}

$arr = [1,2,3,4,5,null,6,7,null,null,null,null,8];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->serializeTree($root);

print_r($res);