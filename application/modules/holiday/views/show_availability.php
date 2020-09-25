<?php
// echo '<pre>';print_r($_POST);
$departDate = $this->input->post('departDate');
$load = $this->input->post('load');
if($load == 'load'){
	$adults = 1;
	$childs = 0;
	$seniors = 0;	
} else {
	$adults = $this->input->post('adults');
	$childs = isset($_POST['childs']) ? $this->input->post('childs') : 0;
	$seniors = isset($_POST['seniors']) ? $this->input->post('seniors') : 0;
}

// $infants = $this->input->post('infants');
$holiday_param = $this->input->post('holiday_param');

if(empty($departDate)){
  $departDate = $this->input->post('fromDate');
}

$holi_id = explode('-', base64_decode($holiday_param));
$holiday_id = $holi_id[1];
// echo '<pre>';print_r($departDate);//exit;
$checkPackageValidity = $this->Holiday_Model->checkPackageValidity($holiday_id,$departDate);
// echo $this->db->last_query();
// echo '<pre>';print_r($checkPackageValidity);exit;
$availability = '';
if ($checkPackageValidity > 0) {
  
  $holiday_activity = $this->Holiday_Model->getActivities($holiday_id,$departDate);
  // echo '<pre>';print_r($holiday_activity);exit;
  if(!empty($holiday_activity)){
    $totalprice = 0;
    $tr_childs = '';
    $tr_seniors = '';
    $departDateF = date('d M', strtotime(str_replace('/', '-', $departDate)));

    $package_details = $this->Holiday_Model->get_holiday_package_by_id($holiday_id);
    $discount_type = $package_details->discount_type;
    $discount = $package_details->discount_price;
    // $session_data = $this->session->userdata('holiday_search_data');
    // $fromDate = $session_data['fromDate'];
    for($i=0;$i<count($holiday_activity);$i++) {
      $block_dates_arr = $this->db->select('*')->from('holiday_blocking_dates')->where('holiday_id', $holiday_id)->where('activity_id',$holiday_activity[$i]->id)->get()->row()->from_date;
      $unavailable = 'Book Now';$disablebtn = '';
      if($block_dates_arr != '') {
        $block_dates = explode(',', $block_dates_arr);
        for($b=0;$b<count($block_dates);$b++) {
          if($block_dates[$b] == $departDate) {
            $unavailable = 'Unavailable';
            $disablebtn = 'disabled';
          }
        }
      }
      
      // echo '<pre>';print_r($block_dates);exit;
      $price_adt = $holiday_activity[$i]->price_adt;
      $price_chd = $holiday_activity[$i]->price_chd;
      $price_sen = $holiday_activity[$i]->price_sen;
      $totalprice = ($adults*$price_adt) + ($childs*$price_chd) + ($seniors*$price_sen);

      $without_discount = '<span class="org-price">US$'.number_format($totalprice,2).'</span>';
      if($discount_type == 0){
        $discount_price = 0;
        $without_discount = '';
      }elseif($discount_type == 1){
        $discount_price = $discount;
      }elseif($discount_type == 2){
        $discount_price = ($discount*$totalprice)/100;
      }
      $total_cost = $totalprice-$discount_price;
      if($childs > 0){
        $tr_childs = '<tr><td>Child '.$childs.' x US$'.number_format($price_chd,2).'</td><td>US$'.number_format(($childs*$holiday_activity[$i]->price_chd),2).'</td></tr>';
      }
      if($seniors > 0){
        $tr_seniors = '<tr><td>Senior '.$seniors.' x US$'.number_format($price_sen,2).'</td><td>US$'.number_format(($seniors*$price_sen),2).'</td></tr>';
      }
      $duration = '';$cancel_policy = '';
      if(!empty($holiday_activity[$i]->duration)){
        $duration = '<b><i class="fa fa-clock-o"></i> Duration:</b> '.$holiday_activity[$i]->duration;
      }
      if(!empty($holiday_activity[$i]->cancel_policy)){
        $cancel_policy = '<b>Cancellation Policy:</b> '.$holiday_activity[$i]->cancel_policy;
      }

      echo '<div class="white-container">
          <div class="tableview">
            <div class="result-section col-sm-8">
              <h3>'.$holiday_activity[$i]->activity_title.'</h3>
              <p><b>Departs at:</b> '.$departDateF.', '.$holiday_activity[$i]->pickup_time.' <b>Operating Hours:</b> '.$holiday_activity[$i]->operating_hours.' <b>Activity Location:</b> '.$holiday_activity[$i]->pickup_location.'</p>
              <p>'.$holiday_activity[$i]->activity_desc.'</p>
              <p>'.$duration.' '.$cancel_policy.'</p>
            </div>
            <div class="price-section col-sm-4">
              <div class="text-right">
                '.$without_discount.'
                <span class="total-price">US$'.number_format($total_cost,2).'</span>
                <form action="'.site_url().'holiday/holiday_itinerary/'.$holiday_param.'" method="post">
                  <input type="hidden" name="adults_no" value="'.$adults.'">
                  <input type="hidden" name="childs_no" value="'.$childs.'">
                  <input type="hidden" name="seniors_no" value="'.$seniors.'">
                  <input type="hidden" name="departDate" value="'.$departDate.'">
                  <input type="hidden" name="total_cost" value="'.$total_cost.'">
                  <input type="hidden" name="activity_id" value="'.$holiday_activity[$i]->id.'">
                  <button type="submit" class="btn btn-primary" '.$disablebtn.'>'.$unavailable.'</button><br>
                </form>
                <div><a href="javascript:;" class="viewdetails"><span>View Details</span> <i class="fa fa-angle-down"></i></a></div>
              </div>
            </div>
          </div>
          <div class="viewdetails-section" style="display:none">
              <p>Price Breakdown</p>
              <table class="table">
                <tr>
                  <td>Adult '.$adults.' x US$'.number_format($price_adt,2).'</td>
                  <td>US$'.number_format(($adults*$price_adt),2).'</td>
                </tr>
                '.$tr_childs.'
                '.$tr_seniors.'
              </table>
           </div>
        </div>';
    }
  } else {
    echo '<div class="white-container">
            <div class="result-details">
              <h3>No package available</h3>
            </div>
          </div>';
  }
} else {
  echo '<div class="white-container">
          <div class="result-details">
            <h3>No package available</h3>
          </div>
        </div>';
}
?>
<style type="text/css">
  .btn-primary.disabled, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary[disabled], .btn-primary[disabled].active, .btn-primary[disabled]:active, .btn-primary[disabled]:focus, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary, fieldset[disabled] .btn-primary.active, fieldset[disabled] .btn-primary:active, fieldset[disabled] .btn-primary:focus, fieldset[disabled] .btn-primary:hover {
    background-color: #ff7802;
    border-color: #ff7802;
  }
</style>