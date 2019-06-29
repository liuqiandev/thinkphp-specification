<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 17:53
 */

namespace app\common\error;


use think\Exception;

class AppError extends Exception
{
    public $selfCode;
    public $msg;
    public $data;
    public $httpCode;
    public $errorLevel;

    /**
     * 自定义异常类，用于业务逻辑中中断逻辑抛出业务异常
     * AppError constructor.
     * @param int $selfCode
     * @param string $msg
     * @param array $data
     * @param int $httpCode
     * @param int $errorLevel
     */
    public function __construct(int $selfCode,string $msg='',array $data=[],int $httpCode=200,int $errorLevel=0)
    {
        $this->selfCode =   $selfCode;
        $this->msg  =   $msg;
        $this->data =   $data;
        $this->httpCode =   $httpCode;
        $this->errorLevel   =  $errorLevel;
    }

}