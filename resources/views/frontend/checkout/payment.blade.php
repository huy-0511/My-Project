@extends('frontend.master')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<!-- <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								 @if($errors->any())
						              <div class="alert alert-danger">
						                  <ul>
						                    @foreach($errors->all() as $error)
						                    <li>{{ $error }}</li>
						                    @endforeach
						                  </ul>
						              </div>
						        @endif
								@if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
                                        {{session('success')}}
                                    </div>
                         		@endif
								<form action="" method="POST">
									@csrf
									<input type="text" name="shipping_email" placeholder="Email">
									<input type="text" name="shipping_name" placeholder="Họ và tên">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
									<input type="text" name="shipping_phone" placeholder="Phone">
									<textarea name="shipping_note" placeholder="ghi chú đơn hàng của bạn" rows="10"></textarea>
									<input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							
						</div>
					</div>
			
				</div>
			</div> -->
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
					<div class="table-responsive cart_info">
				
			<form action="{{url('/update-cart')}}" method="post">
				@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sp</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
			 @if($errors->any())
	              <div class="alert alert-danger">
	                  <ul>
	                    @foreach($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                    @endforeach
	                  </ul>
	              </div>
	        @endif
			@if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
                    {{session('success')}}
                </div>
     		@endif
				@if(Session::get('cart') == true)
					<?php 
						$total = 0;
					 ?>
					@foreach(Session::get('cart') as $cart)


						<tr>
							<td class="cart_product">
								<a href="#"><img src="{{asset('product/'.$cart['product_image'])}}" alt="{{$cart['product_image']}}" width="90" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="#"></a></h4>
								<p>{{$cart['product_name']}} </p>
							</td>
							<td class="cart_price">
								<p><?php echo number_format($cart['product_price']); ?>đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
										
										<!-- <a class="cart_quantity_up" href=""> + </a> -->
										<input class="cart_quantity" type="number" name="qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="1">
										<!-- <input type="hidden" value="" name="rowId_cart" class="form_control"> -->
										
										<!-- <a class="cart_quantity_down" href=""> - </a> -->
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php  
								$subtotal = $cart['product_price'] * $cart['product_qty'];
								$total += $subtotal;

								?>
								 	<?php echo number_format($subtotal); ?>
								 </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-sp/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach
				
					@else
						<?php echo 'alert("vui lòng thêm sản phẩm vào giỏ hàng");' ?>
					@endif
					</tbody>
				</table>
			 </form>
			</div>
			<h4 style="margin: 40px 0; font-size: 20px ">Chọn hình thức thành toán</h4>
			
			<form method="post" action="">
				@csrf
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox">Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox">Nhận tiền mặt</label>
					</span>
					<input type="submit" value="Đặt Hàng" name="send_order_place" class="btn btn-primary btn-sm">
					<!-- <span>
						<label><input type="checkbox"> Paypal</label>
					</span> -->
				</div>
			</form>
		</div>
	</section> 
@endsection