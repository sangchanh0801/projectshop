@extends('admin.layouts.master')
@section('title')
<title>Thông tin cá nhân</title>
@endsection
@section('nametitle')
Thông tin cá nhân
@endsection
@section('content')
<div class="content-wrap">
    <div class="main">
    <div class="container-fluid">
        <!-- /# row -->
        <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
               @if (session()->has('mess'))
                    <strong style="color: red">{{session()->get('mess')}}</strong>
                @endif
                <div class="card-body">
                <div class="user-profile">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="image">
                                    @if($profile->avatar)
                                    <img class="card-img-top img-fluid roundend-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" src="{{asset($profile->avatar)}}" alt="profile picture">
                                    @else
                                    <img class="card-img-top img-fluid roundend-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" src="/public/storage/photos/4/avatar.png" alt="profile picture">
                                    @endif
                                </div>
                                <div class="card-body mt-4 ml-2">
                                  <h5 class="card-title text-left"><small><i class="fas fa-user"></i> {{$profile->name}}</small></h5>
                                  <p class="card-text text-left"><small><i class="fas fa-envelope"></i> {{$profile->email}}</small></p>
                                  <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i> </small></p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-8">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{route('updateprofile', $profile->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Họ và tên</label>
                                  <input id="inputTitle" type="text" name="name" placeholder="Nhập tên của bạn"  value="{{$profile->name}}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Số điện thoại</label>
                                  <input id="inputTitle" type="text" name="phone" placeholder="Nhập số điện thoại"  value="{{$profile->phone}}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Địa chỉ</label>
                                  <input id="inputTitle" type="text" name="address" placeholder="Nhập địa chỉ của bạn"  value="{{$profile->address}}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail" class="col-form-label">Email</label>
                                    <input id="inputEmail" disabled type="email" name="email" placeholder="Enter email"  value="{{$profile->email}}" class="form-control">

                                  </div>
                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Ảnh đại diện<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Chọn
                                            </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="avatar" value="{{$profile->avatar}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-form-label">Tuổi</label>
                                        <select name="birthday" class="form-control">
                                          <option value="">-----Tuổi-----</option>
                                            @php
                                            for ($i = 1; $i < 101; $i++){
                                                echo '<option value="'.$i.'" '.(($profile->birthday == $i) ? 'selected' : '').'>'.$i.'</option>';
                                            }
                                            @endphp
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="col-form-label">Giới tính</label>
                                        <select name="gender" class="form-control">
                                            <option value="" >-----Giới tính-----</option>
                                            <option value="1" {{(($profile->gender =='1') ? 'selected' : '')}}>Nam</option>
                                            <option value="2" {{(($profile->gender =='2') ? 'selected' : '')}}>Nữ</option>
                                            <option value="3" {{(($profile->gender =='3') ? 'selected' : '')}}>Giới tính khác</option>
                                        </select>
                                      </div>

                                    <button type="submit" class="btn btn-success btn-sm">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- /# row -->
        </section>
    </div>
    </div>
</div>
@endsection
<style>
    .breadcrumbs{
        list-style: none;
    }
    .breadcrumbs li{
        float:left;
        margin-right:10px;
    }
    .breadcrumbs li a:hover{
        text-decoration: none;
    }
    .breadcrumbs li .active{
        color:red;
    }
    .breadcrumbs li+li:before{
      content:"/\00a0";
    }
    .image{
        background:url('{{asset('/public/storage/photos/4/background.jpg')}}');
        height:150px;
        background-position:center;
        background-attachment:cover;
        position: relative;
    }
    .image img{
        position: absolute;
        top:55%;
        left:35%;
        margin-top:30%;
    }
    i{
        font-size: 14px;
        padding-right:8px;
    }

}
  </style>
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


