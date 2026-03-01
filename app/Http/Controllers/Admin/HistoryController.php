<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $pagetitle = 'Admin Top Up - Riwayat Transaksi';
        $current_page = 'transaksi';
        return view('pages.admin.history', compact('pagetitle', 'current_page'));
    }

    public function data()
    {
        $result = DB::select('
            SELECT
                a.id, a.customer_id, b.name customer_name, 
                a.tanggal, a.voucher_id, c.voucher_title, d.title game_title,
                a.voucher_value, a.payment_id,
                a.payment_amount, a.user_id,
                a.status, a.created_at, a.updated_at
            FROM data_payment a
            LEFT JOIN users b ON b.id = a.customer_id
            LEFT JOIN master_voucher c ON c.id = a.voucher_id
            LEFT JOIN master_game d ON d.id = c.game_id
        ');
        
        return response()->json([
            'status' => 'S',
            'message' => 'Berhasil mendapatkan data!',
            'data' => $result
        ]);
    }
}
