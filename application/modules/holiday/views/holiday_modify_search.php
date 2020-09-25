<?php
$session_data = $this->session->userdata('holiday_search_data');
// echo '<pre>';print_r($session_data);exit;
$city_arr = explode(',',$session_data['cityName']);
$cityname = $city_arr[0];
$months = $session_data['months'];
$cityCode = $session_data['cityCode'];
$region_arr = explode(',',$session_data['region_arr']);
$region_id=$region_arr[0];
?>
<style type="text/css">
  .table>tbody>tr>td, .table>tfoot>tr>td{
    background-color: #fff;
}
</style>
<span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
<div class="row">
  <div class="col-md-12">
    <form role="form" action="<?php echo site_url(); ?>holiday/holidaysearch" method="post">
      <!--Search critiria for holiday-->
      <div class="form-group">
        <h3><?php echo lang('h_holiday_packages');?></h3>
      </div>
      <div class="row small-padding form-group">
        <div class="col-md-5">
          <label>Region</label>
          <select id="region_id" name="region_arr[]" class="form-control">
            <option value="">All Region</option>
            <?php for($i=0;$i<count($continent);$i++){ ?>
            <option value="<?php echo $continent[$i]->continent_id;?>" <?php if($region_id==$continent[$i]->continent_id){ echo 'selected'; }  ?>><?php echo $continent[$i]->continent_name;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-5">
          <label>Destination</label>
          <input id="hol_cityName" name="cityName" class="form-control" type="text" placeholder="Type Destination" value="<?php if($cityname==''){ echo 'Any City'; } else { echo $cityname; }?>">
          <input type="hidden" name="cityid"/>
        </div>
      </div>
      <div class="row small-padding form-group">
        <div class="col-md-5">
          <label>Travel Month</label>
          <input id="mon_dur" class="form-control date-picker" name="months" type="text" placeholder="Month of Travel" value="<?php if($months==''){ echo 'Any Time'; } else { echo $months; }?>" autocomplete="off" readonly="readonly" style="background:#fff;cursor: pointer;">
          
          <input type="hidden" class="form-control" name="holiduration" id="holiduration" value="<?php echo $holiday_search_data['holiday_duration']; ?>"  />
          <div class="dropdown-search" data-toggle="dropdown" id="holidistmonthtab" style="max-width:500px;max-height:250px;border-radius: 5px;background-color:#f00;" >
            <div class="tabs-left" id="distmonthtab" style="z-index: 999;">
              <?php
              $months = array(' ','January','February', 'March', 'April','May', 'June',  'July',  'August', 'September', 'October',  'November',  'December');
              $curr_month=date("F");
              $curr_year=date("Y");
              $year=$curr_year;
              $index = array_search($curr_month,$months);
              ?>
              <table id="datatable1" class="table" style="max-width:500px;width:250px;height: 225px; max-height:250px;overflow: hidden;border-radius: 5px;color:grey;">
                <tr class="monthsdurtr" style="height: 18px;">
                  <td colspan="4" class="monthsdur" data-monthidex="0" data-monthyear="" style="padding-bottom: 0px;"><p style="padding-top: 8px;font-weight: bold;font-size: 14px !important;">Any Time</p></td>
                </tr>
                <?php for($i=1;$i<=12;$i++) {
                  if($i==1) { ?>
                  <tr class="monthsdurtr">
                    <td class="monthsdur" data-monthidex="<?php echo $index;?>" data-monthyear="<?php echo "in " .$months[$index]; ?>"><?php echo substr($months[$index++],0,3)."<br/>".$year;  ?></td>
                    <?php } if($index>12) {
                      $index=1;
                      $year=$curr_year+1;
                    } if($i!=1) { ?>
                    <td class="monthsdur" data-monthidex="<?php echo $index;?>" data-monthyear="<?php echo "in " .$months[$index]; ?>"><?php echo substr($months[$index++],0,3)."<br/>".$year;  ?></td>
                    <?php } if($i%4==0&&$i!=12) { ?>
                  </tr>
                  <tr class="monthsdurtr">
                    <?php } if($i==12) { ?>
                  </tr>
                  <?php } } ?>
                </table>
                <!-- /tab-content -->
              </div>
            </div>
          </div>
        </div>
        <div class="searchBtncntr">
          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary"><?php echo lang('h_search_holiday');?> <i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>