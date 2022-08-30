@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <h2 class="mt-4 mb-4">Rekening</h2>

        @if($message = \Illuminate\Support\Facades\Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="/dashboard_seller/add_rekening" class="btn add-data mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            <span class="align-middle">Tambah Data</span>
        </a>
        <div class="table-responsive">
            <table class="table">
                <thead style="background-color: rgb(246,246,246)" class="border-0 borderless">
                <tr style="color: rgb(89,89,126)" class="text-center align-middle">
                    <th scope="col">No Rekening</th>
                    <th scope="col">Atas Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataRekening as $rekening)
                    <tr class="text-center">
                        <td>{{ $rekening['number_account'] }}</td>
                        <td>{{ $rekening['name'] }}</td>
                        <td>
                            <a class="btn btn-warning d-inline-block" href="/dashboard_seller/change_rekening/{{ \Illuminate\Support\Facades\Crypt::encryptString($rekening['id_account']) }}">Ubah</a>
                            <form class="d-inline-block" action="/deleteDataRekening" method="post">
                                @csrf
                                <input type="hidden" name="idAccount" value="{{ $rekening['id_account'] }}">
                                <button onclick="return confirm('Apakah anda ingin menghapus data rekening ini ? ')" class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
