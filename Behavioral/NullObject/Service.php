<?php

namespace DesignPatterns\Behavioral\NullObject;

class Service
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        // 提示：这里你只是使用它，而不需要通过如：is_null() 检查 $logger 是否已经设置。
        $this->logger->log('We are in '.__METHOD__);
    }
}