  <div class="uk-grid uk-grid-collapse important-contact contact_row">
        <div class="uk-width-1-10">
          <div class="bt-flabels__wrapper">
            <label>Salutation</label>
            <select name="contact_title[]" onchange="validatename(this);">
              <option value="">Select Salutation</option>
              <?php for($j=0;$j<count($salutation);$j++){ ?>
              <option value="<?php echo $salutation[$j]->name;?>" <?php if($contact_details[$i]->contact_title==$salutation[$j]->name){echo "selected"; }?>><?php echo $salutation[$j]->name;?></option>
              <?php } ?>
            </select>         
            <span class="bt-flabels__error-desc">Required</span>
          </div>
        </div>

        <div class="uk-width-1-10">
          <div class="bt-flabels__wrapper">
            <label>Name</label>
            <input type="text" name="contact_name[]"  placeholder="Name" autocomplete="off"/>
            <span class="bt-flabels__error-desc">Required</span>
          </div>
        </div>

        <div class="uk-width-1-10">
          <div class="bt-flabels__wrapper bt-flabels--right">
            <label>Surname</label>
            <input type="text" name="contact_surname[]" autocomplete="off" placeholder="Surname"/>
            <span class="bt-flabels__error-desc">Required</span>
          </div>
        </div>

        <div class="uk-width-1-10">
          <div class="bt-flabels__wrapper">
            <label>Department</label>
            <select name="contact_department[]" data-parsley-required>
              <option value="">Select Department</option>
              <?php for($j=0;$j<count($department);$j++){ ?>
              <option value="<?php echo $department[$j]->name;?>" <?php if($contact_details[$i]->contact_department==$department[$j]->name){echo "selected"; }?>><?php echo $department[$j]->name;?></option>
              <?php } ?>
            </select>         
            <span class="bt-flabels__error-desc">Required</span>
          </div>
        </div>

        <div class="uk-width-1-10">
          <div class="bt-flabels__wrapper">
            <label>Designation/Role</label>
            <select name="contact_role[]"  data-parsley-required>
             <option value="">Select Role</option>
             <?php for($j=0;$j<count($designation);$j++){ ?>
             <option value="<?php echo $designation[$j]->name;?>" <?php if($contact_details[$i]->contact_role==$designation[$j]->name){echo "selected"; }?>><?php echo $designation[$j]->name;?></option>
             <?php } ?>
           </select>         
           <span class="bt-flabels__error-desc">Required</span>
         </div>
       </div>

       <div class="uk-width-1-10">
        <div class="bt-flabels__wrapper bt-flabels--right">
          <label>Telephone</label>
          <input type="text" name="contact_telephone[]"  placeholder="Telephone" autocomplete="off" />
          <span class="bt-flabels__error-desc">Required</span>
        </div>
      </div>

      <div class="uk-width-1-10">
        <div class="bt-flabels__wrapper bt-flabels--right">
          <label>Mobile</label>
          <input type="text" name="contact_mobile[]" data-parsley-required placeholder="Mobile" autocomplete="off"/>
          <span class="bt-flabels__error-desc">Required</span>
        </div>
      </div>

      <div class="uk-width-2-10">
        <div class="bt-flabels__wrapper bt-flabels--right">
          <label>Email</label>
          <input type="text" name="contact_email[]" placeholder="abc@me.com" data-parsley-required data-parsley-type="email" autocomplete="off" />
          <span class="bt-flabels__error-desc">Invalid Email</span>
        </div>
      </div>

      <div class="uk-width-1-10 uk-text-center">        
        <a href="#"  onclick="addContact(event);" title="Add More Contact" class="uk-button uk-button-primary uk-button-large"><i class="uk-icon-plus-circle"></i></a>
        <a href="#" onclick="deleteContact(this, event);"   title="Delete This Contact" class="uk-button uk-button-danger uk-button-large"><i class="uk-icon-minus-circle"></i></a>  
      </div> 
    </div>
    <script type="text/javascript"> 

(function ($) {
  'use strict';

  var floatingLabel;

  floatingLabel = function floatingLabel(onload) {
    var $input;
    $input = $(this);
    if (onload) {
      $.each($('.bt-flabels__wrapper input'), function (index, value) {
        var $current_input;
        $current_input = $(value);
        if ($current_input.val()) {
          $current_input.closest('.bt-flabels__wrapper').addClass('bt-flabel__float');
        }
      });
    }

    setTimeout(function () {
      if ($input.val()) {
        $input.closest('.bt-flabels__wrapper').addClass('bt-flabel__float');
      } else {
        $input.closest('.bt-flabels__wrapper').removeClass('bt-flabel__float');
      }
    }, 1);
  };

  $('.bt-flabels__wrapper input').keydown(floatingLabel);
  $('.bt-flabels__wrapper input').change(floatingLabel);

  window.addEventListener('load', floatingLabel(true), false);
  $('.js-flabels').parsley().on('form:error', function () {
    $.each(this.fields, function (key, field) {
      if (field.validationResult !== true) {
        field.$element.closest('.bt-flabels__wrapper').addClass('bt-flabels__error');
      }
    });
  });

  $('.js-flabels').parsley().on('field:validated', function () {
    if (this.validationResult === true) {
      this.$element.closest('.bt-flabels__wrapper').removeClass('bt-flabels__error');
    } else {
      this.$element.closest('.bt-flabels__wrapper').addClass('bt-flabels__error');
    }
  });
})(jQuery);
</script>