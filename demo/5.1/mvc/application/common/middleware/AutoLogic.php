<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 15:33
 */

namespace app\common\middleware;


use think\Exception;
use think\facade\Request;

class AutoLogic
{
    public function render()
    {
        if(app(AppConst::class)->client==='wap'){
            $thisLogic  =   'app\\'.Request::module().'\wap_logic\\'.Request::controller();
        }else{
            $thisLogic  =   'app\\'.Request::module().'\pc_logic\\'.Request::controller();
        }
        if(class_exists($thisLogic)){
            bind('logic',$thisLogic);
            return true;
        }else{
            throw new Exception('logic class is not exist');
        }
    }
}