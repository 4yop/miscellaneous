<?php



    require_once __DIR__.'/../../vendor/fzaninotto/faker/src/autoload.php';
    require_once 'helper.php';


    $redis = redis();
    $faker = Faker\Factory::create('zh_CN');



    $redis->del('near_user');

    $users = [];
    //随机生成用户信息 并插入redis geo
    for($i = 0;$i < 100; $i++)
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


    $user_id = random_int(1,100);
    $position = $users[$user_id - 1]['position'];
    //最近的50个用户 距离 10000000km以内
    $res = $redis->georadius('near_user',$position['longitude'],$position['latitude'],'10000000','km',['WITHDIST','count'=>50,'ASC']);

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

