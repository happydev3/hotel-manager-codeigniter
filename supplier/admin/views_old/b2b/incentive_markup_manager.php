
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
							<h3>Agent Discount Markup Manager</h3>
                           
                        						
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="hotel-markup">
                                    	<legend></legend> 
                        
                  						 <table width="100%" border="0" cellpadding="3" cellspacing="0">
					
                    <form class="form-horizontal" name='hotel_generic' id="hotel_generic" action="">
                  <fieldset>
				  
                      <tr> 
                        <td class="center">Agent</td>
                        <td>                                        
              <select id="selectError2" name="gen_agent_no" required>
                        <option value="all">ALL</option>
                        <optgroup label="Active Agent List">                                       
                        <?php
                            for($i=0;$i<count($agent_list);$i++) {?>
                               <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
                            <?php } ?>
                        									
                        </optgroup>										
             </select>
                                 
                         </td>  
						 <td>Type</td>
						 <td>
							 <select name="service_type">
								 <option value="1">Hotels</option>
								 <option value="2">Flights</option>
								 <option value="4">Bus</option>
								 <option value="5">Apartments</option>
								 
								 </select>
							 
							 </td>
						 </tr>
						
						 <tr>
                  
						     <td class="center">Markup Process</td>
						 <td>
						  <select name="hotel_gen_markup_process" required>
								 <option value="1">Percent</option>
								 <option value="2">Fixed</option>						
						  </select>						 
						 </td>
						 
                        <td class="center">Markup</td>
                        <td>
                        <input class="required" id="hotel_gen_markup" type="text" name="hotel_gen_markup" style="width:40px;" required> %
                        </td>
                        <td>
                        <button type="submit" class="btn btn-primary" >Add MarkUp</button>
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
                                                  <th>Agent No</th>                           	
                                                 <th>MarkUp Process</th>
                                                  <th>Markup (%)</th>                                 
                                              
                                              </tr>
                                          </thead>
											<tbody><?php //echo '<pre>';print_r($b2b_markup_list);exit; ?>
                                            <?php if(!empty($b2b_markup_list)) {?>
                          <?php $j=0;
						  for($i=0;$i<count($b2b_markup_list);$i++) {?>
                          
							<tr>
                                <td><?php echo $i+1;?></td>
                                <td><?php if($b2b_markup_list[$i]->service_type == '1'){ echo 'Hotels';}elseif($b2b_markup_list[$i]->service_type == '2'){ echo 'Flights';}elseif($b2b_markup_list[$i]->service_type == '4'){ echo 'Bus'; }elseif($b2b_markup_list[$i]->service_type == '5'){ echo 'Apartment'; }?></td>
                            	<td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
								<td class="center"><?php if($b2b_markup_list[$i]->markup_process == '1'){ echo 'Percent'; }else{ echo 'Fixed'; }?></td>
								<td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>             
                                
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
		
		$agent_no = $( "select[name='gen_agent_no'] option:selected" ).val();
		$markup = $( "input[name='hotel_gen_markup']" ).val();			
		$api_name = $('select[name="hotel_gen_api"] option:selected').val();
		$markup_type = 'generic';
		$service_type =$('select[name="service_type"] option:selected').val();
		$country = 'all';
		  $markup_process = $( "select[name='hotel_gen_markup_process']" ).val();		
		var dataString = "agent_no="+ $agent_no +"&service_type="+ $service_type +"&markup_type="+ $markup_type +"&markup="+ $markup +"&process="+ $markup_process;
		alert(dataString);
		if(confirm('Are you sure you want to Add/Update B2B Generic Bus MarkUp?')) {
			 
			 $.ajax({
				url: '<?php echo site_url(); ?>/b2b/update_incentive_markups',
				type: "POST",
				data: dataString,
				
				success: function (data) {
					//alert(data);
					window.location = '<?php echo site_url(); ?>/b2b/b2b_incentive_manager';
				}
				
			});
		}	
		
	});
	
	// Ajax call for specific Bus markups
	
	$("#hotel_specific").submit(function(ev){
		ev.preventDefault();    
		alert('s');
		$agent_no = $( "select[name='spec_agent_no'] option:selected" ).val();
		$markup = $( "input[name='hotel_spec_markup']" ).val();			
		$api_name = $('select[name="hotel_spec_api"] option:selected').val();
		$markup_type = 'specific';
		$service_type =$('select[name="service_type"] option:selected').val();
	
		$markup_process = 1;
		var dataString = "agent_no="+ $agent_no +"&service_type="+ $service_type +"&markup_type="+ $markup_type +"&api_name="+ $api_name +"&markup="+ $markup +"&process="+ $markup_process;
		alert(dataString);
		if(confirm('Are you sure you want to Add/Update B2B Specific Bus MarkUp?')) {
			 
			 $.ajax({
				url: '<?php echo site_url(); ?>/b2b/update_incentive_markups',
				type: "POST",
				data: dataString,
				
				success: function (data) {
					//alert(data);
					window.location = '<?php echo site_url(); ?>/b2b/b2b_incentive_manager';
				}
				
			});
		}	
		
	});
	
	
});


</script>

</body>
</html>