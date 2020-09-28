@extends('frontend.master')
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
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
							<input type="text" placeholder="Tài khoản" name="email" />
							<input type="password" placeholder="Password" name="password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection