    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
    <?php echo $this->load->view('top_panel'); ?>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />      
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>TRENDING DESTINATIONS</h3>
          </div>
        </div>
        <div class="clearfix"></div>     
        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <ul class="nav nav-tabs navbar-left nav-dark">
                <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Package List</strong></a></li>
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
               <a style="margin: 0 0 0 8px;cursor: not-allowed;" class="btn btn-danger">
                  Total Number of TRENDING DESTINATIONS Package :  <?php echo count($trenddestipackage);?>
              </a>                 
                <a id="trending_dest_id" href="" style="margin: 0 0 0 8px;" class="btn btn-warning">(Select Package & Click Here)</a>
                <br/><br/><br/>
                <?php if (!empty($package)) { ?>
                <div class="table-responsive">
                  <div class="double-scroll">
                    <table  id="datatable1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SI.No</th>
                          <th>TRENDING DESTINATIONS</th>
                          <th>Package Name</th>
                          <th>Package Status</th> 
                          <th>Price</th>                                       
                          <th>Start Date</th>
                          <th>End date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for ($i = 0; $i < count($package); $i++) { ?>
                        <tr>
                          <td><?php echo $i + 1; ?></td>
                          <td align="center"><input type="checkbox" class="trending_dest" value="<?php echo $package[$i]->holiday_id; ?>" name="trending_dest[]" <?php if(trim($package[$i]->trending_dest) == 1){ echo 'checked'; } ?>/></td>
                          <td><?php echo $package[$i]->package_title; ?></td>
                          <td><?php if($package[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                          <td><?php echo $package[$i]->price; ?></td>
                          <td><?php echo $package[$i]->start_date; ?></td>
                          <td><?php echo $package[$i]->end_date; ?></td>
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
                        <th>TRENDING DESTINATIONS</th>
                        <th>Package Name</th>
                        <th>Package Status</th> 
                        <th>Price</th>                                       
                        <th>Start Date</th>
                        <th>End date</th>
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
<!-- My Custom JS-->
<!-- <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script> -->
<script>
  $(document).ready(function() {

    $('#trending_dest_id').click(function(e) {
      e.preventDefault();
      var trending_destcheck = new Array();
      var trending_destuncheck = new Array();
      var trenchecked_count = $( ".trending_dest:checked" ).length;
      if(trenchecked_count>=2){
        $('.trending_dest:checked').each(function() {
          trending_destcheck.push($(this).val());
        });            
        $('.trending_dest:checkbox:not(:checked)').each(function() {
         trending_destuncheck.push($(this).val());
       });
        $.ajax({
          type: "POST",
          url: "<?php echo site_url(); ?>/holiday/trending_dest",
          dataType: 'html',
          data: {message: trending_destcheck,message1: trending_destuncheck},
          success: function(data) {
            new PNotify({
              title: 'success',
              text: 'Featured Holiday Added Successfully',
              type: 'success',
              styling: 'bootstrap3'
            });
            window.location.reload();
          }
        });
      }else{
       new PNotify({
        title: 'Alert',
        text: 'Select Atleast 8 Packages for TRENDING DESTINATIONS',
        type: 'error',
        styling: 'bootstrap3'
      });
     }
   });       

  });
</script>
<!-- PNotify -->
<script>
    /*
      $(document).ready(function() { 
         
          if($( ".trending_dest:checked" ).length<8){        
          new PNotify({
                                  title: 'Alert TRENDING DESTINATIONS',
                                  text:'<h5> Select Only Active Packages</h5>'+ 
                                  '<h5><b>TRENDING DESTINATIONS</b> Should have Minimum 4 Packages.</h5>',
                                  type: 'error',
                                   nonblock: {
                                         nonblock: false
                                      },
                                  hide: false,
                                   addclass: 'dark',
                                  styling: 'bootstrap3'
                              });
        }          
      }); */
    </script>
    <!-- /PNotify -->
  </body>
  </html>