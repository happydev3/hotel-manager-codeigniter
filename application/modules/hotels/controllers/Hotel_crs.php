<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Hotel_crs extends MX_Controller {
    /* * ***** START SET CREDENTIAL ********* */

    private $base_currency;
    private $client_id;
    private $username;
    private $password;
    private $post_url;
    private $api_flag;
    private $mode;
    private $api;
    //  private $version;
    private $nationality;
    private $market_name;
    private $crshotelcode;
    private $hotelname;

    private $city_name;
    private $city_code;
    private $cin;
    private $cout;
    private $rooms;
    private $nights;
    private $adults;
    private $childs;
    private $adults_count;
    private $childs_count;
    private $childs_ages;
    private $sess_id;
    private $adminMarkup;
    private $agentMarkup;
    private $paymentCharge; 
  

    /*     * ***** END SET VARIABLES ********* */

    function __construct() {
        parent::__construct();
        $this->load->model('hotel_crs/Hotelcrs_Model');

        $this->api = 'hotel_crs';
        // $this->sess_id = $this->session->userdata('session_id');
        $this->load->database();
        $this->db->reconnect();

        $this->set_credentials();
    }

    public function set_credentials() {
        $authDetails = $this->Hotelcrs_Model->getApiAuthDetails($this->api);
        // echo $this->db->last_query();
        // echo '<pre>';print_r($authDetails);exit;
        if ($authDetails != '') {
            $this->api_flag = true;
            $this->post_url = ($authDetails->mode == 0 ? $authDetails->demo_url : $authDetails->live_url);
            $this->client_id = $authDetails->client_id;
            $this->username = $authDetails->username;
            $this->password = $authDetails->password;
           // $this->version = "1.25";
        } else {
            $this->api_flag = false;
        }
    }

    public function set_variables($ses_id,$refNo) {
      $this->sess_id = $ses_id;
      $hotel_search_data = $this->Hotelcrs_Model->check_hotel_search_data($ses_id,$refNo);
      $search_data=json_decode($hotel_search_data->search_data,true);
      // echo '<pre/>';print_r($search_data);exit;
      $this->city_code = $search_data['cityCode'];
      $cityNamearr=explode(',', $search_data['cityName']); 
      $this->city_name = $cityNamearr[0];     
      // $code = $this->fitruums_model->get_fitruums_city(trim($cityNamearr[0]), trim($cityNamearr[1]));    
      // echo $code; exit;   
      // if ($code == '') {
      //   $this->city_code = '';
      // } else {
      //   $this->city_code = $code;
      // }
      $this->cin = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['checkIn'])));
      $this->cout = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['checkOut'])));

      $this->nationality = $search_data['nationality'];

      $this->nights = $search_data['nights'];
      $this->rooms = $search_data['rooms'];
      $this->uniqueRefNo = $search_data['uniqueRefNo'];
      $this->adults = $search_data['adults'];
      $this->childs = $search_data['childs'];
      $this->infant = $search_data['infant'];
      $this->childs_ages = $search_data['childs_ages'];
      $this->adults_count = $search_data['adults_count'];
      $this->childs_count = $search_data['childs_count'];
      $this->base_currency = 'USD';

      // $session_data = $this->session->userdata('hotel_search_data');
      // echo '<pre>';print_r($session_data);exit;
      // if(!empty($session_data['hotelname'])) {
      //   $this->hotelname=trim($session_data['hotelname']);
      //   $cityNamedet=explode('||', trim($session_data['cityName']));
      //   $citydetails=explode(',', trim($cityNamedet[1]));
      //   $this->crshotelcode = $this->Hotelcrs_Model->get_crshotelcode($this->api,$this->hotelname,trim($citydetails[0]),trim($citydetails[1]));
      // } else {
      //    $this->crshotelcode = '';
      // }

        $this->adt_cnt = 0;
        $this->chd_cnt = 0;
        if(!empty($this->infant)) {
            $this->inf_cnt = $this->infant;
        } else {
            $this->inf_cnt = 0;
        }
        $this->childage_str='';
        $childage_arr=array();       
        // for ($i = 0; $i < $this->rooms; $i++) 
        for ($i = 0; $i < 1; $i++) {
            $this->adt_cnt += $this->adults[$i];
            $adults_num = $this->adults[$i];
            $childs_num = 0;
            $infants_num = 0;
            if ($this->childs[$i] != 0) {
                $ages = explode(',', $this->childs_ages[$i]);
                for ($a = 0; $a < count($ages); $a++) {
                  $this->chd_cnt += 1;
                  $childs_num += 1;
                  $childage_arr[]=$ages[$a];                  
                }
            }
        }
        $this->childage_str=implode(',', $childage_arr);
    }


    public function hotels_availabilty_search($ses_id,$refNo) {
      $this->set_variables($ses_id,$refNo);
      if ($this->session->userdata('hotel_search_activate') == 1) {
        // echo 1;exit;
        echo json_encode(array('results' => 'success'));
      } else {
        // echo 2;exit;
        // $checkCityCode = $this->Hotelcrs_Model->checkCityCode($this->city_code);
        // $cityName = $checkCityCode->city_name;
        $this->Hotelcrs_Model->delete_temp_results($this->sess_id, 'hotel_crs');
        if (!empty($this->childs_ages)) {
          $child_ages = implode(',', $this->childs_ages);
        } else {
          $child_ages = '';
        }
        if ($this->api_flag) {
          $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
          $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
          $validation = true;
          $error_message = '';
          if (strtotime("now") > strtotime($checkOut)) {
            $validation = false;
            $error_message = "Invalid Checkout Time";
          }
          for ($i = 0; $i < $this->rooms; $i++) {
            if (empty($this->childs[$i])) {
              $this->childs[$i] = 0;
            }
            if ($this->adults[$i] == 0 && $this->childs[$i] == 0) {
              $validation = false;
              $error_message = "Invalid Passenger Information;";
              break;
            }
          }
          // echo $validation;exit;
          if ($validation) {
            $this->extracthotel($checkIn,$checkOut,$refNo,$hotelCode='');
            $searchhotelcodeslist = $this->Hotelcrs_Model->getsearchhotelcodes($this->sess_id, $this->api);
            // echo $this->db->last_query();
            // echo '<pre>';print_r($searchhotelcodeslist);exit;
            if(!empty($searchhotelcodeslist)){
              foreach($searchhotelcodeslist as $val) {
                for ($i = 0; $i < $this->rooms; $i++) {
                  $checkroom = $this->Hotelcrs_Model->check_hotel_search($this->api,$this->sess_id,$val->hotel_code,$i);
                  // echo '<pre>';print_r($checkroom);exit;
                  if(empty($checkroom)) {
                    $this->Hotelcrs_Model->delete_hotel_results($this->api,$this->sess_id,$val->hotel_code);
                    break;
                  }
                }
              }
            }
          }
        }
        echo json_encode(array('results' => 'success'));
      }
    }


    public function hotelsdetails_availabilty_search($hotelCode,$ses_id,$refNo) {
      //Set fitruums Variables
      $this->set_variables($ses_id,$refNo);

      if ($this->Hotelcrs_Model->check_hotel_search_result($ses_id,$refNo))  {
        return 1;
      } else {
        $this->Hotelcrs_Model->delete_temp_results($this->sess_id, 'hotel_crs');
        if (!empty($this->childs_ages)) {
          $child_ages = implode(',', $this->childs_ages);
        } else {
          $child_ages = '';
        }
        if ($this->api_flag) {
          $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
          $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
          $validation = true;
          $error_message = '';
          // if (strtotime("now") > strtotime($checkIn))
          // {
          //    $validation = false;
          //    $error_message = "Invalid Checkin Time";
          // }
          if (strtotime("now") > strtotime($checkOut)) {
            $validation = false;
            $error_message = "Invalid Checkout Time";
          }
          for ($i = 0; $i < $this->rooms; $i++) {
            if (empty($this->childs[$i])) {
              $this->childs[$i] = 0;
            }
            if ($this->adults[$i] == 0 && $this->childs[$i] == 0) {
              $validation = false;
              $error_message = "Invalid Passenger Information;";
              break;
            }
          }
          // echo $validation;exit;
          if ($validation) {
            $this->extracthotel($checkIn,$checkOut,$refNo,$hotelCode='');
            $searchhotelcodeslist = $this->Hotelcrs_Model->getsearchhotelcodes($this->sess_id, $this->api);
            // echo $this->db->last_query();
            // echo '<pre>';print_r($searchhotelcodeslist);exit;
            if(!empty($searchhotelcodeslist)){
              foreach($searchhotelcodeslist as $val) {
                for ($i = 0; $i < $this->rooms; $i++) {
                  $checkroom = $this->Hotelcrs_Model->check_hotel_search($this->api,$this->sess_id,$val->hotel_code,$i);
                  // echo '<pre>';print_r($checkroom);exit;
                  if(empty($checkroom)) {
                    $this->Hotelcrs_Model->delete_hotel_results($this->api,$this->sess_id,$val->hotel_code);
                    break;
                  }
                }
              }
            }
          }
           return 1;  
        }
      }
      return 0;
    }

 

  
    function extracthotel($checkIn,$checkOut,$refNo,$hotelCode) {
      $this->crshotelcode=$hotelCode;
      if(!empty($this->crshotelcode)){
        $hotelcodes = $this->crshotelcode;
      } else{
        $hotelcodes = $this->Hotelcrs_Model->gethotelcodes($this->city_code,0,500);
      } 
      $ROE = 1;
      if(!empty($hotelcodes)){
        $hotelcodess=array();
        if(!empty($hotelcodes)){
          foreach($hotelcodes as $hot) {
            $hotelcodess[] = $hot->hotel_code;
          }
        }
        // echo $this->db->last_query();
        // echo '<pre>';print_r($hotelcodes);exit;
        $roomcodes = $this->Hotelcrs_Model->getroomcodes($hotelcodess,0,2000);
        if(!empty($roomcodes)) {
          // echo '<pre>';print_r($roomcodes);exit; 
          $rmhotelcodes=array();
          $rmcodes=array();
          $rmcodeUnique=array();
          if(!empty($hotelcodes)){
            foreach($roomcodes as $rm) {
              $rmhotelcodes[]=$rm->hotel_code;
              $rmcodes[]=$rm->room_code;
            }
          }
          $htcode=array_unique($rmhotelcodes);    
          $rmcodeUnique=array_unique($rmcodes);    
          $to_date=strtotime($checkOut);
          $from_date=strtotime($checkIn); 
          $days=floor(($to_date - $from_date) / (60 * 60 * 24));
          $rate=array();    
          $results=array();
          $room_count_arr=array();       
          $rmhotelcodess=implode(',', $htcode); 
          $rmcodess=implode(',', $rmcodeUnique); 
          // print_r($htcode);
          // echo "<pre>"; print_r($rmcodess); exit;
          for ($i = 0; $i < $this->rooms; $i++) {
            $res_details = array();
            $res_details = $this->Hotelcrs_Model->get_crs_hotels_rates($rmhotelcodess,$rmcodess,$this->city_code, $checkIn, $checkOut, $this->adults[$i], $this->childs[$i],$this->rooms);
            // echo $this->db->last_query();//exit;
            if(!empty($res_details)) {
              $rate[$i]=$res_details;
            }
          }
          // echo $this->db->last_query();//exit;
          // echo "<pre>";  print_r($res_details);exit;

          for ($i = 0; $i < $this->rooms; $i++) {
            $index = '';
            $indexarr=array();
            $roommealarr=array();
            $childsagearr=array(); 
            $child_ages = '';  
            if ($this->childs[$i] != 0) {
              $child_ages=$this->childs_ages[$i];
              $ages = explode(',', $this->childs_ages[$i]);
              for ($c = 0; $c < $this->childs[$i]; $c++) {  
                $childsagearr[]=$ages[$c];                  
              }
            }
            $childsagestr='';
            if(!empty($childsagearr)) {
              $childsagestr=implode("|", $childsagearr);
              $childsagestr="|".$childsagestr;
            }
            if(isset($rate[$i])) {
              for($l=0;$l<count($rate[$i]);$l++) {
                if(strtotime($checkIn)==strtotime($rate[$i][$l]->room_avail_date)) {
                  $day=0;
                  $flag=true;
                  // $total_cost=0;
                  $min_night_stay = '';
                  $sub_rate_adt=0;
                  $adult_cost=0;
                  $child_cost=0;
                  $room_discount=0;
                  $admin_discount=0;
                  $total_adult = $this->adults_count;
                  $total_child = $this->childs_count;
                  
                  $hotel_room_allotment=array();        
                  $rt_hotel_code=$rate[$i][$l]->hotel_code;
                  $rt_room_code=$rate[$i][$l]->room_code;
                  $rt_meal_plan=$rate[$i][$l]->meal_plan;
                  $rt_supplier_id=$rate[$i][$l]->supplier_id;
                  $index1='RATE'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_meal_plan.'|'.($i+1).$this->adults[$i].'|'.$this->childs[$i];
                  $roommealtype1='RATE'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;
                  if(!empty($roommealarr[$i][$roommealtype1])) {
                    continue;
                  }
                  if(!empty($indexarr[$i][$index1])) {
                    continue;
                  }
                  for($j=0,$s=0;$j<count($rate[$i]) && !empty($rate[$i]);$j++) {
                    if($rt_hotel_code==$rate[$i][$j]->hotel_code && 
                      $rt_room_code==$rate[$i][$j]->room_code && 
                      $rt_supplier_id==$rate[$i][$j]->supplier_id && 
                      $rt_meal_plan==$rate[$i][$j]->meal_plan) {

                      $index='RATE'.'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_supplier_id.'|'.$rt_meal_plan.'|'.($i+1).$this->adults[$i].'|'.$this->childs[$i];
                      $roommealtype='RATE'.'|'.($i+1).'|'.$rt_hotel_code.'|'.$rt_room_code.'|'.$rt_meal_plan;    
                      $day=$day+1;
                      $s=$j;
                      $room_discount = $rate[$i][$j]->discount;
                      $min_night_stay = $rate[$i][$j]->min_night_stay;
                      // $room_discount += $rate[$i][$j]->discount;
                      // $total_cost += $rate[$i][$j]->room_rate;
                      // $adult_cost += $rate[$i][$j]->adult_rate;
                      // $child_cost += $rate[$i][$j]->child_rate;
                      // echo 'fgdf'.$room_discount;exit;
                      for($a=0;$a<$total_adult;$a++){
                        $adult_cost += $rate[$i][$j]->adult_rate;
                      }

                      for($c=0;$c<$total_child;$c++){
                        $child_cost += $rate[$i][$j]->child_rate;
                      }

                      if($total_adult == 1){
                        $sub_rate_adt += $rate[$i][$j]->adult_rate;
                      } elseif($total_adult == 2){
                        $sub_rate_adt += $rate[$i][$j]->double_rate;
                      } elseif($total_adult == 3){
                        $sub_rate_adt += $rate[$i][$j]->triple_rate;
                      } elseif($total_adult == 4){
                        $sub_rate_adt += $rate[$i][$j]->quad_rate;
                      } elseif($total_adult > 4){
                        $sub_rate_adt += ($rate[$i][$j]->quad_rate + ($rate[$i][$j]->adult_rate*($total_adult-3)));
                      }

                      $hotel_room_allotment[]=$rate[$i][$j]->sup_hotel_room_allotment_id;
                    }
                  }
                  
                  // echo 'child_cost'.$child_cost;//exit;
                  // echo 'sub_rate_adt'.$sub_rate_adt;//exit;

                  // $total_cost = $adult_cost+$child_cost;
                  $total_cost = ($sub_rate_adt+$child_cost);

                  // echo 'total_cost'.$total_cost;exit;

                  if($day==$this->nights) {
                    $currency_type = $rate[$i][$s]->currency_type;
                    $discount_type = $rate[$i][$l]->discount_type;
                    $admin_discount = $rate[$i][$l]->discount_value;
                    /*if ($currency_type != 'USD') {
                        $ROE = $this->change_currency($currency_type);
                        $total_costc = $ROE * $total_cost;
                        $room_discount = $ROE * $room_discount;
                        if($discount_type==2){
                          $admin_discount = ($total_costc*$admin_discount)/100;
                        } else if($discount_type==1){
                          $admin_discount = $admin_discount;
                        }
                    }*/

                    $indexarr[$i][$index]=$index;
                    $roommealarr[$i][$roommealtype]=$roommealtype;
                    $room_count_arr[$i]=$i;

                    $rate[$i][$s]->min_night_stay=$min_night_stay;
                    $rate[$i][$s]->discount_type=$discount_type;
                    $rate[$i][$s]->admin_discount=$admin_discount;
                    $rate[$i][$s]->room_discount=$room_discount;
                    $rate[$i][$s]->total_cost=$total_cost;
                    $rate[$i][$s]->net_fare=$total_cost;
                    $rate[$i][$s]->room_index=$i;
                    $rate[$i][$s]->index=$index;
                    $rate[$i][$s]->adult=$this->adults[$i];
                    $rate[$i][$s]->child=$this->childs[$i];
                    $rate[$i][$s]->nights=$this->nights; 
                    $rate[$i][$s]->childs_ages=$child_ages;
                    $rate[$i][$s]->type='Normal';
                    $rate[$i][$s]->hotel_room_allotment=implode(',', $hotel_room_allotment);
                    $cancelpolicy_arr=array(
                      'supplier_id'=>$rate[$i][$s]->supplier_id,
                      'sup_hotel_id'=>$rate[$i][$s]->sup_hotel_id,
                      'hotel_code'=>$rate[$i][$s]->hotel_code,
                      'room_code'=>$rate[$i][$s]->room_code,
                      'sup_room_details_id'=>$rate[$i][$s]->sup_room_details_id,
                      'meal_plan'=>$rate[$i][$s]->meal_plan
                    );
                    $cancellation_policy = $this->Hotelcrs_Model->check_crs_hotels_normal_cancel_policy($cancelpolicy_arr,$checkIn);
                    $cancel_policy = '';
                    // echo '<pre>';print_r($cancellation_policy);//exit;
                    $hotel_crs_cancellation_json=array();
                    if(!empty($cancellation_policy[0])) {
                      for($can=0,$incre=0;$can<count($cancellation_policy);$can++) {
                        if($cancellation_policy[$can]->per_rate_charge > 0) {
                          $last_date = $cancellation_policy[$can]->days_before_checkin;
                          if($last_date!=0) {
                            $cancel_date = date('Y-m-d', strtotime('-' . $last_date . ' days ', strtotime($checkIn)));
                          } else {
                            $cancel_date = $checkIn; 
                          }
                          if($can==0 ||($can>=1 && $cancellation_policy[$can]->days_before_checkin!=$cancellation_policy[($can-1)]->days_before_checkin)) {
                            if($cancellation_policy[$can]->cancel_rates_type=='fixed') {
                              if ($currency_type != 'USD') {
                                  $ROE = $this->change_currency($currency_type);
                                  $per_rate_charge = $ROE * $per_rate_charge;
                              }
                              // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . ' '.$rate[$i][$s]->currency_type.' will charged. If cancelled on ' . $cancel_date . ' </p>';
                              $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.' '.$rate[$i][$s]->currency_type.' will charged if not cancelled before '.$cancel_date.'</p>';
                              $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                            }
                            if($cancellation_policy[$can]->cancel_rates_type=='percentage') {
                              // $cancel_policy .= '<p>Cancellation charges ' . $cancellation_policy[$can]->per_rate_charge . '% will charged. If cancelled on ' . $cancel_date . ' </p>';
                              $cancel_policy .= '<p>A cancellation fee of '.$cancellation_policy[$can]->per_rate_charge.'% will charged if not cancelled before '.$cancel_date.'</p>';
                              $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                            }
                          }
                        } else {
                          if($cancellation_policy[$can]->policy_id!='' && $cancellation_policy[$can]->policy_id!=0) {
                            $query2 =  $this->db->select('*')->where('id', $cancellation_policy[$can]->policy_id)->get('cancel_policy');
                            $cancel_policy = $query2->row()->policy_desc;
                          } else {
                            if($cancellation_policy[$can]->cancel_rates_type=='non_refundable') {
                              $cancel_policy ='<p>Non Refundable</p>';
                              $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin]=$cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                            } else {
                              $cancel_policy = $cancellation_policy[$can]->cancel_rates_type;
                              $hotel_crs_cancellation_json[$index][$cancellation_policy[$can]->days_before_checkin] = $cancellation_policy[$can]->per_rate_charge.'||'.$cancellation_policy[$can]->cancel_rates_type;
                            }
                          }
                        }
                      }
                    }
                    $rate[$i][$s]->cancel_policy=$cancel_policy;
                    $rate[$i][$s]->hotel_crs_cancellation_json = json_encode($hotel_crs_cancellation_json);  
                    $results[$index]=$rate[$i][$s]; 
                  }
                }
              }
            }
          }

          // echo "<pre>"; print_r($results);exit;
          $insertrooms=array();
          $ro=0;
          foreach ($results as $result) {
            $checkroom = $this->Hotelcrs_Model->check_hotel_room_search($this->api,$this->sess_id,$result->hotel_code,$result->room_code,$result->room_index);

            if(empty($checkroom)) {
              $room_details_info = array(
                'supplier_id' => $result->supplier_id,
                'sup_hotel_id' => $result->sup_hotel_id,   
                'hotel_code' => $result->hotel_code,   
                'room_code' => $result->room_code,   
                'sup_room_details_id' => $result->sup_room_details_id,   
                'meal_plan' => $result->meal_plan,            
              );

              $ROE = 1;
              $admin_discount_type = $result->discount_type;
              $currencyv1 = $result->currency_type;
              if ($currencyv1 !== 'USD') {
                $ROE = $this->change_currency($currencyv1);
              }
              $total_amt = $ROE*$result->total_cost;
              // $convertedprice1 = $ROE*$result->net_fare;
              $supplier_discount = 0;
              $room_discount = $result->room_discount;

              // Promotion OTA
              #discount notice
              #discount value
              #discount id or room_code --- use for any other info
              #discount type
              #discount audience
              $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
              $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
              $promotions = $this->Hotelcrs_Model->getPromotionOta($result->hotel_code,$checkIn,$checkOut);
              $promotion_ota = '';
              if(!empty($promotions)){
                $promotion_ota = serialize($promotions);
              }
              
              // echo $this->db->last_query();
              // echo '<pre>';print_r($promotion_ota);exit;
              if($room_discount>0){
                $supplier_discount = 0;
                // $supplier_discount = ($total_amt*$room_discount)/100;
              }
              $discount_value = $result->discount_value;
              $admin_cost = $total_amt - $supplier_discount;
              if($admin_discount_type==2){
                if($discount_value > 0){
                  $admin_discount = $ROE*(($admin_cost*$discount_value)/100);
                }
              } else {
                $admin_discount = $ROE*$discount_value;
              }
              $total_discount = $admin_discount+$supplier_discount;
              $discount = $total_discount;
              $convertedprice1 = $total_amt - $discount;
              
              $this->load->module('hotels/hotel_markup');
              // $markup_array = $this->hotel_markup->markup_calculation($convertedprice1,$this->nationality,$this->api,$this->city_code,$result->hotel_code);
              $markup_array = $this->hotel_markup->markup_calculation($convertedprice1,$this->nationality,$this->api);
              $sup_tax = $this->db->select('supplier_tax_percent,government_tax,resort_fee,service_tax')->from('supplier_hotel_list')->where('hotel_code', $result->hotel_code)->get()->row();
              $total_cost = $markup_array['total_cost'];
              
              $government_tax = 0;
              $resort_fee = 0;
              $service_tax = 0;
              $sup_tax_amt = 0;

              if(!empty($sup_tax)){
                $government_tax = (($sup_tax->government_tax*$total_cost)/100);
                $resort_fee = $sup_tax->resort_fee*$this->nights;
                $service_tax = (($sup_tax->service_tax*$total_cost)/100);
              }

              $insertrooms[$ro] =array(
                'session_id' => $this->sess_id,
                'uniqueRefNo' => $refNo,
                'hotel_supplier_id'=>$result->supplier_id,
                'api' => $this->api,
                'city_code' => $this->city_code,
                'city_name' => $this->city_name,
                'hotel_code' => $result->hotel_code,
                'rate_basis_desc'=>$result->index,
                'unique_cityid' => $this->city_code,
                'hotel_name' => $result->hotel_name,
                'room_name' => $result->room_name,
                'room_code' => $result->room_code,
                'room_description'=>$result->room_desc,
                'hotel_property_id'=>$result->hotel_room_allotment,
                'room_details_info'=>json_encode($room_details_info),
                'room_type' => $result->room_type,
                'exclusions' => $result->exclusions,
                'inclusions' => $result->inclusions,
                'room_policies' => $result->room_policies,
                // 'room_cancel_policies' => $result->room_cancel_policies,
                'room_cancel_policies' => $result->cancel_policy,
                'description' => $result->hotel_desc,
                'child_age' => $result->childs_ages,
                'board_type'=>$result->meal_plan,
                'adult' => $result->adult,
                'child' => $result->child,
                'room_count' => $this->rooms,
                'room_runno'=>$result->room_index,
                'nights'=>$result->nights,
                'image' => $result->thumb_img,
                'hotel_address' => $result->address,
                'amenities' => $result->hotel_facilities,
                'room_amenities' => $result->room_facilities,
                'cancel_policy'=>$result->cancel_policy,
                'star' => $result->hotel_star_rating,

                'xml_currency' => $result->currency_type,
                'currency' => 'USD',
                'ROE' => $ROE,
                // 'org_amt' => $result->total_cost + $sup_tax_amt,
                // 'currency_conv_value' => $result->total_cost + $sup_tax_amt,
                // 'total_cost' =>$result->total_cost + $sup_tax_amt,
                'net_fare'=>$result->net_fare,

                'org_amt' => $result->total_cost,
                'currency_conv_value' => $convertedprice1,
                // 'total_cost' => $convertedprice1 + $sup_tax_amt,

                'discount_type' => $result->discount_type,
                'discount_value' => $admin_discount,
                'member_discount' => $result->discount_value,
                'discount' => $discount,
                // 'sup_tax_amt' => $sup_tax_amt,
                'government_tax' => $government_tax,
                'resort_fee' => $resort_fee,
                'service_tax' => $service_tax,

                'payment_charge' => $markup_array['payment_charge'],
                'total_cost' => $markup_array['total_cost'],
                'admin_markup' => $markup_array['admin_markup'],
                // 'admin_agent_markup' => $markup_array['admin_agent_markup'],
                'agent_markup' => $markup_array['agent_markup'],

                'hotel_crs_cancellation_json'=>$result->hotel_crs_cancellation_json,
                'min_night_stay' => $result->min_night_stay,
                'promotion_ota' => $promotion_ota
              );
              $ro++;
            }
          }
          // echo '<pre>';print_r($insertrooms);exit;
          if (!empty($insertrooms) && count($room_count_arr)==$this->rooms)  {
            $this->Hotelcrs_Model->insert_crs_data($insertrooms);
            // echo $this->db->last_query();exit;
          }
        }
      }
    }


    public function change_currency($tocurrency) {
      $curr = $this->Hotelcrs_Model->get_converted_price($tocurrency, 'USD', 1);
      return $curr;
    }



  public function fetch_search_result() {
      $temp_data = $this->Hotelcrs_Model->fetch_search_result($this->sess_id, $this->api);
      //echo '<pre/>';print_r($temp_data);exit;
      if (empty($temp_data)) {
          $this->session->unset_userdata('hotel_search_activate');
      }

      $data['result'] = $temp_data;
      $hotels_search_result = $this->load->view('hotel_crs/search_result_ajax', $data, true);

      echo json_encode(array(
          'hotels_search_result' => $hotels_search_result
      ));
  }

  public function hotel_details($hotelCode,$searchId,$ses_id,$refNo) { 
    $this->set_variables($ses_id,$refNo);
    $data['searchId'] = $searchId;
    $data['hotelDetails'] = $hotelDetails = $this->Hotelcrs_Model->getHotelDetails($hotelCode, $searchId,$ses_id);
    $data['room_info'] = $this->Hotelcrs_Model->get_hotel_rooms($this->city_code, $ses_id, $hotelCode);

    $data['priceDetails'] = $this->Hotelcrs_Model->getMinMaxCostHotel($hotelCode,$ses_id);
    

    if(empty($hotelDetails)) {
        $data['hotelDetails'] = $hotelDetails = $this->Hotelcrs_Model->getSupHotelDetails($hotelCode);
        $data['total_cost'] = 0;
    } else {
      $data['total_cost'] = $hotelDetails->total_cost;
    }
    // echo '<pre/>';print_r($priceDetails);exit;
    $data['hotelImages'] = $this->Hotelcrs_Model->getHotelImages($hotelCode);
    $data['ses_id'] = $ses_id;
    $data['refNo'] = $refNo;
    $data['checkdate'] = $this->cin;
    
    $data['rooms'] = $this->rooms;
    $data['newuniqueRefNo'] = $this->generateRandomString(8);
    $data['city_code'] = $this->city_code;
    
    // $this->load->library('googlemaps');
    // $config['center'] = "$hotelDetails->latitude, $hotelDetails->longitude";
    // $config['zoom'] = '11';
    // $this->googlemaps->initialize($config);
    // $marker = array();
    // $marker['position'] = "$hotelDetails->latitude, $hotelDetails->longitude";
    // $marker['infowindow_content'] = "$hotelDetails->hotel_name <br/> $hotelDetails->city_name <br /> $hotelDetails->address";
    // $this->googlemaps->add_marker($marker);
    // $data['map'] = $this->googlemaps->create_map();
    $this->load->view('hotel_crs/hotel_details', $data);
  }

  function rooms_availability($session_id, $hotelCode) {
    // $this->set_variables();
    $room_info = $this->Hotelcrs_Model->get_hotel_rooms($this->city_code,$session_id, $hotelCode);
    $set_currency = $this->session->userdata('default_currency');
    $set_curr_val = $this->session->userdata('currency_value');
    $showRoom = '';
    $dataroom['room_info']=$room_info;
    // echo '<pre/>11';print_r($room_info);exit;
    $showRoom .= $this->load->view('hotel_crs/rooms_available', $dataroom, TRUE);
    echo json_encode(array('rooms_result' => $showRoom));    
  }

 public function nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city, $star) {

        $nearby_hotels = $this->Hotelcrs_Model->get_nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city, $star);
        // echo $this->db->last_query();
        // echo '<pre/>11';print_r($nearby_hotels);exit;
        $showHotels = '';
        if (!empty($nearby_hotels)) {
            for ($t = 0; $t < count($nearby_hotels); $t++) {
                $review = rand(100, 500);
                $rating = rand(1, 5);
                $showHotels .='';
                $showHotels .= '<div class="col-md-12 htl-type">
                  <img src="' .get_image_aws($nearby_hotels[$t]->image). '" width="100" height="100" alt="' . $nearby_hotels[$t]->room_type . '">
                  <div class="htl-type-dtls">
                    <div class="row">
                      <div class="col-md-12 htlDetailsCntr">
                        <div class="htlname">' . $nearby_hotels[$t]->hotel_name . ' <span class="star star'.$nearby_hotels[$t]->star.'"></span></div>
                        
                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: ' . $nearby_hotels[$t]->address . ', ' . $nearby_hotels[$t]->city_name . '</div>
                        <span>'.$nearby_hotels[$t]->currency.' '.$nearby_hotels[$t]->total_cost.'</span><br/>
                        <form name="frmHotelDetails" method="post" action="' . site_url() . 'hotels/details">
                            <input type="hidden" name="callBackId" value="' . base64_encode('hotel_crs') . '" />
                            <input type="hidden" name="hotelCode" value="' . $nearby_hotels[$t]->hotel_code . '" />
                            <input type="hidden" name="searchId" value="' . $nearby_hotels[$t]->search_id . '" />
                            <button type="submit" class="btn btn-primary" style="color: #fff">View Deals</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>';
            }
        }

        echo json_encode(array(
            'nearby_hotels' => $showHotels,
        ));
    }


    public function hotel_itinerary($hotelCode,$searchId,$session_id,$refNo) {      
      $this->set_variables($session_id,$refNo);
      $roomDetails=array();
      $supplement_cost=0;
      $total_cost=0;
      $cancel_policy='';
      foreach ($searchId as $val) {
        $roomDetails[] = $searchrooms = $this->Hotelcrs_Model->get_merged_rooms('hotel_crs', $session_id, $hotelCode, $val);
        $total_cost += $searchrooms->total_cost;
        if(!empty($searchrooms->cancel_policy)){
          $cancel_policy.='Room'.($searchrooms->room_runno+1).'<br>'.$searchrooms->cancel_policy;
        }
      }
      $data['tempSearchId'] =implode(',',$searchId);
      $data['total_cost'] = $total_cost;
      $data['supplement_cost'] = $supplement_cost;
      $data['roomDetails']=$roomDetails;
      $data['cancel_policy']=$cancel_policy;
      $data['country_list']=$this->Hotelcrs_Model->getCountry();
      // echo '<pre/>11';print_r($data['country_list']);exit;
      $data['ses_id'] = $session_id;                
      $data['refNo'] = $refNo; 
      if (!empty($roomDetails)) {
        $this->load->view('hotel_crs/hotel_itinerary', $data);
      } else {
        $error = 'One of the selected room type is not available. Please search again';
        redirect('hotels/error_page/' . base64_encode($error));
        exit;
      }
    }

    public function payment_process($sessionId, $hotelCode, $searchId, $refNo) {

      $this->set_variables($sessionId,$refNo);
      $searchIds =explode(',',$searchId);
      $roomDetails = array();
      foreach ($searchIds as $val) {
        $roomDetails[]= $this->Hotelcrs_Model->getRoomDetails($this->api, $sessionId, $hotelCode, $val);
      }
      // echo $this->db->last_query();
      // echo '<pre>';print_r($roomDetails);exit;
      list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$sup_tax_cost,$gov_tax_cost,$resort_fee_cost,$service_tax_cost,$allotment_arr,$min_night_stay) = $this->check_rates_and_room_availability($sessionId, $hotelCode,$roomDetails);

      if ($check_availiablity && $check_rates) {
        $Sys_RefNo = $refNo;
        $pass_info = $this->session->userdata('passenger_info');
        // $total_cost = 0;
        // foreach ($roomDetails as $res) {
        //   $total_cost += $res->total_cost;
        // }

        $price_nights = 1; //Price based on nights? No=1Yes=total_nights
        $this->load->module('home');
        $discount_return = $this->home->priceChangeOnLogin($searchId,$price_nights);
        // echo '<pre>rr';print_r($discount_return);//exit;

        $total_cost = $discount_return['member_cost'];
        $total_discount = $discount_return['discount'];
        $promo_id = $discount_return['promo_id'];
        $total_taxes = $discount_return['taxes'];

        $sup_tax_cost =0;
        // $total_taxes = $sup_tax_cost+$gov_tax_cost+$resort_fee_cost+$service_tax_cost;
        // $total_cost = $total_cost+$total_taxes-$total_discount;
        $total_cost = $total_cost+$total_taxes;

        // $total_cost = 100;
        $ip = $_SERVER['REMOTE_ADDR'];
        //$this->session->set_userdata('payment_id' , $payinsert_id);
        $search_details = array(
            'callBackId' => 'hotel_crs',
            'searchId' => $searchId,
            'hotelname' => $roomDetails[0]->hotel_name,
            'hotelcity' => $roomDetails[0]->city_name,
            'hotelCode' => $hotelCode,
            'sessionId' => $sessionId,
            'service_type'=>1,
            'uniqueRefNo' => $Sys_RefNo,
            'desc'=>'Hotel Booking',
            'cost' => $total_cost
        );
        $this->session->set_userdata('search_details', $search_details);
        // echo '<pre>rr';print_r($search_details);exit;
        redirect('payment/index');
        exit;
      } else {
        $error = 'Rooms Not Available';
        redirect('hotels/error_page/' . base64_encode($error));
        exit();
        return '';
      }
    }

  public function hotel_reservation($sessionId,$hotelCode,$searchId,$refNo) {
    $this->set_variables($sessionId,$refNo);
    $searchIds = explode(',',$searchId);
    $roomDetailsdata = array();
    foreach ($searchIds as $val) {
      $roomDetailsdata[]= $this->Hotelcrs_Model->getRoomDetails($this->api, $sessionId, $hotelCode, $val); 
    } 
    if (!empty($roomDetailsdata)) {
      list($booking_id,$roomDetails,$allotment_arr)= $this->crs_booking($sessionId,$hotelCode,$searchId,$roomDetailsdata);
      // echo "<pre>hgfhfghhhjg"; print_r($booking_id);exit;
      if (!empty($booking_id)) {
        $Book_Status = 'Success';
      } else {
        $Book_Status = 'Fail';
      }
      $total_cost = 0;

      $sup_tax_amt = 0;
      // $sup_tax_amt = $roomDetails[0]->sup_tax_amt;
      $government_tax = $roomDetails[0]->government_tax;
      $resort_fee = $roomDetails[0]->resort_fee;
      $service_tax = $roomDetails[0]->service_tax;

      $discount = $roomDetails[0]->discount;
      $admin_markup = 0;
      $admin_agent_markup = 0;
      $payment_charge= 0;
      $user_id=0;
      $agent_id=0;
      $Booking_Date = date('Y-m-d');
      $Sys_RefNo = $refNo;
      $room_type_name='';
      $cancel_policy='';
      foreach ($roomDetails as $res) {
        $total_cost += $res->total_cost;
        $admin_markup += $res->admin_markup;
        $admin_agent_markup += $res->admin_agent_markup;
        $payment_charge += $res->payment_charge; 
        $board_type=$this->Hotelcrs_Model->get_supplement_meal_plan($res->board_type);
        $booking_code_str='';
        $room_type_name.=$res->room_name.' '.$res->room_type.' | Inclusion ( '.$board_type.' ) '.$booking_code_str.'<br>';
        $cancel_policy.='Room'.($res->room_runno+1).'<br>'.$res->cancel_policy;
      }

      $price_nights = 1; //Price based on nights? No=1Yes=total_nights
      $this->load->module('home');
      $discount_return = $this->home->priceChangeOnLogin($searchId,$price_nights);
      // echo '<pre>rr';print_r($discount_return);//exit;
      $total_cost = $discount_return['member_cost']+$discount_return['discount'];
      $discount = $discount_return['discount'];
      $promo_id = $discount_return['promo_id'];
      $total_taxes = $discount_return['taxes'];

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
        $deposit_check_status = $this->deposit_check($roomDetails);
        if ($deposit_check_status == 1) {
          $error = 'Your Balance is too low to make this booking';
          redirect('hotels/error_page/' . base64_encode($error), 'refresh');
          exit;
        } elseif ($deposit_check_status == 0) {
          $totsend = $total_cost+$total_taxes-$discount;
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
        'supplier_id'=>$roomDetails[0]->supplier_id,
        'Api_Name'=>'hotel_crs',
        'Hotel_RefNo' => '',
        'Booking_RefNo' => $booking_id,
        'uniqueRefNo' => $Sys_RefNo,
        'Booking_Status' => $Book_Status,
        'Booking_Date' => $Booking_Date,
        'Booking_Amount' => $total_cost+$total_taxes-$discount,
        'total_cost' => $total_cost,
        'discount' => $discount,
        'promotional_discount' => $promo_id,

        // 'sup_tax_amt' => $sup_tax_amt,
        'government_tax' => $government_tax,
        'resort_fee' => $resort_fee,
        'service_tax' => $service_tax,

        'Admin_Markup' => $admin_markup,
        'Admin_Agent_Markup' => $admin_agent_markup,
        'Payment_Charge' => $payment_charge,
        'cancel_policy' =>$cancel_policy,
        'Currency' => $roomDetails[0]->currency,
        'Xml_Currency' => $roomDetails[0]->xml_currency,
        'Booking_Done_By' => $Booking_Done_By,
        'payment_type'=>$pay_type,
        'agent_type'=>$agent_type,
        'room_type_name'=>$room_type_name,

        'user_mobile'=>$user_mobile,
        'user_email'=>$user_email,
        'user_name'=>$user_name,
        'user_pincode'=>$user_pincode,
        'user_city'=>$user_city,
        'user_state'=>$user_state,
        'user_country'=>$user_country,
        'user_address'=>$user_address,
        'allotment_arr'=>serialize($allotment_arr)
      );
      // echo '<pre>rr';print_r($insertbookingdata);exit;
      $this->db->insert('hotel_booking_reports', $insertbookingdata);

      // Hotel Booking Hotels Information Data
      // echo "<pre>"; print_r($roomDetails);exit;
      $this->Hotelcrs_Model->insert_hotel_booking_information_data($user_id, $agent_id, $Sys_RefNo, $roomDetails[0]->hotel_code, $roomDetails[0]->room_code, $roomDetails[0]->hotel_name, $this->city_name, $this->cin, $this->cout, $Booking_Date, $this->rooms, $this->nights, 'hotel_crs', $roomDetails[0]->star, $roomDetails[0]->image, $roomDetails[0]->hotel_desc, $roomDetails[0]->address, $roomDetails[0]->hotel_phone, $roomDetails[0]->hotel_fax, $this->adults_count, $this->childs_count, $this->adults, $this->childs, $this->childs_ages, $roomDetails[0]->cancel_policy, $roomDetails[0]->imp_information);

      redirect('hotels/voucher?voucherId=' . $Sys_RefNo . '&hotelRefId=' . $booking_id, 'refresh');
    } else {
      $this->hotel_itinerary($sessionId, $hotelCode, $searchId);
    }
  }

  public function crs_booking($sessionId, $hotelCode,$searchId,$roomDetailsdata) {
    
    $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
    $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
    list($check_availiablity,$check_rates,$net_amount,$total_cost,$discount,$sup_tax_cost,$gov_tax_cost,$resort_fee_cost,$service_tax_cost,$allotment_arr,$min_night_stay)=$this->check_rates_and_room_availability($sessionId,$hotelCode,$roomDetailsdata);

    $searchIds =explode(',',$searchId);
    $roomDetails = array();
    foreach ($searchIds as $val) {
      $roomDetails[]= $this->Hotelcrs_Model->getRoomDetails($this->api,$sessionId, $hotelCode, $val);
        // echo '<pre>';print_r($roomDetails);

    }

    $discount = $roomDetails[0]->discount;
    $sup_tax_amt = $roomDetails[0]->sup_tax_cost;
    $government_tax = $roomDetails[0]->government_tax;
    $resort_fee = $roomDetails[0]->resort_fee;
    $service_tax = $roomDetails[0]->service_tax;
    $total_cost = $total_cost;

    if ($check_availiablity && $check_rates) {
      $pass_info = $this->session->userdata('passenger_info');
      $booking_id = $this->Hotelcrs_Model->get_last_booking_code();
      $booking_id += 1;
      $this->db->trans_begin();
      // echo '<pre>';print_r($booking_id);exit;
      $insert_hotel = array(
        'booking_id' => $booking_id,
        'hotel_code' => $roomDetails[0]->hotel_code,
        'hotel_name' => $roomDetails[0]->hotel_name,
        'supplier_id' => $roomDetails[0]->supplier_id,
        'uniqueRefNo' => $this->uniqueRefNo,
        'check_in' => $checkIn,
        'check_out' => $checkOut,
        'booking_date' => date('Y-m-d'),
        // 'city' => $roomDetails->city_name,
        'city' => $this->city_name,
        'room_count' => $this->rooms, 
        'adult' => $this->adults_count,
        'child' => $this->childs_count,                
        'net_amount' => $net_amount,
        'total_amount' => $total_cost,
        'discount' => $discount,
        // 'min_night_stay' => $min_night_stay,
        'government_tax' => $government_tax,
        'resort_fee' => $resort_fee,
        'service_tax' => $service_tax,

        // 'tax' => $sup_tax_amt,
        'tax' => '0.0',
        // 'comment_desc'=>$pass_info['comment'],
      );
  // echo '<pre>';print_r($insert_hotel);exit;
      $this->Hotelcrs_Model->insert_crs_booking($insert_hotel);
      $i = 0;
      $ages = '';
      foreach ($roomDetails as $res) {
        if(!empty($this->childs_ages[$i])){
          $ages = $this->childs_ages[$i];
        }
        $insert_hotel_room_details = array(
          'booking_id' => $booking_id,
          'uniqueRefNo' => $this->uniqueRefNo,
          'mobile' => $pass_info['GuestMobileNo'],
          'email' => $pass_info['GuestEmailID'],
          'hotel_code' => $res->hotel_code,
          'room_code' => $res->room_code,
          'supplier_id'=>$res->hotel_supplier_id,
          'meal_plan'=>$res->board_type,
          'room_no'=>($res->room_runno+1),
          'check_in' => $checkIn,
          'check_out' => $checkOut,
          'room_type' => $res->room_type,
          'room_price' => $res->total_cost,
          'net_fare'=>$res->net_fare,
          // 'discount'=>$res->discount,
          'adult' => $this->adults[$i],
          'child' => $this->childs[$i],  
          'childs_ages'=> $ages,
          'nights'=>$this->nights,       
          // 'hotel_crs_booking_code'=>$res->hotel_crs_booking_code,
          'hotel_crs_cancellation_json'=>$res->hotel_crs_cancellation_json,
        );
        $this->Hotelcrs_Model->insert_crs_booking_room_details($insert_hotel_room_details);
        $i++;
      }
      $this->Hotelcrs_Model->insert_crs_booking_pass($booking_id, $this->rooms, $this->adults, $this->childs,$this->uniqueRefNo);
      $balance = $total_cost + $this->Hotelcrs_Model->get_supplier_balance($roomDetails[0]->supplier_id);

      $insertData = array(
        // 'transaction_id' => $this->generateRandomString(10),
        'transaction_id' => $this->uniqueRefNo,
        'supplier_id' => $roomDetails[0]->supplier_id,
        'supplier_no' => $roomDetails[0]->supplier_no,
        'booking_id' => $booking_id,
        'hotel_id' => $roomDetails[0]->supplier_hotel_list_id,
        'hotel_code' =>$roomDetails[0]->hotel_code,
        'property_type' =>'hotel',
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
      $this->Hotelcrs_Model->insert_supplier_act_summary($insertData);
      // echo $this->db->last_query();
      // if ($this->db->trans_status() === FALSE) {
      //   echo '<pre>dffd';print_r($booking_id);exit;
      //   $this->db->trans_rollback();
      //   return '';
      // } else {
      //   $this->db->trans_commit();
        //Reduce Availibilty
        foreach ($allotment_arr as $key=>$val) {
          $this->Hotelcrs_Model->update_crs_hotels_room_allotment($key,$val);
        }
        // echo '<pre>34';print_r($booking_id);exit;
        return array($booking_id,$roomDetails,$allotment_arr);
        // return $booking_id;
      // }
    } else {
      $error = 'Rooms Not Available';
      redirect('hotels/error_page/' . base64_encode($error));
      exit();
      return '';
    }
  }


  public function check_rates_and_room_availability($sessionId,$hotelCode,$roomDetails) {
    // echo "hghg<pre>"; print_r($roomDetails);exit;
    $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $this->cin)));
    $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $this->cout)));
    $allotment_arr=array();
    $check_availiablity = true;
    $check_rates = true;
    
    $tot_cost = 0;$dis_cost = 0;$net_cost=0;
    $sup_tax_cost=0;$gov_tax_cost=0;$resort_fee_cost=0;$service_tax_cost=0;
    $total_cost_arr=array();$net_fare_arr=array();$discount_arr=array();
    $sup_tax_arr=array();$gov_tax_arr=array();$resort_fee_arr=array();$service_tax_arr=array();

    $total_sub_rate = 0;
    $sub_rate_adt = 0;
    $child_rate = 0;
    $total_adult = $this->adults_count;
    $total_child = $this->childs_count;

    for($i=0;$i<count($roomDetails);$i++) {
      $allotment_id=explode(',',$roomDetails[$i]->hotel_property_id);
      // echo '<pre>';print_r($allotment_id);//exit;
      foreach ($allotment_id as $val) {
        if(isset($allotment_arr[$val])) {
          $allotment_arr[$val]=($allotment_arr[$val]+1);
        } else {
          $allotment_arr[$val]=1;
        }
      }
    }
    
    for($i=0;$i<count($roomDetails);$i++) {    
      $room_details_info=json_decode($roomDetails[$i]->room_details_info,true);
      $dataarray=array(
        'sup_hotel_id'=>$room_details_info['sup_hotel_id'], 
        'supplier_id'=>$room_details_info['supplier_id'],  
        'hotel_code'=>$room_details_info['hotel_code'],   
        'room_code'=>$room_details_info['room_code'],   
        'sup_room_details_id'=>$room_details_info['sup_room_details_id'],   
        'meal_plan'=>$room_details_info['meal_plan'],   
      );
      $check_prices = $this->Hotelcrs_Model->check_crs_hotels_price($dataarray,$checkIn,$checkOut);    
      $cp=0;
      if(!empty($check_prices)) {
        foreach($check_prices as $chp) {  
          // if($chp->room_rate==0) { 
          //   $check_rates=false; break; 
          // }

          // if($chp->adult_rate==0) { 
          //   $check_rates=false; break; 
          // }
          
          if($total_adult == 1){
            $sub_rate_adt = $chp->adult_rate;
          } elseif($total_adult == 2){
            $sub_rate_adt = $chp->double_rate;
          } elseif($total_adult == 3){
            $sub_rate_adt = $chp->triple_rate;
          } elseif($total_adult == 4){
            $sub_rate_adt = $chp->quad_rate;
          } elseif($total_adult > 4){
            $sub_rate_adt = ($chp->quad_rate + ($chp->adult_rate*($total_adult-3)));
          }

          $min_night_stay = $chp->min_night_stay;

          $child_rate = $total_child*$chp->child_rate;

          $total_sub_rate = ($sub_rate_adt + $child_rate);
          if($total_sub_rate == 0) { 
            $check_rates = false; break; 
          }
          if(isset($total_cost_arr[$roomDetails[$i]->search_id])) {      
            // $total_cost_arr[$roomDetails[$i]->search_id] = $total_cost_arr[$roomDetails[$i]->search_id] + $chp->room_rate;
            $total_cost_arr[$roomDetails[$i]->search_id] = $total_cost_arr[$roomDetails[$i]->search_id] + $total_sub_rate;
            $cp = $cp+1;       
          } else {        
            // $total_cost_arr[$roomDetails[$i]->search_id] = $chp->room_rate;
            $total_cost_arr[$roomDetails[$i]->search_id] = $total_sub_rate;
            $cp = $cp+1;
          }  
        } 
        $net_fare_arr[$roomDetails[$i]->search_id] = $total_cost_arr[$roomDetails[$i]->search_id];
        $discount_arr[$roomDetails[$i]->search_id] = $roomDetails[$i]->discount;

        // $sup_tax_arr[$roomDetails[$i]->search_id] = $roomDetails[$i]->sup_tax_amt;
        $gov_tax_arr[$roomDetails[$i]->search_id] = $roomDetails[$i]->government_tax;
        $resort_fee_arr[$roomDetails[$i]->search_id] = $roomDetails[$i]->resort_fee;
        $service_tax_arr[$roomDetails[$i]->search_id] = $roomDetails[$i]->service_tax;
      }
      if($cp!=$roomDetails[$i]->nights) { 
        $check_rates=false; break; 
      }
    }

    foreach ($allotment_arr as $key=>$val) {
      $check_allotment= $this->Hotelcrs_Model->check_crs_hotels_room_allotment($key);
      if(empty($check_allotment)) {
        $check_availiablity=false; break;
      }
      if($check_allotment->rooms_available!=-1) { 
        if(($check_allotment->total_booking+$val)>$check_allotment->rooms_available) {
          $check_availiablity=false; break;
        }
      }
    }

    if($check_availiablity && $check_rates) {
        foreach($total_cost_arr as $key=>$val) {
           $tot_cost += $val;
           // $this->Hotelcrs_Model->update_crs_hotels_room_total_cost($key,$sessionId,$hotelCode,$val);   
        }
        if(!empty($net_fare_arr)) {
          foreach($net_fare_arr as $key=>$val)
          {
             $net_cost+=$val;
             // $this->Hotelcrs_Model->update_crs_hotels_room_net_fare($key,$sessionId,$hotelCode,$val);   
          }
        }
        if(!empty($discount_arr)) {
          foreach($discount_arr as $key=>$val) {
              $dis_cost += $val;   
             // $this->Hotelcrs_Model->update_crs_hotels_room_discount($key,$sessionId,$hotelCode,$val);   
          }
        }
        /*if(!empty($sup_tax_arr)) {
          foreach($sup_tax_arr as $key=>$val) {
              $sup_tax_cost += $val;     
          }
        }*/
        if(!empty($gov_tax_arr)) {
          foreach($gov_tax_arr as $key=>$val) {
              $gov_tax_cost += $val;     
          }
        }
        if(!empty($resort_fee_arr)) {
          foreach($resort_fee_arr as $key=>$val) {
              $resort_fee_cost += $val;     
          }
        }
        if(!empty($service_tax_arr)) {
          foreach($service_tax_arr as $key=>$val) {
              $service_tax_cost += $val;     
          }
        }
    }
    // foreach ($allotment_arr as $key=>$val) {
    //   echo '<pre>key';print_r($key);
    //   echo '<pre>val';print_r($val);
    // }
    // echo '<pre>new';print_r($net_fare_arr);//exit;
    // echo '<pre>new';print_r($gov_tax_arr);//exit;
    // echo '<pre>new';print_r($resort_fee_arr);//exit;
    // echo '<pre>new';print_r($service_tax_arr);//exit;
    // echo '<pre>new';print_r($total_cost_arr);//exit;
    // echo '<pre>new';print_r($discount_arr);exit;
    return array($check_availiablity,$check_rates,$net_cost,$tot_cost,$dis_cost,$sup_tax_cost,$gov_tax_cost,$resort_fee_cost,$service_tax_cost,$allotment_arr,$min_night_stay); 
  }



  public function payment_gateway($sessionId, $hotelCode, $searchId) {
        $this->set_variables();

        $data['roomDetails'] = $roomDetails = $this->Hotelcrs_Model->getRoomDetails($this->active_api, $sessionId, $hotelCode, $searchId);

        $pass_info = $this->session->userdata('passenger_info');
        //	if($passenger_info['payment_type'] == 'icici'){ $pay_type='PG';  }else{ $pay_type='deposit';  }
        $totsend = 0;


        $totsend = $roomDetails->total_cost;


        $ip = $_SERVER['REMOTE_ADDR'];
        // $payinsert = array('uniqueRefNo' => $this->uniqueRefNo, 'amount' => $totsend, 'passenger_email' => $pass_info['user_email'], 'passenger_mobile' => $pass_info['user_mobile'], 'service_type' => 1, 'ip' => $_SERVER['REMOTE_ADDR']);
        // $payinsert_id = $this->Hotelcrs_Model->pay_details($payinsert);
        $pay_details = array(
            'callBackId' => 'hotelcrs',
            'searchId' => $searchId,
            'hotelCode' => $hotelCode,
            'sessionId' => $sessionId,
            //  'payinsert_id' => $payinsert_id,
            'uniqueRefNo' => $this->uniqueRefNo,
            'total_cost' => round($totsend),
            'desc' => 'NorthTours Hotel Booking : ' . $this->uniqueRefNo,
            'paytype' => $pass_info['paytype'],
            'passenger_email' => $pass_info['user_email'],
            'passenger_mobile' => $pass_info['user_mobile'],
            'service_type' => 1,
            'ip' => $ip,
            'currency' => 'USD',
            'return_url' => site_url() . "hotels/payment_return",
        );
        $this->session->set_userdata('pay_details', $pay_details);
        redirect('payment/index', 'refresh');


        exit;
    }

    public function deposit_check($roomDetails) {
        $deposit_check_status = 1;
        if ($this->session->userdata('agent_logged_in')) {
            $agent_no = $this->session->userdata('agent_no');
            $agent_type = $this->session->userdata('agent_type');
            $available_balance = $this->Hotelcrs_Model->get_agent_available_balance($agent_no, $agent_type);

            
            $discount = $roomDetails->discount;
            // $sup_tax_amt = $roomDetails->sup_tax_amt;
            $sup_tax_amt = 0;
            $government_tax = $roomDetails->government_tax;
            $resort_fee = $roomDetails->resort_fee;
            $service_tax = $roomDetails->service_tax;

            $total_cost = $roomDetails->total_cost + $sup_tax_amt + $government_tax + $resort_fee + $service_tax - $discount;

            // if ($agent_type == 1) {
            //     // $agent_markup = $roomDetails->di_markup;
            // } elseif ($agent_type == 2 && $this->session->userdata('agent_parent') != 0) {
            //     // $agent_markup = $roomDetails->di_agent_markup;
            // } elseif ($agent_type == 2 && $this->session->userdata('agent_parent') == 0) {
                $agent_markup = $roomDetails->admin_agent_markup;
            // } elseif ($agent_type == 3) {
            //     // $agent_markup = $roomDetails->sub_agent_markup;
            // }
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
        $agent_parent = $this->session->userdata('agent_parent');

        $available_balance = $this->Hotelcrs_Model->get_agent_available_balance($agent_no, $agent_type);
        $available_balance = empty($available_balance) ? 0 : $available_balance;
        $withdraw_amount = $total_price - $agent_markup;
        if ($available_balance < $withdraw_amount) {
            $error = 'Your balance is too low for booking this hotel';
            redirect('hotels/error_page/' . base64_encode($error));
        } else {
            $closing_balance = $available_balance - $withdraw_amount;
            $this->Hotelcrs_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $Sys_RefNo, $agent_type);
        }
    }


    public function executeRequest($request) {
        $httpHeader = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
            "Accept-Encoding: gzip,deflate"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Adding HttpHeader
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

        $response = curl_exec($ch);
        $errors = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }

    // error page
    function error_page($error) {
        $data['error'] = $error;
        $this->load->view('home/error_page', $data);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'VMN' . $randomString;
    }


      public function session_check() {
        $session_data = $this->session->userdata('hotel_search_data');
        if ($this->session->userdata('hotel_search_data') == '') {
            $error = 'Session expired. Please search again.';
            redirect('hotels/error_page/' . base64_encode($error));
        }
    }

    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }

}
