<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect('dashboard');
        }

        return view('pages.login');
    }

    public function admin_login()
    {
        $credential = [
            'username' => request()->post('username'),
            'password' => request()->post('password'),
        ];

        $validation = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        if (Auth::user()) {
            return response()->json([
                'status'   => 'E',
                'messsage' => 'User sudah login!',
            ]);
        }

        if (Auth::attempt($credential)) {
            if (Auth::user()->role != 'ADMIN') {
                Auth::logout();

                return response()->json([
                    'status'  => 'E',
                    'message' => 'Username atau password salah, silakan periksa kembali!',
                ]);
            }

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil login!',
            ]);
        }

        return response()->json([
            'status'  => 'E',
            'message' => 'Username atau password salah, silakan periksa kembali!',
        ]);
    }

    public function user_login()
    {
        $credential = [
            'username' => request()->post('username'),
            'password' => request()->post('password'),
        ];

        $validation = Validator::make(request()->all(), [
            'username'    => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        if (Auth::user()) {
            return response()->json([
                'status'   => 'E',
                'messsage' => 'User sudah login!',
            ]);
        }

        if (Auth::attempt($credential)) {
            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil login!',
            ]);
        }

        return response()->json([
            'status'  => 'E',
            'message' => 'Username atau password salah, silakan periksa kembali!',
        ]);
    }

    public function logout()
    {
        $link = null;
        if (Auth::user()->role == "ADMIN")
            $link = route('admin.login');
        else $link = route('login');

        if (Auth::user())
            Auth::logout();

        return $link;
    }
}
