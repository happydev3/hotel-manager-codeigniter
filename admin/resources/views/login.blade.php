<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="img/favicon_1.ico">
	<title>Welcome - Admin</title>
	<!-- Bootstrap core CSS -->
	{!! Html::style('public/tpdassets/css/bootstrap.min.css')!!}
	{!! Html::style('public/tpdassets/css/bootstrap-reset.css')!!}
	<!--Animation css-->
	{!! Html::style('public/tpdassets/css/animate.css')!!}
	<!--Icon-fonts css-->
	{!! Html::style('public/tpdassets/assets/font-awesome/css/font-awesome.css')!!}
	{!! Html::style('public/tpdassets/assets/ionicon/css/ionicons.min.css')!!}
	{!! Html::style('public/tpdassets/assets/material-design-iconic-font/css/material-design-iconic-font.min.css')!!}
	<!-- DataTables -->

	{!! Html::style('public/tpdassets/css/style.css')!!}
	{!! Html::style('public/tpdassets/css/helper.css')!!}

	<!-- Page Content Start -->
	<div class="wrapper-page">
		<div class="panel panel-color panel-inverse">
			<div class="panel-heading" style="background: #252525">
				<!-- <h3 class="text-center m-t-10"> Sign In to <strong>Admin</strong></h3> -->
				<h3 class="text-center m-t-10"><img src="{{ asset('public/tpdassets/img/logo.png') }}" style="width: 250px;"></h3>
			</div>
			<div class="panel-body">
				 <form class="form-horizontal m-t-10 p-20 p-b-0" method="POST" action="{{url('login')}}">
					 {!! csrf_field() !!}
					<div class="form-group ">
						<div class="col-xs-12">
							 <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" />
						</div>
					</div>
					<div class="form-group ">

						<div class="col-xs-12">
							<input class="form-control" type="password" name="password" id="password" placeholder="Password" />
						</div>
					</div>
					<!-- <div class="form-group ">
						<div class="col-xs-12">
							<label class="cr-styled"> 
								<input type="checkbox" name="remember" id="remember" checked>
								<i class="fa"></i>
								Remember me
							</label>
						</div>
					</div> -->

					<div class="form-group text-right">
						<div class="col-xs-12">
							<button class="btn btn-success w-md" type="submit">Log In</button>
						</div>
					</div>
					@if(session('message'))
					<div class="alert alert-danger">{{session('message')}}</div>
					@endif 
					<!-- <div class="form-group m-t-30">
						<div class="col-sm-7">
							<a href="#"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
						</div>
						<div class="col-sm-5 text-right">
							<a href="#">Create an account</a>
						</div>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	
</section>
<!-- Main Content Ends -->
<!-- js placed at the end of the document so the pages load faster -->
{!! Html::script('public/tpdassets/js/jquery.js')!!}
{!! Html::script('public/tpdassets/js/bootstrap.min.js')!!}
{!! Html::script('public/tpdassets/js/pace.min.js')!!}
{!! Html::script('public/tpdassets/js/modernizr.min.js')!!}
{!! Html::script('public/tpdassets/js/wow.min.js')!!}
{!! Html::script('public/tpdassets/js/jquery.nicescroll.js')!!}

@yield('script')

{!! Html::script('public/tpdassets/js/jquery.app.js')!!}
</body>
</html>