<?php



    require_once __DIR__.'/../../vendor/fzaninotto/faker/src/autoload.php';
    require_once 'helper.php';
    $redis = redis();

    $faker = Faker\Factory::create('zh_CN');

    $end = 100;

    $users = [];

    $redis->del('near_user');

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
    //最近的10个用户
    $res = $redis->georadius('near_user',$position['longitude'],$position['latitude'],'10000000','km',['WITHDIST','count'=>10,'ASC']);

    echo "当前id为:{$user_id},位置：{$position['longitude']},{$position['latitude']}\n";

    foreach ($res as $k=>$v)
    {
        $user_id = (int)str_replace('user_','',$v[0]);
        $user = $users[$user_id - 1];

        echo ($k+1).".\n";
        echo "{$user['name']}\n";
        echo "id:{$user_id}";
        echo "距离你 {$v[1]} km\n";
        echo "\n";
        
    }

