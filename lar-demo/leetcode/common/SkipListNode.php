<?php


namespace leetcode\common;

use function Complex\ln;

const maxLevel = 16;
const power = 2;
const maxRand = maxLevel ** power - 1;
function randLevel():int
{
    return maxLevel - (int)(log(1 + random_int(1,maxRand) * maxRand) / log(power));
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
                },range(0,maxLevel-1));
        $right = array_map(function (){
                    return new SkipNode(INF);
                },range(0,maxLevel-1));
        for($i = 0;$i < maxLevel - 1;$i++)
        {
            $left[$i] = $right[$i];
            $left[$i]->down = $left[$i+1];
            $right[$i]->down = $right[$i+1];
        }
        $left[maxLevel - 1]->right = $right[maxLevel - 1];
        $this->head = $left[0];
    }

    /**
     * @param Integer $target
     * @return Boolean
     */
    function search($target) {

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
                    return new SkipNode(NAN);
                },range(0,randLevel()-1));

        var_dump($arr);exit;
        $t = new SkipNode(NAN);
        for ($i = 0;$n = count($arr),$j = maxLevel - $n;++$i,++$j)
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

    }

}

$s = new SkipNodeList();
$s->add(1);
$s->add(2);
$s->add(3);


