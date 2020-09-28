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
						<h2 class="title text-center">{{$meta_title}}</h2>
						
							<div class="product-image-wrapper">
							   @foreach($post as $key => $value)	
								<div class="single-products" style="margin: 10px 0;">
									<div class="productinfo text-center">

									<img style="float: left; width:40%;padding: 5px; height: 200px;" src="{{asset('baiviet/'.$value['post_image'])}}" alt="{{$value['post_slug']}}" height="250" width="250"/>
									<h4 style="color: #000; padding: 5px;">{{$value['post_title']}}</h4>
									<p>{!! $value['post_desc'] !!}</p>
										  
									</div>
									<div class="text-right">
										<a href="{{url('/bai-viet/'.$value['post_slug'])}}" class="btn btn-warning btn-sm">Xem bài viết</a>
									</div>	
								</div>
								<div class="clearfix"></div>
								@endforeach
							</div>

						
					</div><!--features_items-->

				</div>
				{!! $post->links() !!}
			</div>
		</div>

	</section>
@endsection