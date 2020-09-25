<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit <?php echo $ins_continent_list->continent_name; ?> Inspiration Content</h3>
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
                 
						 <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_inspiration" enctype="multipart/form-data" method="post">
            <div class="form-group">
             <label class="col-sm-3 control-label">Continent Name</label>
             <div class="col-sm-6">
             <input type="text" class="form-control" name="content_name" value="<?php echo $ins_continent_list->continent_name; ?>" disabled />
             <input type="hidden" name="continent" value="<?php echo $ins_continent_list->continent_id;?>">             
              </div>
            </div>
            <?php if(!empty($ins_continent_list->inspiration_img_path)) { ?>
             <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Current Inspiration Image</label>
                <div class="col-sm-6">
                 <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $ins_continent_list->inspiration_img_path; ?>"/>                                   
                </div>
                </div>
                <?php } ?> 
            <div class="form-group">
              <label class="col-sm-3 control-label" for="focusedInput">Update New Inspiration Image</label>           
              <div class="col-sm-6 ">
              <input class="form-control" type="file" name="inspiration_image" <?php if(empty($ins_continent_list->inspiration_img_path)) { 
                echo 'required'; } ?>>
              </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-3  control-label">Inspiration Below Discover Header Text</label>
                    <div class="col-sm-6 " style="width:70%">
                        <textarea class="form-control" id="" rows="10" name="inspiration_header_text" placeholder="Enter text here..." required><?php echo $ins_continent_list->inspiration_header_text;?></textarea>
                    </div>
             </div>
             <div class="form-group">
                    <label class="col-sm-3  control-label">Inspiration Paragraph Text</label>
                    <div class="col-sm-6 " style="width:70%">
                        <textarea class="form-control" id="" rows="10" name="inspiration_text" placeholder="Enter text here..." required><?php echo $ins_continent_list->inspiration_text;?></textarea>
                    </div>
             </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url(); ?>/holidaypackage/continent" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
              </div>
            </div>                  
          </form>        
                                                   
						</div>
					
					</div>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
 <?php echo $this->load->view('footer'); ?>
