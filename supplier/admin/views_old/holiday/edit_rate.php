<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<div class="mainpanel">
    <?php echo $this->load->view('top_panel'); ?>

    <style>
        .paging_full_numbers {
            line-height: 22px;
            margin-top: 22px;
        }
        .mb30 {
            margin-bottom: 30px;
            /* height: 398px; */
            min-height: 400px;
        }
      /*  table tr td{
            width:20px !important;
        }*/
         table {
    table-layout:fixed;
}
table td {
    width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
}
    </style>
    <div class="contentpanel">





        <?php if (isset($error)) { ?>
            <div class="alert alert-error">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <strong>Error....!</strong>
                <?php echo $error; ?>
            </div>
        <?php } ?>


        <br/>

        <div class="row">
            <div class="col-md-12">
                <h2>Edit Holiday Rates</h2>
                
                  <div class="row">
            <div class="col-md-12">
            <div class="col-md-12"><h4>Edit rates for <b>" <?php echo $hol_info->package_title; ?> "</b></h4></div><br>
               <div class="col-md-2"><b>Holiday Duartion : </b></div><div class="col-md-8"><?php echo $hol_info->start_date; ?> to <?php echo $hol_info->end_date; ?></div><br>
           
            </div>
        </div>
                <?php if(!empty($result)){ ?>
                <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/edit_pax_package_type" enctype="multipart/form-data" method="post">

                    <?php
                    $i = 0;
                    foreach ($result as $res) {
                        ?>
                        <script>
                            function calender<?php echo $i; ?>(){
                                var nowTemp = new Date();
                                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                                var startdate = $('#datepick<?php echo $i; ?>').datepicker({
                                    minDate: 0,
                                    maxDate: '+12M',
                                    numberOfMonths: 2,
                                    dateFormat: 'dd/mm/yy',
                                    onRender: function(date) {

                                            
                                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                                              

                                    }
                                }).on('changeDate', function(ev) {
              
                                    if (ev.date.valueOf() > enddate.date.valueOf()) {
                                        var newDate = new Date(ev.date)
                                        newDate.setDate(newDate.getDate() + 1);
                                        enddate.setValue(newDate);
                                    }
                                    startdate.hide();
                                    $('#datepick1<?php echo $i; ?>')[0].focus();
              
                                         
                                }).data('datepicker');


                                var enddate = $('#datepick1<?php echo $i; ?>').datepicker({
                                    minDate: 1,
                                    maxDate: '+12M',
                                    numberOfMonths: 2,
                                    dateFormat: 'dd/mm/yy',
               
                                    onRender: function(date) {

                                        return date.valueOf() <= startdate.date.valueOf() ? 'disabled' : '';

                                    }

                                }).on('changeDate', function(ev) {

                                    enddate.hide();

                                }).data('datepicker');  
                            }
                        </script>

                        <table width="100%" border="1" class="currency_first" id="currency_first" style="position:relative;top:50px;">
                            <tr><td>
                            <select name="currency[]">
                                <?php foreach($currency as $curr){ ?>
<option value="<?php echo $curr["currency_code"]; ?>" <?php if($res->currency==$curr["currency_code"]) echo 'selected'; ?>><?php echo $curr['currency_code']; ?></option>
                                <?php } ?>
                            </select>
                                </td>
                                <td><input type="text" name="start_date[]" id="datepick<?php echo $i; ?>" class="datepicker" value="<?php $stardt=explode('-',$res->start_date); echo $stardt[2].'-'.$stardt[1].'-'.$stardt[0]; ?>" placeholder="Start Date" onclick="return calender<?php echo $i; ?>();" ></td>
                                <td><input class="datepicker" id="datepick1<?php echo $i; ?>" type="text" name="end_date[]" placeholder="End Date" value="<?php $enddt=explode('-', $res->end_date); echo $enddt[2].'-'.$enddt[1].'-'.$enddt[0]; ?>"  onclick="return calender<?php echo $i; ?>();" > </td>
                            </tr>
                            <tr><td>Holiday Package</td>
                                <td>Single</td>
                                <td>Twin Sharing</td>
                                <td>Triple Sharing</td>
                                <td>Quad Sharing</td>
                                <td>Infant</td>
                                <td>Child With Bed</td>
                                <td>Child Without Bed</td>
                            </tr>

                            <tr>
                                <td><span>Standard</span><input type="hidden" value="3" name="package_type"/></td>
                                <td><input type="text" name="standard_single[]" value="<?php echo $res->standard_single ?>"></td>
                                <td><input type="text" name="standard_twin[]" value="<?php echo $res->standard_twin ?>"></td>
                                <td><input type="text" name="standard_triple[]" value="<?php echo $res->standard_triple ?>"></td>
                                <td><input type="text" name="standard_quad[]" value="<?php echo $res->standard_quad ?>"></td>
                                <td><input type="text" name="standard_infant[]" value="<?php echo $res->standard_infant ?>"></td>
                                <td><input type="text" name="standard_cwb[]" value="<?php echo $res->standard_cwb ?>"></td>
                                <td><input type="text" name="standard_cwithoutbed[]" value="<?php echo $res->standard_cwithoutbed ?>"></td>
                            </tr>

                            <tr>
                                <td><span>DELUXE</span><input type="hidden" value="2" name="package_type"/></td>
                                <td><input type="text" name="deluxe_single[]" value="<?php echo $res->deluxe_single ?>"></td>
                                <td><input type="text" name="deluxe_twin[]" value="<?php echo $res->deluxe_twin ?>"></td>
                                <td><input type="text" name="deluxe_triple[]" value="<?php echo $res->deluxe_triple ?>"></td>
                                <td><input type="text" name="deluxe_quad[]" value="<?php echo $res->deluxe_quad ?>"></td>
                                <td><input type="text" name="deluxe_infant[]" value="<?php echo $res->deluxe_infant ?>"></td>
                                <td><input type="text" name="deluxe_cwb[]" value="<?php echo $res->deluxe_cwb ?>"></td>
                                <td><input type="text" name="deluxe_cwithoutbed[]" value="<?php echo $res->deluxe_cwithoutbed ?>"></td>
                            </tr>

                            <tr>
                                <td>
                                    <div>
                                        <span>Premium</span>
                                        <input type="hidden" value="1" name="package_type" <?php echo $res->currency ?>/>
                                    </div></td>
                                <td> <input type="text" name="premium_single[]" value="<?php echo $res->premium_single ?>"></td>
                                <td><input type="text" name="premium_twin[]" value="<?php echo $res->premium_twin ?>"></td>
                                <td><input type="text" name="premium_triple[]" value="<?php echo $res->premium_triple ?>"></td>
                                <td><input type="text" name="premium_quad[]" value="<?php echo $res->premium_quad ?>"></td>
                                <td><input type="text" name="premium_infant[]" value="<?php echo $res->premium_infant ?>"></td>
                                <td><input type="text" name="premium_cwb[]" value="<?php echo $res->premium_cwb ?>"></td>
                                <td><input type="text" name="premium_cwithoutbed[]" value="<?php echo $res->premium_cwithoutbed ?>"></td>
                            </tr>


                        </table> 
                        <input type="hidden" value="<?php echo $res->holiday_id ?>" name="holiday_id" />
                        <input type="hidden" value="<?php echo $res->id ?>" name="id[]" />
                        <div style="height:20px;">

</div>
                    <?php $i++; } ?>
                    <button class="" id="" value="Add New Currecny" style="position:relative;top:80px;">Save The Rates</button> 
                </form>

<?php } ?>


            </div></div><br>


    </div><!-- contentpanel -->
    <!-- end of content -->

