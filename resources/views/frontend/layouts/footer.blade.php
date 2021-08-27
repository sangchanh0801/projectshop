<!-- Footer Start -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    @php
                        $settings=DB::table('settings')->first();
                    @endphp
                    <h2>Thông tin liên hệ</h2>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i> {{$settings->setting_address}}</p>
                        <p><i class="fa fa-envelope"></i> {{$settings->setting_email}}</p>
                        <p><i class="fa fa-phone"></i> {{$settings->setting_phone}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Follow Shop</h2>
                    <div class="contact-info">
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $brand = DB::table('brand_products')->where('brand_status', 1)->take(3)->get();
            @endphp
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Thương hiệu</h2>
                    <ul>
                        @foreach ($brand as $bra)
                            <li><a href="#">{{$bra->brand_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @php
                $category_product = DB::table('category_products')->where('category_status', 1)->take(3)->get();
            @endphp
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Danh mục sản phẩm</h2>
                    <ul>
                        @foreach ($category_product as $cate)
                        <li><a href="#">{{$cate->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row payment align-items-center">
            <div class="col-md-6">
                <div class="payment-method">
                    <h2>We Accept:</h2>
                    <img src="{{asset('public/frontend/img/payment-method.png')}}" alt="Payment Method" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-security">
                    <h2>Đảm bảo:</h2>
                    <img src="{{asset('public/frontend/img/godaddy.svg')}}" alt="Payment Security" />
                    <img src="{{asset('public/frontend/img/norton.svg')}}" alt="Payment Security" />
                    <img src="{{asset('public/frontend/img/ssl.svg')}}" alt="Payment Security" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
            </div>
            <div class="col-md-6 template-by">
                <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->
 <!-- Back to Top -->
 <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- JavaScript Libraries -->
<script src="{{asset('public/frontend/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/frontend/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('public/frontend/lib/slick/slick.min.js')}}"></script>
<script src={{asset('public/frontend/js/jquery-ui.js')}}></script>
<!-- Template Javascript -->
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="{{asset('public/frontend/lib/easing/sweetalert.js')}}"></script>
<script src="{{asset('public/frontend/js/simple.money.formats.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('.add-to-cart').click(function(){
        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var cart_product_number = $('.cart_product_number_'+ id).val();
        var _token = $('input[name="_token"]').val();
        if (parseInt(cart_product_number) <= parseInt(cart_product_qty)) {
            swal("Số lượng hàng không đủ");
        }else{
            $.ajax({
            url: '{{url('/add-cart-ajax')}}',
            method: 'POST',
            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_number:cart_product_number,_token:_token},
            success:function(){
                swal({
                        title: "Đã thêm sản phẩm vào giỏ hàng",
                        text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                        showCancelButton: true,
                        cancelButtonText: "Xem tiếp",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Đi đến giỏ hàng",
                        closeOnConfirm: false
                    },
                    function() {
                        window.location.href = "{{url('/cart')}}";
                    });
            }
        });
        // alert(cart_product_number);
        }

    });
});
</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
                            var action = $(this).attr('id');
                            var ma_id = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            var result = '';
                            if (action == 'city') {
                                result = 'province';
                            }else{
                                result = 'wards';
                            }
                            $.ajax({
                                url: '{{url('/select-delivery-home')}}',
                                method: 'POST',
                                data :{action:action,ma_id:ma_id,_token:_token},
                                success:function(data){
                                    $('#' +result).html(data);
                                }
                            });
                        });
        });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.calculate_delivery').click(function(){
        var matp = $('.city').val();
        var maqh = $('.province').val();
        var xaid = $('.wards').val();
        var _token = $('input[name="_token"]').val();
        if (matp == '' && maqh == '' && xaid == '') {
            alert('Nhập thông tin để tính phí vận chuyển');
        }
        $.ajax({
            url: '{{url('/calculate-delivery')}}',
            method: 'POST',
            data :{matp:matp, maqh:maqh,xaid:xaid, _token:_token},
            success:function(){
                location.reload();
            }
        });
    });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.send-order').click(function(){
                swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ không được hoàn trả, bạn có muốn đặt không? ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Cảm ơn, mua hàng",
                    cancelButtonText: "No, cancel, pls",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_fname = $('.shipping_fname').val();
                            var shipping_lname = $('.shipping_lname' ).val();
                            var shipping_email = $('.shipping_email').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.shipping_method').val();
                            var order_coupon = $('.order_coupon').val();
                            var order_fee = $('.order_fee').val();
                            var city = $('.city').val();
                            var province = $('.province').val();
                            var wards = $('.wards').val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: '{{url('/confirm-order')}}',
                                method: 'POST',
                                data:{shipping_fname:shipping_fname,shipping_lname:shipping_lname,shipping_email:shipping_email,
                                    shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_notes:shipping_notes,
                                    shipping_method:shipping_method,order_coupon:order_coupon,order_fee:order_fee,
                                    city:city,province:province,wards:wards,_token:_token},
                                success:function(){
                                    swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                             }
                            });
                                window.setTimeout(function(){
                                    location.reload();
                                },3000);
                            }else {
                                    swal("Đóng", "Đơn hàng chưa được gửi)", "error");
                            }
                });
        });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function(){
        load_comment();
        function load_comment(){
            var post_id = $('.post_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url: '{{url('/load_comment')}}',
            method: 'POST',
            data :{post_id:post_id, _token:_token},
            success:function(data){
                $('#show_comment').html(data);
            }
        });
        }
        $('.send_comment').click(function(){
        var post_id = $('.post_id').val();
        var comment_content = $('.comment_content').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/send_comment')}}',
            method: 'POST',
            data :{post_id:post_id,comment_content:comment_content, _token:_token},
            success:function(){
                swal('Cám ơn bình luận của bạn');
                load_comment();
            }
        });
    });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        load_product_comment();
        function load_product_comment(){
            var product_id = $('.product_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(product_id);
            $.ajax({
            url: '{{url('/load_product_comment')}}',
            method: 'POST',
            data :{product_id:product_id, _token:_token},
            success:function(data){
                $('#show_product_comment').html(data);
            }
        });
        }
        $('.send_product_comment').click(function(){
        var product_id = $('.product_id').val();
        var product_comment = $('.product_comment').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/send_product_comment')}}',
            method: 'POST',
            data :{product_id:product_id,product_comment:product_comment, _token:_token},
            success:function(){
                swal('Cám ơn bình luận của bạn');
                load_product_comment();
            }
        });
    });

    });
