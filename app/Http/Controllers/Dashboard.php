<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        $menu = 'dashboard';
        return view('dashboard.index', [
            'menu' => $menu
        ]);
    }
}
