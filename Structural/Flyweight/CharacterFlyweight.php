<?php

namespace DesignPatterns\Structural\Flyweight;

/**
 * 具体的享元实例被工厂类的方法共享。
 */
class CharacterFlyweight implements FlyweightInterface
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * 实现 FlyweightInterface 中的传递方法 render() 。
     */
    public function render(string $font): string
    {
        // 享元对象需要客户端提供环境依赖信息来自我定制, 意味着外部可以有多个不同形态的享元对象

        return sprintf('Character %s with font %s', $this->name, $font);
    }
}