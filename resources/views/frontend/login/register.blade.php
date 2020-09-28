@extends('frontend.master')
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
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
							<input type="text" placeholder="Name" name="name" />
							<input type="email" placeholder="Email Address" name="email" />
							<input type="password" placeholder="Password" name="password"/>
							<input type="text" placeholder="phone" name="phone"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection