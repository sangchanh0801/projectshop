<div class="col-lg-4 sidebar">
    <div class="sidebar-widget category">
        <h2 class="title">Danh mục sản phẩm</h2>
        <nav class="navbar bg-light">
            <ul class="navbar-nav">
                @foreach ($allcategory as $cate)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('viewcategory',$cate->category_slug )}}"><i class="fa fa-female"></i>{{$cate->category_name}}</a>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="sidebar-widget widget-slider">
        <div class="sidebar-slider normal-slider">
            @foreach ($relate_product as $product)
            <div class="product-item">
                <div class="product-title">
                    <a href="#">{{$product->product_name}}</a>
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
                        <img src="{{asset($product->product_image)}}" alt="Product Image">
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
            @endforeach
        </div>
    </div>

    <div class="sidebar-widget brands">
        <h2 class="title">Thương hiệu</h2>
        <ul>
            @foreach ($allbrand as $brand)
            <li><a href="{{route('viewbrand', $brand->brand_name)}}">{{$brand->brand_name}} </a><span>(0)</span></li>
            @endforeach
        </ul>
    </div>
    @php
        $alltag = DB::table('post_tags')->where('tag_status', 1)->get();
    @endphp
    <div class="sidebar-widget tag">
        <h2 class="title">Tag</h2>
        @foreach ($alltag as $tag)
        <a href="#">{{$tag->tag_name}}</a>
        @endforeach
    </div>
</div>
