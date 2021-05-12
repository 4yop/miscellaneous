<?php


namespace App\Service;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Hyperf\WebSocketServer\Context;

class BinderService
{
    protected $redis;

    protected $key = 'hyperf:connectionBinder:map';

    public function __construct()
    {
        $container = ApplicationContext::getContainer();
        $this->redis = $container->get(\Hyperf\Redis\Redis::class);
    }

    /**
     * 绑定一个标记到当前连接.
     *
     * @param string $flag
     * @param int    $fd
     *
     * @return void
     */
    public function bind (string $flag, int $fd)
    {
        Context::set('__flag',$flag);
        $this->redis->hSet($this->key,$flag,$fd);
    }

    /**
     * 绑定一个标记到当前连接，如果已绑定返回false.
     *
     * @param string $flag
     * @param int    $fd
     *
     * @return bool
     */
    public function bindNx(string $flag, int $fd): bool
    {
        $res = $this->redis->hSetNx($this->key,$flag,$fd);
        if ($res)
        {
            Context::set('__flag',$flag);
        }
        return $res;
    }

    /**
     * 取消绑定.
     *
     * @param string   $flag
     * @param int|null $keepTime 旧数据保持时间，null 则不保留
     *
     * @return void
     */
    public function unbind(string $flag, ?int $keepTime = null)
    {
        $key = $this->key;
        $fd = $this->redis->hGet($key, $flag);
        if ($fd)
        {
            Context::set('__flag',null);
        }
        $this->redis->multi();
        $this->redis->hDel($key, $flag);
        if ($fd && $keepTime > 0)
        {
            $this->redis->set($key . ':old:' . $flag, $fd, $keepTime);
        }
        $this->redis->exec();
    }

    /**
     * 使用标记获取连接编号.
     *
     * @param string $flag
     *
     * @return int|null
     */
    public function getFdByFlag($flag): ?int
    {
        return $this->redis->hGet($this->key, $flag) ?: null;
    }

    /**
     * 使用标记获取连接编号.
     *
     * @param string[] $flags
     *
     * @return int[]
     */
    public function getFdsByFlags(array $flags): array
    {
        return $this->redis->hMget($this->key, $flags);
    }


    /**
     * 使用连接编号获取标记.
     *
     * @param int $fd
     *
     * @return string|null
     */
    public function getFlagByFd(int $fd): ?string
    {
        return Context::get('__flag',null);
    }

    /**
     * 使用连接编号获取标记.
     *
     * @param int[] $fds
     *
     * @return string[]
     */
    public function getFlagsByFds(array $fds): array
    {
        $flags = [];
        foreach ($fds as $fd)
        {
            $flags[$fd] = Context::get('__flag',null);
        }

        return $flags;
    }

    /**
     * 使用标记获取旧的连接编号.
     *
     * @param string $flag
     *
     * @return int|null
     */
    public function getOldFdByFlag(string $flag): ?int
    {

        return $this->redis->get($this->key . ':old:' . $flag) ?: null;

    }

}