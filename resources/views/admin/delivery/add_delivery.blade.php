@extends('admin.layouts.master')
@section('title')
<title>Add Delivery</title>
@endsection
@section('nametitle')
    Add_Delivery
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-8" style="margin: auto">
                    <div class="card">
                        <div class="card-title">
                            <h4>THÊM PHÍ VẬN CHUYỂN</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form >
                                    @csrf
                                    <div class="form-group">
                                        <label>Chọn tỉnh-thành phố</label>
                                            <select class="form-control choose city" name="city" id="city" >
                                                <option value="">--Chọn tỉnh thành phố--</option>
                                                @foreach ($city as $ci)
                                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Chọn quận huyện</label>
                                            <select class="form-control province choose" name="province" id="province">
                                                <option value="">--Chọn quận huyện--</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Chọn xã phường thị trấn</label>
                                            <select class="form-control wards" name="wards" id="wards">
                                                <option value="">--Chọn xã phường--</option>

                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted m-b-15 f-s-12">Phí vận chuyển</p>
                                        <input type="text" class="form-control input-flat fee_ship" placeholder="Nhập phí vận chuyển " name="fee">
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-default add_delivery">Thêm phí vận chuyển</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4>Danh sách phí vận chuyển </h4>
                        </div>
                        <div class="bootstrap-data-table-panel" id="load_delivery">

                        </div>
                    </div>
                </div>


            </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/admin/selectfeeship')}}',
                method: 'POST',
                data :{_token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit' ,function(){
            var feeship_id = $(this).data('feeship_id');
            var feeship_value = $(this).text();
            // alert(feeship_id);
            // alert(feeship_value);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/admin/updatefeeship')}}',
                method: 'POST',
                data :{_token:_token, feeship_id:feeship_id, feeship_value:feeship_value},
                success:function(data){
                    fetch_delivery();
                }
            });

        });
        $('.add_delivery').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/admin/add-feeship')}}',
                method: 'POST',
                data :{city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function(data){
                    swal("Thêm phí thành công");
                    fetch_delivery();
                }
            });
        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp);
            // alert(_token);
            if (action == 'city') {
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url: '{{url('/admin/selectdelivery')}}',
                method: 'POST',
                data :{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#' +result).html(data);
                }
            });
        });
    });
</script>
@endpush
