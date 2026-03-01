<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGame;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MasterGameController extends Controller
{
    public function index()
    {
        $pagetitle = 'Admin Top Up - Master Game';
        $current_page = 'master_game';
        return view('pages.admin.master_game', compact('pagetitle', 'current_page'));
    }

    public function list()
    {
        return response()->json([
            'status'  => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data'    => MasterGame::where('is_active', '=', '1')->get(),
        ]);
    }

    public function create()
    {
        $validation = Validator::make(request()->all(), [
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'sometimes|nullable|image',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_title = request()->post('title');
        $data_slug = Str::slug(trim($data_title));
        $data_description = request()->post('description');
        $data_image = request()->file('image');

        try {
            $data = [
                'user_id' => request()->user()->id,
                'title' => trim($data_title),
                'slug' => $data_slug,
                'description' => trim($data_description),
                'is_active' => 1,
            ];

            if (! empty($data_image)) {
                $filename = "image_" . time() . rand(100, 999) . "." . $data_image->extension();
                $image = url('assets/uploads') . '/' . $filename;

                if (!Storage::exists('app/public/assets/uploads/'))
                    Storage::makeDirectory('app/public/assets/uploads/');

                $data_image->move(storage_path('app/public/assets/uploads/'), $filename);
                $data['image'] = $image;
            }

            $result = MasterGame::create($data);

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
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'sometimes|nullable|image',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('id');
        $data_title = request()->post('title');
        $data_slug = Str::slug(trim($data_title));
        $data_description = request()->post('description');
        $data_image = request()->file('image');

        try {
            // cek game ada atau tidak
            $cek = MasterGame::where('is_active', '=', 1)
                ->where('id', '=', $data_id)->first() ?? null;
            if ($cek == null)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data tidak ditemukan!',
                ]);

            $data = [
                'title' => trim($data_title),
                'slug' => $data_slug,
                'description' => trim($data_description),
                'user_id' => Auth::user()->id,

                'updated_at' => now(),
            ];

            if (!empty($data_image)) {
                $filename = "image_" . time() . rand(100, 999) . "." . $data_image->extension();
                $image = url('assets/uploads') . '/' . $filename;

                if (!Storage::exists('app/public/assets/uploads/'))
                    Storage::makeDirectory('app/public/assets/uploads/');

                $data_image->move(storage_path('app/public/assets/uploads/'), $filename);
                $data['image'] = $image;
            }

            $update = MasterGame::find($data_id)->update($data);

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

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('id');

        try {
            $data = MasterGame::where('is_active', '=', 1)
                ->where('id', '=', $data_id)->first() ?? null;
            if ($data == null) {
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data tidak ditemukan!',
                ]);
            }

            $delete = [
                'is_active' => 0,
                'updated_at' => now(),
            ];

            $data->update($delete);
            return response()->json([
                'status'  => 'S',
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
            'title.required' => 'Judul game tidak boleh kosong!',
            'title.max' => 'Judul terlalu panjang!',
            'description.required' => 'Deskripsi tidak boleh kosong!',
            'image.image' => 'File tidak bukan berupa gambar!',
        ];
    }
}
