@extends('DashboardSeller.MainDashboard')

@section('content')

    <div style="min-height: 100vh" class="home-seller container overflow-auto">
        <div class="row" style="min-height: inherit !important">
            <div class="col-12 col-sm-8">
                <h2 class="mt-4">Recently Added</h2>
                <div class="recently-added overflow-scroll p-4">
                    <div class="row list-recently d-flex gap-1 flex-nowrap">
                        @foreach($dataProduct as $product)
                            <div style="width: 50%" class="item-sold card p-2">
                                <div class="image-product">
                                    <img class="img-thumbnail rounded-start" src="{{ asset('storage/' . $product['image']) }}" alt="...">
                                </div>
                                <div class="detail-product p-2">
                                    <h5 class="card-title">{{ $product['name_product'] }}</h5>
                                    <h6 style="color: rgb(252,89,49);" class="card-text fw-bold">Rp. {{ number_format($product['price'],0,',','.') }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <h2 class="mt-4 mb-4">Recent Order</h2>
                <div class="table-responsive">
                    <table style="border: 1px solid rgb(229,229,229)" class="table">
                        <thead style="background-color: rgb(246,246,246)" class="border-0 borderless">
                            <tr style="color: rgb(89,89,126)" class="text-center">
                                <th scope="col">Item</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Buyer</th>
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @foreach($dataOrder as $order)
                                <tr class="align-middle text-center">
                                    <td class="image-product-sold">
                                        <img class="img-thumbnail img-fluid" src="{{ asset('storage/' . $order->product->image) }}" alt="">
                                        <span>{{ $order->product->name_product }}</span>
                                    </td>
                                    <td>{{ date('Y/m/d', strtotime($order['updated_at'] )) }}</td>
                                    <td>{{ date('H:i', strtotime($order['updated_at'] )) }}</td>
                                    <td>{{ $order->buyer->name_buyer }}</td>
                                    <td class="text-center">
                                        <button class="status-order" type="button">{{ $order['status_order'] }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <h2 class="mt-4">Income</h2>
                <h4 style="color: rgb(252,89,49);" class="mt-4 mb-3 fw-bold">Rp. 120.000</h4>
                <div class="chart-container" style="height: 50vh">
                    <canvas style="height: 40vh" id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
