<?php

namespace DesignPatterns\Behavioral\TemplateMethod;
class Basketball extends Game
{
    protected function initialize(): string
    {
        return 'Basketball Game Initialized! Start playing.';
    }

    protected function startPlay(): string
    {
        return 'Basketball Game Started. Enjoy the game!';
    }

    protected function endPlay(): string
    {
        return 'Basketball Game Finished!';
    }
}