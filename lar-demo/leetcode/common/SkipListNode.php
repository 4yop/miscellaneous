<?php


namespace leetcode\common;

use function Complex\ln;

const MAXLEVEL = 16;
const POWER = 2;
const MAXRAND = MAXLEVEL ** POWER - 1;
function randLevel():int
{
    return MAXLEVEL - (int)(log(1 + random_int(1,MAXRAND) * MAXRAND) / log(POWER));
}
class SkipNode
{
    public $value;
    public $right = null;
    public $down = null;
    public function __construct($value)
    {
        $this->value = $value;
    }
}

class SkipNodeList
{
    public $head;
    public function __construct()
    {
        $left = array_map(function (){
                    return new SkipNode(-INF);
                },range(0,MAXLEVEL-1));
        $right = array_map(function (){
                    return new SkipNode(INF);
                },range(0,MAXLEVEL-1));
        for($i = 0;$i < MAXLEVEL - 1;$i++)
        {
            $left[$i]->right = $right[$i];
            $left[$i]->down = $left[$i+1];
            $right[$i]->down = $right[$i+1];
        }
        $left[MAXLEVEL - 1]->right = $right[MAXLEVEL - 1];
        $this->head = $left[0];
    }

    /**
     * @param Integer $target
     * @return Boolean
     */
    function search($target) {
        $node = $this->head;
        while ($node !== null)
        {
            if ($node->right->value > $target)
            {
                $node = $node->down;
            }else if ($node->right->value < $target)
            {
                $node = $node->right;
            }else
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Integer $num
     * @return NULL
     */
    function add($num)
    {
        $prev = [];
        $node = $this->head;
        while($node !== null)
        {
            if ($node->right->value >= $num)
            {
                $prev[] = $node;
                $node = $node->down;
            }else
            {
                $node = $node->right;
            }
        }

        $arr = array_map(function ()use($num){
                    return new SkipNode($num);
                },range(0,randLevel()-1));


        $t = new SkipNode(NAN);

        for ($i = 0,$n = count($arr),$j = MAXLEVEL - $n;$i < $n;++$i,++$j)
        {
            list($a,$p) = [$arr[$i],$prev[$j]];
            $a->right = $p->right;
            $p->right = $a;
            $t->down = $a;
            $t = $a;
        }

    }

    /**
     * @param Integer $num
     * @return Boolean
     */
    function erase($num) {
        $node = $this->head;
        $ans = false;
        while ($node !== null)
        {
            if ($node->right->value > $num)
            {
                $node = $node->down;
            }else if ($node->right->value < $num)
            {
                $node = $node->right;
            }else
            {
                $ans = true;
                $node->right = $node->right->right;
                $node = $node->down;
            }
        }
        return $ans;
    }


}

$s = new SkipNodeList();
$s->traversal();exit;



for($i = 1;$i <= 2;$i++)
{
    $s->add($i);
}



print_r($s->head);
