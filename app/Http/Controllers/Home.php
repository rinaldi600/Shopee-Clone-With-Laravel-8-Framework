<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;

class Home extends Controller
{
    public function index() {
        $data = [
          'dataProduct' => Product::all(),
        ];
        return view('Shopee.Home.Home', $data);
    }

    public function banner(Request $request) {
        $path    = './banner/slide_show';
        $files = array_diff(scandir($path), array('.', '..'));
        return response()->json([
            'image' => $files
        ]);
    }

    public function detailProduct(Product $product) {
        $data = [
            'detailProduct' => $product,
            'title' => 'Jual ' . $product['name_product'],
        ];

        return view('Shopee/DetailProduct/DetailView', $data);
    }

    public function searchProduct(Request $request) {
        dd($request->input('keyword'));
    }
}
