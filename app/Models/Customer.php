<?php

namespace App\Models;

use App\Http\Controllers\Customer as ControllersCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'm_customer';

    protected $fillable = [
        'kode',
        'name',
        'telp',
        'is_delete'
    ];

    public function cust(){
        return $this->hasMany(ControllersCustomer::class, 'cust_id', 'id');
    }
    
}
