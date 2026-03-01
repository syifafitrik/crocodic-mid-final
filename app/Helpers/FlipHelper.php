<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class FlipHelper
{
    const API_KEY = 'JDJ5JDEzJGRhTnUudnpuNW5yMjlLSnRSVkVsL096bDMudy5Zb0xjVzNjYXFPaDdWTWc3SXM1SlRVZWU2';

    /**
     * Lihat list all tagihan
     *
     * @return json
     **/
    public static function listTagihan()
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->get('https://bigflip.id/big_sandbox_api/v2/pwf/bill')
            ->json();

        return $result;
    }

    /**
     * Lihat list all tagihan
     *
     * @param int $id_tagihan
     * @return json
     **/
    public static function detailTagihan(int $id_tagihan)
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->get("https://bigflip.id/big_sandbox_api/v2/pwf/{$id_tagihan}/bill")
            ->json();

        return $result;
    }

    /**
     * Update tagihan
     *
     * @param string $title
     * @param int $amount
     * @return json
     **/
    public static function createTagihan(string $title, int $amount)
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->asForm()
            ->post('https://bigflip.id/big_sandbox_api/v2/pwf/bill', [
                'title' => $title,
                'type' => 'SINGLE',
                'amount' => $amount,
                'expired_date' => now()->addHour(2)->format('Y-m-d H:i'),
                'is_address_required' => 0,
                'is_phone_number_required' => 0,
                'step' => 1
            ])->json();

        return $result;
    }

    /**
     * Update tagihan
     *
     * @param int $id_tagihan
     * @param string $title
     * @param int $amount
     * @param string $status ACTIVE / INACTIVE
     * @return json
     **/
    public static function updateTagihan(int $id_tagihan, string $title, int $amount, string $status = 'ACTIVE')
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->asForm()
            ->put("https://bigflip.id/big_sandbox_api/v2/pwf/{$id_tagihan}/bill", [
                'title' => $title,
                'type' => 'SINGLE',
                'amount' => $amount,
                'expired_date' => now()->addHour(2)->format('Y-m-d H:i'),
                'is_address_required' => 0,
                'is_phone_number_required' => 0,
                'status' => $status,
            ])->json();

        return $result;
    }

    /**
     * Lihat list all pembayaran
     *
     * @return json
     **/
    public static function listPembayaran()
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->get('https://bigflip.id/big_sandbox_api/v2/pwf/payment')
            ->json();

        return $result;
    }
    
    /**
     * Lihat list all pembayaran
     *
     * @return json
     **/
    public static function detailPembayaran(int $id_pembayaran)
    {
        $result = Http::withBasicAuth(self::API_KEY, '')
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->get("https://bigflip.id/big_sandbox_api/v2/pwf/{$id_pembayaran}/payment")
            ->json();

        return $result;
    }
}
