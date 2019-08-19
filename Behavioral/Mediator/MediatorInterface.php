<?php

namespace DesignPatterns\Behavioral\Mediator;

interface MediatorInterface
{
    /**
     * 发出响应
     *
     * @param string $content
     */
    public function sendResponse($content);

    /**
     * 做出请求
     */
    public function makeRequest();

    /**
     * 查询数据库
     */
    public function queryDb();
}