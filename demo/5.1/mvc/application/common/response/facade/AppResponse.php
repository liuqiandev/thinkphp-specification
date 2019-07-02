<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 18:25
 */

namespace app\common\response\facade;

use app\common\library\BaseLogic;
use think\Facade;

/**
 * @see \app\common\response\AppResponse
 * @mixin \app\common\response\AppResponse
 * @method \app\common\response\AppResponse setCode(int $appCode) static 设置App状态码
 * @method \app\common\response\AppResponse setData($data) static 设置App返回数据
 * @method \app\common\response\AppResponse setHttpCode(int $httpCode) static 设置App http状态码
 * @method \app\common\response\AppResponse setMsg(string $msg) static 设置返回Msg
 * @method \app\common\response\AppResponse setErrorLevel(int $level) static 设置App状态码
 * @method \app\common\response\AppResponse render(int $appCode=1,string $msg='', $data=null,int $httpCode=200,int $errorLevel=0) static 设置App状态码
 * @method \app\common\response\AppResponse objectRender(BaseLogic $logic=null) static 设置App状态码
 */
class  AppResponse extends Facade
{
    protected static function getFacadeClass()
    {
        return \app\common\response\AppResponse::class;
    }
}