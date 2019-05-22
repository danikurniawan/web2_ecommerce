@extends('layouts.app')

@section('content')
    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Detail Order
                    </div>
    
                    <div class="card-body">
                        <table class="" width="100%">
                            <tr>
                                <td width="20%">Alamat</td>
                                <td>: {{$order->shipping_address}}</td>
                            </tr>

                            <tr>
                                <td width="20%">Desa / Kelurahan</td>
                                <td>: {{$order->kelurahan}}</td>
                            </tr>

                            <tr>
                                <td width="20%">Kecamatan</td>
                                <td>: {{$order->kecamatan}}</td>
                            </tr>

                            <tr>
                                <td width="20%">Kota</td>
                                <td>: {{$order->kota}}</td>
                            </tr>

                            <tr>
                                <td width="20%">Provinsi</td>
                                <td>: {{$order->provinsi}}</td>
                            </tr>

                            <tr>
                                <td width="20%">No HP</td>
                                <td>: {{$order->phone_number}}</td>
                            </tr>

                            <tr>
                                <td width="20%">Kode Pos</td>
                                <td>: {{$order->zip_code}}</td>
                            </tr>
                        </table>

                        <hr>
                        <h4>Product Pesanan</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $orders)
                                        <tr>
                                            <td align="center">
                                                @if (isset($orders->product->images[0]->src))
                                                    <img src="{{ url('images_product/view/'.$orders->product->images[0]->src) }}" alt="gambar product" style="width: 145px; height: 145px">
                                                @else
                                                    <img src="{{ url('noImages.jpg') }}" alt="gambar product" style="width: 145px; height: 145px">
                                                @endif
                                            </td>
                                            <td>{{ $orders->price }}</td>
                                            <td>{{ $orders->quantity }}</td>
                                            <td>{{ $orders->price * $orders->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection