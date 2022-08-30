@extends('Shopee.MainLayout')

@section('content')
{{--    @dump($detailProduct)--}}
    <div class="container detail-product mt-2">
        <div style="background-color: white" class="detail position-relative">
            <div style="height: inherit;" class="row container-detail">
                <div style="height: inherit;" class="col-12 col-sm-6 p-1">
                    <img class="image-product img-thumbnail" src="{{ asset('/storage/'. $detailProduct['image']) }}" alt="">
                </div>
                <div style="height: inherit" class="col-12 col-sm-6">
                    <h4>{{ $detailProduct['name_product'] }}</h4>
                    <h3 style="color: rgb(254,87,34); background-color: rgb(250,250,250)" class="fw-bold p-2">
                        Rp. {{ number_format($detailProduct['price'], 0, ',', '.') }}
                    </h3>
                    <p class="mt-3"> <span style="color: rgb(117,117,117)">Protection &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        Proteksi Efek Samping Produk
                        <span style="background-color: rgb(254,87,34); color: white; border-radius: 20%" class="p-1">New</span>
                    </p>
                    <form action="/checkout_product" method="post">
                        @csrf
                        <div class="quantity d-flex align-items-center flex-wrap">
                            <span>Kuantitas &nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="hidden" name="idProduk" value="{{ $detailProduct['id_product'] }}">
                            <input type="number" name="quantityProduct" placeholder="Jumlah" min="1" max="{{ $detailProduct['quantity'] }}" class="quantity-order p-2">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span>Tersisa {{ $detailProduct['quantity'] }} buah</span>
                        </div>
                        <span class="alert-quantity d-none" style="color: rgb(255,66,79)">Silahkan masukkan jumlah anda</span>
                        <div class="group-button">
                            <button class="btn btn-buy text-white rounded-1 mt-4" style="background-color: rgb(254,87,34)" type="submit">
                                Beli Sekarang
                            </button>
                            <input type="hidden" value="{{ $detailProduct['id_product'] }}">
                            <input type="hidden" value="{{ auth()->guard('buyers')->user()['id_buyer'] ?? '' }}">
                            <input type="hidden" value="{{ $detailProduct->seller->id_seller }}">
                            <button class="product-cart btn btn-cart rounded-1 mt-4"
                                    style="border: 1px solid rgb(254,87,34); color: rgb(254,87,34); background-color: rgb(255,238,232)" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                Masukkan Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="height: 100px; background-color: white" class="seller mt-2 d-flex align-items-center">
            <div style="width: 100%" class="details mx-2 d-flex align-items-center gap-2">
                <img src="/img/erica-zhou-IHpUgFDn7zU-unsplash.jpg"
                     class="image-seller img-thumbnail rounded-circle" alt="">
                <div class="detail-seller">
                    <div>
                        <span>{{  $detailProduct->seller->name_seller }}</span> <br>
                        <span style="color: rgb(130,130,130)">Aktif 9 Menit Lalu</span>
                    </div>
                    <div>
                        <a class="btn btn-outline-secondary go-shop d-flex align-items-center gap-1" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop-window" viewBox="0 0 16 16">
                                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            Kunjungi Toko
                        </a>
                    </div>
                </div>
                <div class="line" style="border-right: 1px solid rgb(242,242,242); height: 80px; width: 1px;"></div>
                <div class="d-flex flex-wrap">
                    <div class="detail-sale-shop">
                        <span>Penilaian &nbsp;&nbsp; <span style="color: rgb(254,87,34)">1.8RB</span></span>
                        <br>
                        <span>Produk &nbsp;&nbsp; <span style="color: rgb(254,87,34)">14</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div style="min-height: 500px" class="specification-product bg-white container mt-2">
            <h4 style="color: rgba(0,0,0,.87); position: relative; top: 20px; background-color: rgb(250,250,250)" class="p-3">
                Deskripsi Produk
            </h4>
            <span style="position: relative; top: 40px;">{!! $detailProduct['description'] !!}</span>
        </div>
    </div>
@endsection
