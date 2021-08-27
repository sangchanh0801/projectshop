@extends('admin.layouts.master')
@section('title')
<title>Thêm Tags</title>
@endsection
@section('nametitle')
    Thêm tags
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto" >
                    <div class="card">
                        <div class="card-title">
                            <h4>Thêm Tags bài viết</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{route('savetag')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Tên tags</p>
                                        <input type="text" class="form-control input-flat" placeholder="Nhập tên tag" name="tag_name" id="title" onkeyup="ChangeToSlug();">
                                        {{-- @if ($errors->has('brand_name'))
                                            <strong style="color: red"> {{$errors->first('brand_name')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Slug</p>
                                        <input type="text" class="form-control input-flat"  name="tag_slug" id="slug">
                                        {{-- @if ($errors->has('brand_image'))
                                            <strong style="color: red"> {{$errors->first('brand_image')}}</strong>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                            <select class="form-control" name="tag_status">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Thêm tag</button>
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
