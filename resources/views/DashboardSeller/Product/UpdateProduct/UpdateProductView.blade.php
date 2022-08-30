@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <div class="row" style="min-height: inherit !important">
            <div class="col-12 col-sm-8">
                <h2 class="mt-4 mb-4">Ubah Product Baru</h2>
                <a href="/dashboard_seller/product" class="btn add-data mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span class="align-middle">kembali</span>
                </a>
                <form action="/updateDataProduct" enctype="multipart/form-data" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="idProduct" value="{{ $detailProduct->id_product }}">
                    <input type="hidden" name="oldUrlImage" value="{{ $detailProduct->image }}">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name_product') is-invalid @enderror" id="nama" name="name_product" value="{{ old('name_product',$detailProduct->name_product) }}">
                        @error('name_product')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="floatingTextarea2" placeholder="Deskripsi" style="height: 100px" name="description">{{ old('description', $detailProduct->description) }}</textarea>
                        <label for="floatingTextarea2">Deskripsi</label>
                        @error('description')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control price-input @error('price') is-invalid @enderror" id="harga" name="price" value="{{ old('price', number_format($detailProduct->price,0,'','.')) }}">
                        @error('price')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Berat ( Kg )</label>
                        <input type="text" class="form-control price-input @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $detailProduct->weight) }}">
                        @error('weight')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="jumlah" name="quantity" value="{{ old('quantity', $detailProduct->quantity) }}">
                        @error('quantity')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="preview">
                            <img style="width: 200px; height: 200px" src="{{ asset('storage/'. $detailProduct->image) }}" class="img-thumbnail" alt="Preview Produk">
                            <div style="color: red" class="mt-1 alert-format d-none">
                                Format harus image
                            </div>
                        </div>
                        <label for="formFile" class="form-label mt-2">Preview</label>
                        <input class="form-control preview-image @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                        @error('image')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn edit-data">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            <span class="align-middle">Ubah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
