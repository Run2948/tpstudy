<?php

namespace app\http\middleware;

class Check
{
    public function handle(\think\Request $request, \Closure $next)
//    public function handle($request, \Closure $next)
    {
        if ($request->param('name') == 'index') {
            return redirect('/');
        }
        echo 'check middleware: <br/>';
        return $next($request);
    }
}
