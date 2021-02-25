<?php

namespace app\http\middleware;

class Auth
{
    public function handle($request, \Closure $next, $name = 'no data')
    {
        echo $name;

        if ($request->param('id') == 10)
        {
            // 中间件给控制器传值
            $request->middle_name = 'Mr.Lee';

            echo '是管理员，提供后台权限并跳转操作';
        }
        return $next($request);
    }
}
