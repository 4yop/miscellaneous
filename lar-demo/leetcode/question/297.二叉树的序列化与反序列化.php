<?php



  class TreeNode {
      public $val = null;
      public $left = null;
      public $right = null;
     function __construct($value) { $this->val = $value; }
  }

class Codec {
    function __construct() {

    }

    /**
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
        if ($root === null)
        {
            return "[null]";
        }
        $queue = [$root];
        $res_arr = [];
        while (!empty($queue))
        {
            $curr = array_shift($queue);
            $res_arr[] = $curr->val;
            if ($curr->left !== null)
            {
                $queue[] = $curr->left;
            }else
            {
                $res_arr[] = null;
            }
            if ($curr->right !== null)
            {
                $queue[] = $curr->right;
            }else
            {
                $res_arr[] = null;
            }
        }

        while (end($res_arr) === null)
        {
            array_pop($res_arr);
        }

        return json_encode($res_arr);
    }

    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        $arr = json_decode($data,true);
        if ($arr[0] === null)
        {
            return null;
        }
        $treeNode = new TreeNode($arr[0]);
        $queue = [$treeNode];
        $i = 1;
        while (!empty($queue) && $i < count($arr))
        {
            $curr = array_shift($queue);
            if ($arr[$i] !== null)
            {
                $curr->left = new TreeNode($arr[$i]);
                $queue[] = $curr->left;
            }
            $i++;
            if ($arr[$i] !== null)
            {
                $curr->right = new TreeNode($arr[$i]);
                $queue[] = $curr->right;
            }
            $i++;
        }
        return $treeNode;
    }
}

$arr = [1,2,3,null,null,4,5];
$treeNode = new TreeNode($arr[0]);
$treeNode->left = new TreeNode($arr[1]);
$treeNode->right = new TreeNode($arr[2]);
$treeNode->left->left = $arr[3];
$treeNode->left->right = $arr[4];
$treeNode->right->left = new TreeNode($arr[5]);
$treeNode->right->right = new TreeNode($arr[6]);

//var_dump(json_decode(json_encode($treeNode),true));


$a = new Codec();

$s = $a->serialize($treeNode);
var_dump($s);