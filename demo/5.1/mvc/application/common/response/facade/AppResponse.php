<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 18:25
 */

namespace app\common\response\facade;

use think\Facade;

class  AppResponse extends Facade
{
    protected static function getFacadeClass()
    {
        return \app\common\response\AppResponse::class;
    }
}