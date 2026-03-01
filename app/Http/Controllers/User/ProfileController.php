<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $pagetitle = 'Top Up - Profile Saya';
        $current_page = 'user_profile';
        $user = Auth::user();

        return view ('pages.user.profile', compact('pagetitle', 'current_page', 'user'));
    }

    public function update(){
        $validation = Validator::make(request()->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_name = request()->post('name');
        $data_email = request()->post('email');
        $data_password = request()->post('password') ?? null;

        try {
            // cek duplikasi email
            $dup = User::where('email', '=', $data_email)->whereNot('id', '=', Auth::user()->id)->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Alamat e-mail sudah dipakai!',
                ]);

            $data = [
                'name' => ucwords(strtolower(trim($data_name))),
                'email' => strtolower(trim($data_email)),

                'updated_at' => now(),
            ];

            if (!empty($data_password))
                $data['password'] = bcrypt(trim($data_password));

            $update = User::find(Auth::user()->id)->update($data);

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil mengubah data!',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }

    private function validation_rules()
    {
        return [
            'name.required' => 'Nama lengkap tidak boleh kosong!',
            'name.string' => 'Nama lengkap tidak valid!',
            'email.required' => 'Alamat e-mail tidak boleh kosong!',
            'email.email' => 'Alamat e-mail tidak valid!',
            'password.required' => 'Password tidak boleh kosong!',
        ];
    }
}
