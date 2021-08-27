@extends('frontend.layouts.master')
@section('content-home')
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <ul class="nav-item" style="list-style: none">
                            <a class="nav-link" href="#"><i class="fa fa-home"></i>Loại sản phẩm</a>
                            @foreach ($allcategory as $cate )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('viewcategory', $cate->category_slug)}}"><i class="fa fa-shopping-bag"></i>{{$cate->category_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="nav-item" style="list-style: none">
                            <a class="nav-link" href="#"><i class="fa fa-female"></i>Thuơng hiệu </a>
                            @foreach ($allbrand as $brand)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('viewbrand', $brand->brand_name)}}"><i class="fa fa-child"></i>{{$brand->brand_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    @foreach ($allbanner as $banner)
                    <div class="header-slider-item">
                        <img src="{{$banner->banner_image}}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>{{$banner->banner_desc}}</p>
                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Xem ngay</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="{{('public/frontend/img/category-1.jpg')}}" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                    <div class="img-item">
                        <img src="{{('public/frontend/img/category-2.jpg')}}" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

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

<!-- Feature Start-->
<div class="feature">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fab fa-cc-mastercard"></i>
                    <h2>Thanh toán an toàn</h2>
                    <p>
                        Thanh toán an toàn nhanh chóng
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-truck"></i>
                    <h2>Vận chuyển toàn quốc</h2>
                    <p>
                        Vận chuyển toàn quốc nhanh chóng
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-sync-alt"></i>
                    <h2>Đổi trả sau 90 ngày</h2>
                    <p>
                        Đổi trả sản phẩm khi sản phẩm bị lỗi
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-comments"></i>
                    <h2>Hỗ trợ 24/7 </h2>
                    <p>
                        Tư ván sản phẩm 24/7
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End-->

<!-- Category Start-->
<div class="category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="{{('public/frontend/img/category-3.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-250">
                    <img src="{{('public/frontend/img/category-4.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
                <div class="category-item ch-150">
                    <img src="{{('public/frontend/img/category-5.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-150">
                    <img src="{{('public/frontend/img/category-6.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
                <div class="category-item ch-250">
                    <img src="{{('public/frontend/img/category-7.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="{{('public/frontend/img/category-8.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category End-->

<!-- Call to Action Start -->
<div class="call-to-action">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Gọi cho chúng tôi để tư vấn sản phẩm</h1>
            </div>
            <div class="col-md-6">
                <a href="tel:0123456789">0325503111</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<!-- Featured Product Start -->
<div class="featured-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Sản phẩm gần đây</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            @foreach ($allproduct as $product)
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
                                            $x = env('APP_URL');
                                        @endphp
                                    <i class="fa fa-star"  style="{{$color}}"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="product-image">
                            <a href="{{route('detailproduct', $product->product_id)}}">
                                <img src="{{asset($product->product_image)}}" alt="{{$x}}">
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
<!-- Featured Product End -->

<!-- Newsletter Start -->
<div class="newsletter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Đăng kí shop ngay</h1>
            </div>
            <div class="col-md-6">
                <div class="form">
                    <input type="email" value="Nhập email của bạn">
                    <button>Đăng kí</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

<!-- Recent Product Start -->

<!-- Recent Product End -->

<!-- Review Start -->
<div class="review">
    <div class="container-fluid">
        <div class="row align-items-center review-slider normal-slider">
            @foreach ($allpost as $post)
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="{{$post->post_image}}" alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>{{$post->post_title}}</h2>
                        <h3>Profession</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            {{$post->post_desc}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
