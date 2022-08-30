@extends('Shopee.MainLayout')
@section('content')

    @if($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="notifications-payment @if($message) '' @else 'd-none' @endif">
            <div style="position: absolute; top: 20%; right: 30%" class="col-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close close-notifications" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div style="background-color: white; min-height: 1000px" class="container-fluid payment-checkout">
        <div class="d-flex align-items-center">
            <img class="img-fluid" src="/img/6102dc563de48b00044eb5b3.png" alt="Banner">
            <p style="color: rgb(254,87,34);" class="fs-3">
                Checkout
            </p>
        </div>
        <div style="min-height: 200px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 7px" class="container mt-4">
            <p style="color: rgb(254,87,34);" class="fs-5 d-flex flex-wrap align-items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
                Alamat Pengiriman
            </p>
            <div class="address-buyer">
                <p style="margin-left: 20px" class="fw-bold">{{ $detailOrder->buyer->name_buyer }}</p>
                <p style="margin-left: 20px">{{ $detailOrder->buyer->address }}</p>
            </div>
        </div>

        <div style="min-height: 200px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 7px" class="container mt-3">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th scope="col">Produk Disimpan</th>
                        <th style="color: rgb(187,187,187)" class="fw-light" scope="col">Harga Satuan</th>
                        <th style="color: rgb(187,187,187)" class="fw-light" scope="col">Jumlah</th>
                        <th style="color: rgb(187,187,187)" class="fw-light" scope="col">Subtotal Produk</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-middle">
                        <td>
                            <p class="d-flex align-items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  style="color: rgb(254,87,34);" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                {{ $detailOrder->seller->name_seller }}
                            </p>
                            <div class="d-flex align-items-center gap-1">
                                <img class="rounded" src="{{ asset('storage/' . $detailOrder->product->image) }}" alt="">
                                <p>{{ $detailOrder->product->name_product }}</p>
                            </div>
                        </td>
                        <td>Rp {{ number_format($detailOrder->product->price,0,',','.') }}</td>
                        <td>{{ $detailOrder['total_order'] }}</td>
                        <td>Rp {{ number_format($detailOrder['price_order'],0,',','.') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="min-height: 80px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 7px" class="container mt-3">
            <p style="border-bottom: 2px solid rgb(173,173,173)" class="p-2 fs-5 d-flex flex-wrap align-items-center gap-1">
                <svg style="color: rgb(254,87,34);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                    <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                    <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Voucher Shopee
            </p>
            <div class="coins-buyer d-flex justify-content-between">
                <p style="margin-left: 20px" class="fw-bold d-flex flex-wrap align-items-center gap-2">
                    <svg style="color: rgb(255,171,15)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                    </svg>
                    Koin Shopee
                </p>
                <p style="color: rgb(146,146,146)">Tukarkan 118 Koin Shopee</p>
            </div>
        </div>

        <div style="min-height: 100px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 7px" class="container mt-4">
            <div class="d-flex p-1 flex-wrap">
                <div class="title-method-payment d-grid align-items-center">
                    <p style="font-size: 16px" class="d-flex flex-wrap align-items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                        </svg>
                        <span>Metode Pembayaran</span>
                    </p>
                </div>
                <div style="min-height: 80px;" class="method-payment d-flex flex-wrap align-content-center gap-1 p-1">
                    <button class="rounded-0 btn-payment" type="button">Transfer Bank</button>
                    <button class="rounded-0 btn-payment" type="button">Outlet</button>
                    <button class="rounded-0 btn-payment" type="button">E-Wallet</button>
                    <button class="rounded-0 btn-payment" type="button">Transfer Manual</button>
                </div>
            </div>
            <div class="list-payment">
                <div style="min-height: 500px" class="row transfer-bank d-none">
                    <div class="col-4">
                        <h1 class="fs-5">Pilih Bank</h1>
                    </div>
                    <div class="col-8">
                        <div>
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="bca">
                                <input class="form-check-input" type="radio" name="bankPayment" id="bca" value="bca">
                                <img src="/img/Bank BCA Logo (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="bca">
                                    BANK BCA ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman Bank BCA</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="bni">
                                <input class="form-check-input" type="radio" name="bankPayment" id="bni" value="bni">
                                <img src="/img/Bank BNI Logo (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="bni">
                                    BANK BNI ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman Bank BNI</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="bri">
                                <input class="form-check-input" type="radio" name="bankPayment" id="bri" value="bri">
                                <img src="/img/Bank BRI (Bank Rakyat Indonesia) Logo (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="bri">
                                    BANK BRI ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman Bank BRI</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="mandiri">
                                <input class="form-check-input" type="radio" name="bankPayment" id="mandiri" value="mandiri">
                                <img src="/img/Bank Mandiri Logo (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="mandiri">
                                    BANK Mandiri ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman Bank Mandiri</span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="min-height: 200px" class="row outlet d-grid justify-content-center d-none">
                    <div class="col-12">
                        <div>
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="alfamart">
                                <input class="form-check-input" type="radio" name="outletPayment" id="alfamart" value="alfamart">
                                <img src="/img/Logo Alfamart (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="alfamart">
                                    Alfamart
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="indomaret">
                                <input class="form-check-input" type="radio" name="outletPayment" id="indomaret" value="indomaret">
                                <img src="/img/Logo Indomaret (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="indomaret">
                                    Indomaret
                                </label>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="min-height: 500px" class="row e-wallet d-none">
                    <div class="col-4">
                        <h1 class="fs-5">Pilih E-Wallet</h1>
                    </div>
                    <div class="col-8">
                        <div>
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="ovo">
                                <input class="form-check-input" type="radio" name="eWalletPayment" id="ovo" value="ovo">
                                <img src="/img/Logo OVO (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="ovo">
                                    OVO ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman OVO</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="dana">
                                <input class="form-check-input" type="radio" name="eWalletPayment" id="dana" value="dana">
                                <img src="/img/Logo DANA (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="dana">
                                    DANA ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman DANA</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="shopeePay">
                                <input class="form-check-input" type="radio" name="eWalletPayment" id="shopeePay" value="shopeePay">
                                <img src="/img/ShopeePay Logo (PNG-240p) - Vector69Com.png" alt="">
                                <label class="form-check-label" for="shopeePay">
                                    ShopeePay ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman ShopeePay</span>
                                </label>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="form-check-label icon-bca d-flex align-items-center gap-2" for="linkAja">
                                <input class="form-check-input" type="radio" name="eWalletPayment" id="linkAja" value="linkAja">
                                <img src="/img/Logo LinkAja (PNG-240p) - FileVector69.png" alt="">
                                <label class="form-check-label" for="linkAja">
                                    LinkAja ( Dicek Otomatis ) <br>
                                    <span style="color: rgb(149,153,153)">Hanya Meneriman LinkAja</span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="min-height: 200px" class="row transfer-manual @error('imageProof') '' @else d-none @enderror d-grid">
                    <div class="col-6 mb-3">
                        <ul class="list-group">
                            @foreach($detailOrder->seller->account as $account )
                                <li class="list-group-item">
                                    Transfer Rekening : {{ $account['number_account'] }}
                                    <br>
                                    Atas Nama : {{ $account['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="/upload_proof_payment" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-8">
                            <h1 class="fs-5">Bukti Pembayaran Foto</h1>
                            <div>
                                <img style="max-height: 50%; max-width: 50%" src="/img/money-bag.gif" class="img-fluid mt-3 mb-3 image-proof-preview" alt="...">
                                <button type="button" class="btn btn-outline-secondary zoom d-none">Zoom Image</button>
                            </div>
                            <input type="hidden" name="idOrder" value="{{ $detailOrder['id_order'] }}">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('imageProof') is-invalid @enderror image-proof" name="imageProof" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                @error('imageProof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <p class="d-none" style="color: red">File Bukan Gambar</p>
                            <button class="btn btn-outline-secondary pe-none" type="submit">Buat Pesanan</button>
                        </div>
                        <div class="mt-3 w-100 h-auto d-grid justify-content-end align-items-center">
                            <div style="color: rgb(149,153,153)" class="total-payment d-grid align-middle">
                                <p>Subtotal Untuk Produk : <span class="fw-bold">Rp. {{ number_format($detailOrder['price_order'],0,',','.') }}</span></p>
                                <p>Total Untuk Ongkos Kirim : -</p>
                                <p>Biaya Penanganan : -</p>
                                <p>Total Pembayaran : -</p>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
