<?php
namespace DesignPatterns\Behavioral\TemplateMethod;
class Football extends Game
{
    protected function initialize(): string
    {
        return 'Football Game Initialized! Start playing.';
    }

    protected function startPlay(): string
    {
        return 'Football Game Started. Enjoy the game!';
    }

    protected function endPlay(): string
    {
        return 'Football Game Finished!';
    }
}