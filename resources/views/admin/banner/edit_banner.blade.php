@extends('admin.layouts.master')
@section('title')
<title>Add Banner</title>
@endsection
@section('nametitle')
    Add_Banner
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto" >
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM BANNER</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('updatebanner', $edit_banner->banner_id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên banner</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên banner" name="banner_name" value="{{$edit_banner->banner_name}}" id="title" onkeyup="ChangeToSlug();">
                                        @if ($errors->has('banner_name'))
                                            <strong style="color: red"> {{$errors->first('banner_name')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Slug</p>
                                        <input type="text" class="form-control input-flat" placeholder="Slug" name="banner_slug" id="slug" value="{{$edit_banner->banner_slug}}">
                                        @if ($errors->has('banner_slug'))
                                            <strong style="color: red"> {{$errors->first('banner_slug')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Hình ảnh banner <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn
                                                </a>
                                            </span>
                                        <input id="thumbnail" class="form-control" type="text" name="banner_image" value="{{$edit_banner->banner_image}}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Mô tả banner</p>
                                        <textarea  class="form-control input-flat" style="height: 300px" placeholder="Mô tả banner" name="banner_desc" >{{$edit_banner->banner_desc}}</textarea>
                                        @if ($errors->has('banner_desc'))
                                            <strong style="color: red"> {{$errors->first('banner_desc')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="banner_status">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Cập nhật banner</button>
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
