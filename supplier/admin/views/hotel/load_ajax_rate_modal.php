<div class="modal fade" id="modalClosedResons1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>hotel/update_room_rates/<?php echo $rate_details->hotel_id; ?>">       
        <div class="modal-body">
          <div class="row border_row">
            <div class="form-group col-md-12" id="modalservermsg">
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-md-12">
            <a  class="btn" style="background: rgb(170, 175, 180); color: white; font-weight: bold;"><?php echo 'Rate Code (WhiteLight) : '.$rate_details->room_rate_code;?></a>
          </div>
        </div>
        <div class="row border_row">
           <div class="form-group col-md-2">
             <?php $index_arr=explode('_',$index)?>
             <label class="strong" for="rate_name">SL. No. : <?php echo  $index_arr[1]; ?></label>
            </div>
            <div class="form-group col-md-4">
            <label class="strong" for="rate_name">Room Rate Name : <?php echo $rate_details->rate_name; ?></label>
            <input type="hidden" name="room_code" id="room_code" value="<?php echo $id1; ?>">
            <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $id ?>">
            <input type="hidden" name="room_rate_code" id="room_rate_code" value="<?php echo $rate_details->room_rate_code; ?>">
            <input type="hidden" name="sup_hotel_room_rates_id" id="sup_hotel_room_rates_id" value="<?php echo $rate_details->sup_hotel_room_rates_id; ?>">
            <input type="hidden" name="index" id="index" value="<?php echo $index; ?>">
            
          </div>
          <div class="form-group col-md-4">
            <label class="strong" for="rate_code">Room Rate Code : <?php echo $rate_details->rate_code; ?></label>
          </div>
           
        </div>
        <div class="row border_row"> 
          <div class="form-group col-md-4">
            <label class="strong" for="rate_desc">Room Rate Description : </label>
          </div>
          <div class="form-group col-md-8">
            <?php echo $rate_details->rate_desc; ?> </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-md-4">          
              <ul class="check_width check_icon">
                <?php if($rate_details->rate_type=='nett'){ ?>
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="nett" <?php if($rate_details->rate_type=='nett'){ echo "checked" ;} ?>><i></i> Nett</label></li>
                <?php } if($rate_details->rate_type=='commission'){ ?>
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="commission" <?php if($rate_details->rate_type=='commission'){ echo "checked" ;} ?> ><i></i> Commissionable</label></li>  
                <?php } ?>              
              </ul>
            </div>
            <?php if($rate_details->rate_type=='commission'){ ?>
            <div class="form-group col-md-4" id="commissionId">
              <label class="strong" for="commission">Commission : <?php echo $rate_details->commission; ?></label>
            </div>
            <?php } if($rate_details->rate_type=='nett'){ ?>
            <div class="form-group col-md-4" id="published_rateId">
              <label class="strong" for="published_rate">Published Rate : </label>
              <input name="published_rate" id="published_rate" value="<?php echo $rate_details->published_rate; ?>" type="text" class="form-control" required="required" data-parsley-rate="">
            </div>
             <?php } ?>
          </div>
          <div class="row border_row">               
            <div class="form-group col-md-4">
              <label class="strong" for="single_occupancy_rate">Single Occupancy Rate : </label>
              <input name="single_occupancy_rate" id="single_occupancy_rate" value="<?php echo $rate_details->single_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="twin_occupancy_rate">Double/Twin Occupancy : </label>
              <input name="twin_occupancy_rate" id="twin_occupancy_rate" value="<?php echo $rate_details->twin_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="triple_occupancy_rate_extrabed">Extra Bed(Triple Occupancy) : </label>
              <input name="triple_occupancy_rate_extrabed" id="triple_occupancy_rate_extrabed" value="<?php echo $rate_details->triple_occupancy_rate_extrabed; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
            </div>
             </div>
             <div class="row border_row">  
            <div class="form-group col-md-4">
              <label class="strong" for="triple_occupancy_rate">Triple Occupancy : </label>
              <input name="triple_occupancy_rate" id="triple_occupancy_rate" value="<?php echo $rate_details->triple_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="quad_occupancy_rate">Quad Occupancy : </label>
              <input name="quad_occupancy_rate" id="quad_occupancy_rate" value="<?php echo $rate_details->quad_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-md-4">
              <label class="strong" for="childminage">Child Min Age : <?php echo $rate_details->childminage; ?></label>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="childmaxage">Child Max Age : <?php echo $rate_details->childmaxage; ?></label>
            </div>
            <div class="form-group col-md-4">
              <label class="strong" for="child_rate">Child Rate : </label>
              <input name="child_rate" id="child_rate" value="<?php echo $rate_details->child_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate=""> 
            </div>
          </div>
         </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> Submit</button>
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50" data-dismiss="modal"><i class="fa  fa-long-arrow-left"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<script type="text/javascript">
  $('#modalClosedResons1').modal({backdrop: 'static', keyboard: false}); 
  $(document).ready(function() {  
    $(".modal").on('shown', function() {
      $(this).find("[autofocus]:first").focus();
    });  
    $("input[name='name']").keyup(function(){
      $("#modalservererror").html('');
    });
    $('.ajax-submit').on('click', function(e) {
    // alert(1); return false;
    e.preventDefault();
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var _this = $(this);
    var form = $(this).parents('form');
    var action = $(this).parents('form').attr('goingact');
    var parent_id = $(this).parents('.modal.fade').attr('id');
     window.ParsleyValidator.addValidator('rate', 
  function (value, requirement) {    
      return deciNum.test(value)||value==='NA';;
  }).addMessage('en', 'rate', 'Enter Either Numberic/ Decimal Value or NA');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else{
      submit_form(_this, form, action, parent_id);
    }
  });
    function submit_form(_this, form, action, parent_id) {
      $.ajax({
        type: 'post',
        url: action,
        data: form.serialize(),
        dataType: 'json',
         success: function(data) {
          
          $("#modalservermsg").html(data.modalservermsg);
          if(data.modal_index!='')
          { 
            $("#<?php echo $index; ?>").html(data.modal_index);
          }           
        },
        error: function(data){          
          $("#modalservermsg").html(data.modalservermsg); 
        }
      });
    }
  });
</script>