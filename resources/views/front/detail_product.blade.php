@extends('front.template')

@section('tambahan_css')
<style>
    .mb30{
        margin-bottom: 20px;
    }
    .star-rating {
      line-height:32px;
      font-size:1.25em;
    }
    
    .star-rating .fa-star{color: orange;}
</style>
@endsection
@section('content')
<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Detail Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if (Session::get('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger">
            {!! Session::get('error') !!}
        </div>
    @endif
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">                
                <div class="col-md-12">
                    <div class="product-content-right">
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        @if (isset($product->images[0]))
                                            <img src="{{ url('images_product/view/'.$product->images[0]->src) }}" alt="gambar product">
                                        @else
                                            <img src="{{ url('noImages.jpg') }}" alt="gambar product">
                                        @endif
                                    </div>
                                    
                                    <div class="product-gallery">
                                        @foreach($product->images as $image)
                                            @auth
                                                <img src="{{ url('admin/images_product/view/'.$image->src) }}">
                                            @else
                                                <img src="{{ url('images_product/view/'.$image->src) }}">
                                            @endauth
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-8">
                                <div class="product-inner">
                                     {{-- Rating --}}
                                    <div class="star-rating">
                                        <span class="fa fa-star{{$rating >= 1 ? '' : '-o'}}" data-rating="1"></span>
                                        <span class="fa fa-star{{$rating >= 2 ? '' : '-o'}}" data-rating="2"></span>
                                        <span class="fa fa-star{{$rating >= 3 ? '' : '-o'}}" data-rating="3"></span>
                                        <span class="fa fa-star{{$rating >= 4 ? '' : '-o'}}" data-rating="4"></span>
                                        <span class="fa fa-star{{$rating >= 5 ? '' : '-o'}}" data-rating="5"></span>
                                     </div>
                                    <h2 class="product-name">{{$product->name}}</h2>
                                   
                                    <div class="product-inner-price">
                                        <ins>Rp. {{ number_format($product->price) }}</ins>
                                    </div>    
                                    
                                    <form action="" class="cart">
                                        {{-- <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div> --}}
                                        
                                        <a href="{{ route('carts.add', ['id' => $product->id]) }}" class="add_to_cart_button"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    </form>   

                                    <div class="product-inner-category">
                                        
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('admin.product.show', ['id' => $product->id]) }}" class="btn btn-default" target="_blank"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/intent/tweet?=my share text&amp;url={{ route('admin.product.show', ['id' => $product->id]) }}" class="btn btn-default" target="_blank"><i class="fa fa-twitter"></i></a>
                                        <a href="http://wa.me/?text={{ route('admin.product.show', ['id' => $product->id]) }}" class="btn btn-default" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('admin.product.show', ['id' => $product->id]) }}" class="btn btn-default" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2> 
                                                {!! $product->description !!}
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                @auth

                                                <h2>Reviews</h2>
                                                <form action="{{url('simpan_review')}}" method="POST">
                                                <div class="submit-review">
                                                    <div class="rating-chooser">
                                                        <p>Rating anda</p>                                                        
                                                        @csrf
                                                        <input type="text" class="form-control" value="0" id="rating" name="rating">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">                                                        
                                                    </div>
                                                    <p>
                                                        <label for="review">Review anda</label> 
                                                        <textarea name="description" cols="30" rows="10" id="ckview"></textarea>
                                                    </p>
                                                    <p><button type="submit" class="btn btn-success">Kirim</button></p>
                                                </div>
                                                </form>
                                                <hr>
                                                @else

                                                <div class="well text-center">
                                                    Anda Harus <a href="{{ url('/login') }}">Login</a> 
                                                </div>
                                                @endauth

                                                @foreach($review as $r)
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img src="{{ asset('front/img/avatar5.png') }}" class="img img-rounded img-fluid"/>
                                                                <p class="text-secondary text-center">{{ $r->created_at->diffForHumans() }}</p>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <p><strong>{{ $r->user->name ?? ''}}</strong></p>
                                                                <p>{!! $r->description !!}</p>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tambahan_js')
<script src="{{URL::asset('js/rating.js')}}"></script>
<script src="{{url('plugins/tinymce/tinymce.min.js')}}"></script>
<script>
$("#rating").rating();
tinymce.init({selector:'#ckview'});
</script>
@endsection