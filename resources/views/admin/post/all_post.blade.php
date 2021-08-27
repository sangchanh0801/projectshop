@extends('admin.layouts.master')
@section('title')
<title>Danh sách bài viết</title>
@endsection
@section('nametitle')
Danh sách bài viết
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách bài viết</h4>
                    <a href="{{route('addpost')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm bài viết</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        @if (session()->has('mess'))
                            {{session()->get('mess')}}
                        @endif
                        <table id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th>Tên bài viết</th>
                                    <th>Hình ảnh bài viết</th>
                                    <th>Slug</th>
                                    <th>Mô tả bài viết</th>
                                    <th>Tag</th>
                                    <th>Danh mục bài viết</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif
                            <tbody>
                            @foreach ($allpost as $post)
                                <tr>
                                    <td>{{$post->post_title}}</td>
                                    <td> <img src="{{$post->post_image}}" height="100" width="100" ></td>
                                    <td>{{$post->post_slug}}</td>
                                    <td>{{$post->post_desc}}</td>
                                    <td>{{$post->post_tag}}</td>
                                    <td>{{$post->category_post_name}}</td>
                                    <td><?php
                                        if ($post->post_status == 1) {
                                          ?>
                                        <a href="{{route('activepost', $post->post_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactivepost', $post->post_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?>
                                        </td>
                                    <td><a  href="{{route('editpost', $post->post_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa bài viết này không?')"
                                        href="{{route('deletepost', $post->post_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$allpost->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
