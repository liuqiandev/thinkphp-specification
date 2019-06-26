<?php

namespace app\http\middleware;

class CrossDomain
{
    //原始header
    protected $originHeader =[
        'Content-Type',
        'If-Match',
        'If-Modified-Since',
        'If-None-Match',
        'If-Unmodified-Since',
        'X-Requested-With'
    ];
    public function handle($request, \Closure $next)
    {
        $optionHeader[] = 'Authorization';
        $allowHeader    = implode(',', array_merge($this->originHeader, $optionHeader));
        //$allowOrigin    = implode(',', Config::get('const.cross.optionOrigin'));
        $allowOrigin    =   '*';
        $allowMethods   =   '*';
        //设置返回header
        header('Access-Control-Allow-Origin:' . $allowOrigin);
        header('Access-Control-Allow-Methods:' . $allowMethods);
        header('Access-Control-Allow-Headers:' . $allowHeader);
        if ($request->method() == "OPTIONS" || $request->method() == "options") {
            return \response(__CLASS__);
        }else{
            return $next($request);
        }
    }
}
