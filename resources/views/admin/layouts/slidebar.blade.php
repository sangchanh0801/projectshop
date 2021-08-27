<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="{{route('dashboard')}}">
                        <!-- <img src="assets/images/logo.png" alt="" /> --><span>Admin</span></a></div>
                <li class="label">Main</li>
                <li><a class="sidebar-sub-toggle" href="{{route('dashboard')}}"><i class="ti-home"></i> Trang chủ
                            <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                </li>
                @can('maneger')
                <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid4-alt"></i> Danh mục sản phẩm <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addcategoryproduct')}}">Thêm danh mục sản phẩm</a></li>
                        <li><a href="{{route('allcategoryproduct')}}">Danh sách danh mục sản phẩm </a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> Thương hiệu sản phẩm <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addbrandproduct')}}">Thêm thương hiệu sản phẩm</a></li>
                        <li><a href="{{route('allbrandproduct')}}">Danh sách thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i> Sản phẩm <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addproduct')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{route('allproduct')}}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                @endcan
                @can('is-admin')
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i> Users <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('adduser')}}">Thêm User</a></li>
                        <li><a href="{{route('alluser')}}">Danh sách User</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i> Mã giảm giá <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addcoupon')}}">Thêm mã giảm giá</a></li>
                        <li><a href="{{route('allcoupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i>Đơn đặt hàng <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('manegeoder')}}">Danh sách đơn đặt hàng</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i>Vận chuyển <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('insertdelivery')}}">Quản lí vận chuyển</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i>Banner <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addbanner')}}">Thêm banner</a></li>
                        <li><a href="{{route('allbanner')}}">Dach sách banner</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i>Tag bài viết <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addtag')}}">Thêm Tag</a></li>
                        <li><a href="{{route('alltag')}}">Dach sách tag</a></li>
                    </ul>
                </li>
                @endcan
                @can('author')
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i> Danh mục bài viết <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addcategorypost')}}">Thêm danh mục bài viết</a></li>
                        <li><a href="{{route('allcategorypost')}}">Danh sách danh mục bài viết</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i> Bài viết <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('addpost')}}">Thêm bài viết</a></li>
                        <li><a href="{{route('allpost')}}">Danh sách bài viết</a></li>
                    </ul>
                </li>
                @endcan

                <li><a class="sidebar-sub-toggle"><i class="ti-map"></i>Bình luận<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('allcomment')}}">Dach sách bình luận bài viết</a></li>
                        <li><a href="{{route('allproductcomment')}}">Dach sách bình luận sản phẩm</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
 <!-- /# sidebar -->
