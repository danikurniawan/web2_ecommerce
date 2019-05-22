@extends('front.template')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Checkout</h2>
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
                        <div class="woocommerce">

                            <form enctype="multipart/form-data" action="{{ route('admin.orders.store') }}" class="checkout" method="post" name="checkout">
                                {{ csrf_field() }}
                                <div id="customer_details">
                                    <div class="col-md-4">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Shipping Details</h3>

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">Nama<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <label>{{ Auth::user()->name }}</label>
                                            </p>

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">Alamat<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <textarea class="form0-control" name="shipping_address" required></textarea>
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="" for="billing_last_name">Desa/Kelurahan <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" class="form0-control" name="kelurahan" required>
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="billing_company">Kecamatan <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" name="kecamatan" class="form0-control" required>
                                            </p>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Kota <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="kota" class="form0-control" required>
                                            </p>

                                            <p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_city">Provinsi <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="provinsi" class="form0-control" required>
                                            </p>

                                            <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                                <label class="" for="billing_state">No Telp <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" name="phone_number" class="form0-control" required>
                                            </p>
                                            <p id="billing_postcode_field" class="form-row form-row-last address-field validate-required validate-postcode" data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                                <label class="" for="billing_postcode">Kode Pos <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="zip_code" class="form0-control" required>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                            <h3 id="order_review_heading">Pesanan Anda</h3>

                                            <div id="order_review" style="position: relative;">
                                                <table class="shop_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-name">Product</th>
                                                            <th class="product-total">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($cart as $item)
                                                        @php
                                                            $total += $item['quantity'] * $item['price'];
                                                        @endphp
                                                            <tr class="cart_item">
                                                                <td class="product-name">
                                                                    {{$item['name']}} <strong class="product-quantity">× {{$item['quantity']}}</strong> </td>
                                                                <td class="product-total">
                                                                    <span class="amount">{{number_format($item['price'])}}</span> </td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                    <tfoot>            
            
                                                        <tr class="order-total">
                                                            <th>Order Total</th>
                                                            <td><strong><span class="amount">{{ number_format($total) }}</span></strong> </td>
                                                        </tr>
            
                                                    </tfoot>
                                                </table>
            
            
                                                <div id="payment">
            
                                                    <div class="form-row place-order">            
                                                        <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="btn btn-success btn-block">           
                                                    </div>
            
                                                    <div class="clear"></div>            
                                                </div>
                                            </div>
                                    </div>
                                </div>                                
                            </form>

                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection

@section('tambahan_js')
@endsection