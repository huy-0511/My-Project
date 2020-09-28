@extends('frontend.master')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="register-req">
			<p>Làm ơn đăng kí hoặc đăng nhập để thanh toán giỏ hàng và xem lại lich sử mua hàng</p>
		</div><!--/register-req-->

		<div class="shopper-informations">
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
					<form method="post">
						@csrf
						<input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
						<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
						<input type="text" name="shipping_address"class="shipping_address"  placeholder="Địa chỉ">
						<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone">
						<textarea name="shipping_note" class="shipping_note" placeholder="ghi chú đơn hàng của bạn" rows="10"></textarea>
						@if(Session::get('fee'))
							<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
						@else
							<input type="hidden" name="order_fee" class="order_fee" value="10000">
						@endif

						@if(Session::get('coupon'))
						  @foreach(Session::get('coupon') as $key => $cou)
							<input type="hidden" name="order_coupon" value="{{$cou['coupon_code']}}" class="order_coupon" >
						  @endforeach	
						@else
							<input type="hidden" name="order_coupon" class="order_coupon" value="không có mã giảm giá">
						@endif
						<div class="">
							 <div class="form-group">
		                        <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                          <select name="payment_select" id="payment_select" class="form-control input-sm m-bot15 payment_select">
		                                <option value="0">Thanh toán qua ATM</option>
		                                <option value="1">Tiền mặt</option>
		                                
		                        </select>
		                    </div>
						</div>
							<input type="button" value="Xác nhận đơn hàng" id="send_order" class="btn btn-primary btn-sm send_order">
					</form>
			<form>
                 @csrf 
             
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn thành phố</label>
                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                    
                            <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach($city as $key => $ci)
                            <option value="{{$ci['id']}}">{{$ci['name_city']}}</option>
                        @endforeach
                            
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                      <select name="district" id="district" class="form-control input-sm m-bot15 district choose">
                            <option value="">--Chọn quận huyện--</option>
                            
                    </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Chọn xã phường</label>
                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                            <option value="">--Chọn xã phường--</option>   
                    </select>
                </div>
               
               <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">	
            </form>
							
						</div>
						
					</div>
				</div>
				<div class="col-sm-12 clearfix">
		<div class="table-responsive cart_info">
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
				<tr>
					<td>
						<input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm">
						<a class="btn btn-default check_out" href="{{url('/delete-all-sp')}}">Xóa tất cả giỏ hàng</a>
					</td>
					<td>
						<div class="total_area">
					<ul>
						<li>Tổng :<span><?php echo number_format($total); ?>
						
						</span></li>
						@if(Session::get('coupon'))
						<li>
							
								@foreach(Session::get('coupon') as $key =>$cou)
									@if($cou['coupon_condition'] == 1)
										Mã giảm : <span>{{$cou['coupon_number']}} %</span>
										<p>
											<?php 
												$totalCoupon = ($total*$cou['coupon_number'])/100;
												

											 ?>
										</p>
										<p>
											<!-- <li>Tổng đã giảm : <span><?php echo number_format($total - $totalCoupon); ?> đ</span></li> -->
											<?php $total_after_coupon = $total - $totalCoupon; ?>
										</p>
									@elseif($cou['coupon_condition']==2)
										Mã giảm <span>{{$cou['coupon_number']}} k</span>
										<p>
											<?php 
												$totalCoupon = $total - $cou['coupon_number'];
												
											 ?>
										</p>
										<p>
											<!-- <li>Tổng đã giảm :<span><?php echo number_format($totalCoupon); ?> đ</span></li> -->
											<?php $total_after_coupon = $totalCoupon; ?>
										</p>
									@endif
								@endforeach
							
						</li>
						@endif

						@if(Session::get('fee'))
						<li>
						<a class="cart_quantity_delete" href="{{url('/delete-fee')}}"><i class="fa fa-times"></i></a>
						Phí vận chuyển <span><?php echo number_format(Session::get('fee')); ?></span></li>
							<?php 
								$total_after_fee = $total - Session::get('fee');
								
							 ?>
						@endif

						<li>Tổng còn<span>
						@if(Session::get('fee') && !Session::get('coupon'))
							<?php $total_after = $total_after_fee;
								echo number_format($total_after);
							 ?> 
						@elseif(!Session::get('fee') && Session::get('coupon'))
							<?php $total_after = $total_after_coupon;
								echo number_format($total_after);
							 ?>
						@elseif(Session::get('fee') && Session::get('coupon'))
							<?php 
							$total_after = $total_after_coupon;
							$total_after = $total_after - Session::get('fee'); 
								echo number_format($total_after);
							?>
						@elseif(!Session::get('fee') && !Session::get('coupon'))
							<?php 
							$total_after = $total; 
							echo number_format($total_after);
							?>
						@endif
						</span></li>
					</ul>
						<!-- <a class="btn btn-default update" href="">Update</a> -->

						
						

				</div>
					</td>
					
				</tr>
				@else
					<?php echo 'alert("vui lòng thêm sản phẩm vào giỏ hàng");' ?>
				@endif
				</tbody>
			</table>
		  </form>
		</div>
	</div>
</section> <!--/#cart_items-->
	<section id="do_action">
	<div class="container">
		@if(Session::get('cart'))
		<tr>
			<td>
				<form method="POST" action="{{url('/check-coupon')}}">
					@csrf
					<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
					<input type="submit" class="btn btn-default check_coupon" value="Tính mã giảm giá" name="check_coupon">
					@if(Session::get('coupon'))
					<a class="btn btn-default check_out" href="{{url('/delete-coupon')}}">Xóa mã khuyến mãi</a>
					@endif
				</form>
			</td>
		</tr>
		@endif
		
	</div>
</section><!--/#do_action-->
				</div>	
			</div>
		</div>

		
	</div>
</section>
@endsection
