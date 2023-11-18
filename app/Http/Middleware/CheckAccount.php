<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
class CheckAccount
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) { //nếu đã đăng nhập
            // Người dùng đã đăng nhập
            $getUser = Users::where('username', Auth::guard('web')->user()->username)->first();
            if (!$getUser) {
                session_start();
                session_destroy();
                return redirect(route('home'));
            }
            if ($getUser->banned != 0) {
                Auth::guard('web')->logout(); // Đăng xuất người dùng
                return redirect(route('login'))->withErrorMessage('Tài khoản của bạn đã bị khóa. Vui lòng liên hệ với admin để biết thêm chi tiết.');
            }
            $my_username = True;
            $my_level = $getUser->role;
        } else {
            // Người dùng chưa đăng nhập
            return redirect(route('login'))->withErrorMessage('Bạn cần đăng nhập để truy cập vào tài nguyên này');
        }
        return $next($request);
    }
}

