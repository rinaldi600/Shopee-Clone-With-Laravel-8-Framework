@extends('Shopee.MainLayout')

@section('content')
    <div style="min-height: 1200px" class="container bg-white product-not-yet-paid p-3">
        <h4 style="color: rgba(0,0,0,.87); position: relative; top: 20px; background-color: rgb(250,250,250)" class="p-3">
            Daftar Produk Kamu
        </h4>

        @if($messageSuccess = \Illuminate\Support\Facades\Session::get('success'))
            <div class="col-7 mt-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $messageSuccess }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div style="position: relative; top: 25px" class="table-responsive col-10">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th class="fw-light remove-transaction d-none" scope="col"></th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Nama Produk</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Toko</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Harga</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Kuantitas</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Total Harga</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Status Order</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Catatan Penjual</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Aksi</th>
                    <th class="fw-light" style="color: rgb(136,136,136)" scope="col">Bayar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataOrder as $order)
                    <tr class="align-middle position-relative">
                        <td class="position-absolute top-50 start-50 d-grid justify-content-center d-none align-content-center translate-middle loading-transaction">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </td>
                        <td>
                            <img class="rounded-1" style="max-width: 30%; max-height: 30%" src="{{ asset('storage/' . $order->product->image) }}" alt="">
                            <span class="mx-2">{{ $order->product->name_product }}</span>
                        </td>
                        <td>
                            {{ $order->seller->name_seller }}
                        </td>
                        <td>Rp. {{ number_format($order->product->price,0,',','.') }}</td>
                        <td>
                            <input type="number" class="text-center" name="quantity-0" min="1" value="{{ $order['total_order'] }}" max="{{ $order->product->quantity }}">
                            <span class="d-none" style="color: red">Maksimum {{ $order->product->quantity }}</span>
                        </td>
                        <td>Rp. {{ number_format($order['price_order'],0,',','.') }}</td>
                        <td>{{ $order['status_order'] }}</td>
                        <td>{{ $order['notes'] }}</td>
                        <td>
                            <form action="/delete_cart_product" method="post">
                                @csrf
                                <input type="hidden" name="idOrder" value="{{ $order['id_order'] }}">
                                <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('Apakah anda ingin menghapus produk')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td class="mx-auto text-center">
                            @if($order['proof_payment'] === 'Belum ada bukti pembayaran')
                                <input type="hidden" value="{{ $order['id_order'] }}">
                                <button class="btn btn-outline-secondary buy-product" type="button">
                                    <svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    Beli
                                </button>
                            @else
                                <a class="text-decoration-none" target="_blank" href="/storage/{{ $order['proof_payment'] }}">
                                    <img style="max-width: 30%; max-height: 30%; margin-bottom: 2px;" src="{{ asset('storage/' . $order['proof_payment']) }}" alt="">
                                </a>
                                <div class="d-inline-block">
                                    <button type="button" class="btn-change-proof modal-btn btn btn-outline-secondary">
                                        Ubah
                                    </button>
                                </div>
                                <div class="modal-change-proof d-none d-grid justify-content-center align-items-center">
                                    <div class="w-100 bg-white mx-auto p-2 rounded-1">
                                        <form action="/change_proof_payment" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group">
                                                <input type="hidden" name="idOrder" value="{{ $order['id_order'] }}">
                                                <input type="hidden" name="indexElement" value="{{ $loop->iteration}}">
                                                <input type="file" class="form-control align-middle @error('changeProof') is-invalid @enderror" id="inputGroupFile02" name="changeProof">
                                                <label class="input-group-text align-middle" for="inputGroupFile02">Upload</label>
                                                @error('changeProof')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-outline-secondary mt-1">Ubah</button>
                                            <button type="button" class="btn-cancel-proof btn btn-danger mt-1">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($message = \Illuminate\Support\Facades\Session::get('indexElement'))
        <script>
            const btnChangePaymentAuto = document.querySelectorAll('.btn-change-proof')['<?php echo((int) $message) - 1 ?>'];
            window.onload = () => {
                btnChangePaymentAuto.click()
            };
        </script>
    @endif
@endsection
