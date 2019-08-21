<?php
namespace DesignPatterns\Behavioral\TemplateMethod;
abstract class Game
{

    /**
     * 子类可以按需要重写方法实现,但调用将以抽象类中定义的方式进行
     * @return array
     */
    final public function play() : array
    {
        $flow = [
            $this->initialize(),
            $this->startPlay(),
            $this->endPlay()
        ];

        return $flow;
    }

    // 以下三个方法是模板,需要子类自己实现
    abstract protected function initialize(): string;
    abstract protected function startPlay(): string;
    abstract protected function endPlay(): string;
}