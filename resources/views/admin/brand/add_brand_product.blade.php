@extends('admin.layouts.master')
@section('title')
<title>Add Brand Product</title>
@endsection
@section('nametitle')
    Add_Brand
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto" >
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM THƯƠNG HIỆU SẢN PHẨM</h4>
                        </div>
                        @if (session()->has('thongbao'))
                            <strong style="color: red">{{session()->get('thongbao')}}</strong>
                        @endif
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('savebrand')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên thương hiệu sản phẩm</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập thương hiệu sản phẩm " name="brand_name">
                                        @if ($errors->has('brand_name'))
                                            <strong style="color: red"> {{$errors->first('brand_name')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Hình ảnh thương hiệu <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn
                                                </a>
                                            </span>
                                        <input id="thumbnail" class="form-control" type="text" name="brand_image" value="{{old('brand_image')}}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Mô tả thương hiệu sản phẩm</p>
                                        <textarea  class="form-control input-flat" style="height: 300px" placeholder="Mô tả thương hiệu sản phẩm " name="brand_desc" ></textarea>
                                        @if ($errors->has('brand_desc'))
                                            <strong style="color: red"> {{$errors->first('brand_desc')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="brand_status">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Thêm thương hiệu</button>
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
@endpush
