<?php

namespace DesignPatterns\Behavioral\Strategy;

class OperationAdd implements Strategy
{
    public function doOperation(int $num1, int $num2) {
        return $num1 + $num2;
    }
}