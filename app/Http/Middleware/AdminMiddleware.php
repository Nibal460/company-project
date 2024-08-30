<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;
use App\Events\UserDeleted;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return redirect('/admin/login');
    }
}
