<?php
    require_once 'helper.php';
    require_once 'D:\phpstudy_pro\new-lzh\miscellaneous\vendor\fzaninotto\faker\src\autoload.php';
    $redis = redis();

    $faker = Faker\Factory::create('zh_CN');

    $end = 100;

    $users = [];

    for($i = 0;$i < $end; $i++)
    {
        $users[$i] = [
            'id' => $i+1,
            'name' => $faker->name,//生成名字
            'avatar' => $faker->imageUrl($width = 100, $height = 100),
            'position' => [
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
            ],
        ];
        $res = $redis->geoadd('near_user',$users[$i]['position']['longitude'],$users[$i]['position']['latitude'],"user_{$users[$i]['id']}");
        if ($res)
        {
            echo "id:{$users[$i]['id']} geo success \n";
        }else
        {
            echo "id:{$users[$i]['id']} geo fail \n";
        }
    }


    $user_id = 1;
    $position = $users[$user_id - 1]['position'];
    $res = $redis->georadius('near_user',$position['longitude'],$position['latitude'],'1','km',['WITHDIST','count'=>10,'ASC']);

    echo "当前id为:{$user_id},位置：{$position['longitude']},{$position['latitude']}\n";

    foreach ($res as $v)
    {
        echo "{$v[0]}距离你{$v[1]}km\n";
    }

