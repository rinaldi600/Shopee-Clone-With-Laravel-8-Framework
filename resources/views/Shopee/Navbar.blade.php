<nav class="navbar navbar-expand-lg">
    <div class="container align-middle">
        <a class="navbar-brand text-white" href="/">
            <img src="/icons/shopee-logo-40482-64x64.ico" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse position-relative" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Seller Center</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mulai Jual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Download</a>
                </li>
            </ul>
            @if(auth()->guard('buyers')->user())
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 drop-menu">
                    <li class="nav-item d-flex align-items-center gap-1">
                        <span class="text-white">{{ auth()->guard('buyers')->user()->name_buyer }}</span>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="btn-logout" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-right text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </button>
                        </form>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 drop-menu">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/registration_user">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login_user">Login</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
<div class="box position-relative d-flex flex-wrap align-content-center">
    @if( \Illuminate\Support\Str::of('payment*')->is(explode('/',\Illuminate\Http\Request::capture()->path())[0]))

    @else
        <div class="col-6 search mx-auto position-relative bg-success">
            <form action="/search_product" method="get">
                <div class="input-group w-100">
                    <input type="text" class="form-control rounded-0 p-2 w-100 keyword" name="keyword" placeholder="Produk Diskon up to 80%">
                </div>
                <button class="btn button-search btn-outline-secondary position-absolute top-50 end-0 translate-middle-y rounded-0 mx-1 text-white" type="submit">
                    Cari
                </button>
            </form>
        </div>
    @endif
    <div class="cart me-5">
        <a class="text-white" href="/carts">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            </svg>
        </a>
    </div>
</div>
