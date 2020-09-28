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

					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 style="margin: 0;" class="title text-center">{{$meta_title}}</h2>
						
							<div class="product-image-wrapper">
							   @foreach($post as $key => $value)	
								<div class="single-products" style="margin: 10px 0;">
									{!! $value['post_content'] !!}	
								</div>
								<div class="clearfix"></div>
								@endforeach
							</div>

						<h2 style="margin: 0;" class="title text-center">Bài viết liên quan</h2>
						<style type="text/css">
							ul.post_relate li{
								list-style-type: disc;
								font-size: 16px;
								padding: 6px; 
							}
							ul.post_relate li a{
								color: #000;
							}
							ul.post_relate li a:hover{
								color: #FE980F;
							}
						</style>
						<ul class="post_relate">
							@foreach($related as $key => $value)
							<li><a href="{{url('/bai-viet/'.$value['post_slug'])}}">{{$value['post_title']}}</a></li>
							@endforeach	
						</ul>
					</div><!--features_items-->

				</div>
			</div>
		</div>

	</section>
@endsection