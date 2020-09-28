<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- -------------Seo--------------------------------- -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link  rel="canonical" href="http://dinhhuy.com/index" />
    <meta name="keywords" content="Pham Nguyen Dinh Huy"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="title" content="Duy Nguyễn Gym Phổ - Giáo án thể hình đẳng cấp nhất"/>
    <link  rel="icon" type="image/x-icon" href="" />
<!-- -------------Seo--------------------------------- -->
    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettify.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('Eshopper/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">

</head><!--/head-->

<body>

@include('frontend.header')	

	

		 @yield('content')

	
@include('frontend.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('Eshopper/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/lightslider.js')}}"></script>
    <script src="{{asset('Eshopper/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/prettify.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.js')}}"></script>
	<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('Eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('Eshopper/js/main.js')}}"></script><!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
                page_id="100319228497505"
          logged_in_greeting="Hi! Chào mừng bạn đến shop."
          logged_out_greeting="Hi! Chào mừng bạn đến shop.">
      </div>

    <script type="text/javascript">
        $(document).ready(function(){
             $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = ' ';
                if(action == 'city'){
                    result = 'district';
                }else{
                    result = 'wards';
                }
               $.ajax({
                        url: "{{url('/select-delivery/checkout')}}",
                        method: "POST",
                        data: {action:action,ma_id:ma_id,_token:_token},
                        success: function (data) {
                            $('#'+result).html(data);

                        },
                        error: function() {
                           console.log(t);
                        }
                    });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            
           
            $('.add-to-cart').click(function(){
                var id = $(this).data('id');
                var cart_product_id = $('.cart_product_id_' +id).val();
                var cart_product_name = $('.cart_product_name_' +id).val();
                var cart_product_image = $('.cart_product_image_' +id).val();
                var cart_product_quantity = $('.cart_product_quantity_' +id).val();
                var cart_product_price = $('.cart_product_price_' +id).val();
                var cart_product_qty = $('.cart_product_qty_' +id).val();

                var _token = $('input[name="_token"]').val();
                if (cart_product_qty > cart_product_quantity){
                    alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
                }else{
                     $.ajax({
                        url: "{{url('/add-cart-ajax')}}",
                        type: "post",
                        data: {cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image,cart_product_price:cart_product_price, cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                        success: function (response) {
                            alert('Đã thêm sản phẩm thàng công');

                        },
                        error: function() {
                           console.log(t);
                        }
                    });
                }
                
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
             $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.district').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp =='' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                  $.ajax({
                        url: "{{url('/calculate-fee')}}",
                        method: "POST",
                        data: {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                        success: function (data) {
                            location.reload(); 

                        },
                        error: function() {
                           console.log(t);
                        }
                    });
               }
            }) ; 
         });
    </script>
      <script type="text/javascript">
            $(document).ready(function(){
             $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },  
                function(isConfirm){
                    if(isConfirm){
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_note = $('.shipping_note').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var shipping_method = $('.payment_select').val();
                        var _token = $('input[name="_token"]').val();
                         $.ajax({
                                url: "{{url('/confirm-order')}}",
                                type: "POST",
                                data: {shipping_email:shipping_email, shipping_name:shipping_name, shipping_address:shipping_address,shipping_phone:shipping_phone, shipping_note:shipping_note,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method,_token:_token},
                                success: function (response) {
                                    swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                                   

                                },
                                error: function() {
                                   console.log(t);
                                }
                            });
                         window.setTimeout(function(){
                            location.reload();
                         },3000);
                     }else{
                        swal("Đóng", "Đơn hàng của bạn chưa được gửi", "error");
                     }
                    
                });
                
                });


            });
        </script>  
</body>
</html>