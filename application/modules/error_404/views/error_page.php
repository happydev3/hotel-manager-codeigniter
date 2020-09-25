
<!-- Header section
    ================================================== -->
    <?php $this->load->view('home/header');?>

<!-----  Top destination content ----->
<!--<div class="container">
	<h3>Change Your Profile Password</h3>
</div>-->

<div class="accountCntr">
  <div class="container"> 
    
    <!--hotel search section-->
    <div class="row white-container">
	
      
       <div class="col-md-8" style="height:300px;align:center;margin-left: 10%">   
           <div style=" margin-top: 20px;align:center">
                   <table align="center" style="width:100%;margin:15%;margin-left: 15%">
            <tbody>
                <tr>
                    <td class="msgIcon"><img src="<?php echo get_image_aws('public/img/Warning.png') ?>"></td>
                    <td tabindex="-1" class="noticeTextType1 strongText">
                        <strong>ERROR MESSAGE : 

                            <?php
                           echo 'Page Not Found';
                            ?>
                        </strong></td>
                </tr>
            </tbody>
        </table>
           </div>
       		
          
       </div>
      
</div>

 </div>

<!-- FOOTER -->
	<?php $this->load->view('home/footer');?>
   
<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="<?php echo base_url();?>public/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script> 

<script src="<?php echo base_url();?>public/js/bjqs-1.3.min.js"></script>
<script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 360,
            width       : 620,
            responsive  : true
          });

        });
      </script>
<script src="<?php echo base_url();?>public/js/customize.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/alert_info.css" type="text/css" /> 

</body>
</html>
