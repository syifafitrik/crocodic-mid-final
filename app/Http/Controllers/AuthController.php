<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index_admin()
    {
        if (Auth::user())
            return redirect(route('admin.dashboard.index'));

        return view('pages.admin.login');
    }

    public function index_user()
    {
        if (Auth::user())
            return redirect(route('home'));

        return view('pages.user.login');
    }

    public function register(){
        if (Auth::user())
            return redirect(route('home'));

        return view('pages.user.register');
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

    public function user_register(){
        $validation = Validator::make(request()->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_name = request()->post('name');
        $data_username = request()->post('username');
        $data_email = request()->post('email');
        $data_password = request()->post('password');

        try {
            // cek duplikasi username
            $dup = User::where('username', '=', $data_username)->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Username sudah dipakai!',
                ]);

            // cek duplikasi email
            $dup = User::where('email', '=', $data_email)->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Alamat e-mail sudah dipakai!',
                ]);

            $data = [
                'name' => ucwords(strtolower(trim($data_name))),
                'username' => strtolower(trim($data_username)),
                'email' => strtolower(trim($data_email)),
                'password' => bcrypt(trim($data_password)),
                'role' => "USER",

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $insert = User::create($data);
            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil registrasi user! Silakan login menggunakan akun baru Anda!',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        if (Auth::user())
            Auth::logout();

        return redirect(route('home'));
    }

    private function validation_rules()
    {
        return [
            'name.required' => 'Nama lengkap tidak boleh kosong!',
            'name.string' => 'Nama lengkap tidak valid!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.string' => 'Username tidak valid!',
            'email.required' => 'Alamat e-mail tidak boleh kosong!',
            'email.email' => 'Alamat e-mail tidak valid!',
            'password.required' => 'Password tidak boleh kosong!',
        ];
    }
}
