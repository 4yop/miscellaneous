<?php
    $data = require_once 'data.php';
    require_once 'func.php';
    $time = time();
    $time_slot = $data['time_slot'];

    $current_time_slot = getTimeSlot(time(),$time_slot);

    $res = getByIds($current_time_slot['data_id'],$data['all_in'],$data['select_option']);

    $res = array_values($res);
    echo json_encode($res,JSON_UNESCAPED_UNICODE);