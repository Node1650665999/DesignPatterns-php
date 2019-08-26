<?php
namespace DesignPatterns\Behavioral\Visitor;

/**
 * 定义访问者对象的契约
 */
interface RoleVisitorInterface
{
    public function visitUser(User $role);

    public function visitGroup(Group $role);
}