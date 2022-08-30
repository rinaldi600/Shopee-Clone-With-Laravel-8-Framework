@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <div class="row" style="min-height: inherit !important">
            <div class="col-12 col-sm-8">
                <h2 class="mt-4 mb-4">Tambah No Rekening</h2>
                <a href="/dashboard_seller/no_rekening" class="btn add-data mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span class="align-middle">kembali</span>
                </a>

                <form action="/getDataRekening" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="atas_name" class="form-label">Atas Nama</label>
                        <input type="text" class="form-control @error('atas_name') is-invalid @enderror" id="atas_name" name="atas_name" value="{{ old('atas_name') }}">
                        @error('atas_name')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_rekening" class="form-label">No Rekening</label>
                        <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}">
                        @error('no_rekening')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn edit-data">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            <span class="align-middle">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
