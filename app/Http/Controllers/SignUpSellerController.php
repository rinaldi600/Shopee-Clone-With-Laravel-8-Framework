<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignUpSellerController extends Controller
{

    private $redirect;
    public function __construct()
    {
        $this->redirect = redirect();
    }

    public function signup(Request $request) {

        $validator = Validator::make($request->all(), [
            'nameSeller' => 'required|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|alpha_dash|min:3|max:20|unique:sellers,username',
            'email' => 'required|email:rfc,dns,spoof,strict,filter',
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
            'password_confirmation' => 'required|alpha_num|min:8|max:20',
            'address' => 'required|regex:/^[[:alnum:]\s\/.\/,]+$/m|min:8'
        ], [
            'nameSeller.required' => 'Nama wajib diisi',
            'nameSeller.regex' => 'Nama hanya boleh huruf saja',

            'username.required' => 'Username wajib diisi',
            'username.alpha_dash' => 'Username tidak valid',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 20 karakter',
            'username.unique' => 'Username sudah tersedia',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa format email yang valid',

            'password.required' => 'Password wajib diisi',
            'password.alpha_num' => 'Password hanya boleh diisi angka dan huruf saja',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 20 karakter',
            'password.confirmed' => 'Password tidak sama',

            'password_confirmation.required' => 'Wajib Diisi',
            'password_confirmation.alpha_num' => 'Password hanya boleh diisi angka dan huruf saja',
            'password_confirmation.min' => 'Password minimal 8 karakter',
            'password_confirmation.max' => 'Password maksimal 20 karakter',

            'address.required' => 'Alamat wajib diisi',
            'address.regex' => 'Alamat tidak valid',
            'address.min' => 'Alamat minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return $this->redirect->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = [
              'id_seller' => 'SELLER - ' . Str::random(16),
                'name_seller' => $request->input('nameSeller'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'address' => $request->input('address')
            ];
            $seller = Seller::create($data);
            $request->session()->flash('status', 'Akun Berhasil Dibuat Silahkan Coba Login');
            return $this->redirect->back();
        }
    }

    public function sign(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => ['required','alpha_dash','min:3','max:20',
                function ($attribute, $value, $fail) {
                    $getDataBuyer = Seller::where('username', $value)->first();
                    if (!$getDataBuyer) {
                        $fail('The '.$attribute.' not found.');
                    }
                }
            ],
            'password' => 'required|alpha_num|min:8|max:20',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.alpha_dash' => 'Username tidak valid',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 20 karakter',

            'password.required' => 'Password wajib diisi',
            'password.alpha_num' => 'Password hanya boleh diisi angka dan huruf saja',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 20 karakter',
        ]);

        if ($validator->fails()) {
            return $this->redirect->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            if (Auth::guard('sellers')->attempt([
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ])) {
                $request->session()->regenerate();
                return redirect()->to('/dashboard_seller');
            }

            return back()->withErrors([
                'password' => ['Password Salah']
            ]);
        }

    }
}
