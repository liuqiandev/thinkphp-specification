<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 21:59
 */

namespace app\index\model;


use think\Model;

/**
 * 此处仅为测试，所有模型的实例化采用的是new Model()的方式，实际应该更多的使用静态或app()的方式访问
 * Class User
 * @package app\index\model
 */
class User extends Model
{
    public $username    =   '123456789';
    public $desc    =   '这是一段很长的文字描述，这段文字在PC端和wap端的长度会不一样';
    public $avatar  =   [
        'pc'=>'你可以把我看成一张大图片，1024*1024那种',
        'wap'=>'我是适配移动端的小图片，128*128那种'
        ];
    public $groupId =   3;

}