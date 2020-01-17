<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/9
 * Time: 15:43
 */
//创建websocket服务

class webSocketServer
{
    public $webSocketServer = null;
    public function __construct($host = '0.0.0.0',$port = 9502)
    {
        if($this->webSocketServer === null){
            $this->webSocketServer = new swoole_websocket_server($host,$port);
        }
        //连接事件
        $this->webSocketServer->on('open',[$this,'onOpen']);
        //消息事件
        $this->webSocketServer->on('message',[$this,'onMessage']);
        //关闭事件
        $this->webSocketServer->on('close',[$this,'onClose']);

        //设置异步任务的工作进程数量
        $this->webSocketServer->set(
            [
                'worker_num' => 2,//启动worker 进程数
                'task_worker_num' => 4//任务的进程数
            ]
        );

        //处理异步任务
        $this->webSocketServer->on('task',[$this,'onTask']);
        //处理异步任务的结果
        $this->webSocketServer->on('finish',[$this,'onFinish']);
        //开启服务
        $this->webSocketServer->start();
    }

    /**监听 连接事件
     * @param $server web socket server
     * @param $request 客户端对应fd
     */
    public function onOpen($server,$request){
        $fd = $request->fd;
        $msg = "[".date('Y-m-d H:i:s')."]({$fd})连接web socket server 成功";
        print_r([
            '标题' => '监听打开事件',
            //'请求数据' => $request
            'msg' => $msg,
        ]);
        $server->push($fd,$msg);
    }

    /**监听 消息事件
     * @param $server web socket server
     * @param $frame 客户端信息
     */
    public function onMessage($server,$frame){
        $fd = $frame->fd;

        $data = [
            1,2,3,4,5,6,7,8,9,10
        ];
        //创建异步任务
        $taskId = $server->task($data);
        $msg = "[".date('Y-m-d H:i:s')."]服务器给({$fd})发了web socket 消息:{$frame->data},创建了任务({$taskId})";
        print_r(
            [
                '标题' => '监听WebSocket消息事件',
                //'客户端数据' => $frame,
                'msg' => $msg,
                'taskId' => $taskId
            ]
        );


        //发消息给客户端
        $server->push($frame->fd, $msg);
    }

    /**监听关闭事件
     * @param $server web socket server
     * @param $fd 进程id
     */
    public function onClose($server,$fd){

        $msg = "[".date('Y-m-d H:i:s')."](fd)关闭 web socket server";
        print_r(
            [
                '标题' => '监听关闭事件',
                '客户端对应fd' => $fd,
                'msg' => $msg,
            ]
        );
        $server->push($fd,$msg);
    }

    /**监听异步任务事件
     * @param $server 服务
     * @param $task_id 任务id
     * @param $src_worker_id worker 进程id
     * @param $data 数据
     */
    public function onTask($server,$task_id,$src_worker_id,$data){
        sleep(10);//睡10秒，为了体现异步任务的作用 Y^_^Y

        print_r(
            [
                '标题' => '监听异步任务事件',
                '任务id task_id' => $task_id,
                'worker进程id' => $src_worker_id,
                '数据data' => $data
            ]
        );
        $msg = "完成任务:任务id task_id:{$task_id},worker进程id:{$src_worker_id},数据:".json_encode($data);
        //将任务结果返回
        $this->webSocketServer->finish($msg);
    }

    /**处理异步任务的结果
     * @param $server
     * @param $task_id 任务id
     * @param $res 任务结果
     */
    public function onFinish($server,$task_id,$res){
        print_r([
            [
                '标题' => '处理任务结果',
                '任务id' => $task_id,
                '结果' => $res,
            ]
        ]);
        echo $res;
    }
}


$ws = new webSocketServer();
