<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Xendit\Xendit;
use Illuminate\Support\Facades\Storage;
use App\FunctionShipping\Cost;

class Buyer extends Controller
{
    public function index() {
        $data = [
            'dataOrder' => Order::with(['product', 'buyer', 'seller'])->where('orders.id_buyer', auth()->guard('buyers')->user()['id_buyer'])->get()
        ];

        return view('Shopee/Cart/CartView', $data);
    }

    public function checkoutBuy(Request $request) {
        $idProduk = $request->input('idProduk');
        $idBuyer = auth()->guard('buyers')->user()['id_buyer'];
        $idSeller = Product::with('seller')->where('id_product', $idProduk)->first()->seller['id_seller'];
        $quantityProduct = $request->input('quantityProduct');
        $priceOrder = (int) Product::where('id_product', $idProduk)->first()['price'];
        $idOrder = 'Order - ' . uniqid();

        Order::create([
            'id_order' => $idOrder,
            'id_product' => $idProduk,
            'id_buyer' => $idBuyer,
            'id_seller' => $idSeller,
            'status_order' => 'pending',
            'total_order' => $quantityProduct,
            'price_order' => (int) $quantityProduct * $priceOrder
        ]);

        return redirect()->to('/payment/'. Crypt::encryptString($idOrder));
    }

    public function cartProduct(Request $request) {
        $idProduct = $request->input('idProduct');
        $idBuyer = $request->input('idBuyer');
        $idSeller = $request->input('idSeller');
        $quantity = $request->input('quantity');

        $productModel = Product::where('id_product', $idProduct)->first();

        $order = new Order();
        $insertData = $order::create([
            'id_order' => 'Order - ' . uniqid(),
            'id_product' => $idProduct,
            'id_buyer' => $idBuyer,
            'id_seller' => $idSeller,
            'status_order' =>  $request->input('statusOrder'),
            'total_order' => $quantity,
            'price_order' => (int) ($quantity * $productModel['price']),
        ]);

        return response()->json([
           'success' => 'Berhasil Ditambahkan'
        ]);
    }

    public function buyProduct(Request $request) {
        Xendit::setApiKey("xnd_development_LVn0PllMk7M6O9wIrFfJ0OHvzm9egzsqq7ptQXF4pB7vub3ap0c3TEb170lfq2");

        $params = [
            "external_id" => "demo_147580196270",
            "payer_email" => "sample_email@xendit.co",
            "description" => "Trip to Bali",
            "amount" => 32000,
        ];

        $valueItem = Order::with('product')->where('id_order', $request->input('idOrder'))->first()['product']['price'];

        Order::where('id_order', $request->input('idOrder'))->update([
            'total_order' => $request->input('quantityProduct'),
            'price_order' => (int)  $request->input('quantityProduct') * $valueItem
        ]);

        return response()->json([
            'idOrder' => Crypt::encryptString($request->input('idOrder'))
        ]);
    }

    public function deleteProduct(Request $request) {
        $deleteOrder = Order::where('id_order', $request->input('idOrder'));
        $proofPayment = $deleteOrder->first()['proof_payment'];
        $proofPayment !== 'Belum ada bukti pembayaran' ?
            Storage::disk('public')->delete($proofPayment) && $deleteOrder->delete() : $deleteOrder->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }

    public function changeImageProof(Request $request) {
        $validator = Validator::make($request->all(), [
            'changeProof' => 'required|file|max:2048|mimes:jpg,bmp,png',
        ], [
            'changeProof.required' => 'Wajib Diisi',
            'changeProof.mimes' => 'Format Wajib Berupa Image',
            'changeProof.max' => 'Maksimal File 2048KB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('indexElement', $request->input('indexElement'));
        } else {
            $imageProof = $request->file('changeProof');
            $idOrder = $request->input('idOrder');
            $getPreviousImage = Order::where('id_order', $idOrder)->first()['proof_payment'];
            Storage::disk('public')->delete($getPreviousImage);
            Order::where('id_order', $idOrder)->update([
                'proof_payment' => $imageProof->store('/image_transaction','public'),
            ]);
            return redirect()->back()->with('success', 'Foto Bukti Pembayaran Berhasil Diubah');
        }
    }


    public function payment(Order $order) {
        $data = [
            'detailOrder' => $order,
        ];
        return view('Shopee/Payment/PaymentView', $data);
    }

    public function proofPayment(Request $request) {
        $validator = Validator::make($request->all(), [
            'imageProof' => 'required|file|max:2048|mimes:jpg,bmp,png',
        ], [
            'imageProof.required' => 'Wajib Diisi',
            'imageProof.mimes' => 'Format Wajib Berupa Image',
            'imageProof.max' => 'Maksimal File 2048KB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $fileImage = $request->file('imageProof');
            $idOrder = $request->input('idOrder');
            Order::where('id_order', $idOrder)->update([
                'proof_payment' => $fileImage->store('/image_transaction','public'),
            ]);
            return redirect()->back()->with('success', 'Bukti Pembayaran Berhasil Diupload');
        }
    }
}
