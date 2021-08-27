@extends('admin.layouts.master')
@section('title')
<title>All Brand Product</title>
@endsection
@section('nametitle')
    All Brand
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách tất cả các thương hiệu sản phẩm </h4>
                    <a href="{{route('addbrandproduct')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm banner"><i class="fa fa-plus"></i>Thêm thương hiệu</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Hình ảnh thương hiệu</th>
                                    <th>Mô tả thương hiệu sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif
                            <tbody>
                                @foreach ($allbrand as $brand)
                                <tr>
                                    {{-- <td>{{$brand->brand_id}}</td> --}}
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset($brand->brand_image)}}" height="100" width="100" ></td>
                                    <td>{{$brand->brand_desc}}</td>
                                    <td> <?php
                                        if ($brand->brand_status == 1) {
                                          ?>
                                        <a href="{{route('activeBrand', $brand->brand_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactiveBrand', $brand->brand_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editbrandproduct', $brand->brand_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa thương hiệu sản phẩm này không?')"
                                        href="{{route('deletebrandproduct', $brand->brand_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                                @endforeach
                             @if (session()->has('message'))
                                {{session()->get('message')}}
                            @endif

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
