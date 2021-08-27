@extends('admin.layouts.master')
@section('title')
<title>All Banner</title>
@endsection
@section('nametitle')
    All Banner
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách tất cả các banner</h4>
                    <a href="{{route('addbanner')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm banner"><i class="fa fa-plus"></i>Thêm banner</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>STT</th>
                                    <th>Tên banner</th>
                                    <th>Slug</th>
                                    <th>Hình ảnh banner</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $i=1;
                            @endphp
                            @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif
                            <tbody>
                                @foreach ($allbanner as $banner)
                                <tr>
                                    {{-- <td>{{$brand->brand_id}}</td> --}}
                                    <td>{{$i++}}</td>
                                    <td>{{$banner->banner_name}}</td>
                                    <td>{{$banner->banner_slug}}</td>
                                    <td><img src="{{$banner->banner_image}}" height="100" width="100" ></td>
                                    <td> <?php
                                        if ($banner->banner_status == 1) {
                                          ?>
                                        <a href="{{route('activebanner', $banner->banner_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactivebanner', $banner->banner_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editbanner', $banner->banner_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa banner này không?')"
                                        href="{{route('deletebanner', $banner->banner_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
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
