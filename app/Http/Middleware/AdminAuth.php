<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth extends Authenticate
{
    protected function redirectTo(Request $request)
    {
        if (Auth::user() && Auth::user()->role == 'ADMIN')
            return route('admin.dashboard.index');
        else if (Auth::user())
            return route('dashboard');

        return route('admin.login');
    }
}
