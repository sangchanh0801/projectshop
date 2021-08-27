@extends('admin.layouts.master')
@section('title')
<title>Cài đặt</title>
@endsection
@section('nametitle')
    Cài đặt
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto">
                    <div class="card">
                        <div class="card-title">
                            <h4>Cài đặt</h4>
                        </div>
                        @if (session()->has('mess'))
                        <strong style="color: red">{{session()->get('mess')}}</strong>
                        @endif
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('updatesetting')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Email</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập email shop" name="setting_email" value="{{$edit_setting->setting_email}}">
                                        @if ($errors->has('setting_email'))
                                            <strong style="color: red"> {{$errors->first('setting_email')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Số điện thoại</p>
                                        <input type="text" class="form-control input-flat" placeholder="Số điện thoại shop" name="setting_phone" id="slug" value="{{$edit_setting->setting_phone}}">
                                        @if ($errors->has('setting_phone'))
                                            <strong style="color: red"> {{$errors->first('setting_phone')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Địa chỉ shop</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập địa chỉ shop" name="setting_address" value="{{$edit_setting->setting_address}}">
                                        @if ($errors->has('setting_address'))
                                            <strong style="color: red"> {{$errors->first('setting_address')}}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Logo shop<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn
                                                </a>
                                            </span>
                                        <input id="thumbnail" class="form-control" type="text" name="banner_image" value="{{$edit_setting->setting_logo}}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả shop</label>
                                        <textarea class="form-control" style="height: 150px" placeholder="Mô tả" name="setting_desc">{{$edit_setting->setting_desc}}</textarea>
                                        @if ($errors->has('setting_desc'))
                                            <strong style="color: red">{{$errors->first('setting_desc')}}</strong>
                                        @endif
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Cập nhật</button>
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
