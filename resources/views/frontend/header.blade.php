
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{asset('Eshopper/images/home/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
	
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<li><a href="{{url('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<li><a href="{{url('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span>
								<?php
										if (Session::get('cart')) 
										{
											 echo count(Session::get('cart'));
										}
										else{
											echo 0;
										} 
									?>	

								</a> </span></li>
								<!-- <li><a href="{{url('/login-customer')}}"><i class="fa fa-lock"></i> Login</a></li> -->
								@if(Auth::check())
								<li><a href="{{ url('/member/logout') }}"><i class="fa fa-lock"></i>Đăng xuất</a></li>
								@else
								<li><a href="{{ url('/member/login') }}"><i class="fa fa-lock"></i>Đăng nhập</a></li>
								@endif
								<li><a href="{{ url('/member/register') }}"><i class="fa fa-lock"></i> Đăng kí</a></li>
								</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/index')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                   <ul role="menu" class="sub-menu">
                                   	  @foreach($cate_post as $value)	
                                        <li><a href="{{url('/danh-muc-bai-viet/'.$value['cate_post_slug'])}}">{{$value['cate_post_name']}}</a></li>
									  @endforeach		 
                                    </ul>
                                </li> 
								<li><a href="{{url('/show-cart')}}">shopping Cart</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{url('/tim-kiem')}}" method="post">
							@csrf
							<div class="search_box pull-right">
								
									
								<input type="text" name="keywords_submit" placeholder="Search" value="" />
								<input type="submit" style="margin-top:0;color:666" name="search_item" value="Tim kiếm" class="btn btn-primary btn-sm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	