@extends('admin.layouts.master')
@section('title')
<title>All Coupon</title>
@endsection
@section('nametitle')
    All_Coupon
@endsection
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách tất cả mã giảm giá</h4> <br>
                    <a href="{{route('addcoupon')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm mã giảm giá</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>Tên mã giảm giá</th>
                                    <th>Hình thức giảm giá</th>
                                    <th>Gía trị giảm giá</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                                {{session()->get('mess')}}
                            @endif
                            <tbody>
                                @foreach ($allcoupon as $coupon)
                                <tr>
                                    <td>{{$coupon->coupon_code}}</td>
                                    @if ($coupon->coupon_type == 1)
                                        <td>Theo phần trăm</td>
                                    @else
                                        <td>Theo số tiền</td>
                                    @endif
                                    @if ($coupon->coupon_type == 1)
                                        <td>{{$coupon->coupon_value}}%</td>
                                    @else
                                        <td>{{number_format($coupon->coupon_value, 0, ',','.')}} VNĐ</td>
                                    @endif

                                    <td> <?php
                                        if ($coupon->coupon_status == 1) {
                                          ?>
                                        <a href="{{route('activecoupon', $coupon->coupon_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactivecoupon', $coupon->coupon_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editcoupon', $coupon->coupon_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')"
                                        href="{{route('deletecoupon', $coupon->coupon_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{$allcoupon->links()}}
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
