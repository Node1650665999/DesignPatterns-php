# DesignPatterns-php

> Refer：[domnikl/DesignPatternsPHP](https://github.com/domnikl/DesignPatternsPHP)

## 安装
```php
composer install
```

### 载入 autoload.php

在当前目录新建 [test.php](./test.php),引入 autoload.php

```php
require  './vendor/autoload.php';
```

为了方便打印结果，我们在 test.php 中定义一个函数

```php
/**
 * @param mixed ...$param
 */
function dd(... $param)
{
    var_dump($param);
}
```

## 创建型

### 简单工厂模式
```php
use DesignPatterns\Creational\SimpleFactory\SimpleFactory;
use DesignPatterns\Creational\SimpleFactory\Bicycle;

$bicycle = (new SimpleFactory())->createBicycle();

dd($bicycle instanceof Bicycle); // true
```


### 工厂方法模式
```php
use DesignPatterns\Creational\FactoryMethod\StdoutLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\FileLoggerFactory;
use DesignPatterns\Creational\FactoryMethod\Logger;

$stdLogger  		= (new StdoutLoggerFactory())->createLogger();
$fileLogger 	    = (new  FileLoggerFactory('log.txt'))->createLogger();
$stdLoggerIsLogger  = $stdLogger instanceof Logger;
$fileLoggerIsLogger = $fileLogger instanceof Logger;

dd($stdLoggerIsLogger, $fileLoggerIsLogger); // true true
```

### 抽象工厂模式
```php
use DesignPatterns\Creational\AbstractFactory\ProductFactory;

$product 		 = new ProductFactory();
$priceDigital    = $product->createDigitalProduct(100)->calculatePrice();
$priceShippable  = $product->createShippableProduct(100)->calculatePrice();

dd($priceDigital, $priceShippable);   // 100  150
```

### 静态工厂模式
```php
use DesignPatterns\Creational\StaticFactory\StaticFactory;
use DesignPatterns\Creational\StaticFactory\FormatString;
use DesignPatterns\Creational\StaticFactory\FormatNumber;

$stringFormatter = StaticFactory::factory('string');
$numberFormatter = StaticFactory::factory('number');

dd($stringFormatter instanceof FormatString, $numberFormatter instanceof FormatNumber);
```

### 建造者模式
```php
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
```

### 单例模式
```php
use DesignPatterns\Creational\Singleton\Singleton;

$singleton  = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

dd($singleton === $singleton2);  // true
```

### 多例模式
> 和单例模式不一样的地方在于，`$instances` 改成了一个存贮多个对象的数组
```php
use DesignPatterns\Creational\Multiton\Multiton;

$multiton1   = Multiton::getInstance(Multiton::INSTANCE_1);
$multitonBak = Multiton::getInstance(Multiton::INSTANCE_1);
$multiton2   = Multiton::getInstance(Multiton::INSTANCE_2);

dd($multiton1 === $multitonBak); // true
dd($multiton1 === $multiton2);   // false
```

### 对象池模式
> 对象池的目的在于降低对象创建的消耗,其表现为将创建好的对象存储到某个容器中,这样下次使用时直接从这个容器中取出该对象就可以了.<br>

对象池模式有个很重要的特点 :
> `当客户端使用完毕,它将把这个特定类型的工厂对象返回给对象池,
而不是销毁掉这个对象`.
```php
use DesignPatterns\Creational\Pool\WorkerPool;

$pool  = new  WorkerPool();
$worker1 = $pool->get();
$worker2 = $pool->get();
$work3 	 = $pool->get();
$pool->dispose($work3);
$worker4 = $pool->get();

dd($worker1 === $worker2);    // false
dd($work3 === $worker4);      // true
```

### 原型模式
> 原型模式核心在于 `clone`, 相比正常 new 一个对象, 克隆它会更节省开销,clone 会对对象的所有属性执行一个浅复制.
```php
use DesignPatterns\Creational\Prototype\BarBookPrototype;

$bar     = new BarBookPrototype();
$barRef  =  $bar;
$barCopy = clone $bar;
$bar->setTitle('test');

dd($bar->getTitle(),$barRef->getTitle(), $barCopy->getTitle());  // test test nothing

```

## 结构型

### 适配器模式
> 适配器的目的在于将一个类的接口转换成可应用的兼容接口,使原本由于接口不兼容而不能一起工作的那些类可以一起工作。

```php
use DesignPatterns\Structural\Adapter\Book;
use DesignPatterns\Structural\Adapter\Kindle;
use DesignPatterns\Structural\Adapter\EBookAdapter;

$book = new Book();
$book->open();
$book->turnPage();

$ebook = new EBookAdapter(new Kindle());
$ebook->open();
$ebook->turnPage();

dd($book->getPage() === 2, $ebook->getPage() === 2);  // true  true
```

### 桥梁模式
> 也叫桥接模式,可以将抽象与实现分离,这样两者可以独立地改变.

```php
use DesignPatterns\Structural\Bridge\HelloWorldService;
use DesignPatterns\Structural\Bridge\HtmlFormatter;
use DesignPatterns\Structural\Bridge\PlainTextFormatter;

$htmlFormatter      = new HtmlFormatter();
$plainTextFormatter = new PlainTextFormatter();
$html = (new HelloWorldService($htmlFormatter))->get();
$text = (new HelloWorldService($plainTextFormatter))->get();

dd($html === '<p>Hello World</p>', $text === 'Hello World'); // true true
```

### 组合模式
> 组合模式对单个对象和组合对象具有一致性,它也模糊了单个对象和组合对象的概念,使得客户能够像处理单个对象一样来处理组合对象,
从而使客户程序能够与组合对象的内部结构解耦,组合模式让对象变的组件化,能够非常容易的对组件进行添加,删除等.

> 组合模式最关键的地方在于单个对象和组合对象实现相同的接口, 这就是组合模式能够将单个对象和组合对象进行一致处理的原因.


> 假设每个创建的 Dom 元素都有一个 `render()` 方法用来生成各自的 HTML 元素, 例如 `Form 表单` 进行 render()会生成一个表单元素,
`Input 框` render() 会生成一个输入框. <br>
> 我们知道 form 表单是可以通过 【input 框,button 按钮】 组合而来的,这里 form 表单就是一个组合元素, input 就是一个子元素,
但是对于用户来说它们是无区别的, form 表单和 input 框都是 HTML 元素, 它们都有相同的行为 render(),都是生成一个html元素而已.

```php
use DesignPatterns\Structural\Composite\Form;
use DesignPatterns\Structural\Composite\InputElement;
use DesignPatterns\Structural\Composite\TextElement;

$form = new Form();
$form->addElement(new TextElement('Email:'));
$form->addElement(new InputElement());
$form->addElement(new TextElement('Password:'));
$form->addElement(new InputElement());

dd($form->render());
//<form>Email:<input type="text" />Password:<input type="text" /></form>
```

### 数据映射模式
> 也叫数据访问对象模式,或数据对象映射模式,是一种数据访问层,用于把低级的数据访问或操作从高级的业务服务中分离出来. <br>
>例如 `laravel 的ORM`,我们可以实现一个对象对应一条数据库记录,对象的属性对应记录的字段,修改对象的属性时,自动更新数据库记录.

```php
use DesignPatterns\Structural\DataMapper\StorageAdapter;
use DesignPatterns\Structural\DataMapper\UserMapper;

$storage = new StorageAdapter([1 => ['username' => 'tcl', 'email' => 'test@gmail.com']]);
$mapper  = new UserMapper($storage);
$user    = $mapper->findById(1);
dd($user->getUsername());       // tcl
```

### 装饰器模式
> 装饰器模式的目的在于为类实例动态增加新的方法,如果你需要扩展一个类的功能,并且不想增加子类的话,那么装饰器模式就非常适合你.

```php
use DesignPatterns\Structural\Decorator\Webservice;
use DesignPatterns\Structural\Decorator\JsonRenderer;
use DesignPatterns\Structural\Decorator\XmlRenderer;

$service = new Webservice('hello');

// 通过JsonRenderer 装饰 Webservice
$service = new JsonRenderer($service);
dd($service->renderData());  // hello

// 通过 XmlRenderer 装饰 Webservice
$service = new  XmlRenderer($service);
dd($service->renderData());
//<?xml version="1.0"?>
<!--<content>"hello"</content>-->
```

### 依赖注入
> 依赖注入的目的在于: 用松散耦合的方式来更好的实现可测试、可维护和可扩展的代码.

```php
use DesignPatterns\Structural\DependencyInjection\DatabaseConfiguration;
use DesignPatterns\Structural\DependencyInjection\DatabaseConnection;

$config     = new DatabaseConfiguration('localhost', 3306, 'root', 'root');
$connection = new DatabaseConnection($config);

dd($connection->getDsn());  // root:root@localhost:3306
```

### 流接口模式
> 通过方法内部返回当前对象的 `this` 来达到链式访问的目的, 很多框架的数据库查询构造器使用这种模式实现.

```php
use DesignPatterns\Structural\FluentInterface\Sql;

$query = (new Sql())
        ->select(['foo', 'bar'])
        ->from('foobar', 'f')
        ->where('f.bar ="bar"')
        ->where('f.foo="foo"');

dd($query);  //SELECT foo, bar FROM foobar AS f WHERE f.bar ="bar" AND f.foo="foo"
```

### 享元模式

> 享元模式和对象池模式都是为了实现对象的共享,以减少内存的开销; 这两者存储对象的方式不一样,`享元模式中容器存储的对象的 key 是创建这个对象时参数`,
而对象池模式中容器存储对象的key是类名,这就意味者享元模式下一个类可以有很多对象, 而对象池模式一个类只能有一个对象, 尽管它们内部都用一个容器存储已经创建的对象.

```php
use DesignPatterns\Structural\Flyweight\FlyweightFactory;

$factory        = new FlyweightFactory;
$flyweightA     = $factory->get('a');
$flyweightB     = $factory->get('b');
$flyweightC     = $factory->get('b');

dd(count($factory));   // 2
```
> 因为 $flyweightA 和 $flyweightB 的状态不同, 但 $flyweightB 和 $flyweightC 又是同一个对象,因此最终计算出的享元对象的形态有两种，所以输出2.

### 代理模式
> 代理模式（Proxy）为其他对象提供一种代理以控制对这个对象的访问。使用代理模式创建代理对象，让代理对象控制目标对象的访问，并且可以在不改变目标对象的情况下添加一些额外的功能。

> 在某些情况下，一个客户不想或者不能直接引用另一个对象，而代理对象可以在客户端和目标对象之间起到中介的作用，并且可以通过代理对象去掉客户不能看到的内容和服务或者添加客户需要的额外服务。

```php
use DesignPatterns\Structural\Proxy\RecordProxy;

$proxy = new RecordProxy($data = []);
$proxy->xyz = false;
dd($proxy->isDirty()); // true
```

### 注册器模式
> 注册器模式（Registry）也叫做注册树模式，注册器模式为应用中经常使用的对象创建一个中央存储器来存放这些对象,通常通过一个只包含静态方法的抽象类来实现(或者通过单例模式).

```php
use  DesignPatterns\Structural\Registry\Registry;

Registry::set(Registry::LOGGER, new StdClass());
$logger    = Registry::get(Registry::LOGGER);

dd($logger instanceof  StdClass);  // true
```

## 行为型

### 中介者模式
> 中介者模式（Mediator Pattern）是用来降低多个对象和类之间的通信复杂性,这种模式提供了一个中介类,该类通常处理不同类之间的通信,并支持松耦合,使代码易于维护.

`中介者模式中各个对象虽彼此协同却不知彼此,只知中介者 Mediator,使各对象不需要显式地相互引用`.
```php
use DesignPatterns\Behavioral\Mediator\Mediator;
use DesignPatterns\Behavioral\Mediator\Subsystem\Client;
use DesignPatterns\Behavioral\Mediator\Subsystem\Database;
use DesignPatterns\Behavioral\Mediator\Subsystem\Server;

$server     = new Server();
new Mediator(new Database(), new Client(), $server);
$server->process();   // Hello World
```
> 整个调用流程为 Server->process() >> Mediator->sendResponse() >> Client->output,可以看到 Server 通过 Mediator (中介者) 最终访问了 Client 的 output, 
而 Server 与 Client 他们是不知道彼此的,完全借助 Mediator 通信.

### 备忘录模式
> 备忘录((Memento))模式就是在不破坏封装的前提下,捕获一个对象的内部状态,并在该对象之外保存这个状态,以便在适当的时候恢复对象.

```php
use DesignPatterns\Behavioral\Memento\Ticket;

$ticket = new Ticket();
$ticket->open();

// 在备忘录中记录 Ticket 的状态(STATE_OPENED)
$memento     = $ticket->saveToMemento();

// 再次修改 Ticket 的状态(这时状态是 STATE_ASSIGNED)
$ticket->assign();
echo $ticket->getState();  // STATE_ASSIGNED

// 从备忘录中恢复该状态,发现状态从由 STATE_ASSIGNED 变为了 STATE_OPENED
$ticket->restoreFromMemento($memento);
echo $ticket->getState();   // STATE_OPENED
```

### 空对象模式
> 空对象 (NullObject) 可以用在数据不可用的时候提供默认的行为, 用来替换代码中判断对象是否为 null 的场景;
> 例如 `if (!is_null($obj)) { $obj->callSomething(); }` 只需 `$obj->callSomething()` 就行.
```php
use DesignPatterns\Behavioral\NullObject\Service;
use DesignPatterns\Behavioral\NullObject\PrintLogger;
use DesignPatterns\Behavioral\NullObject\NullLogger;

$servicePrint = new Service(new PrintLogger());
$servicePrint->doSomething();

//像黑洞一样,啥都不输出
$serviceNullObject = new Service(new NullLogger());
$serviceNullObject->doSomething();
```

### 观察者模式
> 对象间存在一对多关系时,当状态发生变化时,所有依赖于它的对象都得到通知并被自动更新.

```php
use DesignPatterns\Behavioral\Observer\User;
use DesignPatterns\Behavioral\Observer\UserObserver;

$observer = new UserObserver();
$user = new User();
$user->attach($observer);
$user->changeEmail('foo@bar.com');

dd(count($observer->getChangedUsers()));  // 1
```

### 状态模式
> 状态模式常用在代码中包含大量与对象状态有关的条件语句,状态模式和命令模式一样,用于消除 if...else 等条件选择语句.
> 实现应将各种具体的状态类抽象出来,并且状态类不应超过 5 个.

我们创建表示各种状态的对象和一个行为随着状态对象改变而改变的 context 对象.

```php
use DesignPatterns\Behavioral\State\ContextOrder;
use DesignPatterns\Behavioral\State\CreateOrder;
$order        = new CreateOrder();
$contextOrder = new ContextOrder();
$contextOrder->setState($order);

// 调用的是 CreateOrder 对象的 done(),但在done()内部却将状态对象篡改成了 ShippingOrder对象
$contextOrder->done();
dd($contextOrder->getStatus());  // shipping

// 尽管看着像是调用了两次done()方法, 但其实调用的是 ShippingOrder 对象的 done()
$contextOrder->done();
dd($contextOrder->getStatus());  // completed
```

### 策略模式
>  策略模式也可以用于解决 if...else 所带来的复杂和难以维护.
```php
use DesignPatterns\Behavioral\Strategy\OperationAdd;
use DesignPatterns\Behavioral\Strategy\OperationSubstract;
use DesignPatterns\Behavioral\Strategy\Context;

$context = new Context(new OperationAdd());
dd($context->executeStrategy(2,2)); // 4
$context = new Context(new OperationSubstract());
dd($context->executeStrategy(2,2));  // 0
```

### 模板模式
> 抽象对象由抽象方法和模版方法组成,为防止恶意操作,模板方法一般都加上 final 关键词;
抽象对象子类可以按需要重写方法实现,`但调用将以抽象类中定义的方式进行`.

```php
use DesignPatterns\Behavioral\TemplateMethod\Basketball;
use DesignPatterns\Behavioral\TemplateMethod\Football;

$basketball = new Basketball();
$football   = new Football();

dd($basketball->play());
dd($football->play());
```

### 访问者模式
> 访问者模式主要解决稳定的数据结构和易变的操作耦合问题,目的在于数据结构与数据操作分离,
它可以在不改变数据结构的前提下定义作用于这些元素的新的操作,可达到为一个元素(被访问者)动态添加新的操作而无需做其它修改的效果;

`该模式的关键在于元素对象中有一个方法接受访问者,将自身引用传入访问者`.

```php
use DesignPatterns\Behavioral\Visitor\RoleVisitor;
use DesignPatterns\Behavioral\Visitor\Group;

$vistor     = new RoleVisitor();
$group      = new Group('admin');
$group->accept($vistor);

dd($vistor->getVisited());
```
