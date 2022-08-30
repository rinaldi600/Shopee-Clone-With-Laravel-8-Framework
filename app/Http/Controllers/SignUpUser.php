<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\CheckPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Buyer;

class SignUpUser extends Controller
{
    public function signup(Request $request) {
        $validator = Validator::make($request->input(), [
            'nameBuyer' => 'required|regex:/^[a-zA-Z\s]+$/m',
            'username' => 'required|regex:/^[a-zA-Z0-9\._]+$/m|min:3|max:20|unique:buyers,username',
            'email' => 'required|email:rfc,dns,strict,spoof,filter',
            'password' => 'required|min:8|max:20|confirmed|alpha_num',
            'password_confirmation' => 'required',
            'address' => 'required|string|min:8'

        ], [
            'nameBuyer.required' => 'Kolom wajib diisi',
            'nameBuyer.regex' => 'Inavlid nama anda',

            'username.required' => 'Kolom wajib diisi',
            'username.regex' => 'Invalid username anda',
            'username.min' => 'Kolom minimal 3 karakter',
            'username.max' => 'Kolom maksimal 20 karakter',
            'username.unique' => 'Username sudah ada',

            'email.required' => 'Kolom wajib diisi',
            'email.email' => 'Invalid email anda',

            'password.required' => 'Kolom wajib diisi',
            'password.confirmed' => 'Password tidak sama',
            'password.min' => 'Kolom minimal 8 karakter',
            'password.max' => 'Kolom maksimal 20 karakter',

            'password_confirmation.required' => 'Password tidak sama',

            'address.required' => 'Kolom wajib diisi',
            'address.min' => 'Kolom minimal 8 karakter'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $dataInput = [
                'id_buyer' => 'Buyer-' . uniqid(),
                'name_buyer' => $request->input('nameBuyer'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
              'address' => strip_tags($request->input('address'))
            ];

            Buyer::create($dataInput);
            $request->session()->flash('success', 'Akun berhasil dibuat silahkan coba login');
            return redirect()->back();
        }
    }

    public function sign(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:buyers,username',
            'password' => ['required', new CheckPassword($request->input('username'))]
        ], [
            'username.required' => 'Kolom wajib diisi',
            'username.exists' => 'Username tidak ada',
            'password.required' => 'Kolom wajib diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (Auth::guard('buyers')->attempt([
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ])) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
