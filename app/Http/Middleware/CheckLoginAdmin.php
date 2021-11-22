<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
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
        $routeName = $request->route()->getName();
        if (in_array($routeName, ['admin.login', 'admin.doLogin'])) {
            if (auth('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
        }else{
            if (!auth('admin')->check()) {
                return redirect()->route('admin.login');
            }
        }
        return $next($request);
    }
}
