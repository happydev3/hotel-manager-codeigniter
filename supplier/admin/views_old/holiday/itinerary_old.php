<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/bootstrap.datepicker.css">
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>&nbsp;Add/Edit Itinerary Data (Day Wise)</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <ul class="nav nav-tabs navbar-left nav-dark">
               <li class="active">
                                    <a data-toggle="tab" href="#pass"><strong>Add/Edit itinerary Data</strong></a>
                                </li>
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
                                <!--  -->
                       
                            <div class="tab-content">
                                <div id="pass" class="tab-pane active" style="background: white;">	
                                    <form action="<?php echo site_url(); ?>/holiday/add_itinerary" method="post" class="form-horizontal">
                                        <input type="hidden" name="hol_id" value="<?php echo $hol_id ?>">
                                                 
                                             <div class="span12 columns" style="width:100%;">

                                                <fieldset style="padding-top:10px;">
                                                    <div id="add_policy_group">

                                                        <div class="control-group policy_row" >
                                                            <label for="inputError" class="control-label">
                                                                Daywise 
                                                            </label>
                                                            <label for="inputError" class="control-label" style="margin-left:200px">
                                                              Itinerary Info
                                                            </label
                                                       </div>

                                                        <?php
                                                        $i = 0;
                                                        if (!empty($hol_itinerary)) {

                                                            foreach ($hol_itinerary as $val) {
                                                                ?>
                                                                <div class="control-group policy_row">
                                                                   
                                                                <label class="control-label">
                                                                    <input type="text" name="day_no[]" style="width:164px;" value="<?php echo $val->day_no; ?>" placeholder="Day Wise" required="required"/>
                                                                </label>
                                                                <label class="control-label" style="margin-left:200px">
                                                                    <textarea  name="itinerary[]" placeholder="Itinerary" rows="3" cols="100" required="required" ><?php echo $val->itinerary; ?> </textarea>
                                                                </label>
                                                                
                                                             

                                                                <label class="control-label" style="margin-left:400px">
                                                                    <a href="#"  onclick="addPolicy(event);" class="btn btn-mini tip" data-original-title="Add Policy"><span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                    <a href="#"  onclick="removePolicy(event);" class="btn btn-mini tip" data-original-title="Delete Policy"><span class="glyphicon glyphicon-minus-sign"></span></a>

                                                                </label>

                                                                </div>                  
                                                                <?php
                                                                $i++;
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="control-group policy_row">
                                                             
                                                                

                                                                <label class="control-label">
                                                                    <input type="text" name="day_no[]" style="width:164px;" placeholder="Day Wise" required="required"/>
                                                                </label>
                                                                <label class="control-label" style="margin-left:200px">
                                                                    <textarea   name="itinerary[]" placeholder="Itinerary" rows="3" required="required"> </textarea>
                                                                </label>
                                                             

                                                                <label class="control-label" style="margin-left:400px">
                                                                    <a href="#"  onclick="addPolicy(event);" class="btn btn-mini tip" data-original-title="Add Policy"><span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                    <a href="#"  onclick="removePolicy(event);" class="btn btn-mini tip" data-original-title="Delete Policy"><span class="glyphicon glyphicon-minus-sign"></span></a>

                                                                </label>

                                                            </div>
<?php } ?>
                                                    </div>  

                                                    
                                              </div>
                                              <div class="form-actions" style="margin:0px;">
                                                        <button class="btn btn-primary" type="submit">Submit</button>
                                                        <a  class="btn" href="<?php echo site_url(); ?>">Cancel</a>
                                                     </div>
                                              </fieldset>
                                              </div>
                                              </form>
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                                           


       <!--  -->

<script>

      
            function addPolicy(e) {
                e.preventDefault();
                $('#add_policy_group').append('<div class="control-group policy_row"><label class="control-label"><input type="text" name="day_no[]" style="width:164px;" placeholder="Day Wise" required="required" /></label> <label class=" control-label" style="margin-left:200px"><textarea  name="itinerary[]" placeholder="Itinerary" rows="3" cols="100" required="required" > </textarea></label></div>');
                }

            function removePolicy(e) {
                e.preventDefault();
                if ($('#add_policy_group').find('.policy_row').length > 1) {
                    $('#add_policy_group').find('.policy_row:last').remove();
                }
                return false;
            }

           
        </script>
        <style>
            .policy_row .control-label{
                width:100px;
            }
        </style>  


<?php echo $this->load->view('footer'); ?>