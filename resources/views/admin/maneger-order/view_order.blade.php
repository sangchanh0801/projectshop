@extends('admin.layouts.master')
@section('title')
<title>Order</title>
@endsection
@section('nametitle')
    Order
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Thông tin người mua</h4>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>Tên người đặt</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Thông tin vận chuyển</h4>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">

                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                <tr>
                                    <th>Tên người nhận hàng</th>
                                    <th>Địa chỉ nhà</th>
                                    <th>Thành phố</th>
                                    <th>Quận huyện</th>
                                    <th>Phường xã</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$shipping->shipping_fname}} {{$shipping->shipping_lname}}</td>
                                    <td>{{$shipping->shipping_address}}</td>
                                    <td>{{$city->name_city}}</td>
                                    <td>{{$province->name_quanhuyen}}</td>
                                    <td>{{$wards->name_xaphuong}}</td>
                                    <td>{{$shipping->shipping_phone}}</td>
                                    <td>{{$shipping->shipping_email}}</td>
                                    @if ($shipping->shipping_method == 1)
                                        <td>Thanh toán bằng ATM</td>
                                    @else
                                        <td>Thanh toán bằng tiền mặt</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Chi tiết đơn hàng</h4>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover" >
                            <thead>
                                @php
                                $i = 1;
                                $total = 0;
                                $subtotal = 0;
                                @endphp
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Gía</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $detail)
                                    @php
                                        $total = $detail->product_price * $detail->product_sales_quantity;
                                        $subtotal += $total;
                                    @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$detail->product_name}}</td>
                                        <td>{{number_format($detail->product_price,0, ',', '.')}} VNĐ</td>
                                        <td>{{$detail->product_sales_quantity}}</td>
                                        <input type="hidden" value="{{$detail->product_sales_quantity}}" name="product_sales_quantity">
                                        <input type="hidden" value="{{$detail->product_id}}" name="order_product_id">
                                        <td>{{number_format($total, 0, ',','.')}} VNĐ</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td style="font-weight: bold">Phí vận chuyển: {{number_format($product_feeship, 0, ',','.')}} VNĐ</td>
                                        @if ($coupon_type == 1)
                                            @php
                                                $total_after_coupon = ($coupon_value*$subtotal)/100;
                                                $total_coupon = $subtotal - $total_after_coupon + $product_feeship;
                                            @endphp
                                            <td style="font-weight: bold">Gỉam giá: {{number_format($total_after_coupon, 0, ',','.')}} VNĐ</td>
                                        @else
                                            @php
                                                $total_after_coupon = $coupon_value;
                                                $total_coupon = $subtotal - $coupon_value+ $product_feeship;
                                            @endphp
                                                <td style="font-weight: bold">Gỉam giá: {{number_format($total_after_coupon, 0, ',','.')}} VNĐ</td>
                                        @endif
                                        <td style="font-weight: bold">Thanh toán: {{number_format($total_coupon, 0, ',','.')}} VNĐ</td>
                                        <td>
                                            @foreach ($order as $or)
                                                @if ($or->order_status == 1)
                                                <form>
                                                    @csrf
                                                        <label>Xử lí đơn hàng</label>
                                                            <select class="form-control order_detail" name="banner_status">
                                                                <option value="" >---Chọn hình thức---</option>
                                                                <option value="1" disabled selected id="{{$or->order_id}}">Đơn hàng mới</option>
                                                                <option value="2" id="{{$or->order_id}}">Đơn hàng đã xử lí</option>
                                                            </select>
                                                </form>
                                                @else
                                                <form>
                                                    @csrf
                                                        <label>Xử lí đơn hàng</label>
                                                            <select class="form-control order_detail" name="banner_status">
                                                                <option value="" >---Chọn hình thức---</option>
                                                                <option value="1" disabled id="{{$or->order_id}}">Đơn hàng mới</option>
                                                                <option value="2" id="{{$or->order_id}}"selected>Đơn hàng đã xử lí</option>
                                                            </select>
                                                </form>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.order_detail').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        quantity = [];
        $("input[name = 'product_sales_quantity']").each(function(){
            quantity.push($(this).val())
        })
        order_product_id = [];
        $("input[name = 'order_product_id']").each(function(){
            order_product_id.push($(this).val())
        })
        $.ajax({
                url: '{{url('/admin/update_order')}}',
                method: 'POST',
                data :{order_status:order_status,order_id:order_id,quantity:quantity,
                    order_product_id:order_product_id,_token:_token},
                success:function(data){
                   alert('CẬP NHẬT ĐƠN HÀNG THÀNH CÔNG');
                }
            });
    });
</script>
@endpush
