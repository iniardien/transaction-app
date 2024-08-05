<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Barang extends Controller
{
    public function index(){
        $menu = 'barang';
        return view('barang.index', [
            'menu' => $menu
        ]);
    }
}
