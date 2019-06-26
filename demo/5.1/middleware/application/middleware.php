<?php
/**
 * Created by PhpStorm.
 * User: se7en
 * Date: 2019/6/26
 * Time: 21:46
 */
/**
 * 注意事项：如果需要判断跨域请求，请将CrossDomain放在最前
 */
return [
    \app\http\middleware\CrossDomain::class,
    \app\http\middleware\Before::class
];