<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function scopeSearch($query, $keyword = array()) {
        $getData = null;

        if ($keyword['filter'] === 'all') {
            $getData = $query->where('name_product', 'LIKE', '%' . $keyword['keyword'] . '%')
                ->orWhere('description', 'LIKE', '%' . $keyword['keyword'] . '%')
                ->orWhere('price', 'LIKE', '%' . $keyword['keyword'] . '%')
                ->orWhere('quantity', 'LIKE', '%' . $keyword['keyword'] . '%');
        } else if ($keyword['filter'] === 'nama') {
            $getData = $query->where('name_product', 'LIKE', '%' . $keyword['keyword'] . '%');
        } else if ($keyword['filter'] === 'jumlah') {
            $getData = $query->where('quantity', '=', $keyword['keyword']);
        } else {
            $getData = $query->where('price', '=', $keyword['keyword']);
        }

        return $getData;
    }

    public function order() {
        return $this->hasMany(Order::class,'id_product');
    }

    public function seller() {
        return $this->belongsTo(Seller::class,'id_seller','id_seller');
    }

    public function getRouteKeyName()
    {
        return 'id_product';
    }
}
