<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 15:45
 */

namespace app\common\middleware;


use app\common\response\facade\AppResponse;
use think\facade\Request;

class AppValidate
{
    public function render()
    {
        $this->controllerValidate();
        $this->actionValidate();
        return true;
    }

    /**
     * 通过控制器名+方法名作为场景验证
     * @return bool
     */
    protected function controllerValidate()
    {
        $validate = 'app\\'.Request::module().'\validate\\'.Request::controller();

        if(class_exists($validate)===false||app($validate)->hasScene(strtolower(Request::action()))===false){
            return true;
        }
        if(app($validate)->scene(Request::action())->check(Request::param())){
            return true;
        }else{
            return AppResponse::setCode(-999)->setMsg(app($validate)->getError())->render();
        }
    }

    /**
     * 通过方法名作为独立验证类方式验证
     * @return bool
     */
    protected function actionValidate()
    {
        $validate = 'app\\'.Request::module().'\validate\\'.Request::controller().'\\'.ucfirst(Request::action());
        if(class_exists($validate)===false){
            return true;
        }
        if(app($validate)->check(Request::param())){
            return true;
        }else{
            return AppResponse::setCode(-999)->setMsg(app($validate)->getError())->render();
        }
    }
}