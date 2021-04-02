<?php
namespace designPattern\DependencyInjection;

class DatabaseConfiguration
{
    /**
     * @var
     */
    private $host;

    /**
     * @var
     */
    private $port;

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;

    public function __construct(string $host,int $port,string $username,string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getHost():string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort():int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUsername():string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword():string
    {
        return $this->password;
    }

}