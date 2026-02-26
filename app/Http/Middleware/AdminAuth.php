<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth extends Authenticate
{
    protected function redirectTo(Request $request)
    {
        if (Auth::user())
            return route('admin.dashboard');

        return route('admin.login');
    }
}
