<div class="modal fade" id="modalClosedResons1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>hotel/<?php echo $action;?>">
        <!-- <div class="modal-header">
          <h3 class="modal-title custom-font">I'm a modal!</h3>
        </div> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" id="modalservermsg">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="strong"><?php echo $tag_name; ?> :</label>
              <div class="controls">
                <input type="text" name="name" class="form-control" autofocus="autofocus" required>
                   <input type="hidden" name="tag_name"  value="<?php echo $tag_name; ?>" class="form-control" required>
                <input type="hidden" name="ctrl"  value="<?php echo $ctrl; ?>" class="form-control" required>
                 <input type="hidden" name="type"  value="<?php echo $type; ?>" class="form-control" required>
                  <input type="hidden" name="type1"  value="<?php echo $type1; ?>" class="form-control" required>
                  <input type="hidden" name="group_id"  value="<?php echo $group_id; ?>" class="form-control" required>
                <input type="hidden" name="hotel_id_index"  value="<?php echo $hotel_id_index; ?>" class="form-control" required>
                 <input type="hidden" name="mode"  value="<?php echo $mode; ?>" class="form-control" required> 
                 <input type="hidden" name="modetype"  value="<?php echo $modetype; ?>" class="form-control" required>
                  <input type="hidden" name="feildname"  value="<?php echo $feildname; ?>" class="form-control" required> 
                  <input type="hidden" name="modal_index"  value="<?php echo $modal_index; ?>" class="form-control" required>              
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> <?php echo $button; ?></button>
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
    var _this = $(this);
    var form = $(this).parents('form');
    var action = $(this).parents('form').attr('goingact');
    var parent_id = $(this).parents('.modal.fade').attr('id');
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
      beforeSend: function() {
      },
      success: function(data) {
        $("#modalservermsg").html(data.modalservermsg);
        if(data.modal_index!='')
        { 
          $("#<?php echo $modal_index; ?>").html(data.modal_index);
        }
        $("input[name='name']").val('');

      },
      error: function(data){
        $("#modalservermsg").html(data.modalservermsg); 
      }
    });
  }
});
</script>