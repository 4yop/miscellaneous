<?php



use leetcode\common\{TreeNode,Base};

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
            $node = array_shift($queue);
            if ($node !== null)
            {
                $res_arr[] = $node->val;
                $queue[] = $node->left;
                $queue[] = $node->right;
            }else
            {
                $res_arr[] = null;
            }
        }
        return json_encode($res_arr);
    }

    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        $arr = json_decode($data,true);

        if (!$arr || $arr[0] === null)
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

$b = new Base();
$root = $b->buildTreeNodeByArr($arr);


$a = new Codec();

$s = $a->serialize($root);
var_dump($s);
