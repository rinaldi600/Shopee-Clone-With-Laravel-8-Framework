<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function seller() {
        return $this->belongsTo(Seller::class,'id_seller','id_seller');
    }
}
