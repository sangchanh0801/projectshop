@extends('admin.layouts.master')
@section('title')
<title>Edit Category Product</title>
@endsection
@section('nametitle')
    Edit_Categorry_Product
@endsection
@section('content')

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>CẬP NHẬT DANH MỤC SẢN PHẨM</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">

                                    <form action={{route('updatecategoryproduct', $edit_category->category_id)}} method="post">
                                        @csrf
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Tên danh mục sản phẩm</p>
                                            <input type="text" class="form-control input-flat" placeholder="Nhập danh mục sản phẩm " name="category_name" value="{{$edit_category->category_name}}" id="title" onkeyup="ChangeToSlug();">
                                            @if ($errors->has('category_name'))
                                            <strong style="color: red">{{$errors->first('category_name')}}</strong>

                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Slug</p>
                                            <input type="text" class="form-control input-flat" placeholder="Slug" name="category_slug" id="slug"  value="{{$edit_category->category_slug}}">
                                            @if ($errors->has('category_slug'))
                                                <strong style="color: red"> {{$errors->first('category_slug')}}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Mô tả danh mục sản phẩm</p>
                                            <textarea  class="form-control input-flat" style="height: 300px" placeholder="Mô tả sản phẩm " name="category_desc" >{{$edit_category->category_desc}}</textarea>
                                            @if ($errors->has('category_desc'))
                                            <strong style="color: red"> {{$errors->first('category_desc')}}</strong>
                                            @endif
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-default">Cập nhật danh mục sản phẩm</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('scripts')
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
