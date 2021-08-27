@extends('admin.layouts.master')
@section('title')
<title>Tất cả sản phẩm</title>
@endsection
@section('nametitle')
Tất cả sản phẩm
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách sản phẩm  </h4>
                    <a href="{{route('addproduct')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm sản phẩm</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        @if (session()->has('mess'))
                            {{session()->get('mess')}}
                        @endif
                        <table id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh sản phẩm</th>
                                    <th>Thêm gallery</th>
                                    <th>Danh mục sản phẩm </th>
                                    <th>Thương hiệu sản phẩm</th>
                                    <th>Gía sản phẩm</th>
                                    <th>Gía gốc sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Size</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($allproduct as $pro)
                                <tr>
                                    <td>{{$pro->product_name}}</td>
                                    <td> <img src="{{$pro->product_image}}" height="100" width="100" ></td>
                                    <td><a  class="btn btn-success btn-sm m-b-10 m-l-5" href="{{route('addgallery', $pro->product_id)}}">Thêm gallery</a></td>
                                    <td>{{$pro->category_name}}</td>
                                    <td>{{$pro->brand_name}}</td>
                                    <td>{{number_format($pro->product_price)}} VNĐ</td>
                                    <td>{{number_format($pro->product_cost)}} VNĐ</td>
                                    <td>{{$pro->product_number}}</td>
                                    <td>{{$pro->product_size}}</td>
                                    {{-- <td>{{$pro->product_content}}</td> --}}
                                    <td><?php
                                        if ($pro->product_status == 1) {
                                          ?>
                                        <a href="{{route('activeProduct', $pro->product_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactiveProduct', $pro->product_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?>
                                        </td>
                                    <td><a  href="{{route('editproduct', $pro->product_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')"
                                        href="{{route('deleteproduct', $pro->product_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$allproduct->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
