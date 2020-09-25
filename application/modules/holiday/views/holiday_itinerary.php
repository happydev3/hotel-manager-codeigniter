<?php $this->load->view('home/header');?>
<?php
  $total_price = ($adults_no*$activities->price_adt) + ($childs_no*$activities->price_chd) + ($seniors_no*$activities->price_sen);
  $discount_type = $holidaydetails->discount_type;
  $discount = $holidaydetails->discount_price;
  if($discount_type == 0){
    $discount_price = 0;
  }elseif($discount_type == 1){
    $discount_price = $discount;
  }elseif($discount_type == 2){
    $discount_price = ($discount*$total_price)/100;
  }
  if($childs_no=='') $childs_no=0;
  if($seniors_no=='') $seniors_no=0;
  // echo '<pre>';print_r($childs_no);exit;
  $total_discount = $discount_price;
  
  $sub_total = $total_price - $total_discount;
?>
<div class="content white-container">
  <section class="push-top-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
              <li class="active_step">
                <a href="javascript:;">
                  <span class="step_no wizard-step"><i class="fa fa-check"></i></span>
                  <span class="step_descr">Get a package</span>
                </a>
              </li>
              <li class="active_step">
                <a href="javascript:;">
                  <span class="step_no wizard-step">2</span>
                  <span class="step_descr">Enter your details</span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  <span class="step_no wizard-step">3</span>
                  <span class="step_descr">Secure your booking</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="hotel-book-section" class="push-top-20 hotel-book-section">
    <div class="container">
      <div class="row small-padding">
        <div class="col-md-8">
          <form method="POST" action="<?php echo site_url(); ?>holiday/confirm_booking" data-parsley-validate id="continueform">
            <div class="box-shadow">
              <div class="bdTitle2 one"><span>1</span> <b>Who's Travelling <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container">
                <div class="white-container">
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>First name</label>
                      <input type="text" name="GuestFirstName" class="form-control" data-parsley-nametest="" required>
                    </div>
                    <div class="col-sm-6">
                      <label>Last name</label>
                      <input type="text" name="GuestLastName" class="form-control" data-parsley-nametest="" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Billing Address</label>
                      <input type="text" name="GuestAddress" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>Zip/Postal Code</label>
                      <input type="text" name="GuestPostalCode" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>Country</label>
                      <select class="form-control" name="GuestCountryCode" required>
                        <option value="">Select Country</option>
                        <?php foreach($country_list as $val){ ?>
                        <option value="<?php echo $val->name;?>"><?php echo $val->name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>State</label>
                      <input type="text" name="GuestState" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>City</label>
                      <input type="text" name="GuestCity" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Email</label>
                      <input type="email" name="GuestEmailID" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Phone Number</label>
                      <input type="text" name="GuestMobileNo" class="form-control" data-parsley-num="" required>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12 text-center">
                      <button type="button" data-id="continuebtn1" class="btn book-btn continuebtn" style="font-size: 25px;padding: 5px 40px;">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php /*
            <div class="box-shadow">
              <div class="bdTitle2 two"><span>2</span> <b>Pax Information <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container" style="display: none;">
                <div class="white-container">
                  <div class="row2 border-title form-group">Traveller(s)</div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="dtlsOffer padding10">Please make sure that the names you enter match that of the passport/ identity card.</div>
                    </div>
                  </div>
                  <div class="light-blue-bg2 pax-details" style="border-bottom: 1px solid #efefef;">
                    <?php for ($a = 0; $a < $adults_no; $a++) {   ?>
                    <div class="row small-padding form-group push-top-5 checkadultsname">
                      <div class="col-sm-2 form-group">
                        <div class="blue-label invisible">Adult</div>
                        <label class="blue-label">Adult <?php echo ($a+1); ?></label>
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class="blue-label" for="selecttitle_a<?php echo ($a+1); ?>">Title <i class="red-text">*</i></label>
                        <div class="controls">
                          <select name="adults_title[]" class="form-control checktitle" id="selecttitle_a<?php echo ($a+1); ?>">
                            <option value="">Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                          </select>
                          <span style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="firstname_a<?php echo ($a+1); ?>">First Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="adults_fname[]" class="form-control" id="firstname_a<?php echo ($a+1); ?>" placeholder="First Name" data-parsley-nametest="">
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="lastname_a<?php echo ($a+1); ?>">Last Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="adults_lname[]" class="form-control" id="lastname_a<?php echo ($a+1); ?>" placeholder="Last Name" data-parsley-nametest="">
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if($childs_no > 0) { ?>
                    <?php for($c=0;$c<$childs_no;$c++) { ?>
                    <div class="row form-group push-top-5 checkchildsname">
                      <div class="col-sm-2 form-group">
                        <label class="blue-label invisible">Child</label>
                        <label class="blue-label">Child <?php echo ($c+1); ?></label>
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class="blue-label" for="selecttitle_c<?php echo ($c+1); ?>">Title <i class="red-text">*</i></label>
                        <div class="controls">
                          <select name="childs_title[]" class="form-control checktitle" id="selecttitle_c<?php echo ($c+1); ?>">
                            <option value="">Title</option>
                            <option value="Child">Child</option>
                          </select>
                          <span style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="firstname_c<?php echo ($c+1); ?>">First Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_fname[]" class="form-control" id="firstname_c<?php echo ($c+1); ?>" placeholder="First Name" >
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="lastname_c<?php echo ($c+1); ?>">Last Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_lname[]" class="form-control" id="lastname_c<?php echo ($c+1); ?>" placeholder="Last Name">
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php if($seniors_no > 0) { ?>
                    <?php for($s=0;$s<$seniors_no;$s++) { ?>
                    <div class="row form-group push-top-5 checkchildsname">
                      <div class="col-sm-2 form-group">
                        <label class="blue-label invisible">Senior</label>
                        <label class="blue-label">Senior <?php echo ($s+1); ?></label>
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class="blue-label" for="selecttitle_c<?php echo ($s+1); ?>">Title <i class="red-text">*</i></label>
                        <div class="controls">
                          <select name="childs_title[]" class="form-control checktitle" id="selecttitle_c<?php echo ($s+1); ?>">
                            <option value="">Title</option>
                            <option value="Senior">Senior</option>
                          </select>
                          <span style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="firstname_c<?php echo ($s+1); ?>">First Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_fname[]" class="form-control" id="firstname_c<?php echo ($s+1); ?>" placeholder="First Name" >
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="lastname_c<?php echo ($s+1); ?>">Last Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_lname[]" class="form-control" id="lastname_c<?php echo ($s+1); ?>" placeholder="Last Name">
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12 text-center">
                      <br>
                      <button type="button" data-id="continuebtn2" class="btn book-btn continuebtn" style="font-size: 25px;padding: 5px 40px;">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            */ ?>
            <div class="box-shadow push-bottom-20">
              <div class="bdTitle2 three"><span>2</span> <b>Payment Information <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container" style="display: none;">
                <div class="white-container">
                  <div class="row">
                    <div class="col-sm-12 text-center">
                      <input type="hidden" name="holiday_param" value="<?php echo $holiday_param;?>" required />
                      <input type="hidden" name="total_cost" value="<?php echo $sub_total;?>" required />
                      <input type="hidden" name="activity_id" value="<?php echo $activities->id;?>" required />
                      <input type="hidden" name="adults_no" value="<?php echo $adults_no;?>" required />
                      <input type="hidden" name="childs_no" value="<?php echo $childs_no;?>" required />
                      <input type="hidden" name="seniors_no" value="<?php echo $seniors_no;?>" required />
                      <input type="hidden" name="departDate" value="<?php echo $departDate;?>" required />
                      <button type="submit" class="btn book-btn" style="font-size: 25px;padding: 5px 40px;">Book Now <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Summary of Charges</b></div>
            <div class="white-container">
              <table class="row2 rooms-table2">
                <tbody>
                  <tr>
                    <td width="50%">
                      <div class="form-label">Package cost:</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($total_price,2) ?><br><!-- <small>(approax J<i class="fa fa-dollar"></i>22,200.09 JMD)</small> --></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label"><?php echo $adults_no ?> x Adult :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format(($adults_no*$activities->price_adt),2) ?></td>
                  </tr>
                  <?php if($childs_no > 0){ ?>
                  <tr>
                    <td>
                      <div class="form-label"><?php echo $childs_no ?> x Child :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format(($childs_no*$activities->price_chd),2) ?></td>
                  </tr>
                  <?php } ?>
                  <?php if($seniors_no > 0){ ?>
                  <tr>
                    <td>
                      <div class="form-label"><?php echo $seniors_no ?> x Senior :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format(($seniors_no*$activities->price_sen),2) ?></td>
                  </tr>
                  <?php } ?>
                  <?php if($discount_type > 0){ ?>
                  <tr>
                    <td>
                      <div class="form-label">Discount :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($total_discount,2) ?></td>
                  </tr>
                  <?php } ?>
                  <!-- <tr>
                      <td>
                          <div class="form-label">Guests :</div>
                      </td>
                    <td class="text-right"><?php //echo $adults_no+$childs_no+$seniors_no ?></td>
                  </tr> -->
                  <tr>
                    <td>
                      <div class="form-label">Package Subtotal :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($sub_total,2) ?></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label blue-link"><u>Tax and Fees :</u></div>
                    </td>
                    <td class="text-right">Included</td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label grand-tr">
                        <span>Total Charges</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label grand-td">
                        <sup2><i class="fa fa-dollar"></i> </sup2><?php echo number_format($sub_total,2) ?><sub2> USD</sub2>
                      </div>
                      <div class="form-label text-center">
                        <!-- (approax J<i class="fa fa-dollar"></i>51,422.36 JMD) -->
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Your Booking Details</b></div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="25%" style="vertical-align: top;">
                      <?php if(!empty($holidaydetails->thumb_img)){ ?>
                      <img src="<?php echo get_image_aws($holidaydetails->thumb_img) ?>" alt="<?php echo $holidaydetails->package_title ?>" class="img-responsive" style="height: 80px;width: 80px" />
                      <?php } else { ?>
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="<?php echo $holidaydetails->package_title ?>" class="img-responsive" style="height: 80px;width: 80px" />
                      <?php } ?>
                      <div class="form-label">
                        <span class="star star<?php echo $holidaydetails->package_rating ?>"></span>
                      </div>
                      <?php //} ?>
                    </td>
                    <td>
                      <h3><?php echo $holidaydetails->package_title;?></h3>
                      <div class="form-label"><?php echo $activities->activity_title;?></div>
                      <!-- <div class="form-label"><?php //echo $departDate;?></div> -->
                      
                      <!-- <div class="form-label">
                        <i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="rating ajax-tabs blue-link" data-id="rating"><u>51 Ratings</u></a>
                      </div> -->
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="30%" style="vertical-align: top;">
                      <div class="form-label push-top-10"><b>Departs at:</b></div>
                      <div class="form-label"><?php echo $journeyDate ?><br><?php echo $activities->pickup_time ?></div>
                    </td>
                    <td style="vertical-align: top;">
                      <div class="form-label push-top-10"><b>Operating Hours:</b></div>
                      <div class="form-label"><?php echo $activities->operating_hours ?></div>
                    </td>
                    <td style="vertical-align: top;">
                      <div class="form-label push-top-10"><b>Duration:</b></div>
                      <div class="form-label"><?php echo $activities->duration ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" style="vertical-align: top;">
                      <div class="form-label push-top-10"><b>Cancellation:</b></div>
                      <div class="form-label"><?php echo $activities->cancel_policy ?></div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Important Information</b></div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td colspan="2">
                      <?php if(!empty($holidaydetails->policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Tour Policy:</b> <?php echo $holidaydetails->policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($holidaydetails->cancellation_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Cancellation Policy:</b> <?php echo $holidaydetails->cancellation_policy; ?>
                      </div>
                      <?php } ?>
                      <!-- <?php //if(!empty($holidaydetails->child_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Child Policy:</b> <?php //echo $holidaydetails->child_policy; ?>
                      </div>
                      <?php //} ?> -->
                      <?php if(!empty($holidaydetails->terms)){ ?>
                      <div class="read-more-item form-label">
                        <b>Terms and Condition:</b> <?php echo $holidaydetails->terms; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($holidaydetails->photo_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Photo Policy:</b> <?php echo $holidaydetails->photo_policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($holidaydetails->rate_desc)){ ?>
                      <div class="read-more-item form-label">
                        <b>Rate Description:</b> <?php echo $holidaydetails->rate_desc; ?>
                      </div>
                      <?php } ?>
                      <!-- <div class="form-label push-top-10">
                        <b>Tour Policy:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad labore quas doloremque tempore dolorum suscipit dolore explicabo minima eius! Perferendis odit officiis, saepe harum ipsam voluptate quo, animi exercitationem fugit.
                      </div>
                      <?php if(!empty($holidaydetails->terms)){ ?>
                      <div class="form-label push-top-10">
                        <b>Cancellation Policy:</b> <?php echo $holidaydetails->terms; ?>
                      </div>
                      <?php } ?>
                      <div class="form-label push-top-10">
                        <b>Photo Policy:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad labore quas doloremque tempore dolorum suscipit dolore explicabo minima eius! Perferendis odit officiis, saepe harum ipsam voluptate quo, animi exercitationem fugit.
                      </div>
                      <div class="form-label push-top-10">
                        <b>Rate Description:</b> Special Rate
                      </div>
                      <div class="form-label push-top-10">
                        <b>Room Charges Disclosure:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad labore quas doloremque tempore dolorum suscipit dolore explicabo minima eius! Perferendis odit officiis, saepe harum ipsam voluptate quo, animi exercitationem fugit.
                      </div> -->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>
<?php $this->load->view('home/footer');?>

<style type="text/css">
.read-more-item {
    display:block;
    overflow:hidden;
    padding-bottom: 10px;
}
.read-more-item p:last-child{
  margin-bottom: 0;
}
#more.read-more-item{
  color: red;
}
</style>
<script type="text/javascript">
var collapsedSize = '92px';
// $('.read-more-item').css('display','block');
$('.read-more-item').each(function() {
    var h = this.scrollHeight;
    // console.log(h);
    var div = $(this);
    if (h > 102) {
        div.css('height', collapsedSize);
        div.after('<a id="more" class="read-more-item" href="javascript:;">Read More</a>');
        var link = div.next();
        link.click(function(e) {
            e.stopPropagation();

            if (link.text() != 'Read Less') {
                link.text('Read Less');
                div.animate({
                    'height': h
                });

            } else {
                div.animate({
                    'height': collapsedSize
                });
                link.text('Read more');
            }

        });
    }

});
</script>

<script type="text/javascript">
  $(document).on('click', '.bdTitle2.active', function(e) {
    var _input = $('.pax-details').find('input');
      var _select = $('.pax-details').find('select');
    // $(this).toggleClass('active');
    if($(this).hasClass('one')){
      _input.removeAttr('required');
      _select.removeAttr('required');
    } else if($(this).hasClass('two')){
      _input.attr('required','true');
      _select.attr('required','true');
    }
    e.preventDefault();
    $(this).parent().parent().find('.middle-container').hide();
    $(this).parent().find('.middle-container').show();
  });
</script>

<script type="text/javascript">
  /*$('.promo-btn').click(function(e) {
      e.preventDefault();
      var promot = $('#user_promotional').val();
      if(promot.length) {
          $.ajax({
              url: siteUrl+'promotional/promo/get_promotional_offer',
              data: 'type=1&promo_code='+$('#user_promotional').val(),
              dataType: 'json',
              type: 'POST',
              beforeSend: function() {
                  $('.show_offers').html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="<?php //echo get_image_aws('public/img/load.gif') ?>"></div>');
              },
              success: function(data) {
                  $('.show_offers').html(data.offer);
              }
          });
      } else {
          alert("Please enter the promotional code.");
      }
  });*/
</script>

<script type="text/javascript">
  var Num=/^(0|[1-9][0-9]*)$/; 
  var NameTest=/^[a-zA-Z\s]+$/;      
  var deciNum= /^[0-9]+(\.\d{1,3})?$/;
  window.Parsley.addValidator('num',  function (value, requirement) {    
    return Num.test(value);
  }).addMessage('en', 'num', 'Enter Numberic Value');
  window.Parsley.addValidator('nametest',  function (value, requirement) {    
    return NameTest.test(value);
  }).addMessage('en', 'nametest', 'Enter Only Alphabet');

  $('.continuebtn').on('click', function() {
    $form = $('#continueform');
    $dataid = $(this).attr('data-id');
    if($form.parsley().validate()) {
      if($dataid == 'continuebtn1') {
        var _input = $('.pax-details').find('input');
        var _select = $('.pax-details').find('select');
        _input.attr('required','true');
        _select.attr('required','true');
      }
      $(this).parents('.box-shadow').find('.bdTitle2').addClass('active');
      $(this).parents('.box-shadow').find('.middle-container').slideToggle();
      $(this).parents('.box-shadow').next('.box-shadow').find('.middle-container').slideToggle();
      return false;
    } else {
      return false;
    }
  });
</script>
</html>
