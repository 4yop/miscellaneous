<?php


    go(function(){
        $mysql = new Swoole\Coroutine\MySQL();

        $mysql->connect([
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 'root',
            'database' => 'mobile',
        ]);

        $redis = new Swoole\Coroutine\Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setDefer();


        while(true){
            $redis->keys("m:*");
            $keys = $redis->recv();//key的
            if(!is_array($keys) || empty($keys)){
                echo "没了keys\n";
                print_r($keys);
                sleep(300);
                continue;
            }
            $key = current($keys);
            $redis->get($key);
            $data = $redis->recv();//数据的


            $arr = explode(',', $data);
            if(count($arr) != 5){
                print_r($arr);
                echo "数据不合法：";break;
            }
            list($id, $mobile, $city, $pro, $op) = $arr;

//                print_r(compact('id', 'mobile', 'city', 'pro', 'op'));
//                break;

            $id = intval($id);
            $sql = "INSERT INTO `mobile`(`id`,`mobile`,`pro`,`city`,`op`) VALUE ('{$id}','{$mobile}','{$pro}','{$city}','{$op}')";

            $res = $mysql->query($sql);
//            }catch (\Exception $e){
//                print_r(explode(',', $data));
//                echo $e->getMessage();break;
//            }

            if($res){
                echo "插入{$mobile}成功\n";
                $redis->del($key);
                $redis->recv();//删除的结果
            }else{
                echo "插入{$mobile}失败,{$mysql->error}\n";
            }
        }







    });