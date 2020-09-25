<script src="<?php echo base_url(); ?>public/js/vendor/flot/jquery.flot.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/flot-spline/jquery.flot.spline.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/easypiechart/jquery.easypiechart.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/raphael/raphael-min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/morris/morris.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/owl-carousel/owl.carousel.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script> 
<!-- <script src="<?php echo base_url(); ?>public/js/vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>  -->
<script src="<?php echo base_url(); ?>public/js/vendor/chosen/chosen.jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/summernote/summernote.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/coolclock/coolclock.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/coolclock/excanvas.js"></script> 
<!--/ vendor javascripts --> 
<!-- Custom JavaScripts --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script> 
<!--/ custom javascripts --> 

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/vendor/gstatic/loader.js"></script> 
<script type="text/javascript">
  google.charts.load('upcoming', {'packages':['geochart']});
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {

	var data = google.visualization.arrayToDataTable([
	  ['Country', 'Visitors'],
	  ['Germany', 200],
	  ['America', 600],
	  ['Brazil', 100],
	  ['Canada', 400],
	  ['France', 190],
	  ['RU', 210]
	]);

	var options = {};

	var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

	chart.draw(data, options);
  }
</script> 

<!-- Page Specific Scripts  --> 
<script type="text/javascript">
        $(window).load(function(){            

            //Initialize morris chart
            Morris.Donut({
                element: 'browser-usage',
                data: [
                    {label: 'Chrome', value: 25, color: '#74c7ff'},
                    {label: 'Safari', value: 20, color: '#aa9bff'},
                    {label: 'Firefox', value: 15, color: '#ff8fa7'},
                    {label: 'Opera', value: 5, color: '#66cd7d'},
                    {label: 'Internet Explorer', value: 10, color: '#5e90b5'},
                    {label: 'Other', value: 25, color: '#ffdc88'}
                ],
                resize: true
            });
            //*Initialize morris chart


            // Initialize owl carousels
            $('#todo-carousel, #feed-carousel, #notes-carousel').owlCarousel({
                autoPlay: 5000,
                stopOnHover: true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : true,
                responsive: true
            });

            $('#appointments-carousel').owlCarousel({
                autoPlay: 5000,
                stopOnHover: true,
                slideSpeed : 300,
                paginationSpeed : 400,
                navigation: true,
                navigationText : ['<i class=\'fa fa-chevron-left\'></i>','<i class=\'fa fa-chevron-right\'></i>'],
                singleItem : true
            });
            //* Initialize owl carousels


            // Initialize rickshaw chart
            var graph;

            var seriesData = [ [], []];
            var random = new Rickshaw.Fixtures.RandomData(50);

            for (var i = 0; i < 50; i++) {
                random.addData(seriesData);
            }

            graph = new Rickshaw.Graph( {
                element: document.querySelector("#realtime-rickshaw"),
                renderer: 'area',
                height: 120,
                series: [{
                    name: 'Series 1',
                    color: '#9675ce',
                    data: seriesData[0]
                }, {
                    name: 'Series 2',
                    color: '#d4bdfa',
                    data: seriesData[1]
                }]
            });

            var hoverDetail = new Rickshaw.Graph.HoverDetail( {
                graph: graph,
            });

            graph.render();

            setInterval( function() {
                random.removeData(seriesData);
                random.addData(seriesData);
                graph.update();

            },1000);
            //* Initialize rickshaw chart

            //Initialize mini calendar datepicker
            $('#mini-calendar').datetimepicker({
                inline: true
            });
            //*Initialize mini calendar datepicker


            //todo's
            $('.widget-todo .todo-list li .checkbox').on('change', function() {
                var todo = $(this).parents('li');

                if (todo.hasClass('completed')) {
                    todo.removeClass('completed');
                } else {
                    todo.addClass('completed');
                }
            });
            //* todo's


            //initialize datatable
            $('#project-progress').DataTable({
                "aoColumnDefs": [
                  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                ],
            });
            //*initialize datatable

            //load wysiwyg editor
            $('#summernote').summernote({
                toolbar: [
                    //['style', ['style']], // no style button
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    //['insert', ['picture', 'link']], // no insert buttons
                    //['table', ['table']], // no table button
                    //['help', ['help']] //no help button
                ],
                height: 143   //set editable area's height
            });
            //*load wysiwyg editor
        });
    </script> 
<!--/ Page Specific Scripts --> 

</body>
</html>
