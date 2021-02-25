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


## 控制器操作

### 一．前置操作

1. 继承 Controller 类后可以设置一个$beforeActionList 属性来创建前置方法；

  ```php
  protected $beforeActionList = [
      'first',
      //one 方法执行不调用 second 前置
      'second' => ['except'=>'one'],
      //third 前置只能通过调用 one 和 two 方法触发
      'third' => ['only'=>'one, two'],
  ];
  protected function first()
  {
  	echo 'first<br/>';
  }
  ```

2. 此时，我们可以分别 URL 访问不同的方法来理解前置的触发执行；

### 二．跳转和重定向

1. Controller 类提供了两个跳转的方法，success(msg,url)和 error(msg)；

  ```php
  public function index()
  {
      if ($this->flag) {
          //如果不指定 url，则返回$_SERVER['HTTP_REFERER']
          $this->success('成功！', '../');
      } else {
          //自动返回前一页
          $this->error('失败！');
      }
  }
  ```

2. 成功或错误有一个固定的页面模版：'thinkphp/tpl/dispatch_jump.tpl'；

3. 在 app.php 配置文件中，我们可以更改自己个性化的跳转页面；

  ```
  // 默认跳转页面对应的模板文件
  'dispatch_success_tmpl' => Env::get('think_path') .
  'tpl/dispatch_jump.tpl',
  'dispatch_error_tmpl' => Env::get('think_path') .
  'tpl/dispatch_jump.tpl',
  ```

4. 如果需要自定义跳转页面，可以使用如下的模版变量：

| 变量  | 说明                  |
| ----- | --------------------- |
| $data | 要返回的数据          |
| $msg  | 页面提示信息          |
| $code | 返回的 code           |
| $wait | 跳转等待时间 单位为秒 |
| $url  | 跳转页面地址          |

### 三．空方法和空控制器

1. 当访问了一个不存在的方法时，系统会报错，我们可以使用_empty()来拦截；

  ```php
  public function _empty($name)
  {
  	return '不存在当前方法：'.$name;
  }
  ```

2. 当访问了一个不存在的控制器时，系统也会报错，我们可以使用 Error 类来拦截；

  ```php
  class Error
  {
      public function index(Request $request)
      {
      	return '当前控制器不存在：'.$request->controller();
      }
  }
  ```

3. 系统默认为 Error 类，如果需要自定义，则在 app.php 配置文件中修改；

  ```
  // 默认的空控制器名
  'empty_controller' => 'Error',
  ```


## 数据库与模型

### 一．连接数据库

1. ThinkPHP 采用内置抽象层将不同的数据库操作进行封装处理；

2. 数据抽象层基于 PDO 模式，无须针对不同的数据库编写相应的代码；

3. 使用数据库的第一步，就是连接你的数据库；

4. 在根目录的 config 下的 database.php 可以设置数据库连接信息；

5. 大部分系统已经给了默认值，你只需要修改和填写需要的值即可；

  ```php
  // 数据库类型
  'type' => 'mysql',
  // 服务器地址
  'hostname' => '127.0.0.1',
  // 数据库名
  'database' => 'grade',
  // 用户名
  'username' => 'root',
  // 密码
  'password' => '123456',
  // 端口
  'hostport' => '3306',
  // 编码
  'charset' => 'utf8',
  // 数据库表前缀
  'prefix' => 'tp_',
  ```

6. type 属性默认支持的数据库有：mysql、sqlite、pgsql、sqlsrv；

7. 还有其它很多连接的细节和方式，需要在具体问题中或项目才能更好理解；

8. 比如：字符串连接 dsn、多模块、动态连接等，这里都暂略；

9. 配置完数据库，我们使用如下代码，在控制器端输出 mysql 里的数据；

  ```php
  public function getNoModelData()
  {
      //$data = Db::table('tp_user')->select();
      $data = Db::name('user')->select();
      return json($data);
  }
  ```

### 二．模型定义

1. 在 MVC 中，我们已经使用过 Controller(C)，View(V)，剩下一个就是 Model(M)；

2. Model 即模型，就是处理和配置数据库的相关信息；

3. 在项目应用根目录创建 model 文件夹，并且创建 User.php；

  ```php
  namespace app\model;
  use think\Model;
  class User extends Model
  {
  }
  ```

4. 当创建了 User 模型了，控制器端可以这么写：

  ```php
  public function getModelData()
  {
      $data = User::select();
      return json($data);
  }
  ```

5. 而此时，命名空间会自动导入 User 模型：use app\model\User;

6. 很多时候，我们需要调试 SQL 是否正确，建议打开 Trace，可以查看原生 SQL；

  ```php
  // 应用 Trace
  'app_trace' => true,
  ```


## 查询数据

### 一．基本查询

1. Db::table()中 table 必须指定完整数据表（包括前缀）；
2. 如果希望只查询一条数据，可以使用 find()方法；
`Db::table('tp_user')->find();`
3. Db::getLastSql()方法，可以得到最近一条 SQL 查询的原生语句；
`SELECT * FROM `tp_user` LIMIT 1`
4. 想指定数据查询，可以使用 where()方法；
`Db::table('tp_user')->where('id', 27)->find()`
SELECT * FROM `tp_user` WHERE `id` = 27 LIMIT 1
5. 没有查询到任何值，则返回 null；
6. 使用 findOrFail()方法同样可以查询一条数据，在没有数据时抛出一个异常；
`Db::table('tp_user')->where('id', 1)->findOrFail()`
7. 使用 findOrEmpty()方法也可以查询一条数据，但在没有数据时返回一个空数组；
    `Db::table('tp_user')->where('id', 1)->findOrEmpty();`
8. 想要获取多列数据，可以使用 select()方法；
    `Db::table('tp_user')->select();`
   SELECT * FROM `tp_user`
