@extends('admin.layouts.master')
@section('title')
<title>Bình luận</title>
@endsection
@section('nametitle')
   Tất cả bình luận
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách bình luận sản phẩm</h4>
                </div>
                @if (session()->has('mess'))
                {{session()->get('mess')}}
                @endif
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tác giả</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Binh luận</th>
                                    <th>Ngày</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                                @foreach ($allcomment as $comment)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$comment->name}}</td>
                                    <td>{{$comment->product_name}}</td>
                                    <td>{{$comment->product_comment}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td> <?php
                                        if ($comment->product_comment_status == 1) {
                                          ?>
                                        <a href="{{route('activeproductcomment', $comment->id)}}"><span class="fa fa-thumbs-up"> Hiển thị</span></a>
                                        <?php
                                        }else {
                                        ?>
                                        <a href="{{route('unactiveproductcomment', $comment->id)}}"><span class="fa fa-thumbs-down">Ẩn</span></a>
                                        <?php
                                        }
                                    ?> </td>
                                    <td><a  href="{{route('editproductcomment', $comment->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn xóa bình luận này không?')"
                                        href="{{route('deleteproductcomment', $comment->id)}}"><i class="fa fa-times" aria-hidden="true"></i>Xóa</a> </td>
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
