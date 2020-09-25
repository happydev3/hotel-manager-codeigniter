
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url(); ?>home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url(); ?>home">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Tax Manager</h3>
                           
                                
                           <ul class="nav nav-pills">                           
								<li class="active">
							
								</li>								
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="hotel-markup">
                                    
                        
                  						 <table width="100%" border="0" cellpadding="3" cellspacing="0">
					
                    <form class="form-horizontal" name='hotel_generic' id="hotel_generic" action="">
                  <fieldset>
                      <tr> 
                        <td class="center">Service Type</td>
                        <td>                                        
              <select id="selectError2" name="service_type" required>
              
                        <option value="1">Hotel</option>
                        <option value="2">Flights</option>
                        <option value="3">Bus</option>
                        <option value="4">Apartment</option>
                        								
             </select>
                                 
                         </td>                  
                        
                        <td class="center">Tax</td>
                        <td>
                        <input class="required" id="service_tax" type="text" name="service_tax" style="width:40px;" required> %
                        </td>
                        <td>
                        <button type="submit" class="btn btn-primary" >Add Tax</button>
                        </td>
                      </tr>
                  </fieldset>
				</form> 

				</table>
                <br/><br/><br/>
                
										<table class='table table-striped dataTable table-bordered'>
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>  
                                                  <th>Type</th>                           	
                                                  <th>Amount</th>
                                                                                 
                                                  <th>Status</th>
                                          
                                              </tr>
                                          </thead>
											<tbody><?php //echo '<pre>';print_r($get_site_tax);exit; ?>
                                            <?php if(!empty($get_site_tax)) {?>
                          <?php $j=0;
						  for($i=0;$i<count($get_site_tax);$i++) {?>
                  
							<tr>
                                <td><?php echo $j+1;?></td>
                               <td><?php  if($get_site_tax[$i]->type == '1'){
							   echo 'Hotels';
							   }elseif($get_site_tax[$i]->type == '2'){
							   echo 'Flights';
							   }
							   elseif($get_site_tax[$i]->type == '3'){
							    echo 'Bus';
								}else if($get_site_tax[$i]->type == '4'){
								echo 'Apartment';
								}
							   ?></td>
                            	<td><?php echo $get_site_tax[$i]->tax_amount;?></td>
								
								<td class="center">
									
                             <!--       <a class="btn btn-small manageB2BbusMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>" data-value="1" data-markup-id="<?php echo $get_site_tax[$i]->markup_id;?>" >
										<i class="icon-ok"></i>			                                          
									</a>
                                     <a class="btn btn-small manageB2BbusMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>" data-value="0" data-markup-id="<?php echo $get_site_tax[$i]->markup_id;?>" >
										<i class="icon icon-color icon-remove"></i>			                                          
									</a>
									<a class="btn btn-danger manageB2BbusMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>" data-value="2" data-markup-id="<?php echo $get_site_tax[$i]->markup_id;?>" >
										<i class="icon-trash icon-white"></i> 
										
									</a> -->
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
</div>	
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

<script type="text/javascript">

$(document).ready(function() {
	
	// Ajax call for generic hotel markups
	
	$("#hotel_generic").submit(function(ev){
		ev.preventDefault();    
		
		$service_type = $( "select[name='service_type'] option:selected" ).val();
		$tax = $( "input[name='service_tax']" ).val();			
		
		var dataString = "service_type="+ $service_type +"&tax="+ $tax ;
		alert(dataString);
		if(confirm('Are you sure you want to Add/Update Tax?')) {
			 
			 $.ajax({
				url: '<?php echo site_url(); ?>/home/update_tax',
				type: "POST",
				data: dataString,
				
				success: function (data) {
					//alert(data);
					window.location = '<?php echo site_url(); ?>/home/jtpl_tax_charge';
				}
				
			});
		}	
		
	});
	
	
	
	
});


</script>

</body>
</html>