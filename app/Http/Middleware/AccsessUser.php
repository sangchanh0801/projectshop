<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AccsessUser
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
        if (Gate::allows('user')== false) {
            return redirect()->route('logincheckout');
        }
        if (Session::get('cart')== false) {
            return redirect()->back()->with('mess', 'Không có sản phẩm trong giỏ hàng, không được thanh toán');
        }
        if (Gate::allows('user') && Session::get('cart') == true) {
            return $next($request);
        }

    }
}
