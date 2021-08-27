@extends('admin.layouts.master')
@section('title')
<title>Sửa bình luận</title>
@endsection
@section('nametitle')
    Sửa bình luận
@endsection
@section('content')

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>CẬP NHẬT BÌNH LUẬN</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                    <form action={{route('updateproductcomment', $edit_comment->id)}} method="post" >
                                        @csrf
                                        {{-- <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Tác giả</p>
                                            <input type="text" disabled class="form-control input-flat" value="{{$edit_comment->name}}">
                                        </div> --}}
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Bình luận</p>
                                            <textarea  class="form-control input-flat" style="height: 300px" placeholder="Bình luận" name="product_comment" >{{$edit_comment->product_comment}}"</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Hiển thị</label>
                                                <select class="form-control" name="product_comment_status">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Ẩn</option>
                                                </select>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-default">Cập nhật bình luận</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
