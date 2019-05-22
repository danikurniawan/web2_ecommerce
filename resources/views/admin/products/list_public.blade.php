@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($product as $idx => $item)

    @if ($idx == 0 || $idx % 4 == 0)
        <div class="row mt-4">
    @endif

        <div class="col">
            <div class="card">
                @if (isset($item->images[0]))
                    <img src="{{ url('images_product/view/'.$item->images[0]->src) }}" class="card-img-top" alt="gambar product">
                @else
                    <img src="{{ url('noImages.jpg') }}" class="card-img-top" alt="gambar product">
                @endif  
                
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ url('product_public/show/'.$item->id)}}">{{ $item->name }}</a>
                    </h5>
                    <p class="card-text">
                        {{ $item->price }}
                    </p>
                    <a href="#" class="btn btn-success">Beli</a>
                    <a href="#" class="btn btn-warning">Add to cart</a>
                </div>
            </div>
        </div>

        @if ($idx > 0 && $idx % 4 == 3)
            </div>
        @endif
    @endforeach
</div>
@endsection