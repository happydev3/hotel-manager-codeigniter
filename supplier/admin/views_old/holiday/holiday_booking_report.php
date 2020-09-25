    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
     <?php echo $this->load->view('top_panel'); ?>
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
       
		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Holiday Booking Report</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
					<ul class="nav nav-tabs navbar-left nav-dark">
						<li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Booking Report</strong></a></li>
					</ul>
		             <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
		       <div class="tab-content mb30" style="overflow:hidden">
            
                <?php if (!empty($holi_booking_report)) { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                      <table  id="datatable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                     <th>SI.No</th>
                                     <th>Unique Ref No.</th>
                                     <th>Package Name</th>
                                     <th>Package Duration</th>
                                     <th>User Name</th>
                                     <th>Email</th>
                                     <th>Mobile No</th>
                                     <th>Address</th>
                                     <th>City</th>
                                     <th>Postel Code</th>
                                     <th>No of Adults</th>
                                     <th>No of Childs</th>
                                     <th>No of Infants</th>
                                     <th>Accommodation Type</th>
                                     <th>No of Single Sharing</th>
                                     <th>No of Twin Sharing</th>
                                     <th>No of Triple Sharing</th>
                                     <th>Total Room</th>
                                     <th>Arrival Date</th>
                                     <th>Total Package Amount</th>
                                     <th>Booking Date & Time</th>
                                     <th>Booking Voucher</th>
                                     <th>Booking Status</th>
                                  </tr>
                            </thead>
                            <tbody>
                                   <?php for ($i = 0; $i < count($holi_booking_report); $i++) { ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->uniqueRefNo; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->package_title; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->holiday_duration; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->title.' '.$holi_booking_report[$i]->first_name.' '.$holi_booking_report[$i]->middle_name.' '.$holi_booking_report[$i]->last_name; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_email; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_mobile; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->address; ?></td>
                                       <td><?php echo $holi_booking_report[$i]->user_city; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->user_pincode; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->adults_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->childs_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->infants_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->accommodation_type; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->single_room_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->twin_room_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->triple_room_no; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->room_count; ?></td>
                                    <td><?php echo $holi_booking_report[$i]->arrival_date; ?></td>
                                    <td><?php                                     	
                                    echo $holi_booking_report[$i]->package_amount; ?></td>
                                      <td><?php echo $holi_booking_report[$i]->booking_datetime; ?></td>
                                        <td><a href="<?php echo site_url(); ?>/holiday/voucher?referId=<?php echo $holi_booking_report[$i]->uniqueRefNo; ?>" title="Click here to go Voucher" data-rel="tooltip" class="btn btn-success" target="_blank">Voucher</a>
                                        </td>
                                      <td><?php echo $holi_booking_report[$i]->booking_status; ?></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                        <table  id="datatable2" class="table table-striped table-bordered">
                            <thead>
                                 <tr>
                                     <th>SI.No</th>
                                     <th>Unique Ref No.</th>
                                     <th>Package Name</th>
                                     <th>Package Duration</th>
                                     <th>User Name</th>
                                     <th>Email</th>
                                     <th>Mobile No</th>
                                     <th>Address</th>
                                     <th>City</th>
                                     <th>Postel Code</th>
                                     <th>No of Adults</th>
                                     <th>No of Childs</th>
                                     <th>No of Infants</th>
                                     <th>Accommodation Type</th>
                                     <th>No of Single Sharing</th>
                                     <th>No of Twin Sharing</th>
                                     <th>No of Triple Sharing</th>
                                     <th>Total Room</th>
                                     <th>Arrival Date</th>
                                     <th>Total Package Amount</th>
                                     <th>Booking Date & Time</th>
                                     <th>Booking Voucher</th>
                                     <th>Booking Status</th>
                                  </tr>
                            </thead>
                            <tbody>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>Error!</strong>
                                    No Data Found. Please try after some time...
                                </div>
                            </tbody>
                        </table>
						 </div>
						  </div>
                        <?php } ?>
						
				</div>
			</div>
		</div>
		</div>
	</div>
	</div>
	</div>
                   
               
<script>
    function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if (val == "1")
        {
            $('#inter').show();
            //$('#inter').addClass('required');
            $('#dome').hide();
        }
        if (val == "2")
        {
            $('#inter').hide();
            $('#dome').show();
            //$('#dome').addClass('required');
        }
    }
