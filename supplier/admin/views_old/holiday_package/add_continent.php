<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Continent List & Inspiration Content</h3>
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
     
          <br/>
          <ul class="nav nav-tabs nav-dark">
            <li class="active"><a href="#home2" data-toggle="tab"><strong>Continent List</strong></a></li>
          </ul>
          <br/>
          <div class="tab-content mb30">
           <div class="table-responsive">
            <table  id="datatable1" class="table table-striped table-bordered">
              <thead>
                <tr> 
                  <th>SI.No</th>
                  <th>Inspiration Image</th> 
                  <th>Continent</th>
                  <th>Below Discover Header Text</th>
                  <th>Paragraph Text</th>
                  <th>Edit Inpiration</th>                                 
                  <th title="Activate Only one continent for Inspiration which will come in Inspiration section on home page">Action (Only One will Activate)</th>
                </tr>
              </thead>   
              <tbody>
                <?php if (!empty($continent_list)) { ?>
                <?php for ($i = 0; $i < count($continent_list); $i++) { ?>
                <tr>
                  <td><?php echo $i + 1; ?></td>
                <td><img style="width:200px;height:100px;"src="<?php echo base_url(); echo $continent_list[$i]->inspiration_img_path; ?>"/></td>
                  <td class="center"><?php echo $continent_list[$i]->continent_name; ?></td>
                 <td class="center"><?php echo $continent_list[$i]->inspiration_header_text; ?></td>
                  <td class="center"><?php echo $continent_list[$i]->inspiration_text; ?></td>
                  <td class="center"> <a href="<?php echo site_url(); ?>/holidaypackage/edit_inspiration/<?php echo  $continent_list[$i]->continent_id; ?>" target="_blank" class="btn btn-info">EDIT</a><a href="<?php echo site_url(); ?>/holidaypackage/inspiration_country/<?php echo  $continent_list[$i]->continent_id; ?>" target="_blank" class="btn btn-info">View / Add Inspiration Country</a></td>
                  <td class="center"> 
                    <?php if($continent_list[$i]->active_inspiration!=1){ ?>
                    <a  href="" data-value="<?php echo  $continent_list[$i]->continent_id ;?>" data-name="<?php echo $continent_list[$i]->continent_name; ?>" style="margin: 0 0 0 8px;" class="active_inspiration btn btn-warning">Activate</a> 
                      <?php } else { ?>
                    <a href="" style="margin: 0 0 0 8px;" class="btn btn-success">Status Active</a>
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
        $('.active_inspiration').click(function(e) {
            e.preventDefault();
            $data_value = $(this).attr('data-value'); 
            $data_name = $(this).attr('data-name'); 
            if(confirm('Are you sure ! you want to Activate '+$data_name+'?')) {  
             $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/holidaypackage/inspiration",
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