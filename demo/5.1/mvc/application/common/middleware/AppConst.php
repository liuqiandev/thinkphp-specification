<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 15:29
 */

namespace app\common\middleware;


use think\facade\Debug;
use think\Request;

class AppConst
{
    public $client;
    public function render(Request $request)
    {
        $this->getClient($request);
        $this->getDebugData();
    }
    protected function getClient(Request $request)
    {
        $this->client   =   $request->param('client')==='wap'?'wap':'pc';
        return true;
    }
    protected function getDebugData()
    {
        if(app()->isDebug()){
            Debug::remark('start');
        }
        return true;
    }
}