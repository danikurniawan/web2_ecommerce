@extends('layouts.app')

@section('content')
    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-right">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Tambah Produk</a>
                    </div>
    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Harga Total</th>
                                        <th>Status</th>
                                        <th>Kode Pos</th>
                                        <th>Alamat Pengiriman</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach ($order as $orders)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ number_format($orders['total_price']) }}</td>
                                            <td>{{ $orders['status'] }}</td>
                                            <td>{{ $orders['zip_code'] }}</td>
                                            <td>{{ $orders['shipping_address'] }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show',$orders['id'])}}" class="btn btn-primary btn-sm">Detail</a>                                                    
                                            </td>
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