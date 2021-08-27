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
<section class="blog-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-12">
                <div class="blog-single-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="image">
                                <img src="{{asset($post->post_image)}}" alt="{{$post->post_image}}">
                            </div>
                            @php
                                $author_info=DB::table('users')->select('name')->where('id',$post->post_author)->first();
                            @endphp
                            <div class="blog-detail">
                                <h2 class="blog-title">{{$post->post_title}}</h2>
                                <div class="blog-meta">
                                    <span class="author"><a href="javascript:void(0);"><i class="fa fa-user"></i>By {{$author_info->name}} </a><a href="javascript:void(0);"><i class="fa fa-calendar"></i>{{$post->created_at->format('M d, Y')}}</a><a href="javascript:void(0);"><i class="fa fa-comments"></i></a></span>
                                </div>
                                <div class="sharethis-inline-reaction-buttons"></div>
                                <div class="content">
                                    {{-- @if($post->quote)
                                    <blockquote> <i class="fa fa-quote-left"></i> {!! ($post->quote) !!}</blockquote>
                                    @endif --}}
                                    <p>{!! ($post->post_content) !!}</p>
                                </div>
                            </div>
                            <div class="share-social">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="content-tags">
                                            <h4>Tags:</h4>
                                            <ul class="tag-inner">
                                                @php
                                                    $tags=explode(',',$post->post_tag);
                                                @endphp
                                                @foreach($tags as $tag)
                                                <li><a href="javascript:void(0);">{{$tag}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                        <div class="col-12 mt-4">
                            <div class="reply">
                                <div class="reply-head comment-form" id="commentFormContainer">
                                    <h2 class="reply-title">Để lại bình luận</h2>
                                    <!-- Comment Form -->
                                    <form class="form comment_form" id="commentForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group  comment_form_body">
                                                    <label>Bình luận<span>*</span></label>
                                                    <textarea name="post_comment" id="comment" rows="10" placeholder="" class="comment_content"></textarea>
                                                    <input type="hidden" name="post_id" value="{{$post->post_id}}" class="post_id"/>
                                                    <input type="hidden" name="parent_id" id="parent_id" value="" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="button" class="btn send_comment"><span class="comment_btn comment">Bình luận</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Comment Form -->
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-center p-5">
                            Bạn cần <a href="{{route('logincheckout')}}" style="color:rgb(54, 54, 204)">Đăng nhập</a> hoặc <a style="color:blue" href="{{route('logincheckout')}}">Đăng kí</a> để bình luận.
                        </p>
                        @endauth

                        <!--/ End Form -->
                        <div class="col-12">
                            <div class="comments">
                                <h3 class="comment-title">Comments</h3>
                                <!-- Single Comment -->
                                <form>
                                    @csrf
                                    <div id="show_comment"></div>
                                    <input type="hidden" name="post_id" value="{{$post->post_id}}" class="post_id"/>
                                </form>
                                <!-- End Single Comment -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Bar Start -->

            <!-- Side Bar End -->

        </div>
    </div>
</div>
</section>
@endsection

<style>
.blog-single .blog-single-main {
	margin-top: 30px;
	background: #fff;
}
.blog-single .blog-detail {
	background: #fff;
}
.blog-single .image{
	position:relative;
}
.blog-single .image img{
	width:500px;
	height:500px;
}
.blog-single .blog-title {
	font-size: 24px;
	font-weight: 600;
	text-transform: capitalize;
	margin: 40px 0 15px 0;
}
.blog-single .blog-meta {
	margin-bottom: 0;
	overflow: hidden;
	border-bottom: 1px solid #dddddd6e;
	padding-bottom: 20px;
	margin-bottom: 25px;
}
.blog-single .blog-meta .author i {
	color: #F7941D;
	margin-right: 10px;
	font-size: 13px;
}
.blog-single .blog-meta .author a {
	font-size: 13px;
	border-right:1px solid #ddd;
	padding:0px 15px;
}
.blog-single .blog-meta .author  a:first-child{
	padding-left:0;
}
.blog-single .blog-meta .author  a:last-child{
	padding-right:0;
	border:none;
}
.blog-single .blog-meta span {
	display: inline-block;
	font-size: 14px;
	color: #666;
}
.blog-single .blog-meta span a i {
	margin-right: 10px;
	color: #F7941D;
}
.blog-single .blog-meta span a:hover{
	color:#F7941D;
}
.blog-single .content p {
	margin-bottom: 25px;
	line-height: 26px;
}
.blog-single .content p:last-child{
	margin:0;
}
.blog-single blockquote {
	position: relative;
	font-size: 13px;
	font-weight: 400;
	padding-left: 20px;
	padding: 10px 20px;
	background: #F6F6F6;
	padding: 30px 40px 30px 70px;
	color: #555;
	border: none;
	margin-bottom: 25px;
	border-left: 3px solid #F7941D;
}
.blog-single blockquote i {
	font-size: 30px;
	color: #F7941D;
	position: absolute;
	left: 20px;
	top: 20px;
}
.blog-single .content .img-post{
	margin-bottom: 25px;
}
.blog-single .share-social .content-tags {
	position: relative;
	margin-top: 25px;
}
.blog-single .share-social .content-tags h4 {
	position: absolute;
	left: 0;
	top: 7px;
	font-size: 15px;
	font-weight: 500;
}
.blog-single .share-social .content-tags .tag-inner{
	padding-left:60px;
}
.blog-single .share-social .content-tags .tag-inner li {
	display: inline-block;
	margin-right: 7px;
	margin-bottom: 10px;
	margin-top: 4px;
}
.blog-single .share-social .content-tags .tag-inner li:last-child{
	margin-right: 0px;
	margin-bottom: 0px;
}
.blog-single .share-social .content-tags .tag-inner li a {
	border-radius: 30px;
	padding: 5px 15px;
	background:#f4f7fc;
	font-size: 13px;
}
.blog-single .share-social .content-tags .tag-inner li a:hover{
	color:#fff;
	background:#F7941D;
}
/* Comments */
.blog-single .comments{
	margin-top:40px;
}
.blog-single .comments .comment-title {
	position: relative;
	font-size: 18px;
	font-weight: 600;
	text-transform: capitalize;
	margin-bottom: 30px;
	display: block;
	background: #fff;
	padding-left: 12px;
}
.blog-single .comments .comment-title:before{
	position: absolute;
	content: "";
	left: 0;
	bottom: -1px;
	height: 100%;
	width: 3px;
	background:#F7941D;
}
.blog-single .comments{

}
.blog-single .comments .single-comment {
	position: relative;
	margin-bottom: 40px;
	border-radius: 5px;
	padding-left: 95px;
}
.blog-single .comments .single-comment.left{
	margin-left:110px;
}
.blog-single .comments .single-comment img {
	height: 70px;
	width: 70px;
	border-radius: 100%;
	position: absolute;
	left: 0;
}
.blog-single .single-comment .content {

}
.blog-single .single-comment .content h4 {
	color: #333;
	font-size: 16px;
	font-weight: 500;
	margin-bottom: 10px;
	display: inline-block;
	margin-bottom: 18px;
	text-transform: capitalize;
}
.blog-single .single-comment .content h4 span {
	display: inline-block;
	font-size: 13px;
	color: #8D8D8D;
	margin: 0;
	font-weight: 400;
	text-transform: capitalize;
	display: block;
	margin-top: 5px;
}
.blog-single .single-comment .content p {
	color: #666;
	font-weight: 400;
	display: block;
	margin: 0;
	margin-bottom: 20px;
	line-height: 22px;
}
.blog-single .single-comment .content .button{}
.blog-single .single-comment .content .btn {
	display: inline-block;
	color: #666;
	font-weight: 400;
	color: #6a6a6a;
	border-radius: 4px;
	text-transform: capitalize;
	font-size: 14px;
	background: transparent;
	padding: 0;
}
.blog-single .single-comment .content a i{
	display:inline-block;
	margin-right:5px;
}
.blog-single .single-comment .content a:hover{
	color:#F7941D;
}
/* Comment Form */
.blog-single .reply form {
	padding: 40px;
	border: 1px solid #eee;
}
.blog-single .reply .reply-title {
	position: relative;
	font-size: 18px;
	font-weight: 600;
	text-transform: capitalize;
	margin-bottom: 30px;
	display: block;
	background: #fff;
	padding-left: 12px;
}
.blog-single .reply .reply-title:before{
	position: absolute;
	content: "";
	left: 0;
	bottom: -1px;
	height: 100%;
	width: 3px;
	background:#F7941D;
}
.blog-single .reply .form-group {
	margin-bottom: 20px;
}
.blog-single .reply .form-group input {
	width: 100%;
	height: 45px;
	line-height: 50px;
	padding: 0 20px;
	border-radius: 0px;
	color: #333 !important;
	border: none;
	border: 1px solid #eee;
}
.blog-single .reply .form-group textarea {
	width: 100%;
	height: 200px;
	line-height: 50px;
	padding: 0 20px;
	border-radius: 0px;
	color: #333 !important;
	border: none;
	border: 1px solid #eee;
}
.blog-single .reply .form-group label {
	color: #333;
	position: relative;
}
.blog-single .reply .form-group label span {
	color:#ff2c18;
	display: inline-block;
	position: absolute;
	right: -12px;
	top: 4px;
	font-size: 16px;
}
.blog-single .reply .button {
	text-align: left;
	margin-bottom:0px;
}
.blog-single .reply .button .btn {
	height: 50px;
	border: none;
}
</style>
