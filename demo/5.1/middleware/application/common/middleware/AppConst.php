<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/26
 * Time: 22:08
 */

namespace app\common\middleware;


class AppConst
{
    public $appInt;
    public $appFloat;
    /**
     *
     */
    public function render()
    {
        list($floatTime,$intTime)    = explode(' ',microtime())  ;
        $this->appInt   =   $intTime;
        $this->appFloat =   $floatTime;
        return true;
    }
}