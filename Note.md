## ThinkPHP5.1 入门开启

### 一．框架简介
1. ThinkPHP5.1 是目前框架正式版的最新版本；
2. ThinkPHP6.0 目前是预览版（尚未稳定的测试版），正式版后考虑制作；
3. TP 框架是免费开源的、轻量级的、简单快速且敏捷的 PHP 框架；
4. 你可以免费使用 TP 框架，甚至可以将你的项目商用；
5. ThinkPHP5.1 要求 PHP 版本是 5.6+以上（目前最新版本是 7.x）；
6. 我们采用最新 7.x 来运行 TP5.1，而预览版 TP6 需要 7.1+；
7. 集成环境这里采用 windows 结合 wamp，其它系统或环境满足版本要求即可;
8. 除了 PHP5.6+，还需要开启 PDO 数据库引擎和 MBstring 字符串扩展；

### 二．安装步骤
1. 官网不提供软件包下载，采用 Composer 和 git 方式下载和更新；
2. 这里只演示 windows 安装，Mac 和 Linux 方法参考一下手册；
3. 打开 windows 下的运行：cmd，然后运行如下代码（Mac 和 Linux 控制台）：
  ```
  composer config -g repo.packagist composer https://packagist.phpcomposer.com
  ```
4. 如果上述地址产生阻碍，可以使用国内的：
  ```
  composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
  ```
5. 现在，先启用服务器环境，测试本地 Web 环境是否正常；
6. 如果你是首次安装 ThinkPHP5.1，那么先从 cmd 中切换到你要加载的目录；
  ```
  composer create-project topthink/think=5.1.* tp5.1test
  ```
7. 通过访问 http://localhost/tp5.1test/public 测试是否进入首页；
8. 如果要更新你的项目版本，直接进入项目根目录，然后直接如下代码：
  ```
  composer update topthink/framework
  ```

### 三．其它杂项
1. 开发规范遵循 PSR-2 命名规范、PSR-4 自动加载；
2. 目录结构，可以参考手册，课程中会慢慢熟知，不摘入了；
3. 对于框架的配置，在以后课程中，遇到某个讲解某个；
4. 学习条件：必须具有 PHP 基础，面向对象基础和 MVC 设计模式基础；


## URL 解析模式

### 一．URL 解析

1. ThinkPHP 框架非常多的操作都是通过 URL 来实现的；

2. `http://serverName/index.php/模块/控制器/操作/参数/值…`；

3. index.php 为入口文件，在 public 目录内的 index.php 文件；

4. 模块在 application 目录下默认有一个 index 目录，这就是一个模块；

5. 而在 index 目录下有一个 controller 控制器目录的 Index.php 控制器；

6. Index.php 控制器的类名也必须是 class Index，否则错误；

7. 而操作就是控制器 class Index 里面的方法，比如：index 或 hello；

8. 那么完整形式为：`public/index.php/index/index/index`

9. 官方给的默认模块，默认控制器，默认操作都是 index，所以出现四个 index；

10. 而操作还另给了一个带参数的方法：hello，如下:

11. 那么完整形式为：`public/index.php/index/index/hello/name/Lee`

12. 为了更清晰的了解 URL 路径的执行过程，我们自己创建一个完全不重复的 URL；

13. 在 application 目录下创建一个 test 目录（模块）；

14. 在 test 模块下创建控制器目录 controller，并在旗下创建 Abc.php（控制器）;

15. 创建如下代码：

    ```php
    <?php
    namespace app\test\controller;
    class Abc
    {
        public function eat($who = '隔壁老王')
        {
        	return $who.'吃饭！';
        }
    }
    ```

    

16. 代码中 eat 是方法（操作），`$who` 是`参数`，'隔壁老王'是`值`；

17. 完整形式为：`public/index.php/test/abc/eat/who/主人老李`

### 二．URL 模式
1. 上个要点已经了解了 URL 所有访问规则，通过创建 test 模块更加了解；
2. 如果 wamp 环境没有开启伪静态，那么 ThinkPHP 不支持 URL 重写；
3. 没有开启 URL 重写，那只能使用 PATH_INFO 模式，如下：
4. `public/index.php?s=test/abc/eat/who/主人老李`；
5. 我们这里是 Apache，其它环境请，如果你使用了，请参考手册；
6. 打开 httpd.conf 文件，加载 mod_rewrite.so，即去掉前面的#号；
7. 将下面代码，放入入口文件 index.php 同级目录下的.htaccess；
8. 上一步，框架本身已经做好了，那其实就是第 6 步一步，然后重启环境；
9. 此时的 URL 重写，可以省略 index.php 了，路径如下：
10. `public/test/abc/eat/who/主人老李`



