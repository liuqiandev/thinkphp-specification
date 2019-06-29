<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 15:51
 */

namespace app\common\response;


use app\common\library\BaseLogic;
use think\facade\Debug;
use think\Model;
use think\model\Collection;
use app\common\error\AppError;
use think\Request;
use think\Response;

class AppResponse extends Request
{
    protected $appCode=1;
    protected $msg='';
    protected $selfData=[];
    protected $httpCode=200;
    protected $errorLevel=0;
    protected $responseData = [];

    public function objectRender(BaseLogic $logic=null)
    {
        if(is_null($logic)){
            return true;
        }
        $this->appCode  =   $logic->appCode;
        $this->msg  =   $logic->msg;
        $this->selfData  =   $logic->selfData;
        $this->httpCode  =   $logic->httpCode;
        $this->errorLevel  =   $logic->errorLevel;
        if($this->appCode<-100){
            return $this->throw();
        }else{
            return $this->response();
        }
    }

    /**
     * @param int $appCode
     * @param string $msg
     * @param null $data
     * @param int $httpCode
     * @param int $errorLevel
     * @return Response
     * @throws AppError
     */
    public function render(int $appCode=1,string $msg='', $data=null,int $httpCode=200,int $errorLevel=0):Response
    {
        if($this->appCode!==1&&$appCode!==1){
            $this->setCode($appCode);
        }
        if($msg!==''&&$this->msg!==''){
            $this->setMsg($msg);
        }
        if(empty($data)===false){
            $this->setData($data);
        }
        if($httpCode !==200&& $this->httpCode!==200){
            $this->setHttpCode($httpCode);
        }
        if($errorLevel!==0&&$this->errorLevel!==0){
            $this->setErrorLevel($errorLevel);
        }
        if($this->appCode<-100){
            return $this->throw();
        }else{
            return $this->response();
        }
    }
    protected function response():Response
    {

        $this->responseData['code']   =   $this->appCode;
        if($this->msg!==''){
            $this->responseData['msg']    =   $this->msg;
        }
        if(empty($this->selfData)===false){
            $this->responseData['data']    =   $this->selfData;
        }
        $this->getDebugData();
        return json($this->responseData)->code($this->httpCode);
    }
    protected function throw():Response
    {
        throw new AppError($this->appCode,$this->msg,$this->responseData,$this->httpCode,$this->errorLevel);
    }
    protected function getDebugData()
    {
        if(app()->isDebug()){
            Debug::remark('end');
            $this->responseData['time'] =   Debug::getRangeTime('start','end');
            $this->responseData['mem'] =   Debug::getRangeMem('start','end');
        }
        return true;
    }

    /**
     * 绑定data
     * @param $data
     * @return $this
     * @throws AppError
     */
    public function setData($data)
    {
        if($data instanceof Model   ||  $data instanceof Collection){
            $data =   $data->toArray();
        }
        if(is_array($data)){
            $this->selfData =   array_merge($this->selfData,$data);
            return  $this;
        }else{
            throw new AppError(-999,'data数据类型错误');
        }
    }
    public function setCode(int $appCode)
    {
        $this->appCode =   $appCode;
        return $this;
    }
    public function setHttpCode(int $httpCode)
    {
        $this->httpCode =   $httpCode;
        return $this;
    }
    public function setMsg(string $msg)
    {
        $this->msg  =   $msg;
        return $this;
    }
    public function setErrorLevel(int $level)
    {
        $this->errorLevel  =   $level;
        return $this;
    }


}