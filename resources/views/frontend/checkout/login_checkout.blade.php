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
							<div class="shipping text-center">
								<img src="images/home/shipping.jpg" alt="" />
							</div>
						<!--/shipping-->
					</div>
				</div>
				
				
						<section id="form"><!--form-->
							<div class="container">
								<div class="row">
									<div class="col-sm-4 col-sm-offset-1">
										<div class="login-form"><!--login form-->
											<h2>Login to your account</h2>
											<form action="#">
												<input type="text" placeholder="Tài khoản" name="email_account" />
												<input type="password" placeholder="Password" name="password_account" />
												<span>
													<input type="checkbox" class="checkbox"> 
													Keep me signed in
												</span>
												<button type="submit" class="btn btn-default">Login</button>
											</form>
										</div><!--/login form-->
									</div>
									<div class="col-sm-1">
										<h2 class="or">OR</h2>
									</div>
									
									<div class="col-sm-4">
										<div class="signup-form"><!--sign up form-->
											<h2>New User Signup!</h2>
											<!-- @if(session('success'))
			                                    <div class="alert alert-success alert-dismissible">
			                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                                        <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
			                                        {{session('success')}}
			                                    </div>
		                             		@endif
											<form action="" method="POST">
												@csrf
												<input type="text" placeholder="Name" name="customer_name" />
												<input type="email" placeholder="Email Address" name="customer_email" />
												<input type="password" placeholder="Password" name="customer_password"/>
												<input type="text" placeholder="phone" name="customer_phone"/>
												<button type="submit" class="btn btn-default">Signup</button>
											</form> -->
										</div><!--/sign up form-->
									</div>
								</div>
							</div>
					</section><!--/form-->

				
			</div>
		</div>
	</section>

@endsection