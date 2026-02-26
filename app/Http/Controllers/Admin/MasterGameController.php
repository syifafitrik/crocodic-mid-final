<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGame;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MasterGameController extends Controller
{
    public function index(){
        $current_page = 'master_game';
        // return view(, compact('current_page'));
    }

    public function list()
    {
        return response()->json([
            'status'  => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data'    => MasterGame::all(),
        ]);
    }

    public function create()
    {
        $validation = Validator::make(request()->all(), [
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'image',
        ], [
            'title.required' => 'Title tidak boleh kosong!',
            'title.max' => 'Title terlalu panjang!',
            'description.required' => 'Deskripsi tidak boleh kosong!',
            'image.image' => 'File bukan berupa gambar!',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }    

        $data_title = request()->post('title');
        $data_slug = Str::slug($data_title);
        $data_description = request()->post('description');
        $data_image = request()->file('image');
        // if (! empty($data_image) && substr($data_image->getMimeType(), 0, 5) != 'image') {
        //     return response()->json([
        //         'status'  => 'E',
        //         'message' => 'File bukan berupa gambar!',
        //     ]);
        // }

        try {
            $insert = [
                'user_id'     => request()->user()->id,
                'title'       => $data_title,
                'slug'        => $data_slug,
                'description' => $data_description,
            ];

            if (! empty($data_image)) {
                $schema   = request()->isSecure() ? "https://" : "http://";
                $filename = "image_" . time() . rand(100, 999) . "." . $data_image->extension();
                $image    = url('assets/uploads') . '/' . $filename;

                if (! Storage::exists('app/public/assets/uploads/')) {
                    Storage::makeDirectory('app/public/assets/uploads/');
                }

                $data_image->move(storage_path('app/public/assets/uploads/'), $filename);

                $insert['image'] = $image;
            }

            $result = MasterGame::create($insert);

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil membuat data!',
                'data'    => $result,
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
            'image' => 'image',
        ], [
            'id.required' => 'Data tidak ditemukan!',
            'title.required' => 'Title tidak boleh kosong!',
            'title.max' => 'Title terlalu panjang!',
            'description.required' => 'Deskripsi tidak boleh kosong!',
            'image.image' => 'File bukan berupa gambar!',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }    

        $data_id = request()->post('id');
        $data_title = request()->post('title');
        $data_slug = Str::slug($data_title);
        $data_description = request()->post('description');
        $data_image = request()->file('image');
        // if (! empty($data_image) && substr($data_image->getMimeType(), 0, 5) != 'image') {
        //     return response()->json([
        //         'status'  => 'E',
        //         'message' => 'File bukan berupa gambar!',
        //     ]);
        // }

        try {
            $blogs = MasterGame::find($data_id) ?? null;
            if ($blogs == null) {
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data tidak ditemukan!',
                ]);
            }

            $update = [
                'user_id'     => request()->user()->id,
                'title'       => $data_title,
                'slug'        => $data_slug,
                'description' => $data_description,
            ];

            if (! empty($data_image)) {
                $schema   = request()->isSecure() ? "https://" : "http://";
                $filename = "image_" . time() . rand(100, 999) . "." . $data_image->extension();
                $image    = $schema . url('assets/uploads') . '/' . $filename;

                if (! Storage::exists('app/public/assets/uploads/')) {
                    Storage::makeDirectory('app/public/assets/uploads/');
                }

                $data_image->move(storage_path('app/public/assets/uploads/'), $filename);

                $update['image'] = $image;
            }

            $blogs->update($update);

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil mengubah data!',
                'data'    => MasterGame::find($data_id),
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
        ], [
            'id.required' => 'Data tidak ditemukan!',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $id = request()->post('id');

        $data = MasterGame::find($id) ?? null;
        if ($data == null) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Data tidak ditemukan!',
            ]);
        }

        $data->delete();
        return response()->json([
            'status'  => 'S',
            'message' => 'Data berhasil dihapus!',
            'data'    => MasterGame::all(),
        ]);
    }
}
