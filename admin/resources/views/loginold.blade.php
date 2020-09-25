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
     
       <section id="form"><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Login to your account</h2>
                            <form method="POST" action="{{url('login')}}">
                                {!! csrf_field() !!}
                                <input type="email" name="email" id="email" placeholder="Email Address" />
                                <input type="password" name="password" id="password" placeholder="Password" />
                                <span>
                                    <input name="remember" id="remember" type="checkbox" class="checkbox"> 
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
                            <form method="POST" action="{{url('register')}}">
                                {!! csrf_field() !!}
                                <input type="text" name="name" id="name"  placeholder="Name">
                                <input type="email" name="email" placeholder="Email Address"/>
                                <input type="password" name="password" placeholder="Password">
                                <button type="submit" class="btn btn-default">Signup</button>
                            </form>
                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
        </section><!--/form-->
   <!-- Footer Start -->
    <footer class="footer">
        2017 © Admin.
    </footer>
    <!-- Footer Ends -->
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