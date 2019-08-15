<?php

namespace DesignPatterns\Creational\Pool;

/*
 * 对象池的目的在于降低对象创建的消耗，其表现为将创建好的对象存储到某个容器中，
 * 这样下次使用时直接从这个容器中取出该对象就可以了
 */

class WorkerPool implements \Countable
{
	/**
	 * @var StringReverseWorker[]
	 */
	private $occupiedWorkers = [];

	/**
	 * @var StringReverseWorker[]
	 */
	private $freeWorkers = [];

	public function get(): StringReverseWorker
	{
		if (count($this->freeWorkers) == 0) {
			$worker = new StringReverseWorker();
		} else {
			$worker = array_pop($this->freeWorkers);
		}

		$this->occupiedWorkers[spl_object_hash($worker)] = $worker;

		return $worker;
	}

	public function dispose(StringReverseWorker $worker)
	{
		$key = spl_object_hash($worker);

		if (isset($this->occupiedWorkers[$key])) {
			unset($this->occupiedWorkers[$key]);
			$this->freeWorkers[$key] = $worker;
		}
	}

	public function count(): int
	{
		return count($this->occupiedWorkers) + count($this->freeWorkers);
	}
}