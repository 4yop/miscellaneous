<?php


function getTimeSlot (int $time,array $time_slot)
{

    foreach ($time_slot as $k=>$v)
    {
        if ($v['start_time'] <= $time && $time < $v['end_time'])
        {
            return $v;
        }
    }
    return [];
}

function getByIds(array $data_id = [],array $all_in = [],array $select_option = [])
{
    $res = [];

    foreach ($data_id as $id)
    {
        if (!isset($select_option[$id]))
        {
            continue;
        }
        $res[$id] = $select_option[$id];
    }
    foreach ($all_in as $id)
    {
        if (!isset($select_option[$id]))
        {
            continue;
        }
        $res[$id] = $select_option[$id];
    }
    return $res;
}