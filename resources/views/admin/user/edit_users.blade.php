@extends('admin.layouts.master')
@section('title')
<title>Sửa người dùng</title>
@endsection
@section('nametitle')
    Sửa người dùng
@endsection
@section('content')

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>CẬP NHẬT USER</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">

                                    <form action={{route('updateuser', $users->id)}} method="post">
                                        @csrf
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Tên người dùng</p>
                                            <input type="text" class="form-control input-flat" placeholder="Nhập tên người dùng" name="name" value="{{$users->name}}" >
                                        </div>
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Email</p>
                                            <input type="text" class="form-control input-flat" placeholder="Email" name="email" value="{{$users->email}}">

                                        </div>
                                        @isset($create)
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Password</p>
                                            <input type="password" class="form-control input-flat" placeholder="Password" name="password" >
                                        </div>
                                        @endisset

                                        @foreach ($roles as $role)
                                        <div class="checkbox">
                                            <label for="{{$role->name}}">
                                                <input type="checkbox" value="{{$role->id}}" id="{{$role->name}}" name="roles[]"
                                                {{-- @isset($users)
                                                    @if (in_array($role->id, $users->roles->pluck('id')->toArray()))
                                                        checked
                                                    @endif
                                                @endisset --}}
                                                    @if ($rolesuser->contains('id', $role->id))
                                                        checked
                                                    @endif
                                                > {{$role->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                        <br>
                                        <button type="submit" class="btn btn-default">Cập nhật người dùng</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

















@endsection
