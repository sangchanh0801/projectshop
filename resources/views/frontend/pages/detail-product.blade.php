@extends('frontend.layouts.master')
@section('content-home')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->
    <!-- Product Detail Start -->

<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                @foreach ($detail_product as  $pro)
                <div class="product-detail-top">
                        @if (session()->has('error'))
                        {{session()->get('error')}}
                        @endif
                        @if (session()->has('success'))
                        {{session()->get('success')}}
                        @endif
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="{{asset($pro->product_image)}}" alt="Product Image">
                                @foreach ($gallery as $gal)
                                <img src="{{asset($gal->gallery_image)}}" alt="Product Image">
                                @endforeach
                            </div>
                            <div class="product-slider-single-nav normal-slider">
                                <div class="slider-nav-img"><img src="{{asset($pro->product_image)}}" alt="Product Image"></div>
                                @foreach ($gallery as $gal)
                                <div class="slider-nav-img"><img src="{{asset($gal->gallery_image)}}" alt="Product Image"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2>{{$pro->product_name}}</h2></div>
                                <div class="ratting">
                                    @for($count = 1; $count<=5; $count++)
                                        @php
                                            if($count<=$rating){
                                                $color = 'color: red';
                                            }else {
                                                $color = 'color: gray';
                                            }
                                        @endphp
                                    <i class="fa fa-star"  style="{{$color}}"></i>
                                    @endfor
                                </div>
                                <div class="price">
                                    <h4>Gía:</h4>
                                    <p>{{number_format($pro->product_price)}} VNĐ</p>
                                </div>
                                <form action="{{route('addcartajax')}}" method="POST">
                                @csrf
                                <div class="quantity">
                                    <h4>Số lượng:</h4>
                                    <div class="qty">
                                        <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1" class="cart_product_qty_{{$pro->product_id}}" name="cart_product_qty">
                                        <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                @if($pro->product_size)
                                <div class="p-size">
                                    <h4>Size:</h4>
                                    <div class="btn-group btn-group-sm">
                                    <ul>
                                        @php
                                        $sizes=explode(',',$pro->product_size);
                                        @endphp
                                    @foreach($sizes as $size)
                                    <li style="list-style: none"><a href="#" class="btn">{{$size}}</a></li>
                                    </ul>
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                                <div class="action">
                                    <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}" name="cart_product_id">
                                    <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}" name="cart_product_name">
                                    <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}" name="cart_product_image">
                                    <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}" name="cart_product_price">
                                    <input type="hidden" value="{{$pro->product_number}}" class="cart_product_number_{{$pro->product_id}}">
                                    <input type="hidden" value="{{$pro->product_size}}" class="cart_product_id_{{$pro->product_id}}" name="cart_product_id">
                                    <input type="hidden" name="productid_hidden" value="{{$pro->product_id}}">
                                    <button type="button" class="btn add-to-cart" name="add-to-cart" data-id_product="{{$pro->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                    <button type="submit" class="btn"><i class="fa fa-shopping-bag"></i>Mua ngay</a>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#specification">Nội dung sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reviews">Đánh giá sản phẩm</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <h4>Mô tả sản phẩm </h4>
                                <p>
                                    {!! html_entity_decode($pro->product_desc) !!}
                                </p>
                            </div>
                            <div id="specification" class="container tab-pane fade">
                                <h4>Nội dung sản phẩm</h4>
                                <p>{!! html_entity_decode($pro->product_content) !!}</p>
                            </div>
                            <div id="reviews" class="container tab-pane fade">
                                <form>
                                    @csrf
                                    <div id="show_product_comment"></div>
                                    <input type="hidden" name="product_id" class="product_id" value="{{$pro->product_id}}">
                                </form>
                                @auth
                                <form>
                                    @csrf
                                    <div class="reviews-submit">
                                        <h4>Để lại bình luận</h4>
                                        <div class="ratting">
                                            @for($count = 1; $count<=5; $count++)

                                            <i class="fa fa-star rating"  style="cursor:pointer;font-size: 30px; "
                                            data-index ="{{$count}}"
                                            id = "{{$pro->product_id}}-{{$count}}"
                                            data-product_id = "{{$pro->product_id}}"
                                            data-rating = "{{$rating}}">
                                            </i>
                                            @endfor
                                        </div>
                                        <div class="row form">
                                            <div class="col-sm-12">
                                                <input type="hidden" class="product_id" value="{{$pro->product_id}}">
                                                <textarea placeholder="Bình luận" class="product_comment"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="button" class="send_product_comment">Bình luận</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <p class="text-center p-5">
                                    Bạn cần <a href="{{route('logincheckout')}}" style="color:rgb(54, 54, 204)">Đăng nhập</a> hoặc <a style="color:blue" href="{{route('logincheckout')}}">Đăng kí</a> để bình luận.
                                </p>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="product">
                    <div class="section-header">
                        <h1>Sản phẩm liên quan</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">
                        @foreach ($relate_product as $product)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="{{route('detailproduct', $product->product_id)}}">{{$product->product_name}}</a>
                                    <div class="ratting">
                                        @php
                                        $product_id = $product->product_id;
                                        $rating = DB::table('ratings')->where('product_id', $product_id)->avg('rating');
                                        $rating = round($rating);
                                        @endphp
                                    @for($count = 1; $count<=5; $count++)
                                            @php
                                                if($count<=$rating){
                                                    $color = 'color: red';
                                                }else {
                                                    $color = 'color: gray';
                                                }
                                            @endphp
                                        <i class="fa fa-star"  style="{{$color}}"></i>
                                    @endfor
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="{{route('detailproduct', $product->product_id)}}">
                                        <img src="{{$product->product_image}}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <form>
                                        @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_number}}" class="cart_product_number_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                            <button type="button" class="add-to-cart" name="add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-cart-plus"></i></button>
                                        </form>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="{{route('detailproduct', $product->product_id)}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3>{{number_format($product->product_price)}} <span>VNĐ</span></h3>
                                    <form action="{{route('addcartajax')}}" method="POST">
                                        @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}" name="cart_product_id">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}" name="cart_product_name">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}"  name="cart_product_image">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}"  name="cart_product_price">
                                            <input type="hidden" value="{{$product->product_number}}" class="cart_product_number_{{$product->product_id}}"  name="cart_product_number">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}"  name="cart_product_qty">
                                            <button type="submit" class="btn"><i class="fa fa-shopping-bag"></i>Mua ngay</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <!-- Side Bar Start -->
            @include('frontend.layouts.sidebar')
            <!-- Side Bar End -->
        </div>
    </div>
</div>

            <!-- Brand Start -->
            <div class="brand">
                <div class="container-fluid">
                    <div class="brand-slider">
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-1.png')}}" alt=""></div>
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-2.png')}}" alt=""></div>
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-3.png')}}" alt=""></div>
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-4.png')}}" alt=""></div>
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-5.png')}}" alt=""></div>
                        <div class="brand-item"><img src="{{('public/frontend/img/brand-6.png')}}" alt=""></div>
                    </div>
                </div>
            </div>
            <!-- Brand End -->


























@endsection
