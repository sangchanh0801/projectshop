@extends('admin.layouts.master')
@section('title')
<title>Edit Coupon</title>
@endsection
@section('nametitle')
    Edit_Coupon
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto">
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM MÃ GIẢM GIÁ</h4>
                        </div>
                        {{-- @if (session()->has('thongbao'))
                        <strong style="color: red">{{session()->get('thongbao')}}</strong>
                        @endif --}}
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('updatecoupon', $edit_coupon->coupon_id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên mã giảm giá</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên mã giảm giá " name="coupon_code" value="{{$edit_coupon->coupon_code}}">
                                        {{-- @if ($errors->has('category_name'))
                                            <strong style="color: red"> {{$errors->first('category_name')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Hình thức giảm giá</label>
                                            <select class="form-control" name="coupon_type">
                                                <option value="1" {{(($edit_coupon->coupon_type =='1') ? 'selected' : '')}}>Theo phần trăm </option>
                                                <option value="2" {{(($edit_coupon->coupon_type =='2') ? 'selected' : '')}} >Theo số tiền</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Nhập giá trị giảm giá</p>
                                        <input type="number" class="form-control input-flat" placeholder="Nhập giá trị giảm giá " name="coupon_value" value="{{$edit_coupon->coupon_value}}">
                                        {{-- @if ($errors->has('category_desc'))
                                            <strong style="color: red"> {{$errors->first('category_desc')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="coupon_status">
                                                <option value="1" {{(($edit_coupon->coupon_status =='1') ? 'selected' : '')}} >Hiển thị</option>
                                                <option value="0" {{(($edit_coupon->coupon_status =='0') ? 'selected' : '')}}>Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Cập nhật mã giảm giá</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
