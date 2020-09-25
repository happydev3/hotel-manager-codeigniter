<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>


      <div class="contentpanel">         
                        
                <?php if (!$this->admin_auth->is_admin()) { ?>
                    <?php $this->load->view('account_balance'); ?>
                <?php } ?>
            
                                    <h3>Create Admin User</h3>
                                
                                    <form class="form-horizontal" action="<?php echo site_url(); ?>/distributor/add_admin_user" enctype="multipart/form-data" method="post">
                                        <fieldset>

                                            <?php if (validation_errors() != "") { ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                    <?php echo validation_errors(); ?>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (!empty($errors)) {
                                                ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                    <strong>Error!</strong>
                                                    <?php echo $errors; ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php $sess_admin_id=$this->session->userdata('admin_id'); ?>
 <input type="hidden" name="admin_parent" value="<?php echo $sess_admin_id;  ?>">
                                            <legend>Login Information</legend>
                                           
                                            <div class="form-group warning">
                                                <label class="col-sm-3 control-label" for="focusedInput">Email-Id</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="email" name="admin_email" value="<?php if (isset($admin_email)) echo $admin_email; ?>" required>
                                                    <span class="help-inline">Login Email-Id / UserName</span>

                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="mobile_no" value="<?php if (isset($mobile_no)) echo $mobile_no; ?>" required maxlength="10">
                                                    <span class="help-inline">Login Mobile Number</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="disabledInput">Password</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="password" name="admin_password" required>
                                                </div>
                                            </div>

                                            <div class="form-group warning">
                                                <label class="col-sm-3 control-label" for="focusedInput">Confirm Password</label>

                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="password" name="passconf" required>
                                                    <span class="help-inline">(Must be same with 'Password')</span>
                                                </div>
                                            </div>
<!--                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">Admin Pins</label>

                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="ad_pins" value="<?php echo $admin_pins; ?>" >
                                                    <span class="help-inline">(Allowed number of users to create)</span>
                                                </div>
                                            </div>-->
                                            <!--<div class="form-group">
                                                                             <label class="col-sm-3 control-label" for="selectError3">Admin User Level</label>
                                                                             <div class="col-sm-6">
                                                                               <select id="selectError1" name="role_id" required>
                                                     <option value="">Select User Level </option>
                                                                                     <option value="2">Sub Admin</option>
                                                                              </select>
                                                                             </div>
                                                                       </div>-->
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="selectError2">Admin Group</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" data-placeholder="Select Admin Group" id="selectError4" data-rel="chosen" name="admin_group" class="cho" required>
                                                        <option value=""></option>
                                                        <?php for ($i = 0; $i < count($admin_group); $i++) { ?>
                                                            <option value="<?php echo $admin_group[$i]->admin_grp_id; ?>"><?php echo $admin_group[$i]->admin_grp_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
<!--                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="selectError2">Admin Parent</label>
                                                <div class="col-sm-6">
                                                    <select data-placeholder="Select Parent Admin" id="selectError5" data-rel="chosen" name="admin_parent" class="" required>
                                                        <option value="">Select Parent..</option>
<?php if ($this->admin_auth->is_admin()) { ?>
                                                            <optgroup label="SuperAdmin">
                                                                    <option value="0">Super Admin</option>
                                                            </optgroup>
<?php } ?>

                                                        <?php
                                                        $admin_group = '';
                                                        for ($i = 0; $i < count($admin_list); $i++) {
                                                            if ($admin_group != $admin_list[$i]->admin_group) {
                                                                if ($admin_group != '') {
                                                                    echo '</optgroup>';
                                                                    break;
                                                                }
                                                                echo '<optgroup label="' . $admin_list[$i]->admin_grp_name . '">';
                                                                $admin_group = $admin_list[$i]->admin_group;
                                                            }
                                                            ?>

                                                            <option value="<?php echo $admin_list[$i]->admin_id; ?>" ><?php echo $admin_list[$i]->first_name . ' ' . $admin_list[$i]->last_name; ?></option>

<?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>-->
                                            <legend>Personal Information</legend>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="selectError3">Title</label>
                                                <div class="col-sm-6">
                                                    <select id="selectError3" name="title" class="form-control" required>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Dr">Dr.</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">First Name</label>

                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="first_name" value="<?php if (isset($first_name)) echo $first_name; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group warning">
                                                <label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="middle_name" value="<?php if (isset($middle_name)) echo $middle_name; ?>" />
                                                    <span class="help-inline">(Optional)</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">Last Name</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="last_name" value="<?php if (isset($last_name)) echo $last_name; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">Address</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" id="focusedInput" type="text" name="address" required><?php if (isset($address)) echo $address; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">Pin Code</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="pin_code" value="<?php if (isset($pin_code)) echo $pin_code; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">City</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="city" value="<?php if (isset($city)) echo $city; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="focusedInput">State</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="focusedInput" type="text" name="state"  value="<?php if (isset($state)) echo $state; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="selectError2">Country</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" data-placeholder="Select Your Country" id="selectError3" data-rel="chosen" name="country" class="cho" required>
                                                        <option value=""></option>
                                                        <optgroup label="Country List">
<?php for ($i = 0; $i < count($country_list); $i++) { ?>
                                                                <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Add  Admin</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>

                                        </fieldset>
                                    </form>

                                

                </div>
            </div>
        </div>
        <?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>


<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>

<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
jQuery(document).ready(function(){
  
  // Basic Form
  jQuery("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  // Error Message In One Container
  jQuery("#basicForm2").validate({
	 errorLabelContainer: jQuery("#basicForm2 div.error")
  });
  
  // With Checkboxes and Radio Buttons
  jQuery("#basicForm3").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  // Validation with select boxes
  jQuery("#basicForm4").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  
});
</script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#selectError5').children("optgroup").hide();
                groplevel = $('#selectError4 option:first').next().html();
                if(groplevel == 'SRSS') {
                    level1 = 'Admin';
                    level2 = 'SRSS';
                } else if(groplevel == 'RSS') {
                    level1 = 'SRSS';
                    level2 = 'RSS';
                } else if(groplevel ==	'SS') {
                    level1 = 'RSS';
                    level2 = 'SS';
                }  else if(groplevel == 'DI') {
                    level1 = 'SS';
                    level2 = 'DI';
                }
                $('#selectError4').change(function() {
                    grp = $("option:not(:selected)",$(this));
                    grpsel = $("option:selected",$(this)).html();
                    $('#selectError5').children("optgroup[label="+level1+"]").hide();
                    $.each(grp,function(i,val) {
                        if(val.value != '') {
                            $('#selectError5').children("optgroup[label="+val.text+"]").hide();
                        }
                    });
                    /* 			$.each(grpsel,function(i,val) {
                                        if(val.value != '') {
                                                $('#selectError5').children("optgroup[label="+val.text+"]").show();
                                        }
                                }); */
                    if(grpsel == level2) {
                        $('#selectError5').children("optgroup[label="+level1+"]").show();
                        $('#selectError5').children("optgroup[label="+level2+"]").hide();
                    } else {
                        grpprev = $("option:selected",$(this)).prev();
                        console.log(grpprev);
                        $.each(grpprev,function(i,val) {
                            if(val.value != '') {
                                $('#selectError5').children("optgroup[label="+val.text+"]").show();
                            }
                        });
                    }
                });
                $('#selectError4').trigger('change');
                /* $('#selectError5').change(function() {
                        }); */
            });
        </script>
    </body>
</html>