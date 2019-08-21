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
use DesignPatterns\Behavioral\TemplateMethod\Basketball;
use DesignPatterns\Behavioral\TemplateMethod\Football;

$basketball = new Basketball();
$football   = new Football();

dd($basketball->play());
dd($football->play());