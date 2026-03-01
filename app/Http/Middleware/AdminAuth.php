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
            return redirect(route('admin.dashboard.index'));
        else if (Auth::user())
            return redirect(route('home'));

        return redirect(route('admin.login'));
    }
}
