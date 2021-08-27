@extends('frontend.layouts.master')
@section('content-home')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Đăng nhập và đăng kí</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="register-form">
                    @if (session()->has('message'))
                        {{session()->get('message')}}
                    @endif
                    <form action="{{route('addcustomer')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tên của bạn</label>
                            <input class="form-control" type="text" placeholder="Tên của bạn" name="name" id="name">
                            @if ($errors->has('name'))
                                <span style="color: red">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>E-mail của bạn</label>
                            <input class="form-control" type="text" placeholder="E-mail của bạn" name="email" id="email">
                            @if ($errors->has('email'))
                            <span style="color: red">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Mật khẩu của bạn</label>
                            <input class="form-control" type="password" placeholder="Mật khẩu của bạn" name="password" id="password">
                            @if ($errors->has('password'))
                            <span style="color: red">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Nhập lại mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" id="password">
                        </div>
                        <div class="col-md-12">
                            <button class="btn">Đăng kí</button>
                        </div>
                        @if (session()->has('mess'))
                            {{session()->get('mess')}}
                        @endif
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-form">
                    <form action="{{route('logincustomer')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email của bạn</label>
                            <input class="form-control" type="text" placeholder="Nhập Email của bạn" name="email">
                        </div>
                        <div class="col-md-6">
                            <label>Mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Mật khẩu của bạn" name="password">
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('redirect', ['facebook'])}}">Đăng nhập bằng facebook</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('redirect', ['google'])}}">Đăng nhập bằng google</a>
                        </div>
                        <div class="col-md-12">
                            <button class="btn">Đăng nhập</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
