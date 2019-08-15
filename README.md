# DesignPatterns-php

> Refer：[domnikl/DesignPatternsPHP](https://github.com/domnikl/DesignPatternsPHP)

## 安装
````php
composer install
````

### 载入 autoload.php

在当前目录新建 [test.php](./test.php),引入 autoload.php

````php
require  './vendor/autoload.php';
````

为了方便打印结果，我们在 test.php 中定义一个函数

````php
/**
 * @param mixed ...$param
 */
function dd(... $param)
{
    var_dump($param);
}
````

## 创建型

### 简单工厂模式
````php
use DesignPatterns\Creational\SimpleFactory\SimpleFactory;
use DesignPatterns\Creational\SimpleFactory\Bicycle;

$bicycle = (new SimpleFactory())->createBicycle();

dd($bicycle instanceof Bicycle); // true
````


### 工厂方法模式
````php
use DesignPatterns\Creational\FactoryMethod\StdoutLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\FileLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\Logger;

$stdLogger  		= (new StdoutLoggerFactory())->createLogger();
$fileLogger 	    = (new  FileLoggerFactory('log.txt'))->createLogger();
$stdLoggerIsLogger  = $stdLogger instanceof Logger;
$fileLoggerIsLogger = $fileLogger instanceof Logger;

dd($stdLoggerIsLogger, $fileLoggerIsLogger); // true true
````

### 抽象工厂模式
````php
use DesignPatterns\Creational\AbstractFactory\ProductFactory;

$product 		 = new ProductFactory();
$priceDigital    = $product->createDigitalProduct(100)->calculatePrice();
$priceShippable  = $product->createShippableProduct(100)->calculatePrice();

dd($priceDigital, $priceShippable);   // 100  150
````

### 静态工厂模式
````php
use DesignPatterns\Creational\StaticFactory\StaticFactory;
use DesignPatterns\Creational\StaticFactory\FormatString;
use DesignPatterns\Creational\StaticFactory\FormatNumber;

$stringFormatter = StaticFactory::factory('string');
$numberFormatter = StaticFactory::factory('number');

dd($stringFormatter instanceof FormatString, $numberFormatter instanceof FormatNumber);
````

### 建造者模式
````php
use DesignPatterns\Creational\Builder\TruckBuilder;
use DesignPatterns\Creational\Builder\CarBuilder;
use DesignPatterns\Creational\Builder\Parts\Truck;
use DesignPatterns\Creational\Builder\Parts\Car;
use DesignPatterns\Creational\Builder\Director;

$truckVehicle = (new Director())->build(new TruckBuilder());
$carVehicle   = (new Director())->build(new CarBuilder());
$ofTruck      = $truckVehicle instanceof Truck;
$ofCar        = $carVehicle instanceof Car;

dd($ofTruck, $ofCar);  // true  true
````

### 单例模式
````php
use DesignPatterns\Creational\Singleton\Singleton;

$singleton  = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

dd($singleton === $singleton2);  // true
````

### 多例模式
> 和单例模式不一样的地方在于，$instances改成了一个存贮多个对象的数组
````php
use DesignPatterns\Creational\Multiton\Multiton;

$multiton1   = Multiton::getInstance(Multiton::INSTANCE_1);
$multitonBak = Multiton::getInstance(Multiton::INSTANCE_1);
$multiton2   = Multiton::getInstance(Multiton::INSTANCE_2);

dd($multiton1 === $multitonBak); // true
dd($multiton1 === $multiton2);   // false
````

### 对象池模式
> 对象池的目的在于降低对象创建的消耗,其表现为将创建好的对象存储到某个容器中,这样下次使用时直接从这个容器中取出该对象就可以了.
````php
use DesignPatterns\Creational\Pool\WorkerPool;

$pool  = new  WorkerPool();
$worker1 = $pool->get();
$worker2 = $pool->get();
$work3 	 = $pool->get();
$pool->dispose($work3);
$worker4 = $pool->get();

dd($worker1 === $worker2);    // false
dd($work3 === $worker4);	  // true
````

### 原型模式
> 原型模式核心在于 clone, 相比正常 new 一个对象, 克隆它会更节省开销,clone 会对对象的所有属性执行一个浅复制.
````php
use DesignPatterns\Creational\Prototype\BarBookPrototype;

$bar     = new BarBookPrototype();
$barRef  =  $bar;
$barCopy = clone $bar;
$bar->setTitle('test');

dd($bar->getTitle(),$barRef->getTitle(), $barCopy->getTitle());  // test test nothing
````