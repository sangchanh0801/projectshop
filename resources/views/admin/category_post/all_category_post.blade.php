@extends('admin.layouts.master')
@section('title')
<title>All Category Post</title>
@endsection
@section('nametitle')
    All Category Post
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách danh mục bài viết </h4>
                    <a href="{{route('addcategorypost')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm danh mục bài viết</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Mô tả danh mục bài viết</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif
                            @if (session()->has('message'))
                                {{session()->get('message')}}
                            @endif
                            <tbody>
                                @foreach ($allcategorypost as $categorypost)
                                <tr>
                                    {{-- <td>{{$brand->brand_id}}</td> --}}
                                    <td>{{$categorypost->category_post_name}}</td>
                                    <td>{{$categorypost->category_post_slug}}</td>
                                    <td>{{$categorypost->category_post_desc}}</td>
                                    <td> <?php
                                        if ($categorypost->category_post_status == 1) {
                                          ?>
                                        <a href="{{route('activecategorypost', $categorypost->category_post_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactivecategorypost', $categorypost->category_post_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editcategorypost', $categorypost->category_post_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa danh mục bài viết này không?')"
                                        href="{{route('deletecategorypost', $categorypost->category_post_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
