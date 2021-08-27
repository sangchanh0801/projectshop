@extends('frontend.layouts.master')
@section('content-home')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Bài viết</a></li>
            <li class="breadcrumb-item active">Danh sách bài viết</li>
        </ul>
    </div>
</div>
@if (session()->has('mess'))
{{session()->get('mess')}}
@endif
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-6 col-md-6 col-8">
                            <!-- Start Single Blog  -->
                            <div class="shop-single-blog">
                            <img src="{{asset($post->post_image)}}" alt="{{$post->post_image}}">
                                <div class="content">
                                    @php
                                        $author_info=DB::table('users')->select('name')->where('id',$post->post_author)->get();
                                    @endphp
                                    <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{$post->created_at->format('d M, Y. D')}}
                                        <span class="float-right">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            @foreach($author_info as $data)
                                                @if($data->name)
                                                    {{$data->name}}
                                                @else
                                                    Sang
                                                @endif
                                            @endforeach
                                        </span>
                                    </p>
                                    <a href="{{route('viewpost', $post->post_slug)}}" class="title" id="P_16">{{$post->post_title}}</a>
                                    <p>{!! html_entity_decode($post->post_desc) !!}</p>
                                    <a href="{{route('viewpost', $post->post_slug)}}" class="more-btn" id="P_16">Xem bài viết</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
                {{$posts->links()}}
                            <!-- End Single Blog  -->
            </div>

            <!-- Side Bar Start -->

            <!-- Side Bar End -->
        </div>
    </div>
</div>

@endsection

<style>
.grid .shop-single-blog{
	margin-top:30px;
}
 .shop-single-blog{
	text-align:center;
	-webkit-transition:all 0.4s ease;
	-moz-transition:all 0.4s ease;
	transition:all 0.4s ease;
}
 .shop-single-blog:hover{
	box-shadow: 0px 10px 10px #0000000a;
}
.shop-single-blog img{
	height:300px;
	width:300px;
}
.shop-single-blog .content {
	padding: 40px;
}
.shop-single-blog .content .title {
	font-size: 17px;
	font-weight: 600;
	color: #333;
}
.shop-single-blog .content .title:hover{
	color:#F7941D;
}
.shop-single-blog .content .date {
	font-size: 14px;
	font-weight: 400;
	margin-bottom: 5px;
	color: #B7B7B7;
}
.shop-single-blog .content .more-btn {
	font-size: 14px;
	font-weight: 400;
	color: #3c3c3c;
	margin-top: 10px;
	display: block;
}
.shop-single-blog .content .more-btn:hover{
	color:#F7941D;
}

</style>

