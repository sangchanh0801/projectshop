<!-- Top bar Start -->
@php
$settings=DB::table('settings')->first();
@endphp
<div class="top-bar">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <i class="fa fa-envelope"></i>
           {{$settings->setting_email}}
        </div>
        <div class="col-sm-6">
            <i class="fa fa-phone-alt"></i>
            {{$settings->setting_phone}}
        </div>
    </div>
</div>
</div>
<!-- Top bar End -->

<!-- Nav Bar Start -->
<div class="nav">
<div class="container-fluid">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a href="#" class="navbar-brand">MENU</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto">
                <a href="{{route('viewhome')}}" class="nav-item nav-link active">Trang chủ</a>
                @foreach ($allcategory as $cate)
                <a href="{{route('viewcategory',$cate->category_slug)}}" class="nav-item nav-link">{{$cate->category_name}}</a>
                @endforeach
                <a href="{{route('viewcart')}}" class="nav-item nav-link">Giỏ hàng</a>
                <a href="{{route('showcheckout')}}" class="nav-item nav-link">Thanh toán</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Bài viết về giày</a>
                    <div class="dropdown-menu">
                        @foreach ($category_post as $cate_post)
                        <a href="{{route('viewcategorypost', $cate_post->category_post_slug)}}" class="dropdown-item">{{$cate_post->category_post_name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="navbar-nav ml-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Tài khoản</a>
                    <div class="dropdown-menu">
                        @if (Auth::check())
                            <a href="" class="dropdown-item">Thông tin cá nhân</a>
                            <a href="/logoutcustomer" class="dropdown-item">Đăng xuất</a>
                        @else
                        <a href="/login-checkout" class="dropdown-item">Đăng nhập</a>
                        <a href="/login-checkout" class="dropdown-item">Đăng kí</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
</div>
<!-- Nav Bar End -->

<!-- Bottom Bar Start -->
<div class="bottom-bar">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-3">
            <div class="logo">
                <a href="{{route('viewhome')}}">
                    <img src="{{asset($settings->setting_logo)}}" alt="Logo">
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="search">
                <form action="{{route('search')}}" method="POST">
                    @csrf
                    <input type="text" placeholder="Search" name="search">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="user">
                <a href="wishlist.html" class="btn wishlist">
                    <i class="fa fa-heart"></i>
                    @php
                        $cart = Session::get('cart');
                        if(is_array($cart)){
                            $count = count($cart);
                        }else {
                            $count = 0;
                        }
                    @endphp
                    <span>(0)</span>
                </a>
                <a href="{{route('viewcart')}}" class="btn cart">
                    <i class="fa fa-shopping-cart"></i>
                    <span>({{$count}})</span>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Bottom Bar End -->
