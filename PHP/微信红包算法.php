<?php
/**
 * @param int $total 单位：分
 * @param int $num 多少个红包
 * @return array
 */
function getRandomMoney(int $total,int $num):array
{
    if ($total > 20000)
    {
        echo "最多发200元\n";
        return [];
    }
    if ($num > 100)
    {
        echo "最多发100个红包\n";
        return [];
    }

    $min= 1;//最小金额,一分钱

    if ($total/$num < $min)
    {
        echo "金额太少了,您这个金额最多只能发".($total/$min)."个人抢的红包\n";
        return [];
    }


    $isMin = false;
    //如果平均金额（分） == 最小的金额，那么只能每人拿最小金额了
    if (($avg = $total/$num) == $min)
    {
        $isMin = true;
    }
    $avg = (int)$avg;//平均数
    $res = [];
    for ($i = 0; $i < $num; $i++)
    {

        if ($isMin == true)
        {
            $res[$i] = $min;
            continue;
        }

        //是否为最后一个
        if ($i == $num - 1)
        {
            $money = $total;
        }else
        {
            $money = random_int($min, $total - ($num - $i - 1) * $min);

            //金额大于平均数的，再减去一个随机数,避免金额太大,
            if ($min < $money - 1 && $avg < $money && $money/2 < $money - 1)
            {
                $money -= random_int($money/3, $money - 1);
            }
        }

        $total -= $money;

        $res[$i] = $money;

    }

    return $res;
}


$total = 20000;
$num = 10;
$res = getRandomMoney($total,$num);

//var_dump($res);


foreach($res as $k=>$money)
{
    echo "第".($k+1)."个人抢到了".($money/100)."元\n";
}

echo "共：".(array_sum($res)/100)."元\n";