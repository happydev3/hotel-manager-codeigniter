<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Business Type</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
              <li><a class="active" href="<?php echo site_url() ?>business_type/businesstype">Business Type</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
            </ul>
          </div>
          <div class="boxs-body">
          <?php 
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            }else if(!empty($errors_msg)){
                $message = $errors_msg;
              $class = 'danger';
            }
             else {
              $message = $error;
              $class = 'danger';
            }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>      
          </div>
          <div class="boxs-body">    
        <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>business_type/<?php echo $action ?>" enctype="multipart/form-data" method="post">
           <div class="form-group">                     
             <label class="col-sm-2 control-label" for="focusedInput"><strong>Business Type</strong></label>
             <div class="col-sm-2">
              <input class="form-control" id="focusedInput" type="text" name="business_type" required="">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            </div>
          </div>   
        </form>
        <br/>
        <div class="row">
          <div class="col-md-6">
            <div id="tableTools"></div>
          </div>
          <div class="col-md-6">
            <div id="colVis"></div>
          </div>
        </div>
        <table class="table table-custom" id="advanced-usage">
          <thead>
            <tr>
              <th>SI.No</th>
              <th>Business Type</th>        
              <th>Updated DateTime</th>
              <th>Status</th>
              <th>Active</th>
              <th>InActive</th>                
              <th>Block</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
           <?php 
           if(!empty($businesstype)) {?>
           <?php $j=0;
           for($i=0;$i<count($businesstype);$i++) {?>         
           <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $businesstype[$i]->business_type;?></td>            
            <td><?php echo $businesstype[$i]->date_time;?></td>         
            <td>
              <?php if($businesstype[$i]->status == 0) { ?>
              <label class="label label-danger">Inactive</label>
              <?php } else if($businesstype[$i]->status == 1) {?>
              <label class="label label-success">Active</label>
              <?php } else if($businesstype[$i]->status == 2) {?>
              <label class="label label-warning">Blocked</label>
              <?php } else{?>
              <label class="label label-info">Pending</label>
              <?php } ?>
            </td>
            <td class="center">
             <a class="btn btn-success btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_business_type_status"  data-url="<?php echo site_url(); ?>"
               data-id="<?php echo $businesstype[$i]->id;  ?>" data-status="1"  title="Active"><i class="fa fa-check"></i> <span>Active</span></a>
             </td>
             <td>
               <a class="btn btn-danger btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_business_type_status" data-url="<?php echo site_url(); ?>"
                data-id="<?php echo $businesstype[$i]->id;  ?>" data-status="0" title="InActive"><i class="fa fa-times"></i> <span>Inactive</span></a>
              </td>
                <td>
                  <a class="btn btn-warning btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_business_type_status" data-url="<?php echo site_url(); ?>" data-id="<?php echo $businesstype[$i]->id;  ?>" data-status="2" title="Block" ><i class="fa fa-times"></i> <span>Block</span></a>                                 
                </td>
                  <td>
                  <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>business_type/view_business_type_info/<?php echo $businesstype[$i]->id;?>" title="Edit" ><i class="fa fa-times"></i> <span>Edit</span></a>                                 
                </td>                 
              </tr>             
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>            
      </div>
    </section>
  </div>
</div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $(window).load(function(){
    //initialize responsive datatable
    function stateChange(iColumn, bVisible) {
      console.log('The column', iColumn, ' has changed its status to', bVisible);
    }
    var table4 = $('#advanced-usage').DataTable({    
      "aoColumnDefs": [
      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
      ]
    });
    var colvis = new $.fn.dataTable.ColVis(table4);
    $(colvis.button()).insertAfter('#colVis');
    $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');
    var tt = new $.fn.dataTable.TableTools(table4, {
      sRowSelect: 'single',
      "aButtons": [
      // 'copy',
      // 'print', 
      {
        'sExtends': 'collection',
        'sButtonText': 'Save',
        // 'aButtons': ['csv', 'xls', 'pdf']
         'aButtons': ['csv']
      }
      ],
      "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    });
    $(tt.fnContainer()).insertAfter('#tableTools');    
    //*initialize responsive datatable
    $(".manage_business_type_status").click(function(){ 
     $siteUrl=$(this).attr('data-url');     
     $id=$(this).attr('data-id');
     $status=$(this).attr('data-status');
     $message=$(this).attr('title');
     if(confirm('Are you sure you want to '+ $message+' this Business Type?')) {
       $.ajax({
        url: $siteUrl + 'business_type/set_business_type_status/',
        data: 'id='+$id+'&status='+$status,
        dataType: 'json',
        type: 'POST',
        success: function(data)
        { window.location.href=$siteUrl + 'business_type/businesstype/'; }
      });
     }
   });
 
    });
  </script> 