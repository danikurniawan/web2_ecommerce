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
                        @if (Session::get('success'))
                            <div class="form-group">
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="row pull-right" style="margin-bottom: 25px">
                            <div class="col-md-9 text-right">Sort : </div>
                            <div class="col-md-3">
                                <select class="form-control" id="orderBy" onchange="orderBy()">
                                    <option value="" {{ $orderBy == '' ? 'selected' : ''}}></option>
                                    <option value="best_seller" {{ $orderBy == 'best_seller' ? 'selected' : ''}}>Best Seller</option>
                                    <option value="rating_terbaik" {{ $orderBy == 'rating_terbaik' ? 'selected' : ''}}>Rating Terbaik</option>
                                    <option value="termurah" {{ $orderBy == 'termurah' ? 'selected' : ''}}>Termurah</option>
                                    <option value="termahal" {{ $orderBy == 'termahal' ? 'selected' : ''}}>Terahal</option>
                                    <option value="terbaru" {{ $orderBy == 'terbaru' ? 'selected' : ''}}>Terbaru</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm" id="tblProduct">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach ($product as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                    <form action="{{ route('admin.product.destroy', $item->id)}}" onsubmit="return  cekSubmit(this)" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.product.show',$item->id)}}" class="btn btn-primary btn-sm">Detail</a>
                                                        <a href="{{ route('admin.product.edit',$item->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    </form>
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

    <script>
    function cekSubmit(sender)
    {
        if(confirm('Anda Yakin ?'))
        {
            sender.submit();
        }
    
        return false;
    }

    function orderBy()
    {
        $("#tblProduct").find('tbody').empty();
        var orderBy = $("#orderBy").val();
        $.ajax({
            type: "GET",
            url: "{{url('admin/product')}}",
            data: {
                orderBy : orderBy
            },
            dataType: "json",
            success: function (response) {
                var produks = "";
                var no = 1;
                $.each(response, function(i, val){
                    var urlDetail = "{{ url('admin/product')}}/" + val.id ;
                    var urlEdit = "{{ url('admin/product')}}/" + val.id +"/edit";
                    var urlDelete = "{{ url('admin/product')}}/" + val.id +"/delete";

                    produks += '<tr>\
                                    <td>' + no +'</td>\
                                    <td>' + val.name +'</td>\
                                    <td>' + val.price +'</td>\
                                    <td>\
                                            <a href="'+urlDetail+'" class="btn btn-primary btn-sm">Detail</a>\
                                            <a href="'+urlEdit+'" class="btn btn-warning btn-sm">Edit</a>\
                                            <a href="'+urlDelete+'" class="btn btn-danger btn-sm">Delete</a>\
                                    </td>\
                                </tr>';

                    no++;
                });
                $("#tblProduct").find('tbody').append(produks);
            },
            error: function(){
                console.log('Ajax Error');
            }
        });

    }
    </script>
@endsection