<?php
    require_once 'helper.php';


    $redis = redis();

    $key = "test-stream";

    for($i = 0;$i < 100;$i++)
    {
        $msg_id = $redis->xAdd($key, '*', ['field-'.$i => 'value:'.$i]);
    }

    //删除
    $xDelResult = $redis->xDel($key, ['1609131229884-0']);
    //创建消费队列
    $xGroupResult = $redis->xGroup('CREATE', $key, $key.':group_1', 0);
    //获取消费队列中的消息
    $xReadGroupResult = $redis->xReadGroup($key.':group_1', 'consumerA', [$key => '>'], 1);
    //从消费者组内读取消息并处理完成后,需确认该条消息已处理
    $xAckResult = $redis->xAck($key, $key.':group_1', ['1609131229885-0']);
    // 用来获消费组或消费内消费者的未处理完毕的消息
    $pendingResult = $redis->xPending($key, $key.':group_1');