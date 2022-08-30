<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $guard = 'sellers';

    public function product() {
        return $this->hasMany(Product::class,'id_seller');
    }

    public function account() {
        return $this->hasMany(Account::class,'id_seller','id_seller');
    }

    public function order() {
        return $this->hasMany(Order::class,'id_seller');
    }

}
