<?php
/**
 * 前置中间件
 * 中间件使用注意事项：
 * 1、全局/模块中间件只使用Before||BeforeModule和After|AfterModule来命名
 * 2、在中间件类中，按照业务需求，按照顺序加载相应的逻辑类
 * 3、全局中间件存放位置：application/common/middleware中
 * 4、模块中间件存放位置：application/module/middleware中
 */
namespace app\http\middleware;


use app\common\middleware\AppConst;
use app\common\middleware\Auth;

class Before
{
    public function handle($request, \Closure $next)
    {
        //用于动态加载某些配置项作为应用的常量
        //其实也可以用类的构造函数来实现，但不推荐
        //此处采用app()来将AppConst::class绑定到容器，方便在后续逻辑中访问
        app(AppConst::class)->render();
        //一个简单的权限验证示例
        app(Auth::class)->render();
        return $next($request);
    }
}
