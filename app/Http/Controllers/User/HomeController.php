<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MasterGame;
use App\Models\MasterVoucher;

class HomeController extends Controller
{
    public function index()
    {
        $current_page = 'home';
        $game_list = MasterGame::where('is_active', '=', 1)->get();

        return view('pages.user.home', compact('current_page', 'game_list'));
    }

    public function detail($data_id, $data_slug)
    {
        $pagetitle = 'Detail Game ';
        $current_page = 'detail';

        $game = MasterGame::where('is_active', '=', 1)
            ->where('id', '=', $data_id)->first() ?? null;
        if ($game == null || $data_slug != $game->slug)
            return abort(404);

        $pagetitle .= $game->title;
        $list_voucher = MasterVoucher::where('is_active', '=', '1')
            ->where('game_id', '=', $game->id)->get();

        return view('pages.user.detail', compact('pagetitle', 'current_page', 'game', 'list_voucher'));
    }
}
