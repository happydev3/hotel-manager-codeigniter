<?php
// error_reporting(E_ALL); 
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Villa extends MX_Controller {
  const RefPrefix = 'VMN';
  private $sess_id;
  private $result_hol;
  public function __construct() {
    parent::__construct();
    $this->load->model('Villa_Model');
    $this->sess_id = $this->session->session_id;
    // $this->load->model('home/Home_Model');
    // $this->load->library('Ajax_pagination');
  }

  function index() {
    $this->load->model('home/Home_Model');
    $data['top_deals']= $this->Home_Model->top_deals();
    $data['popular_destination']= $this->Home_Model->popular_destination();
    $data['country']= $this->Home_Model->get_country();
    $this->load->view('home/index', $data);
  }

  function results($results_id='') {
      // echo '<pre>123'; print_r($_POST);exit;
      if(!isset($_POST['cityName'])&&!empty($results_id)) {
        // echo '<pre>123'; print_r($results_id);exit;
        $this->villaSearchResult($results_id);      
      } else {
        $this->form_validation->set_rules('cityName', 'City Name', 'required|min_length[3]');
        $this->form_validation->set_rules('fromDate', 'From Date', 'required');
        $this->form_validation->set_rules('toDate', 'To Date', 'required');
        $this->form_validation->set_rules('bedrooms', 'Bedrooms', 'required');
        $this->form_validation->set_rules('bathrooms', 'Bathrooms', 'required');
        $this->form_validation->set_rules('guests', 'Guests', 'required');
        if($this->form_validation->run() == FALSE && $this->valid_checkin_date($this->input->post('fromDate')) && $this->valid_checkout_date($this->input->post('toDate'))) {
            // echo valdation_errors();exit;
            $this->load->view('home/index');
        } else {
          // echo '<pre>123'; print_r($_POST);exit;  
          $cityName = $this->input->post('cityName');
          $city_id = $this->input->post('cityid');
          $fromDate = $this->input->post('fromDate');
          $toDate = $this->input->post('toDate');
          $bedrooms = $this->input->post('bedrooms');
          $bathrooms = $this->input->post('bathrooms');
          $guests = $this->input->post('guests');
          
          if (!empty($cityName)) {
            $search_data = '';
            if(!empty($results_id)) {
              if(!empty($ses_id) && !empty($refNo)) {
                $resultstr = base64_decode($results_id);
                $results_arr=explode('/', $resultstr);
                $ses_id=$results_arr[0];
                $refNo=$results_arr[1];
                $villa_search_data = $this->Villa_Model->check_search_data($ses_id,$refNo);
                $search_data = json_decode($villa_search_data->search_data,true);
              }
            }
            /**********   SET SEARCHED DATA VARIABLES  ***************/
            if (!empty($search_data)) {
              $sess_cityName = $search_data['cityName'];
              $sess_fromDate = $search_data['fromDate'];
              $sess_toDate = $search_data['toDate'];
              $sess_bedrooms = $search_data['bedrooms'];
              $sess_bathrooms = $search_data['bathrooms'];
              $sess_guests = $search_data['guests'];

              if($sess_cityName == $cityName && $sess_fromDate == $fromDate && $sess_toDate == $toDate && $sess_bedrooms == $bedrooms && $sess_bathrooms == $bathrooms && $sess_guests == $guests) {
                $uniqueRefNo = $villa_search_data->uniqueRefNo;
                $ses_id = $villa_search_data->session_id;
              } else {
                $uniqueRefNo = $this->generateRandomString(8);
                $ses_id = $this->sess_id;
                $this->Villa_Model->delete_temp_results($this->sess_id);
              }

            } else {
              $uniqueRefNo = $this->generateRandomString(8);
              $ses_id = $this->sess_id;
              $this->Villa_Model->delete_temp_results($this->sess_id);
            }
            $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$fromDate))));
            $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$toDate))));
            $dur = date_diff($date1,$date2,TRUE);
            $duration = $dur->format("%a");
            // $duration = $this->dateDiff($date1, $date2);

            $sess_array = array(
              'uniqueRefNo' => $uniqueRefNo,      
              'cityName'=>$cityName,
              'destination'=>trim($cityName),
              'fromDate'=>$fromDate,
              'toDate'=>$toDate,
              'duration'=>$duration,
              'city_id'=>$city_id,
              'cityCode'=>$city_id,
              'bedrooms' =>$bedrooms,
              'bathrooms'=>$bathrooms,
              'guests'=>$guests
            );
            // echo '<pre>';print_r($sess_array);exit;
            $search_data = json_encode($sess_array,JSON_FORCE_OBJECT);
            $villa_search_data = array(
              'session_id'=>$ses_id,
              'uniqueRefNo'=>$uniqueRefNo,
              'search_data'=>$search_data,
            );
            $this->db->insert('villa_search_data', $villa_search_data);
            redirect('villa/results/'.base64_encode($ses_id.'/'.$uniqueRefNo));
          } else {
            $this->load->view('home/index');
          }
        }
      }
  }

   public function map_filter_ajax() {
      $temp_data = $this->Villa_Model->fetchLocationMap($_POST['ses_id']);
      // echo '<pre>123'; print_r($temp_data);exit;
      $hotels_search_map = '';
      if (!empty($temp_data)) {
        // $hotels_search_map = '<iframe src = "https://maps.google.com/maps?q='.$temp_data->latitude.','.$temp_data->longitude.'&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>';

        $hotels_search_map = '<iframe src="https://maps.google.com/maps?q='.$temp_data->latitude.','.$temp_data->longitude.'&hl=es;z=14&amp;output=embed" height="250" style="width:100%" frameborder="0" style="border:0;margin-bottom: 10px" allowfullscreen></iframe>';
      }
      echo json_encode(array(
        'result' => $hotels_search_map
      ));
    }

  function villaSearchResult($results_id) {
          // echo '<pre>123'; print_r($results_id);exit;
          $resultstr = base64_decode($results_id);
          $results_arr=explode('/', $resultstr);
          $ses_id = $results_arr[0];
          $refNo = $results_arr[1];
          if(!empty($ses_id) && !empty($refNo))
          { 
             $villa_search_data = $this->Villa_Model->check_search_data($ses_id,$refNo);
             
             if(!empty($villa_search_data)) {
                $search_data=json_decode($villa_search_data->search_data,true);
                $api_info = $this->Villa_Model->getActiveAPIs();       
                $api_list = array();
                foreach ($api_info as $api) {
                     $api_list[] = base64_encode($api['api_name']);
                }      
                $data['api_list'] = $api_list;                
                $data['ses_id'] = $ses_id;                
                $data['refNo'] = $refNo;     
                $this->load->view('search_result', $data);
             } else {
                $this->load->view('home/index');
             }
          }      
  }

  function villa_availability() {
      $post_data = $this->input->post(NULL, TRUE);
      if ($post_data != '') {
          if (isset($post_data['callBackId']) && $post_data['callBackId'] != '') {
               $api = base64_decode($post_data['callBackId']);
               $ses_id = ($post_data['ses_id']);
               $refNo = ($post_data['refNo']);                
               $this->load->module('villa/' . $api);
               // echo $api;exit;
              $this->$api->villa_availabilty_search($ses_id,$refNo);
          } else {
              redirect('home/index', 'refresh');
          }
      } else {
          redirect('home/index', 'refresh');
      }
  }

  public function fetch_results() {
      // $datarr = array('villas_available'=> 1);
      // $this->db->where('villas_available', 0);
      // $this->db->update('sup_villa_rates', $datarr);
      // echo $this->db->last_query(); 
      // echo "<pre>"; print_r($_POST);exit;
      $count = 0;     
      $ListMapView=isset($_POST['ListMapView'])?$_POST['ListMapView']:'List';     
      $subdata=array();
      // $filter_details = $this->Villa_Model->get_filter_option_details($_POST['ses_id']);
      $filter_min_price = $this->Villa_Model->get_filter_min_price($_POST['ses_id']);
      $filter_max_price = $this->Villa_Model->get_filter_max_price($_POST['ses_id']);
      $min_price = round($filter_min_price->min_price, 2);
      $max_price = round($filter_max_price->max_price, 2);

      $villa_search_data = $this->Villa_Model->check_search_data($_POST['ses_id'],$_POST['refNo']);
      $search_data = json_decode($villa_search_data->search_data,true);
      $bedrooms = $search_data['bedrooms'];
      $bathrooms = $search_data['bathrooms'];

      // $temp_data = $this->Villa_Model->all_fetch_search_result($_POST['ses_id'], $offset = 0, $this->perPage(),);
      $temp_data = $this->Villa_Model->all_fetch_search_result($_POST['ses_id'],$offset = 0,$this->perPage(),'','','','','','',$bedrooms,$bathrooms,'','');
      // echo $this->db->last_query();
      // echo '<pre/>';print_r($temp_data);exit;
      $villa_search_result = '';
      $count=count($temp_data);
      if (!empty($temp_data)) {
        if ($ListMapView=="Map") {
          $villa_search_result .= '<div class="map-view" id="map-view">';
          $subdata['mapdata'] = $temp_data;
          $villa_search_result .= $this->load->view('villa_crs/search_result_ajax_map', $subdata, TRUE);
          $villa_search_result .= '</div>';
        } else if ($ListMapView=="List") {
          for ($l = 0; $l < $count; $l++) {
             if ($temp_data[$l]->api == 'villa_crs') {
                  $subdata['result'] = $temp_data[$l];
                  $villa_search_result .= $this->load->view('villa_crs/search_result_ajax', $subdata, TRUE);
             }
          }
          // $villa_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
        } else if ($ListMapView=="Grid") {
          $villa_search_result .= '<div class="grid-view">';
          for ($g = 0; $g < $count; $g++) {
             if ($temp_data[$g]->api == 'villa_crs') {
                  $subdata['result'] = $temp_data[$g];
                  $villa_search_result .= $this->load->view('villa_crs/search_result_ajax_grid', $subdata, TRUE);
             }
          }
          $villa_search_result .= '</div>';
          // $villa_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
        }
      } else {
        $villa_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
      }
      echo json_encode(array(
          'villa_search_result' => $villa_search_result,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'search_count'=>$count          
      ));
  }

  public function searchresult_ajax($offset = 0) {
    // echo '<pre>';print_r($_POST); exit;
    $count=0;
    $subdata=array();
    $villa_search_data = $this->Villa_Model->check_search_data($_POST['ses_id'],$_POST['refNo']);
    $search_data = json_decode($villa_search_data->search_data,true);
    $city_id = $search_data['city_id'];
    $bedrooms = $search_data['bedrooms'];
    $bathrooms = $search_data['bathrooms'];
    $pdata['ListMapView']=$ListMapView=isset($_POST['ListMapView'])?$_POST['ListMapView']:'List';

    $pdata['minPrice'] = $minPrice = '';
    $pdata['maxPrice'] = $maxPrice = '';
    if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
        $pdata['minPrice'] = $_POST['minPrice'];
        $pdata['maxPrice'] = $_POST['maxPrice'];
        $minPrice = round($_POST['minPrice'], 2);
        $maxPrice = round($_POST['maxPrice'], 2);
    }
    $pdata['starRating'] = '';
    if (isset($_POST['starRating']) && $_POST['starRating'] != '') {
        $pdata['starRating'] = $_POST['starRating'];
    }
    $pdata['facility'] = '';
    if (isset($_POST['fac']) && $_POST['fac'] != '') {
        $pdata['facility'] = $_POST['fac'];
    }
    $pdata['villaName'] = '';  
    if (isset($_POST['villaName']) && $_POST['villaName'] != '') {
        $pdata['villaName'] = $_POST['villaName'];
    }
    if ($_POST['villaName'] == 'undefined') {
        $pdata['villaName'] = '';
    }
    $pdata['location'] = '';
    if (isset($_POST['location']) && $_POST['location'] != '') {
        $pdata['location'] = $_POST['location'];
    }
    $sortBy = $order = '';
    if (isset($_POST['sortBy']) && $_POST['sortBy'] != '') {
        $sortBy = $_POST['sortBy'];
        $order = $_POST['order'];
    }
    $pdata['sessionId']=$_POST['ses_id'];
    $pdata['TotalRec'] = $this->Villa_Model->TotalSearchResults($pdata['sessionId'],$minPrice, $maxPrice, $pdata['starRating'], $pdata['villaName'],$pdata['facility'],$pdata['location'],$bedrooms,$bathrooms);


    $pdata['perPage'] = $this->perPage();       
    $temp_data = $this->Villa_Model->all_fetch_search_result($pdata['sessionId'], $offset, $this->perPage(), $minPrice, $maxPrice, $pdata['starRating'],$pdata['facility'],$pdata['villaName'], $pdata['location'],$bedrooms,$bathrooms, $sortBy, $order);

    // echo $this->db->last_query();
    // echo '<pre>';print_r($temp_data); exit;

    $priceArr=array();
    $minPr=0;
    if (!empty($temp_data)) {
       $count=count($temp_data);
       for ($i = 0; $i < count($temp_data); $i++) { 
         $priceArr[]=$temp_data[$i]->total_cost;
       }
    }

    if(!empty($priceArr[0])) {
      sort($priceArr);
      $minPr=$priceArr[0];
    }

    $villa_search_result = '';
    $count=count($temp_data);
    if (!empty($temp_data)) {
      if ($ListMapView=="Map") {
        $villa_search_result .= '<div class="map-view" id="map-view">';
        // for ($m = 0; $m < $count; $m++) {
          // if ($temp_data[$m]->api == 'hotel_crs') {
              $subdata['mapdata'] = $temp_data;
              $villa_search_result .= $this->load->view('villa_crs/search_result_ajax_map', $subdata, TRUE);
          // }
        // }
        $villa_search_result .= '</div>';
      } else if ($ListMapView=="List") {
        for ($l = 0; $l < $count; $l++) {
           if ($temp_data[$l]->api == 'villa_crs') {
                $subdata['result'] = $temp_data[$l];
                $villa_search_result .= $this->load->view('villa_crs/search_result_ajax', $subdata, TRUE);
           }
        }
        // $villa_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
      } else if ($ListMapView=="Grid") {
        $villa_search_result .= '<div class="grid-view">';
        for ($g = 0; $g < $count; $g++) {
           if ($temp_data[$g]->api == 'villa_crs') {
                $subdata['result'] = $temp_data[$g];
                $villa_search_result .= $this->load->view('villa_crs/search_result_ajax_grid', $subdata, TRUE);
           }
        }
        $villa_search_result .= '</div>';
        // $villa_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
      }
    } else {
      $villa_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
    }

    echo json_encode(array(
        'villa_search_result' => $villa_search_result,
         'search_count'=>$count,
         'min_price'=>$minPr,
         // 'max_price' => $maxPrice,   
    ));
  }


  public function details($detail_id='') {
    if(!empty($detail_id)) {
      $villa_inquiry = isset($_POST['villa_inquiry'])?$this->input->post('villa_inquiry'):'';
      if($villa_inquiry == 'Send Inquiry'){
        $this->villaEnquiry();
        $this->session->set_flashdata('inquiry','yes');
        redirect('villa/details/'.$detail_id);
      }
      $detailstr = base64_decode($detail_id);
      $details_arr = explode('/', $detailstr);
      // echo '<pre>'; print_r($details_arr);exit;
      $ses_id=$details_arr[0];
      $refNo=$details_arr[1];
      $searchId=$details_arr[2];
      $villaCode=$details_arr[3];
      $callBackId=$details_arr[4];
      if (!empty($ses_id)&&!empty($refNo)&&!empty($villaCode)&&!empty($callBackId)) {
        $api = base64_decode($callBackId);
        $this->load->module('villa/' . $api);
        $this->$api->villa_details($villaCode,$searchId,$ses_id,$refNo);
      } else {
        echo 'Permission Denied';
      }
    } else {
      echo 'Permission Denied';
    }
  }

  public function preview($detail_id='') {
    if(!empty($detail_id)) {
      $villaCode = base64_decode($detail_id);
      $data['villaDetails'] = $this->Villa_Model->getVillaFullDetails($villaCode);
      // echo $this->db->last_query();
      // echo '<pre>'; print_r($data['villaDetails']);exit;
      if (!empty($data['villaDetails'])) {
        $data['galleryimg'] = $this->Villa_Model->get_gallery($villaCode,20);
        // echo $this->db->last_query();
        // echo '<pre>'; print_r($data['galleryimg']);exit;
        $this->load->view('villa_preview', $data);
      } else {
        echo 'Permission Denied';
      }
    } else {
      echo 'Permission Denied';
    }
  }

  public function itinerary() {
    // echo '<pre/>';print_r($_POST);exit;
    if (isset($_POST['callBackId']) && isset($_POST['villaCode']) && isset($_POST['refNo'])) {
      $api = base64_decode($_POST['callBackId']);
      $ses_id = trim($_POST['ses_id']);
      $villaCode = trim($_POST['villaCode']);
      $searchId = trim($_POST['searchId']);
      $refNo = trim($_POST['refNo']);
      $departDate = trim($_POST['departDate']);
      $returnDate = trim($_POST['returnDate']);
      // $guests = trim($_POST['guests']);
      $this->load->module('villa/' . $api);
      $this->$api->villa_itinerary($villaCode,$searchId,$ses_id,$refNo,$departDate,$returnDate);
    } else {
      echo 'Permission Denied';
    }
  }

  public function calcRateAvail() {
    // echo '<pre>';print_r($_POST);exit;
    $departDate = $this->input->post('departDate');
    $returnDate = $this->input->post('returnDate');
    $villaCode = $this->input->post('villaCode');
    $searchId = $this->input->post('searchId');
    $session_id = $this->input->post('session_id');
    $refNo = $this->input->post('refNo');
    $this->load->module('villa/villa_crs');
    // $villadetails2 = $this->Villacrs_Model->get_villa_details('villa_crs', $session_id, $villaCode, $searchId);

    
    $check_rates = $this->villa_crs->checkupdateVillaPrice($searchId,$departDate,$returnDate,$session_id,$refNo,$villaCode);
    $villadetails = $this->Villacrs_Model->get_villa_details('villa_crs', $session_id, $villaCode, $searchId);

   

    $durationInt = $villadetails->duration;
    if($villadetails->price_type == '2') {
      $price_type = 'per week';
      // $durationInt = ceil($durationInt/7);
      // if($durationInt <= 1) {
      //   $durationInt = 1;
      //   $duration = '1 Week';
      // } else{
      //   $duration = $durationInt.' Weeks';
      // }
      $duration = $durationInt.' Nights';
      $priceperrate = $villadetails->price;
      
      $dur = $durationInt - 7; 
      $totalprice = ($villadetails->price + $dur*($villadetails->price/7));
      
    } else  {
      $price_type = 'per night';
      if($durationInt <= 1) {
        $duration = '1 Night';
      } else{
        $duration = $durationInt.' Nights';
      }
      // $duration = $durationInt.' Nights';
      $priceperrate = $villadetails->total_cost/$durationInt;
      $totalprice = $villadetails->total_cost;
    }
    echo json_encode(array(
      'status'=>$check_rates,
      'duration'=>$duration,
      'price_type'=>$price_type,
      'priceperrate'=> number_format($priceperrate),
      'totalprice'=> number_format($totalprice),
    ));
    // echo '<pre>';print_r($villadetails);exit;
  }

  public function reservation() {
    // echo '<pre/>';print_r($_POST);exit;
    if (isset($_POST['callBackId']) && isset($_POST['villaCode']) && isset($_POST['searchId'])) {
      // echo 124; exit;
      $this->session->set_userdata('passenger_info', $_POST);
      $api = base64_decode($_POST['callBackId']);
      $villaCode = trim($_POST['villaCode']);
      $searchId = $_POST['searchId'];
      $sessionId = $_POST['sessionId'];
      $refNo = $_POST['refNo'];
      // $payment_type = $this->input->post('payment_type');
      $this->load->module('villa/' . $api);
      if ($this->session->userdata('agent_logged_in')) {
        $this->$api->villa_reservation($sessionId, $villaCode, $searchId, $refNo);
      } else {
        // $this->$api->villa_reservation($sessionId, $villaCode, $searchId, $refNo);
        $this->$api->payment_process($sessionId, $villaCode, $searchId, $refNo);
      }
    } else {
      echo 'Permission Denied';
    }
  }

  public function voucher1() {
    if (isset($_GET['voucherId'])) {
      $sysRefNo = $_GET['voucherId'];
      $data['result'] = $this->Villa_Model->get_villa_booking($sysRefNo);
      $data['passenger_info'] = $this->Villa_Model->get_villa_pass_info($sysRefNo);
      $usermail = $data['passenger_info'][0]->email;
      $supplier_id =  $data['result']->supplier_id;
      // echo "<pre/>";print_r($supplier_id);exit;
      // $name = $data['passenger_info'][0]->first_name;
      $data['supplier_info'] = $this->Hotels_Model->getSupplierInfo($supplier_id);
      $data_email = array(
        'user_email' => $usermail,
        'supplier_id' =>$supplier_id,
        'subject'=>'Villa Booking',
      );
      $voucher_content =  $this->load->view('voucher_email',$data,true);
      // echo "<pre/>";print_r($data_email);exit;
      $this->load->module('home/sendemail');
      $this->sendemail->ticketing_mail($data_email, $voucher_content);

      redirect('villa/voucher?voucherId='.$sysRefNo);
    } else {
      echo 'Permission Denied';
    }
  }

  public function voucher() {
    if (isset($_GET['voucherId'])) {
      $sysRefNo = $_GET['voucherId'];
      //echo '<pre>';print_r($sysRefNo);exit;
      $data['result'] = $this->Villa_Model->get_villa_booking($sysRefNo);
      $supplier_id =  $data['result']->supplier_id;
      // echo $this->db->last_query();
      $data['passenger_info'] = $this->Villa_Model->get_villa_pass_info($sysRefNo);
      $data['supplier_info'] = $this->Hotels_Model->getSupplierInfo($supplier_id);
      // echo "<pre/>";  print_r($data['result']);exit;
      $this->load->view('voucher', $data);
      // $this->load->view('new_voucher', $data);
    } else {
      echo 'Permission Denied';
    }
  }

  function error_page($error) {
      $data['error'] = $error;
      $this->load->view('error_page', $data);
  }

  // Codeigniter Validation Rules Starts here
  public function cityname_validation($city) {
      $this->form_validation->set_message('cityname_validation', 'The %s field is not valid City or Destination Code');

      preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $city, $out);
      $cityCode = $out[1];

      if (!empty($cityCode))
          return TRUE;
      else
          return FALSE;
  }

  public function valid_checkin_date($date) {
      if (!$this->isDate($date)) {
          $this->form_validation->set_message('valid_checkin_date', 'Invalid {field}. Please use dd/mm/yyyy format.');
          return FALSE;
      }
      $today = strtotime(date('Y-m-d'));
      $checkInDate = strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $date))));
      if ($checkInDate < $today) {
          $this->form_validation->set_message('valid_checkin_date', '{field} must be today or later.');
          return FALSE;
      }
      return TRUE;
  }

  public function valid_checkout_date($date) {
      $journeyDate = $this->input->post('checkIn');
      if (!$this->isDate($date)) {
          $this->form_validation->set_message('valid_checkout_date', 'Invalid {field}. Please use dd/mm/yyyy format.');
          return FALSE;
      }

      $today = strtotime(date('Y-m-d'));
      $checkOutDate = strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $date))));
      $checkInDate = strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $journeyDate))));

      if ($checkOutDate < $today) {
          $this->form_validation->set_message('valid_checkout_date', '{field} date must be today or later.');
          return FALSE;
      }
      if ($checkOutDate <= $checkInDate) {
          $this->form_validation->set_message('valid_checkout_date', '{field} date must be greater than to Check-In date.');
          return FALSE;
      }

      return TRUE;
  }

  function isDate($date) {
      return 1 === preg_match('~^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~', $date);
  }

  public function dateDiff($start, $end) {
      $start_ts = strtotime($start);
      $end_ts = strtotime($end);
      $diff = $end_ts - $start_ts;
      return round($diff / 86400);
  }

  public function perPage() {
    return 15;
  }

  public function searchAjaxData() {
    if(isset($_POST['val'])&&isset($_POST['type'])) {
      $type=$_POST['type'];
      $val=$_POST['val'];
      $villaCode = $val;
      if($type=="maps") {
        $villaDetails = $this->Villa_Model->getVillaDetails($villaCode);
        $result = '<iframe src = "https://maps.google.com/maps?q='.$villaDetails->latitude.','.$villaDetails->longitude.'&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>';
        echo json_encode(array('result'=>$result, 'type'=>'mapTypeId'));
      }else {
        echo json_encode(array('result'=>'','type'=>''));
      }
    } else {
      echo json_encode(array('result'=>'','type'=>''));
    }
  }

  public function booking_request($id=''){
    // echo '<pre/>';print_r($_POST);exit;
    if(empty($_POST['villaCode'])){
      redirect('home/index','refresh');
    }

    $villa_id = $data['villa_id'] = $_POST['villa_id'];

    $data['villadetails'] = $villadetails = $this->Villa_Model->get_villa_package_by_id($villa_id);
    
  // echo '<pre/>';print_r($villadetails);exit;
    $data['departDate'] = $departDate = $this->input->post('departDate');
    $data['returnDate'] = $returnDate = $this->input->post('returnDate');

    $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$departDate))));
    $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$returnDate))));

    $duration = $this->durationCalc($date1, $date2,$villadetails->price_type);

    $data['total_cost'] = $duration*$villadetails->price;
    $data['total_duration'] = $duration;

    // echo '<pre/>';print_r($data);exit;
    
    $data['journeyDate'] = date('d M, Y', strtotime(str_replace('/', '-', $departDate)));
    $data['journeyDate2'] = date('d M, Y', strtotime(str_replace('/', '-', $returnDate)));

    $this->load->view('villa/villa_request', $data);
  }

  public function confirm_request(){
    $villa_param = $this->input->post('villa_param');
    $package_code=$this->input->post('package_code');
    $package_name=$this->input->post('package_name');
    $fname=$this->input->post('GuestFirstName');
    $lname=$this->input->post('GuestLastName');
    $email=$this->input->post('GuestEmailID');
    $tphone=$this->input->post('GuestMobileNo');
    $comments = $this->input->post('comments');
    $email_subscription = $this->input->post('email_subscription');
    if(empty($email_subscription)){
      $email_subscription = 'No';
    }

    $uniqueRefNo = $this->generateRandomString(8);

    $holi_id = explode('-', base64_decode($villa_param));
    $villa_id = $holi_id[1];
    $villadetails = $this->Villa_Model->get_villa_package_by_id($villa_id);

    $data_enquiry = array(
      'uniqueRefNo' => $uniqueRefNo,
      'package_details' => $villadetails->property_name.' ('.$villadetails->property_code.')',
      'user_name' => $fname.' '.$lname,
      'user_email' => $email,
      'user_mobile'=> $tphone,
      'user_message' => $comments,
      'request_date' => date('d M, Y'),
      'email_subscription' => $email_subscription,
      'subject' => 'Villa Booking Request'
    );

    // echo '<pre>';print_r($data_enquiry);//exit;

    $this->load->module('home/sendemail');
    $this->sendemail->send_enquiry($data_enquiry);
    redirect('villa/enquiryThankyou','refresh');
  }

  public function confirm_booking() {
    // echo '<pre>';print_r($_POST);exit;
    $unique_refno = $this->generateRandomString(8);
    $this->session->set_userdata('passenger_info', $_POST);
    $pass_info = $this->session->userdata('passenger_info');
    $ip = $_SERVER['REMOTE_ADDR'];

    $holi_id = explode('-', base64_decode($pass_info['villa_param']));
    $villa_id = $holi_id[1];

    $villadetails = $this->Villa_Model->get_villa_package_by_id($villa_id);

    $departDate = $pass_info['departDate'];
    $returnDate = $pass_info['returnDate'];

    $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$departDate))));
    $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$returnDate))));

    $duration = $this->durationCalc($date1, $date2,$villadetails->price_type);

    if($villadetails->price_type==1) {
      $duration_type = 'per night';
    } else  {
      $duration_type = 'per week';
    }

    // $this->load->module('promotional');  
    // $promotional_arr=$this->promotional->calculate_promo(6, $_POST['total_cost'], $_POST['promo_code']);
    // if($promotional_arr!='') {
    //   $total_cost=$promotional_arr['total_cost'];
    //   $discount_amount=$promotional_arr['discount'];
    // }
    // else {
    $total_cost = $villadetails->price*$duration;
    $discount_amount=0;
    // }

    // $pay_type = 'deposit';
    $pay_type = 'payment_gateway';
    if ($this->session->userdata('user_logged_in')) {
      $user_id = $this->session->userdata('user_id');
      $user_no = $this->session->userdata('user_no');
      $Booking_Done_By = 'user';
      $agent_id = 0;
    } else if ($this->session->userdata('agent_logged_in')) {
      $agent_id = $this->session->userdata('agent_id');
      $Booking_Done_By = 'agent';
      $user_id = 0;
      $pay_type = 'deposit';
      $user_no = '';
    } else {
      $Booking_Done_By = 'guest';
      $agent_id = 0;
      $user_id = 0; 
      $user_no = '';
    }

    $session_data = $this->session->userdata('villa_search_data');

    $search_details = array(
      'service_type'=>9,
      'uniqueRefNo' => $unique_refno,
      'desc'=>'villa Booking',
      'cost' => $total_cost,
      'discount_amount'=>$discount_amount,
      'package_cost'=>$villadetails->price,
      'ip'=>$ip,
      'email'=>$pass_info['GuestEmailID'],
      'contact'=>$pass_info['GuestMobileNo'],
      'name'=>$pass_info['GuestFirstName'].' '.$pass_info['GuestLastName'],
      'callBackId' => ''
    );
    $this->session->set_userdata('search_details', $search_details);
    $search_details = $this->session->userdata('search_details');

    // echo '<pre>';print_r($search_details);exit;
    if($pay_type=='deposit') {
      // pax booking data
      $pax_reports = array(
        'user_id'=>$user_id,
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        'user_email'=>$pass_info['GuestEmailID'],
        'first_name'=>$pass_info['GuestFirstName'],
        'last_name'=>$pass_info['GuestLastName'],
        'user_mobile'=>$pass_info['GuestMobileNo'],
        'user_address'=>$pass_info['GuestAddress'],
        'user_city'=>$pass_info['GuestCity'],
        'user_state'=>$pass_info['GuestState'],
        'user_country'=>$pass_info['GuestCountryCode'],
        'user_pincode'=>$pass_info['GuestPostalCode'],
        'villa_id'=>$villa_id,
        'package_title'=>$villadetails->property_name,
        'guests' => $session_data['guests'],
        'user_ip' => $search_details['ip']
      );

      // echo '<pre>';print_r($pax_reports);//exit;
      $this->Villa_Model->villa_booking_passenger_info($pax_reports);
      // echo $this->db->last_query();exit;

      // booking report data
      $booking_reports = array(
        'user_id'=>$user_id,
        'user_no'=>$user_no,
        'agent_id'=>$agent_id,
        'supplier_id'=>$villadetails->supplier_id,
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        'villa_id'=>$villa_id,
        'package_title'=>$villadetails->property_name,
        'package_code'=>$villadetails->property_code,
        
        'duration_type'=>$duration_type,
        'villa_duration'=>$duration,
        'from_date'=>$pass_info['departDate'],
        'to_date'=>$pass_info['returnDate'],
        'guests' => $session_data['guests'],
        'bedrooms' => $session_data['bedrooms'],
        'bathrooms' => $session_data['bathrooms'],
        'total_cost'=>$search_details['cost'],
        'package_cost'=>$search_details['package_cost'],
        'discount_amount'=>$search_details['discount_amount'],
        // 'promo_code'=>$pass_info['promo_code'],
        'booking_type'=>$pay_type,
        'booking_status'=>'Success'
      );
      // echo '<pre>';print_r($booking_reports);//exit;
      $this->Villa_Model->villa_booking_reports($booking_reports);
      // echo $this->db->last_query();exit;

      // booking villa info data
      $villa_info_report = array(
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        'package_title'=>$villadetails->property_name,
        'package_code'=>$villadetails->property_code,
        'bedrooms' => $session_data['bedrooms'],
        'bathrooms' => $session_data['bathrooms'],
        'duration_type'=>$duration_type,
        'star_rating'=>$villadetails->star_rating,
        'latitude'=>$villadetails->latitude,
        'longitude'=>$villadetails->longitude,
        'currency'=>$villadetails->currency_type,
        'price'=>$villadetails->price,
        'reservation_email'=>$villadetails->reservation_email,
        'cancellation_policy'=>$villadetails->cancellation_policy,
        'terms_and_condition'=>$villadetails->terms_and_condition,
        'imp_info'=>$villadetails->imp_info,
        'city_name'=>$villadetails->city_name,
        'country_name'=>$villadetails->country_name
      );
      // echo '<pre>';print_r($villa_info_report);exit;
      $this->Villa_Model->villa_booking_villa_info($villa_info_report);
      // echo $this->db->last_query();exit;
      redirect('villa/package_voucher1?referId='.$search_details['uniqueRefNo'],'refresh');

    } else if($pay_type=='payment_gateway') {
        redirect('payment/index','refresh');
    }
  }

  public function booking_voucher() {
    $search_details = $this->session->userdata('search_details'); 
    $pass_info = $this->session->userdata('passenger_info');

    $holi_id = explode('-', base64_decode($pass_info['villa_param']));
    $villa_id = $holi_id[1];

    $villadetails = $this->Villa_Model->get_villa_package_by_id($villa_id);

    $departDate = $pass_info['departDate'];
    $returnDate = $pass_info['returnDate'];

    $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$departDate))));
    $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$returnDate))));

    $duration = $this->durationCalc($date1, $date2,$villadetails->price_type);

    if($villadetails->price_type==1) {
      $duration_type = 'per night';
    } else  {
      $duration_type = 'per week';
    }

    $pay_type = 'payment_gateway';
    if ($this->session->userdata('user_logged_in')) {
      $user_id = $this->session->userdata('user_id');
      $user_no = $this->session->userdata('user_no');
      $Booking_Done_By = 'user';
      $agent_id = 0;
    } else {
      $Booking_Done_By = 'guest';
      $agent_id = 0;
      $user_id = 0;
      $user_no = '';
    }

    $session_data = $this->session->userdata('villa_search_data');

    $pax_reports = array(
      'user_id'=>$user_id,
      'uniqueRefNo'=>$search_details['uniqueRefNo'],
      'user_email'=>$pass_info['GuestEmailID'],
      'first_name'=>$pass_info['GuestFirstName'],
      'last_name'=>$pass_info['GuestLastName'],
      'user_mobile'=>$pass_info['GuestMobileNo'],
      'user_address'=>$pass_info['GuestAddress'],
      'user_city'=>$pass_info['GuestCity'],                   
      'user_state'=>$pass_info['GuestState'],
      'user_country'=>$pass_info['GuestCountryCode'],
      'user_pincode'=>$pass_info['GuestPostalCode'],
      'villa_id'=>$villa_id,
      'package_title'=>$villadetails->property_name,
      'guests' => $session_data['guests'],
      'user_ip' => $search_details['ip']
    );

    $this->Villa_Model->villa_booking_passenger_info($pax_reports);

    $booking_reports = array(
      'user_id'=>$user_id,
      'user_no'=>$user_no,
      'agent_id'=>$agent_id,
      'supplier_id'=>$villadetails->supplier_id,
      'uniqueRefNo'=>$search_details['uniqueRefNo'],
      'villa_id'=>$villa_id,
      'package_title'=>$villadetails->property_name,
      'package_code'=>$villadetails->property_code,
      
      'duration_type'=>$duration_type,
      'villa_duration'=>$duration,
      'from_date'=>$pass_info['departDate'],
      'to_date'=>$pass_info['returnDate'],
      'guests' => $session_data['guests'],
      'bedrooms' => $session_data['bedrooms'],
      'bathrooms' => $session_data['bathrooms'],
      'total_cost'=>$search_details['cost'],
      'package_cost'=>$search_details['package_cost'],
      'discount_amount'=>$search_details['discount_amount'],
      // 'promo_code'=>$pass_info['promo_code'],
      'booking_type'=>$pay_type,
      'booking_status'=>'Success'
    );
    // echo '<pre>';print_r($booking_reports);//exit;
    $this->Villa_Model->villa_booking_reports($booking_reports);

    // booking villa info data
    $villa_info_report = array(
      'uniqueRefNo'=>$search_details['uniqueRefNo'],
      'package_title'=>$villadetails->property_name,
      'package_code'=>$villadetails->property_code,
      'bedrooms' => $session_data['bedrooms'],
      'bathrooms' => $session_data['bathrooms'],
      'duration_type'=>$duration_type,
      'star_rating'=>$villadetails->star_rating,
      'latitude'=>$villadetails->latitude,
      'longitude'=>$villadetails->longitude,
      'currency'=>$villadetails->currency_type,
      'price'=>$villadetails->price,
      'reservation_email'=>$villadetails->reservation_email,
      'cancellation_policy'=>$villadetails->cancellation_policy,
      'terms_and_condition'=>$villadetails->terms_and_condition,
      'imp_info'=>$villadetails->imp_info,
      'city_name'=>$villadetails->city_name,
      'country_name'=>$villadetails->country_name
    );
    $this->Villa_Model->villa_booking_villa_info($villa_info_report);

    redirect('villa/package_voucher1?referId='.$search_details['uniqueRefNo'],'refresh');
  }

  public function package_voucher1() {
    $uniqueRefNo = $_GET['referId'];
    $data['result'] = $villa_booking_info = $this->Villa_Model->get_villa_booking($uniqueRefNo);   
    // echo "<pre/>";  print_r($villa_booking_info);exit;
    $data_email = array(
      'user_email'    => $villa_booking_info->user_email,
      'subject'=>'Villa Booking'
    );
    $voucher_content =  $this->load->view('voucher_email',$data,true);
    // echo "<pre/>";print_r($data_email);exit;
    $this->load->module('home/sendemail');
    $this->sendemail->ticketing_mail($data_email, $voucher_content);
    redirect('villa/package_voucher?referId='.$uniqueRefNo,'refresh');
  }

  public function package_voucher() {
    $uniqueRefNo = $_GET['referId'];
    $data['villa_booking_info'] = $data['result'] = $this->Villa_Model->get_villa_booking($uniqueRefNo);
    $this->load->view('voucher',$data);  
  }

  function durationCalc($date1, $date2,$price_type){
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

  function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return 'VMN' . $randomString;
  }

  public function generateReferenceNo($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
    $string = '';
    for ($i = 0; $i < $len; $i++) {
      $pos = rand(0, strlen($chars) - 1);
      $string .= $chars{$pos};
    }
    return self::RefPrefix . $string;
  }

  public function villaEnquiry(){
    $villa_id = $this->input->post('villa_id');
    $package_code=$this->input->post('package_code');
    $package_name=$this->input->post('package_name');
    $fname=$this->input->post('fname');
    $mname=$this->input->post('mname');
    $lname=$this->input->post('lname');
    $email=$this->input->post('email');
    $tphone=$this->input->post('tphone');
    $comments = $this->input->post('comments');
    $email_subscription = $this->input->post('email_subscription');
    if(empty($email_subscription)){
      $email_subscription = 'No';
    }
    $uniqueRefNo = $this->generateRandomString(8);
    $data_enquiry = array(
      'uniqueRefNo' => $uniqueRefNo,
      'package_details' => $package_name.' ('.$package_code.')',
      'user_name'    => $fname.' '.$mname.' '.$lname,
      'subject'     => 'Villa Inquiry',
      'user_email'    => $email,
      'user_mobile'  => $tphone,
      'user_message' => $comments,
      'request_date' => date('d M, Y'),
      'email_subscription' => $email_subscription
    );
    // echo '<pre>';print_r($data_enquiry);exit;
    $this->load->module('home/sendemail');
    $this->sendemail->send_enquiry($data_enquiry);
    // redirect('villa/enquiryThankyou','refresh');
  }

  public function enquiryThankyou(){
    $this->load->view('thankyou');
  }

}