</script>

<script type="text/javascript">
    function remove_background(product_id){
        for(var count = 1; count<=5; count++){
            $('#'+product_id+'-'+count).css('color', 'gray');
        }
    }
    $(document).on('mouseenter','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        // alert(index);
        // alert(product_id);
        remove_background(product_id);
        for(var count = 1; count<=index; count++){
            $('#'+product_id+'-'+count).css('color', 'red');
        }
    });
    $(document).on('mouseleave','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        // var rating = $(this).data('rating');
        remove_background(product_id);
        // for(var count = 1; count<=5; count++){
        //     $('#'+product_id+'-'+count).css('color', 'gray');
        // }
    });
    $(document).on('click','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/insert_rating')}}',
            method: 'POST',
            data :{index:index,product_id:product_id, _token:_token},
            success:function(data){
                if (data == 'done') {
                   swal('Cám ơn bạn đã đánh giá');
                }else{
                    alert('Lỗi đánh giá');
                }

            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#sort').on('change', function(){
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#slider-range" ).slider({
            orientation: "horizontal",
            range: true,
            max: {{$max}},
            min: {{$min}},
            step: 10000,
            values: [ {{$min}}, {{$max}} ],
            slide: function( event, ui ) {
            $( "#amount_start" ).val( ui.values[ 0 ] + ' - ').simpleMoneyFormat();
            $( "#amount_end" ).val( ui.values[ 1 ]).simpleMoneyFormat();
                $("#start_price").val(ui.values[ 0 ]);
                $("#end_price").val(ui.values[ 1 ]);
            }
        });
            $( "#amount_start" ).val( $( "#slider-range" ).slider( "values", 0 )+ ' - ').simpleMoneyFormat();
            $( "#amount_end" ).val( $( "#slider-range" ).slider( "values", 1 )).simpleMoneyFormat();
    });
    </script>
