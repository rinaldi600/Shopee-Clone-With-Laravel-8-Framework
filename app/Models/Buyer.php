<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order() {
        return $this->hasMany(Order::class,'id_buyer');
    }
}
