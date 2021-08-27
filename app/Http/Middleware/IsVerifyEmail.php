<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserVerify;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->email_verified_at == null) {
            Auth::logout();
            return redirect()->route('logincheckout')
                    ->with('message', 'Bạn cần xác nhận tài khoản của mình. Chúng tôi đã gửi cho bạn một mã kích hoạt, vui lòng kiểm tra email của bạn.');
          }
        return $next($request);
    }
}
