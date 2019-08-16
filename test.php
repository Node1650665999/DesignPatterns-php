<?php
require  './vendor/autoload.php';

/**
 * @param mixed ...$param
 */
function dd(... $param)
{
	var_dump($param);
}


//== TODO ==
use DesignPatterns\Structural\Flyweight\FlyweightFactory;

$factory        = new FlyweightFactory;
$flyweightA     = $factory->get('a');
$flyweightB     = $factory->get('b');
$flyweightC     = $factory->get('b');
dd(count($factory));   // 2

