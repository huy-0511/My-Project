@extends('frontend.master')
@section('content')
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('Eshopper/images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('Eshopper/images/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('Eshopper/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('Eshopper/images/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('Eshopper/images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('Eshopper/images/home/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->	
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
								
								</ul>
							@endforeach
							</div>
							
						</div><!--/brands_products-->
						<!--price-range-->
						<!-- <div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div> -->
						<!--/price-range-->
						<!--shipping-->
							<!-- <div class="shipping text-center">
								<img src="images/home/shipping.jpg" alt="" />
							</div> -->
						<!--/shipping-->
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">New Product</h2>
						@foreach($all_product as $value)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										 
											<form>
												 <a  href="{{url('/chitietsanpham/'.$value['id'])}}">
												@csrf
											<input type="hidden" name="" value="{{$value['id']}}" class="cart_product_id_{{$value['id']}}">	
											<input type="hidden" name="" value="{{$value['product_name']}}" class="cart_product_name_{{$value['id']}}">	
											<input type="hidden" name="" value="{{$value['product_image']}}" class="cart_product_image_{{$value['id']}}">
											<input type="hidden" value="{{$value['product_qty']}}" class="cart_product_quantity_{{$value['id']}}">	
											<input type="hidden" name="" value="{{$value['product_price']}}" class="cart_product_price_{{$value['id']}}">
											<input type="hidden" name="" value="1" class="cart_product_qty_{{$value['id']}}">	
											<img src="{{asset('product/'.$value['product_image'])}}" alt="" height="250" width="250"/>
											<h2><?php echo number_format($value['product_price']).''.'VNĐ' ?></h2>
											<p>{{$value['product_name']}}</p>
											<!-- <a id="add"  href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> 
											-->
											</a>
											<!-- <button type="button"class="btn btn-default add-to-cart" name="add-to-cart" data-id="{{$value['id']}}">Thêm giỏ hàng</button> -->
											<input type="button" name="add-to-cart" data-id="{{$value['id']}}" class="btn btn-default add-to-cart" value="Thêm giỏ hàng">
											<input type="button" data-toggle="modal" data="#xemnhanh" name="add-to-cart" data-id="{{$value['id']}}" class="btn btn-default xemnhanh" value="Xem nhanh">
											</form>
										  
										</div>
										<!-- <div class="product-overlay">
											<div class="overlay-content">
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div> -->
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
						
					</div><!--features_items-->

				</div>
			</div>
		</div>
		<script type="text/javascript">
			// $('.ratings_stars').click(function(){
			// 	var getValues =  $(this).find("input").val();
		       
	  //       	$.ajax({
			//       url: "/ajax/rate", 
			//       type: "post",
			//       data: {values: getValues, id:getID},
			//         success: function (response) {
			//         	console.log(response)
			//            // You will get response from your PHP page (what you echo or print)
			//            if (response == 1) {
			//            	alert('ok');
			//            }else{
			//            	alert('ko thanh cong');
			//            }
			//         },
			//         error: function() {
			//            console.log(t);
			//         }
			//     });
			// $(document).ready(function(){
			//   $("p").click(function(){
			//     alert("The paragraph was clicked.");
			//   });
			
		</script>
	</section>
@endsection