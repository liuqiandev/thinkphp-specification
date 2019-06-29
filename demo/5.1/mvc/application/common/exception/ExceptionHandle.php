<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 17:48
 */

namespace app\common\exception;




use app\common\error\AppError;
use Exception;
use think\exception\Handle;
use think\Response;
use think\facade\Debug;
class ExceptionHandle extends Handle
{
    protected $returnData;
    public function render(Exception $e): Response
    {
        if($e instanceof AppError){
            return $this->toJson($e);
        }else{
            return parent::render($e);
        }
    }

    /**
     * 返回json
     * @param AppError $e
     * @return \think\response\Json
     */
    protected function toJson(AppError $e)
    {
        $this->errorHandle($e);

        $this->returnData['code']   =   $e->selfCode;
        if($e->msg!==''){
            $this->returnData['msg']    =   $e->msg;
        }
        if(empty($e->data)===false){
            $this->returnData['data']    =   $e->data;
        }
        $this->getDebugData();
        return json($this->returnData)->code($e->httpCode);
    }

    /**
     * debug检查
     * @return bool
     */
    protected function getDebugData()
    {
        if(app()->isDebug()){
            $this->returnData['debug']  =   Debug::getRangeTime('start', 'end') . 's';
            $this->returnData['ram'] = Debug::getRangeMem('start','end').'kb';
        }
        return true;
    }

    /**
     * 自定义一个错误级别或错误级别码，根据这个级别码来完成一些操作，如邮件、短信等
     * @param AppError $e
     * @return bool
     */
    protected function errorHandle(AppError $e)
    {
        if($e->errorLevel>100){
            //do something
            return true;
        }
        return true;
    }
}