<?php
    class WatchDog
    {
        public function __construct()
        {

        }

        /**是否为 window 系统
         * @return bool
         */
        public function isWinow()
        {
            return  strpos(PHP_OS,'WIN') !== false;
        }

        /**判断进程是否执行中
         * @return bool|mixed
         */
        public function isProcessExecuting(int $pid)
        {

            if (extension_loaded('swoole') )
            {
                return $this->checkProcessBySwoole($pid);
            }else
            {
                return $this->checkProcessByCmd($pid);
            }

        }

        /**判断进程是否执行中 通过 swoole
         * @return mixed
         */
        public function checkProcessBySwoole(int $pid)
        {
            return \Swoole\Process::kill($pid,0);
        }

        /**判断进程是否执行中 通过 命令行
         * @return bool
         */
        public function checkProcessByCmd(int $pid)
        {
            if ($this->isWinow())
            {
                $command = "tasklist /fi \"PID eq {$pid}\" | findstr {$pid}";
            }else
            {
                $command = "ps axo pid | grep -w {$pid}";
            }
            return !empty(exec($command));
        }

        /**获取redis
         * @return RedLock
         */
        private function getRedis()
        {
            require_once 'RedLock.php';
            $servers = [
                ['127.0.0.1', 6379, 0.01],
                //['127.0.0.1', 6378, 0.01],
            ];
            $redLock = new RedLock($servers);
            return $redLock;
        }

        /**sleep间隔时间
         * @param $ttl
         * @return mixed
         */
        public function getSleepTime($ttl)
        {
            //至少睡1秒
            $sleep_time = max(intval($ttl*1000/3),1000000);
            return $sleep_time;
        }

        //定时检查
        public function cornCheck(int $pid,string $key,string $ttl)
        {
            $redLock = $this->getRedis();
            $sleep_time = $this->getSleepTime($ttl);
            $i = 0;
            while ($this->isProcessExecuting($pid)) {
                $redLock->renewal($key, $ttl);
                $i++;
                var_dump("第{$i}次,续锁完成,pid:{$pid},间隔:{$sleep_time}微秒\n");
                usleep($sleep_time);
            }

            return true;
        }


    }



    //文件名称，监控的进程id,key,锁的过期时间
    list($filename,$pid,$key,$ttl) = $argv;

    if ($pid === null || $key === null ||$ttl === null)
    {
        exit("参数不对");
    }
    $start_time = time();
    cli_set_process_title('php-lock-watch-dog');


    $watchDog = new WatchDog();

    $watchDog->cornCheck($pid,$key,$ttl);

    $work_time = time() - $start_time;

    echo "pid:{$pid},执行完了{$work_time}秒\n";