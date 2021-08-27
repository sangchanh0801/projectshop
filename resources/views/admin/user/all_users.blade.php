@extends('admin.layouts.master')
@section('title')
<title>Danh sách người dùng</title>
@endsection
@section('nametitle')
    Danh sách người dùng
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách người dùng</h4>
                    <a href="{{route('adduser')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm người dùng</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        @if (session()->has('mess'))
                            {{session()->get('mess')}}
                        @endif
                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $i=1;
                            @endphp
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><a  href="{{route('edituser', $user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa user này không?')"
                                        href="{{route('deleteuser', $user->id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
