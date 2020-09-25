<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Villa_crs extends MX_Controller {
  const RefPrefix = 'VMN';
  private $base_currency;
  private $api_flag;
  private $mode;
  private $api;
  private $nationality;
  private $city_name;
  private $city_code;
  private $cin;
  private $cout;
  private $bedrooms;
  private $bathrooms;
  private $guests;
  private $sess_id;
  private $duration;

  private $crsvillacode;

  public function __construct() {
    parent::__construct();
    $this->load->model('villa_crs/Villacrs_Model');
    $this->api = 'villa_crs';
    $this->load->database();
    $this->db->reconnect();
    $this->set_credentials();
  }

  public function set_credentials() {
    $authDetails = $this->Villacrs_Model->getApiAuthDetails($this->api);
    if ($authDetails != '') {
      $this->api_flag = true;
    } else {
      $this->api_flag = false;
    }
  }

  public function set_variables($ses_id,$refNo) {
    $this->sess_id = $ses_id;
    $villa_search_data = $this->Villacrs_Model->check_search_data($ses_id,$refNo);
    $search_data = json_decode($villa_search_data->search_data,true);
    // echo '<pre/>';print_r($search_data);exit;
    $this->city_code = $search_data['city_id'];
    $cityNamearr = explode(',', $search_data['cityName']); 
    $this->city_name = $cityNamearr[0];     
    $this->cin = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['fromDate'])));
    $this->cout = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['toDate'])));
    $this->bedrooms = $search_data['bedrooms'];
    $this->bathrooms = $search_data['bathrooms'];
    $this->uniqueRefNo = $search_data['uniqueRefNo'];
    $this->guests = $search_data['guests'];
    $this->duration = $search_data['duration'];
    $this->base_currency = 'USD';
    $this->nationality = '';
  }

  public function villa_availabilty_search($ses_id,$refNo) {
    // echo 1;exit;
    $this->set_variables($ses_id,$refNo);
    if ($this->session->userdata('villa_search_activate') == 1) {
      echo json_encode(array('results' => 'success'));
    } else {
      // echo 2;exit;
      $this->Villacrs_Model->delete_temp_results($this->sess_id, $this->api);
      if ($this->api_flag) {
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
        $validation = true;
        $error_message = '';
        if (strtotime("now") > strtotime($checkOut)) {
          $validation = false;
          $error_message = "Invalid Checkout Time";
          // break;
        }
        if ($this->guests == 0) {
          $validation = false;
          $error_message = "Invalid Guest Information;";
          // break;
        }
        // echo $validation;exit;
        if ($validation) {
          $this->extractSearch($checkIn,$checkOut,$refNo,$villaCode='');
          // echo $this->db->last_query();
          // echo '<pre>';print_r($searchhotelcodeslist);exit;
        }
      }
      echo json_encode(array('results' => 'success'));
    }
  }

  function extractSearch($checkIn,$checkOut,$refNo,$villaCode) {
    $ROE = 1;
    $this->crshotelcode=$villaCode;
    if(!empty($this->crshotelcode)){
      $villaCodes = $this->crshotelcode;
    } else{
      $villaCodes = $this->Villacrs_Model->getvillacodes($this->city_code,0,500);
    }
    // echo "<pre>"; print_r($villaCodes);exit;
    if(!empty($villaCodes)) {
      $to_date=strtotime($checkOut);
      $from_date=strtotime($checkIn); 
      $rate = array();    
      $results = array();
      $res_details = array();
      for ($i = 0; $i < 1; $i++) {
        $res_details = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);
        if(!empty($res_details)) {
          $rate[$i]=$res_details;
        }
      }
      // echo $this->db->last_query();//exit;
      // echo "<pre>";print_r($res_details);exit;
      for ($i = 0; $i < 1; $i++) {
        $index = '';
        $indexarr=array();
        $roommealarr=array();
        if(isset($rate[$i])) {
          for($l=0;$l<count($rate[$i]);$l++) {
            $day=0;
            // $flag=true;
            $total_cost=0;
            $villa_allotment_id=array();        
            $rt_villa_code=$rate[$i][$l]->villa_code;
            $rt_supplier_id=$rate[$i][$l]->supplier_id;
            $index1='RATE'.'|'.$rt_villa_code.'|'.$rt_supplier_id.'|'.($i+1).$rate[$i][$l]->bedroom.'|'.$rate[$i][$l]->bathroom.'|'.$this->guests;
            if(!empty($indexarr[$i][$index1])) {
              continue;
            }
            for($j=0,$s=0;$j<count($rate[$i]) && !empty($rate[$i]);$j++) {
              if($rt_villa_code==$rate[$i][$j]->villa_code && $rt_supplier_id==$rate[$i][$j]->supplier_id) {
                $index='RATE'.'|'.$rt_villa_code.'|'.$rt_supplier_id.'|'.($i+1).$rate[$i][$j]->bedroom.'|'.$rate[$i][$j]->bathroom.'|'.$this->guests;  
                $day=$day+1;
                $s=$j;
                $total_cost += $rate[$i][$j]->villa_rate;
                $villa_allotment_id[] = $rate[$i][$j]->sup_villa_rates_id;
              }
            }

            if($day == $this->duration) {
              $currency_type = $rate[$i][$s]->currency_type;
              if ($currency_type != 'USD') {
                  $ROE = $this->change_currency($currency_type);
                  $total_cost = $ROE * $total_cost;
              }
              $indexarr[$i][$index] = $index;
              $room_count_arr[$i] = $i;
              $rate[$i][$s]->total_cost = $total_cost;
              $rate[$i][$s]->net_fare = $total_cost;
              $rate[$i][$s]->room_index = $i;
              $rate[$i][$s]->index = $index;
              $rate[$i][$s]->bedrooms = $rate[$i][$s]->bedroom;
              $rate[$i][$s]->bathrooms = $rate[$i][$s]->bathroom;
              $rate[$i][$s]->guests = $this->guests;
              $rate[$i][$s]->duration = $this->duration; 

              $rate[$i][$s]->type='Normal';
              $rate[$i][$s]->villa_allotment_id = implode(',', $villa_allotment_id);
              $supplier_rate_info=array(
                'supplier_id'=>$rate[$i][$s]->supplier_id,
                'sup_villa_id'=>$rate[$i][$s]->sup_villa_id,
                'villa_code'=>$rate[$i][$s]->villa_code,
                'villa_allotment_id'=>implode(',', $villa_allotment_id),
              );
              $cancellation_policy=$this->Villacrs_Model->check_crs_villa_normal_cancel_policy($supplier_rate_info,$checkIn);

              $cancel_policy='';
              $crs_cancellation_json=array();
              if(!empty($cancellation_policy[0])) {
                for($can=0,$incre=0;$can<count($cancellation_policy);$can++) {
                  $last_date = $cancellation_policy[$can]->days_before_checkin;                     
                  if($last_date!=0) {
                    $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                  } else {
                    $cancel_date = $checkIn; 
                  }
                  if($can==0 ||($can>=1 && $cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin)) {
                    if($cancellation_policy[$can]->cancel_rates_type=='non_refundable') {
                      $cancel_policy ='<p>Non Refundable</p>';
                      $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
                    }

                    if($cancellation_policy[$can]->cancel_rates_type=='fixed') {
                      if ($currency_type != 'USD') {
                          $ROE = $this->change_currency($currency_type);
                          $per_rate_charge = $ROE * $per_rate_charge;
                      }
                      // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$rate[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                      $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.' '.$rate[$i][$s]->currency_type.' will charged if not cancelled before '.$cancel_date.'</p>';

                      $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                    }
                    if($cancellation_policy[$can]->cancel_rates_type=='percentage') {
                      // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                      $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.'% will charged if not cancelled before '.$cancel_date.'</p>';
                      $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                    }
                  }                   
                }
              }
              $rate[$i][$s]->cancel_policy = $cancel_policy;
              $rate[$i][$s]->crs_cancellation_json=json_encode($crs_cancellation_json);  
              $results[$index]=$rate[$i][$s]; 
            }
          }
        }
      }

      // echo "<pre>"; print_r($results);exit;
      $insertrooms=array();
      $ro=0;
      foreach ($results as $result) {
        $checkvilla = $this->Villacrs_Model->check_villa_search($this->api,$this->sess_id,$result->villa_code);

        if(empty($checkvilla)) {
          $supplier_rate_info = array(
            'supplier_id'=>$result->supplier_id,
            'sup_villa_id'=>$result->sup_villa_id,   
            'villa_code'=>$result->villa_code,
            'villa_allotment_id'=>$result->villa_allotment_id,
          );
          $currencyv1 = $result->currency_type;
          if ($currencyv1 != 'USD') {
              $ROE = $this->change_currency($currencyv1);
              $convertedprice1 = $ROE * $total_cost;
          } else{
            $convertedprice1 = $result->total_cost;
          }
          // $this->load->module('hotels/hotel_markup');
          // $markup_array = $this->hotel_markup->markup_calculation($convertedprice1, $this->nationality, $this->api,$this->city_code,$result->villa_code);
          $sup_tax_amt =  0;
          /*$sup_tax = $this->db->select('supplier_tax_percent')->from('villa_list')->where('villa_code', $result->villa_code)->get()->row();
          $total_cost = $result->total_cost;
          if(!empty($sup_tax)){
            $sup_tax_amt = (($sup_tax->supplier_tax_percent*$total_cost)/100);
          }*/
          $insertvilla[$ro] =array(
            'session_id' => $this->sess_id,
            'uniqueRefNo' => $refNo,
            'supplier_id'=>$result->supplier_id,
            'api' => $this->api,
            'city_code' => $this->city_code,
            'city_name' => $this->city_name,
            'villa_code' => $result->villa_code,
            // 'unique_cityid' => $this->city_code,
            'villa_name' => $result->property_name,
            'villa_allotment_id'=>$result->villa_allotment_id,
            'supplier_rate_info'=>json_encode($supplier_rate_info),
            'guests' => $this->guests,
            'bedrooms' => $result->bedrooms,
            'bathrooms' => $result->bathrooms,
            'description' => $result->short_desc,
            'price_type' => $result->price_type,
            'avail_type' => $result->availability_type,
            'duration'=>$result->duration,
            'image' => $result->thumb_img,
            'villa_address' => $result->address,
            'amenities' => $result->facilities,
            'cancel_policy'=>$result->cancel_policy,
            'star' => $result->star_rating,
            'xml_currency' => $result->currency_type,
            'currency' => 'USD',
            'ROE' => $ROE,
            // 'org_amt' => $result->total_cost + $sup_tax_amt,
            // 'currency_conv_value' => $result->total_cost + $sup_tax_amt,
            // 'total_cost' =>$result->total_cost + $sup_tax_amt,
            'net_fare'=>$result->net_fare,
            'org_amt' => $result->total_cost,
            'currency_conv_value' => $convertedprice1,
            'total_cost' => $convertedprice1 + $sup_tax_amt,
            // 'payment_charge' => $markup_array['payment_charge'],
            // 'total_cost' => $markup_array['total_cost'] + $sup_tax_amt,
            // 'admin_markup' => $markup_array['admin_markup'],
            // 'admin_agent_markup' => $markup_array['admin_agent_markup'],
            // 'agent_markup' => $markup_array['agent_markup'],
            'villa_crs_cancellation_json'=>$result->crs_cancellation_json,
            // 'blocked_dates'=>$result->from_date,
          );
          $ro++;
        }
      }
      // echo '<pre>';print_r($insertvilla);exit;
      if (!empty($insertvilla))  {
        $this->Villacrs_Model->insert_crs_data($insertvilla);
        // echo $this->db->last_query();exit;
      }
    }
    // echo 22;exit;
  }

  function extractSearchold($checkIn,$checkOut,$refNo,$villaCode) {
    $ROE = 1;
    $to_date=strtotime($checkOut);
    $from_date=strtotime($checkIn); 
    $days=floor(($to_date - $from_date) / (60 * 60 * 24));
    $rate=array();    
    $results=array();

    $res_details = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);

    // echo $this->db->last_query();//exit;
    // echo '<pre>';print_r($res_details);exit;
    
    $total_cost=0;$net_fare=0;$r=0;
    $sup_villa_rates_id = array();
    foreach($res_details as $rate) {
      $villa_rate = $rate->villa_rate;
      $currency_type = $rate->currency_type;
      if ($currency_type != 'USD') {
          $ROE = $this->change_currency($currency_type);
          $villa_rate = $ROE * $rate->villa_rate;
      }
      $total_cost += $villa_rate;
      $net_fare += $total_cost;
      $sup_villa_rates_id[] = $rate->sup_villa_rates_id;
      $supplier_rate_info = array(
        'supplier_id'=>$rate->supplier_id,
        'sup_villa_id'=>$rate->sup_villa_id,
        'villa_code'=>$rate->villa_code,
      );
      $cancellation_policy = $this->Villacrs_Model->check_crs_villa_normal_cancel_policy($supplier_rate_info,$checkIn);
      // echo '<pre>';print_r($cancellation_policy);exit;
      $cancel_policy='';
      $hotel_crs_cancellation_json = array();
      if(!empty($cancellation_policy[0])) {
        for($can=0;$can<count($cancellation_policy);$can++) {
          $last_date = $cancellation_policy[$can]->days_before_checkin;                     
          if($last_date!=0) {
            $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
          } else {
            $cancel_date = $checkIn; 
          }
          if($can==0 ||($can>=1 && $cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin)) {
            if($cancellation_policy[$can]->cancel_rates_type=='non_refundable') {
              $cancel_policy ='<p>Non Refundable</p>';
              $hotel_crs_cancellation_json[$r][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
            }

            if($cancellation_policy[$can]->cancel_rates_type=='fixed') {
              if ($currency_type != 'USD') {
                $ROE = $this->change_currency($currency_type);
                $per_rate_charge = $ROE * $per_rate_charge;
              }
              // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$rate[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
              $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.' '.$rate[$i][$s]->currency_type.' will charged if not cancelled before '.$cancel_date.'</p>';
              $hotel_crs_cancellation_json[$r][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
            }
            if($cancellation_policy[$can]->cancel_rates_type=='percentage') {
              // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
              $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.'% will charged if not cancelled before '.$cancel_date.'</p>';
              $hotel_crs_cancellation_json[$r][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
            }
          }
          // echo '<pre>';print_r($hotel_crs_cancellation_json);exit;
        }
      }

      $rate->cancel_policy=$cancel_policy;
      $rate->hotel_crs_cancellation_json = json_encode($hotel_crs_cancellation_json);  
      $results[$r] = $rate; 
      $r++;
    }

    // echo "<pre>"; print_r($results);exit;
    $supplier_rate_info['sup_villa_rates_id'] = implode(',', $sup_villa_rates_id);

    $insertvilla=array();
    $ro=0;
    foreach ($results as $result) {
      $checkvilla = $this->Villacrs_Model->check_villa_search($this->api,$this->sess_id,$result->villa_code);

      if(empty($checkvilla)) {
        $currencyv1 = $result->currency_type;
        if ($currencyv1 != 'USD') {
            $ROE = $this->change_currency($currencyv1);
            $convertedprice1 = $ROE * $total_cost;
        } else{
          $convertedprice1 = $total_cost;
        }

        // $this->load->module('hotels/hotel_markup');
        // $markup_array = $this->hotel_markup->markup_calculation($convertedprice1, $this->nationality, $this->api,$this->city_code,$result->villa_code);
        $sup_tax_amt =  0;
        $insertvilla[$ro] =array(
          'session_id' => $this->sess_id,
          'uniqueRefNo' => $refNo,
          'supplier_id'=>$result->supplier_id,
          'api' => $this->api,
          'city_code' => $this->city_code,
          'city_name' => $this->city_name,
          'villa_code' => $result->villa_code,
          // 'unique_cityid' => $this->city_code,
          'supplier_rate_info' => json_encode($supplier_rate_info),
          'villa_allotment_id' => implode(',', $sup_villa_rates_id),
          // 'room_details_info'=>json_encode($room_details_info),
          'villa_name' => $result->property_name,
          'description' => $result->short_desc,
          'guests' => $this->guests,
          'bedrooms' => $result->bedrooms,
          'bathrooms' => $result->bathrooms,
          'price_type' => $result->price_type,
          'avail_type' => $result->availability_type,
          'duration'=>$this->duration,
          'image' => $result->thumb_img,
          'villa_address' => $result->address,
          'amenities' => $result->facilities,
          'cancel_policy'=>$result->cancel_policy,
          'star' => $result->star_rating,
          'xml_currency' => $result->currency_type,
          'currency' => 'USD',
          'ROE' => $ROE,
          // 'org_amt' => $result->total_cost + $sup_tax_amt,
          // 'currency_conv_value' => $result->total_cost + $sup_tax_amt,
          // 'total_cost' =>$result->total_cost + $sup_tax_amt,
          'net_fare'=>$net_fare,
          'org_amt' => $total_cost,
          'currency_conv_value' => $convertedprice1,
          'total_cost' => $convertedprice1 + $sup_tax_amt,
          // 'payment_charge' => $markup_array['payment_charge'],
          // 'total_cost' => $markup_array['total_cost'] + $sup_tax_amt,
          // 'admin_markup' => $markup_array['admin_markup'],
          // 'admin_agent_markup' => $markup_array['admin_agent_markup'],
          // 'agent_markup' => $markup_array['agent_markup'],
          'villa_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
        );
        // print_r($insertvilla);exit;
        $ro++;
      }
    }
    // echo '<pre>';print_r($insertvilla);exit;
    if (!empty($insertvilla))  {
      $this->Villacrs_Model->insert_crs_data($insertvilla);
    }

  }
  public function check_block_list($ses_id,$refNo,$villaCode){
    $villa_search_data = $this->Villacrs_Model->check_search_data($ses_id,$refNo);
    $search_data = json_decode($villa_search_data->search_data,true);
    $fromDate = date('Y-m-d',strtotime(str_replace('/','-',$search_data['fromDate'])));
    $toDate = date('Y-m-d',strtotime(str_replace('/','-',$search_data['toDate'])));

    $block_list = $this->Villacrs_Model->check_block_list($fromDate,$toDate,$villaCode);
    // echo $this->db->last_query();
    // echo '<pre>';print_r($block_list);exit;
    $block_dates = array();
    if(!empty($block_list)){
     $error = 'Villa is blocked on this date. Please search with different date';
        redirect('villa/error_page/' . base64_encode($error));
        exit;
    }
   
  }

  public function villa_details($villaCode,$searchId,$ses_id,$refNo) { 
    $this->set_variables($ses_id,$refNo);
    $data['searchId'] = $searchId;
    $data['villaDetails'] = $villaDetails = $this->Villacrs_Model->getVillaDetails($villaCode, $searchId);
    $data['galleryimg'] = $this->Villacrs_Model->get_gallery($villaCode,15);
    // echo $this->db->last_query();
    $data['ses_id'] = $ses_id;
    $data['refNo'] = $refNo;
    $data['total_cost'] = $villaDetails->total_cost;

    $checkIn = Date('Y-m-d');
    $checkOut = date('Y-m-d', strtotime('+180 days', strtotime($checkIn)));
    // $villas_available = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);
    $villas_unavailable = $this->Villacrs_Model->get_villa_blocks($checkIn,$checkOut,$villaCode);

    // echo '<pre>';print_r($villas_unavailable);exit;

    $checkblocking = $this->check_block_list($ses_id,$refNo,$villaCode);

    $villas_unavail = array();
    // if(!empty($villas_unavailable)){
    //   foreach($villas_unavailable as $key=>$avail) {
    //     $villas_unavail[] = Date('d/m/Y', strtotime($avail->villa_avail_date));
    //   }
    // }
    // $data['calendar_block'] = implode(', ', $villas_unavail);
    // $data['calendar_block'] = $villas_unavail;
    // echo '<pre>';print_r($data['calendar_block']);exit;

    $block_list = $this->Villacrs_Model->get_block_list($villaCode);

    $block_dates = array();
    if(!empty($block_list)){
      for($i=0;$i<count($block_list);$i++){
        $villas_unavail[$block_list[$i]->blocking_reason] = explode(',', $block_list[$i]->from_date);
      }
    }
    $result = $this->array_flatten($villas_unavail);
    // $data['calendar_block'] = $block_dates;

    $data['calendar_block'] = $result;
    // echo '<pre>';print_r($data['calendar_block']);exit;

    // $this->load->library('googlemaps');
    // $config['center'] = "$villaDetails->latitude, $villaDetails->longitude";
    // $config['zoom'] = '11';
    // $this->googlemaps->initialize($config);
    // $marker = array();
    // $marker['position'] = "$villaDetails->latitude, $villaDetails->longitude";
    // $marker['infowindow_content'] = "$villaDetails->hotel_name <br/> $villaDetails->city_name <br /> $villaDetails->address";
    // $this->googlemaps->add_marker($marker);
    // $data['map'] = $this->googlemaps->create_map();
    $this->load->view('villa_details', $data);
  }

public function array_flatten($array) { 
  if (!is_array($array)) { 
    return false; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, $this->array_flatten($value)); 
    } else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
}

  public function villa_itinerary($villaCode,$searchId,$session_id,$refNo,$departDate,$returnDate) {
    $this->set_variables($session_id,$refNo);
    if(!empty($searchId)) {
      // update rates
      $this->updateVillaPrice($searchId,$departDate,$returnDate,$session_id,$refNo,$villaCode);
      $BookDetails = $this->Villacrs_Model->preBookDetails($this->api,$session_id,$villaCode,$searchId);
      list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$allotment_arr)=$this->check_rates_and_availability($villaCode,$searchId,$session_id,$BookDetails);
    }
    if ($check_availiablity && $check_rates) {
      $data['villadetails'] = $villadetails = $this->Villacrs_Model->get_villa_details('villa_crs', $session_id, $villaCode, $searchId);
      $cancel_policy='';
      if(!empty($villadetails->cancel_policy)) {
          $cancel_policy = $villadetails->cancel_policy;
      }
      $data['cancel_policy'] = $cancel_policy;

      $data['ses_id'] = $session_id;
      $data['searchId'] = $searchId;
      $data['refNo'] = $refNo;
      $data['villa_code'] = $villaCode;
      // $data['total_cost'] = $duration*$villadetails->total_cost;
      // $data['total_duration'] = $duration;
      // echo '<pre/>';print_r($villadetails);exit;
      $data['country_list'] = $this->Villacrs_Model->getCountry();
      if (!empty($villadetails)) {
        $this->load->view('villa_itinerary', $data);
      } else {
        $error = 'Villa not available on selected dates. Please search again';
        redirect('villa/error_page/' . base64_encode($error));
        exit;
      }
    } else{
      $error = 'Villa not available on selected dates. Please search again';
      redirect('villa/error_page/' . base64_encode($error));
      exit;
    }
  }

  function updateVillaPrice($searchId,$departDate,$returnDate,$sessionId,$refNo,$villaCode,$price_type='') {
    $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$departDate))));
    $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$returnDate))));
    $dur = date_diff($date1,$date2,TRUE);
    $duration = $dur->format("%a");
    // if($price_type == '2'){
    //   $duration = ceil($duration/7);
    // }
    // $duration = $this->dateDiff($date1, $date2);
    $villa_search_data = $this->Villa_Model->check_search_data($sessionId,$refNo);
    // echo $this->db->last_query();
    // echo '<pre/>';print_r($villa_search_data);exit;
    $search_data = json_decode($villa_search_data->search_data,true);
    $sess_array_updt = array(
      'uniqueRefNo' => $search_data['uniqueRefNo'],      
      'cityName'=>$search_data['cityName'],
      'destination'=>$search_data['destination'],
      'fromDate'=>$departDate,
      'toDate'=>$returnDate,
      'duration'=>$duration,
      'city_id'=>$search_data['city_id'],
      'cityCode'=>$search_data['cityCode'],
      'bedrooms' =>$search_data['bedrooms'],
      'bathrooms'=>$search_data['bathrooms'],
      'guests'=>$search_data['guests']
    );
    // echo '<pre>';print_r($sess_array_updt);exit;
    $search_data_updt = json_encode($sess_array_updt,JSON_FORCE_OBJECT);
    $data_updt = array(
      'search_data'=>$search_data_updt,
    );
    $this->Villacrs_Model->update_villa_availability($sessionId,$refNo,$data_updt);
    $checkIn = date('Y-m-d',strtotime(str_replace('/','-',$departDate)));
    $checkOut = date('Y-m-d',strtotime(str_replace('/','-',$returnDate)));
    $res_details = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);
    // echo $this->db->last_query();
    // echo '<pre>';print_r($res_details);exit;
    if (!empty($res_details)) {
      $rate_arr = array();
      $total_cost = 0;$net_fare = 0;
      foreach($res_details as $rates){
        $rate_arr[] = $rates->sup_villa_rates_id;
        $supplier_rate_info = array(
          'supplier_id'=>$rates->supplier_id,
          'sup_villa_id'=>$rates->sup_villa_id,
          'villa_code'=>$rates->villa_code,
          'villa_allotment_id'=>$rates->sup_villa_rates_id,
        );
        $villa_rate = $rates->villa_rate;
        $currency_type = $rates->currency_type;
        if ($currency_type != 'USD') {
            $ROE = $this->change_currency($currency_type);
            $villa_rate = $ROE * $rates->villa_rate;
        }

        if($rates->price_type == '2'){
          $dur = $rates->duration - 7; 
          $total_cost = ($rates->price + $dur*($rates->price/7));
          $net_fare = ($rates->price + $dur*($rates->price/7));
          // $total_cost = ($rates->price*$duration/7);
          // $net_fare = ($villa_rate*$duration/7);
          // $org_amt = ($villa_rate*$duration/7);
        } else {
          $total_cost += $villa_rate;
          $net_fare += $villa_rate;
          // $org_amt += $villa_rate;
        }
      }
      $supplier_rate_info['villa_allotment_id'] = implode(',', $rate_arr);
      // echo '<pre>';print_r($supplier_rate_info);//exit;
      $data_updt = array(
        'villa_allotment_id' => implode(',', $rate_arr),
        'duration' => $duration,
        'supplier_rate_info' => json_encode($supplier_rate_info),
        'total_cost' => $total_cost,
        'net_fare' => $net_fare,
        // 'org_amt' => $org_amt,
      );
      // echo '<pre>';print_r($data_updt);exit;
      $this->Villacrs_Model->update_crs_villa_search($searchId,$sessionId,$villaCode,$data_updt); 
    } else{
      $error = 'Villa not available on selected dates. Please search again';
      redirect('villa/error_page/' . base64_encode($error));
      exit;
    }
  }

  function checkupdateVillaPrice($searchId,$departDate,$returnDate,$sessionId,$refNo,$villaCode,$price_type='') {
    $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$departDate))));
    $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$returnDate))));
    $dur = date_diff($date1,$date2,TRUE);
    $duration = $dur->format("%a");
    // if($price_type == '2'){
    //   $duration = ceil($duration/7);
    // }
    // $duration = $this->dateDiff($date1, $date2);
    $villa_search_data = $this->Villa_Model->check_search_data($sessionId,$refNo);
    // echo $this->db->last_query();
    // echo '<pre/>';print_r($villa_search_data);exit;
    $search_data = json_decode($villa_search_data->search_data,true);
    $sess_array_updt = array(
      'uniqueRefNo' => $search_data['uniqueRefNo'],      
      'cityName'=>$search_data['cityName'],
      'destination'=>$search_data['destination'],
      'fromDate'=>$departDate,
      'toDate'=>$returnDate,
      'duration'=>$duration,
      'city_id'=>$search_data['city_id'],
      'cityCode'=>$search_data['cityCode'],
      'bedrooms' =>$search_data['bedrooms'],
      'bathrooms'=>$search_data['bathrooms'],
      'guests'=>$search_data['guests']
    );
    // echo '<pre>';print_r($sess_array_updt);exit;
    $search_data_updt = json_encode($sess_array_updt,JSON_FORCE_OBJECT);
    $data_updt = array(
      'search_data'=>$search_data_updt,
    );
    $this->Villacrs_Model->update_villa_availability($sessionId,$refNo,$data_updt);
    $checkIn = date('Y-m-d',strtotime(str_replace('/','-',$departDate)));
    $checkOut = date('Y-m-d',strtotime(str_replace('/','-',$returnDate)));
    $res_details = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);
    // echo $this->db->last_query();
    // echo '<pre>';print_r($res_details);exit;
    if (!empty($res_details)) {
      $rate_arr = array();
      $total_cost = 0;$net_fare = 0;
      foreach($res_details as $rates){
        $rate_arr[] = $rates->sup_villa_rates_id;
        $supplier_rate_info = array(
          'supplier_id'=>$rates->supplier_id,
          'sup_villa_id'=>$rates->sup_villa_id,
          'villa_code'=>$rates->villa_code,
          'villa_allotment_id'=>$rates->sup_villa_rates_id,
        );
        $villa_rate = $rates->villa_rate;
        $currency_type = $rates->currency_type;
        if ($currency_type != 'USD') {
            $ROE = $this->change_currency($currency_type);
            $villa_rate = $ROE * $rates->villa_rate;
        }

        if($rates->price_type == '2'){
          $dur = $rates->duration - 7; 
          $total_cost = ($rates->price + $dur*($rates->price/7));
          $net_fare = ($rates->price + $dur*($rates->price/7));
          // $total_cost = ($rates->price*$duration/7);
          // $net_fare = ($villa_rate*$duration/7);
          // $org_amt = ($villa_rate*$duration/7);
        } else {
          $total_cost += $villa_rate;
          $net_fare += $villa_rate;
          // $org_amt += $villa_rate;
        }
      }
      $supplier_rate_info['villa_allotment_id'] = implode(',', $rate_arr);
      // echo '<pre>';print_r($supplier_rate_info);//exit;
      $data_updt = array(
        'villa_allotment_id' => implode(',', $rate_arr),
        'duration' => $duration,
        'supplier_rate_info' => json_encode($supplier_rate_info),
        'total_cost' => $total_cost,
        'net_fare' => $net_fare,
        // 'org_amt' => $org_amt,
      );
      // echo '<pre>';print_r($data_updt);exit;
      $this->Villacrs_Model->update_crs_villa_search($searchId,$sessionId,$villaCode,$data_updt);
      return true; 
    } else{
      return false; 
    }
  }

  public function payment_process($sessionId, $villaCode, $searchId, $refNo) {
      $this->set_variables($sessionId,$refNo);

      $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
      $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
      $BookDetails = $this->Villacrs_Model->preBookDetails($this->api,$sessionId,$villaCode,$searchId);

      // echo $this->db->last_query();
      // echo '<pre>';print_r($BookDetails);exit;
      list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$allotment_arr)=$this->check_rates_and_availability($villaCode,$searchId,$sessionId,$BookDetails);

      if ($check_availiablity && $check_rates) {
        // $BookDetails = $this->Villacrs_Model->preBookDetails($this->api, $sessionId, $villaCode, $searchId);
        $Sys_RefNo = $refNo;
        $pass_info = $this->session->userdata('passenger_info');
        $total_cost = $BookDetails->total_cost;

        // $total_cost = 100;
        $ip = $_SERVER['REMOTE_ADDR'];
        $search_details = array(
          'service_type'=>9,
          'searchId' => $searchId,
          'uniqueRefNo' => $Sys_RefNo,
          'desc'=>'Villa Booking',
          'cost' => $total_cost,
          // 'discount_amount'=>$discount_amount,
          // 'package_cost'=>$BookDetails->total_cost,
          'ip'=>$ip,
          // 'email'=>$pass_info['GuestEmailID'],
          // 'contact'=>$pass_info['GuestMobileNo'],
          // 'name'=>$pass_info['GuestFirstName'].' '.$pass_info['GuestLastName'],
          'villaname' => $BookDetails->villa_name,
          'villacity' => $BookDetails->city_name,
          'villaCode' => $villaCode,
          'sessionId' => $sessionId,
          'callBackId' => 'villa_crs'
        );
        $this->session->set_userdata('search_details', $search_details);
        //echo $Sys_RefNo;exit;
        // echo '<pre>rr';print_r($pass_info);//exit;
        // echo '<pre>rr';print_r($search_details);exit;
        // echo '<pre>';print_r($this->session->all_userdata());exit;
        redirect('payment/index');
        exit;
      } else {
        $error = 'Villa Not Available';
        redirect('villa/error_page/' . base64_encode($error));
        exit();
        return '';
      }
  }

  public function villa_reservation($sessionId,$villaCode,$searchId,$refNo) {
    $this->set_variables($sessionId,$refNo);
    $preBookDetails = $this->Villacrs_Model->preBookDetails($this->api,$sessionId,$villaCode,$searchId); 
    if (!empty($preBookDetails)) {
      list($booking_id,$BookDetails,$allotment_arr)= $this->crs_booking($sessionId,$villaCode,$searchId);
      // echo "<pre>11"; print_r($BookDetails);exit;
      if (!empty($booking_id)) {
        $Book_Status = 'Success';
      } else {
        $Book_Status = 'Fail';
      }
      $user_id=0;
      $agent_id=0;
      $Booking_Date = date('Y-m-d');
      $Sys_RefNo = $refNo;

      $total_cost = $BookDetails->total_cost;
      $admin_markup = $BookDetails->admin_markup;
      $admin_agent_markup = $BookDetails->admin_agent_markup;
      $payment_charge = $BookDetails->payment_charge;
      $cancel_policy = $BookDetails->cancel_policy;
      
      if ($this->session->userdata('user_logged_in')) {
        $user_id = $this->session->userdata('user_id');
        $user_no = $this->session->userdata('user_no');
        $Booking_Done_By = 'user';
        $agent_type = '0';
        $agent_id = 0;
        $deposit_withdraw_markup = '0';
      } else if ($this->session->userdata('agent_logged_in')) {
        $agent_id = $this->session->userdata('agent_id');
        $Booking_Done_By = 'agent';
        $agent_type = '2';
        $user_id = 0;
        $deposit_withdraw_markup = $admin_agent_markup;
        $user_no = '';
      } else {
        $agent_id = 0;
        $user_id = 0;
        $agent_type = 0;
        $Booking_Done_By = 'guest';
        $deposit_withdraw_markup = '0';
        $user_no = '';
      }
      if ($this->session->userdata('agent_logged_in')) {
        $pay_type = 'deposit';
        $deposit_check_status = $this->deposit_check($BookDetails);
        if ($deposit_check_status == 1) {
          $error = 'Your Balance is too low to make this booking';
          redirect('villa/error_page/' . base64_encode($error), 'refresh');
          exit;
        } elseif ($deposit_check_status == 0) {
          $this->deposit_withdraw($totsend, $deposit_withdraw_markup, $this->uniqueRefNo);
        }
      } else {
        $pay_type = 'payment_gateway';
      }

      $passenger_info = $this->session->userdata('passenger_info');

      $user_mobile = $passenger_info['GuestMobileNo'];
      $user_email = $passenger_info['GuestEmailID'];
      $user_pincode = $passenger_info['GuestPostalCode'];
      $user_city =  $passenger_info['GuestCity'];
      $user_state =  $passenger_info['GuestState'];
      $user_country =  $passenger_info['GuestCountryCode'];
      $user_address = $passenger_info['GuestAddress'];
      $user_name = $passenger_info['GuestFirstName'].' '.$passenger_info['GuestLastName'];

      $insertbookingdata = array(
        'user_id' => $user_id,
        'user_no' => $user_no,
        'agent_id' => $agent_id,
        'supplier_id'=>$BookDetails->supplier_id,
        'Api_Name'=>'villa_crs',
        'Booking_RefNo' => $booking_id,
        'uniqueRefNo' => $Sys_RefNo,
        'Booking_Status' => $Book_Status,
        'Booking_Date' => $Booking_Date,
        'Booking_Amount' => $total_cost,
        'total_cost' => $total_cost,
        'Admin_Markup' => $admin_markup,
        'Admin_Agent_Markup' => $admin_agent_markup,
        'Payment_Charge' => $payment_charge,
        'cancel_policy' =>$cancel_policy,
        'Currency' => $BookDetails->currency,
        'Xml_Currency' => $BookDetails->xml_currency,
        'Booking_Done_By' => $Booking_Done_By,
        'payment_type'=>$pay_type,
        'agent_type'=>$agent_type,
        // 'villa_allotment_id'=>$BookDetails->villa_allotment_id,
        'allotment_arr'=>serialize($allotment_arr),
        'user_mobile'=>$user_mobile,
        'user_email'=>$user_email,
        'user_name'=>$user_name,
        'user_pincode'=>$user_pincode,
        'user_city'=>$user_city,
        'user_state'=>$user_state,
        'user_country'=>$user_country,
        'user_address'=>$user_address
      );
      // echo "<pre>11"; print_r($insertbookingdata);exit;
      $this->db->insert('villa_booking_reports', $insertbookingdata);

      // Hotel Booking Hotels Information Data 'allotment_id'=>$BookDetails->villa_allotment_id
      // echo "<pre>"; print_r($BookDetails);exit;
      $dataVilla = array(
          'user_id' => $user_id,
          'agent_id' => $agent_id,
          'uniqueRefNo' => $Sys_RefNo,
          'villa_code' => $BookDetails->villa_code,
          'villa_name' => $BookDetails->villa_name,
          'city_code' => $this->city_code,
          'check_in' => $this->cin,
          'check_out' => $this->cout,
          'voucher_date' => $Booking_Date,
          'city' => $this->city_name,
          'bedrooms' => $BookDetails->bedrooms,
          'durations' => $this->duration,
          // 'api' => 'villa_crs',
          'star' => $BookDetails->star_rating,
          'image' => $BookDetails->image,
          'description' => $BookDetails->short_desc,
          'address' => $BookDetails->address,
          'phone' => $BookDetails->phone,
          'bathrooms' => $BookDetails->bathrooms,
          'guests' => $this->guests,
          'cancellation_policy' => $BookDetails->cancel_policy,
          'latitude' => $BookDetails->latitude,
          'longitude' => $BookDetails->longitude,
      );
      // echo "<pre>11"; print_r($dataVilla);//exit;
      $this->Villacrs_Model->insert_villa_booking_information_data($dataVilla);
      // echo $this->db->last_query();exit;

      redirect('villa/voucher1?voucherId=' . $Sys_RefNo . '&RefId=' . $booking_id, 'refresh');
    } else {
      $this->villa_itinerary($sessionId, $villaCode, $searchId);
    }
  }

  public function crs_booking($sessionId,$villaCode,$searchId) {
    
    $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
    $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
    $BookDetails = $this->Villacrs_Model->preBookDetails($this->api,$sessionId,$villaCode,$searchId);
    list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$allotment_arr)=$this->check_rates_and_availability($villaCode,$searchId,$sessionId,$BookDetails);
    
    if ($check_availiablity && $check_rates) {
      $pass_info = $this->session->userdata('passenger_info');
      $booking_id = $this->Villacrs_Model->get_last_booking_code();
      $booking_id += 1;
      // $this->db->trans_begin();
      // echo '<pre>';print_r($BookDetails);exit;
      $insert_villa = array(
        'booking_id' => $booking_id,
        'villa_code' => $BookDetails->villa_code,
        'villa_name' => $BookDetails->villa_name,
        'supplier_id' => $BookDetails->supplier_id,
        'uniqueRefNo' => $this->uniqueRefNo,
        'check_in' => $checkIn,
        'check_out' => $checkOut,
        'booking_date' => date('Y-m-d'),
        // 'city' => $BookDetails->city_name,
        'city' => $this->city_name,
        'bedrooms' => $BookDetails->bedrooms,
        'bathrooms' => $BookDetails->bathrooms,
        'guests' => $this->guests,                
        'net_amount' => $net_amount,
        'total_amount' => $total_cost,
        'discount' => $discount,
        'tax' => '0.0',
        // 'comment_desc'=>$pass_info['comment'],
      );

      $this->Villacrs_Model->insert_crs_booking($insert_villa); //supplier booking
      $this->Villacrs_Model->insert_crs_booking_pass($booking_id,$this->uniqueRefNo); //supplier booking
      $balance = $total_cost + $this->Villacrs_Model->get_supplier_balance($BookDetails->supplier_id);

      $insertData = array(
        // 'transaction_id' => $this->generateRandomString(10),
        'transaction_id' => $this->uniqueRefNo,
        'supplier_id' => $BookDetails->supplier_id,
        'supplier_no' => '',
        'booking_id' => $booking_id,
        'hotel_id' => '',
        'hotel_code' =>$BookDetails->villa_code,
        'property_type' =>'villa',
        'transaction_summary' => 'Pay Supplier',
        'booked_amount' => $total_cost,
        'paid_amount' => 0,
        'available_balance' => $balance,
        // 'city' => $roomDetails->city_name,
        'city' => $this->city_name,
        'booking_date' => date('Y-m-d'),
        'transaction_datetime' => date('Y-m-d H:i:s'),
        'user_id' => '0',
        'remarks' => 'Pay Supplier',
      );
      
      $this->Villacrs_Model->insert_supplier_act_summary($insertData);
      // echo $this->db->last_query();
      // echo '<pre>34';print_r($this->db->trans_status());exit;
      // if ($this->db->trans_status() === FALSE) {
      //   // echo '<pre>34';print_r($BookDetails);exit;
      //   $this->db->trans_rollback();
      //   return '';
      // } else {
      //   $this->db->trans_commit();
        //Reduce Availibilty
        /*$allotment_arr = explode(',', $BookDetails->villa_allotment_id);
        for($al=0;$al<count($allotment_arr);$al++){
          $this->Villacrs_Model->update_crs_villa_allotment($allotment_arr[$al]);
        }*/
        foreach ($allotment_arr as $key=>$val) {
          $this->Villacrs_Model->update_crs_villa_allotment($key,$val);
        }
        
        // echo '<pre>34';print_r($BookDetails);exit;
        return array($booking_id,$BookDetails,$allotment_arr);
        // return $booking_id;
      // }
    } else {
      $error = 'Villa Not Available';
      redirect('villa/error_page/' . base64_encode($error));
      exit();
      return '';
    }
  }

  public function check_rates_and_availability($villaCode,$searchId,$sessionId,$BookDetails) {
    // echo "<pre>gyjh"; print_r($BookDetails);
    $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
    $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
    $date1 = date_create($checkIn);
    $date2 = date_create($checkOut);
    $dur = date_diff($date1,$date2,TRUE);
    $duration = $dur->format("%a");
    $ROE = 1;
    // $res_details = $this->Villacrs_Model->get_crs_villa_rates($checkIn,$checkOut,$villaCode);
    // echo '<pre>';print_r($BookDetails);//exit;
    $allotment_arr=array();
    $allotment_id = explode(',',$BookDetails->villa_allotment_id);
    // echo '<pre>';print_r($allotment_id);//exit;
    foreach ($allotment_id as $val) {
      if(isset($allotment_arr[$val])) {
        $allotment_arr[$val]=($allotment_arr[$val]+1);
      } else {
        $allotment_arr[$val]=1;
      }
    }
    $total_cost=0;$net_fare=0;
    $check_availiablity = true;$check_rates = true;
    $tot_cost = 0;$dis_cost = 0;$net_cost = 0;$total_dur = 0;
    $total_cost_arr=array();
    $net_fare_arr=array();
    $discount_arr=array();
    $duration_arr=array();
    $allotment_id = $BookDetails->villa_allotment_id;
    // echo '<pre>';print_r($allotment_id);//exit;
    if(!empty($BookDetails)) {
      $supplier_rate_info = json_decode($BookDetails->supplier_rate_info,true);
      $dataarray=array(
        'sup_villa_id'=>$supplier_rate_info['sup_villa_id'], 
        'supplier_id'=>$supplier_rate_info['supplier_id'], 
        'villa_code'=>$supplier_rate_info['villa_code'], 
        'villa_allotment_id'=>$supplier_rate_info['villa_allotment_id'], 
      );
      
      $check_prices = $this->Villacrs_Model->check_crs_villa_price($dataarray,$checkIn,$checkOut);
      // echo '<pre>';print_r($BookDetails);//exit;
      $cp=0;
      if(!empty($check_prices)) {
        foreach($check_prices as $chp) {
          if($chp->villa_rate==0) {
            $check_rates = false;
          }
          
          if(isset($total_cost_arr[$BookDetails->search_id])) {
            $total_cost_arr[$BookDetails->search_id] += $chp->villa_rate;
            $cp = $cp+1;
          } else {
            $total_cost_arr[$BookDetails->search_id] = $chp->villa_rate;
            $cp = $cp+1;
          }
        }

        if($BookDetails->price_type == '2'){
          $dur = $BookDetails->duration - 7;
          $total_cost_arr[$BookDetails->search_id] = $BookDetails->price + $dur*($BookDetails->price/7);
          // echo '<pre>cppp'.$dur;print_r($total_cost_arr);exit;
        } else{
          $total_cost_arr[$BookDetails->search_id] = $total_cost_arr[$BookDetails->search_id];
        }

        $net_fare_arr[$BookDetails->search_id] = $total_cost_arr[$BookDetails->search_id];
        $discount_arr[$BookDetails->search_id] = 0;
        $duration_arr[$BookDetails->search_id] = $BookDetails->duration;
        // echo '<pre>';print_r($net_fare_arr);//exit;
      }
      // echo '<pre>cppp'.$dur;print_r($total_cost_arr);exit;
      // $this->duration;
      if($cp != $BookDetails->duration) { 
        $check_rates = false; 
      }
      foreach ($allotment_arr as $key=>$val) {
        $check_allotment = $this->Villacrs_Model->check_crs_villa_allotment($key);
        // echo '<pre>fgf';print_r($check_rates);exit;
        if(empty($check_allotment)) {
          $check_availiablity = false;
        }
        if($check_allotment->villas_available != 1) {
          $check_availiablity = false;
        }
      }
      if($check_availiablity && $check_rates) {
        foreach($total_cost_arr as $key=>$val) {
          $tot_cost += $val;
          $this->Villacrs_Model->update_crs_villa_search($key,$sessionId,$villaCode,array('total_cost'=>$val));   
        }
        if(!empty($net_fare_arr)) {
          foreach($net_fare_arr as $key=>$val) {
            $net_cost += $val;
            $this->Villacrs_Model->update_crs_villa_search($key,$sessionId,$villaCode,array('net_fare'=>$val));   
          }
        }
        if(!empty($discount_arr)) {
          foreach($discount_arr as $key=>$val) {  
            $dis_cost += $val;
            // $this->Villacrs_Model->update_crs_villa_search($key,$sessionId,$villaCode,array('discount'=>$val));   
          }
        }
        if(!empty($duration_arr)) {
          foreach($duration_arr as $key=>$val) {  
            $total_dur += $val;   
            // $this->Villacrs_Model->update_crs_villa_search($key,$sessionId,$villaCode,array('duration'=>$val));
          }
        }

        $cancellation_policy = $this->Villacrs_Model->check_crs_villa_normal_cancel_policy($supplier_rate_info,$checkIn);
        $cancel_policy='';$index = 1;
        $crs_cancellation_json=array();
        $currency_type = $BookDetails->xml_currency;
        if(!empty($cancellation_policy[0])) {
          for($can=0,$incre=0;$can<count($cancellation_policy);$can++) {
            $last_date = $cancellation_policy[$can]->days_before_checkin;                     
            if($last_date!=0) {
              $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
            } else {
              $cancel_date = $checkIn; 
            }
            if($can==0 ||($can>=1 && $cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin)) {
              if($cancellation_policy[$can]->cancel_rates_type=='non_refundable') {
                $cancel_policy ='<p>Non Refundable</p>';
                $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;                        
              }

              if($cancellation_policy[$can]->cancel_rates_type=='fixed') {
                if ($currency_type != 'USD') {
                    $ROE = $this->change_currency($currency_type);
                    $per_rate_charge = $ROE * $per_rate_charge;
                }
                // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$rate[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.' '.$rate[$i][$s]->currency_type.' will charged if not cancelled before '.$cancel_date.'</p>';
                $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
              }
              if($cancellation_policy[$can]->cancel_rates_type=='percentage') {
                // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.'% will charged if not cancelled before '.$cancel_date.'</p>';
                $crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
              }
            }                   
          }
          $candata = array('cancel_policy'=>$cancel_policy,'crs_cancellation_json'=>json_encode($crs_cancellation_json));
          $this->Villacrs_Model->update_crs_villa_search($searchId,$sessionId,$villaCode,$candata);
        }
      }
      // echo '<pre>';print_r($total_cost);//exit;
      // echo '<pre>';print_r($net_fare);exit;

      return array($check_availiablity,$check_rates,$net_cost,$tot_cost,$dis_cost,$allotment_arr);
      // exit;
      /*
        foreach($res_details as $rate) {
          $villa_rate = $rate->villa_rate;
          $currency_type = $rate->currency_type;
          if ($currency_type != 'USD') {
              $ROE = $this->change_currency($currency_type);
              $villa_rate = $ROE * $rate->villa_rate;
          }
          $total_cost += $villa_rate;
          $net_fare += $rate->villa_rate;

          $currencyv1 = $rate->currency_type;
          if ($currencyv1 != 'USD') {
              $ROE = $this->change_currency($currencyv1);
              $convertedprice1 = $ROE * $total_cost;
          } else{
            $convertedprice1 = $total_cost;
          }
          // $this->load->module('hotels/hotel_markup');
          // $markup_array = $this->hotel_markup->markup_calculation($convertedprice1, $this->nationality, $this->api,$this->city_code,$result->villa_code);
          $sup_tax_amt =  0;
          $updateVilla =array(
            'duration'=>$duration,
            // 'org_amt' => $result->total_cost + $sup_tax_amt,
            // 'currency_conv_value' => $result->total_cost + $sup_tax_amt,
            // 'total_cost' =>$result->total_cost + $sup_tax_amt,
            'net_fare'=>$net_fare,
            'org_amt' => $total_cost,
            'currency_conv_value' => $convertedprice1,
            'total_cost' => $convertedprice1 + $sup_tax_amt,
            // 'payment_charge' => $markup_array['payment_charge'],
            // 'total_cost' => $markup_array['total_cost'] + $sup_tax_amt,
            // 'admin_markup' => $markup_array['admin_markup'],
            // 'admin_agent_markup' => $markup_array['admin_agent_markup'],
            // 'agent_markup' => $markup_array['agent_markup'],
          );
          // echo '<pre>';print_r($updateVilla);exit;
          $this->Villacrs_Model->update_villa_price($villaCode,$searchId,$sessionId,$updateVilla);
        }
        $check_availiablity = true;$check_rates = true;
      */
    }
    // $tot_cost = $convertedprice1 + $sup_tax_amt;
    // $dis_cost = 0;
    // return array($check_availiablity,$check_rates,$net_fare,$tot_cost,$dis_cost,$allotment_id); 
  }

  public function deposit_check($BookDetails) {
      $deposit_check_status = 1;
      if ($this->session->userdata('agent_logged_in')) {
          $agent_no = $this->session->userdata('agent_no');
          $agent_type = $this->session->userdata('agent_type');
          $available_balance = $this->Villacrs_Model->get_agent_available_balance($agent_no, $agent_type);

          $total_cost = $BookDetails->total_cost;
          $agent_markup = $BookDetails->admin_agent_markup;
          $withdraw_amount = $total_cost - $agent_markup;
          if ($available_balance < $withdraw_amount) {
              $deposit_check_status = 1;
          } else {
              $deposit_check_status = 0;
          }
      }
      return $deposit_check_status;
  }

  function deposit_withdraw($total_price, $agent_markup, $Sys_RefNo) {

      $agent_id = $this->session->userdata('agent_id');
      $agent_no = $this->session->userdata('agent_no');
      $agent_type = $this->session->userdata('agent_type');

      $available_balance = $this->Villacrs_Model->get_agent_available_balance($agent_no, $agent_type);
      $available_balance = empty($available_balance) ? 0 : $available_balance;
      $withdraw_amount = $total_price - $agent_markup;
      if ($available_balance < $withdraw_amount) {
          $error = 'Your balance is too low for booking this hotel';
          redirect('hotels/error_page/' . base64_encode($error));
      } else {
          $closing_balance = $available_balance - $withdraw_amount;
          $this->Villacrs_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $Sys_RefNo, $agent_type);
      }
  }

  function durationCalc($date1,$date2,$price_type){
    $dur = date_diff($date1,$date2,TRUE);
    $dura = $dur->format("%a");
    if($price_type==1) {
      $duration = $dura;
    } else  {
      $duration2 = round($dura/7);
      $duration = $duration2;
      if($duration2 <= 0) {
        $duration = 1;
      }
    }
    return $duration;
  }

  public function dateDiff($start, $end) {
      $start_ts = strtotime($start);
      $end_ts = strtotime($end);
      $diff = $end_ts - $start_ts;
      return round($diff / 86400);
  }

  function generateRandomString($length = 10) {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return 'VMN' . $randomString;
  }




}