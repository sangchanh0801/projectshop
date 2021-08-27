@extends('admin.layouts.master')
@section('title')
<title>Cập nhật bài viết</title>
@endsection
@section('nametitle')
Cập nhật bài viết
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto">
                    <div class="card">
                        <div class="card-title">
                            <h4>CẬP NHẬT BÀI VIẾT</h4>
                        </div>
                        {{-- @if (session()->has('thongbao'))
                        <strong style="color: red">{{session()->get('thongbao')}}</strong>
                        @endif --}}
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('updatepost', $edit_post->post_id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên bài viết</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên bài viết " name="post_title" id="title" onkeyup="ChangeToSlug();" value="{{$edit_post->post_title}}">
                                        {{-- @if ($errors->has('category_name'))
                                            <strong style="color: red"> {{$errors->first('category_name')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Slug</p>
                                        <input type="text" class="form-control input-flat" placeholder="Slug" name="post_slug" id="slug" value="{{$edit_post->post_slug}}">
                                        {{-- @if ($errors->has('category_name'))
                                            <strong style="color: red"> {{$errors->first('category_name')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Hình ảnh thương hiệu <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn
                                                </a>
                                            </span>
                                        <input id="thumbnail" class="form-control" type="text" name="post_image" value="{{old('post_image')}}">
                                      </div>
                                    </div>
                                    @php
                                        $data=explode(',',$edit_post->post_tag);
                                    @endphp
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tags</p>
                                        <select name="post_tag[]" class="custom-select" multiple>
                                            <option value="">--Chọn Tag--</option>
                                            @foreach($post_tag as $key=>$tag)
                                                <option value='{{$tag->tag_name}}' @if( in_array( $tag->tag_name ,$data ) ) selected @endif>{{$tag->tag_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tác giả</p>
                                        <select name="post_author" class="form-control">
                                            <option value="">--Chọn tác giả--</option>
                                            @foreach($users as $key=>$data)
                                                <option value='{{$data->id}}' {{($edit_post->post_author == $data->id) ? 'selected' : ''}}>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tóm tắt bài viết</p>
                                        <textarea  class="form-control input-flat" style="height: 200px" placeholder="Tóm tắt bài viết" name="post_desc" >{{$edit_post->post_desc}}</textarea>
                                        {{-- @if ($errors->has('category_desc'))
                                            <strong style="color: red"> {{$errors->first('category_desc')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Nội dung bài viết</p>
                                        <textarea  class="form-control input-flat" style="height: 200px" placeholder="Nội dung bài viết " name="post_content" id="ckeditor5">{{$edit_post->post_content}}</textarea>
                                        {{-- @if ($errors->has('category_desc'))
                                            <strong style="color: red"> {{$errors->first('category_desc')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục bài viết</label>
                                            <select class="form-control" name="cate_post_id">
                                                @foreach ($cate_post as $cate)
                                                    <option value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="post_status">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Cập nhật bài viết</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@push('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endpush

@push('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
<script src="{{('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
    $('#lfm').filemanager('image');
    $(document).ready(function(){
      // Define function to open filemanager window
      var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
      };
      // Define LFM summernote button
      var LFMButton = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'Insert image with filemanager',
          click: function() {

            lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
              lfmItems.forEach(function (lfmItem) {
                context.invoke('insertImage', lfmItem.url);
              });
            });

          }
        });
        return button.render();
      };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('#summernote-editor').summernote({
        toolbar: [
          ['popovers', ['lfm']],
        ],
        buttons: {
          lfm: LFMButton
        }
      })
    });
  </script>
<script language="javascript">
    function ChangeToSlug()
    {
        var title, slug;
        //Lấy text từ thẻ input title
        title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>
@endpush
