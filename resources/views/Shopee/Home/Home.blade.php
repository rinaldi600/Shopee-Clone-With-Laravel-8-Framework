@extends('Shopee.MainLayout')
@section('content')
    <div class="banner mt-2 bg-white">
        <div style="height: inherit" class="container mx-auto">
            <div style="height: inherit" class="row">
                <div class="col-12 col-sm-8 parent-image position-relative overflow-hidden" style="height: inherit;">
                    <div class="position-absolute top-50 start-0 translate-middle-y rounded-1" style="background-color: rgba(0,0,0,.25)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" style="cursor: pointer" class="arrow-left bi bi-arrow-left text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                    </div>
                    <img class="rounded banner-image" style="width:100%;height:100%;" src="/banner/ehimetalor-akhere-unuabona-TvJk52iLxQA-unsplash.jpg" alt="">
                    <div class="position-absolute top-50 end-0 translate-middle-y rounded-1" style="background-color: rgba(0,0,0,.25)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" style="cursor: pointer" class="arrow-right bi bi-arrow-right text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </div>
                </div>
                <div style="height: inherit" class="col-12 col-sm-4">
                    <div style="height: inherit" class="row">
                        <div style="height: 50%" class="col-12 p-1">
                            <img class="rounded" style="width:100%;height:100%;" src="/banner/maxresdefault.jpg" alt="">
                        </div>
                        <div style="height: 50%" class="col-12 p-1">
                            <img class="rounded" style="width:100%;height:100%;" src="/banner/SEO-Header-1-1.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category p-1 mt-3 mb-3">
        <div style="min-height: inherit" class="container mx-auto bg-white">
            <h4 style="color: rgb(117,117,117)" class="p-2 fw-bold">KATEGORI</h4>
            <div class="row category-one px-1">
                <div style="background-image: url('/banner/category/accessories.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Accessories</a></p>
                </div>
                <div style="background-image: url('/banner/category/automotive.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Automotive</a></p>
                </div>
                <div style="background-image: url('/banner/category/clothes.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Clothes</a></p>
                </div>
                <div style="background-image: url('/banner/category/computer.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Computer</a></p>
                </div>
                <div style="background-image: url('/banner/category/elektronik.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Elektronik</a></p>
                </div>
                <div style="background-image: url('/banner/category/food.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Food</a></p>
                </div>
            </div>
            <div class="row category-two px-1">
                <div style="background-image: url('/banner/category/handphone.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Handphone</a></p>
                </div>
                <div style="background-image: url('/banner/category/healthy.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Healthy</a></p>
                </div>
                <div style="background-image: url('/banner/category/hobby.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Hobby</a></p>
                </div>
                <div style="background-image: url('/banner/category/shoe.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Shoe</a></p>
                </div>
                <div style="background-image: url('/banner/category/sport.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Sport</a></p>
                </div>
                <div style="background-image: url('/banner/category/stationary.jpg');
                background-position: center; background-repeat: no-repeat; background-size: cover; justify-items: center" class="col-sm-2 position-relative d-grid align-items-center">
                    <div style="background-color: rgba(0,0,0,.4); position: absolute; top: 0; right: 0; left: 0; bottom: 0"></div>
                    <p style="z-index: 999; position: absolute" class="text-center"><a class="text-decoration-none text-white" href="#">Stationary</a></p>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: rgb(245,245,245);" class="container-fluid">
        <div class="product-recomended container mt-3 mb-3 d-flex flex-wrap gap-1">
            @if($dataProduct->count() <= 0)
                <h1 class="text-center d-grid justify-content-center mx-auto">PRODUK BELUM ADA</h1>
            @else
                @foreach($dataProduct as $product)
                    <div class="list-product bg-white">
                        <div style="height: 65%" class="image-section bg-white">
                            <img style="width: 100% !important; height: 100%" src="{{ 'storage/' . $product['image'] }}" alt="Product">
                        </div>
                        <div style="height: 35%" class="name-product">
                            <p style="color: black; font-size: 16px"><a class="text-dark text-decoration-none" href="/detail/{{ \Illuminate\Support\Facades\Crypt::encryptString($product['id_product']) }}">
                                    <?= strlen($product['name_product']) >
                                    35 ? substr($product['name_product'], 0, 30).'...' : $product['name_product']  ?></a></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <p style="color: rgb(254,87,34)" class="fw-bold">Rp. {{ number_format($product['price'],0,',','.') }}</p>
                                <p style="font-size: 10px; color: rgb(117,117,117)">1755 Terjual</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
