<?php $this->load->view('home/header'); ?>
<section id="content">
  <div class="container">
    <div class="row traveller-details  white-container"> 
      <div class="col-md-12 ">
        <h2 align="center" style="background: #f5872e; color: white; font-weight:bold; padding:8px;">Create Profile</h2>
        <form role="form" action="<?php echo site_url(); ?>b2c/user_register" enctype="multipart/form-data" method="post">
         <div class="row">
           <div class="col-md-4">
            <div class="form-group">
              <label for="user_email">Email</label>
              <input type="email" class="form-control" placeholder="email address" name="user_email" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="first_name">Password</label>
              <input type="password" id="user_password" class="form-control" placeholder="password" name="user_password" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="confirm_password">Confirm Password <span id="passnotmatch" style="color: red"></span></label>
              <input type="password" class="form-control" id="confirm_password" placeholder="confirm password" name="confirm_password" required>
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-2">
          <div class="form-group">
            <label for="title">Title </label>
            <select class="form-control" name="title" required >
              <option value="">Select Title</option>
              <option value="Mr">Mr.</option>
              <option value="Mrs">Mrs.</option>
              <option value="Ms">Ms.</option>
              <option value="Dr">Dr.</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" placeholder="first name" name="first_name" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="first_name">Last Name</label>
            <input type="text" class="form-control" placeholder="last name" name="last_name" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="mobile_no">Contact Number: <span id="contactno" style="color: red"></span></label>
            <input type="text" class="form-control" id="mobile_no" name="mobile_no"  required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <button type="submit" id="usersignup" class="full-width btn-medium">SIGNUP</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</section>
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  var Num=/^(0|[1-9][0-9]*)$/;
  tjq(document).ready(function() {
    tjq('#usersignup').on('click', function()
    {
     tjqvalidation=true;
       if(tjq("#user_password").val()!=tjq("#confirm_password").val()){
      tjq("#passnotmatch").html("Password is not matching");
      tjqvalidation=false;
    }
     if(!Num.test(tjq("#mobile_no").val())){
      tjq("#contactno").html("Enter only numberic value ");
      tjqvalidation=false;
    }

    if(tjqvalidation==true){
      return true;
    }else{
      return false;
    }
  });  
    tjq('#confirm_password,#user_password').keyup(function()
    {
     if(tjq("#user_password").val()==tjq("#confirm_password").val()){
      tjq("#passnotmatch").html("");
    }
  });  
    tjq('#mobile_no').keyup(function()
    {
     if(!Num.test(tjq("#mobile_no").val())){
      tjq("#contactno").html("Enter only numberic value ");    
    }
    else
    {
     tjq("#contactno").html("");
   }
 });
  });
</script>
