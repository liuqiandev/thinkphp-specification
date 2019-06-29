<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/29
 * Time: 21:53
 */

namespace app\index\pc_logic;


use app\common\library\BaseLogic;
use app\common\middleware\AppConst;
use app\index\model\User;
use think\Request;
use app\index\service\UserGroup;

class Index extends BaseLogic
{
    public function client(Request $request)
    {
        $this->selfData['param']    =   $request->param();
        $this->selfData['class']    =   __CLASS__;
        return $this;
    }
    public function userInfo()
    {
        $user = new User();
        $this->selfData['avatar'] =   $user->avatar[(string)app(AppConst::class)->client];
        $this->selfData['desc'] =   $user->desc;
        $this->selfData['class']    =   __CLASS__;
        return $this;
    }
    public function userGroup()
    {
        $this->selfData =   app(UserGroup::class)->getUserGroupInfo();
        $this->selfData['class']    =   __CLASS__;
        return $this;
    }
}