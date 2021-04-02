<?php


namespace designPattern\DependencyInjection;

//依赖注入
//作用:使代码更好维护，更好扩展
class DatabaseConnection
{

    /**
     * @var DatabaseConfiguration
     */
    private $configuration;

    public function __construct(DatabaseConfiguration $config)
    {
        $this->configuration = $config;
    }

    public function getDsn():string
    {
        // 这仅仅是演示，而不是一个真正的  DSN
        // 注意，这里只使用了注入的配置。 所以，
        // 这里是关键的分离关注点。
        return sprintf(
            '%s:%s@%s:%d',
            $this->configuration->getUsername(),
            $this->configuration->getPassword(),
            $this->configuration->getHost(),
            $this->configuration->getPort()
        );
    }

}