9. 多列数据在查询不到任何数据时返回空数组，使用 selectOrFail()抛出异常；
`Db::table('tp_user')->where('id', 1)->selectOrFail();`
10. 当在数据库配置文件中设置了前缀，那么我们可以使用 name()方法忽略前缀；
`Db::name('user')->selectOrFail();``

### 二．更多方式

1. ThinkPHP 提供了一个助手函数 db，可以更方便的查询；
`\db('user')->select();`
2. 通过 value()方法，可以查询指定字段的值（单个），没有数据返回 null；
`Db::name('user')->where('id', 27)->value('username');`
3. 通过 colunm()方法，可以查询指定列的值（多个），没有数据返回空数组；
`Db::name('user')->column('username');`
4. 可以指定 id 作为列值的索引；
`Db::name('user')->column('username', 'id');`
5. 数据分批处理、大批数据处理和 JSON 数据查询，当遇到具体问题再探讨；


## 链式查询

### 一．查询规则

1. 前面课程中我们通过指向符号“->”多次连续调用方法称为：链式查询；
2. 当 Db::name('user')时，返回数据库对象，即可连缀数据库对应的方法；
3. 而每次执行一个数据库查询方法时，比如 where()，还将返回数据库对象；
4. 只要还是数据库对象，那么就可以一直使用指向符号进行链式查询；
5. 如果想要最后得到结果，可以使用 find()、select()等方法结束查询；
6. 而 find()和 select()是结果查询方法（放在最后），并不是链式查询方法；
`Db::name('user')->where('id', 27)->order('id', 'desc')->find()`
7. 除了查询方法可以使用链式连贯操作，CURD 操作也可以使用（下节课研究）；
8. 那么，有多少种类似 where()的链式操作方法呢？打开手册看一下...

### 二．更多查询
1. 如果多次使用数据库查询，那么每次静态创建都会生成一个实例，造成浪费；

2. 我们可以把对象实例保存下来，再进行反复调用即可；

  ```php
  $user = Db::name('user');
  $data = $user->select();
  ```

3. 当同一个对象实例第二次查询后，会保留第一次查询的值；

  ```php
  $data1 = $user->order('id', 'desc')->select();
  $data2 = $user->select();
  return Db::getLastSql();
  ```

  SELECT * FROM `tp_user` ORDER BY `id` DESC

4. 使用 removeOption()方法，可以清理掉上一次查询保留的值；

  ```php
  $user->removeOption('where')->select();
  ```


## 增删改操作

### 一．新增数据

1. 使用 insert()方法可以向数据表添加一条数据；

  ```php
  $data = [
  'username' => '辉夜',
  'password' => '123',
  'gender' => '女',
  'email' => 'huiye@163.com',
  'price' => 90,
  'details' => '123',
  'create_time' => date('Y-m-d H:i:s')
  ];
  Db::name('user')->insert($data);
  ```

2. 如果新增成功，insert()方法会返回一个 1 值；

  ```php
  $flag = Db::name('user')->insert($data);
  if ($flag) return '新增成功！';
  ```

3. 你可以使用 data()方法来设置添加的数据数组；
    `Db::name('user')->data($data)->insert();`

4. 如果你添加一个不存在的数据，会抛出一个异常 Exception；

5. 如果采用的是 mysql 数据库，支持 REPLACE 写入；
    `Db::name('user')->insert($data, true);`

6. 使用 insertGetId()方法，可以在新增成功后返回当前数据 ID；
    `Db::name('user')->insertGetId($data);`

7. 使用 insertAll()方法，可以批量新增数据，但要保持数组结构一致；

  ```php
  $data = [
  [
  'username' => '辉夜 1',
  'password' => '123',
  'gender' => '女',
  'email' => 'huiye@163.com',
  'price' => 90,
  'details' => 123,
  'create_time' => date('Y-m-d H:i:s')
  ],
  [
  'username' => '辉夜 2',
  'password' => '123',
  'gender' => '女',
  'email' => 'huiye@163.com',
  'price' => 90,
  'details' => 123,
  'create_time' => date('Y-m-d H:i:s')
  ],
  ];
  Db::name('user')->insertAll($data);
  ```

8. 批量新增也支持 data()方法，和单独新增类似；
    `Db::name('user')->data($data)->insertAll();`

9. 批量新增也支持 reaplce 写入，和单独新增类似；
`Db::name('user')->insertAll($data, true);`

### 二．修改数据

1. 使用 update()方法来修改数据，修改成功返回影响行数，没有修改返回 0；

  ```php
  $data = [
  'username' => '李白'
  ];
  $update = Db::name('user')->where('id', 38)->update($data);
  return $update;
  ```

2. 或者使用 data()方法传入要修改的数组，如果两边都传入会合并；
    `Db::name('user')->where('id', 38)->
    data($data)->update(['password'=>'456']);`

3. 如果修改数组中包含主键，那么可以直接修改；

  ```php
  $data = [
  'username' => '李白',
  'id' => 38
  ];
  Db::name('user')->update($data);
  ```

4. 使用 inc()方法可以对字段增值， dec()方法可以对字段减值；
    `Db::name('user')->inc('price')->dec('price', 3)->update($data);`

5. 增值和减值如果同时对一个字段操作，前面一个会失效；

6. 使用 exp()方法可以在字段中使用 mysql 函数；
    `Db::name('user')->exp('email', 'UPPER(email)')->update($data);`

7. 使用 raw()方法修改更新，更加容易方便；

  ```php
  $data = [
  'username' => '李白',
  'email' => Db::raw('UPPER(email)'),
  'price' => Db::raw('price - 3'),
  'id' => 38
  ];
  Db::name('user')->update($data);
  ```

8. 使用 setField()方法可以更新一个字段值；
    `Db::name('user')->where('id', 38)->setField('username', '辉夜');`

9. 增值 setInc()和减值 setDec()也有简单的做法，方便更新一个字段值；
    `Db::name('user')->where('id', 38)->setInc('price');`

10. 增值和减值如果不指定第二个参数，则步长为 1；

### 三．删除数据

1. 极简删除可以根据主键直接删除，删除成功返回影响行数，否则 0；
`Db::name('user')->delete(51);`
2. 根据主键，还可以删除多条记录；
`Db::name('user')->delete([48,49,50]);`
3. 正常情况下，通过 where()方法来删除；
`Db::name('user')->where('id', 47)->delete();`
4. 通过 true 参数删除数据表所有数据，我还没测试，大家自行测试下；
`Db::name('user')->delete(true);`


## 查询表达式

### 一．比较查询

1. 在查询数据进行筛选时，我们采用 where()方法，比如 id=80；
`Db::name('user')->where('id', 80)->find();`
`Db::name('user')->where('id','=',80)->find();`
2. where(字段名,查询条件)，where(字段名,表达式,查询条件)；
3. 其中，表达式不区分大小写，包括了比较、区间和时间三种类型的查询；
4. 使用`<>`、`>`、`<`、`>=`、`<=`可以筛选出各种符合比较值的数据列表；
`Db::name('user')->where('id','<>',80)->select();`

### 二．区间查询

1. 使用 like 表达式进行模糊查询；
`Db::name('user')->where('email','like','xiao%')->select();`
2. like 表达式还可以支持数组传递进行模糊查询；
`Db::name('user')->where('email','like',['xiao%','wu%'], 'or')->select();`
SELECT * FROM `tp_user` WHERE (`email` LIKE 'xiao%' OR `email` LIKE 'wu%')
3. like 表达式具有两个快捷方式 whereLike()和 whereNoLike()；
`Db::name('user')->whereLike('email','xiao%')->select();`
`Db::name('user')->whereNotLike('email','xiao%')->select();`
4. between 表达式具有两个快捷方式 whereBetween()和 whereNotBetween()；
`Db::name('user')->where('id','between','19,25')->select();`
`Db::name('user')->where('id','between',[19, 25])->select();`
`Db::name('user')->whereBetween('id',[19, 25])->select();`
`Db::name('user')->whereNotBetween('id',[19, 25])->select();`
5. in 表达式具有两个快捷方式 whereIn()和 whereNotIn()；
`Db::name('user')->where('id','in', '19,21,29')->select();`
`Db::name('user')->whereIn('id','19,21,29')->select();`
`Db::name('user')->whereNotIn('id','19,21,29')->select();`
6. null 表达式具有两个快捷方式 whereNull()和 whereNotNull()；
`Db::name('user')->where('uid','null')->select();`
`Db::name('user')->where('uid','not null')->select();`
`Db::name('user')->whereNull('uid')->select();`
`Db::name('user')->whereNotNull('uid')->select();`

### 三．其它查询

1. 使用 exp 可以自定义字段后的 SQL 语句；
`Db::name('user')->where('id','exp','IN (19,21,25)')->select();`
`Db::name('user')->whereExp('id','IN (19,21,25)')->select();`


## 时间查询

### 一．传统方式

1. 可以使用`>`、`<`、`>=`、`<=`来筛选匹配时间的数据；
`Db::name('user')->where('create_time', '> time', '2018-1-1')->select();`
2. 可以使用 between 关键字来设置时间的区间；
`Db::name('user')->where('create_time', 'between time', ['2018-1-1',
'2019-12-31'])->select();`
`Db::name('user')->where('create_time', 'not between time', ['2018-1-1',
'2019-12-31'])->select();`

### 二．快捷方式

1. 时间查询的快捷方法为 whereTime()，直接使用`>`、`<`、`>=`、`<=`；
`Db::name('user')->whereTime('create_time', '>', '2018-1-1')->select();`
2. 快捷方式也可以使用 between 和 not between；
`Db::name('user')->whereBetween('create_time', ['2018-1-1',
'2019-12-31'])->select();`
3. 还有一种快捷方式为：whereBetweenTime()，如果只有一个参数就表示一天；
`Db::name('user')->whereBetweenTime('create_time', '2018-1-1',
'2019-12-31')->select();`
4. 默认的大于>，可以省略；
`Db::name('user')->whereTime('create_time', '2018-1-1')->select();`

### 三．固定查询

| 关键字     | 说明 |
| ---------- | ---- |
| today 或 d | 今天 |
| yesterday  | 昨天 |
| week 或 w  | 本周 |
| last week  | 上周 |
| month 或 m | 本月 |
| last month | 上月 |
| year 或 y  | 今年 |
| last year  | 去年 |

`Db::name('user')->whereTime('create_time','d')->select();`
`Db::name('user')->whereTime('create_time','y')->select();`

### 四．其它查询

1. 查询指定时间的数据，比如两小时内的；
`Db::name('user')->whereTime('create_time', '-2 hour')->select();`
2. 查询两个时间字段时间有效期的数据，比如会员开始到结束的期间；
`Db::name('user')->whereBetweenTimeField('start_time',
'end_time')->select();`


## 聚合、原生和子查询

### 一．聚合查询

1. 使用 count()方法，可以求出所查询数据的数量；
`Db::name('user')->count();`
2. count()可设置指定 id，比如有空值(Null)的 uid，不会计算数量；
`Db::name('user')->count('uid');`
3. 使用 max()方法，求出所查询数据字段的最大值；
`Db::name('user')->max('price');`
4. 如果 max()方法，求出的值不是数值，则通过第二参数强制转换；
`Db::name('user')->max('price', false);`
5. 使用 min()方法，求出所查询数据字段的最小值，也可以强制转换；
`Db::name('user')->min('price');`
6. 使用 avg()方法，求出所查询数据字段的平均值；
`Db::name('user')->avg('price');`
7. 使用 sum()方法，求出所查询数据字段的总和；
`Db::name('user')->sum('price');`

### 二．子查询

1. 使用 fetchSql()方法，可以设置不执行 SQL，而返回 SQL 语句，默认 true；
    `Db::name('user')->fetchSql(true)->select();`

2. 使用 buidSql()方法，也是返回 SQL 语句，但不需要再执行 select()，且有括号；
    `Db::name('user')->buildSql(true);`

3. 结合以上方法，我们实现一个子查询；

  ```php
  $subQuery = Db::name('two')->field('uid')->where('gender',
  '男')->buildSql(true);
  $result = Db::name('one')->where('id','exp','IN '.$subQuery)->select();
  ```

4. 使用闭包的方式执行子查询；

  ```php
  $result = Db::name('one')->where('id', 'in', function ($query) {
  	$query->name('two')->where('gender', '男')->field('uid');
  })->select();
  ```

### 三．原生查询

1. 使用 query()方法，进行原生 SQL 查询，适用于读取操作，SQL 错误返回 false；
`Db::query('select * from tp_user');`
2. 使用 execute 方法，进行原生 SQL 更新写入等，SQL 错误返回 false；
`Db::execute('update tp_user set username="孙悟空" where id=29');`


## 链式方法【上】

### 一．where

1. 表达式查询，就是 where()方法的基础查询方式；
    `Db::name('user')->where('id', '>', 70)->select();`

2. 关联数组查询，通过键值对来数组键值对匹配的查询方式；

  ```php
  $result = Db::name('user')->where([
  'gender' => '男',
  'price' => 100 //'price' => [60,70,80]
  ])->select();
  ```

3. 索引数组查询，通过数组里的数组拼装方式来查询；

  ```php
  $result = Db::name('user')->where([
  ['gender', '=', '男'],
  ['price', '=', '100']
  ])->select();
  ```

4. 将复杂的数组组装后，通过变量传递，将增加可读性；
    `$map[] = ['gender', '=', '男'];`
    `$map[] = ['price', 'in', [60, 70, 80]];`
    `$result = Db::name('user')->where($map)->select();`

5. 字符串形式传递，简单粗暴的查询方式；
`Db::name('user')->where('gender="男" AND price IN (60, 70, 80)')->select();`

### 二．field

1. 使用 field()方法，可以指定要查询的字段；
`Db::name('user')->field('id, username, email')->select();`
`Db::name('user')->field(['id', 'username', 'email'])->select();`
2. 使用 field()方法，给指定的字段设置别名；
`Db::name('user')->field('id,username as name')->select();`
`Db::name('user')->field(['id', 'username'=>'name'])->select();`
3. 在 field()方法里，可以直接给字段设置 MySQL 函数；
`Db::name('user')->field('id,SUM(price)')->select();`
4. 对于更加复杂的 MySQL 函数，必须使用字段数组形式；
`Db::name('user')->field(['id', 'LEFT(email, 5)'=>'leftemail'
])->select();`
5. 使用 field(true)的布尔参数，可以显式的查询获取所有字段，而不是*；
`Db::name('user')->field(true)->select();`
6. 使用 field()方法中字段排除，可以屏蔽掉想要不显示的字段；
`Db::name('user')->field('details,email', true)->select();`
`Db::name('user')->field(['details,email'], true)->select();`
7. 使用 field()方法在新增时，验证字段的合法性；
`Db::name('user')->field('username, email, details')->insert($data);`

### 三．alias

1. 使用 alias()方法，给数据库起一个别名；
`Db::name('user')->alias('a')->select();`


## 链式方法【下】

### 一．limit

1. 使用 limit()方法，限制获取输出数据的个数；
    `Db::name('user')->limit(5)->select();`

2. 分页模式，即传递两个参数，比如从第 3 条开始显示 5 条 limit(2,5)；
    `Db::name('user')->limit(2, 5)->select();`

3. 实现分页，需要严格计算每页显示的条数，然后从第几条开始；

  ```php
  //第一页
  Db::name('user')->limit(0, 5)->select();
  //第二页
  Db::name('user')->limit(5, 5)->select();
  ```

### 二．page

1. page()分页方法，优化了 limit()方法，无须计算分页条数；

  ```php
  //第一页
  Db::name('user')->page(1, 5)->select();
  //第二页
  Db::name('user')->page(2, 5)->select();
  ```

### 三．order

1. 使用 order()方法，可以指定排序方式，没有指定第二参数，默认 asc；
`Db::name('user')->order('id', 'desc')->select();`
2. 支持数组的方式，对多个字段进行排序；
`Db::name('user')->order(['create_time'=>'desc', 'price'=>'asc'])->select();`

### 四．group

1. 使用 group()方法，给性别不同的人进行 price 字段的总和统计；
`Db::name('user')->field('gender, sum(price)')->group('gender')->select();`
2. 也可以进行多字段分组统计；
`Db::name('user')->field('gender, sum(price)')->group('gender,password')->select();`

### 五．having

1. 使用 group()分组之后，再使用 having()进行筛选；

  ```php
  $result = Db::name('user')
  ->field('gender, sum(price)')
  ->group('gender')
  ->having('sum(price)>600')
  ->select();
  ```



## 模型定义

### 一．定义模型

1. 定义一个和数据库表向匹配的模型；

  ```php
  class User extends Model
  ```

2. 模型会自动对应数据表，并且有一套自己的命名规则；

3. 模型类需要去除表前缀(tp_)，采用驼峰式命名，并且首字母大写；
    `tp_user(表名) => User`
    `tp_user_type(表名) => UserType`

4. 如果担心设置的模型类名和 PHP 关键字冲突，可以开启应用类后缀；

5. 在 app.php 中，设置 class_suffix 属性为 true 即可；

  ```php
  // 应用类库后缀
  'class_suffix' => true,
  ```

6. 设置完毕后，所有的控制器类名和模型类名需要加上 Controller 和 Model；

  ```php
  class UserModel
  ```

### 二．设置模型

1. 默认主键为 id，你可以设置其它主键，比如 uid；

  ```php
  protected $pk = 'uid';
  ```

2. 从控制器端调用模型操作，如果和控制器类名重复，可以设置别名；

  ```php
  use app\model\User as UserModel;
  ```

3. 在模型定义中，可以设置其它的数据表；

  ```php
  protected $table = 'tp_one';
  ```

4. 模型和控制器一样，也有初始化，在这里必须设置 static 静态方法；

  ```php
  //模型初始化
  protected static function init()
  {
      //第一次实例化的时候执行 init
      echo '初始化 User 模型';
  }
  ```

### 三．模型操作

1. 模型操作数据和数据库操作一样，只不过不需要指定表了；

  ```php
  UserModel::select();
  ```

2. 数据库操作返回的列表是一个二维数组，而模型操作返回的是一个结果集；
`[[]]` 和 `[{}]`


## 模型添加与删除

### 一．数据添加

1. 使用实例化的方式添加一条数据，首先实例化方式如下，两种均可：

  ```php
  $user = new UserModel();
  $user = new \app\model\User();
  ```

2. 设置要新增的数据，然后用 save()方法写入到数据库中，save()返回布尔值；

  ```php
  $user->username = '李白';
  $user->password = '123';
  $user->gender = '男';
  $user->email = 'libai@163.com';
  $user->price = 100;
  $user->details = '123';
  $user->uid = 1011;
  $user->create_time = date('Y-m-d H:i:s');
  $user->save();
  ```

3. 也可以通过 save()传递数据数组的方式，来新增数据；

  ```php
  $user = new UserModel();
  $user->save([
  'username' => '李白',
  'password' => '123',
  'gender' => '男',
  'email' => 'libai@163.com',
  'price' => 100,
  'details' => '123',
  'uid' => 1011,
  'create_time' => date('Y-m-d H:i:s')
  ]);
  ```

4. 模型新增也提供了 replace()方法来实现 REPLACE into 新增；

  ```php
  $user->replace()->save();
  ```

5. 当新增成功后，使用$user->id，可以获得自增 ID（主键需是 id）；

  ```php
  echo $user->id;
  ```

6. 使用 saveAll()方法，可以批量新增数据，返回批量新增的数组；

  ```php
  $dataAll = [
      [
      'username' => '李白 1',
      'password' => '123',
      'gender' => '男',
      'email' => 'libai@163.com',
      'price' => 100,
      'details' => '123',
      'uid' => 1011,
      'create_time' => date('Y-m-d H:i:s')
      ],
      [
      'username' => '李白 2',
      'password' => '123',
      'gender' => '男',
      'email' => 'libai@163.com',
      'price' => 100,
      'details' => '123',
      'uid' => 1011,
      'create_time' => date('Y-m-d H:i:s')
      ]
  ];
  $user = new UserModel();
  print_r($user->saveAll($dataAll));
  ```

### 二．数据删除

1. 使用 get()方法，通过主键(id)查询到想要删除的数据；

  ```php
  $user = UserModel::get(93);
  ```

2. 然后再通过 delete()方法，将数据删除，返回布尔值；

  ```php
  $user->delete();
  ```

3. 也可以使用静态方法调用 destroy()方法，通过主键(id)删除数据；

  ```php
  UserModel::destroy(92);
  ```

4. 静态方法 destroy()方法，也可以批量删除数据；

  ```php
  UserModel::destroy('80, 90, 91');
  UserModel::destroy([80, 90, 91]);
  ```

5. 通过数据库类的查询条件删除；

  ```php
  UserModel::where('id', '>', 80)->delete();
  ```

6. 使用闭包的方式进行删除；

  ```php
  UserModel::destroy(function ($query) {
  	$query->where('id', '>', 80);
  });
  ```


## 模型修改和查询

### 一．数据修改

1. 使用 get()方法通过主键获取数据，然后通过 save()方法保存修改，返回布尔值；

  ```php
  $user = UserModel::get(118);
  $user->username = '李黑';
  $user->email = 'lihei@163.com';
  $user->save();
  ```

2. 通过 where()方法结合 find()方法的查询条件获取的数据，进行修改；

  ```php
  $user = UserModel::where('username', '李黑')->find();
  $user->username = '李白';
  $user->email = 'libai@163.com';
  $user->save();	
  ```

3. save()方法只会更新变化的数据，如果提交的修改数据没有变化，则不更新；

4. 但如果你想强制更新数据，即使数据一样，那么可以使用 force()方法；

  ```php
  $user->force()->save();
  ```

5. Db::raw()执行 SQL 函数的方式，同样在这里有效；

  ```php
  $user->price = Db::raw('price+1');
  ```

6. 如果只是单纯的增减数据修改，可以使用 inc/dec；

  ```php
  $user->price = ['inc', 1];
  ```

7. 直接通过 save([],[])两个数组参数的方式更新数据；

  ```php
  $user->save([
  'username' => '李黑',
  'email' => 'lihei@163.com'
  ],['id'=>118]);
  ```

8. 通过 saveAll()方法，可以批量修改数据，返回被修改的数据集合；

  ```php
  $list = [
  ['id'=>118, 'username'=>'李白', 'email'=>'libai@163.com'],
  ['id'=>128, 'username'=>'李白', 'email'=>'libai@163.com'],
  ['id'=>129, 'username'=>'李白', 'email'=>'libai@163.com']
  ];
  $user->saveAll($list);
  ```

9. 批量更新 saveAll()只能通过主键 id 进行更新；

10. 使用静态方法结合 update()方法来更新数据，这里返回的是影响行数；

    ```php
    UserModel::where('id', 118)->update([
    'username' => '李黑',
    'email' => 'lihei@163.com'
    ]);
    ```

11. 另外一种静态方法 update()，返回的是对象实例；

    ```php
    UserModel::update([
    'id' => 118,
    'username' => '李黑',
    'email' => 'lihei@163.com'
    ]);
    ```

12. 模型的新增和修改都是 save()进行执行的，它采用了自动识别体系来完成；

13. 实例化模型后调用 save()方法表示新增，查询数据后调用 save()表示修改；

14. 当然，如果在 save()传入更新修改条件后也表示修改；

15. 再当然，如果编写的代码比较复杂的话，可以用 isUpdate()方法显示操作；

    ```php
    //显示更新
    $user->isUpdate(true)->save();
    //显示新增
    $user->isUpdate(false)->save();
    ```

### 二．数据查询

1. 使用 get()方法，通过主键(id)查询到想要的数据；

  ```php
  $user = UserModel::get(129);
  return json($user);
  ```

2. 也可以使用 where()方法进行条件筛选查询数据；

  ```php
  $user = UserModel::where('username', '辉夜')->find();
  return json($user);
  ```

3. 不管是 get()方法还是 find()方法，如果数据不存在则返回 Null；

4. 和数据库查询一样，模型也有 getOrFail()方法，数据不存在抛出异常；

5. 同上，还有 findOrEmpty()方法，数据不存在返回空模型；

6. 通过模型->符号，可以得到单独的字段数据；

  ```php
  return $user->username;
  ```

7. 如果在模型内部获取数据，请不要用$this->username，而用如下方法；

  ```php
  public function getUserName()
  {
  	return self::where('username', '辉夜')->find()->getAttr('username');
  }
  ```

8. 通过 all()方法，实现 IN 模式的多数据获取；

  ```php
  $user = UserModel::all('79, 118, 128');
  $user = UserModel::all([79, 118, 128]);
  ```

9. 使用链式查询得到想要的数据；

  ```php
  UserModel::where('gender', '男')->order('id', 'asc')
  ->limit(2)->select();
  ```

10. 获取某个字段或者某个列的值；

    ```php
    UserModel::where('id', 79)->value('username');
    UserModel::whereIn('id',[79,118,128])->column('username','id');
    ```

11. 模型支持动态查询：getBy*，*表示字段名；

    ```php
    UserModel::getByUsername('辉夜');
    UserModel::getByEmail('huiye@163.com');
    ```

12. 模型支持聚合查询；

    ```php
    UserModel::max('price');
    ```
    
    
## 模型获取器和修改器

### 一．模型获取器

1. 获取器的作用是对模型实例的数据做出自动处理；

2. 一个获取器对应模型的一个特殊方法，该方法为 public；

3. 方法名的命名规范为：`getFieldAttr()`；

4. 举个例子，数据库表示状态 status 字段采用的是数值；

5. 而页面上，我们需要输出 status 字段希望是中文，就可以使用获取器；

6. 在 User 模型端，我创建一个对外的方法，如下：

  ```php
  public function getStatusAttr($value)
  {
      $status = [-1=>'删除', 0=>'禁用', 1=>'正常', 2=>'待审核'];
      return $status[$value];
  }
  ```

7. 然后，在控制器端，直接输出数据库字段的值即可得到获取器转换的对应值；

  ```php
  $user = UserModel::get(21);
  return $user->status;
  ```

8. 除了 getFieldAttr 中 Field 可以是字段值，也可以是自定义的虚拟字段；

  ```php
  public function getNothingAttr($value, $data)
  {
  $myGet = [-1=>'删除', 0=>'禁用', 1=>'正常', 2=>'待审核'];
  return $myGet[$data['status']];
  }
  return $user->nothing;
  ```

9. Nothing 这个字段不存在，而此时参数$value 只是为了占位，并未使用；

10. 第二个参数$data 得到的是筛选到的数据，然后得到最终值；

11. 如果你定义了获取器，并且想获取原始值，可以使用 getData()方法；

    ```php
    return $user->getData('status');
    ```

12. 直接输出无参数的 getData()，可以得到原始值，而$user 输出是改变后的；

    ```php
    dump($user->getData());
    dump($user);
    ```

13. 使用 WithAttr 在控制器端实现动态获取器，比如设置所有 email 为大写；

    ```php
    $result = UserModel::WithAttr('email', function ($value) {
    return strtoupper($value);
    })->select();
    return json($result);
    ```

14. 使用 WithAttr 在控制器端实现动态获取器，比如设置 status 翻译为中文；

    ```php
    $result = UserModel::WithAttr('status', function ($value) {
    $status = [-1=>'删除', 0=>'禁用', 1=>'正常', 2=>'待审核'];
    return $status[$value];
    })->select();
    return json($result);
    ```

15. 同时定义了模型获取器和动态获取器，那么模型修改器优先级更高；

### 二．模型修改器

1. 模型修改器的作用，就是对模型设置对象的值进行处理；

2. 比如，我们要新增数据的时候，对数据就行格式化、过滤、转换等处理；

3. 模型修改器的命名规则为：`setFieldAttr`；

4. 我们要设置一个新增，规定邮箱的英文都必须大写，修改器如下：

  ```php
  public function setEmailAttr($value)
  {
  	return strtoupper($value);
  }
  ```

5. 除了新增，会调用修改器，修改更新也会触发修改器；

6. 模型修改器只对模型方法有效，调用数据库的方法是无效的，比如->insert()


## 模型搜索器和数据集

### 一．模型搜索器

1. 搜索器是用于封装字段（或搜索标识）的查询表达式；

2. 一个搜索器对应模型的一个特殊方法，该方法为 public；

3. 方法名的命名规范为：`searchFieldNameAttr()`；

4. 举个例子，我们要封装一个邮箱字符模糊查询，然后封装一个时间限定查询；

5. 在 User 模型端，我创建两个对外的方法，如下：

  ```php
  public function searchEmailAttr($query, $value)
  {
  	$query->where('email', 'like', $value.'%');
  }
  public function searchCreateTimeAttr($query, $value)
  {
  	$query->whereBetweenTime('create_time', $value[0], $value[1]);
  }
  ```

6. 然后，在控制器端，通过 withSearch()静态方法实现模型搜索器的调用；

  ```php
  $result = UserModel::withSearch(['email', 'create_time'],[
  'email' => 'xiao',
  'create_time' => ['2014-1-1', '2017-1-1']
  ])->select();
  ```

7. `withSearch()`中第一个数组参数，限定搜索器的字段，第二个则是表达式值；

8. 如果想在搜索器查询的基础上再增加查询条件，直接使用链式查询即可；
    `UserModel::withSearch(...)->where('gender', '女')->select()`

9. 如果你想在搜索器添加一个可以排序的功能，具体如下：

  ```php
  public function searchEmailAttr($query, $value, $data)
  {
      $query->where('email', 'like', $value.'%');
      if (isset($data['sort'])) {
      	$query->order($data['sort']);
      }
  }
  $result = UserModel::withSearch(['email', 'create_time'],[
      'email' => 'xiao',
      'create_time' => ['2014-1-1', '2017-1-1'],
      'sort' => ['price'=>'desc']
  ])->select();
  ```

10. 搜索器的第三个参数$data，可以得到 withSearch()方法第二参数的值；

11. 字段也可以设置别名：`'create_time'=>'ctime' `

### 二．模型数据集

1. 数据集由 all()和 select()方法返回数据集对象；

2. 数据集对象和数组操作方法一样，循环遍历、删除元素等；

3. 判断数据集是否为空，我们需要采用 isEmpty()方法；

  ```php
  $result = UserModel::where('id', 111)->select();
  if ($result->isEmpty()) {
  	return '没有数据！';
  }
  ```

4. 使用模型方法 hidden()可以隐藏某个字段，使用 visible()显示只某个字段；

5. 使用 append()可以添加某个获取器字段，使用 withAttr()对字段进行函数处理；

  ```php
  $result = UserModel::select();
  $result->hidden(['password'])->append(['nothing'])->withAttr('email', function ($value) {
  	return strtoupper($value);
  });
  return json($result);
  ```

6. 使用模型方法 filter()对筛选的数据进行过滤；

  ```php
  $result = UserModel::select()->filter(function ($data) {
  	return $data['price'] > 100;
  });
  return json($result);
  ```

7. 也可以使用数据集之后链接 where()方法来代替 filter()方法；

  ```php
  $result = UserModel::select()->where('price', '>', '100');
  ```

8. 数据集甚至还可以使用 order()方法进行排序；

  ```php
  $result = UserModel::select()->order('price', 'desc');
  ```

9. 使用 diff()和 intersect()方法可以计算两个数据集的差集和交集；

  ```php
  $result1 = UserModel::where('price', '>', '80')->select();
  $result2 = UserModel::where('price', '<', '100')->select();
  return json($result1->diff($result2));
  return json($result2->intersect($result1));
  ```


## 模型自动时间戳和只读字段

### 一．模型自动时间戳

1. 系统自动创建和更新时间戳功能默认是关闭状态；

2. 如果你想全局开启，在 `database.php` 中，设置为 true；

  ```php
  // 自动写入时间戳字段
  'auto_timestamp' => true,
  ```

3. 如果你只想设置某一个模型开启，需要设置特有字段；

  ```php
  //开启自动时间戳
  protected $autoWriteTimestamp = true;
  ```

4. 当然，还有一种方法，就是全局开启，单独关闭某个或某几个模型为 false；

5. 自动时间戳开启后，会自动写入 create_time 和 update_time 两个字段；

6. 此时，它们的默认的类型是 int，如果是时间类型，可以更改如下：

  ```php
  'auto_timestamp' => 'datetime', //或
  protected $autoWriteTimestamp = 'datetime';
  ```

7. 都配置完毕后，当我们新增一条数据时，无须新增 create_time 会自动写入时间；

8. 同理，当我们修改一条数据时，无须修改 update_time 会自动更新时间；

9. 自动时间戳只能在模型下有效，数据库方法不可以使用；

10. 如果创建和修改时间戳不是默认定义的，也可以自定义；

    ```php
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';
    ```

11. 如果业务中只需要 create_time 而不需要 update_time，可以关闭它；

    ```php
    protected $updateTime = false;
    ```

12. 也可以动态实现不修改 update_time，具体如下：

    ```php
    $user->isAutoWriteTimestamp(false)->save();
    ```

### 二．模型只读字段

1. 模型中可以设置只读字段，就是无法被修改的字段设置；

2. 我们要设置 username 和 email 不允许被修改，如下：

  ```php
  protected $readonly = ['username', 'email'];
  ```

3. 除了在模型端设置，也可以动态设置只读字段；

  ```php
  $user->readonly(['username', 'email'])->save();
  ```

4. 同样，只读字段只支持模型方式不支持数据库方式；


## 模型类型转换和数据完成

### 一．模型类型转换

1. 系统可以通过模型端设置写入或读取时对字段类型进行转换；

2. 我们这里，通过读取的方式来演示部分效果；

3. 在模型端设置你想要类型转换的字段属性，属性值为数组；

  ```php
  protected $type = [
      'price' => 'integer',
      'status' => 'boolean',
      'create_time' => 'datetime:Y-m-d'
  ];
  ```

4. 数据库查询读取的字段很多都是字符串类型，我们可以转换成如下类型：
    integer(整型)、float(浮点型)、boolean(布尔型)、array(数组)
    object(对象)、serialize(序列化)、json(json)、timestamp(时间戳)
    datetime(日期)

5. 由于数据库没有那么多类型演示，常用度不显著，我们提供几个方便演示的；

  ```php
  public function typeConversion()
  {
      $user = UserModel::get(21);
      var_dump($user->price);
      var_dump($user->status);
      var_dump($user->create_time);
  }
  ```

6. 类型转换还是会调用属性里的获取器等操作，编码时要注意这方面的问题；

### 二．模型数据完成

1. 模型中数据完成通过 auto、insert 和 update 三种形式完成；

2. auto 表示新增和修改操作，insert 只表示新增，update 只表示修改；

  ```php
  protected $auto = ['email'];
  protected $insert = ['uid'=>1];
  protected $update = [];
  ```

3. 先理解 insert，当我们新增一条数据时会触发新增数据完成；

4. 此时，并不需要自己去新增 uid，它会自动给 uid 赋值为 1；

  ```php
  $user = new UserModel();
  $user->username = '李白';
  $user->password = '123';
  $user->gender = '男';
  $user->email = 'libai@163.com';
  $user->price = 100;
  $user->details = '123';
  $user->save();
  ```

5. auto 表示新增和修改均要自动完成，而不给默认值的字段需要修改器提供；

  ```php
  public function setEmailAttr($value)
  {
  	return strtoupper($value);
  }
  ```

6. 新增时，邮箱字符串会被修改器自动完成大写，那数据完成的意义何在？

7. 修改时，如果你不去修改邮箱，在数据自动完成强制完成，会自动完成大写；

8. 也就是说，邮箱的大写，设置 update 更加合适，因为新增必填必然触发修改器；

9. 对于 update 自动完成，和 auto、insert 雷同，自行演示；



## 模型查询范围和输出

### 一．模型查询范围

1. 在模型端创建一个封装的查询或写入方法，方便控制器端等调用；

2. 比如，封装一个筛选所有性别为男的查询，并且只显示部分字段 5 条；

3. 方法名规范：前缀 scope，后缀随意，调用时直接把后缀作为参数使用；

  ```php
  public function scopeGenderMale($query)
  {
  	$query->where('gender', '男')->field('id,username,gender,email')->limit(5);
  }
  ```

4. 在控制器端，我们我们直接调用并输出结果即可；

  ```php
  public function queryScope()
  {
      $result = UserModel::scope('gendermale')->select();
      //$result = UserModel::gendermale()->select();
      return json($result);
  }
  ```

5. 也可以实现多个查询封装方法连缀调用，比如找出邮箱 xiao 并大于 80 分的；

  ```php
  public function scopeEmailLike($query, $value)
  {
  	$query->where('email', 'like', '%'.$value.'%');
  }
  public function scopePriceGreater($query, $value)
  {
  	$query->where('price', '>', 80);
  }
  $result = UserModel::emailLike('xiao')->priceGreater(80)->select();
  ```

6. 查询范围只能使用 find()和 select()两种方法；

7. 全局范围查询，就是在此模型下不管怎么查询都会加上全局条件；

  ```php
  //全局范围查询
  protected function base($query)
  {
  	$query->where('status', 1);
  }
  ```

8. 在定义了全局查询后，如果某些不需要全局查询可以使用 useGlobalScope 取消；

  ```php
  UserModel::useGlobalScope(false)
  ```

9. 当然，设置为 true，则开启全局范围查询，注意：这个方法需要跟在::后面；

  ```php
  UserModel::useGlobalScope(true)
  ```

### 二．模型输出方式

1. 通过模版进行数据输出；

  ```php
  public function view()
  {
      $user = UserModel::get(21);
      $this->assign('user', $user);
      return $this->fetch();
  }
  ```

2. 根据错误提示，可以创建相对应的模版，然后进行数据显示；

  ```php
  {$user.username}.
  {$user.gender}.
  {$user.email}
  ```

3. 使用 toArray()方法，将对象按照数组的方式输出；

  ```php
  $user = UserModel::get(21);
  print_r($user->toArray());
  ```

4. 和之前的数据集一样，它也支持 hidden、append、visible 等方法；

  ```php
  print_r($user->hidden(['password,update_time'])->toArray());
  ```

5. toArray()方法也支持 all()和 select()等列表数据；

  ```php
  print_r(UserModel::select()->toArray());
  ```

6. 使用 toJson()方法将数据对象进行序列化操作，也支持 hidden 等方法；

  ```php
  print_r($user->toJson());
  ```


## JSON 字段

### 一．数据库 JSON

1. 数据库写入 JSON 字段，直接通过数组的方式即可完成；

  ```php
  $data = [
      'username' => '辉夜',
      'password' => '123',
      'gender' => '女',
      'email' => 'huiye@163.com',
      'price' => 90,
      'details' => '123',
      'uid' => 1011,
      'status' => 1,
      'list' => ['username'=>'辉夜', 'gender'=>'女',
      'email'=>'huiye@163.com'],
  ];
  Db::name('user')->insert($data);
  ```

2. 从上面写入可以看出，list 字段设置的就是 json，通过数组写入的就是 json；

3. 但是，如果我要写入 details 这个 text 文本格式的字段，通过数组会报错；

4. 这个时候，采用->json(['details'])方法来进行转换，也可以写入 json 数据；

  ```php
  'details' => ['content'=>123],
  Db::name('user')->json(['details'])->insert($data);
  ```

5. 在查询上，也可以使用->json(['list,details'])方法来获取数据；

  ```php
  $user = Db::name('user')->json(['list','details'])->where('id', 173)->find();
  return json($user);
  ```

6. 如果要将 json 字段里的数据作为查询条件，可以通过如下方式实现：

  ```php
  $user = Db::name('user')->json(['list','details'])->where('list->username', '辉夜')->find();
  ```

7. 如果想完全修改 json 数据，可以使用如下的方式实现：

  ```php
  $data['list'] = ['username'=>'李白', 'gender'=>'男'];
  Db::name('user')->json(['list'])->where('id', 174)->update($data);
  ```

8. 如果只想修改 json 数据里的某一个项目，可以使用如下的方式实现：

  ```php
  $data['list->username'] = '李黑';
  Db::name('user')->json(['list'])->where('id', 174)->update($data);
  ```

### 二．模型 JSON

1. 使用模型方式去新增包含 json 数据的字段；

  ```php
  $user = new UserModel();
  $user->username = '李白';
  $user->password = '123';
  $user->gender = '男';
  $user->email = 'libai@163.com';
  $user->price = 100;
  $user->uid = 1011;
  $user->status = 1;
  $user->details = ['content'=>123];
  $user->list = ['username'=>'辉夜', 'gender'=>'女','email'=>'huiye@163.com','uid'=>1011];
  $user->save();
  ```

2. 对于本身不是 json 字段，想要写入 json 字段的字符字段，需要设置；

  ```php
  protected $json = ['details', 'list'];
  ```

3. 也可以通过对象的方式，进行对 json 字段的写入操作；

  ```php
  $list = new \StdClass();
  $list->username = '辉夜';
  $list->gender = '女';
  $list->email = 'huiye@163.com';
  $list->uid = 1011;
  $user->list = $list;
  ```

4. 通过对象调用方式，直接获取 json 里面的数据；

  ```php
  $user = UserModel::get(179);
  return $user->list->username;
  ```

5. 通过 json 的数据查询，获取一条数据；

  ```php
  $user = UserModel::where('list->username', '辉夜')->find();
  return $user->list->email;
  ```

6. 更新修改 json 数据，直接通过对象方式即可；

  ```php
  $user = UserModel::get(179);
  $user->list->username = '李白';
  $user->save();
  ```


## 软删除

### 一．数据库软删除

1. 所谓软删除，并不是真的删除数据，而是给数据设置一个标记；

2. 首先，我们需要在数据表创建一个 delete_time，默认为 NULL；

3. 其次，使用软删除功能，软删除其实就是 update 操作，创建一个时间标记；

  ```php
  Db::name('user')->where('id', 192)
  ->useSoftDelete('delete_time', date('Y-m-d H:i:s'))
  ->delete();
  return Db::getLastSql();
  ```

4. 此时，这条数据就被软删除了。只不过，手册并没有给出更多的操作；

### 二．模型软删除

1. 介于数据库软删除没有太多的可操作的方法，官方手册推荐使用模型软操作；

2. 首先，需要在模型端设置软删除的功能，引入 SoftDelete，它是 trait；

  ```php
  use SoftDelete;
  protected $deleteTime = 'delete_time';
  ```

3. delete_time 默认我们设置的是 null，如果你想更改这个默认值，可以设置：

  ```php
  protected $defaultSoftDelete = 0;
  ```

4. 默认情况下，开启了软删除功能的查询，模型会自动屏蔽被软删除的数据；

  ```php
  $user = UserModel::select();
  return json($user);
  ```

5. 在开启软删除功能的前提下，使用 withTrashed()方法取消屏蔽软删除的数据；

  ```php
  $user = UserModel::withTrashed()->select();
  return json($user);
  ```

6. 如果只想查询被软删除的数据，使用 onlyTrashed()方法即可；

  ```php
  $user = UserModel::onlyTrashed()->select();
  return json($user);
  ```

7. 如果想让某一条被软删除的数据恢复到正常数据，可以使用 restore()方法；

  ```php
  $user = UserModel::onlyTrashed()->find();
  $user->restore();
  ```

8. 如果想让一条软删除的数据真正删除，在恢复正常后，使用 delete(true)；

  ```php
  $user = UserModel::onlyTrashed()->get(193);
  $user->restore();
  $user->delete(true);
  ```


## 模版引擎和视图渲染

### 一．模版引擎

1. MVC 中，M(模型)和 C(控制器)是前面我们所了解的内容；
2. 而 V(视图)，也就是模版页面，是 MVC 中第三个核心内容；
3. 模版引擎分为两种，一种内置的，一种外置作为插件引入的，我们用内置的即可；
4. 内置的模版引擎的配置文件是 config/template.php；
5. 默认情况下已经很好了，不需要修改任何参数，view_path 默认是 view 目录；

### 二．视图渲染

1. 在控制器端，我们首先继承一下控制器基类(不是必须的，助手函数也行)；

2. 先采用第一种不带任何参数的最典型的做法(自动定位)，看它报错信息；

  ```php
  class See extends Controller
  {
      public function index()
      {
          //自动定位
          return $this->fetch();
      }
  }
  ```

3. 模版路径为：当前模块/view/当前控制器名(小写)/当前操作(小写).html

4. 如果你想制定一个输出的模版，可以在 fetch()方法传递相应的参数；

  ```php
  return $this->fetch('edit'); //指定模版
  return $this->fetch('public/edit'); //指定目录下的模版
  return $this->fetch('admin@public/edit'); //指定模块下的模版
  return $this->fetch('/edit'); //view_path 下的模版
  ```

5. 如果没有继承 Controller 控制器的话，可以使用助手函数 view()方法；

  ```php
  return view('edit');
  ```


## 视图赋值和过滤

### 一．视图赋值

1. 在继承控制器基类的情况下，我们可以使用 assign()方法进行赋值；

  ```php
  $this->assign('name', 'ThinkPHP'); //{$name}
  ```

2. 也可以通过数组的方式，进行多个变量的赋值；

  ```php
  $this->assign([
      'username' => '辉夜', //{$username}
      'email' => 'huiye@163.com' //{$email}
  ]);
  ```

3. assign()方法和 fetch()方法也可以合二为一进行操作；

  ```php
  return $this->fetch('index', [
      'username' => '辉夜',
      'email' => 'huiye@163.com'
  ]);
  ```

4. 使用 display()方法，可以不通过模版直接解析变量；

  ```php
  $content = '{$username}.{$email}';
  return $this->display($content, [
      'username' => '辉夜',
      'email' => 'huiye@163.com'
  ]);
  ```

5. 使用 view()助手函数实现渲染并赋值操作；

  ```php
  return view('index', [
      'username' => '辉夜',
      'email' => 'huiye@163.com'
  ]);
  return view('index')->assign([
      'username' => '辉夜',
      'email' => 'huiye@163.com'
  ]);
  ```

6. 使用 View::share()静态方法，可以在系统任意位置做全局变量赋值；

  ```php
  \think\facade\View::share('key', 'value'); //也支持数组
  ```

### 二．视图过滤

1. 如果需要对模版页面输出的变量进行过滤，可以使用 filter()方法；

  ```php
  $this->assign([
      'username' => '辉 1 夜',
      'email' => 'huiye@163.com'
  ]);
  return $this->filter(function($content){
  	return str_replace("1",'<br/>',$content);
  })->fetch();
  ```

2. 这里的$content 表示所有的模版变量，找到 1 之后，实现换行操作；

3. 如果控制器有 N 个方法，都需要过滤，可以直接在初始化中全局过滤；

  ```php
  public function initialize()
  {
      $this->filter(function($content){
      	return str_replace("1",'<br/>',$content);
      });
  }
  ```

4. 也可以使用助手函数实现模版变量的过滤功能；

  ```php
  return view()->filter(function($content){
  	return str_replace("1",'<br/>',$content);
  });
  ```


## 模版变量输出

### 一．变量输出

1. 上一节课视图赋值讲到过，模版的变量的输出方式，控制器实现赋值；

  ```php
  $this->assign('name', 'ThinkPHP');
  ```

2. 当模版位置创建好后，输出控制器的赋值变量时，说你用花括号和$符号；

  ```php
  {$name}
  ```

3. 当程序运行的时候，会在 runtime/temp 目录下生成一个编译文件；

  ```php
  <?php echo htmlentities($name); ?>
  ```

4. 如果传递的值是数组，那么编译文件也会自动相应的对应输出方式；

  ```php
  $data['username'] = '辉夜';
  $data['email'] = 'huiye@163.com';
  $this->assign('user', $data);
  ```

  ```php
  模版调用：{$user.username}.{$user.email} //或{$user['email']}
  编译文件：<?php echo htmlentities($user['username']); ?>
  ```

5. 如果传递的值是对象，那么编译文件也会自动相应的对应输出方式；

  ```php
  $obj = new \stdClass();
  $obj->username = '辉夜';
  $obj->email = 'huiye@163.com';
  $this->assign('obj', $obj);
  ```

  ```php
  模版调用：{$obj->username}.{$obj->email}
  编译文件：<?php echo htmlentities($obj->username); ?>
  ```

6. 如果是模型对象的数据列表，数组和对象方式均可；

### 二．其它输出

1. 如果输出的变量没有值，可以直接设置默认值代替；

  ```php
  {$user.username|default='没有用户名'}
  ```

2. 使用$Think.xxx.yyy 方式，可以输出系统的变量；

3. 系统变量有：$_SERVER、$_ENV、$_GET、$_POST、$_REQUEST、$_SESSION 和$_COOKIE；

  ```php
  {$Think.get.name} //其它雷同
  ```

4. 除了变量，常量也可以在模版直接输出；

  ```php
  {$Think.const.PHP_VERSION}
  {$Think.PHP_VERSION}
  ```

5. 系统配置也可以直接在模版输出，配置参数可以在 config 文件下；

  ```php
  {$Think.config.default_return_type}
  ```


## 模版中函数和运算符

### 一．使用函数

1. 控制器端先赋值一个密码的变量，模版区设置 md5 加密操作；

  ```php
  $this->assign('password', '123456');
  ```

  ```php
  {$password|md5}
  ```

2. 系统默认在编译的会采用 htmlentities 过滤函数防止 XSS 跨站脚本攻击；

3. 如果你想更换一个过滤函数，比如 htmlspecialchars，可以在配置文件设置；

4. 具体在 config 下的 template.php 中，增加一条如下配置即可；

  ```php
  'default_filter' => 'htmlspecialchars'
  ```

5. 如果在某个字符，你不需要进行 HTML 实体转义的话，可以单独使用 raw 处理；

  ```php
  {$user['email']|raw}
  ```

6. 系统还提供了一些固定的过滤方法，如下：

| 函数    | 说明                   |
| ------- | ---------------------- |
| date    | 格式化时间`{$time|date='Y-m-d'}` |
| format  | 格式化字符串`{$number|format='%x'}` |
| upper   | 转换为大写             |
| lower   | 转换为小写             |
| first   | 输出数组的第一个元素   |
| last    | 输出数组的最后一个元素 |
| default | 默认值                 |
| raw     | 不使用转义             |

```php
  $this->assign('time', time());
