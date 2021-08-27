@extends('admin.layouts.master')
@section('title')
<title>Add Coupon</title>
@endsection
@section('nametitle')
Add_Coupon
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto">
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM MÃ GIẢM GIÁ</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('savecoupon')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên mã giảm giá</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên mã giảm giá " name="coupon_code">
                                        @if ($errors->has('coupon_code'))
                                            <strong style="color: red"> {{$errors->first('coupon_code')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Hình thức giảm giá</label>
                                            <select class="form-control" name="coupon_type">
                                                <option value="1">Theo phần trăm </option>
                                                <option value="2">Theo số tiền</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Nhập giá trị giảm giá</p>
                                        <input type="number" class="form-control input-flat" placeholder="Nhập giá trị giảm giá " name="coupon_value">
                                        @if ($errors->has('coupon_value'))
                                            <strong style="color: red"> {{$errors->first('coupon_value')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="coupon_status">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Thêm danh mục sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>










@endsection
