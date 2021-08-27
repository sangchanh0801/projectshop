@extends('frontend.layouts.master')
@section('content-home')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->

<div class="checkout">
    <form>
        @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-inner">
                    <div class="billing-address">
                        <h2>Thông tin giao hàng</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Họ của bạn</label>
                                <input class="form-control shipping_fname" type="text" placeholder="Họ của bạn" name="shipping_fname" >
                            </div>
                            <div class="col-md-6">
                                <label>Tên của bạn</label>
                                <input class="form-control shipping_lname" type="text" placeholder="Tên của bạn" name="shipping_lname" >
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input class="form-control shipping_email" type="text" placeholder="E-mail" name="shipping_email" >
                            </div>
                            <div class="col-md-6">
                                <label>Số điện thoại</label>
                                <input class="form-control shipping_phone" type="text" placeholder="Số điện thoại" name="shipping_phone" >
                            </div>
                            <div class="col-md-12">
                                <label>Địa chỉ giao hàng</label>
                                <input class="form-control shipping_address" type="text" placeholder="Địa chỉ giao hàng" name="shipping_address">
                            </div>
                            @include('frontend.pages.delivery')
                            <div class="col-md-12">
                                <label>Ghi chú</label>
                                <textarea class="form-control shipping_notes" type="text" placeholder="Ghi chú" name="shipping_notes"></textarea>
                            </div>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                @endforeach
                            @else
                                <input type="hidden" name="order_coupon" class="order_coupon" value="0">
                            @endif

                            @if (Session::get('fee'))
                                <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                            @else
                                <input type="hidden" name="order_fee" class="order_fee" value="10000">
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @php
                $total = 0;
            @endphp
            @if (Session::has('cart'))
                @foreach (Session::get('cart') as $cart)
                    @php
                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                    $total += $subtotal;
                    @endphp
                @endforeach
            @endif
            <div class="col-lg-4">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>Tổng đơn hàng</h1>
                            <p>Tổng tiền<span>{{number_format($total,0,',','.')}} VNĐ</span></p>
                                @if (Session::get('fee'))
                                    <p>Phí vận chuyển: <span>{{Session::get('fee')}}VNĐ</span></p>
                                @endif
                                @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key=>$cou)
                                        @if ($cou['coupon_type'] == 1)
                                            <p>Mã giảm giá: <span>{{$cou['coupon_value']}} % </span></p>
                                            @php
                                                $total_coupon = ($total* $cou['coupon_value'])/100;
                                                echo '<p>Tổng giảm:<span> '.number_format($total_coupon, 0, ',', '.') .'  VNĐ</span></p>'
                                            @endphp
                                            <h2>Tổng giảm <span>{{number_format($total-$total_coupon, 0 , ',','.')}}  VNĐ</span></h2>
                                        @elseif ($cou['coupon_type'] == 2)
                                            <p>Mã giảm giá: <span>{{$cou['coupon_value']}} VNĐ</span></p>
                                            @php
                                                $total_coupon =  $cou['coupon_value'];
                                                echo '<p>Tổng giảm:<span> '.number_format($total_coupon, 0, ',', '.') .' VNĐ</span></p>'
                                            @endphp
                                                <h2>Tổng giảm <span>{{number_format($total-$total_coupon, 0 , ',','.')}} VNĐ</span></h2>
                                        @endif
                                    @endforeach
                                @endif
                    </div>
                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <h1>Phương thức thanh toán</h1>
                            <div class="payment-method">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input shipping_method" id="payment-1" name="shipping_method" value="1">
                                    <label class="custom-control-label" for="payment-1">Thanh toán bằng ATM</label>
                                </div>
                                <div class="payment-content" id="payment-1-show">
                                    <p>
                                        Thanh toán bằng ATM
                                    </p>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input shipping_method" id="payment-2" name="shipping_method" value="2">
                                    <label class="custom-control-label" for="payment-2">Thanh toán bằng tiền mặt</label>
                                </div>
                                <div class="payment-content" id="payment-2-show">
                                    <p>
                                       Thanh toán bằng tiền mặt
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn send-order">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
