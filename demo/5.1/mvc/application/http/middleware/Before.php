<?php

namespace app\http\middleware;

use app\common\middleware\AppConst;
use app\common\middleware\AppLogic;
use app\common\middleware\AppValidate;

class Before
{
    public function handle($request, \Closure $next)
    {
        app(AppConst::class)->render($request);
        app(AppLogic::class)->render();
        app(AppValidate::class)->render();
        return $next($request);
    }
}
