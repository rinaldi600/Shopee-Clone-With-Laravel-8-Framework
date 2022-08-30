<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class DashboardSeller extends Controller
{

    private $redirect;
    private $validation;
    private $rules;
    private $message;
    public function __construct()
    {
        $this->redirect = redirect();

        $this->rules = [
            'name_product' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|numeric|max:999|min:1',
            'image' => 'file|required|image|max:2048',
            'weight' => 'required|integer|gte:1|lte:30'
        ];

        $this->message = [
            'name_product.required' => 'Kolom wajib diisi',
            'name_product.regex' => 'Inputan kolom invalid',
            'description.required' => 'Kolom wajib diisi',
            'price.required' => 'Kolom wajib diisi',
            'weight.required' => 'Kolom wajib diisi',
            'weight.integer' => 'Kolom wajib angka',
            'weight.gte' => 'Berat harus lebih dari 1 Kg',
            'weight.lte' => 'Berat harus kurang dari 30 Kg',
            'price.string' => 'Kolom harus berupa angka',
            'quantity.required' => 'Kolom wajib diisi',
            'quantity.numeric' => 'Kolom harus berupa angka',
            'quantity.max' => 'Kolom maksimal 999',
            'quantity.min' => 'Kolom minimal 1',
            'image.required' => 'Kolom wajib diisi',
            'image.image' => 'Kolom wajib berupa gambar',
            'image.max' => 'Maksimal gambar 2MB'
        ];
    }

    public function index(Request $request) {
        $data = [
          'slogan' => 'Dashboard Seller',
            'dataOrder' => Order::with(['product','buyer','seller'])->where('id_seller', auth()->guard('sellers')->user()['id_seller'])->orderBy('created_at','DESC')->get()->take(2),
            'dataProduct' => Product::where('id_seller', auth()->guard('sellers')->user()['id_seller'])->orderBy('created_at','DESC')->get()->take(10)
        ];
        return view('DashboardSeller.Home.HomeDashboard', $data);
    }

    public function product(Request $request) {
        $getData = Product::where('id_seller',\auth()->guard('sellers')->user()['id_seller'])->paginate(2);

        if ($request->isMethod('get') && ($request->input('keyword') || $request->input('filter'))) {
            $getData = Product::search($request->input())->paginate(2)->appends(request()->query());
        }
        $data = [
            'slogan' => 'Dashboard Seller',
            'dataProduct' => $getData,
            'dataCount' => Product::where('id_seller',\auth()->guard('sellers')->user()['id_seller'])->get()->count()
        ];
        return view('DashboardSeller.Product.HomeProduct', $data);
    }

    public function addProduct() {
        $data = [
            'slogan' => 'Dashboard Seller'
        ];
        return view('DashboardSeller.Product.AddProduct.AddProductView', $data);
    }

    public function noRekening() {
        $data = [
            'slogan' => 'Dashboard Seller',
            'dataRekening' => Account::with('seller')->where('id_seller', Auth::guard('sellers')->user()['id_seller'])->get()
        ];
        return view('DashboardSeller.NoRekening.RekeningView', $data);
    }

    public function changeRekening(Account $account) {
        $data = [
            'slogan' => 'Dashboard Seller',
            'detailRekening' => $account,
        ];
        return view('DashboardSeller.NoRekening.ChangeRekening.ChangeRekeningView', $data);
    }

    public function getNewDataRekening(Request $request) {
        $checkNoRekening = $request->input('oldNumberAccount') == $request->input('no_rekening') ? 'exists:accounts,number_account' : 'unique:accounts,number_account';
        $this->validation = Validator::make($request->all(), [
            'atas_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'no_rekening' => 'required|numeric|digits_between:10,20|'. $checkNoRekening,
        ],[
            'atas_name.required' => 'Kolom wajib diisi',
            'atas_name.regex' => 'Nama invalid',
            'no_rekening.required' => 'Kolom wajib diisi',
            'no_rekening.unique' => 'No rekening tidak boleh sama',
            'no_rekening.numeric' => 'No rekening invalid',
            'no_rekening.digits_between' => 'Digit no rekening harus minimal 10 dan maksimal 20',
        ]);

        if ($this->validation->fails()) {
            return redirect()->back()
                ->withErrors($this->validation)
                ->withInput();
        } else {
            Account::where('id_account', $request->input('idAccount'))->update([
                'name' => $request->input('atas_name'),
                'number_account' => $request->input('no_rekening'),
            ]);
            return $this->redirect->to('/dashboard_seller/no_rekening')->with('success','Berhasil mengubah data rekening');
        }
    }

    public function deleteDataRekening(Request $request) {
        Account::where('id_account',$request->input('idAccount'))->delete();
        return $this->redirect->to('/dashboard_seller/no_rekening')->with('success','Berhasil menghapus data rekening');
    }

    public function addRekening() {
        $data = [
            'slogan' => 'Dashboard Seller',
        ];
        return view('DashboardSeller.NoRekening.AddRekening.AddRekeningView', $data);
    }

    public function getDataRekening(Request $request) {

        $this->validation = Validator::make($request->all(), [
            'atas_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'no_rekening' => 'required|numeric|digits_between:10,20|unique:accounts,number_account',
        ],[
            'atas_name.required' => 'Kolom wajib diisi',
            'atas_name.regex' => 'Nama invalid',
            'no_rekening.required' => 'Kolom wajib diisi',
            'no_rekening.unique' => 'No rekening tidak boleh sama',
            'no_rekening.numeric' => 'No rekening invalid',
            'no_rekening.digits_between' => 'Digit no rekening harus minimal 10 dan maksimal 20',
        ]);

        if ($this->validation->fails()) {
            return redirect()->back()
                ->withErrors($this->validation)
                ->withInput();
        } else {
            Account::create([
                'id_account' => 'ID - ' . uniqid(),
                'name' => $request->input('atas_name'),
                'id_seller' => Auth::guard('sellers')->user()['id_seller'],
                'number_account' => $request->input('no_rekening'),
            ]);
            return $this->redirect->to('/dashboard_seller/no_rekening')->with('success','Berhasil menambahkan no rekening');
        }

    }

    public function updateProduct($idProduct) {
        try {
            $decrypted = Crypt::decryptString($idProduct);
            $data = [
                'slogan' => 'Dashboard Seller',
                'detailProduct' => Product::where('id_product', $decrypted)->first(),
            ];
            return view('DashboardSeller.Product.UpdateProduct.UpdateProductView', $data);
        } catch (DecryptException $e) {
            return $this->redirect->back();
        }
    }

    public function updateDataProduct(Request $request) {
        unset($this->rules['image']);
        $validationImage = empty($request->file('image')) ? '' : $this->rules['image'] = 'file|required|image|max:2048';
        $this->validation = Validator::make($request->all(), $this->rules, $this->message);
        if ($this->validation->fails()) {
            return redirect()->back()
                ->withErrors($this->validation)
                ->withInput();
        } else {
            $data = [
                'name_product' => $request->input('name_product'),
                'description' => htmlentities($request->input('description'), ENT_QUOTES, 'UTF-8', false),
                'weight' => $request->input('weight'),
                'price' => str_replace('.','',$request->input('price')),
                'quantity' => $request->input('quantity'),
            ];
            $checkImage = empty($request->file('image')) ? ''
                :
                ($data['image'] = $request->file('image')->store('product_image','public')) &&
                Storage::disk('public')->delete($request->input('oldUrlImage'));
            Product::where('id_product', $request->input('idProduct'))->update($data);
            return $this->redirect->to('/dashboard_seller/product')->with('success','Produk berhasil diubah');
        }
    }

    public function getDataProduct(Request $request) {
        $this->validation = Validator::make($request->all(), $this->rules, $this->message);

        if ($this->validation->fails()) {
            return redirect()->back()
                ->withErrors($this->validation)
                ->withInput();
        }

        $fileUpload = $request->file('image');
        $data = [
          'id_product' => 'Product-'.(String) Str::uuid(),
            'id_seller' => \auth()->guard('sellers')->user()->id_seller,
            'name_product' => $request->input('name_product'),
            'description' => htmlentities($request->input('description'), ENT_QUOTES, 'UTF-8', false),
            'weight' => $request->input('weight'),
            'price' => str_replace('.','',$request->input('price')),
            'image' =>  $fileUpload->store('product_image','public'),
            'quantity' => $request->input('quantity'),
        ];

        Product::create($data);
        return $this->redirect->to('/dashboard_seller/product')->with('success','Produk berhasil ditambahkan');

    }

    public function deleteProduct(Request $request) {
        $checkOrder = Order::where('id_product', $request->input('idProduct'))->first();
        if (empty($checkOrder)) {
            $data = Product::where('id_product', $request->input('idProduct'))->first();
            Storage::disk('public')->delete($data['image']);
            $delete = Product::where('id_product', $request->input('idProduct'))->delete();
            return $this->redirect->back()->with('success','Data deleted');
        } else {
            return $this->redirect->back()->with('success','Data tidak bisa dihapus, karena sedang dipakai');
        }
    }

    public function orderProduct(Request $request) {
        $data = [
            'dataOrder' => Order::search(
                $request->input()
            )->with(['product', 'buyer', 'seller'])->where('id_seller', \auth()->guard('sellers')->user()['id_seller'])->paginate(25)->appends(request()->query())
        ];
        return view('DashboardSeller.Product.OrderProduct.OrderProduct', $data);
    }

    public function changeNote(Request $request) {
        $idOrder = $request->input('idOrder');
        $textNotes = $request->input('textNotes');

        Order::where('id_order', $idOrder)->update([
           'notes' => $textNotes
        ]);

        return response()->json([
            'success' => 'Berhasil Diubah'
        ]);

    }


    public function confirmOrder(Request $request) {
        if ($request->input('confirm')) {
            $confirmOrder = $request->input('confirm');
            $idOrder = $request->input('idOrder');
            $detailProduct = Order::with('product')->where('id_order', $idOrder)->first();
            $quantityOrder = Order::where('id_order', $idOrder)->first()['total_order'];

            if ($detailProduct->product->quantity - $quantityOrder >= 0) {
                Product::where('id_product', $detailProduct->product['id_product'])->update([
                    'quantity' => $detailProduct->product->quantity - $quantityOrder
                ]);

                Order::where('id_order', $idOrder)->update([
                    'status_order' => $confirmOrder
                ]);
                return redirect()->back()->with('success', 'Status order berhasil diubah');
            } else {
                return redirect()->back()->with('success', 'Produk Tidak Mencukupi');
            }
        }
        else {
            if ($request->input('other')) {
                $statusOrder = $request->input('value');
                $idOrder = $request->input('idOrder');
                $detailOrder = Order::where('id_order', $idOrder)->first();
                $detailProduct = Order::with('product')->where('id_order', $idOrder)->first();
                if ($detailOrder['status_order'] === 'pending') {
                    Order::where('id_order', $request->input('idOrder'))->update([
                        'status_order' => $statusOrder
                    ]);
                    return response()->json([
                       'successRejected' => $statusOrder,
                    ]);
                }
            } else {
                $statusOrder = $request->input('cancel');
                $detailOrder = Order::where('id_order', $request->input('idOrder'))->first();
                $detailProduct = Order::with('product')->where('id_order', $request->input('idOrder'))->first()->product;
                if ($detailOrder['status_order'] === 'confirmed') {
                    Product::where('id_product', $detailProduct['id_product'])->update([
                        'quantity' => $detailProduct->quantity + $detailOrder['total_order']
                    ]);

                    Order::where('id_order', $request->input('idOrder'))->update([
                        'status_order' => $statusOrder
                    ]);
                    return redirect()->back()->with('success', 'Status order berhasil diubah');
                }
            }
        }
    }

    public function logout(Request $request) {
        \auth()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->to('/login_seller');
    }
}
