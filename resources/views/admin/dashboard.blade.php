@extends('admin.layouts.master')
@section('title')
    <title>Admin</title>
@endsection
@section('card')
    <span>Thống kê đơn hàng doanh số</span>
@endsection
{{-- @section('nametitle')
    Trang chủ
@endsection --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form autocomplete="off">
                @csrf
                {{-- <div class="col-md-2"> --}}
                    <label> Từ ngày: <input type="text" id="datepicker" class="form-control"></label>
                    <label> Đến ngày: <input type="text" id="datepicker2" class="form-control"></label>
                    <label>
                        Lọc theo:
                        <select class="form-control" id="dashboard_filter">
                            <option>----Chọn----</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="Thangtruoc">Tháng trước</option>
                            <option value="Thangnay">Tháng này</option>
                            <option value="365ngay">365 ngày qua</option>
                        </select>
                    </label>
                    <div class="col-md-2">
                        <input type="button" class="btn btn-pink btn-rounded m-b-10 m-l-5" value="Lọc kết qủa" id="btn_dashboard_filter">
                    </div>

                {{-- </div> --}}
                {{-- <div class="col-md-2"> --}}

                {{-- </div> --}}
            </form>
            <div class="card-body">
                <div class="col-md-12 ">
                    <div id="myfirstchart" style="height: 250px"></div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-title">
                    <h4>Thống kê số lượng của shop</h4>
                </div>
                <div class="card-body" id="donut">

                </div>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script  type="text/javascript">
    $(function(){
        $('#datepicker').datepicker({
            closeText: "Đóng",
		prevText: "Trước",
		nextText: "Sau",
		currentText: "Hôm nay",
		monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
		monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
		dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
		dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
		dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
		weekHeader: "Tuần",
		dateFormat: "yy-mm-dd",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
        });
        $('#datepicker2').datepicker({
            closeText: "Đóng",
		prevText: "Trước",
		nextText: "Sau",
		currentText: "Hôm nay",
		monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
		monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
		dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
		dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
		dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
		weekHeader: "Tuần",
		dateFormat: "yy-mm-dd",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
            chart30Day();
            var chart = new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            parseTime: false,
            lineColors: ['#9999FF','#FF9900	','#009900','#FF6600', '#00CCFF'],
            hideHover: 'auto',
            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['order', 'sale', 'profit', 'quantity'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
            });

            function chart30Day(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: '{{url('/admin/day_filter')}}',
                    method: 'POST',
                    dataType :"JSON",
                    data :{_token:_token},
                    success:function(data){
                        chart.setData(data);
                    }
                });
        }
        $('#btn_dashboard_filter').click(function(){
           var from_date = $('#datepicker').val();
           var end_date = $('#datepicker2').val();
           var _token = $('input[name="_token"]').val();
           $.ajax({
                url: '{{url('/admin/filter_by_day')}}',
                method: 'POST',
                dataType :"JSON",
                data :{from_date:from_date,end_date:end_date, _token:_token},
                success:function(data){ 
                    chart.setData(data);
                }
            });

        })
        $('#dashboard_filter').click(function(){
           var dashboard_value = $(this).val();
           var _token = $('input[name="_token"]').val();
           $.ajax({
                url: '{{url('/admin/dashboard_filter')}}',
                method: 'POST',
                dataType :"JSON",
                data :{dashboard_value:dashboard_value, _token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });

        })


    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var donut = Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#c934eb',
            '#34abeb',
            '#ebdb34',
            '#56eb34',
        ],
        //labelColor:"#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [
            {label:"Sản phẩm", value: <?php echo $count_product ?>},
            {label:"Thương hiệu", value:<?php echo $count_brand ?>},
            {label:"Bài viết", value:<?php echo $count_post ?>},
            {label:"Loại sản phẩm", value:<?php echo $count_cate_product ?>},
        ]
        });
    });
</script>
@endpush
