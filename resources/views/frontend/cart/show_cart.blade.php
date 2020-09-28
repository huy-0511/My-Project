@extends('frontend.master')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
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
							<td class="description">Số lượng tồn</td>
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
								<img src="{{asset('product/'.$cart['product_image'])}}" alt="{{$cart['product_image']}}" width="90" height="80" />
							</td>
							<td class="cart_description">
							
								<p>{{$cart['product_name']}} </p>
							</td>
							<td class="cart_description">
								
								<p>{{$cart['product_quantity']}}</p>
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
											Mã giảm :<span>{{$cou['coupon_number']}} % </span> 
											<p>
												<?php 
													$totalCoupon = ($total*$cou['coupon_number'])/100;
													echo '<p><li>Tổng giảm :'.number_format($totalCoupon).' đ</p></li>';	

												 ?>
											</p>
											<p>
												<li>Tổng đã giảm : <?php echo number_format($total - $totalCoupon); ?> đ</li>
											</p>
										@elseif($cou['coupon_condition']==2)
											Mã giảm :<span>{{$cou['coupon_number']}} k</span>
											<p>
												<?php 
													$totalCoupon = $total - $cou['coupon_number'];
													
												 ?>
											</p>
											<p>
												<li>Tổng đã giảm <span><?php echo number_format($totalCoupon); ?> đ</span></li>
											</p>
										@endif
									@endforeach
								
							</li>
							@endif
							<!-- <li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span></span></li> -->
							
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->

							<a class="btn btn-default check_out" href="{{url('/checkout')}}">Đặt Hàng</a>
							

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
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					
				</div>
				

			</div>
		</div>
	</section><!--/#do_action-->
@endsection