<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Holiday Category</h3>
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
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_new_theme" enctype="multipart/form-data" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Theme Name</label>
                <div class="col-sm-6">
                  <input class="form-control" id="focusedInput" type="text" name="theme_name"  value="" required>                                   
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Home Page Category Image</label>           
                <div class="col-sm-6 ">
                  <input class="form-control" type="file" name="home_category_image"  required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Category Page Image</label>           
                <div class="col-sm-6 ">
                  <input class="form-control" type="file" name="category_image"  required>
                </div>
              </div>  			  
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">ADD</button>
                  <a href="<?php echo site_url(); ?>/holiday/holidaypackagethemelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                </div>
              </div>              
            </form>
            
            <br/>
            <ul class="nav nav-tabs nav-dark">

              <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Theme List</strong></a></li>

            </ul>
            <div class="tab-content mb30">
              <div class="table-responsive">
                <table  id="datatable1" class="table table-striped table-bordered">
                  <thead>
                    <tr> 
                      <th>SI.No</th>                    	
                      <th>Theme Name</th>
                      <th>Home Page Category Image</th>
                      <th>Category Page Image</th>
                      <th>Status</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>   
                  <tbody>
                    <?php if (!empty($theme)) { ?>
                    <?php for ($i = 0; $i < count($theme); $i++) { ?>
                    <tr>
                      <td><?php echo $i + 1; ?></td>
                      <td class="center"><?php echo $theme[$i]->theme_name; ?></td>
                      <td><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $theme[$i]->home_category_image; ?>"/></td>
                      <td><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $theme[$i]->category_image; ?>"/></td>
                      <td class="center">
                       <?php if($theme[$i]->isActive == 0) { ?>
                       <span class="label label-inactive">Inactive</span>
                       <?php } else if($theme[$i]->isActive == 1) {?>  
                       <span class="label label-success">Active</span>
                       <?php } ?>
                     </td>
                     <td>
                       <a href="<?php echo site_url(); ?>/holiday/set_theme_status/<?php echo $theme[$i]->theme_id;  ?>/1" onclick="return confirm('Do you really want to Active this Theme. ?')">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                      </a>
                      <a href="<?php echo site_url(); ?>/holiday/set_theme_status/<?php echo $theme[$i]->theme_id;  ?>/0" onclick="return confirm('Do you really want to InActive this Theme. ?')">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                      </a>
                      &nbsp;|&nbsp;
                      <a href="<?php echo site_url(); ?>/holiday/edit_package_theme/<?php echo  $theme[$i]->theme_id; ?>" target="_blank">Edit</a>
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
