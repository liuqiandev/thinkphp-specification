<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/26
 * Time: 22:12
 */

namespace app\common\middleware;


use think\Exception;
use think\facade\Request;
use think\facade\Response;

class Auth
{
    protected $unAuthAction=[
        'index/Index/index',
        'index/Index/test'
    ];
    public function render()
    {
        if($this->isAuthNecessary()){
            return $this->auth();
        }else{
            return true;
        }
    }

    /**
     * 权限校验逻辑
     * @return bool
     * @throws Exception
     */
    protected function auth()
    {
        if(Request::param('name')=='thinkphp'){
            return true;
        }else{
            //注意此处只能通过抛出异常来跳出请求流程,配合TP的自定义异常接管可以实现自定义返回
            throw new Exception('未通过验证');
        }
    }

    /**
     * 检查当前请求是否需要验证
     * @return bool
     */
    protected function isAuthNecessary()
    {
        $action   =   Request::module().'/'.Request::controller().'/'.Request::action();
        if(in_array($action,$this->unAuthAction)){
            return false;
        }else{
            return true;
        }
    }
}