<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\Clock\now;

class MasterUserController extends Controller
{
    public function index()
    {
        $pagetitle = 'Admin Top Up - Master User';
        $current_page = 'master_user';
        return view('pages.admin.master_user', compact('pagetitle', 'current_page'));
    }

    public function list()
    {
        return response()->json([
            'status' => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data' => User::all()
        ]);
    }

    public function create()
    {
        $validation = Validator::make(request()->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
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
        $data_role = request()->post('role');

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
                'role' => strtoupper(trim($data_role)),

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $insert = User::create($data);

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil menambah data!',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }

    public function update()
    {
        $validation = Validator::make(request()->all(), [
            'id' => 'required',
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'role' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('id');
        $data_name = request()->post('name');
        $data_username = request()->post('username');
        $data_email = request()->post('email');
        $data_password = request()->post('password') ?? null;
        $data_role = request()->post('role');

        try {
            // cek user ada atau tidak
            $cek = User::find($data_id) ?? null;
            if ($cek == null)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data tidak ditemukan!',
                ]);

            // cek duplikasi username
            $dup = User::where('username', '=', $data_username)->whereNot('id', '=', $data_id)->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Username sudah dipakai!',
                ]);

            // cek duplikasi email
            $dup = User::where('email', '=', $data_email)->whereNot('id', '=', $data_id)->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Alamat e-mail sudah dipakai!',
                ]);

            $data = [
                'name' => ucwords(strtolower(trim($data_name))),
                'username' => strtolower(trim($data_username)),
                'email' => strtolower(trim($data_email)),
                'role' => strtoupper(trim($data_role)),

                'updated_at' => now(),
            ];

            if (!empty($data_password))
                $data['password'] = bcrypt(trim($data_password));

            $update = User::find($data_id)->update($data);

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

    public function delete()
    {
        $validation = Validator::make(request()->all(), [
            'id' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('id');

        try {
            // tidak boleh hapus user yang sedang aktif (dipakai)
            if ($data_id == Auth::user()->id)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Tidak bisa menghapus user ini!',
                ]);

            $data = User::find($data_id) ?? null;
            if ($data == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data tidak ditemukan!'
                ]);

            $data->delete();
            return response()->json([
                'status' => 'S',
                'message' => 'Data berhasil dihapus!',
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
            'id.required' => 'Data tidak ditemukan!',
            'name.required' => 'Nama lengkap tidak boleh kosong!',
            'name.string' => 'Nama lengkap tidak valid!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.string' => 'Username tidak valid!',
            'email.required' => 'Alamat e-mail tidak boleh kosong!',
            'email.email' => 'Alamat e-mail tidak valid!',
            'password.required' => 'Password tidak boleh kosong!',
            'role.required' => 'Role tidak boleh kosong!',
        ];
    }
}
