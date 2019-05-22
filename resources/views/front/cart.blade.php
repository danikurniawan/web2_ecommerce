@extends('front.template')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Carts</h2>
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

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">                               
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce" style="overflow-x: auto">
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">#</th>
                                        <th class="product-thumbnail">Photo</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $total = 0;
                                    @endphp

                                    @if (session('cart'))

                                    @foreach (session('cart') as $id => $product)
                                    
                                    @php
                                        $total += $product['price'] * $product['quantity'];
                                    @endphp

                                    <tr class="cart_item">
                                        <td class="">
                                            <a title="Update this item" class="btn btn-success update-cart" data-id="{{$id}}" href="#"><i class="fa fa-check"></i></a>
                                            <a title="Remove this item" class="btn btn-danger remove-from-cart" data-id="{{$id}}" href="#"><i class="fa fa-trash"></i></a> 
                                        </td>

                                        <td class="product-thumbnail">
                                            @if (isset($product['image_url'][0]))
                                                <img src="{{ url('images_product/view/'.$product['image_url'][0]->src) }}" alt="gambar product" style="width: 145px; height: 145px">
                                            @else
                                                <img src="{{ url('noImages.jpg') }}" alt="gambar product" style="width: 145px; height: 145px">
                                            @endif
                                            
                                        </td>

                                        <td class="product-name">
                                            {{$product['name']}} 
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">{{number_format($product['price'])}}</span> 
                                        </td>

                                        <td class="product-quantity text-center" data-th="Quantity">
                                            <input type="number" class="form-control quantity" title="Qty" value="{{ $product['quantity'] }}" min="0" step="1" >
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{number_format($product['price'] * $product['quantity'])}}</span> 
                                        </td>
                                    </tr>
                                        
                                    @endforeach
                                        
                                    @endif
                                    
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <a href="{{ url('/') }}" class="btn btn-info">Lanjtukan Belanja</a>
                                            @if (session('cart'))
                                            <a href="{{ route('admin.orders.create') }}" class="btn btn-success">Lanjtukan Ke Pembayaran</a>
                                            
                                            @endif
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">
                        <div class="cart_totals ">
                            <table cellspacing="0">
                                <tbody>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">{{ number_format($total) }}</span></strong> </td>
                                    </tr>
                                </tbody>
                            </table>
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
<script>
$(document).ready(function(){
    $(".update-cart").click(function(e){
        e.preventDefault();

        var vm = $(this);

        $.ajax({
            url: "{{ route('carts.update') }}",
            method: "patch",
            data: {_token: '{{csrf_token()}}', id: vm.attr("data-id"), quantity: vm.parents("tr").find('.quantity').val()},
            success: function(res) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function(e){
        e.preventDefault();

        var vm = $(this);

        if(confirm("Anda Yakin ?"))
        {
            $.ajax({
                url: "{{ route('carts.remove') }}",
                method: "DELETE",
                data: {_token: '{{csrf_token()}}', id: vm.attr("data-id")},
                success: function(res) {
                    window.location.reload();
                }
            });
        }
        
    });
});
</script>
@endsection