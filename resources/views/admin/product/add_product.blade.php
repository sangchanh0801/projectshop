@extends('admin.layouts.master')
@section('title')
<title>Thêm sản phẩm</title>
@endsection
@section('nametitle')
Thêm sản phẩm
@endsection
@section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Thêm sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-elements">
                            <form action="{{route('saveproduct')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <input type="text" class="form-control" placeholder="Tên sản phẩm" name="product_name" value="{{old('product_name')}}" id="title" onkeyup="ChangeToSlug();">
                                            @if ($errors->has('product_name'))
                                                <strong style="color: red">{{$errors->first('product_name')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Slug</p>
                                            <input type="text" class="form-control input-flat" placeholder="Slug" name="product_slug" id="slug">
                                            @if ($errors->has('product_slug'))
                                                <strong style="color: red"> {{$errors->first('product_slug')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Gía sản phẩm</label>
                                            <input type="text" data-validation="lenght" data-validation-lenght="min10" class="form-control price_format" placeholder="Gía sản phẩm" name="product_price" value="{{old('product_price')}}">
                                            @if ($errors->has('product_price'))
                                                <strong style="color: red">{{$errors->first('product_price')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Gía gốc sản phẩm</label>
                                            <input type="text" data-validation="lenght" data-validation-lenght="min10" class="form-control price_format2" placeholder="Gía gốc sản phẩm" name="product_cost" value="{{old('product_cost')}}">
                                            @if ($errors->has('product_cost'))
                                                <strong style="color: red">{{$errors->first('product_cost')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPhoto" class="col-form-label">Hình ảnh sản phẩm <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Chọn
                                                    </a>
                                                </span>
                                            <input id="thumbnail" class="form-control" type="text" name="product_image" value="{{old('product_image')}}">
                                          </div>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @if ($errors->has('product_image'))
                                                <strong style="color: red">{{$errors->first('product_image')}}</strong>
                                        @endif
                                        <div class="form-group">
                                            <label>Nội dung sản phẩm</label>
                                            <textarea class="form-control" style="height: 150px" id="ckeditor" placeholder="Nội dung sản phẩm" name="product_content" >{{old('product_content')}}</textarea>
                                            @if ($errors->has('product_content'))
                                                <strong style="color: red">{{$errors->first('product_content')}}</strong>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Số lượng sản phẩm</label>
                                            <input type="number" min="1" class="form-control" placeholder="Số lượng sản phẩm" name="product_number" value="{{old('product_number')}}">
                                            @if ($errors->has('product_number'))
                                                <strong style="color: red">{{$errors->first('product_number')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Danh mục sản phẩm</label>
                                                <select class="form-control" name="product_cate">
                                                    <option value="">---Chọn danh muc sản phẩm---</option>
                                                    @foreach ($category as $cate )
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Thương hiệu sản phẩm</label>
                                            <select class="form-control" name="product_brand">
                                                @php
                                                    $brand = DB::table('brand_products')->get();
                                                @endphp
                                                <option value="">---Chọn thương hiệu sản phẩm---</option>
                                                @foreach ($brand as $bra)
                                                <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="size">Size</label> <br>
                                            @for ($i =38; $i <47 ; $i++)
                                            <input type="checkbox"  name="size[]" value="{{$i}}">
                                                <label for="">{{$i}}</label><br>
                                            @endfor
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả sản phẩm</label>
                                            <textarea class="form-control" style="height: 150px" id="ckeditor1" placeholder="Mô tả sản phẩm" name="product_desc" >{{old('product_desc')}}</textarea>
                                            @if ($errors->has('product_desc'))
                                                <strong style="color: red">{{$errors->first('product_desc')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Hiển thị</label>
                                                <select class="form-control" name="product_status">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Ẩn</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default">Thêm sản phẩm</button>
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
<script src="{{asset('/public/backend/js/simple.money.formats.js')}}"></script>
<script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
    $('.price_format2').simpleMoneyFormat();
</script>

<script src="{{asset('/public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="http://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
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
