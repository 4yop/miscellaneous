<?php
    return [
        'all_in'    => [2999],
        'time_slot' => [
            //熬夜
            [
                'id'         => 1,
                'start_time' => strtotime(date('Y-m-d 00:00:00')),
                'end_time'   => strtotime(date('Y-m-d 03:00:00')),
                'data_id'    => [9,10],
            ],
            //通宵
            [
                'id'         => 2,
                'start_time' => strtotime(date('Y-m-d 03:00:00')),
                'end_time'   => strtotime(date('Y-m-d 06:00:00')),
                'data_id'    => [11,3,10],
            ],
            //早上
            [
                'id'         => 3,
                'start_time' => strtotime(date('Y-m-d 06:00:00')),
                'end_time'   => strtotime(date('Y-m-d 10:00:00')),
                'data_id'    => [1,3],
            ],
            //早上
            [
                'id'         => 4,
                'start_time' => strtotime(date('Y-m-d 10:00:00')),
                'end_time'   => strtotime(date('Y-m-d 13:30:00')),
                'data_id'    => [4,],
            ],
            //午休
            [
                'id'         => 5,
                'start_time' => strtotime(date('Y-m-d 13:31:00')),
                'end_time'   => strtotime(date('Y-m-d 14:00:00')),
                'data_id'    => [5,],
            ],
            //下午
            [
                'id'         => 6,
                'start_time' => strtotime(date('Y-m-d 14:00:00')),
                'end_time'   => strtotime(date('Y-m-d 16:00:00')),
                'data_id'    => [6,],
            ],
            //下班
            [
                'id'         => 7,
                'start_time' => strtotime(date('Y-m-d 16:00:00')),
                'end_time'   => strtotime(date('Y-m-d 20:00:00')),
                'data_id'    => [7,],
            ],
            //夜生活
            [
                'id'         => 8,
                'start_time' => strtotime(date('Y-m-d 20:00:00')),
                'end_time'   => strtotime(date('Y-m-d 23:59:59')),
                'data_id'    => [8,10],
            ],
        ],


        'select_option'=>[
        1 => [
            'question' => '早餐吃什么',
            'count'    => rand(10,100),
            'options' => [
                '做饭',
                '麦当劳',
                '肯德基',
                '汤粉',
                '吃白粥',
                '美团的第一个店的第三个',
                '饿了么的第一个店第四个',
            ],
        ],
        2999 => [
            'question' => '要不要行动',
            'count'    => rand(33,99),
            'options' => [
                '要',
                '不要',
            ],
        ],
        3 => [
            'question' => '早餐吃什么',
            'count'    => rand(33,99),
            'options' => [
                '白粥',
                '肠粉',
                '汤粉',
                '馒头',
                '包子',
                '汉堡包',
                "饿了么的第".rand(1,10)."间的第".rand(1,10)."个",
                "美团的第".rand(1,10)."间的第".rand(1,10)."个",
                "自己做饭",
                "泡面",
                '减肥',
            ],
        ],
        4 => [
            'question' => '午餐吃什么',
            'count'    => rand(33,99),
            'options' => [
                "汤粉",
                "叉烧饭",
                "香菇滑鸡饭",
                "白切鸡",
                '肯德基',
                '麦当劳',
                "饿了么的第".rand(1,10)."间的第".rand(1,10)."个",
                "美团的第".rand(1,10)."间的第".rand(1,10)."个",
                "自己做饭",
                "泡面",
                '减肥',
            ],
        ],
        5 => [
            'question' => '要不要午休',
            'count'    => rand(33,99),
            'options' => [
                "干活",
                "休息",
                "上王者",
                "逛某宝",
                "看基金",
            ],
        ],
        6 => [
            'question' => '要点下午茶么',
            'count'    => rand(33,99),
            'options' => [
                "多喝热水",
                "凉茶",
                "不点",
                "蜜雪冰城",
                "雪碧",
                "可乐",
                "星巴克",
                '减肥',
            ],
        ],
        7 => [
            'question'  => '晚饭吃什么',
            'count'    => rand(33,99),
            'options' => [
                "猪肚鸡",
                "烤鱼",
                "烧烤",
                "肯德基",
                "麦当劳",
                "烤肉",
                "汤粉",
                "白切鸡",
                "自己做饭",
                "泡面",
                '减肥',
            ],
        ],
        8 => [
            'question' => '干点啥',
            'count' => rand(33,99),
            'options' => [
                "打游戏",
                '发呆',
                "看书学习",
                "听歌",
                "看视频",
                "刷抖音",
                "吃零食",
                "出去逛",
                "睡觉",
            ],
        ],
        9 => [
            'question' => '睡不着干点啥',
            'count' => rand(33,99),
            'options' => [
                "打游戏",
                "逛某宝",
                "看书学习",
                "看视频",
                "吃零食",
            ],
        ],
        10 => [
            'question' => '夜宵吃啥',
            'count' => rand(33,99),
            'options' => [
                "炒粉",
                "零食",
                "烧烤",
                "肯德基",
                "麦当劳",
            ],
        ],
        11 => [
            'question' => '这么晚了,干点啥?',
            'count' => rand(33,99),
            'options' => [
                "睡觉",
                "吃东西",
                "看视频",
                "逛某宝",
            ],
        ],
    ]];