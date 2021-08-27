@extends('admin.layouts.master')
@section('title')
<title>Thêm thư viện ảnh</title>
@endsection
@section('nametitle')
   Thêm thư viện ảnh
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Thêm thư viện ảnh</h4>
                    <form action="{{route('insertgallery', $pro_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <span id="error_gallery"></span>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="hidden" value="{{$pro_id}}" name="pro_id" class = "pro_id">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" class="file" name="file" value="{{old('file')}}">
                              </div>
                            </div>
                            {{-- <input type="file" id="file" data-input="thumbnail" name="file[]" data-preview="holder" accept="image/*" multiple class="btn btn-primary"> --}}
                            <button type="submit" class="btn btn-info btn-outline m-b-10 m-l-5 add_gallery">Tải ảnh</button>
                            {{-- @if (session()->has('mess'))
                            {{session()->get('mess')}}
                            @endif --}}
                        </span>
                    </div>
                    </form>
                </div>
                <div class="bootstrap-data-table-panel">
                    <form>
                    @csrf
                    <div class="table-responsive" id="load_gallery">
                        <input type="hidden" value="{{$pro_id}}" name="pro_id" class = "pro_id">
                    </div>
                    </form>
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
  <script type="text/javascript">
    $(document).ready(function(){  
        load_gallery();
        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url: '{{url('/admin/select_gallery')}}',
                method: 'POST',
                data :{pro_id:pro_id, _token:_token},
                success:function(data){
                    $('#load_gallery').html(data);
                }
            });
        }
        $('.add_gallery').click(function(){
            var pro_id = $('.pro_id').val();
            var files =  $('.file').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            // alert(file);
                $.ajax({
                    url: '{{url('/admin/insert_gallery')}}',
                    method: 'POST',
                    data :{pro_id:pro_id,files:files,_token:_token},
                    success:function(data){
                        // swal("Thêm hình ảnh thành công");
                        load_gallery();
                    }
                });
        });
        $(document).on('blur', '.edit_gal_id', function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/admin/update_gallery')}}',
                method: 'POST',
                data :{gal_text:gal_text, gal_id:gal_id, _token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span>Cập nhật tên hình ảnh thành công</span>');
                }
            });
        })
        $(document).on('click', '.delete_gallery', function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn có muốn xóa hình ảnh này không?')) {
                $.ajax({
                url: '{{url('/admin/delete_gallery')}}',
                method: 'POST',
                data :{gal_id:gal_id, _token:_token},
                success:function(data){
                    load_gallery();
                }
            });
            }

        })
    });
</script>
@endpush
