<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function index()
    {
        $menu = 'transaksi';
        return view('transaksi.index', [
            'menu' => $menu
        ]);
    }
}
