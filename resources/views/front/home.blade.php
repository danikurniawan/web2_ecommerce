@extends('front.template')
@section('content')
<div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                <li>
                    <img src="{{ asset('front/img/h4-slide.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            iPhone <span class="primary">6 <strong>Plus</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Dual SIM</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('front/img/h4-slide2.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            by one, get one <span class="primary">50% <strong>off</strong></span>
                        </h2>
                        <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('front/img/h4-slide3.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Select Item</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('front/img/h4-slide4.png') }}" alt="Slide">
                    <div class="caption-group">
                      <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">& Phone</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Product Terbaru</h2>
                    <div class="product-carousel">
                        @foreach($product as $item)
                        <div class="single-product">
                            <div class="product-f-image">
                                @if (isset($item->images[0]))
                                    <img src="{{ url('images_product/view/'.$item->images[0]->src) }}" alt="gambar product" style="weight: 195px; height: 265px">
                                @else
                                    <img src="{{ url('noImages.jpg') }}" alt="gambar product" style="weight: 195px; height: 265px">
                                @endif
                                <div class="product-hover">
                                    <a href="{{ route('carts.add', ['id' => $item->id]) }}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    <a href="{{ url('product_public/show/'.$item->id)}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                </div>
                            </div>
                            
                            <h2><a href="{{ url('product_public/show/'.$item->id)}}">{{ $item->name }}</a></h2>
                            
                            <div class="product-carousel-price">
                                <ins>Rp. {{ number_format($item->price) }}</ins>
                            </div> 
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->
@endsection