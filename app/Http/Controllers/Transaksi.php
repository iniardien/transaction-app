<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function index()
    {
        $menu = 'transaksi';
     
        $query = Sales::query();
        $transaksi = $query->paginate(5);

        return view('transaksi.index', [
            'menu' => $menu,
            'transaksi' => $transaksi,
           
        ]);
    }

    public function create()
    {
        $menu = 'transaksi';
        $customers = Customer::where('is_delete', 0)->get();
        // Mendapatkan tanggal saat ini
        $currentDate = Carbon::now();

        // Mendapatkan bulan dan tahun saat ini
        $month = str_pad($currentDate->month, 2, '0', STR_PAD_LEFT); // Menambahkan leading zero jika perlu
        $year = $currentDate->year;

        // Menghitung jumlah transaksi pada bulan dan tahun saat ini
        $count = Sales::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $countFormatted = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        $notransaksi = $year . $month . '-' . $countFormatted;
        return view('transaksi.create', [
            'menu' => $menu,
            'notransaksi' => $notransaksi,
            'customers' => $customers
        ]);
    }
}