```

```php
 {$time|date='Y-m-d'}
```

```php
  $this->assign('number', '14');
```

```php
  {$number|format='%x'}
```

7. 如果函数中，需要多个参数调用，直接用逗号隔开即可；

  ```php
  {$name|substr=0,3}
  ```

8. 在模版中也支持多个函数进行操作，用|号隔开即可，函数从左到右依次执行；

  ```php
  {$password|md5|upper|substr=0,3}
  ```

9. 你也可以在模版中直接使用 PHP 的语法模式，该方法不会使用过滤转义：

  ```php
  {:substr(strtoupper(md5($password)), 0, 3)}
  ```

### 二．运算符

1. 在模版中的运算符有+、-、*、/、%、++、--等；

  ```php
  {$number + $number}
  ```

2. 如果模版中有运算符，则函数方法则不再支持；

  ```php
  {$number + $number|default='没有值'}
  ```

3. 模版也可以实现三元运算，包括其它写法；

  ```php
  {$name ? '正确' : '错误'} //$name 为 true 返回正确，否则返回错误
  {$name ?= '真'} //$name 为 true 返回真
  {$Think.get.name ?? '不存在'} //??用于系统变量，没有值时输出
  {$name ?: '不存在'} //?:用于普通变量，没有值时输出
  ```

4. 三元运算符也支持运算后返回布尔值判断；

  ```php
  {$a == $b ? '真' : '假'}
  ```



## 模版的循环标签

### 一．foreach 循环

1. 控制前端先通过模型把相应的数据列表给筛选出来；

  ```php
  $list = UserModel::all();
  $this->assign('list', $list);
  return $this->fetch('user');
  ```

2. 在模版端使用对称的标签{foreach}...{/foreach}实现循环；

  ```php
  {foreach $list as $key=>$obj}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/foreach}
  ```

3. 其中$list 是控制前端传递的数据集，$key 是 index 索引，$obj 是数据对象；

4. 也可以在模版中直接执行模型数据调用，而不需要在控制器设置；

  ```php
  {foreach :model('user')->all() as $key=>$obj}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/foreach}
  ```

### 二．volist 循环

1. volist 也是将查询得到的数据集通过循环的方式进行输出；

  ```php
  {volist name='list' id='obj'}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/volist}
  ```

2. volist 中的 name 属性表示数据总集，id 属性表示当前循环的数据单条集；

3. volist 也可以直接使用模型对象获取数据集的方式进行循环输出；

  ```php
  {volist name=':model("user")->all()' id='obj'}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/volist}
  ```

4. 使用 offset 属性和 length 属性从第 4 条开始显示 5 条，这里下标从 0 开始；

  ```php
  {volist name='list' id='obj' offset='3' length='5'}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/volist}
  ```

5. 可以使用 eq 标签(下节课比较标签的知识点)，来实现奇数或偶数的筛选数据；

  ```php
  {volist name='list' id='obj' mod='2'}
      {eq name='mod' value='0'}
          {$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
      {/eq}
  {/volist}
  ```

6. 通过编译文件可以理解，mod=2 表示索引除以 2 得到的余数是否等于 0 或 1；

7. 如果余数设置为 0，那么输出的即偶数，如果设置为 1，则输出的是奇数；

8. 当然，切换到其它数字，也会有更多的排列效果；

9. 使用 empty 属性，可以当没有任何数据的时候，实现输出指定的提示；

  ```php
  {volist name=':model("user")->where("id", 1000)->all()' id='obj' empty='没有任何数据'}
  	{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
  {/volist}
  ```

10. empty 属性，可以是控制器端传递过来的变量，比如：empty='$empty'；

11. 使用 key='k'，让索引从 1 开始计算，不指定就用{$i}，指定后失效；

    ```php
    {volist name='list' id='obj' key='k'}
    	{$k}.{$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
    {/volist}
    ```

### 三．for 循环

1. for 循环，顾名思义，通过起始和终止值，结合步长实现的循环；

  ```php
  {for start='1' end='100' comparison='<' step='2' name='i'}
  	{$i}
  {/for}
  ```


## 模版的比较和定义标签

### 一．比较标签

1. {eq}..{/eq}标签，比较两个值是否相同，相同即输出包含内容；

  ```php
  $this->assign('username', 'Mr.Lee');
  ```

  ```php
  {eq name='username' value='Mr.Lee'}
  李先生
  {/eq}
  ```

2. 属性 name 里是一个变量，$符号可加可不加；而 value 里是一个字符串；

3. 如果 value 也需要是一个变量的话，那么 value 需要加上$后的变量；

  ```php
  {eq name='username' value='$username'}
  李先生
  {/eq}
  ```

4. {eq}标签有一个别名标签：{equal}，效果是一样的；

5. 相对应的{neq}或{notequal}，实现相反的效果；

  ```php
  {neq name='username' value='Mr.Wang'}
  	两个值不相等
  {/neq}
  ```

6. 这一组标签也支持 else 操作，标签为：{else/}；

  ```php
  {eq name='username' value='Mr.Lee'}
  	两个值相等
  {else/}
  	两个值不等
  {/eq}
  ```

7. {gt}(>)、{egt}(>=)、{lt}(<)、{elt}(<=)、{heq}(===)和{nheq}(!==)；

8. 除了相等和不等，还有上面六种比较形式；

  ```php
  {egt name='number' value='10'}
  	大于等于 10
  {else/}
  	小于 10
  {/egt}
  ```

9. 所有的标签都可以统一为{compare}标签使用，增加一个 type 方法指定即可；

  ```php
  {compare name='username' value='Mr.Lee' type='eq'}
  两个值相等
  {/compare}
  ```

### 二．定义标签

1. 如果你想在模版文件中去定义一个变量，可以使用{assgin}标签；

  ```php
  {assign name='var' value='123'} //也支持变量 value='$name'
  {$var}
  ```

2. 有变量的定义就会有常量的定义，可以使用{define}标签；

  ```php
  {define name='PI' value='3.1415926'}
  {$Think.const.PI}
  ```

3. 有时，实在不知道在模版中怎么进行编码时，可以采用{php}标签进行原生编码；

  ```php
  {php}
  echo '原生编码防止脱发';
  {/php}
  ```

4. 要注意的是：原生编码就是 PHP 编码，不能再使用模版引擎的特殊编码方式；

5. 比如{eq}，{$user.name}这些标签语法均不支持；

6. 标签之间，是支持嵌套功能的，比如从列表中找到“樱桃小丸子”；

  ```php
  {foreach :model('user')->all() as $key=>$obj}
      {eq name='obj.username' value='樱桃小丸子'}
          {$key}.{$obj.id}.{$obj.username}({$obj.gender}).{$obj.email}<br>
      {/eq}
  {/foreach}
  ```


## 模版的条件判断标签

### 一．switch 标签

1. 使用{switch}...{/switch}可以实现多个条件判断；

  ```php
  {switch number}
  {case 1}1{/case}
  {case 5}5{/case}
  {case 10}10{/case}
  {default/}不存在
  {/switch}
  ```

2. {case}也支持多个条件判断，使用|线隔开即可；

  ```php
  {case 10|20|30}10,20,30 均可{/case}
  ```

3. {case}后面也可以是变量，设置变量后不可以使用|线；

  ```php
  {case $id}
  ```

### 二．IF 标签

1. 使用简单条件判断的{if}标签；

  ```php
  {if $number > 10}大于 10{/if}
  ```

2. {if}标签的条件判断可以使用 AND、OR 等语法；

  ```php
  {if ($number > 10) OR ($number > 5)}大于 10{/if}
  ```

3. {if}标签支持{else/}语法；

  ```php
  {if $number > 10}
  	大于 10
  {else/}
  	小于 10
  {/if}
  ```

4. {if}标签也支持{elseif}多重条件判断；

  ```php
  {if $number > 100}
  	大于 100
  {elseif $number > 50}
  	大于 50
  {else}
  	小于 50
  {/if}
  ```

5. {if}标签中的条件判断支持 PHP 写法，比如函数和对象调用；

  ```php
  {if strtoupper($user->name) == 'MR.LEE'}
  确认李先生
  {/if}
  ```

### 三．范围标签

1. 范围标签：{in}和{notin}，判断值是否存在或不存在指定的数据列表中；

  ```php
  {in name='number' value='10,20,30,40,50'}存在{/in}
  {in name='number' value='10,20,30,40,50'}
  	在数据列表中
  {else/}
  	不在数据列表中
  {/in}
  ```

2. name 值可以是是系统变量，比如$Think.xxx.yyy，value 可以是变量；

3. 范围标签：{between}和{notbetween}，判断值是否存在或不存在数据区间中；

  ```php
  {between name='number' value='10,50'}存在{/between}
  {between name='number' value='10,50'}
  	在数据区间中
  {else/}
  	不在数据区间中
  {/between}
  ```

4. between 中的 value 只能是两个值，表示一个区间，第三个值会无效；

5. 区间不但可以表达数字，也可以是字母，比如 a-z，A-Z；

### 四．是否存在标签

1. 是否存在：{present}和{notpresent}判断变量是否已经定义赋值(是否存在)；

  ```php
  {present name='user'}存在{/present}
  {present name='user'}
  	user 已声明
  {else/}
  	user 为声明
  {/present}
  ```

2. 是否为空：{empty}和{notempty}判断变量是否为空值；

  ```php
  {empty name='username'}有值{/empty}
  {empty name='username'}
  	username 有值
  {else/}
  	username 没值
  {/empty}
  ```

3. 常量是否定义：{defined}判断常量是否定义(是否存在)；

  ```php
  {defined name='PI'}
  	PI 存在
  {else/}
  	PI 不存在
  {/defined}
  ```


## 模版的加载包含输出等

### 一．包含文件

1. 使用{include}标签来加载公用重复的文件，比如头部、尾部和导航部分；

2. 在模版 view 目录创建一个 public 公共目录，分别创建 header、footer 和 nav；

3. 然后创建 Block 控制器，引入控制器模版 index，这个模版包含三个公用文件；

  ```php
  {include file='public/header,public/nav'/}
  index
  {include file='public/footer'/}
  ```

4. 也可以包含一个文件的完整路径，包括后缀，如下：

  ```php
  {include file="../application/view/public/nav.html"/}
  ```

5. 模版的标题和关键字，可以通过固定的语法进行传递；

6. 对于标题，在控制器先设置一下标题变量，然后设置{include}设置属性；

  ```php
  $this->assign('title', '模版');
  ```

  ```php
  {include file='public/header' title='$title' keywords='这是一个模版！'/}
  ```

7. 切换到 public/header.html 模版页面，使用[xxx]的方式调用数据；
  ```html
  <title>[title]</title>
  <meta name="keywords" content="[keywords]" />
  ```

### 二．输出替换

1. 有时，我们需要调用一些静态文件，比如 css/js 等；

2. 一般来说，我们将这些静态文件存放在根目录 public/static/css(或 js)；

3. 那么，直接写完整路径，比较繁长，可以把这些路径整理打包；

4. 在目前二级目录下，template.php 中，配置新增一个参数；

  ```php
  'tpl_replace_string' => [
  '__JS__' => 'static/js',
  '__CSS__' => 'static/css',
  ]
  ```

5. 如果是在顶级域名下，直接在改成/static/css 即可，加一个反斜杠；

6. html 文件调用端，直接通过__CSS__(__JS__)配置的魔术方法调用即可；
  ```php+HTML
  <link rel="stylesheet" type="text/css" href="__CSS__/basic.css">
  <script type="text/javascript" src="__JS__/basic.js"></script>
  ```
7. 在测试的时候，由于是更改的配置文件刷新，每次都要删除编译文件才能生效；

### 三．文件加载

1. 传统方式调用 CSS 或 JS 文件时，采用 link 和 script 标签实现；

2. 系统提供了更加智能的加载方式，方便加载 CSS 和 JS 等文件；

3. 使用{load}标签和 href 属性来链接，不需要设置任何其它参数；

  ```php
  {load href='__CSS__/basic.css'/}
  {load href='__JS__/basic.js'/}
  ```

4. 也支持 href 多属性值的写法，如下：

  ```php
  {load href='__CSS__/basic.css, __JS__/basic.js'}
  ```

5. {load}还提供了两个别名{js}、{css}来更好的实现可读性；

  ```php
  {js href='__JS__/basic.js'}
  {css href='__CSS__/basic.css'}
  ```

4. {js}和{css}只是别名而已，识别.js 还是.css 是根据后缀的；


## 模版的布局和继承

### 一．模版布局

1. 默认情况下，不支持模版布局功能，需要在配置文件中开启；

2. 在配置文件 template.php 中，配置开启模版布局功能；

  ```php
  'layout_on' => true,
  ```

3. 此时，执行上一节课的模版控制器，会发现提示缺少模版 `layout.html`；

4. 这个默认的布局文件，是可以更改的，位置和名字均可配置；

  ```php
  'layout_name' => 'public/layout',
  ```

5. 我们清空上一节课 index.html 的模版代码，只写一个“主体”二字；

6. 然后将所有的代码拷贝到 layout.html 的布局模版中去，删除本身的“主体”；

7. 然后执行 index.html 模版时，怎么将主体嵌入到 layout.html 中去？

8. 使用{__CONTENT__}类似魔术方法的标签来引入 index.html“主体”内容；

  ```php
  {include file='public/header,public/nav' title='$title' keywords='这是一个模版！'/}
  {include file="../application/view/public/nav.html"/}
  {__CONTENT__}
  {include file='public/footer'/}
  ```

9. 你可以更改{__CONTENT__}，只要在配置文件中配置；

  ```php
  'layout_item' => '{__REPLACE__}'
  ```

10. 再强调：再测试的时候，如果更改了配置文件，务必删除 temp 下编译文件再刷新；

11. 上面说的是第一种，配置文件下来开启布局，而第二种方式则不需要开启直接使用；

12. 首先，你必须关闭第一种配置，我这里就直接注释掉了，然后使用{layout}标签；

13. 只要在 index.html 的最上面加上如下代码，即可实现模版布局；

    ```php
    {layout name="public/layout" repalce='[__CONTENT__]'}
    ```

14. 第三种，直接在控制器端执行 layout(true)方法即可，false 表示临时关闭；

    ```php
    $this->view->engine->layout(true);
    ```

15. 这种方法，虽然不需要配置文件开启，但如果不用默认的路径，还是要配置路径等；

### 二．模版继承

1. 模版继承是另一种布局方式，这种布局的思路更加的灵活；

2. 首先，我们要创建一个 public/base.html 的基模版文件，文件名随意；

  ```html
  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>{$title}</title>
  </head>
  <body>
  </body>
  </html>
  ```

3. 创建一个新的方法 extend 载入新的模版 extend.html，然后加载基模版；

  ```php
  {extend name='public/base'}
  {extend name='../application/view/public/base.html'}
  ```

4. 对于模版基类里的变量{$title}，直接在控制器设置传值即可；

  ```php
  $this->assign('title', '模版');
  ```

5. 在基模版 base.html 中，设置几个可替换的区块部分，{block}标签实现；

  ```php
  {block name='nav'}nav{/block}
  {block name='include'}{include file='public:nav'}{/block}
  {block name='footer'} @ThinkPHP 版权所有 {/block}
  ```

6. 在 extend.html 模版中，改变 nav，变成自己所需要的部分；

  ```php
  {block name='nav'}
  <ol>
  <li>首页</li>
  <li>分类</li>
  <li>关于</li>
  </ol>
  {/block}
  ```
7. 在 base.html 中，{include}可以加载内容，而在 extend.html 可以改变加载；

  ```php
  {block name='include'}{include file='public:header'}{/block}
  ```

8. 在 base.html 中已设置的内容，可以通过{__block__}加载到 extend.html 中；

  ```php
  {block name='footer'}
  本站来自： {__block__} | 翻版必究
  {/block}
  ```


## 模版的一些杂项

### 一．原样输出

1. 有时，我们需要输出类似模版标签或语法的数据，这时会被模版解析；

2. 此时，我们就使用模版的原样输出标签{literal}；

  ```php
  {literal}
  变量标签形式：{$name}
  {/literal}
  ```

### 二．模版注释

1. 对于在 HTML 页面中的标签，用 HTML 注释是无效的，需要模版定义的注释；

  ```php
  {//$name}
  {/*$name*/}
  {/* 多行注释*/}
  ```

2. 注释和{符号之间不能有空格，否则无法实现注释隐藏；

3. 生成编译文件后，注释的内容会自动被删除，不会显示；

### 三．标签扩展

1. 标签库分为内置和扩展标签，内置标签库是 Cx 标签库，就是我们一直用的；

2. 标签库源文件在：根目录下 `thinkphp/library/think/template/taglib`；

3. 其中 TagLib.php 是标签解析基类，Cx.php 是标签库解析类，继承自 TagLib；

4. 通读源代码，我们发现，基本都是我们之前所学习的标签，用法也很简单；

  ```php
  {eq name='xxx'}yyy{/eq}
  ```

5. 因为 Cx 是内置标签，使用的时候是非常简洁的形式，如果是扩展标签则如下格式：

  ```php
  {cx:eq name='xxx'}yyy{/cx:eq}
  ```

6. 如果自己定义一个扩展的标签库，可以按照 Cx.php，在它旁边创建 Html.php；

  ```php
  class Html extends TagLib
  {
      //定义标签列表
      protected $tags = [
          //标签定义： attr 属性列表 close 是否闭合(0 或者 1，默认 1)
          'font' => ['attr' => 'color,size', 'close'=>1]
      ];
      //闭合标签
      public function tagFont($tag, $content)
      {
          $parseStr = '<span style="color: ' . $tag['color'] . ';font-size:' . ($tag['size'] * 10) . 'px">' . $content . '</span>';
          return $parseStr;
      }
  }
  ```

7. 对于扩展标签，我们需要在模版中引入这个标签，并使用扩展标签；

  ```php
  {html:font color='red' size='10'}
  我是 ThinkPHP
  {/html:font}
  ```

8. 如果想把这个扩展标签库移到应用目录区，比如：`application\taglib`；

9. 我们这个时候，需要在 template.php 配置一下预加载标签；

  ```php
  // 预先加载的标签库
  'taglib_pre_load' => 'app\taglib\Html',
  ```

10. 最后，需要更改一下 Html.php 的命名空间；

    ```php
    namespace app\taglib;
    ```



## 路由介绍和定义

### 一．路由简介

1. 路由的作用就是让 URL 地址更加的规范和优雅，或者说更加简洁；

2. 设置路由对 URL 的检测、验证等一系列操作提供了极大的便利性；

3. 在 ThinkPHP5.1 中，路由是默认开启的，没有配置开关，不需要手动配置；

4. 创建一个 Address 控制器类，创建两个方法，具体如下：

  ```php
  class Address extends Controller
  {
      public function index()
      {
      	return 'index';
      }
      public function details($id)
      {
      	return 'details 目前调用的 id：'.$id;
      }
  }
  ```

5. 为了让我们路由的课程观看更加直观，我们采用内置服务器的方式来演示；

6. 通过命令行模式键入到当前项目目录后输入命令：php think run 启动；

7. 此时，public 目录会自动被绑定到顶级域名：127.0.0.1:8000 上；

8. 我们只要在地址栏键入：http://localhost:8000 或(127.0.0.1:8000)即可；

### 二．路由定义

1. 在没有定义路由规则的情况下，我们访问 address/details 包含 id 的 URL 为：
    http://localhost:8000/address/details/id/5 //或者.../id/5.html

2. 将这个 URL 定义路由规则，在根目录 route 下的 Route.php 里配置；

  ```php
  Route::get('details/:id', 'Address/details');
  ```

3. 当配置好路由规则后，会出现非法请求的错误，我们需要用路由规则的 URL 访问；
    http://localhost:8000/details/5 //或者.../details/5.html

4. 一般来说 GET 方法是用的最多的，所以我们使用 Route::get()最多，其它如下：

  ```php
  Route::rule('details/:id', 'Address/xxx, 'GET'); //GET
  Route::rule('details/:id', 'Address/xxx, 'POST'); //POST
  Route::rule('details/:id', 'Address/xxx, 'GET|POST'); //GET 或 POST
  ```

5. 所有请求方式(快捷方式)：GET(get)、POST(post)、DELETE(delete)、PUT(put)
    PATCH(patch)、*(any，任意请求方式)

6. 快捷方式，就是直接用 Route::get、Route::post 等方式即可，无须第三参数；

7. 当我们设置了强制路由的时候，访问首页就会报错，必须强制设置首页路由；

8. 开始强制路由，需要在 app.php 里面进行配置，然后配置首页路由；

  ```php
  'url_route_must' => true,
  ```

  ```php
  Route::get('/', 'index'); //当写一个 index，表面控制器是 Index
  ```

9. 在路由的规则表达式中，有多种地址的配置规则，具体如下：

  ```php
  //静态路由
  Route::get('ad', 'address/index');
  //静态动态结合的地址
  Route::get('details/:id', 'address/details');
  //多参数静态动态结合的地址
  Route::get('search/:id/:uid', 'address/search');
  //全动态地址，不限制是否 search 固定
  Route::get(':search/:id/:uid', 'address/search');
  //包含可选参数的地址
  Route::get('find/:id/[:content]', 'address/find');
  //规则完全匹配的地址
  Route::get('search/:id/:uid$', 'address/search');
  ```

  ```php
  //也可以开启全局完全匹配，在 app.php 中配置
  'route_complete_match' => true,
  ```

10. 路由定义好之后，我们在控制器要创建这个路由地址，可以通过 url()方法实现；

    ```php
    //不定义标识的做法
    return url('address/details', ['id'=>10]);
    //定义标识的做法
    Route::get('details/:id', 'address/details')->name('det');
    return url('det', ['id'=>10]);
    ```



## 路由的变量规则和闭包

### 一．变量规则

1. 系统默认的路由变量规则为\w+，即字母、数字和下划线；

2. 如果我们需要对于具体的变量进行单独的规则设置，则需要通过 pattern()方法；

3. 将 details 方法里的 id 传值，严格限制必须只能是数字\d+；

  ```php
  Route::get('details/:id', 'address/details')
  ->name('det')
  ->pattern('id', '\d+');
  ```

4. 也可以设置 search 方法的两个值的规则，通过数组的方式传递参数；

  ```php
  Route::get('search/:id/:uid', 'address/search')
  ->pattern([
      'id' => '\d+',
      'uid' => '\d+'
  ]);
  ```

5. 以上两种，均为局部变量规则，也可以直接在 Route.php 设置全局变量规则；

  ```php
  Route::pattern([
      'id' => '\d+',
      'uid' => '\d+'
  ]);
  ```

6. 也支持使用组合变量规则方式，实现路由规则；

  ```php
  Route::get('details-<id>', 'address/details')->pattern('id', '\d+');
  ```

7. 动态组合的拼装，地址和参数如果都是模糊动态的，可以使用如下方法；

  ```php
  Route::get('details-:name-:id', 'Hello_:name/details')->pattern('id', '\d+');
  ```

8. 在不设定任何规则的情况下，系统默认为\w+，在配置文件中可以更改默认规则；

  ```php
  'default_route_pattern' => '[\w\-]+',
  ```

### 二．闭包支持

1. 闭包支持我们可以通过 URL 直接执行，而不需要通过控制器和方法；

  ```php
  Route::get('think', function () {
  	return 'hello,ThinkPHP5!';
  });
  ```

2. 闭包支持也可以传递参数和动态规则；

  ```php
  Route::get('hello/:name', function ($name) {
  	return 'Hello,' . $name;
  });
  ```



## 路由的地址和缓存

### 一．路由地址

1. 路由的地址一般为：控制器/方法，如果多模块则：模块/控制器/方法；
   
    ```php
    //默认 Index 控制器
    Route::get('/', 'index');
    //控制器/方法
    Route::get('details/:id', 'Address/details');
//模块/控制器/方法
    Route::get('details/:id', 'index/Address/details');
    ```
    
2. 支持多级控制器，并且支持路由到相应的地址；
   
    ```php
    //目录为：application\controller\group
    namespace app\controller\group;
    //地址为：application\controller\group
    http://localhost:8000/group.address/details/id/5
//支持多级路由
    Route::get('details/:id', 'group.Address/details');
    ```
    
3. 支持动态路由地址以及额外参数地址；
   
    ```php
    Route::get('details-:name-:id', 'Hello_:name/details');
//获取隐式 GET 值：$this->request->param('flag');
    Route::get('details/:id', 'Address/details?flag=1&status=1');
    ```
    
4. 支持直接去执行方法，不单单是普通方法，还有静态方法；
   
    ```php
    Route::get('details/:id', 'app\controller\Address@details');
    Route::get('stat/:id', 'app\controller\Address::stat');
    ```
    
5. 路由也支持重定向功能，实现一个外部跳转；
   
    ```php
    Route::get('details/:id', 'http://www.liyanhui.com/details/:id')->status(302);
    Route::redirect('details/:id', 'http://www.liyanhui.com/details/:id', 302);
    ```

6. 路由也可以对模版进行传值；

    ```php
    Route::view('see/:name', 'See/other');
    Route::view('see/:name', 'See/other', ['email'=>'huiye@163.com']);
    ```

### 二．路由缓存

1. 路由缓存可以极大的提高性能，需要在部署环境下才有效果，在 app.php 开启；

    ```php
    'route_check_cache' => true,
    ```

2. 为了测试路由缓存是否真的在起作用，可以通过一条命令行命令来清理缓存测试；

    ```bash
    >php think clear --route
    ```



## 路由的参数和快捷路由

### 一．路由参数

1. 设置路由的时候，可以设置第三个数组参数，主要实施匹配检测和行为执行；

2. ext 参数作用是检测 URL 后缀，比如：我们强制所有 URL 后缀为.html；

  ```php
  Route::get('details/:id', 'address/details', ['ext'=>'html']);
  ...['ext'=>'html|shtml'] //支持多个
  ```

3. 第三数组参数也可以作为对象的方法存在，比如改下成如下形式；

  ```php
  Route::get('details/:id', 'address/details')->ext('html');
  ```

4. https 参数作用是检测是否为 https 请求，结合 ext 强制 html 如下；

  ```php
  Route::get('details/:id', 'address/details', ['ext'=>'html', 'https'=>true]);
  Route::get('details/:id', 'address/details')->ext('html')->https();
  ```

5. 如果想让全局统一配置 URL 后缀的话，可以在 app.php 中设置；

  ```php
  //设置 false 为禁止后缀，空允许所有后缀
  'url_html_suffix' => 'html',
  ```

6. denyExt 参数作用是禁止某些后缀的使用；

  ```php
  Route::get('details/:id', 'address/details')->denyExt('gif|jpg|png');
  ```

7. filter 参数作用是对额外参数进行检测；

  ```php
  Route::get('details/:id', 'address/details')->filter('id', 10);
  ```

8. model 参数作用是绑定到模型，第三参数设置 false 避免异常，也可以多参数；

  ```php
  Route::get('user/:id', 'address/getUser')->model('id', '\app\model\User');
  ...->model('id', '\app\model\User',false);
  Route::get('user/:id/:name'...->model('id&name', '\app\model\User');
  ```

9. option 参数作用是全局的路由进行配置，且可以多次调用；

  ```php
  Route::option('ext', 'html')->option('https', true);
  ```

### 二．快捷路由

1. 快捷路由可以快速给控制器注册路由，还可以更加不同的请求类型设置前缀；

  ```php
  Route::controller('short', 'Short');
  ```

2. 快捷路由控制器和方法的编写原则，给方法前面加上 get 或 post 等请求类型；

  ```php
  class Short extends Controller
  {
      public function index()
      {
      return 'index';
      }
      
      public function getInfo()
      {
      return 'getInfo';
      }
      
      public function getList()
      {
      return 'getList';
      }
      
      public function postInfo()
      {
      return 'postInfo';
      }
  }
  ```



## 路由的分组和注解

### 一．路由分组

1. 路由分组，即将相同前缀的路由合并分组，这样可以简化路由定义，提高匹配效率；

2. 在定义分组路由前，我们专门做一个类，来实际演练这个效果；

  ```php
  class Collect extends Controller
  {
      public function index()
      {
      	return 'index';
      }
      
      public function read($id)
      {
      	return 'read id:'.$id;
      }
      
      public function who($name)
      {
      	return 'your name:'.$name;
      }
  }
  ```

3. 使用 group()方法，来进行分组路由的注册；

  ```php
  Route::group('col', [
  ':id' => 'Collect/read',
  ':name' => 'Collect/who'
  ])->ext('html')->pattern(['id'=>'\d+$', 'name'=>'\w+$']);
  ```

4. 使用 group()方法，并采用闭包的形式进行注册；

  ```php
  Route::group('col', function () {
  Route::get(':id', 'Collect/read');
  Route::get(':name', 'Collect/who');
  })->ext('html')->pattern(['id'=>'\d+$', 'name'=>'\w+$']);
  ```

5. 使用 prefix()方法，简化路径的地址；

  ```php
  Route::group('col', function () {
  Route::get(':id', 'read');
  Route::get(':name', 'who');
  }) ->prefix('Collect/')
  ->ext('html')
  ->pattern(['id'=>'\d+$', 'name'=>'\w+$']);
  ```

6. 使用 append()方法，可以额外传入参数，用 request 获取；

  ```php
  Route::group()...->append(['flag'=>1]);
  ```

7. 路由规则(主要是分组和域名路由)定义的文件，加载时会解析消耗较多的资源；

8. 尤其是规则特别庞大的时候，延迟解析开启让你只有在匹配的时候才会注册解析；

9. 我们在 app.php 中开启延迟解析，多复制几组规则，然后通过 trace 来查看内存；

  ```php
  'url_lazy_route' => true,
  ```

### 二．注解路由

1. 路由系统还提供了一个可以在注解(注释)中直接创建路由的方式，但默认关闭；

2. 我们在 app.php 中，开启路由注解功能；

  ```php
  'route_annotation' => true,
  ```

3. 然后在控制器设置注解代码即可，可以使用 PHPDOC 生成一段，然后添加路由规则；

    ```php
    /**
    * @param $id
    * @return string
    * @route('col/:id');
    */
    ```
    
4. 第二参数，可以设置请求类型，而需要设置更多的规则，可以换行设置；

    ```php
    /**
    * @param $id
    * @return string
    * @route('col/:id', 'get')
    * ->ext('html')
    * ->pattern(['id'=>'\d+'])
    *
    */
    ```
    
5. 有几个注意点：语句结尾不需要分号，路由规则结束后，需要有一个空行；

6. 支持资源路由，下节课会讲到具体资源路由；

    ```php
    /**
    * @route('col')
    */
    class Collect extends Controller
    ```



## 路由的 MISS 和跨域请求

### 一．MISS 路由

1. 全局 MISS,类似开启强制路由功能，匹配不到相应规则时自动跳转到 MISS；

  ```php
  Route::miss('public/miss');
  ```

2. 分组 MISS，可以在分组中使用 miss 方法，当不满足匹配规则时跳转到这里；

  ```php
  Route::miss('miss');
  ```

### 二．跨域请求

1. 当不同域名进行跨域请求的时候，由于浏览器的安全限制，会被拦截；

2. 所以，为了解除这个限制，我们通过路由 allowCrossDomain()来实现；

  ```php
  Route::get('col/:id', 'Collect/read')
  ->ext('html')->allowCrossDomain();
  ```

3. 实现跨域比如没有实现的 header 头文件多了几条开头为 Access 的信息；

4. 此时，这个页面，就可以支持跨域请求的操纵了；

5. 我们创建一个不同端口号或不同域名的 ajax 按钮，点击获取这个路由页面信息；

6. 如果，没有开启跨域请求，则会爆出提醒：
    已拦截跨源请求：同源策略禁止读取位于 http://localhost:8000/col/5.html 的远程资源。（原因：CORS 头缺
    少 'Access-Control-Allow-Origin'）

7. 开启后，即正常获取得到的数据；

8. 如果你想限制跨域请求的域名，则可以增加一条参数；

  ```php
  Route::get('col/:id', 'Collect/read')
  ->ext('html')
  ->header('Access-Control-Allow-Origin','http://localhost')
  ->allowCrossDomain();
  ```



## 路由的绑定和别名

### 一．路由绑定

1. 路由绑定可以简化 URL 和路由规则的定义，可以绑定到模块/控制器/操作；

2. 由于本身不是规则，需要关闭强制路由来测试，本身绑定并不是定义路由；

3. index 模块/User 控制器/read：http://.../index/user/read/id/5；

  ```php
  //绑定路由到 index 模块
  Route::bind('index); http://.../user/read/id/5
  //绑定路由到 User 控制器
  Route::bind('index/User); http://.../read/id/5
  //绑定路由到 read 操作
  Route::bind('index/User/read); http://.../id/5
  ```

4. 当我们再创建一个 admin 模块，只要绑定到 admin 模块，开启路由就切换了；

  ```php
  Route::bind('admin');
  Route::get('user/:id','User/read'); //未绑定则：admin/user/read
  ```

### 二．路由别名

1. 给一个控制器起一个别名，可以通过别名自动生成一系列规则；

2. 比如，给 index 模块下的 User 控制器创建别名：user，省去了模块 index；

  ```php
  Route::alias('user', 'index/User');
  ```

  http://localhost:8000/user/create
  http://localhost:8000/user/edit/id/5
  http://localhost:8000/user/read/id/5

3. 也可以直接绑定到类，来实现相同的效果；

  ```php
  Route::alias('user', '\app\index\controller\User');
  ```

4. 也支持别名设置限定条件，比如 ext 等；

  ```php
  Route::alias('user', 'index/User', ['ext'=>'html']);
  Route::alias('user', 'index/User')->ext('html');
  ```

**PS：这两个知识点，部分功能有些问题；而别名路由和前面的快捷路由在 PHP6 已经废
弃，产生的问题自然在新版也没了；**



## 资源路由

### 一．资源路由

1. 资源路由，采用固定的常用方法来实现简化 URL 的功能；

2. 系统提供了一个命令，方便开发者快速生成一个资源控制器；

  ```bash
  php think make:controller index/Blog
  ```

3. 模块/控制器，默认在 controller 目录下，根据你的情况调整路径结构；

  ```bash
  php think make:controller Blog //单应用
  php think make:controller ../index/controller/Blog //多应用
  ```

4. 模块/控制器，默认在 controller 目录下，根据你的情况调整路径结构；

5. 从生成的多个方法，包含了显示、增删改查等多个操作方法；

6. 在路由 route.php 文件下创建一个资源路由，资源名称可自定义；

  ```php
  Route::resource('blog', 'Blog'); //多应用即：index/Blog
  ```

7. 这里的 blog 表示资源规则名，Blog 表示路由的访问路径；

8. 资源路由注册成功后，会自动提供以下方法，无须手动注册；

9. GET 访问模式下：index(blog)，create(blog/create)，read(blog/:id)，edit(blog/:id/edit)

10. POST 访问模式下：save(blog)；

11. PUT 方式模式下：update(blog/:id)；

12. DELETE 方式模式下：delete(blog/:id)；
    http://localhost:8000/blog/ (index)
    http://localhost:8000/blog/5 (read)
    http://localhost:8000/blog/5/edit (edit)

13. 对于 POST，是新增，一般是表单的 POST 提交，而 PUT 和 DELETE 用 AJAX 访问；

14. 将跨域提交那个例子修改成.ajax，其中 type 设置为 DELETE 即可访问到；

    ```php
    $.ajax({
        type : "DELETE",
        url : "http://localhost:8000/blog/10",
        success : function (res) {
            console.log(res);
        }
    });
    ```

15. 默认的参数采用 id 名称，如果你想别的，比如：blog_id，则：
    
```php
    ->vars(['blog'=>'blog_id']); //相应的 delete($blog_id)
```

16. 也可以通过 only()方法限定系统提供的资源方法，比如：
    
```php
    ->only(['index','save','create'])
```

17. 还可以通过 except()方法排除系统提供的资源方法，比如：
    
```php
    ->except(['read','delete','update'])
```

18. 使用 rest()方法，更改系统给予的默认方法，1.请求方式；2.地址；3.操作；

    ```php
    Route::rest('create', ['GET', '/:id/add', 'add']);
    //批量
    Route::rest([
        'save' => ['POST', '', 'store'],
        'update' => ['PUT', '/:id', 'save'],
        'delete' => ['DELETE', '/:id', 'destory'],
    ]);
    ```

19. 使用嵌套资源路由，可以让上级资源对下级资源进行操作，创建 Comment 资源；

    ```php
    class Comment
    {
        public function read($id, $blog_id)
        {
        	return 'Comment id:'.$id.'，Blog id:'.$blog_id;
        }
        
        public function edit($id, $blog_id)
        {
        	return 'Comment id:'.$id.'，Blog id:'.$blog_id;
        }
    }
    ```

20. 使用嵌套资源路由，可以让上级资源对下级资源进行操作，创建 Comment 资源；

    ```php
    Route::resource('blog.comment', 'Comment');
    ```

21. 资源嵌套生成的路由规则如下：
    http://localhost:8000/blog/:blog_id/comment/:id
    http://localhost:8000/blog/:blog_id/comment/:id/edit

22. 嵌套资源生成的上级资源默认 id 为：blog_id，可以通过 vars 更改；

    ```php
    Route::resource('blog.comment', 'Comment')
    ->vars(['blog'=>'blog_id']);
    ```



## 域名路由

### 一．域名路由

1. 要使用域名路由，首先，在本地我们需要通过 hosts 文件来映射；

2. 打开 `C:\Windows\System32\drivers\etc` 找到 hosts 文件；

3. 在末尾添加一句：`127.0.0.1 news.abc.com` 映射二级域名；

4. 再在末尾添加一句：`127.0.0.1 a.news.abc.com` 用于三级域名泛指；

5. 此时，我们访问 news.abc.com 就直接映射到 localhost 里了；

6. 如果想访问 thinkphp 独立的服务器，开启后，直接:8080 即可；
    http://news.abc.com:8000

7. 拿 Collect 控制器举例，复习一下路由的规则；

  ```php
  Route::get('edit/:id', 'Collect/edit');
  ```

8. 如果想限定在 news.abc.com 这个域名下才有效，通过域名路由闭包的形式；

  ```php
  Route::domain('news', function () {
  	Route::get('edit/:id', 'Collect/edit');
  });
  ```

9. 这里的 domain()即域名路由，第一参数，表示二级(子)域名的名称；

10. 除了闭包方式，也可以通过数组的方式来设置域名路由；

    ```php
    Route::domain('news', [
    	'edit/:id' => ['Collect/edit']
    ]);
    ```

11. 除了二级(子)域名设置外，也可以设置完整域名；

    ```php
    Route::domain('news.abc.com', [
    	'edit/:id' => ['Collect/edit']
    ]);
    ```

12. 支持多个二级(子)域名，使用相同的路有规则；

    ```php
    Route::domain(['news', 'blog', 'live'], function () {
    	Route::get('edit/:id', 'Collect/edit');
    });
    ```

13. 可以作为方法，进行二级(子)域名的检测，或完整域名检测；

    ```php
    Route::get('edit/:id', 'Collect/edit')->domain('news');
    Route::get('edit/:id', 'Collect/edit')->domain('news.abc.com');
    ```

### 二．域名绑定

1. 在 app.php 中可以设置根域名，如果不设置，会默认自动获取；

  ```php
  'url_domain_root' => 'abc.com',
  ```

2. 当设置了根域名后，如果实际域名不符，将解析失败；

3. 域名设置还支持绑定指定的模块，比如多应用的 admin 模块；

  ```php
  Route::domain('news', 'admin');
  Route::domain('news.abc.com', 'admin');
  Route::domain('127.0.0.1', 'admin');
  ```

4. 如果遇到三级域名，并且需要通用泛指，可以使用`*`通配符；

  ```php
  Route::domain('*.news', [
  'edit/:id' => ['Collect/edit']
  ]);
  ```

5. 而直接使用通配符`*`，则指定所有的二级域名；

  ```php
  Route::domain('*', [
  'edit/:id' => ['Collect/edit']
  ]);
  ```

**PS：还绑定到命名空间、类，额外参数、分组等操作和前面众多路由一样，不再重复
讲解；**



## 路由的 URL 生成

### 一．域名路由

1. 之前所有的 URL，都是手动键入的，而路由也提供了一套生成方法；

  ```php
  Url::build('地址表达式',['参数'],['URL 后缀'],['域名'])
  url('地址表达式',['参数'],['URL 后缀'],['域名'])
  ```

2. 在 Collect 演示生成，拿 Blog 来实现 URL 地址；

3. 使用 build()方法，只传一个控制器时，会被误认为 Collect 下的 blog 方法；

  ```php
  Url::build('Blog'); // /collect/blog.html
  ```

4. 在没有设置路由的情况下，传递一个控制器以及操作方法；

  ```php
  Url::build('Blog/create'); // /blog/create.html
  ```

5. 如果设置了对应路由，第 4 条生成的 URL 会相应的改变；

  ```php
  Route::get('bc', 'Blog/create'); // /bc.html
  Route::get('bl/cr', 'Blog/create'); // /bl/cr.html
  ```

6. 下面是没有设置路由和设置路由的带参数的 URL 生成；

  ```php
  Url::build('Blog/read', 'id=5'); // /blog/read/id/5.html
  Url::build('Blog/read', 'id=5'); // /read/5.html
  ```

7. 参数部分，也可以用数组的方式，当然，多参数也支持；

  ```php
  Url::build('Blog/read', ['id'=>5]);
  Url::build('Blog/read', 'id=5&uid=10');
  Url::build('Blog/read', ['id'=>5, 'uid'=>10]);
  ```

8. 也可以使用助手函数 url 直接来设置；

  ```php
  url('Blog/read', ['id'=>5]);
  ```

9. 也可以使用普通的地址来设置 url；

  ```php
  Url::build('Blog/read?id=5');
  ```

10. 也可以使用和路由规则配对的方式设置 url；

    ```php
    Url::build('/read/5');
    ```

11. 在 app.php 可以设置默认 html 后缀，也可以在方法第三个参数设置；

    ```php
    url('Blog/edit', ['id'=>5], 'shtml');
    ```

12. 使用#name，可以生成一个带锚点的 url；

    ```php
    url('Blog/edit#name', ['id'=>5]);
    ```

13. 使用 `Url::root('/index.php')`在 URL 前面加上一个 index.php；

14. 但这个添加需要整体考虑路径是否支持或正确，否则无法访问；

15. 在本身有 index.php 的时候，使用 `Url::root('/')` 隐藏；

    ```php
    Url::root('/index.php');
    ```



## 请求对象和信息

### 一．请求对象

1. 当控制器继承了控制器基类时，自动会被注入 Request 请求对象的功能；

  ```php
  class Rely extends Controller
  {
      public function index()
      {
      	return $this->request->param('name');
      }
  }
  ```

2. Request 请求对象拥有一个 param 方法，传入参数 name，可以得到相应的值；

3. 如果我们不继承控制器基类，可是自行注入 Request 对象，依赖注入后面会讲；

  ```php
  use think\Request;
  class Rely
  {
      public function index(Request $request)
      {
      	return $request->param('name');
      }
  }
  ```

4. 还可以通过构造方法进行注入，通过构造注入，就不需要每个方法都注入一遍；

  ```php
  use think\Request;
  class Rely
  {
      protected $request;
      
      public function __construct(Request $request)
      {
      	$this->request = $request;
      }
      
      public function index()
      {
      	return $this->request->param('name');
      }
  }
  ```

5. 使用 Facade 方式应用于没有进行依赖注入时使用 Request 对象的场合；

  ```php
  use think\facade\Request;
  class Rely
  {
      public function index()
      {
      	return Request::param('name');
      }
  }
  ```

6. 使用助手函数 request()方法也可以应用在没有依赖注入的场合；

  ```php
  class Rely
  {
      public function index()
      {
      	return request()->param('name');
      }
  }
  ```

### 二．请求信息

1. Request 对象除了 param 方法外，还有一些请求的固定信息，如表：

![image-20210224102721942](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210224102721942.png)

2. 上表的调用方法，直接调用即可，无须传入值，只有极个别如果传入 true 获取完
    整 URL 的功能；
    
    ```php
    Request::url();
    // 获取完整 URL 地址 包含域名
    Request::url(true);
    // 获取当前 URL（不含 QUERY_STRING） 不带域名
    Request::baseFile();
    // 获取当前 URL（不含 QUERY_STRING） 包含域名
    Request::baseFile(true);
    // 获取 URL 访问根地址 不带域名
    Request::root();
    // 获取 URL 访问根地址 包含域名
    Request::root(true);
    ```



## 请求变量

### 一．请求变量

1. Request 对象支持全局变量的检测、获取和安全过滤，支持$_GET、$_POST...等；

2. 为了方便演示，这里一律使用 Facade 的静态调用模式；

3. 使用 has()方法，可以检测全局变量是否已经设置：

  ```php
  dump(Request::has('id', 'get'));
  dump(Request::has('username', 'post'));
  ```

4. Request 支持的所有变量类型方法，如下表：

![image-20210224105759505](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210224105759505.png)

5. param()变量方法是自动识别 GET、POST 等的当前请求，推荐使用；

  ```php
  //获取请求为 name 的值，过滤
  dump(Request::param('name'));
  //获取所有请求的变量，以数组形式，过滤
  dump(Request::param());
  //获取所有请求的变量(原始变量)，不包含上传变量，不过滤
  dump(Request::param(false));
  //获取所有请求的变量，包含上传变量，过滤
  dump(Request::param(true));
  ```

6. 如果使用依赖注入的方式，可以将变量作为对象的属性进行调用；

  ```php
  public function read(\think\Request $request)
  {
  	return $request->name;
  }
  ```

7. 如果采用的是路由 URL，也可以获取到变量，但 param::get()不支持路由变量；

  ```php
  public function edit($id)
  {
      dump(Request::param());
      dump(Request::route()); // 路由请求不支持 get 变量
      dump(Request::get()); // get 变量不支持路由请求
  }
  ```

8. 注意：除了::server()和::env()方法外，其它方法传递的变量名区分大小写；

9. 因为::server()和::env()属于系统变量，会强制转换为大写后获取值；

10. 如果获取不到值，支持请求的变量设置一个默认值；

    ```php
    dump(Request::param('name', 'nodata'));
    ```

11. 对于变量的过滤，在全局设置一个过滤函数，也可以单独对某个变量过滤；

    ```php
    'default_filter' => 'htmlspecialchars',
    ```

    ```php
    Request::param('name', '', 'htmlspecialchars');
    Request::param('name', '', 'strtoupper');
    ```

12. 使用 only()方法，可以获取指定的变量，也可以设置默认值；

    ```php
    dump(Request::only('id,name'));
    dump(Request::only(['id','name']));
    dump(Request::only(['id'=>1,'name'=>'nodata']));
    ```

13. 使用 only()方法，默认是 param 变量，可以在第二参数设置 GET、POST 等；

    ```php
    dump(Request::only(['id','name'], 'post'));
    ```

14. 相反的 except()方法，就是排除指定的变量；

    ```php
    dump(Request::except('id,name'));
    dump(Request::except(['id','name']));
    dump(Request::except(['id'=>1,'name'=>'nodata']));
    dump(Request::except(['id','name'], 'post'));
    ```

15. 使用变量修饰符，可以将参数强制转换成指定的类型；

16. /s(字符串)、/d(整型)、/b(布尔)、/a(数组)、/f(浮点)；

    ```php
    Request::param('id/d');
    ```

### 二．助手函数

1. 为了简化操作，Request 对象提供了助手函数；

  ```php
  dump(input('?get.id')); //判断 get 下的 id 是否存在
  dump(input('?post.name')); //判断 post 下的 name 是否存在
  dump(input('param.name')); //获取 param 下的 name 值
  dump(input('param.name', 'nodata')); //默认值
  dump(input('param.name', '', 'htmlspecialchars')); //过滤器
  dump(input('param.id/d')); //设置强制转换
  ```



## 请求类型和 HTTP 头信息

### 一．请求类型

1. 有时，我们需要判断 Request 的请求类型，比如 GET、POST 等等；

2. 可以使用 method()方法来判断当前的请求类型，当然，还有很多专用的请求判断；

![image-20210224213603904](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210224213603904.png)

3. 使用普通表单提交，通过 method() 方法获取类型；
    ```html
    <form action="http://localhost/tp5.1/public/rely" method="post">
        <input type="text" name="name" value="Lee">
        <input type="submit" value="提交">
    </form>
    ```
    ```php
    return Request::method();
    ```

4. 在表单提交时，我们也可以设置请求类型伪装，设置隐藏字段_method；

5. 而在判断请求，使用 method(true)可以获取原始请求，否则获取伪装请求；

  ```php
<form action="http://localhost/tp5.1/public/rely" method="post">
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" value="Lee">
    <input type="submit" value="提交">
</form>  
  ```

  ```php
  Request::method(true);
  ```

6. 如果想更改请求伪装变量类型的名称，可以在 app.php 中更改；

  ```php
  'var_method' => '_method',
  ```

7. AJAX/PJAX 伪装，使用?_ajax=1 和?_pjax=1，并使用 isAjax()和 isPjax()；

  ```php
  //.../rely?_ajax=1 
  dump(Request::isAjax());
  ```

8. 这里需要用 isAjax()和 isPjax()来判断，用 method 无法判断是否为 a(p)jax；

9. 在 app.php 也可以更改 ajax 和 pjax 的名称；

  ```php
  'var_ajax' => '_ajax',
  'var_pjax' => '_pjax', 
  ```

### 二．HTTP 头信息

1. 使用 header()方法可以输出 HTTP 头信息，返回是数组类型，也可单信息获取；

  ```php
  dump(Request::header());
  dump(Request::header('host'));
  ```



## 伪静态.参数绑定.请求缓存

### 一．伪静态

1. 先使用 Url::build()方法获取当前的 url 路径，得到默认的后缀为.html；

  ```php
  return Url::build();
  ```

2. 可以通过 app.php 修改伪静态的后缀，比如修改成 shtml、xml 等；

  ```php
  'url_html_suffix' => 'xml',
  ```

3. 如果地址栏用后缀访问成功后，可以使用 Request::ext()方法得到当前伪静态；

  ```php
  return Request::ext();
  ```

4. 配置文件伪静态后缀，可以支持多个，用竖线隔开，访问时不在区间内则报错；

  ```php
  'url_html_suffix' => 'shtml|xml|pdf',
  ```

5. 直接将伪静态配置文件设置为 false，则关闭伪静态功能；

  ```php
  'url_html_suffix' => false,
  ```

### 二．参数绑定

1. 参数绑定功能：即 URL 地址栏的数据传参，我们一直在使用的功能；

  ```php
  public function get($id)
  {
  	return 'get:'.$id;
  }
  ```

2. 操作方法 URL：/get，而带上 id 参数后，则为：/get/id/5；

3. 如果缺少了 /5 或者缺少了`/id/5`，则都会报错方法参数错误：id；

4. 那么解决方案，就是给 `$id = 0` 一个默认值，防止 URL 参数错误；

5. 如果设置了两个参数，那么参数传递的执行顺序可以设置，比如；

  ```php
  public function get($id, $name)
  {
  	return 'get:'.$id.'，'.$name;
  }
  ```

6. 不管是：`/id/5/name/lee`，还是：`/name/lee/id/5`，都不会产生错误；

7. 但如果你在 app.php 中设置了，必须按照顺序去传递参数，则需要严格；

  ```php
  // URL 参数方式 0 按名称成对解析 1 按顺序解析
  'url_param_type' => 1,
  /get/5/lee //不需要再传递 id 和 name，直接按顺序传值即可
  ```

### 三．请求缓存

1. 请求缓存仅对 GET 请求有效，并设置有效期；

2. 可以设置全局请求缓存，在 app.php 中设置；

  ```php
  'request_cache' => true,
  'request_cache_expire' => 3600,
  ```

3. 当第二次访问时，会自动获取请求缓存的数据响应输出，并发送 304 状态码；

4. 如果要对路由设置一条缓存，直接使用 `cache(3600)` 方法；

  ```php
  Route::get('edit/:id', 'Rely/edit')->cache(3600);
  ```



##  响应重定向和文件下载

### 一．响应操作

1. 响应输出，之前已经都掌握了，包括 return、json()和 view()；

2. return 默认会输出 html 格式，配置文件默认设定的 `default_return_type`；

3. 而背后是 response 对象，可以用 response()输出达到相同的效果；

  ```php
  return response($data);
  ```

4. 使用 response()方法可以设置第二参数，状态码，或调用 code()方法；

  ```php
  return response($data, 201);
  return response($data)->code(202);
  ```

5. 使用 json()、view()方法和 response()返回的数据类型不同，效果一样；

  ```php
  return json($data, 201);
  return json($data)->code(202);
  ```

6. 不但可以设置状态码，还可以设置 header()头文件信息；

  ```php
  return json($data)->code(202)
  ->header(['Cache-control' => 'no-cache,must-revalidate']);
  ```

### 二．重定向

1. 使用 redirect()方法可以实现页面重定向，需要 return 执行；

  ```php
  return redirect('http://www.baidu.com');
  ```

2. 站内重定向，直接输入路由地址或相对地址即可，需要用顶级域名，二级会错误；

  ```php
  return redirect('edit/5');
  return redirect('/address/details/id/5');
  ```

3. 也可以通过 params()方法传递数组参数键值对的方式，进行跳转；

  ```php
  return redirect('/address/details')->params(['id'=>5]);
  return redirect('/address/details', ['id'=>5]);
  ```

### 三．文件下载

1. 文字下载和图片下载都使用 download() 方法即可，路径为实际路径；

  ```php
  return \download('image.jpg', 'my');
  $data = '这是一个测试文件';
  return \download($data, 'test.txt', true);
  ```



## 容器和依赖注入

### 一．依赖注入

1. 手册对依赖注入比较严谨的说明，具体如下：
    依赖注入其实本质上是指对类的依赖通过构造器完成自动注入，例如在控制器架构方法和操作
    方法中一旦对参数进行对象类型约束则会自动触发依赖注入，由于访问控制器的参数都来自于 URL
    请求，普通变量就是通过参数绑定自动获取，对象变量则是通过依赖注入生成。

2. 先看一个小例子，了解一下依赖注入的写法，创建一个模型；

  ```php
  namespace app\model;
  use think\Model;
  class One extends Model
  {
  	public $name = 'Mr.Lee';
  }
  ```

3. 创建一个控制器 Inject，通过依赖注入将模型 One 对象引入其内；

  ```php
  namespace app\controller;
  use app\model\One;
  class Inject
  {
      protected $one;
      public function __construct(One $one)
      {
      	$this->one = $one;
      }
      public function index()
      {
      	return $this->one->name;
      }
  }
  ```

4. 依赖注入：即允许通过类的方法传递对象的能力，并且限制了对象的类型(约束)；

5. 而传递的对象背后的那个类被自动绑定并且实例化了，这就是依赖注入；

### 二．容器

1. 依赖注入的类统一由容器管理的，大多数情况下是自动绑定和自动实例化的；

2. 如果想手动来完成绑定和实例化，可以使用 bind()和 app()助手函数来实现；

  ```php
  class Inject
  {
      public function index()
      {
      	bind('one', 'app\model\One');
      	return app('one')->name;
      }
  }
  ```

3. bind('one','...') 绑定类库标识，这个标识具有唯一性，以便快速调用；

4. app('one') 快速调用，并自动实例化对象，标识严格保持一致包括大小写；

5. 自动实例化对象的方式，是采用单例模式实现，如果想重新实例化一个对象，则：

  ```php
  //每次调用总是会重新实例化
  $one = app('one', true);
  return $one->name;
  ```

6. 当然，你也可以直接通过 app()绑定一个类到容器中并自动实例化；

  ```php
  return app('app\model\One')->name;
  ```

7. 使用 bind([])可以实现批量绑定，只不过系统有专门提供批量绑定的文件；

   ```php
   bind([
       'one' => 'app\model\One',
       'user' => 'app\model\User'
   ]);
   return app('one')->name;
   bind([
       'one' => \app\model\One::class,
       'user' => \app\model\User::class
   ]);
   return app('user')->name;
   ```

8. `::class` 模式，不需要单引号，而且需要在最前面加上\，之前的加不加都行；

9. 系统提供了 provider.php 文件，用于批量绑定类到容器中，这里不加不报错；

   ```php
   return [
       'one' => app\model\One::class,
       'user' => app\model\User::class
   ];
   ```

10. 系统内置了很多常用的类库，以便开发者快速调用，具体如下：

![image-20210224223123559](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210224223123559.png)

```php
return app('request')->param('name');
```

11. 大家会发现，这个不是我们之前学过的 Request::param()么？对！
12. 也就是说，实现同一个效果可以由容器的 bind()和 app()实现，也可以使用依赖
注入实现，还有 Facade(下节课重点探讨)实现，以及助手函数实现；



## Facade

### 一．创建静态调用

1. Facade，即门面设计模式，为容器的类提供了一种静态的调用方式；

2. 在之前的很多课程中，我们大量的引入 Facade 类库，并且通过静态调用；

3. 比如请求 Request::?，路由 Route::?，数据库 Db::?等等，均来自 Facade；

4. 下面我们手工来创建一个自己的静态调用类库，来了解一下流程；

5. 首先，在应用目录下创建 common 公共类库文件夹，并创建 Test.php；

  ```php
  namespace app\common;
  class Test
  {
      public function hello($name)
      {
      	return 'Hello, '.$name;
      }
  }
  ```

6. 再在同一个目录下创建 facade 文件夹，并创建 Test.php，用于生成静态调用；

  ```php
  namespace app\Facade;
  use think\Facade;
  class Test extends Facade
  {
      protected static function getFacadeClass()
      {
      	return 'app\common\Test';
      }
  }
  ```

7. 然后在控制器端，就可以和之前系统提供的静态调用一样调用了；

  ```php
  return Test::hello('Mr.Lee!');
  ```

8. 除了在 `getFacadeClass()` 方法显示绑定，也可以在应用公共函数文件进行绑定；

9. 这里的绑定后，就不需要 getFacadeClass()方法了，还可以进行批量统一绑定；

  ```php
  // 应用公共文件
  use think\Facade;
  Facade::bind('app\facade\Test', 'app\common\Test');
  Facade::bind([
  	'app\facade\Test' => 'app\common\Test',
  ]);
  ```

### 二．核心类库

1. 以下是系统提供的常用 Facade 核心类库表；

![image-20210225115522682](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210225115522682.png)

2. 在真正使用 Facade 核心类库时，直接使用提供的别名即可，具体别名如下：

![image-20210225115543256](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210225115543256.png)


## 钩子和行为

### 一．概念理解

1. 首先，钩子和行为在 6.0 的版本被废弃了，用事件来取代；
2. 虽说用事件来取代，不过意思的一样的，我们还是有必要理解一下；
3. 什么是行为，就是在系统执行的流程中执行的一个动作；
4. 比如，当执行到路由时，对路由的设置进行一系列的检测，这种就叫行为；
5. 而钩子又是什么呢？可以理解为行为执行的那个位置点，触发点；
6. 系统架构里用了很多这种方式实现框架程序，我们自己手工来创建一个试试；

### 二．小实例

1. 在应用目录下创建一个 behavior 文件夹，用于存放行为类，比如 Test.php

  ```
  namespace app\behavior;
  class Test
  {
      public function run($params)
      {
      	echo $params.'，只要触发，我就执行！';
      }
  }
  ```

2. 行为类创建好之后，设置一个入口方法 run()，run()方法只要钩子被触发就执行；

3. 比如，我们将行为注册到 tags.php 中应用初始化的数组里(app_init)；

  ```php
  // 应用初始化
  'app_init' => [
  	'app\behavior\Test',
  ],
  ```

4. 我们也可以自定义一个钩子，然后注册到 tags.php 中，执行后触发；

  ```php
  public function bhv()
  {
      //钩子
      Hook::listen('eat', '吃饭');
  }
  ```

  ```php
  //自定义
  'eat' => [
  	'app\behavior\Test',
  ],
  ```

5. 那么，我们可不可以让初始化对应的是初始化的行为，自定义对应自定义的行为呢；

6. app_init 对应的方法是 appInit(有下划线的大写)，而自定义 eat 就是 eat；

  ```php
  public function appInit($params)
  {
  	echo '初始化的行为被触发！';
  }
  
  public function eat($params)
  {
  	echo $params.'的行为被触发！';
  }
  ```

7. 系统除了 app_init 钩子，还提供了一系列的钩子供使用；

![image-20210225115939153](https://gitee.com/zhujinrun/image/raw/master/2020/image-20210225115939153.png)



## 中间件【上】

### 一．定义中间件

1. 中间件和钩子有点类似，它主要用于拦截和过滤 HTTP 请求，并进行相应处理；

2. 这些请求的功能可以是 URL 重定向、权限验证等等；

3. 为了进一步了解中间件的用法，我们首先定义一个基础的中间件；

4. 可以通过命令行模式，在应用目录下生成一个中间件文件和文件夹；

  ```bash
  php think make:middleware Check
  ```

5. 具体路径为：application\http\middleware\Check.php；

  ```php
  namespace app\http\middleware;
  use think\Request;
  class Check
  {
      public function handle(Request $request, \Closure $next)
      {
          if ($request->param('name') == 'index') {
          	return redirect('/');
          }
      	return $next($request);
      }
  }
  ```

6. 然后将这个中间件进行注册，在应用目录下`创建 middleware.php` 中间件配置；

  ```php
  return [
  	app\http\middleware\Check::class
  ];
  ```

7. 中间件的入口执行方法必须是：handle() 方法，第一参数请求，第二参数是闭包；

8. 业务代码判断请求的 name 如果等于 index，就拦截住，不再执行，跳转到首页；

9. 但如果请求的 name 是 lee，那需要继续往下执行才行，不能被拦死；

10. 那么就需要`$next($request)`把这个请求去调用回调函数；

11. 中间件 handle()方法规定需要返回 response 对象，才能正常使用；

12. 而 $next($request)，研读源码追踪发现，它就是`返回的 response 对象`；

13. 为了测试拦截后，无法继续执行，可以 `return response()助手函数`测试；




## 中间件【下】

### 一．前/后置中间件

1. 上节课，我们创建了一个简单的中间件，它拦截 HTTP 验证请求匹配后跳转；

2. 这种将`$next($request)`放在方法底部的方式，属于前置中间件；

3. 前置中间件就是请求阶段来进行拦截验证，比如登录判断、跳转、权限等；

4. 而后置中间件就是请求完毕之后再进行验证，比如写入日志等等；

  ```php
  public function handle(Request $request, \Closure $next)
  {
      //中间件代码，前置
      return $next($request);
  }
  
  public function handle(Request $request, \Closure $next)
  {
      $response = $next($request);
      //中间件代码，后置
      return $response;
  }
  ```

### 二．路由中间件

1. 创建一个给路由使用的中间件，判断路由的 ID 值实现相应的验证；

  ```php
  class Auth
  {
      public function handle(Request $request, \Closure $next)
      {
          if ($request->param('id') == 10)
          {
              echo '是管理员，提供后台权限并跳转操作';
          }
          return $next($request);
      }
  }
  ```

2. 如果将 Auth 中间件注册到 middleware.php 中，就变成公有中间件了；

3. 路由方法提供了一个 middleware()方法，让指定的路由采用指定的中间件；

  ```php
  Route::rule('read/:id', 'Inject/read')->middleware('Auth');
  ```

4. middleware()方法，除了传类名，还可以是命名空间的两种形式，均支持；

  ```php
  ->middleware('app\http\middleware\Auth')
  ->middleware(app\http\middleware\Auth::class)
  ```

5. 一个路由规则，如果要注册多个中间件，可以用数组的绑定；

  ```php
  Route::rule('read/:id', 'Inject/read')->middleware(['Auth', 'Check']);
  ```

6. 也支持分组路由，闭包路由等；

  ```php
  Route::group('read', function () {
  	Route::rule(':id', 'Inject/read');
  })->middleware('Auth');
  
  Route::rule('read/:id', 'Inject/read')->middleware(function ($request, Closure $next) {
      if ($request->param('id') == 10) {
      	echo '是管理员！';
      }
  	return $next($request);
  });
  ```

7. 中间件 handler()方法的第三参数，可以路由进行设置；

   ```php
   Route::rule('read/:id', 'Inject/read')->middleware('Auth:abc');
   ```

   ```php
   public function handle(Request $request, \Closure $next, $name)
   {
   	echo $name;
   }
   ```

8. 在定义全局中间件绑定的时候，如果想传入参数，可以设置为数组模式；

   ```php
   [app\http\middleware\Auth::class,'hello']
   'Auth',
   'Auth:hello' 
   ```

### 三．控制器中间件

1. 可以让中间件在控制器里注册，控制器必须继承 Controller 基类；

  ```php
  class Inject extends Controller
  {
  	protected $middleware = ['Auth'];
  }
  ```

2. 默认情况下，控制器中间件对所有操作方法有效，支持做限制；

  ```php
  protected $middleware = [
      'Auth' => ['only' =>['index', 'test']],
      'Check' => ['except' =>['bhv', 'read']],
  ];
  ```

3. 中间件给控制器传递参数，通过 Request 对象实现；

  ```php
  $request->name = 'Mr.Lee';
  ```



## 异常处理

### 一．异常处理

1. 系统输出的异常信息比 PHP 原生的要人性化的多，但需要开启调试模式；

2. 如果你想更改异常页面的样式、布局之类的，可以修改这个页面：

  ```php
  thinkphp/tpl/think_exception.tpl
  ```

3. 如果你想要直接替换掉异常页面，换成别的，可以在 app.php 中进行设置：
   
  ```php
  // 异常页面的模板文件
  'exception_tmpl' => Env::get('think_path') .'tpl/think_exception.tpl', 
  ```

4. 默认情况下，对所有 PHP 的错误都会抛出异常信息，可以用错误级别关闭；
   
```php
    error_reporting(0);
```

5. 系统的异常抛出是自动进行的，并不需要你手动抛出，但也支持手动；

  ```php
  throw new Exception('异常消息', 10086);
  ```

6. 我们可以使用 try...catch 对可能发生的异常进行手动捕获或抛出；

  ```php
  try {
  	echo 0/0;
  } catch (ErrorException $e)
  {
  	echo '发生错误：'.$e->getMessage();
  }
  ```

7. 我们可以抛出 HTTP 异常，所谓 HTTP 异常比如 404 错误，500 错误之类；

  ```php
  throw new HttpException(404, '页面不存在');
  ```

8. 系统提供了一个助手函数 abort()方法简化 HTTP 异常抛出；

  ```php
  abort(404, '页面不存在');
  ```

9. 如果系统关闭了调试模式，进入部署环境下，可以设置 HTTP 错误页面，比如 404；

  ```php
  'http_exception_template' => [
      // 定义 404 错误的模板文件地址
      404 => Env::get('app_path') . '404.html',
  ]
  ```
