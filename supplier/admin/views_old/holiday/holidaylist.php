    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
     <?php echo $this->load->view('top_panel'); ?>
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />      
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Holiday List</h3>
              </div>
            </div>
            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav nav-tabs navbar-left nav-dark">
                        <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday List          </strong></a></li>
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
              <?php if (!empty($package)) { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                      <table  id="datatable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI.No</th>
                                    <th>Image</th>
                                    <th>Package Name</th>
                                    <th>Destination</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>                                
                                    <th>Add/Edit Review</th>
                                    <th>Add/Edit Itinerary</th>
                                    <th>Add/Edit Rate Calulcations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($package); $i++) { ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                   <td><?php  $images[$i]=$this->holiday_model->get_img_by_type($package[$i]->holiday_id,1); ?>
                                        <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $images[$i]->holiday_images; ?>"/>
                                    </td>
                                    <td><?php echo $package[$i]->package_title; ?></td>
                                    <td align="center">
                                        <?php
                                        $city = $package[$i]->destination;
                                        $city_name = explode(',', $city);
                                        $cityname = $this->holiday_model->getdesticity($city_name);
                                        $visit_name = '';
                                        foreach ($cityname as $visit) {
                                            $visit_name.=$visit->city_name . ',';
                                        }
                                        $visit=rtrim($visit_name,',');
                                        echo $visit;
                                        ?>
                                    </td>
                                    <td><?php echo $package[$i]->start_date; ?></td>
                                    <td><?php echo $package[$i]->end_date; ?></td>
                                    <td><?php echo $package[$i]->price; ?></td>
                                     <td><?php if($package[$i]->status == 1){ echo 'Active';    }else{ echo 'Inactive';   } ?></td>
                                    <td>
                                    <a href="<?php echo site_url(); ?>/holiday/edit_package/<?php echo $package[$i]->holiday_id; ?>">Edit |</a>
                                    <a href="<?php echo site_url() ?>/holiday/holiday_active/<?php echo $package[$i]->holiday_id; ?>/1">Active</a>&nbsp;|&nbsp;
                                        <a href="<?php echo site_url() ?>/holiday/holiday_active/<?php echo $package[$i]->holiday_id; ?>/0">Inactive</a>
                                    </td>                                  
                                    <td class="center"><a href="<?php echo site_url(); ?>/holiday/holiday_review/<?php echo $package[$i]->holiday_id; ?>">Add/Edit review</a></td>
                                    <td class="center"><a href="<?php echo site_url(); ?>/holiday/itinerary/<?php echo $package[$i]->holiday_id; ?>">Add/Edit itinerary</a></td>
                                    <td><a href="<?php echo site_url() ?>/holiday/holiday_rates/<?php echo $package[$i]->holiday_id; ?>">Add/Edit Rates</a></td>
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
                                    <th>Image</th>
                                    <th>Package Name</th>
                                    <th>Destination</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>                                 
                                    <th>Add/Edit Review</th>
                                    <th>Add/Edit Itinerary</th>
                                    <th>Add/Edit Rate Calulcations</th>
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


