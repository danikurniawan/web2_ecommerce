@extends('front.template')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 25px">
    <div class="row well text-right">
        <div class="col-md-9 text-right">
            <label>Sorting :</label>
        </div>
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
</div>
<div class="text-center" id="spinner" style="display: none"><i class="fa fa-refresh fa-spin fa-2x"></i></div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row" id="listProduct">
            @foreach($product as $item)
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper" style="weight: 195px; height: 265px">
                        @if (isset($item->images[0]))
                            <img src="{{ url('images_product/view/'.$item->images[0]->src) }}" alt="gambar product" style="weight: 195px; height: 265px">
                        @else
                            <img src="{{ url('noImages.jpg') }}" alt="gambar product" style="weight: 195px; height: 265px">
                        @endif
                    </div>
                    <h2><a href="{{ url('product_public/show/'.$item->id)}}">{{ $item->name }}</a></h2>
                    <div class="product-carousel-price">
                        <ins>Rp. {{ number_format($item->price) }}</ins>
                    </div>  
                    
                    <div class="product-option-shop">
                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('carts.add', ['id' => $item->id]) }}">Add to cart</a>
                    </div>                       
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('tambahan_js')
    <script>
    function orderBy()
    {
        $("#spinner").show();
        $("#listProduct").empty();
        var orderBy = $("#orderBy").val();
        $.ajax({
            type: "GET",
            url: "{{url('product_public')}}",
            data: {
                orderBy : orderBy
            },
            dataType: "json",
            success: function (response) {
                var produks = "";
                var urlGambar = "{{ url('images_product/view') }}";
                $("#spinner").hide();

                $.each(response, function(i, val){
                    
                    var urlAddCart = "{{ url('carts/add') }}/"+val.id;
                    var urlDetail = "{{ url('product_public/show')}}/" + val.id ;
                    if(val.images.length > 0)
                    {
                        gambar = "<img src=" + urlGambar + '/' + val.images[0].src + " alt='gambar product' style='weight: 195px; height: 265px'>";
                    }else{
                        gambar = '<img src="{{ url("noImages.jpg") }}" alt="gambar product" style="weight: 195px; height: 265px">';
                    }

                    produks += '<div class="col-md-3 col-sm-6">\
                                    <div class="single-shop-product">\
                                        <div class="product-upper" style="weight: 195px; height: 265px">\
                                            ' + gambar + '\
                                        </div>\
                                        <h2><a href="'+urlDetail+'">' + val.name + '</a></h2>\
                                        <div class="product-carousel-price">\
                                            <ins>Rp. ' + val.price.toFixed(2) + '</ins>\
                                        </div>\
                                        <div class="product-option-shop">\
                                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="'+urlAddCart+'">Add to cart</a>\
                                        </div></div>\
                                </div>';

                });
                $("#listProduct").append(produks);
            },
            error: function(){
                $("#spinner").hide();
                console.log('Ajax Error');
            }
        });

    }
    </script>
@endsection