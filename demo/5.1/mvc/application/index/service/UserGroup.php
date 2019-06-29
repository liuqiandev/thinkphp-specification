<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 22:08
 */

namespace app\index\service;


use app\index\model\Group;
use app\index\model\User;

class UserGroup
{
    public function getUserGroupInfo()
    {
        $systemGroup    =   (new Group())->group;
        $userInfo   =   (new User())->username;
        return compact('systemGroup','userInfo');
    }
}