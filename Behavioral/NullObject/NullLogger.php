<?php

namespace DesignPatterns\Behavioral\NullObject;

class NullLogger implements LoggerInterface
{
    public function log(string $str)
    {
        // 什么也不用做，就像黑洞一样，吸收一切
    }
}