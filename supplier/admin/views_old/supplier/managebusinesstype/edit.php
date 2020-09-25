<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>Edit Business Type</h3>
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

    
							
							
              <?php 
                  if($this->session->flashdata('flash_message')){
                  if($this->session->flashdata('flash_message') == 'updated')
                  {
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo 'Business Type is updated with success.';
                    echo '</div>';       
                  }else{
                    echo '<div class="alert alert-error">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                    echo '</div>';          
                  }
                  }
              ?>
							<!-- <?php 
								  if($flash_message !=''){ ?>
								  <div class="alert ">
									<a class="close" data-dismiss="alert">×</a>
									<strong><?php echo $flash_message ?></strong>
									</div>
								<?php
									
								  }
							?> -->
							<?php
								  //form data
								  
								  //form validation
								  echo validation_errors();
								 //echo'<pre/>';print_r($businesstype);exit;
								  ?>	
								  <form action="<?php echo site_url(); ?>/supplier/businesstype_update/<?php echo $businesstype[0]['id'] ?>" method="post" >

								  <div class="form-group">
										<label for="req" class="col-sm-3 control-label">Business Type</label>
										 <div class="col-sm-6">
										  <input class='form-control'  type="text" id="" name="business_type" value="<?php echo $businesstype[0]['business_type']; ?>">
										</div>
									  </div>
								
                               <div class="clearfix"></div>
								
							<div class="ln_solid"></div>
	                        <div class="form-group">
                        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<input type="submit" class="btn btn-primary" value="Update">
                  <a href="<?php echo site_url() ?>/supplier/businesstype/" class="btn btn-primary">Cancel</a>
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


