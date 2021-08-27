@extends('admin.layouts.master')
@section('title')
<title>Thêm người dùng</title>
@endsection
@section('nametitle')
   Thêm người dùng
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto" >
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM USER</h4>
                        </div>
                        {{-- @if (session()->has('thongbao'))
                            <strong style="color: red">{{session()->get('thongbao')}}</strong>
                        @endif --}}
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('saveuser')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên người dùng</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên người dùng" name="name" id="name">
                                    </div>
                                    @if ($errors->has('name'))
                                            <span style="color: red">{{$errors->first('name')}}</span>
                                    @endif
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Email</p>
                                        <input type="text" class="form-control input-flat" placeholder="Email" name="email" id="email">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span style="color: red">{{$errors->first('email')}}</span>
                                    @endif
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Password</p>
                                        <input type="password" class="form-control input-flat" placeholder="Password" name="password" id="password">
                                    </div>
                                    @if ($errors->has('password'))
                                    <span style="color: red">{{$errors->first('password')}}</span>
                                    @endif
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Password Confirm</p>
                                        <input type="password" class="form-control input-flat" placeholder="Password" name="password_confirmation" id="password">
                                    </div>

                                    @foreach ($roles as $role)
                                    <div class="checkbox">
                                        <label for="{{$role->name}}">
                                            <input type="checkbox" value="{{$role->id}}" id="{{$role->name}}" name="roles[]"> {{$role->name}}
                                        </label>
                                    </div>
                                    @endforeach

                                    <br>
                                    <button type="submit" class="btn btn-default">Thêm người dùng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




@endsection
