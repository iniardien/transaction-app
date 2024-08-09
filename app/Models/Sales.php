<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;

class Sales extends Model
{
    use HasFactory;

    protected $table = 't_sales';

    protected $fillable = [
        'kode',
        'tgl',
        'cust_id',
        'subtotal',
        'diskon',
        'ongkir',
        'total_bayar'
    ];

    public function cust(){
        return $this->hasOne(Customer::class, 'id', 'cust_id');
    }
    public function barang_detail(){
        return $this->hasMany(SalesDetail::class, 'sales_id', 'id');
    }

}
