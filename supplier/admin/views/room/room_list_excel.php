<?php // $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">




<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Room list</h2>
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Room list</a></li>
            </ul>
              
            </div>
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
            </ul>
          </div>
          <div class="boxs-body">
           <?php
              $sess_msg = $this->session->flashdata('message');
              if(!empty($sess_msg)){
                $message = $sess_msg;
                $class = 'success';
                $status = 'success';
              } else {
                $error = $this->session->flashdata('error');
                $message = $error;
                $class = 'danger';
                $status = 'error';
              }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($status) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
           <form  role="form">
              <div class="row">                      
                <div class="form-group col-md-4">
                 <label class="strong" for="hotel_code">Hotel Code : </label>
                  <input name="hotel_code" id="hotel_code" value="<?php echo set_value('hotel_code'); ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                 <label class="strong" for="room_name">Room Name : </label>
                  <input name="room_name" id="room_name" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control">
                </div>
               
                <div class="form-group col-md-4" style="padding-top: 23px;">
                 
                 <input  class="btn btn-success" type="button"  value="Search" />
              
                 
                 <input  class="btn btn-warning" type="reset" value="Clear Filter" />
                </div>
                </div>
                
            </form>
            <div class="row">
             <div class="col-md-4">
               <a href="<?php echo site_url() ?>hotel/add_room" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
               </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-6">
                <div id="tableTools"></div>
              </div>
              <div class="col-md-6">
                <div id="colVis"></div>
              </div>
            </div>
            <div class="table-responsive">
                            <div class="double-scroll">
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>             
                  <th>SL. No.</th>
                  <th>Hotel Code</th>
                  <th>Room Name</th>                  
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th> 
                   <th>SL. No.</th>
                  <th>Hotel Code</th>
                  <th>Room Name</th>                  
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th>                   
                </tr>
              </thead>
              <tbody>
              <?php for($i=0;$i<500;$i++) { ?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td>NT00001</td>
                  <td>Single AC Room</td>
                  <td>                 
                    <label class="label label-success">Active</label>
                  </td>
                  <td>                 
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Room. ?')"><i class="fa fa-times"></i> Inactive</a>
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td>  
                   <td><?php echo $i+2;?></td>
                  <td>NT00001</td>
                  <td>Single AC Room</td>
                  <td>                 
                    <label class="label label-success">Active</label>
                  </td>
                  <td>                 
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Room. ?')"><i class="fa fa-times"></i> Inactive</a>
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td>                    
                </tr>
                <tr>
                  <td><?php echo $i+3;?></td>
                  <td>NT00002</td>
                  <td>Double Luxury/AC Room</td>
                  <td>                 
                   <label class="label label-danger">Inactive</label>
                  </td>
                  <td> 
                     <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Room. ?')"><i class="fa fa-check"></i> Active</a>          
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td> 
                   <td><?php echo $i+4;?></td>
                  <td>NT00002</td>
                  <td>Double Luxury/AC Room</td>
                  <td>                 
                   <label class="label label-danger">Inactive</label>
                  </td>
                  <td> 
                     <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Room. ?')"><i class="fa fa-check"></i> Active</a>          
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td>                       
                </tr>   
                <?php } ?>           
              </tbody>
            </table>
            </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php // echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>




<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js
"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js
"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>






<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script> 
<script>
$(document).ready(function() {
  $(".select2").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    // allowClear: true
  });

});

$(document).ready(function() {
   $('.double-scroll').doubleScroll();
     $('#example').doubleScroll({
    resetOnWindowResize: true
  });
});

 (function( $ ) {
  
  jQuery.fn.doubleScroll = function(userOptions) {
  
    // Default options
    var options = {
      contentElement: undefined, // Widest element, if not specified first child element will be used
      scrollCss: {                
        'overflow-x': 'auto',
        'overflow-y': 'hidden'
      },
      contentCss: {
        'overflow-x': 'auto',
        'overflow-y': 'hidden'
      },
      onlyIfScroll: true, // top scrollbar is not shown if the bottom one is not present
      resetOnWindowResize: false, // recompute the top ScrollBar requirements when the window is resized
      timeToWaitForResize: 30 // wait for the last update event (usefull when browser fire resize event constantly during ressing)
    };
  
    $.extend(true, options, userOptions);
  
    // do not modify
    // internal stuff
    $.extend(options, {
      topScrollBarMarkup: '<div class="doubleScroll-scroll-wrapper" style="height: 20px;"><div class="doubleScroll-scroll" style="height: 20px;"></div></div>',
      topScrollBarWrapperSelector: '.doubleScroll-scroll-wrapper',
      topScrollBarInnerSelector: '.doubleScroll-scroll'
    });

    var _showScrollBar = function($self, options) {

      if (options.onlyIfScroll && $self.get(0).scrollWidth <= $self.width()) {
        // content doesn't scroll
        // remove any existing occurrence...
        $self.prev(options.topScrollBarWrapperSelector).remove();
        return;
      }
    
      // add div that will act as an upper scroll only if not already added to the DOM
      var $topScrollBar = $self.prev(options.topScrollBarWrapperSelector);
      
      if ($topScrollBar.length == 0) {
        
        // creating the scrollbar
        // added before in the DOM
        $topScrollBar = $(options.topScrollBarMarkup);
        $self.before($topScrollBar);

        // apply the css
        $topScrollBar.css(options.scrollCss);
        $self.css(options.contentCss);

        // bind upper scroll to bottom scroll
        $topScrollBar.bind('scroll.doubleScroll', function() {
          $self.scrollLeft($topScrollBar.scrollLeft());
        });

        // bind bottom scroll to upper scroll
        var selfScrollHandler = function() {
          $topScrollBar.scrollLeft($self.scrollLeft());
        };
        $self.bind('scroll.doubleScroll', selfScrollHandler);
      }

      // find the content element (should be the widest one)  
      var $contentElement;    
      
      if (options.contentElement !== undefined && $self.find(options.contentElement).length !== 0) {
        $contentElement = $self.find(options.contentElement);
      } else {
        $contentElement = $self.find('>:first-child');
      }
      
      // set the width of the wrappers
      $(options.topScrollBarInnerSelector, $topScrollBar).width($contentElement.outerWidth());
      $topScrollBar.width($self.width());
      $topScrollBar.scrollLeft($self.scrollLeft());
      
    }
  
    return this.each(function() {
      
      var $self = $(this);
      
      _showScrollBar($self, options);
      
      // bind the resize handler 
      // do it once
      if (options.resetOnWindowResize) {
      
        var id;
        var handler = function(e) {
          _showScrollBar($self, options);
        };
      
        $(window).bind('resize.doubleScroll', function() {
          // adding/removing/replacing the scrollbar might resize the window
          // so the resizing flag will avoid the infinite loop here...
          clearTimeout(id);
          id = setTimeout(handler, options.timeToWaitForResize);
        });

      }

    });

  }

}( jQuery ));

</script>