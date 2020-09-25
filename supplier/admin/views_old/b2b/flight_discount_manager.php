<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>
  <style>
  .paging_full_numbers {
  line-height: 22px;
  margin-top: 22px;
  }
  .mb30 {
  margin-bottom: 30px;
  /* height: 398px; */
  min-height: 420px;
  }
  .chosen-container{width:120px !important}
  </style>
  <script type="text/javascript">
  var baseUrl = "<?php echo base_url(); ?>";
  var siteUrl = "<?php echo site_url(); ?>";
  
  
  </script>
  <script src="<?php echo base_url(); ?>public/js/autocomplete/jquery-ui.min.css"></script>
  <div class="contentpanel">
    <!-- content goes here -->
    <h3>B2B Airline Discount Manager</h3>
    <ul class="nav nav-tabs nav-dark">
      <li class="active"><a href="#profile3" data-toggle="tab"><strong>B2B Airline Discount Manager</strong></a></li>
    </ul>
    <div class="tab-content mb30">
      <div class="tab-pane active" id="profile3">
        <table width="100%" border="0" cellpadding="3" cellspacing="0">
          <form class="form-horizontal" name="flight_specific_airline" id="flight_specific_airline" action="" >
            <fieldset>
              <tr>
                <td class="center">Airlines</td>
                <td>
                  <select id="selectError6" name="flight_spec_airline" required>
                    <option value="">Select Specific Airline</option>
                    <optgroup label="Airline List">
                      <?php for($i=0;$i<count($airlines_list);$i++) {?>
                      <option value="<?php echo $airlines_list[$i]->airline_code; ?>"><?php echo $airlines_list[$i]->airline_name; ?></option>
                      <?php } ?>
                    </optgroup>
                  </select>
                </td>
                <td class="center">From</td>
                <td class="markup_p">
                  <input type="hidden" name="origin" value="all" />
                  <input  id="fromCity" type="text" class="clearable" name="fromcity"    />
                </td>
                <td class="center">to</td>
                <td class="markup_p">
                  <input type="hidden" name="destination" value="all" />
                  <input  id="toCity" type="text" class="clearable" name="tocity"  />
                </td>
                <td class="center">Discount</td>
                <td class="markup_p">
                  <input required id="flight_spec_airline_markup" type="text" name="discount"  style="width:40px;" /> %
                </td>
              </tr>
              <tr>
                <td><input type="checkbox" name="basefare" value="1"> Basefare</td>
                <td><input type="checkbox" name="yqfare" value="2"> YQ Fare</td>
                <td class="center"><!-- Markup Process --></td>
                <td>
                  <input type="hidden" name="flight_spec_airline_markup_process" value="percentage" />
                  <!--  <select id="selectError4" name="flight_spec_airline_markup_process" class="markup_process" required>
                    <option value='percentage'>Percentage (%)</option>
                    <option value='amount'>Amount</option>
                  </select> -->
                </td>
              </tr>
              <tr>
                <td></td><td></td><td></td>  <td>
                <button type="submit" class="btn btn-primary">Add Discount</button>
              </td></tr>
            </fieldset>
          </form>
        </table>
        <br/><br/>
        <table class='table' id="table5">
          <thead>
            <tr>
              <th>SI.No</th>
              <th>Airline</th>
              <th>Fare type</th>
              <th>Origin</th>
              <th>Destination</th>
              <th>Discount</th>
              <th>Status</th>
              <th><!-- Actions --></th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($b2b_discount_list)) {?>
            <?php
            for($i=0;$i<count($b2b_discount_list);$i++) {?>
            <?php ?>
            <tr>
              <td><?php echo $i+1;?></td>
              <td>
                <?php for($j=0;$j<count($airlines_list);$j++) {
                if($b2b_discount_list[$i]->airline==$airlines_list[$j]->airline_code){
                echo $airlines_list[$j]->airline_name;
                }
                } ?>
              </td>
              <td class="center"><?php if($b2b_discount_list[$i]->basefare==1){ echo 'Basefare,'; } if($b2b_discount_list[$i]->yqfare==2){ echo 'YQ Fare,'; }?></td>
              
              <td class="center"><?php
                if($b2b_discount_list[$i]->origin=='all'){
                echo 'all';
                }else{
                foreach($airport_list as $ar){
                if($ar->airport_code==$b2b_discount_list[$i]->origin){
                echo $ar->airport_name.','.$ar->airport_city.','.$ar->airport_country;
                }
                }
                }?>
              </td>
              <td class="center"><?php if($b2b_discount_list[$i]->destination=='all'){
                echo 'all';
                }else{
                foreach($airport_list as $ar){
                if($ar->airport_code==$b2b_discount_list[$i]->destination){
                echo $ar->airport_name.','.$ar->airport_city.','.$ar->airport_country;
                }
                }
              }?></td>
              <td class="center"><?php echo $b2b_discount_list[$i]->discount;?></td>
              <td class="center">
                <?php if($b2b_discount_list[$i]->status == 0) { ?>
                <span class="label label-inactive">Inactive</span>
                <?php } else if($b2b_discount_list[$i]->status == 1) {?>
                <span class="label label-success">Active</span>
                <?php } ?>
              </td>
              <td class="center">
                <a class="" href="<?php echo site_url(); ?>/b2b/manage_discount_status/<?php echo $b2b_discount_list[$i]->markup_id; ?>/1" title="Active" onclick="return confirm('Do you want to activate this discount?')" data-rel="tooltip" >
                  <span class="glyphicon glyphicon-ok-sign"></span>
                </a>
                <a class="" href="<?php echo site_url(); ?>/b2b/manage_discount_status/<?php echo $b2b_discount_list[$i]->markup_id; ?>/0" title="Inactive" onclick="return confirm('Do you want to de-activate this discount?')" data-rel="tooltip" >
                  <span class="glyphicon glyphicon-minus-sign"></span>
                </a>
                <a class="" href="<?php echo site_url(); ?>/b2b/manage_discount_status/<?php echo $b2b_discount_list[$i]->markup_id; ?>/2" title="Delete" onclick="return confirm('Do you want to delete this discount?')" data-rel="tooltip" >
                  <i class="fa fa-trash-o"></i>
                </a>
                
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <div class="alert alert-error">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong>Error!</strong>
              No Data Found. Please try after some time...
            </div>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div><!-- panel -->
<!-- end of panel body 2 -->
</div><!-- panel Defualt-->
</div><!-- col-md-6 -->
</div>
</div><!-- contentpanel -->
<!-- end of content -->
</div>
<?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/js/autocomplete/airports_list.js"></script>
<script src="<?php echo base_url(); ?>public/js/autocomplete/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
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
<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script>
jQuery(document).ready(function() {
jQuery('#table1').dataTable();

jQuery('#table2').dataTable({
"sPaginationType": "full_numbers"
});
jQuery('#table4').dataTable({
"sPaginationType": "full_numbers"
});
jQuery('#table5').dataTable({
"sPaginationType": "full_numbers"
});
// Chosen Select
jQuery("select").chosen({
'min-width': '100px',
'white-space': 'nowrap',
disable_search_threshold: 10
});

// Delete row in a table
jQuery('.delete-row').click(function(){
var c = confirm("Continue delete?");
if(c)
jQuery(this).closest('tr').fadeOut(function(){
jQuery(this).remove();
});
return false;
});

// Show aciton upon row hover
jQuery('.table-hidaction tbody tr').hover(function(){
jQuery(this).find('.table-action-hide a').animate({opacity: 1});
},function(){
jQuery(this).find('.table-action-hide a').animate({opacity: 0});
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
// Ajax call for generic flight markups


// Ajax call for specific Flight markups


// Ajax call for specific Airline wise Flight markups

$("#flight_specific_airline").submit(function(ev){
ev.preventDefault();

// $markup_process = $( "input[name='flight_spec_airline_markup_process']" ).val();
$basefare='';
$yqfare='';
if($("input[name='basefare']:checked").val()){
$basefare = $("input[name='basefare']:checked").val();
}
if($("input[name='yqfare']:checked").val()){
$yqfare = $("input[name='yqfare']:checked").val();
}
$discount = $( "input[name='discount']" ).val();
$origin = $( "input[name='origin']" ).val();
$destination = $( "input[name='destination']" ).val();
$airline = $('select[name="flight_spec_airline"] option:selected').val();
var dataString = "discount="+ $discount +"&airline="+ $airline+"&basefare="+$basefare+"&yqfare="+$yqfare+"&origin="+$origin+"&destination="+$destination;
if(confirm('Are you sure you want to Add/Update B2B Specific Airline Discount?')) {
$.ajax({
url: '<?php echo site_url();?>/b2b/update_discount',
type: "POST",
data: dataString,
success: function (data) {
window.location = '<?php echo site_url();?>/b2b/flight_discount_manager';
}
});
}
});
});
</script>