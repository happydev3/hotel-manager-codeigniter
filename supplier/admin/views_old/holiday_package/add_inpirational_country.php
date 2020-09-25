<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php  echo strtoupper('Discover'.' '.$ins_country_list[0]->continent_name);  ?> 
       </h3>
      </div>
    </div>
    <div class="clearfix"></div>     
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
           <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br/>
          <?php if(isset($error)){ ?>
          <div class="alert alert-error">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong>Error....!</strong>
            <?php echo $error; ?>
          </div>
          <?php } ?>
      
      <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_inspiration_country" enctype="multipart/form-data" method="post">
               <div class="form-group">
                 <label class="col-sm-3 control-label">Select country</label>
                <div class="col-sm-6">
                  <select  id="country" name="country" class="holidaypackage_country form-control" tabindex="-1" required>
                    <option value="">Select Your Country</option>
                    <optgroup label="Country List">                                       
                                        <?php
                      for($i=0;$i<count($ins_country_list);$i++) {?>
                      <option value="<?php echo $ins_country_list[$i]->country_id; ?>"><?php echo $ins_country_list[$i]->country_name; ?></option>
                    <?php } ?>                    
                    </optgroup>                   
                  </select>
                </div>
                </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label" for="focusedInput">Add Country Inspiration Image</label>           
              <div class="col-sm-6 ">
              <input class="form-control" type="file" name="country_inspiration_image"  required>            
              </div>
            </div>          
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url(); ?>/holidaypackage/inspiration_country/<?php echo $ins_country_list[0]->continent_id ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
              </div>
            </div>                  
          </form>        
          <br/>
          <ul class="nav nav-tabs nav-dark">
            <li class="active"><a href="#home2" data-toggle="tab"><strong>Country  List</strong></a></li>
          </ul>
          <br/>
          <div class="tab-content mb30">
           <div class="table-responsive">
            <table  id="datatable1" class="table table-striped table-bordered">
              <thead>
                <tr> 
                  <th>SI.No</th>
                  <th>Inspiration Country Image</th>
                  <th>Country</th>
                  <th>Status</th>                          
                  <th>Action</th>                
                </tr>
              </thead>   
              <tbody>
                <?php if (!empty($ins_country_list)) { ?>
                <?php for ($i = 0; $i < count($ins_country_list); $i++) { ?>
                <tr>
                  <td><?php echo $i + 1; ?></td>
                <td><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $ins_country_list[$i]->country_inspiration_image; ?>" alt="Update the Image"/></td>
                  <td class="center"><?php echo $ins_country_list[$i]->country_name; ?></td>          
                   <td class="center">
                   <?php if(!empty($ins_country_list[$i]->country_inspiration_image)) { ?>
                    <?php if($ins_country_list[$i]->active_inspiration_country!=1){ ?>
                     Inactive</a> 
                      <?php } else { ?>
                       Active
                      <?php } } else { ?> 
                     Disabled
                      <?php } ?>          
                   </td> 
                  <td class="center"> 
                  <?php if(!empty($ins_country_list[$i]->country_inspiration_image)) { ?>
                    <?php if($ins_country_list[$i]->active_inspiration_country!=1){ ?>
                    <a href="<?php echo site_url(); ?>/holidaypackage/inspirationcountry/<?php echo $ins_country_list[$i]->continent_id;  ?>/<?php echo $ins_country_list[$i]->country_id;  ?>/1" onclick="return confirm('Are you sure ! you want to Activate . ? '+'<?php echo $ins_country_list[$i]->country_name; ?>')" style="margin: 0 0 0 8px;" class="btn btn-success">Activate</a> 
                      <?php } else { ?>
                     <a href="<?php echo site_url(); ?>/holidaypackage/inspirationcountry/<?php echo $ins_country_list[$i]->continent_id;  ?>/<?php echo $ins_country_list[$i]->country_id;  ?>/0" onclick="return confirm('Are you sure ! you want to Deactivate . ? '+'<?php echo $ins_country_list[$i]->country_name; ?>')" style="margin: 0 0 0 8px;" class="btn btn-warning">Deactivate</a> 
                      <?php } } else { ?> 
                      <button style="margin: 0 0 0 8px; cursor: not-allowed;" class="btn btn-danger">Disabled</button>
                      <?php } ?>           
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
  </div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>
<script>
    $(document).ready(function() {        
        $('.active_inspiration_country').click(function(e) {
            e.preventDefault();
            $data_value = $(this).attr('data-value'); 
            $data_name = $(this).attr('data-name'); 
            if(confirm('Are you sure ! you want to Activate '+$data_name+'?')) {  
             $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/holidaypackage/inspirationcountry",
                dataType: 'html',
                data: {data_val: $data_value},
                success: function(data) {
                      new PNotify({
                                  title: 'success',
                                  text: $data_name+' Successfully Activated',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
                      window.location.reload();
                }
            });
           }
                       
        });
    });
  </script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/adapters/jquery.js"></script>