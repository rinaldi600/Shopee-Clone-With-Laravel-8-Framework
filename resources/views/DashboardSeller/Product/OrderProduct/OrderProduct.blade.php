@extends('DashboardSeller.MainDashboard')

@section('content')
    <div style="min-height: 100vh" class="container">
        <h2 class="mt-4 mb-4">Data Order</h2>
        <form action="/dashboard_seller/order_product" method="get">
            @csrf
            <div class="mb-3 col-11 col-sm-6 d-flex gap-1">
                <input type="text" name="keyword" class="form-control @if(request()->input('keyword')) pe-none @else d-none @endif" placeholder="Cari Data" value="{{ request()->input('keyword') }}">
                <input type="date" name="keywordDate" class="form-control @if(request()->input('keywordDate')) pe-none @else d-none @endif" value="{{ request()->input('keywordDate') }}">

                <select name="keywordStatus" class="form-select @if(request()->input('keywordStatus') && request()->input('keywordStatus') !== 'Status') pe-none @else d-none @endif" aria-label="Default select example">
                    <option>Status</option>
                    <option  @if(request()->input('keywordStatus') && request()->input('keywordStatus') === 'confirmed') selected @endif value="confirmed">Confirmed</option>
                    <option @if(request()->input('keywordStatus') && request()->input('keywordStatus') === 'pending') selected @endif value="pending">Pending</option>
                    <option @if(request()->input('keywordStatus') && request()->input('keywordStatus') === 'rejected') selected @endif value="rejected">Rejected</option>
                </select>

                <select class="form-select filter-search-data @if(request()->input('filter')) pe-none @endif" name="filter" aria-label="Default select example">
                    <option value="filter">Filter</option>
                    <option @if(request()->input('filter') === 'status-order') selected @endif value="status-order">Status Order</option>
                    <option @if(request()->input('filter') === 'tanggal-pemesanan') selected @endif value="tanggal-pemesanan">Tanggal Pemesanan</option>
                    <option @if(request()->input('filter') === 'nama-produk') selected @endif value="nama-produk">Nama Produk</option>
                </select>
                @if(request()->input('filter'))
                    <a style="width: 300px" class="btn btn-outline-secondary d-flex align-items-center" href="/dashboard_seller/order_product">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                        <span>Reset Filter</span>
                    </a>
                @else
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                @endif
            </div>
        </form>

        <div class="loading-update-note d-none">

        </div>

        @if($message = \Illuminate\Support\Facades\Session::get('success'))
            <div class="alert alert-success col-6" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="mt-3 table-responsive">
            <table class="table">
                <thead style="background-color: rgb(246,246,246)" class="border-0 borderless">
                <tr style="color: rgb(89,89,126)" class="text-center align-middle">
                    <th scope="col">ID Order</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Pesanan</th>
                    <th scope="col">Harga Total Pesanan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Bukti Pembayaran</th>
                    <th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @if($dataOrder->count() <= 0)
                    <td colspan="9" class="text-center">
                        <img src="/icons/browser.png" alt="">
                        <span class="d-block mt-1 fw-bold">Data tidak ditemukan</span>
                    </td>
                @else
                    @foreach($dataOrder as $order)
                        <tr class="text-center">
                            <td class="align-middle">
                                <input type="hidden" value="{{ $order['id_order'] }}">
                                <span>{{ $order['id_order'] }}</span>
                            </td>
                            <td class="align-middle">
                                <img class="d-inline-block rounded" style="max-width: 10%; max-height: 10%" src="{{ asset('storage/' . $order->product->image) }}" alt="">
                                <span class="d-inline-block">{{ $order->product->name_product }}</span>
                            </td>
                            <td class="align-middle">
                                <span>{{ $order['total_order'] }}</span>
                            </td>
                            <td class="align-middle">
                                <span>Rp {{number_format($order['price_order'],0,',','.')}}</span>
                            </td>
                            <td class="align-middle">
                                <span class="@if($order['status_order'] === 'confirmed') bg-success text-white @elseif($order['status_order'] === 'pending') bg-warning @else bg-danger text-white @endif p-2 rounded-1">{{ $order['status_order'] }}</span>
                            <td class="notes-container align-middle">
                                <span class="notes">{{ $order['notes'] }}</span>
                                <input class="change-notes d-none" type="text" placeholder="Masukkan Catatan">
                            </td>
                            <td class="align-middle">
                                @if($order['proof_payment'] !== 'Belum ada bukti pembayaran')
                                    <img class="d-inline-block mb-1" style="max-width: 20%; max-height: 20%" src="{{ asset('storage/' . $order['proof_payment']) }}" alt="">
                                    <button onclick="return confirm('Apakah Anda Yakin ?')" class="view-proof-payment btn btn-outline-secondary" type="button">Zoom Image</button>
                                @else
                                    <span>Belum Ada bukti Pembayaran</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <span>{{ $order['created_at'] }}</span>
                            </td>
                            <td class="align-middle">
                                @if($order['status_order'] === 'confirmed')
                                    <form class="float-start mb-2" action="/confirm_order" method="post">
                                        @csrf
                                        <input type="hidden" name="idOrder" value="{{ $order['id_order'] }}">
                                        <input type="hidden" name="cancel" value="rejected">
                                        <script>
                                            function alertData() {
                                                return confirm('Apakah anda yakin ingin membatalkan order ?');
                                            }
                                        </script>
                                        <button class="btn btn-danger d-flex align-items-center gap-1" onclick="return alertData()" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg align-middle" viewBox="0 0 16 16">
                                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                            </svg>
                                            <span class="d-inline-block align-middle">Cancel Order</span>
                                        </button>
                                    </form>
                                @else
                                    <form class="float-start mb-2" action="/confirm_order" method="post">
                                        @csrf
                                        <input type="hidden" name="idOrder" value="{{ $order['id_order'] }}">
                                        <input type="hidden" name="confirm" value="confirmed">
                                        <script>
                                            function alertData() {
                                                return confirm('Apakah anda yakin ingin konfirmasi order ?');
                                            }
                                        </script>
                                        <button class="btn btn-success d-flex align-items-center gap-1" onclick="return alertData()" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg align-middle" viewBox="0 0 16 16">
                                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                            </svg>
                                            <span class="d-inline-block align-middle">Confirm Order</span>
                                        </button>
                                    </form>
                                @endif

                                @if($order['status_order'] !== 'confirmed')
                                    <form class="float-start" action="/confirm_order" method="post">
                                        <input type="hidden" name="idOrder" value="{{ $order['id_order'] }}">
                                        <select class="form-select status-order-other" name="other" aria-label="Default select example">
                                            <option>Pilih</option>
                                            @if($order['status_order'] === 'pending')
                                                <option value="rejected">Rejected</option>
                                            @endif
                                        </select>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{ $dataOrder->links() }}
        </div>
    </div>
@endsection