</script>
<?php echo $this->load->view('footer'); ?>
<!--<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.doubleScroll.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.double-scroll').doubleScroll();
    });
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/custom.js"></script>-->
<script>
    function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if(val == "1")
        {
            $('#inter').show();
//$('#inter').addClass('required');
$('#dome').hide();
}
if(val == "2")
    {$('#inter').hide();
$('#dome').show();
//$('#dome').addClass('required');
}
}
</script>
</body>
</html>
<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#promo_id').click(function(e) {
            e.preventDefault();
            var promocheck = new Array();
            var promouncheck = new Array();
            $('.promo:checked').each(function() {
                promocheck.push($(this).val());
            });
            $('.promo:checkbox:not(:checked)').each(function() {
//var  check=$(this).val();
promouncheck.push($(this).val());
//console.log($(this).val());
//alert(check);
});
            alert(promouncheck);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/holiday/promo_hol",
                dataType: 'html',
                data: {message: promocheck,message1: promouncheck},
                success: function(data) {
                    alert('Promotional Holiday Added Successfully');
// window.location.reload();
}
});
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#rec_id').click(function(e) {
//alert('fhj');
e.preventDefault();
var reccheck = new Array();
var recuncheck = new Array();
$('.rec:checked').each(function() {
    reccheck.push($(this).val());
});
$('.rec:checkbox:not(:checked)').each(function() {
    recuncheck.push($(this).val());
});
//console.log(reccheck);
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/holiday/rec_hol",
    dataType: 'html',
    data: {message: reccheck,message1: recuncheck},
    success: function(data) {
        alert('Recommended Holiday Added Successfully');
        window.location.reload();
    }
});
});
    });
</script>
<script>
    $(document).ready(function() {
        $('#dome').click(function(e) {
//alert('fhj');
e.preventDefault();
var domcheck = new Array();
var domuncheck= new Array();
$('.dome:checked').each(function() {
//var  check=$(this).val();
domcheck.push($(this).val());
//console.log($(this).val());
//alert(check);
});
$('.dome:checkbox:not(:checked)').each(function() {
    domuncheck.push($(this).val());
});
//console.log(reccheck);
alert(domuncheck);
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/holiday/dome_hol",
    dataType: 'html',
    data: {message: domcheck,message1:domuncheck},
    success: function(data) {
        alert('Domestic Holiday Added Successfully');
        window.location.reload();
    }
});
});
    });
</script>
<script>
    $(document).ready(function() {
        $('#inter').click(function(e) {
//alert('fhj');
e.preventDefault();
var intcheck = new Array();
var interuncheck = new Array();
$('.inter:checked').each(function() {
//var  check=$(this).val();
intcheck.push($(this).val());
});
$('.inter:checkbox:not(:checked)').each(function() {
    interuncheck.push($(this).val());
});
//console.log(reccheck);
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/holiday/inter_hol",
    dataType: 'html',
    data: {message: intcheck,message1: interuncheck},
    success: function(data) {
        alert('International Holidays Added Successfully');
        window.location.reload();
    }
});
});
    });
</script>
<script>
    $(document).ready(function() {
        $('#subpage_rec').click(function(e) {
// alert('subpage_rec');
e.preventDefault();
var intcheck = new Array();
var interuncheck = new Array();
$('.subpage_rec:checked').each(function() {
//var  check=$(this).val();
intcheck.push($(this).val());
});
$('.subpage_rec:checkbox:not(:checked)').each(function() {
    interuncheck.push($(this).val());
});
//console.log(reccheck);
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/holiday/subpage_rec",
    dataType: 'html',
    data: {message: intcheck,message1: interuncheck},
    success: function(data) {
        alert('SubPage Recommended Holidays Successfully');
        window.location.reload();
    }
});
});
    });
</script>
<script>
    $(document).ready(function() {
        $('#holiday_thm').click(function(e) {
// alert('subpage_rec');
e.preventDefault();
var intcheck = new Array();
var interuncheck = new Array();
$('.holiday_thm:checked').each(function() {
//var  check=$(this).val();
intcheck.push($(this).val());
//console.log($(this).val());
});
$('.holiday_thm:checkbox:not(:checked)').each(function() {
    interuncheck.push($(this).val());
});
//console.log(reccheck);
alert(interuncheck);
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/holiday/holiday_thm",
    dataType: 'html',
    data: {message: intcheck,message1: interuncheck},
    success: function(data) {
        alert('Holidays Themes added Successfully');
        window.location.reload();
    }
});
});
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reservation').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
    </body>
</html>