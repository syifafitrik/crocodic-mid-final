<?php

namespace App\Http\Controllers\User;

use App\Helpers\FlipHelper;
use App\Http\Controllers\Controller;
use App\Models\MasterGame;
use App\Models\MasterVoucher;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $pagetitle = 'Pembelian Voucher Saya';
        $current_page = 'user_payment';

        return view('pages.user.payment', compact('pagetitle', 'current_page'));
    }

    public function list()
    {
        $result = DB::select('
            SELECT
                a.id, a.customer_id, b.name customer_name, 
                a.tanggal, a.voucher_id, c.voucher_title, d.title game_title,
                a.voucher_value, a.payment_id, a.payment_amount,
                a.payment_link, a.user_id, a.status,
                a.created_at, a.updated_at
            FROM data_payment a
            LEFT JOIN users b ON b.id = a.customer_id
            LEFT JOIN master_voucher c ON c.id = a.voucher_id
            LEFT JOIN master_game d ON d.id = c.game_id
            WHERE a.customer_id = ?
            ORDER BY a.updated_at DESC
        ', [Auth::user()->id]);

        return response()->json([
            'status' => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data' => $result
        ]);
    }

    public function detail($payment)
    {
        $pagetitle = 'Detail Pembayaran Tagihan';
        $current_page = 'user_payment';

        if (empty(trim($payment)))
            return abort(404);

        try {
            $payment = Payment::where('payment_id', '=', $payment)->first() ?? null;
            if ($payment == null || $payment->customer_id != Auth::user()->id)
                return abort(404);

            $voucher = MasterVoucher::where('id', '=', $payment->voucher_id)->first() ?? null;
            $game = MasterGame::where('id', '=', $voucher->game_id)->first() ?? null;

            return view(
                'pages.user.payment-detail',
                compact(
                    'pagetitle',
                    'current_page',
                    'payment',
                    'game',
                    'voucher'
                )
            );
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }
    public function create()
    {
        $validation = Validator::make(request()->all(), [
            'game' => 'required',
            'voucher' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_game = request()->post('game');
        $data_voucher = request()->post('voucher');

        try {
            // Cek data game
            $game = MasterGame::where('is_active', '=', 1)
                ->where('id', '=', $data_game)->first() ?? null;
            if ($game == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data game tidak ditemukan!'
                ]);

            // Cek data voucher
            $voucher = MasterVoucher::find($data_voucher) ?? null;
            if ($game == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data voucher tidak ditemukan!'
                ]);

            // Masuk create payment flip
            $flip = FlipHelper::createTagihan("Top Up Game {$game->title} dengan Voucher {$voucher->voucher_title}", intval($voucher->voucher_price));
            if (empty($flip) || $flip == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Terjadi kesalahan! Gagal membuat tagihan!'
                ]);

            $payment = [
                'customer_id' => Auth::user()->id,
                'tanggal' => date('Y-m-d'),
                'voucher_id' => $voucher->id,
                'voucher_value' => $voucher->voucher_value,
                'voucher_code' => strtoupper(Str::random(10)),
                'payment_id' => $flip['link_id'],
                'payment_amount' => $voucher->voucher_price,
                'payment_link' => 'http://' . $flip['link_url'],
                'user_id' => Auth::user()->id,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $create = Payment::create($payment);
            return response()->json([
                'status' => 'S',
                'message' => 'Berhasil memesan voucher!',
                'data' => route('user.payment.detail', [$flip['link_id']])
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }

    public function verification()
    {
        $validation = Validator::make(request()->all(), [
            'payment' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('payment');

        try {
            $data = Payment::where('payment_id', '=', $data_id)->first() ?? null;
            if ($data == null || $data->customer_id != Auth::user()->id)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data tidak ditemukan!'
                ]);

            $result = FlipHelper::detailPembayaran($data_id) ?? null;
            if (empty($result) || $result == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Terjadi kesalahan! Data payment tidak ditemukan!'
                ]);

            if (empty($result['data']))
                return response()->json([
                    'status' => 'E',
                    'message' => 'Pembayaran belum dilakukan!'
                ]);
                
            if ($result['data'][0]['status'] != 'SUCCESSFUL')
                return response()->json([
                    'status' => 'E',
                    'message' => 'Pembayaran sudah selesai atau kadaluarsa!'
                ]);

            $verified = Payment::where('payment_id', '=', $data_id)->update([
                'status' => '1',
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => 'S',
                'message' => 'Data berhasil diverifikasi!',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }

    public function cancel()
    {
        $validation = Validator::make(request()->all(), [
            'payment' => 'required',
        ], $this->validation_rules());

        if ($validation->fails()) {
            return response()->json([
                'status'  => 'E',
                'message' => $validation->errors()->first(),
            ]);
        }

        $data_id = request()->post('payment');

        try {
            $data = Payment::where('payment_id', '=', $data_id) ?? null;
            if ($data == null)
                return response()->json([
                    'status' => 'E',
                    'message' => 'Data tidak ditemukan!'
                ]);

            $canceled = Payment::where('payment_id', '=', $data_id)->update([
                'status' => '2',
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => 'S',
                'message' => 'Data berhasil dibatalkan!',
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
            'payment.required' => 'Data payment tidak ditemukan!',
            'game.required' => 'Data game tidak ditemukan!',
            'voucher.required' => 'Data voucher tidak ditemukan!',
        ];
    }
}
