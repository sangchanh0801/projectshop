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
                    <h4>DANH SÁCH TAG BÀI VIẾT</h4>
                    <a href="{{route('addtag')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm"><i class="fa fa-plus"></i>Thêm tag</a>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($alltag as $tag)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$tag->tag_name}}</td>
                                    <td>{{$tag->tag_slug}}</td>
                                    <td> <?php
                                        if ($tag->tag_status == 1) {
                                          ?>
                                        <a href="{{route('activetag', $tag->tag_id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactivetag', $tag->tag_id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('edittag', $tag->tag_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa tag này không?')"
                                        href="{{route('deletetag', $tag->tag_id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
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

