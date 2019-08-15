<?php

namespace DesignPatterns\Creational\Prototype;
/*
 *  原型模式核心在于 clone, 相比正常 new 一个对象, 克隆它会更节省开销,
 *  clone 会对对象的所有属性执行一个浅复制,所有的引用属性仍然会是一个指向原来的变量的引用。
 * */
abstract class BookPrototype
{
	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $category;

	abstract public function __clone();

	public function getTitle(): string
	{
		return $this->title ?? 'nothing';
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}
}