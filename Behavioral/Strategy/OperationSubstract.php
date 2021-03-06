<?php

namespace DesignPatterns\Behavioral\Strategy;

class OperationSubstract implements Strategy
{
    public function doOperation(int $num1, int $num2) {
        return $num1 - $num2;
    }
}