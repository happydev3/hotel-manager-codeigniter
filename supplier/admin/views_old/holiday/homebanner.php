<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Continent List</h3>
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
            <?php  ?>
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_banner" enctype="multipart/form-data" method="post">            
              <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Home Banner Image</label>           
                <div class="col-sm-6 ">
                  <input class="form-control" type="file" name="banner_image"  required>
                </div>
              </div>            
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Add</button>          
                </div>
              </div>                  
            </form>   <?php  ?>        
            <br/>
            <ul class="nav nav-tabs nav-dark">
              <li class="active"><a href="#home2" data-toggle="tab"><strong>Home Banner List</strong></a></li>
            </ul>
            <br/>
            <div class="tab-content mb30">
              <div class="table-responsive">
                <table  id="datatable1" class="table table-striped table-bordered">
                  <thead>
                    <tr> 
                      <th>SI.No</th>            
                      <th>Banner</th> 
                      <th>Status</th>
                      <th>Actions</th>             
                    </tr>
                  </thead>   
                  <tbody>
                    <?php if (!empty($banner)) { ?>
                    <?php for ($i = 0; $i < count($banner); $i++) { ?>
                    <tr>
                      <td><?php echo $i + 1; ?></td>
                      <td><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $banner[$i]->img_path; ?>"/></td>
                      <td class="center">
                       <?php if($banner[$i]->isActive == 0) { ?>
                       <span class="label label-inactive">Inactive</span>
                       <?php } else if($banner[$i]->isActive == 1) {?>  
                       <span class="label label-success">Active</span>
                       <?php } ?>
                     </td>
                     <td>
                       <a href="<?php echo site_url(); ?>/holiday/set_banner_status/<?php echo $banner[$i]->banner_id;  ?>/1" onclick="return confirm('Do you really want to Active this Banner. ?')">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                      </a>
                      <a href="<?php echo site_url(); ?>/holiday/set_banner_status/<?php echo $banner[$i]->banner_id;  ?>/0" onclick="return confirm('Do you really want to InActive this Banner. ?')">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                      </a>
                      &nbsp;|&nbsp;
                      <a href="<?php echo site_url(); ?>/holiday/edit_banner/<?php echo  $banner[$i]->banner_id; ?>" target="_blank">Edit</a>
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
<script src="<?php echo base_url();?>public/js/ckeditor/adapters/jquery.js"></script>