@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if (isset($product->images[0]))
                <img src="{{ url('images_product/view/'.$product->images[0]->src) }}" class="card-img-top" alt="gambar product">
            @else
                <img src="{{ url('noImages.jpg') }}" class="card-img-top" alt="gambar product">
            @endif  

            <div class="row mt-4">
                @foreach($product->images as $image)
                <div class="col-md-6">
                    @auth
                        <img src="{{ url('admin/images_product/view/'.$image->src) }}" class="img-thumbnail">
                    @else
                        <img src="{{ url('images_product/view/'.$image->src) }}" class="img-thumbnail">
                    @endauth
                
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-9">
            <h3>
                {{$product->name}}
            </h3>
            <h4>{{$product->price}}</h4>

            <div class="mt-4">
                <a href="#" class="btn btn-success">Beli</a>
                <a href="#" class="btn btn-warning">Add to cart</a>
            </div>

            <div class="mt-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#description" role="tab" data-toggle="tab">Desktipsi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#review" role="tab" data-toggle="tab">Review</a>
                    </li>
                </ul>

                <div class="tab-content mt-2">
                    <div role="tabpanel" class="tab-pane fade in active show" id="description">
                        {!! $product->description !!}
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="review">
                        Halamam review
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection