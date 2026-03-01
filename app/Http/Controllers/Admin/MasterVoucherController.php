<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGame;
use App\Models\MasterVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MasterVoucherController extends Controller
{
    public function index()
    {
        $pagetitle = 'Admin Top Up - Master Voucher';
        $current_page = 'master_voucher';
        $master_game = MasterGame::all();
        return view('pages.admin.master_voucher', compact('pagetitle', 'current_page', 'master_game'));
    }
    public function list()
    {
        $result = MasterVoucher::join('master_game as a', 'a.id', '=', 'master_voucher.game_id')
            ->select('master_voucher.*', 'a.title as game_title')
            ->where('master_voucher.is_active', '=', '1')
            ->get();

        return response()->json([
            'status' => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data' => $result
        ]);
    }

    public function create()
    {
        $validation = Validator::make(request()->all(), [
            'game_id' => 'required',
            'title' => 'required',
            'value' => 'required',
            'price' => 'required',
            'is_hot' => 'min:0|max:1',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_game_id = request()->post('game_id');
        $data_title = request()->post('title');
        $data_value = request()->post('value');
        $data_price = request()->post('price');
        $data_is_hot = request()->post('is_hot');

        try {
            // cek game
            $game = MasterGame::where('is_active', '=', 1)
                ->where('id', '=', $data_game_id)->first() ?? null;
            if ($game == null)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data game tidak ditemukan!',
                ]);

            // cek duplikasi value
            $dup = MasterVoucher::where('game_id', '=', $data_game_id)
                ->where('voucher_value', '=', $data_value)
                ->where('voucher_price', '=', $data_price)
                ->where('is_active', '=', '1')
                ->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data voucher dengan harga dan value tersebut sudah ada!',
                ]);

            $data = [
                'game_id' => $data_game_id,
                'voucher_title' => $data_title,
                'voucher_value' => $data_value,
                'voucher_price' => $data_price,
                'user_id' => Auth::user()->id,
                'is_hot' => intval($data_is_hot),
                'is_active' => '1',

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $insert = MasterVoucher::create($data);

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
            'game_id' => 'required',
            'title' => 'required',
            'value' => 'required',
            'price' => 'required',
            'is_hot' => 'min:0|max:1',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('id');
        $data_game_id = request()->post('game_id');
        $data_title = request()->post('title');
        $data_value = request()->post('value');
        $data_price = request()->post('price');
        $data_is_hot = request()->post('is_hot');

        try {
            // cek voucher
            $cek = MasterVoucher::where('id', '=', $data_id)->first() ?? null;
            if ($cek == null)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data tidak ditemukan!',
                ]);

            // cek game
            $game = MasterGame::where('id', '=', $data_game_id)->first();
            if ($game == null)
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data game tidak ditemukan!',
                ]);

            // cek duplikasi value
            $dup = MasterVoucher::where('game_id', '=', $data_game_id)
                ->where('voucher_value', '=', $data_value)
                ->where('voucher_price', '=', $data_price)
                ->where('is_active', '=', '1')
                ->whereNot('id', '=', $data_id)
                ->get();
            if ($dup->isNotEmpty())
                return response()->json([
                    'status'  => 'E',
                    'message' => 'Data voucher dengan harga dan value tersebut sudah ada!',
                ]);

            $data = [
                'game_id' => $data_game_id,
                'voucher_title' => $data_title,
                'voucher_value' => $data_value,
                'voucher_price' => $data_price,
                'user_id' => Auth::user()->id,
                'is_hot' => intval($data_is_hot),

                'updated_at' => now(),
            ];

            $update = MasterVoucher::find($data_id)->update($data);

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
            $data = MasterVoucher::where('is_active', '=', 1)->where('id', '=', $data_id)->first() ?? null;
            if ($data == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data tidak ditemukan!'
                ]);

            $data->update([
                'is_active' => '0',
                'updated_at' => now(),
            ]);
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
            'game_id.required' => 'Data game tidak ditemukan!',
            'title.required' => 'Title tidak boleh kosong!',
            'value.required' => 'Isi voucher tidak boleh kosong!',
            'value.min' => 'Isi voucher tidak valid!',
            'price.required' => 'Harga tidak boleh kosong!',
            'price.min' => 'Harga tidak valid!',
            'is_hot.min' => 'Status trending tidak valid!',
            'is_hot.max' => 'Status trending tidak valid!',
        ];
    }
}
