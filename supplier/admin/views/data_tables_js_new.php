<script src="<?php echo base_url(); ?>public/js/vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/ColVis/js/dataTables.colVis.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>


 <script src="<?php echo base_url(); ?>public/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.flash.min.js
"></script>
<script src="<?php echo base_url(); ?>public/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/pdfmake.min.js
"></script>
<script src="<?php echo base_url(); ?>public/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.html5.min.js
"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.print.min.js
"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
  $('#table1, #table2, #table3, #table4, #table5').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [{extend:'pageLength', className: "btn-primary"},{       
                      extend: 'excel',
                      text: 'Export Excel',
                      exportOptions: {
                        rows: { selected: true }                                                
                      },
                      className: "btn-success"
                    }],
                    lengthMenu: [
                    [5, 10, 25, 50, -1 ],
                    ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                    ]
                  });
  });

</script> 
