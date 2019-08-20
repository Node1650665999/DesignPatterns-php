<?php

namespace DesignPatterns\Behavioral\Strategy;

class Context
{
    private  $strategy = null;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $num1, int $num2)
    {
        return $this->strategy->doOperation($num1, $num2);
    }
}