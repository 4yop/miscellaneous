<?php




//距离根结点最短
function BFS($root,$target){
    $step = 0;
    $queue = [];

    array_push($queue,$root);

    while(!empty($queue)){
        $step++;
        $size = count($queue);
        for($i = 0;$i < $size;++$i){
            $current = array_shift($queue);
            if($target->val == $current->val){
                return $step;
            }

            foreach($current as $v){
                array_push($queue,$v);
            }

        }

    }
    return -1;
}

//不会重重复访问
function BFS1($root,$target){
    $queue = [];
    $used = [];
    $step = 0;

    array_push($queue,$root);
    array_push($used,$root);

    while(!empty($queue)){
        $step++;
        $size = count($queue);
        for($i = 0;$i < $step;++$i){
            $current = array_shift($queue);
            if($current->val == $target->val){
                return $step;
            }
            foreach($current as $v){
                array_push($queue,$v);
                array_push($used,$v);
            }

        }
    }

}