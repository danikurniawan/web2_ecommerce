@extends('layouts.app')

@section('content')
    <div class="container col-md-9">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Edit Produk
                    </div>
    
                    <div class="card-body">

                        @if (count($errors))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label>Nama Product</label>
                                <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Nama Product" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Harga" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" rows="3" id="ckview">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Tambah Image (Multiple)</label><br>
                                <input type="file" name="img_src[]" class="btn btn-info" multiple accept="image/*">
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{url('plugins/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({selector:'#ckview'});</script>
@endpush