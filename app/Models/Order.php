<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    private $keyword;
    private $searchData;

    public function scopeSearch($query, $data = []) {
        if (!array_key_exists('filter', $data)) {
            return $query;
        } else {
            if ($data['filter'] === 'tanggal-pemesanan') {

                unset($data['keywordStatus']);
                unset($data['keyword']);

                $this->keyword = $data['keywordDate'];
                $this->searchData = $query->where('created_at', 'LIKE', '%'.$this->keyword.'%');
            } elseif ($data['filter'] === 'status-order') {

                unset($data['keyword']);
                unset($data['keywordDate']);

                $this->keyword = $data['keywordStatus'];
                $this->searchData = $query->where('status_order', $this->keyword);
            } elseif ($data['filter'] === 'nama-produk') {

                unset($data['keywordDate']);
                unset($data['keywordStatus']);

                $this->keyword = $data['keyword'];
                $this->searchData = $query->whereHas('product', function ($query) {
                    $query->where('name_product', 'LIKE','%'.$this->keyword.'%');
                });
            }
            return $this->searchData;
        }
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }

    public function buyer() {
        return $this->belongsTo(Buyer::class,'id_buyer','id_buyer');
    }

    public function seller() {
        return $this->belongsTo(Seller::class,'id_seller','id_seller');
    }
}