</div>

<?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>

<script src="js/custom.js"></script>

<script>
	
    $('.add_new_first').click(function(){
        //alert('hi');
	
        $('#displaytable').append('<table width="100%" border="1" class="currency_first" id="currency_first" style="position:relative;top:50px;">\
       <tr><td> \
                 <input type="text" name="currency[]">\
                </td></tr>\
                <tr><td>Holiday Package</td>\
                <td width=30px>Single</td>\
                <td>Twin Sharing</td>\
                <td>Triple Sharing</td>\
                <td>Quad Sharing</td>\
                <td>Infant</td>\
                <td>Child With Bed</td>\
                <td>Child Without Bed</td>\
        </tr>\
                <tr>\
                <td>\
                <div>\
                <span>STANDARD</span>\
                </div></td>\
         <td> <input type="text" name="premium_single[]"  value="0"></td>\
                 <td><input type="text" name="premium_twin[]" value="0"></td>\
                 <td><input type="text" name="premium_triple[]" value="0"></td>\
                 <td><input type="text" name="premium_quad[]" value="0"></td>\
                 <td><input type="text" name="premium_infant[]" value="0"></td>\
                 <td><input type="text" name="premium_cwb[]" value="0"></td>\
        <td><input type="text" name="premium_cwithoutbed[]" value="0"></td>\
        </tr>\
        <tr>\
                <td><span>DELUXE</span><input type="hidden" value="2" name="package_type"/></td>\
         <td><input type="text" name="deluxe_single[]" value="0"></td>\
                 <td><input type="text" name="deluxe_twin[]" value="0"></td>\
                 <td><input type="text" name="deluxe_triple[]" value="0"></td>\
                 <td><input type="text" name="deluxe_quad[]" value="0"></td>\
                 <td><input type="text" name="deluxe_infant[]" value="0"></td>\
                 <td><input type="text" name="deluxe_cwb[]" value="0"></td>\
        <td><input type="text" name="deluxe_cwithoutbed[]" value="0"></td>\
        </tr>\
        <tr>\
                <td><span>PREMIUM</span><input type="hidden" value="3" name="package_type"/></td>\
        <td><input type="text" name="standard_single[]" value="0"></td>\
                <td><input type="text" name="standard_twin[]" value="0"></td>\
                <td><input type="text" name="standard_triple[]" value="0"></td>\
                <td><input type="text" name="standard_quad[]" value="0"></td>\
                <td><input type="text" name="standard_infant[]" value="0"></td>\
                <td><input type="text" name="standard_cwb[]" value="0"></td>\
        <td><input type="text" name="standard_cwithoutbed[]" value="0"></td>\
        </tr>\
</table>');
	
                $('.remove_all').click(function(){
                    $('#displaytable').html('');
                });
                //var cloneCount = 1;
                //var Clonedtable = jQuery("#currency_first").clone(true);
                //  Clonedtable.appendTo('table#currency_second');
            });
</script>

<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