## 模块设计

### 一．目录结构

1. ThinkPHP5.1 默认是多模块架构，也可以设置为单模块操作；

2. 所有模块的命名空间以 app 这三个字母作为根命名空间（可通过环境变量更改）；

3. 手册摘入的结构列表：

   ![image-20210221140546628](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210221140546628.png)


4. 模块下的类库文件命名空间统一为：app\模块名；

5. 比如：`app\index\controller\Index`

6. 多模块设计在 URL 访问时，必须指定相应的模块名，比如：public/test/abc/eat；

7. 如果你只有 test 这一个模块时，你可以绑定这个模块，从而省略写法；

8. 打开 public/index.php 的文件，追加一个方法：

  ```
  Container::get('app')->bind('test')->run()->send();
  ```

9. 此时，URL 调用就变成了：public/abc/eat；多模块时，则其它无法访问；

10. 如果你的应用特别简单，只有一个模块，一个控制器，那改写下追加的方法：

    ```
    Container::get('app')->bind('test/abc')->run()->send();
    ```

11. 此时，URL 调用就变成了：public/eat；得到了极简；其它控制器则无法访问；

### 二．空模块

1. 可以通过环境变量设置空目录，将不存在的目录统一指向指定目录；

2. 在 config 目录下的 app.php 修改：

  ```
  // 默认的空模块名
  'empty_module' => 'index',
  ```

3. 空模块只有在多模块开启，且没有绑定模块的情况下生效；

### 三．单一模块

1. 如果你的应用只有一个模块，那可以直接设置单模块；

2. 在 config 目录下的 app.php 修改：
   
  ```
  // 是否支持多模块
    'app_multi_module' => false,
  ```

3. 目录结构可变为，手册摘入：

   ![image-20210221140502802](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210221140502802.png)

4. URL 地址 `public/index/one`，即：控制器/操作；

5. 单一模块的命名空间也变更为：app/controller；

### 四．环境变量

1. ThinkPHP5.1 提供了一个类库 Env 来获取环境变量；
    `return Env::get('app_path');`

| 系统路径      | Env 参数名称 |
| ------------- | ------------ |
| 应用根目录    | root_path    |
| 应用目录      | app_path     |
| 框架目录      | think_path   |
| 配置目录      | config_path  |
| 扩展目录      | extend_path  |
| composer 目录 | vendor_path  |
| 运行缓存目录  | runtime_path |
| 路由目录      | route_path   |
| 当前模块目录  | module_path  |


## 控制器定义

### 一．控制器定义

1. 控制器，即 controller，控制器文件存放在 controller 目录下；

2. 类名和文件名大小写保持一致，并采用驼峰式（首字母大写）；

  ```
  use think\Controller;
  class Index extends Controller
  ```

3. 继承控制器基类，可以更方便使用功能，但不是必须的；

4. 系统也提供了其它方式，在不继承的情况下完成相同功能；

5. 前面我们知道如果是一个单词，首字母大写，比如 class Index；

6. URL 访问时直接 public/index 即可；

7. 那么如果创建的是双字母组合，比如 class HelloWorld；

8. URL 访问时必须为：public/hello_world；

9. 如果你想原样的方式访问 URL，则需要关闭配置文件中自动转换；
    `'url_convert' => false,`

10. 此时，URL 访问可以为：public/HelloWorld；

11. 如果你想改变根命名空间 app 为其它，可以在根目录下创建.env 文件；

12. 然后写上配对的键值对即可，app_namespace=application;

### 二．渲染输出

13. ThinkPHP 直接采用方法内 return 返回的方式直接就输出了；

14. 使用 json 输出，直接采用 json 函数；

   ```
   $data = array('a'=>1, 'b'=>2, 'c'=>3);
   return json($data);
   ```

15. 使用 view 输出模版，开启错误提示，可知道如何创建模版；
      `return view();`

16. 默认输出方式为 html 格式输出，如果返回的是数组，则会报错；

17. 可以更改配置文件里的默认输出类型，更改为 json；

   ```
   return ['user'=>'Lee', 'age'=>100];
      'default_return_type' => 'json',
   ```

18. 一般来说，正常页面都是 html 输出，用于模版，AJAX 默认为 json；

19. 如果继承了基类控制器，那么可以定义控制器初始化方法：initialize()；

20. initialize()方法会在调用控制器方法之前执行；

   ```
    protected function initialize()
    {
        //parent::initialize();
     echo 'init';
    }
   ```

21. initialize()方法不需要任何返回值，输出用 PHP 方式，return 无效；

