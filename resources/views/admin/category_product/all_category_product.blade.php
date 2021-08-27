@extends('admin.layouts.master')
@section('title')
<title>Danh sách danh mục sản phẩm</title>
@endsection
@section('nametitle')
Danh sách danh mục sản phẩm
@endsection
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách tất cả các danh mục sản phẩm </h4> <br>
                    <a href="{{route('addcategoryproduct')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm banner"><i class="fa fa-plus"></i>Thêm danh mục sản phẩm</a>
                    @if (session()->has('mess'))
                    {{session()->get('mess')}}
                    @endif
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mô tả danh mục sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allcategory as $category)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_desc}}</td>
                                    <td> <?php
                                        if ($category->category_status == 1) {
                                          ?>
                                        <a href="{{route('activeCategory', $category->category_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactiveCategory', $category->category_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editcategoryproduct', $category->category_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')"
                                        href="{{route('deletecategoryproduct', $category->category_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
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
{{-- <td>
    <span class="ti-marker-alt"></span><a href=""><span class="icon-name"> Sửa</span></a>

</td>
<td>
    <span class="ti-trash"></span><a href=""><span class="icon-name"> Xóa</span></a>
<td> --}}
