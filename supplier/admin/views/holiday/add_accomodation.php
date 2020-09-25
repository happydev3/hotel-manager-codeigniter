<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Holiday Accommodation <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Holidays</a></li>
              <li><a class="active">Holiday Accommodation</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
              <?php
              // print_r($edit_accomodation);exit;
              $sess_msg = $this->session->flashdata('message');
              if(!empty($sess_msg)){
                $message = $sess_msg;
                $class = 'success';
              } else {
                $message = $error;
                $class = 'danger';
              }
              $acco_type = explode(',',$edit_accomodation->accomodation_type);
              ?>
              <?php if($message){ ?>
              <br>
              <div class="alert alert-<?php echo $class ?>">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <strong><?php echo ucfirst($class) ?>....!</strong>
                <?php echo $message; ?>
              </div>
              <?php } ?>
              <form action="<?php echo site_url() ?>holiday/submit_accomodation" method="post" role="form" enctype="multipart/form-data" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label for="hotel_name"><strong>Hotel Name :</strong></label>
                    <input value="<?php echo $edit_accomodation->hotel_name ?>" type="text" name="hotel_name" id="hotel_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="hotel_city"><strong>Hotel City :</strong></label>
                    <select name="hotel_city" id="hotel_city" class="form-control">
                      <?php foreach($holiday_city as $city){ ?>
                      <option value="<?php echo $city->city_id ?>" <?php if($edit_accomodation->hotel_city==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="contact_no"><strong>Contact Number :</strong></label>
                    <input value="<?php echo $edit_accomodation->contact_no ?>" type="text" name="contact_no" id="contact_no" class="form-control" required>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-7">
                    <label class="strong">Tour style :</label>
                    <ul class="check_width check_icon theme_group">
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Economy" <?php foreach($acco_type as $acc) if($acc =='Economy') echo 'checked="checked"'; ?>><i></i> Economy(3.5)</label></li>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Superior" <?php foreach($acco_type as $acc) if($acc =='Superior') echo 'checked="checked"'; ?>><i></i> Superior(4)</label></li>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="First class" <?php foreach($acco_type as $acc) if($acc =='First class') echo 'checked="checked"'; ?>><i></i> First class(5)</label></li>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Luxury" <?php foreach($acco_type as $acc) if($acc =='Luxury') echo 'checked="checked"'; ?>><i></i> Luxury(5+)</label></li>
                    </ul>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Address :</label>
                    <textarea name="address" class="form-control" id="address" rows="3" cols="100"><?php echo $edit_accomodation->address ?></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label class="strong">Description :</label>
                    <textarea name="description" class="form-control ckeditor" id="description" rows="3" cols="100"><?php echo $edit_accomodation->description ?></textarea>
                  </div>
                </div>
                <div class="row border_row min_height200">
                  <div class="col-md-12">
                    <label><strong>Gallery Image</strong></label><br>
                    <div class="messages2"></div>
                    <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>Add Multiple image...</span>
                      <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                    </span>
                    <input type="hidden" name="unique_id" value="accomodation_id">
                    <input type="hidden" name="controller" value="accomodation">
                    <input type="hidden" name="table_name" value="accomodation_images">
                    <input type="hidden" name="column_name" value="gallery_img">
                    <input type="hidden" name="img_type" value="gallery">
                    <input type="hidden" name="upload_type" value="custom_insert">
                    <!-- <input name="submit" value="Upload" class="btn btn-primary upload_now" /> -->
                    <div class="row2 remove_in_colne" style="margin-top: 15px">
                      <?php foreach($gallery_img as $gal) { ?>
                      <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                        <img src="<?php echo get_image_aws($gal->gallery_img); ?>" img_url="<?php echo $gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="row2 preview-image"></div>
                  </div>
                </div>
                <input type="hidden" name="accomodation_id" value="<?php echo $accomodation_id ?>">
                <div class="row border_row">
                  <div class="col-md-offset-11">
                    <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a mb-10">Update</button>
                  </div>
                </div>
              </form>

              <div class="boxs-body">
                <div class="row">
                  <div class="col-md-6">
                    <div id="tableTools"></div>
                  </div>
                  <div class="col-md-6">
                    <div id="colVis"></div>
                  </div>
                </div>
                <table class="table table-custom" id="advanced-usage">
                  <thead>
                    <tr>
                      <th>SL. No.</th>
                      <th>Hotel Name</th>
                      <th>Hotel City</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($accomodation_info)) { ?>
                    <?php for ($i = 0; $i < count($accomodation_info); $i++) { ?>
                    <?php $city_info = $this->holiday_city->get_single($accomodation_info[$i]->hotel_city); ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $accomodation_info[$i]->hotel_name; ?></td>
                      <td><?php echo $city_info->city_name ?></td>
                      <td>
                        <?php if($accomodation_info[$i]->status == 0) { ?>
                        <label class="label label-danger">Inactive</label>
                        <?php } else { ?>
                        <label class="label label-success">Active</label>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($accomodation_info[$i]->status == 0) { ?>
                        <a class="btn btn-success btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>holiday/set_acc_status/<?php echo $accomodation_info[$i]->id;  ?>/1" onclick="return confirm('Do you really want to Active this Accomodation. ?')"><i class="fa fa-check"></i> <span>Active</span></a>&nbsp;&nbsp;&nbsp;|&nbsp;
                        <?php } else { ?>
                        <a class="btn btn-danger btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>holiday/set_acc_status/<?php echo $accomodation_info[$i]->id;  ?>/0" onclick="return confirm('Do you really want to InActive this Accomodation. ?')"><i class="fa fa-times"></i> <span>Inactive</span></a>&nbsp;|&nbsp;
                        <?php } ?>
                        <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>holiday/add_accomodation?id=<?php echo  $accomodation_info[$i]->id; ?>"><i class="fa fa-pencil"></i> <span>Edit</span></a>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
CKEDITOR.replace('description', tools);
</script>
<!-- Required for images upload -->
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
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
               alert("It doesn't supports");
           }
       } else {
           alert("Select Only images");
       }
  });
} else {
  alert("Your browser doesn't support to File API")
}
</script>
<script>
jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages").offset().top-100}, 150);
            
        }
    };  
    // Submit the form
    $(".upload-image-form").ajaxForm(options);  
    return false; 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  var img_url = $(this).parent().find('img').attr('img_url');
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name+'&img_url='+img_url,
      dataType: 'json',
      beforeSend: function(){
        _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
      },
      error: function(){
        _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
        document.location.reload();
      },
      complete: function(response){
        _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>File Deleted Successfully.</div>');
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
        document.location.reload();
      }
    });
  } else {
      return false;
  }
});
</script>

<script type="text/javascript">
$(window).load(function(){
  function stateChange(iColumn, bVisible) {
    console.log('The column', iColumn, ' has changed its status to', bVisible);
  }

  var table4 = $('#advanced-usage').DataTable({
    "aoColumnDefs": [
      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
    ]
  });

  var colvis = new $.fn.dataTable.ColVis(table4);

  $(colvis.button()).insertAfter('#colVis');
  $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

  var tt = new $.fn.dataTable.TableTools(table4, {
    sRowSelect: 'single',
    "aButtons": [
      'copy',
      'print', {
        'sExtends': 'collection',
        'sButtonText': 'Save',
        'aButtons': ['csv', 'xls', 'pdf']
      }
    ],
    "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
  });
  $(tt.fnContainer()).insertAfter('#tableTools');
});
</script> 