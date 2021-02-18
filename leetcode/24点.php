<?php

    //随意写的，真正用别这么写



    class Solution
    {
        function suan ($arr)
        {



            foreach ($arr as $k1=>$v1)
            {
                $res4 = [];
                $res1 = $this->ge4($v1);

                foreach ($arr as $k2=>$v2)
                {
                    if (in_array($k2,[$k1]))
                    {
                        continue;
                    }
                    $res2 = $this->ge4($v2,$res1);
                    foreach ($arr as $k3=>$v3)
                    {
                        if (in_array($k3,[$k1,$k2]))
                        {
                            continue;
                        }
                        $res3 = $this->ge4($v3,$res2);
                        foreach ($arr as $k4=>$v4)
                        {
                            if (in_array($k4,[$k1,$k2,$k3]))
                            {
                                continue;
                            }

                            $res4 = $this->ge4($v4,$res3);
                            if ( $res = $this->find24($res4) )
                            {
                                return $res['desc'];
                            }
                        }
                    }
                }
            }

            return "不能组成24点\n";
        }

        function find24($arr)
        {
            foreach ($arr as $v)
            {
                if ($v['val'] == 24) {
                    return $v;
                }
            }
            return false;
        }


        function ge4($num,$arr = [])
        {
            if (empty($arr)) {
                $arr[] = [
                    'val'=>$num,
                    'desc' => "\n",
                ];
                return $arr;
            }
            $res = [];
            foreach ($arr as $v)
            {
                $res[] = [
                    'val' => $num + $v['val'],
                    'desc' => $v['desc']."$num + {$v['val']} = ".($num + $v['val'])."\n",
                ];
                $res[] = [
                    'val' => $num - $v['val'],
                    'desc' => $v['desc']."$num - {$v['val']} = ".($num - $v['val'])."\n",
                ];
                $res[] = [
                    'val' => $num * $v['val'],
                    'desc' => $v['desc']."$num * {$v['val']} = ".($num * $v['val'])."\n",
                ];
                if ($v['val'] != 0) {
                    $res[] = [
                        'val' => $num / $v['val'],
                        'desc' => $v['desc']."$num / {$v['val']} = ".($num / $v['val'])."\n",
                    ];
                }

            }
            return $res;

        }


    }
    $arr = [];
    for($i = 1;$i <= 4;$i++)
    {

        $n = 0;
        while ($n < 1 || $n > 10)
        {
            fwrite(STDOUT,"输入第{$i}张牌[1~10]:");
            $n = intval(fgets(STDIN));
        }
        $arr[] = $n;
    }

    $s = new Solution();


    $r = $s->suan($arr);

    echo $r;