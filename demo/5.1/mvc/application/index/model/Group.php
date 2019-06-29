<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 22:06
 */

namespace app\index\model;


use think\Model;

class Group extends Model
{
    public $group=[
        1=>'创始人',
        2=>'管理员',
        3=>'普通成员'
    ];
}