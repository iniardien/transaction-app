<?php

namespace App\Http\Controllers;

use App\Models\Customer as CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Customer extends Controller
{
    public function index(Request $request)
    {
        $menu = 'customer';
        $query = CustomerModel::where('is_delete', 0);
        if($search = $request->input('search')){
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('telp', 'like', '%'.$search.'%');
            
        }
        $customer = $query->paginate(5);
        return view('customer.index', [
            'menu' => $menu,
            'customers' => $customer
        ]);
    }

    public function create(Request $request)
    {
        $lastcustomer = CustomerModel::latest()->first();
        $newId = $lastcustomer ? $lastcustomer->id + 1 : 1;
        $kode = 'CUS' . $newId;

        $customer = CustomerModel::create([
            'kode' => $kode,
            'name' => $request->nama,
            'telp' => $request->no_telp
        ]);

        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Customer added successfully.');
        } else {
            return redirect()->route('customer.index')->with('error', 'Failed to add customer.');
        }
    }

    public function edit($id, Request $request)
    {
        $decryptId = Crypt::decrypt($id);
        $customer = CustomerModel::findOrFail($decryptId);
        $customer->update([
            'name' => $request->nama,
            'telp' => $request->no_telp
        ]);

        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Customer edit successfully.');
        } else {
            return redirect()->route('customer.index')->with('error', 'Failed to edit customer.');
        }
        
    }

    public function delete($id){
        $decryptId = Crypt::decrypt($id);
        $customer = CustomerModel::findOrFail($decryptId);
        $customer->update(['is_delete' => 1]);
        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Customer delete successfully.');
        } else {
            return redirect()->route('customer.index')->with('error', 'Failed to delete customer.');
        }
        
    }
}
