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