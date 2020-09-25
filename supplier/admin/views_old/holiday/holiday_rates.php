<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
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
       /* table tr td{
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
.tdhead
{
    padding-left: 10px;
}
    </style>
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <?php if(!empty($result)){ ?>
                <h3>Edit Holiday Rates</h3>
                <?php } else { ?>
                 <h3>Add Holiday Rates</h3>
                <?php } ?>
              </div>
            </div>

            <div class="clearfix"></div>
       <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php if(!empty($result)){ ?>
                 <h2>Edit rates for <b>" <?php echo $hol_info->package_title; ?> "</b></h2>
                 <?php } else { ?>
                    <h2>Add rates for <b>" <?php echo $hol_info->package_title; ?> "</b></h2>
                     <?php } ?>                    
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
        <?php if (isset($error)) { ?>
        <div class="alert alert-error">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong>Error....!</strong>
            <?php echo $error; ?>
        </div>
        <?php } ?>
    <?php  if($this->session->flashdata('insert_curr_values')!=''){ ?>
    <div class="alert alert-error">
        <button class="close" data-dismiss="alert" type="button">×</button>

        <?php echo $msg = $this->session->flashdata('insert_curr_values'); ?>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-2"><b>Holiday Duartion : </b></div><div class="col-md-8"><?php echo $hol_info->start_date; ?> to <?php echo $hol_info->end_date; ?></div>
        <br/><?php if(!empty($result)){ ?>
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/edit_pax_package_type" enctype="multipart/form-data" method="post">
                 <table width="100%" border="1" class="currency_first" id="currency_first" style="position:relative;top:50px;background: white;font-family: 'Montserrat', sans-serif;">
                                <tr><td class="tdhead">Price Category</td>
                                <td>Single</td>
                                <td>Twin Sharing</td>
                                <td>Triple Sharing</td>
                                <td>Infant</td>
                                <td>Child With Bed</td>
                                <td>Child Without Bed</td>
                                </tr>
                            <tr>
                                <td class="tdhead"><span>Comfort</span></td>
                                <td> <input type="text" name="comfort_single" value="<?php echo $result[0]->comfort_single; ?>"></td>
                                <td><input type="text" name="comfort_twin" value="<?php echo $result[0]->comfort_twin; ?>"></td>
                                <td><input type="text" name="comfort_triple" value="<?php echo $result[0]->comfort_triple; ?>"></td>
                               <td><input type="text" name="comfort_infant" value="<?php echo $result[0]->comfort_infant; ?>"></td>
                                <td><input type="text" name="comfort_cwb" value="<?php echo $result[0]->comfort_cwb; ?>"></td>
                                <td><input type="text" name="comfort_cwithoutbed" value="<?php echo $result[0]->comfort_cwithoutbed; ?>"></td>
                            </tr>
                            <tr>
                                <td class="tdhead"><span>Quality</span></td>
                                <td> <input type="text" name="quality_single" value="<?php echo $result[0]->quality_single; ?>"></td>
                                <td><input type="text" name="quality_twin" value="<?php echo $result[0]->quality_twin; ?>"></td>
                                <td><input type="text" name="quality_triple" value="<?php echo $result[0]->quality_triple; ?>"></td>
                               <td><input type="text" name="quality_infant" value="<?php echo $result[0]->quality_infant; ?>"></td>
                                <td><input type="text" name="quality_cwb" value="<?php echo $result[0]->quality_cwb; ?>"></td>
                                <td><input type="text" name="quality_cwithoutbed" value="<?php echo $result[0]->quality_cwithoutbed; ?>"></td>
                            </tr>
                            <tr>
                                <td class="tdhead"><span>Luxury</span></td>
                                <td> <input type="text" name="luxury_single" value="<?php echo $result[0]->luxury_single; ?>"></td>
                                <td><input type="text" name="luxury_twin" value="<?php echo $result[0]->luxury_twin; ?>"></td>
                                <td><input type="text" name="luxury_triple" value="<?php echo $result[0]->luxury_triple; ?>"></td>
                                <td><input type="text" name="luxury_infant" value="<?php echo $result[0]->luxury_infant; ?>"></td>
                                <td><input type="text" name="luxury_cwb" value="<?php echo $result[0]->luxury_cwb; ?>"></td>
                                <td><input type="text" name="luxury_cwithoutbed" value="<?php echo $result[0]->luxury_cwithoutbed; ?>"></td>
                            </tr>
                        </table>
                        <input type="hidden" value="<?php echo $result[0]->holiday_id ?>" name="holiday_id" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary"  value="Add New Currecny" style="position:relative;top:20px;">Save The Rates</button> 
                        <a href="<?php echo site_url(); ?>/holiday/packagelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning" style="position:relative;top:20px;">Cancel</a>
                        </div>
                        </div>
                    </form>
                <?php } else { ?>
                <form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_pax_package_type" enctype="multipart/form-data" method="post">
                        <table width="100%" border="1" class="currency_first" id="currency_first" style="position:relative;top:50px;background: white;font-family: 'Montserrat', sans-serif;">
                                <tr><td class="tdhead">Price Category</td>
                                <td>Single</td>
                                <td>Twin Sharing</td>
                                <td>Triple Sharing</td>
                                <td>Infant</td>
                                <td>Child With Bed</td>
                                <td>Child Without Bed</td>
                                </tr>
                              <tr>
                                <td class="tdhead"><span>Comfort</span></td>
                                <td> <input type="text" name="comfort_single"></td>
                                <td><input type="text" name="comfort_twin"></td>
                                <td><input type="text" name="comfort_triple"></td>
                                <td><input type="text" name="comfort_infant"></td>
                                <td><input type="text" name="comfort_cwb"></td>
                                <td><input type="text" name="comfort_cwithoutbed"></td>
                                </tr>
                                <tr>
                                <td class="tdhead"><span>Quality</span></td>
                                <td> <input type="text" name="quality_single"></td>
                                <td><input type="text" name="quality_twin"></td>
                                <td><input type="text" name="quality_triple"></td>
                                <td><input type="text" name="quality_infant"></td>
                                <td><input type="text" name="quality_cwb"></td>
                                <td><input type="text" name="quality_cwithoutbed"></td>
                                </tr>
                                <tr>
                                <td class="tdhead"><span>Luxury</span></td>
                                <td><input type="text" name="luxury_single"></td>
                                <td><input type="text" name="luxury_twin"></td>
                                <td><input type="text" name="luxury_triple"></td>
                                <td><input type="text" name="luxury_infant"></td>
                                <td><input type="text" name="luxury_cwb"></td>
                                <td><input type="text" name="luxury_cwithoutbed"></td>
                                </tr>
                            </table>
                            <input type="hidden" value="<?php echo $holiday_id ?>" name="holiday_id"/>
                       <div class="ln_solid"></div>
                       <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" id="" value="Add New Currecny" style="position:relative;top:20px;">Add</button>
                            <a href="<?php echo site_url(); ?>/holiday/packagelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning" style="position:relative;top:20px;">Cancel</a> 
                            </div>
                            </div>
                        </form>
                    <?php } ?>
                    </div>
                </div>
             </div><!-- contentpanel -->
                <!-- end of content -->

            </div>
</div>
</div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>
