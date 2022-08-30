<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\Home::class, 'index']);

Route::get('/registration_seller', function () {
    $data = [
      'slogan' => 'Daftar sekarang Sebagai Seller! | Shopee Indonesia',
        'title' => 'Daftar Seller'
    ];
    return view('SignUp.ViewSignUp', $data);
});

Route::get('/registration_user', function () {
    $data = [
        'slogan' => 'Daftar sekarang Sebagai Pengguna! | Shopee Indonesia',
        'title' => 'Daftar Pengguna'
    ];
    return view('SignUpUser.ViewSignUp', $data);
});

Route::get('/login_seller', function () {
    $data = [
        'slogan' => 'Login Sebagai Seller! | Shopee Indonesia',
        'title' => 'Login Seller'
    ];
    return view('LogInSeller.ViewLogInSeller', $data);
})->middleware('IsLoginSeller');

Route::get('/login_user', function () {
    $data = [
        'slogan' => 'Login Sebagai Pengguna | Shopee Indonesia',
        'title' => 'Login Pengguna'
    ];
    return view('LogInUser.ViewLogInUser', $data);
})->middleware('IsLoginUser');


// Dashboard Seller
Route::middleware('seller')->group(function () {
    Route::get('/dashboard_seller', [\App\Http\Controllers\DashboardSeller::class, 'index']);
    Route::get('/dashboard_seller/no_rekening', [\App\Http\Controllers\DashboardSeller::class, 'noRekening']);
    Route::get('/dashboard_seller/add_rekening', [\App\Http\Controllers\DashboardSeller::class, 'addRekening']);
    Route::get('/dashboard_seller/change_rekening/{account}', [\App\Http\Controllers\DashboardSeller::class, 'changeRekening']);
    Route::get('/dashboard_seller/product', [\App\Http\Controllers\DashboardSeller::class, 'product']);
    Route::get('/dashboard_seller/order_product', [\App\Http\Controllers\DashboardSeller::class, 'orderProduct']);
    Route::get('/dashboard_seller/product/add_product', [\App\Http\Controllers\DashboardSeller::class, 'addProduct']);
    Route::get('/dashboard_seller/product/update_product/{idProduct}', [\App\Http\Controllers\DashboardSeller::class, 'updateProduct']);
    Route::delete('/delete_product', [\App\Http\Controllers\DashboardSeller::class, 'deleteProduct']);
    Route::put('/updateDataProduct', [\App\Http\Controllers\DashboardSeller::class, 'updateDataProduct']);
    Route::post('/getDataProduct', [\App\Http\Controllers\DashboardSeller::class, 'getDataProduct']);
    Route::post('/getDataRekening', [\App\Http\Controllers\DashboardSeller::class, 'getDataRekening']);
    Route::post('/getNewDataRekening', [\App\Http\Controllers\DashboardSeller::class, 'getNewDataRekening']);
    Route::post('/deleteDataRekening', [\App\Http\Controllers\DashboardSeller::class, 'deleteDataRekening']);
    Route::post('/change_note', [\App\Http\Controllers\DashboardSeller::class, 'changeNote']);
    Route::post('/confirm_order', [\App\Http\Controllers\DashboardSeller::class, 'confirmOrder']);
    Route::post('/logout_seller', [\App\Http\Controllers\DashboardSeller::class, 'logout']);
});

// Dashboard Buyer
Route::middleware('buyer')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\SignUpUser::class, 'logout']);
    Route::post('/checkout_product', [\App\Http\Controllers\Buyer::class, 'checkoutBuy']);
    Route::get('/carts', [\App\Http\Controllers\Buyer::class, 'index']);
    Route::post('/cart-product', [\App\Http\Controllers\Buyer::class, 'cartProduct']);
    Route::post('/buy_product', [\App\Http\Controllers\Buyer::class, 'buyProduct']);
    Route::post('/delete_cart_product', [\App\Http\Controllers\Buyer::class, 'deleteProduct']);
    Route::post('/upload_proof_payment', [\App\Http\Controllers\Buyer::class, 'proofPayment']);
    Route::post('/change_proof_payment', [\App\Http\Controllers\Buyer::class, 'changeImageProof']);
    Route::get('/payment/{order:id_order}', [\App\Http\Controllers\Buyer::class, 'payment']);
});

Route::post('/signup_seller', [\App\Http\Controllers\SignUpSellerController::class, 'signup']);
Route::post('/sign_seller', [\App\Http\Controllers\SignUpSellerController::class, 'sign']);
Route::post('/sign_user', [\App\Http\Controllers\SignUpUser::class, 'sign']);
Route::post('/signup_user', [\App\Http\Controllers\SignUpUser::class, 'signup']);
Route::get('/detail/{product}', [\App\Http\Controllers\Home::class, 'detailProduct']);

Route::post('/banner_image', [\App\Http\Controllers\Home::class, 'banner']);
Route::get('/search_product', [\App\Http\Controllers\Home::class, 'searchProduct']);


