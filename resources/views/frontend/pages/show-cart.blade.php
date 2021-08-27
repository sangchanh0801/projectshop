@extends('frontend.layouts.master')
@section('content-home')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('viewhome')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Gía</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                            <strong style="color: red">{{session()->get ('mess')}}</strong>
                            @endif
                            <tbody class="align-middle" id="load_cart">
                                @php
                                    $total = 0;
                                @endphp
                            @if (Session::get('cart'))
                                @foreach (Session::get('cart') as $cart)
                                <form action="{{route('upcart')}}" method="post">
                                    @csrf
                                @php
                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="{{$cart['product_image']}}" alt="Image"></a>
                                            <p>{{$cart['product_name']}} </p>
                                        </div>
                                    </td>
                                    <td>{{number_format($cart['product_price'],0,',','.')}} VNĐ</td>
                                    <td>
                                        <div class="qty" id="cart_qty">
                                                <button type="button" class="btn-minus update-to-cart"><i class="fa fa-minus"></i></button>
                                                <input type="text"  name="cart_qty[{{$cart['session_id']}}]"  value="{{$cart['product_qty']}}" >
                                                <button type="button" class="btn-plus update-to-cart" ><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
                                    <td>
                                        <a href="{{route('delcart', $cart['session_id'])}}"><i class="fa fa-trash del-to-cart"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <p>Không có sản phẩm nào</p>
                                @endif
                            </tbody>
                        </table><br>
                        @if (Session::get('cart'))
                        <div class="col-md-12">
                            <button class="btn">Cập nhật giỏ hàng</button>
                        </div>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        @if (Session::get('cart'))
                        <div class="col-md-12">
                            <form action="{{route('checkcoupon')}}" method="POST">
                            @csrf
                            <div class="coupon">
                                <input type="text" placeholder="Nhập mã giảm giá" name="coupon_code">
                                <button>Mã giảm giá</button>
                            </div>
                            </form>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
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
                                                    <h2>Tổng sau giảm <span>{{number_format($total-$total_coupon, 0 , ',','.')}} VNĐ</span></h2>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>
                                @if (Session::get('cart'))
                                    <div class="cart-btn">
                                        <form action="{{route('showcheckout')}}" >
                                            @csrf
                                            <button >Thanh toán</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
