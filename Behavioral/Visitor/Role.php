<?php
namespace DesignPatterns\Behavioral\Visitor;
/*
 *  被访问者对象
 * */
interface Role
{
    // accept 接收访问者
    public function accept(RoleVisitorInterface $visitor);
}