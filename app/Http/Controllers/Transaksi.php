<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;



class Transaksi extends Controller
{
    public function index(Request $request)
    {
        $menu = 'transaksi';

        $query = Sales::query();
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', '%' . $search . '%')
                    ->orWhere('total_bayar', 'like', '%' . $search . '%')
                    ->orWhere('tgl', 'like', '%' . $search . '%');
            });
        }
        $transaksi = $query->paginate(5);
        $transaksi->appends(['search' => $search]);
        $totalPricePerPage = $transaksi->sum('total_bayar');

        return view('transaksi.index', [
            'menu' => $menu,
            'transaksi' => $transaksi,
            'grand_total' => $totalPricePerPage

        ]);
    }

    public function create()
    {
        $menu = 'transaksi';
        $customers = Customer::where('is_delete', 0)->get();
        $barangs = Barang::where('is_delete', 0)->get();
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
            'customers' => $customers,
            'barangs' => $barangs
        ]);
    }

    public function store(Request $request)
    {
        $subtotal = str_replace('.', '', $request->input('sub_total'));
        $subtotal = str_replace(',', '.', $subtotal);
        $diskon = str_replace('.', '', $request->input('diskon'));
        $diskon = str_replace(',', '.', $diskon);
        $ongkir = str_replace('.', '', $request->input('ongkir'));
        $ongkir = str_replace(',', '.', $ongkir);
        $total_bayar = str_replace('.', '', $request->input('total_bayar'));
        $total_bayar = str_replace(',', '.', $total_bayar);
        $sales = Sales::create([
            'kode' => $request->notransaksi,
            'tgl' => $request->tgl,
            'cust_id' => $request->id_customer,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'ongkir' => $ongkir,
            'total_bayar' => $total_bayar
        ]);

        if ($sales) {
            $barang_ids = $request->input('barang_id');
            if ($barang_ids != null) {
                for ($i = 0; $i < count($barang_ids); $i++) {
                    $diskonnilai = str_replace('.', '', $request->input('diskon_nilai')[$i]);
                    $diskonnilai = str_replace(',', '.', $diskonnilai);
                    $harga_diskon = number_format($request->input('harga_diskon')[$i], 0, ',', '');
                    $total_harga = str_replace('.', '', $request->input('total_harga')[$i]);
                    $total_harga = str_replace(',', '.', $total_harga);

                    SalesDetail::create([
                        'sales_id' => $sales->id,
                        'barang_id' => $barang_ids[$i],
                        'harga_bandrol' => $request->input('harga_bandrol')[$i],
                        'qty' => $request->input('qty')[$i],
                        'diskon_pct' => $request->input('diskon_pct')[$i],
                        'diskon_nilai' => $diskonnilai,
                        'harga_diskon' => $harga_diskon,
                        'total' => $total_harga
                    ]);

                    $qty = $request->input('qty')[$i];
                    $barangs = Barang::find($barang_ids[$i]);
                    $barangs->update([
                        'qty' => $barangs->qty - $qty
                    ]);
                }
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi added successfully.');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Failed to add Transaksi.');
        }
    }

    public function detail($id)
    {
        $decryptId = Crypt::decrypt($id);
        $menu = 'transaksi';
        $transaksi = Sales::findOrFail($decryptId);
        $salesdetail = SalesDetail::where('sales_id', $decryptId)->get();
        return view('transaksi.detail', [
            'menu' => $menu,
            'transaksi' => $transaksi,
            'salesdetail' => $salesdetail
        ]);
    }
    public function edit($id)
    {
        $customers = Customer::where('is_delete', 0)->get();
        $barangs = Barang::where('is_delete', 0)->get();
        $decryptId = Crypt::decrypt($id);
        $menu = 'transaksi';
        $transaksi = Sales::findOrFail($decryptId);
        $salesdetail = SalesDetail::where('sales_id', $decryptId)->get();
        $date = Carbon::parse($transaksi->tgl)->format('Y-m-d');
        return view('transaksi.edit', [
            'menu' => $menu,
            'transaksi' => $transaksi,
            'salesdetail' => $salesdetail,
            'customers' => $customers,
            'barangs' => $barangs,
            'date' => $date
        ]);
    }

    public function update($id, Request $request)
    {
        $decryptId = Crypt::decrypt($id);
        $sales = Sales::find($decryptId);
        


        $subtotal = str_replace('.', '', $request->input('sub_total'));
        $subtotal = str_replace(',', '.', $subtotal);
        $diskon = str_replace('.', '', $request->input('diskon'));
        $diskon = str_replace(',', '.', $diskon);
        $ongkir = str_replace('.', '', $request->input('ongkir'));
        $ongkir = str_replace(',', '.', $ongkir);
        $total_bayar = str_replace('.', '', $request->input('total_bayar'));
        $total_bayar = str_replace(',', '.', $total_bayar);
        $sales->update([
            'kode' => $request->notransaksi,
            'tgl' => $request->tgl,
            'cust_id' => $request->id_customer,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'ongkir' => $ongkir,
            'total_bayar' => $total_bayar
        ]);

        if ($sales) {
            $sales_detail = SalesDetail::where('sales_id', $decryptId)->delete();
            $barang_ids = $request->input('barang_id');
            if ($barang_ids != null) {
                for ($i = 0; $i < count($barang_ids); $i++) {
                    $diskonnilai = str_replace('.', '', $request->input('diskon_nilai')[$i]);
                    $diskonnilai = str_replace(',', '.', $diskonnilai);
                    $harga_diskon = number_format($request->input('harga_diskon')[$i], 0, ',', '');
                    $total_harga = str_replace('.', '', $request->input('total_harga')[$i]);
                    $total_harga = str_replace(',', '.', $total_harga);

                    SalesDetail::create([
                        'sales_id' => $sales->id,
                        'barang_id' => $barang_ids[$i],
                        'harga_bandrol' => $request->input('harga_bandrol')[$i],
                        'qty' => $request->input('qty')[$i],
                        'diskon_pct' => $request->input('diskon_pct')[$i],
                        'diskon_nilai' => $diskonnilai,
                        'harga_diskon' => $harga_diskon,
                        'total' => $total_harga
                    ]);
                }
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi Edit successfully.');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Failed to Edit Transaksi.');
        }
    }
    public function delete($id)
    {
        $decryptId = Crypt::decrypt($id);
        $transaksi = Sales::findOrFail($decryptId);
        $detailsales = SalesDetail::where('sales_id', $decryptId)->delete();
        $transaksi->delete();
        if ($transaksi) {
            return redirect()->route('transaksi.index')->with('success', 'Transaksi delete successfully.');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Failed to delete Transaksi.');
        }
    }
}
