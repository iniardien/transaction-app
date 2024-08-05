<?php

namespace App\Http\Controllers;

use App\Models\Barang as ModelsBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Barang extends Controller
{
    public function index(Request $request) {
        $menu = 'barang';
        $query = ModelsBarang::where('is_delete', 0);
        if($search = $request->input('search')){
            $query->where('nama', 'like', '%'.$search.'%')
                ->orWhere('harga', 'like', '%'.$search.'%');
            
        }
        $barang = $query->paginate(5);
        return view('barang.index', [
            'menu' => $menu,
            'barangs' => $barang
        ]);
    }

    public function create(Request $request)
    {
        $lastbarang = ModelsBarang::latest()->first();
        $newId = $lastbarang ? $lastbarang->id + 1 : 1;
        $kode = 'BRG' . $newId;
        $harga = str_replace('.', '', $request->input('harga'));
        $barang = ModelsBarang::create([
            'kode' => $kode,
            'nama' => $request->nama,
            'harga' => $harga,
            'qty' => $request->qty
        ]);

        if ($barang) {
            return redirect()->route('barang.index')->with('success', 'Barang added successfully.');
        } else {
            return redirect()->route('barang.index')->with('error', 'Failed to add Barang.');
        }
    }

    public function edit($id, Request $request)
    {
        $decryptId = Crypt::decrypt($id);
        $barang = ModelsBarang::findOrFail($decryptId);
        $harga = str_replace('.', '', $request->input('harga'));
        $barang->update([
            'nama' => $request->nama,
            'harga' => $harga,
            'qty' => $request->qty
        ]);

        if ($barang) {
            return redirect()->route('barang.index')->with('success', 'Barang edit successfully.');
        } else {
            return redirect()->route('barang.index')->with('error', 'Failed to edit Barang.');
        }
        
    }

    public function delete($id){
        $decryptId = Crypt::decrypt($id);
        $barang = ModelsBarang::findOrFail($decryptId);
        $barang->update(['is_delete' => 1]);
        if ($barang) {
            return redirect()->route('barang.index')->with('success', 'Barang delete successfully.');
        } else {
            return redirect()->route('barang.index')->with('error', 'Failed to delete Barang.');
        }
        
    }
}
