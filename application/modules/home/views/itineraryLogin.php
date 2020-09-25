              <p><b><i class="fa fa-hand-o-right"></i> Login to speed up the booking</b></p> <button class="btn btn-primary loginBtn loginBtn--facebook" onclick="checkLoginState();" title="Facebook" style="background: #3b5998;border-color: #3b5998">Facebbok Login</button>&nbsp;
                     <?php include(APPPATH.'libraries/googlelogin/login.php'); ?>
                    <button class="btn btn-primary loginBtn loginBtn--google" title="Google" onclick="PopupCenter('<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>','Google Login','450','600');" style="background: #dd4b39;border-color: #dd4b39">
                    Google+ Login</button> &nbsp;
                   <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLogin" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;">Account Login</a>   

                     