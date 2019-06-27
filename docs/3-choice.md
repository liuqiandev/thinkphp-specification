# 选择适合你/团队的组件使用方式
在thinkphp的内置组件中，框架提供了多重实现方式：
#### 1、助手函数
框架提供了多重助手函数，在官方手册中，关于助手函数的描述为：
```
系统为一些常用的操作提供了助手函数支持，但核心框架本身并不依赖任何助手函数。
使用助手函数和性能并无直接影响，只是某些时候无法享受IDE自动提醒的便利，但是否使用助手函数看项目自身规范，在应用的公共函数文件中也可以对系统提供的助手函数进行重写。
```
我们再来看一个`cache()`的具体实现，所有助手函数默认都在`thinkphp/helper.php`中：
```
if (!function_exists('cache')) {
    /**
     * 缓存管理
     * @param mixed     $name 缓存名称，如果为数组表示进行缓存设置
     * @param mixed     $value 缓存值
     * @param mixed     $options 缓存参数
     * @param string    $tag 缓存标签
     * @return mixed
     */
    function cache($name, $value = '', $options = null, $tag = null)
    {
        if (is_array($options)) {
            // 缓存操作的同时初始化
            Cache::connect($options);
        } elseif (is_array($name)) {
            // 缓存初始化
            return Cache::connect($name);
        }

        if ('' === $value) {
            // 获取缓存
            return 0 === strpos($name, '?') ? Cache::has(substr($name, 1)) : Cache::get($name);
        } elseif (is_null($value)) {
            // 删除缓存
            return Cache::rm($name);
        }

        // 缓存数据
        if (is_array($options)) {
            $expire = isset($options['expire']) ? $options['expire'] : null; //修复查询缓存无法设置过期时间
        } else {
            $expire = is_numeric($options) ? $options : null; //默认快捷缓存设置过期时间
        }

        if (is_null($tag)) {
            return Cache::set($name, $value, $expire);
        } else {
            return Cache::tag($tag)->set($name, $value, $expire);
    }
    }
}
```
我们可以看到，其实`cache()`这个助手实现的都是`think\facade\Cache`这个类的一些操作。这也正是另外一种选择。
#### 2、容器管理类
容器管理类的引入使得tp5.1更加现代化，同时也可以使我们的编码更加规范。现代化的mvc框架都是统一入口，在这个统一入口中，一般会实例化一个基类，然后通过这个基类去加载执行各式各样的逻辑，而在tp5.1中，这个基类正是容器基类`Container`。在容器基类中，默认绑定了框架的一些基础组件，在`thinkphp\library\think\Container.php`的66行，你可以看到默认绑定的一些组件实现类。

如果你需要将自己的类或者属性绑定到容器中，可以参考[官方手册：容器和依赖注入](https://www.kancloud.cn/manual/thinkphp5_1/353958)。

门面（Facade）是一个特殊的容器管理方式，它让你可以通过创建一个Facade子类的方式完成容器绑定工作，而且提供静态访问的方式。
#### 3、实例化组件类
我们不推荐这种方式访问内置组件，也不推荐这种方式访问扩展。

### 推荐的选择
1、使用容器管理的助手函数`app()`或容器管理类`Container::get()`来管理和访问非框架内置组件/扩展。

2、使用门面（Facade）来管理可以定义Facade的非框架内置组件/扩展。

3、使用[核心Facade类库](https://www.kancloud.cn/manual/thinkphp5_1/353959)来管理和访问框架内置组件。

**注意事项：并非所有的自定义组件/扩展/类库都适合定义一个Facade类。**