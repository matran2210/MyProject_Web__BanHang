<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminLoginMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(Auth::check()){  //nếu có đăng nhập rồi thì mới tiếp tục

            $user = Auth::user();

            if($user->level =='Admin' ){
                return $next($request);
            }
            else  return redirect()->route('login-admin');

        } //không có đăng nhập thì đưa về trang login
        else return redirect()->route('login-admin');

    }
}
