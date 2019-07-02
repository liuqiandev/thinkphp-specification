# Thinkphp逻辑分层项目实例

运行环境：

```
php7.1+
composer
```

安装运行

```
cd 到目录下
composer install
```
或者将application目录覆盖全新安装的thinkphp5.1的application目录

## 特性描述
1. 前置中间件动态加载配置项 `application/common/middleware/AppConst`

2. 前置中间件动态绑定逻辑类 `application/common/middleware/AppLogic`

3. 前置中间件自动完成独立验证 `application/common/middleware/AppValidate`

4. 自定义异常接管 `application/common/exception/ExceptionHandle`

5. 自定义响应 `application/common/response/AppResponse`

6. 自定义响应facade类注解 `app\common\response\facade\AppResponse`