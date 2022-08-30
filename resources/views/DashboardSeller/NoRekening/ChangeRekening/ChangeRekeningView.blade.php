@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <div class="row" style="min-height: inherit !important">
            <div class="col-12 col-sm-8">
                <h2 class="mt-4 mb-4">Edit No Rekening</h2>
                <a href="/dashboard_seller/no_rekening" class="btn add-data mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span class="align-middle">kembali</span>
                </a>

                <form action="/getNewDataRekening" method="post">
                    @csrf
                    <input type="hidden" name="oldNumberAccount" value="{{ $detailRekening['number_account'] }}">
                    <input type="hidden" name="idAccount" value="{{ $detailRekening['id_account'] }}">
                    <div class="mb-3">
                        <label for="atas_name" class="form-label">Atas Nama</label>
                        <input type="text" class="form-control @error('atas_name') is-invalid @enderror" id="atas_name" name="atas_name" value="{{ old('atas_name',$detailRekening['name']) }}">
                        @error('atas_name')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_rekening" class="form-label">No Rekening</label>
                        <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ old('no_rekening', $detailRekening['number_account']) }}">
                        @error('no_rekening')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn edit-data">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                            <span class="align-middle">Ubah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
