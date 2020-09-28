@extends('frontend.master')
@section('content')	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
						@foreach($category as $value)	

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{url('/danhmucsanpham/'.$value['id'])}}">{{$value['category_name']}}</a></h4>
								</div>
							</div>
						@endforeach	
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
						@foreach($brand as $value)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{url('/thuonghieusanpham/'.$value['id'])}}"> <span class="pull-right">(50)</span>{{$value['brand_name']}}</a></li>
						@endforeach			
								</ul>
							</div>
						</div>

					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					@foreach($product_detail as $value)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('product/'.$value['product_image'])}}" alt="" height="250" />
								<h3>ZOOM</h3>
							</div>
							<!-- <ul id="imageGallery">
							  <li data-thumb="{{asset('Eshopper/images/shop/product10.jpg')}}" data-src="{{asset('Eshopper/images/shop/product10.jpg')}}">
							    <img src="{{asset('Eshopper/images/shop/product10.jpg')}}" />
							  </li>
							  <li data-thumb="{{asset('Eshopper/images/shop/product10.jpg')}}" data-src="{{asset('Eshopper/images/shop/product10.jpg')}}">
							    <img src="{{asset('Eshopper/images/shop/product10.jpg')}}" />
							  </li>
							  <li data-thumb="{{asset('Eshopper/images/shop/product7.jpg')}}" data-src="{{asset('Eshopper/images/shop/product7.jpg')}}">
							    <img src="{{asset('Eshopper/images/shop/product7.jpg')}}" />
							  </li>
							</ul> -->

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value['product_name']}}</h2>
								<p>Web ID: {{$value['id']}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<form>
									@csrf
								
									<input type="hidden" name="" value="{{$value['id']}}" class="cart_product_id_{{$value['id']}}">	
									<input type="hidden" name="" value="{{$value['product_name']}}" class="cart_product_name_{{$value['id']}}">	
									<input type="hidden" name="" value="{{$value['product_image']}}" class="cart_product_image_{{$value['id']}}">

									<input type="hidden" name="" value="{{$value['product_qty']}}" class="cart_product_quantity_{{$value['id']}}">	
									<input type="hidden" name="" value="{{$value['product_price']}}" class="cart_product_price_{{$value['id']}}">

									<span>
										<span><?php echo number_format($value['product_price']).''.'VNĐ'?></span>
										<label>Quantity:</label>
										<input type="number" name="qty" min="1" class="cart_product_qty_{{$value['id']}}" value="1" />
										<input type="hidden" name="productid_hidden" value="{{$value['id']}}">
										
										
									</span>
									<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id="{{$value['id']}}" name="add-to-cart">
								</form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới 100%</p>
								<p><b>Brand:</b>
									@foreach($brand as $value1)
										@if($value['brand_id'] == $value1['id'])
										{{$value1['brand_name']}}
										@endif
									@endforeach
								</p>
								<p><b>Category:</b>
									@foreach($category as $value2)
										@if($value['category_id'] == $value2['id'])
										{{$value2['category_name']}}
										@endif
									@endforeach
								</p>
								<style type="text/css">
									a.tags_style{
										margin: 3px 2px;
										border:1px solid;

										height: auto;
										background: #428bca;
										color: #ffff;
										padding: 0px;
									}
									a.tags_style:hover{
										background: black;
									}
								</style>
								<fieldset>
									<legend>Tags</legend>
									<p><i class="fa fa-tag"></i>
										<?php 
											$tags = $value['product_tags'];
											$tags = explode(",",$tags); //tách chuỗi tìm vị trí nào có dẩu phẩy thì xóa đi
										 ?>
										 @foreach($tags as $tag)
										 	<a href="{{url('/tag')}}" class="tags_style">{{$tag}}</a>
										 @endforeach
									</p>
								</fieldset>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value['product_content']!!}</p>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value['product_desc']!!}</p>
								
							</div>
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
				@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản Phẩm Liên Quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								 @foreach($product_detail as $key => $value1)
								 	@foreach($all_product as $value2)
								 		@if($value2['category_id'] == $value1['category_id'] && $value2['id'] != $value1['id'] )	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('product/'.$value2['product_image'])}}" alt="" height="250" width="250"/>
													<h2><?php echo number_format($value2['product_price']).''.'VNĐ' ?></h2>
													<p>{{$value2['product_name']}}</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
									
											</div>
										</div>
									</div>
										@endif
									@endforeach
								 @endforeach	
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
@endsection	
