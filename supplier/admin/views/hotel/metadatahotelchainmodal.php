<div class="modal fade" id="modalClosedResons1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>hotel/<?php echo $action;?>">     
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" id="modalservermsg">
            </div>
          </div>
             <div class="row border_row min_height200">
                <div class="col-md-12">                
                  <label><strong>Hotel Chain Logo</strong></label><br>                
                  <div class="messages"></div>
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Hotel Chain Logo...</span>
                    <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                  </span>                 
               <div class="row2 preview-image"></div>
               </div>
              </div>

          <div class="row">
            <div class="col-md-12">
              <label class="strong"><?php echo $tag_name; ?> :</label>
              <div class="controls">
                <input type="text" name="name" class="form-control" autofocus="autofocus"  required>      
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
    if (window.File && window.FileList && window.FileReader) {
      $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();
       var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support
      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
       if (typeof (FileReader) != "undefined") {
         for (var i = 0; i < countFiles; i++) {
           var reader = new FileReader();
           reader.onload = function (e) {
            var file = e.target;                   
                      $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                  }
                } else {
                  $("#img_path").val('');
                 alert("It doesn't supports");
               }
             } else {
              $("#img_path").val('');
               alert("Select Only images");
             }
           });
    } else {
      $("#img_path").val('');
      alert("Your browser doesn't support to File API");
    }
  </script>

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
    }
    else if($("#img_path").val()=="")
    {
      alert("Kindly Add Hotel Chain Logo......");
        return false;
    }
     else{
      submit_form(_this, form, action, parent_id);
    }
  });
  function submit_form(_this, form, action, parent_id) {
    var files = $('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      data.append('uploadfile[]', file, file.name);
    }

   data.append("name",  $("input[name='name']").val());
   data.append("tag_name",  "<?php echo $tag_name; ?>");
   data.append("ctrl",  "<?php echo $ctrl; ?>");
   data.append("type",  "<?php echo $type; ?>");
   data.append("type1",  "<?php echo $type1; ?>");
   data.append("group_id",  "<?php echo $group_id; ?>");
   data.append("hotel_id_index",  "<?php echo $hotel_id_index; ?>");
   data.append("mode",  "<?php echo $mode; ?>"); 
   data.append("modetype",  "<?php echo $modetype; ?>");
   data.append("feildname" , "<?php echo $feildname; ?>"); 
   data.append("modal_index" , "<?php echo $modal_index; ?>"); 
   $.ajax({
      type: 'POST',               
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      data: data,
      url: action,
      dataType : 'json',  
      beforeSend: function() {
      },
      success: function(data) {
        $("#modalservermsg").html(data.modalservermsg);
        if(data.modal_index!='')
        { 
          $("#<?php echo $modal_index; ?>").html(data.modal_index);
        }
        $("input[name='name']").val('');
        $("#img_path").val('');
        $(".preview-image").html("");
      },
      error: function(data){
        $("#modalservermsg").html(data.modalservermsg); 
      }
    });
  }
});
</script>
  