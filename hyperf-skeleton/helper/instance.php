<?php

use Hyperf\Utils\ApplicationContext;
use Psr\SimpleCache\CacheInterface;

/**
 * @return mixed|CacheInterface
 */
function cache()
{
    return ApplicationContext::getContainer()->get(CacheInterface::class);
}