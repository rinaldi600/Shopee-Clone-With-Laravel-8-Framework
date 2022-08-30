@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <div class="row" style="min-height: inherit !important">
            <div class="col-12 col-sm-10">
                <h2 class="mt-4 mb-4">Product</h2>
                <a href="/dashboard_seller/product/add_product" class="btn add-data mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    <span class="align-middle">Tambah Data</span>
                </a>
                <div class="col-8">
                    <form action="/dashboard_seller/product" method="get" onkeydown="return event.key != 'Enter';">
                        <div class="input-group mb-3 d-flex gap-2 align-content-center">
                            <input type="text" class="form-control search-keyword" placeholder="Masukkan Keyword" name="keyword" value="{{ request()->input('keyword') ?? '' }}">

                            <select required class="form-select search-filter" id="inputGroupSelect01" name="filter">
                                <option value="Pilih Filter">Pilih Filter</option>
                                <option {{ request()->input('filter') === 'all' ? 'selected' : '' }} value="all">Semua</option>
                                <option {{ request()->input('filter') === 'nama' ? 'selected' : '' }} value="nama">Nama</option>
                                <option {{ request()->input('filter') === 'jumlah' ? 'selected' : '' }} value="jumlah">Jumlah</option>
                                <option {{ request()->input('filter') === 'harga' ? 'selected' : '' }} value="harga">Harga</option>
                            </select>

                            <div class="position-relative">
                                <button class="btn btn search-data block-two" type="submit" id="button-addon2">
                                    Cari
                                </button>
                                <div class="block"></div>
                            </div>

                        </div>
                        <p style="margin-top: -10px" class="text-danger alert-input d-none">Inputan tidak berupa angka</p>
                    </form>
                </div>
                @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                       {{session()->get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5 class="mt-3 mb-3">{{ $dataCount }} Produk</h5>
                <div class="table-responsive">
                    <table style="border: 1px solid rgb(229,229,229)" class="table">
                        <thead style="background-color: rgb(246,246,246)" class="border-0 borderless">
                        <tr style="color: rgb(89,89,126)" class="text-center">
                            <th scope="col">Item</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Berat ( KG )</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="fs-6">
                        @foreach($dataProduct as $product)
                            <tr class="align-middle text-center">
                                <td class="image-product-sold">
                                    <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$product->image) }}" alt="">
                                </td>
                                <td>{{ $product->name_product }}</td>
                                <td>{{ $product->weight }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                                <td class="text-center">{{ $product->quantity >= 1 ? 'Ada' : 'Habis'  }}</td>
                                <td>
                                    <form class="mb-2" action="/delete_product" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="idProduct" value="{{ $product->id_product }}">
                                        <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn delete-data align-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                            <span class="align-middle">Delete</span>
                                        </button>
                                    </form>
                                    <a href="/dashboard_seller/product/update_product/{{ \Illuminate\Support\Facades\Crypt::encryptString($product->id_product) }}" class="btn edit-data">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                        <span class="align-middle">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $dataProduct->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
