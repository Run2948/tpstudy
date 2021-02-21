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
