<!-- Register -->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel3">Sign Up</h3>
      </div>
      <div class="modal-body"> 
        <form class="form-signup"  name="validate_create_account" role="form" goaction="<?php echo site_url(); ?>b2c/user_register" method="post">
          <div class="row">
            <div class="col-sm-12">
              <label>Email*</label>
              <input type="email" class="form-control form-group" name="user_email" data-parsley-trigger="change" id="acc_user_email" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-sm-12">
              <label>Mobile Number*</label>
              <input type="text" class="form-control" name="mobile_no" id="acc_mobile_no"  required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label>Password*</label>
              <input type="password" class="form-control form-group" name="user_password" id="acc_user_password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label>Confirm Password*</label>
              <input type="password" class="form-control form-group" name="passconf" id="acc_user_passconf" data-parsley-equalto="#acc_user_password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label>First Name*</label>
              <input type="text" class="form-control form-group" name="first_name" id="acc_first_name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label>Last Name*</label>
              <input type="text" class="form-control form-group" name="last_name" id="acc_last_name" required>
            </div>
          </div>
          <p class="red" id="usersignup_msg" style="margin-top:-12px;color: red;"></p>
          <div class="row form-group">
            <div class="col-sm-12">
              <button class="btn border-btn full-width" id="user_signup">Create account</button>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <span>By proceeding you agree to ours <a href="<?php echo site_url() ?>home/termsCondition" target="_blank">Terms of use</a> and <a href="<?php echo site_url() ?>home/privacyPolicy" target="_blank">Privacy Policy.</a></span>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <div class="row no-padding">
          <div class="col-sm-9 text-left" style="line-height: 2.5382;">Already have an account?</div>
          <div class="col-sm-3 text-right">
            <a href="#" class="btn btn-primary close-first" data-toggle="modal" data-target="#modalLogin">Sign in</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Sign in -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <!-- <div class="modal-header pos-relative">
        <h3 style="margin: 0 0 4px;" id="myModalLabel3">Sign in with one click</h3>
        <div class="row no-padding text-center">
          <div class="col-sm-6"> 
           <button class="btn btn-primary full-width loginBtn loginBtn--facebook" onclick="checkLoginState();" title="Facebook" style="background: #3b5998;border-color: #3b5998">Facebbok Login</button>
          </div>
          <div class="col-sm-6">
            <?php //include(APPPATH.'libraries/googlelogin/login.php'); ?>
            <button class="btn btn-primary full-width loginBtn loginBtn--google" title="Google" onclick="PopupCenter('<?php //echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>','Google Login','450','600');" style="background: #dd4b39;border-color: #dd4b39">
            Google+ Login</button>
          </div>
        </div>
        <div class="text-center">
          <span class="middle-text-border">OR</span>
        </div>
      </div> -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Sign In</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Email*</label>
            <input type="email" class="form-control form-group" name="user_email" data-parsley-trigger="change" id="sign_user_email" required>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-12">
            <label>Password*</label>        
            <input type="password" class="form-control" name="user_password" id="sign_user_password">
            <p class="text-right"><a href="#" data-toggle="modal" data-target="#modalForgotpassword"><small><u class="close-first">Forgot Password?</u></small></a></p>
          </div>
        </div>
        <p class="red" id="userlogin_msg" style="margin-top:-12px;color: red;"></p>
        <div class="row form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary full-width" id="userlogin_id">Sign in</button>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <span>By proceeding you agree to ours <a href="<?php echo site_url() ?>home/termsCondition" target="_blank">Terms of use</a> and <a href="<?php echo site_url() ?>home/privacyPolicy" target="_blank">Privacy Policy.</a></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row no-padding">
          <div class="col-sm-6 text-left" style="line-height: 2.5382;">No account yet?</div>
          <div class="col-sm-6 text-right">
            <a href="#" class="btn border-btn close-first" data-toggle="modal" data-target="#modalRegister">Create account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Forgot password -->
<div class="modal fade" id="modalForgotpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel2">Forgot Password?</h3>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="<?php echo site_url(); ?>/b2c/forgot_password" method="post" method="post">
          <div class="row">
            <div class="col-sm-12">
              <label>Registered Email*</label>
              <input type="email" data-parsley-trigger="change" class="form-control form-group" name="email_id" id="forgot_pass_email_id" required>
              <p><small>A link will be sent to your registered email address to reset your password.</small></p>
              <button class="btn btn-lg btn-primary modal-btn full-width">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.member_href.loggedin').each(function(){
    $(this).removeAttr('data-target');
  });
</script>

 
