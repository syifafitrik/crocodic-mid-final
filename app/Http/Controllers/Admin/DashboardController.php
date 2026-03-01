<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $pagetitle = 'Admin Top Up - Dashboard';
        $current_page = 'dashboard';
        return view('pages.admin.dashboard', compact('pagetitle', 'current_page'));
    }

    public function data()
    {
        try {
            /* Harian */
            // penjualan hari ini
            $today = Payment::where('tanggal', '=', now()->format('Y-m-d'))->get();
            $today_all = $today->count();
            $today_pending = $today->where('status', '=', '0')->count();
            $today_success = $today->where('status', '=', '1')->count();
            $today_cancel = $today->where('status', '=', '2')->count();
            $today_income = $today->where('status', '=', '1')->sum('payment_amount');


            // penjualan kemarin
            $yesterday = Payment::where('tanggal', '=', now()->addDay(-1)->format('Y-m-d'))->get();
            $yesterday_all = $yesterday->count();
            $yesterday_pending = $yesterday->where('status', '=', '0')->count();
            $yesterday_success = $yesterday->where('status', '=', '1')->count();
            $yesterday_cancel = $yesterday->where('status', '=', '2')->count();
            $yesterday_income = $yesterday->where('status', '=', '1')->sum('payment_amount');

            /* Bulanan */
            // penjualan bulan ini
            $monthly = Payment::whereBetween('tanggal', [
                now()->format('Y-m-01'),
                now()->format('Y-m-t')
            ])->get();
            $monthly_all = $monthly->count();
            $monthly_pending = $monthly->where('status', '=', '0')->count();
            $monthly_success = $monthly->where('status', '=', '1')->count();
            $monthly_cancel = $monthly->where('status', '=', '2')->count();
            $monthly_income = $monthly->where('status', '=', '1')->sum('payment_amount');
                
            // penjualan bulan kemarin
            $last = Payment::whereBetween('tanggal', [
                now()->addMonth(-1)->format('Y-m-01'),
                now()->addMonth(-1)->format('Y-m-t')
            ])->get();
            
            $last_all = $last->count();
            $last_pending = $last->where('status', '=', '0')->count();
            $last_success = $last->where('status', '=', '1')->count();
            $last_cancel = $last->where('status', '=', '2')->count();
            $last_income = $last->where('status', '=', '1')->sum('payment_amount');

            return response()->json([
                'status'  => 'S',
                'message' => 'Berhasil mendapatkan data!',
                'data' => [
                    'today_all' => $today_all,
                    'today_pending' => $today_pending,
                    'today_success' => $today_success,
                    'today_cancel' => $today_cancel,
                    'today_income' => $today_income,

                    'yesterday_all' => $yesterday_all,
                    'yesterday_pending' => $yesterday_pending,
                    'yesterday_success' => $yesterday_success,
                    'yesterday_cancel' => $yesterday_cancel,
                    'yesterday_income' => $yesterday_income,

                    'monthly_all' => $monthly_all,
                    'monthly_pending' => $monthly_pending,
                    'monthly_success' => $monthly_success,
                    'monthly_cancel' => $monthly_cancel,
                    'monthly_income' => $monthly_income,
                    
                    'last_all' => $last_all,
                    'last_pending' => $last_pending,
                    'last_success' => $last_success,
                    'last_cancel' => $last_cancel,
                    'last_income' => $last_income,
                ]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'  => 'E',
                'message' => 'Terjadi kesalahan! Error: ' . $ex->getMessage(),
            ]);
        }
    }
}
