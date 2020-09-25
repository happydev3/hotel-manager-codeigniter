<?php
// error_reporting(E_ALL); 
ini_set('memory_limit', '-1');
//@ini_set('mysql.connect_timeout', 3000);
//@ini_set('default_socket_timeout', 3000);

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Holiday extends MX_Controller {
  const RefPrefix = 'VMN';
  private $sess_id;
  private $result_hol;
  public function __construct() {
    parent::__construct();
    $this->load->model('Holiday_Model');
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

  public function results($results_json=''){
    $results_json = isset($_GET['data'])?$_GET['data']:'';
    if($results_json!=''){
      $request_data = unserialize(urldecode($results_json));
      // echo '<pre/>';print_r($request_data);exit;
      $cityName = isset($request_data['cityName'])?$request_data['cityName']:'';     
      $months= isset($request_data['months'])?$request_data['months']:'';
      $fromDate = isset($request_data['fromDate'])?$request_data['fromDate']:'';
      $toDate = isset($request_data['toDate'])?$request_data['toDate']:'';
      $holiduration=isset($request_data['holiduration'])?$request_data['holiduration']:''; 
      $city_id=isset($request_data['city_id'])?$request_data['city_id']:'';  
      $theme_arr=isset($request_data['theme_arr'])?$request_data['theme_arr']:'';
      $region_arr=isset($request_data['region_arr'])?implode(',',$request_data['region_arr']):'';
      if(!empty($city_id)) {
        $sess_data = array(
          'cityName'=>$cityName,
          'destination'=>trim($cityName),
          'holiduration' => $holiduration,
          'fromDate'=>$fromDate,
          'toDate'=>$toDate,
          'city_id'=>$city_id,
          'months' =>$months,
          'theme_arr'=>$theme_arr,
          'region_arr'=>$region_arr
        );
        $this->session->set_userdata('holiday_search_data', $sess_data);
      }
      $sess_data = $this->session->userdata('holiday_search_data');
      $data['result'] = $result = $this->Holiday_Model->search_holiday_package_result($sess_data['city_id'],$sess_data['fromDate'],$sess_data['toDate']);
      // echo '<pre/>';print_r($sess_data);exit;
      $data['cities'] = array(); $data['durations'] = array(); $data['themes'] = array();
      if(!empty($result)){
        $destis = array();$durs = array();$themes = array();
        foreach ($result as $res) {
          $destis[] = $res->destination;
          $durs[] = $res->duration;
          $themes[] = $res->theme_id;
        }
        
        $cities = array();
        $destinations = array_unique(explode(',', implode(',', $destis)));
        foreach($destinations as $desti){
          $cities[$desti] = $this->Holiday_Model->get_city_name($desti);
        }
        $data['cities'] = $cities;

        $themes_arr = array();
        $themes_arr_unique = array_unique(explode(',', implode(',', $themes)));
        foreach($themes_arr_unique as $them){
          $themes_arr[$them] = $this->Holiday_Model->get_theme_name($them);
        }
        $data['themes'] = $themes_arr;
        // echo '<pre/>';print_r($data['themes']);exit;
        $data['durations'] = $durations = array_unique(explode(',', implode(',', $durs)));
        asort($durations);
      }
      // echo '<pre/>';print_r($durations);exit;
      $this->load->view('holiday/search_result',$data);
    } else {
      $this->holidaysearch();
    }
  }

  public function holidaysearch() {
    // echo '<pre>';print_r($_POST);exit;
    $cityName = isset($_REQUEST['cityName'])?$_REQUEST['cityName']:'';     
    $months= isset($_REQUEST['months'])?$_REQUEST['months']:'';
    $fromDate = isset($_REQUEST['fromDate'])?$_REQUEST['fromDate']:'';
    $toDate = isset($_REQUEST['toDate'])?$_REQUEST['toDate']:'';
    $holiduration=isset($_REQUEST['holiduration'])?$_REQUEST['holiduration']:''; 
    $city_id=isset($_REQUEST['cityid'])?$_REQUEST['cityid']:'';  
    $theme_arr=isset($_REQUEST['theme_arr'])?$_REQUEST['theme_arr']:'';
    $region_arr=isset($_REQUEST['region_arr'])?implode(',',$_REQUEST['region_arr']):'';

    $arr = array(
      'cityName'=>$cityName,
      'destination'=>trim($cityName),
      'holiduration' => $holiduration,
      'fromDate'=>$fromDate,
      'toDate'=>$toDate,
      'city_id'=>$city_id,
      'months' =>$months,
      'theme_arr'=>$theme_arr,
      'region_arr'=>$region_arr
    );
    $query = serialize($arr);
    $url=urlencode($query); 
    redirect("holiday/results?data=".$url);
    // print_r($_POST); exit;
  }

  public function fetch_results() {

    $holiday_search_data = $this->session->userdata('holiday_search_data');
    // print_r($holiday_search_data);//exit;

    // $holiduration = $holiday_search_data['holiduration'];            
    $city_id = $holiday_search_data['city_id'];
    // $theme_arr = $holiday_search_data['theme_arr'];
    $fromDate = $holiday_search_data['fromDate'];
    $toDate = $holiday_search_data['toDate'];

    $result = $this->Holiday_Model->search_holiday_package_result($city_id,$fromDate,$toDate);
    $subdata['result'] = $result;
    $subdata['cityName'] = $holiday_search_data['cityName'];

    // echo $this->db->last_query();
    // echo '<pre/>';print_r($subdata['result']);exit;

    $holiday_search_result = '';   
    if (!empty($result)) {
      $holiday_search_result .= $this->load->view('search_result_ajax', $subdata, TRUE);
      $cnt=count($result);
    } else {
      $holiday_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
      $cnt=0;
    }
    echo json_encode(array(
      'holiday_search_result' => $holiday_search_result,
      'search_count'=> $cnt,
    ));
  }

  public function searchresult_ajax($offset = 0) {
    // echo'<pre/>';print_r($_POST);//exit;
    /*
      $minPrice = $_POST['minPrice'];   
      $maxPrice = $_POST['maxPrice'];
      $minDur = $_POST['minDur'];
      $maxDur = $_POST['maxDur'];
      $minRating = $_POST['minRating'];
      $maxRating = $_POST['maxRating'];
      // $minTemp = $_POST['minTemp'];
      // $maxTemp = $_POST['maxTemp'];
      $categoryVal = $_POST['categoryVal'];
      $regionVal = $_POST['regionVal'];
      $themeids = $_POST['themeVal'];
      $monthVal = $_POST['monthVal'];
      $sortBy = $_POST['sortBy'];
      $order = $_POST['order'];
    */

    $themeids = $_POST['themeVal'];
    $cityids = $_POST['cityVal'];
    $durations = $_POST['durationVal'];

    $holiday_search_data = $this->session->userdata('holiday_search_data');

    $themeVal = (!empty($themeids))?$themeids:$holiday_search_data['theme_arr'];
    $cityVal = (!empty($cityids))?$cityids:$holiday_search_data['city_id'];
    // $durationVal = (!empty($durations))?$durations:$holiday_search_data['holiduration'];
    $durationVal = (!empty($durations))?$durations:'';

    // echo'<pre/>';print_r($durationVal);exit;

    $result = $this->Holiday_Model->search_holiday_package_filter_results($cityVal,$durationVal,$themeVal);
    // echo $this->db->last_query();
    // echo'<pre/>';print_r($result);exit;
    $holiday_search_result = '';            
    $subdata['result'] = $result; 
    if ($result!=='') {
      $holiday_search_result .= $this->load->view('search_result_ajax', $subdata, TRUE);
      $cnt=count($result);
    } else {
      $holiday_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
      $cnt=0;
    }
    echo json_encode(array(
      'holiday_search_result' => $holiday_search_result,
      'search_count' => $cnt
      //'paging' => $paging
    ));
  }

  public function holidaydetails($id='') {
    if(empty($id)){
      redirect('home/index','refresh');
    }
    $data['holiday_param'] = $id;
    $holi_id = explode('-', base64_decode($id));
    $id = $holi_id[1];
    $data['holiday_id'] = $id;
    
    // echo '<pre/>';print_r($holi_id);exit;
    $data['galleryimg'] = $this->Holiday_Model->get_gallery($id,15);
    
    $data['package_details'] = $package_details = $this->Holiday_Model->get_holiday_package_by_id($id);
    // echo $this->db->last_query();
    // echo '<pre/>';print_r($data['package_details']);exit;

    // $data['package_itinerary'] =$package_itinerary= $this->Holiday_Model->get_holiday_package_itinerary_by_id($id);
    // $data['package_itinerary_images'] =$package_itinerary= $this->Holiday_Model->get_holiday_package_itinerary_images_by_id($id);

    $themelist = $this->Holiday_Model->get_all_theme_name();
    $themelistarrary = array();
    for($l=0;$l<count($themelist);$l++) {   
      $themelistarrary[$themelist[$l]->theme_id] = $themelist[$l]->theme_name;
    }
    $data['themelistarrary'] = $themelistarrary;

    $holiday_search_data = $this->session->userdata('holiday_search_data');           
    $city_id = $holiday_search_data['city_id'];
    $data['similar_result'] = $this->Holiday_Model->getSimialrPackages($city_id,$id);

    $holiday_search_data = $this->session->userdata('holiday_search_data');
    $fromDate = $holiday_search_data['fromDate'];
    $toDate = $holiday_search_data['toDate'];
    // $data['holiday_activity'] = $this->Holiday_Model->getActivities($id, $fromDate, $toDate);
    $data['meeting_points'] = $this->Holiday_Model->getMeetingPoints($id);
    // echo $this->db->last_query();
    // echo '<pre/>';print_r($data['meeting_points']);exit;

    $data['holiday_search_data'] = $this->session->userdata('holiday_search_data');
    $this->load->view('holiday/holiday_details',$data);  
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

  public function holidayEnquiry(){
    $holiday_id=$this->input->post('holiday_id');
    $package_code=$this->input->post('package_code');
    $package_name=$this->input->post('package_name');
    $fname=$this->input->post('fname');
    $mname=$this->input->post('mname');
    $lname=$this->input->post('lname');
    $email=$this->input->post('email');
    $tphone=$this->input->post('tphone');
    $no_of_adults = $this->input->post('no_of_adults');
    $no_of_children = $this->input->post('no_of_children');
    $comments = $this->input->post('comments');

    $data_enquiry = array(
      'holiday_id'    => $holiday_id,
      'package_code'    => $package_code,
      'package_name'    => $package_name,
      'firstname'    => $fname,
      'middlename'   => $mname,
      'lastname'    => $lname,
      'subject'     => 'Holiday Enquiry Form',
      'email'    => $email,
      'telephone'  => $tphone,
      'no_of_adults' => $no_of_adults,
      'no_of_children'  => $no_of_children,
      'comments' => $comments
    );

    // echo '<pre>';print_r($data_enquiry);

    $this->load->module('home/sendemail');
    $this->sendemail->send_enquiry($data_enquiry);
    redirect('holiday/enquiryThankyou','refresh');
  }

  public function enquiryThankyou(){
    $this->load->view('thankyou');
  }

  public function showAvailability(){
    // echo '<pre>';print_r($_POST);//exit;
    $showdata['departDate'] = $this->input->post('departDate');
    $showdata['adults'] = $this->input->post('adults');
    $showdata['childs'] = isset($_POST['childs']) ? $this->input->post('childs') : 0;
    $showdata['seniors'] = isset($_POST['seniors']) ? $this->input->post('seniors') : 0;
    // $infants = $this->input->post('infants');
    $showdata['holiday_param'] = $this->input->post('holiday_param');

    $availability = $this->load->view('show_availability', $showdata, TRUE);
    echo json_encode(array(
      'availability' => $availability
    ));
  }

  public function holiday_itinerary($id=''){
    if(empty($id)){
      redirect('home/index','refresh');
    }
    $data['holiday_param'] = $id;
    $holi_id = explode('-', base64_decode($id));
    $data['holiday_id'] = $holiday_id = $holi_id[1];

    $activity_id = $this->input->post('activity_id');
    $data['adults_no']=$this->input->post('adults_no');
    $data['childs_no']=$this->input->post('childs_no');
    $data['seniors_no']=$this->input->post('seniors_no');
    // $data['adults_cost']=$this->input->post('adults_cost');
    // $data['childs_cost']=$this->input->post('childs_cost');
    // $data['seniors_cost']=$this->input->post('seniors_cost');
    $data['departDate']=$this->input->post('departDate');
    $data['total_cost']=$this->input->post('total_cost');

    $data['journeyDate'] = date('d M, Y', strtotime(str_replace('/', '-', $data['departDate'])));

    $data['holidaydetails'] = $this->Holiday_Model->get_holiday_package_by_id($holiday_id);
    $data['activities'] = $this->Holiday_Model->getActivitiesByid($activity_id);
    $data['country_list'] = $this->Holiday_Model->get_country_fulllist();
    // echo '<pre>11';print_r($data['activities']);exit;
    $this->load->view('holiday/holiday_itinerary', $data);
  }

  public function confirm_booking() {
    // echo '<pre>';print_r($_POST);//exit;
    $unique_refno = $this->generateRandomString(8);
    $this->session->set_userdata('passenger_info', $_POST);
    $pass_info = $this->session->userdata('passenger_info'); 
    $ip = $_SERVER['REMOTE_ADDR'];

    $holi_id = explode('-', base64_decode($pass_info['holiday_param']));
    $holiday_id = $holi_id[1];

    $holidaydetails = $this->Holiday_Model->get_holiday_package_by_id($holiday_id);
    $activities = $this->Holiday_Model->getActivitiesByid($pass_info['activity_id']);

    // echo '<pre>';print_r($activities);exit;
    $total_price = ($pass_info['adults_no']*$activities->price_adt) + ($pass_info['childs_no']*$activities->price_chd) + ($pass_info['seniors_no']*$activities->price_sen);

    $discount_type = $holidaydetails->discount_type;
    $discount = $holidaydetails->discount_price;
    if($discount_type == 0){
      $discount_price = 0;
    }elseif($discount_type == 1){
      $discount_price = $discount;
    }elseif($discount_type == 2){
      $discount_price = ($discount*$total_price)/100;
    }
    $total_discount = $discount_price;
    
    $sub_total = $total_price - $total_discount;

    // $this->load->module('promotional');  
    // $promotional_arr=$this->promotional->calculate_promo(6, $_POST['total_cost'], $_POST['promo_code']);
    // if($promotional_arr!='') {
    //   $total_cost=$promotional_arr['total_cost'];
    //   $discount_amount=$promotional_arr['discount'];
    // }
    // else {
    $total_cost = $sub_total;
    $discount_amount=$total_discount;
    // }

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

    $search_details = array(
      'service_type'=>6,
      'uniqueRefNo' => $unique_refno,
      'desc'=>'Holiday Booking',
      'cost' => $total_cost,
      'discount_amount'=>$discount_amount,
      'package_cost'=>$total_price,
      'ip'=>$ip,
      'email'=>$pass_info['GuestEmailID'],
      'contact'=>$pass_info['GuestMobileNo'],
      'name'=>$pass_info['GuestFirstName'].' '.$pass_info['GuestLastName'],
      'callBackId' => ''
    );
    $this->session->set_userdata('search_details', $search_details);
    $search_details = $this->session->userdata('search_details');

    
    // $data['activities'] = $this->Holiday_Model->getActivitiesByid($activity_id);

    // echo '<pre>';print_r($search_details);exit;
    if($pay_type=='deposit') {
      // pax booking data
      // for($i=0;$i<count($pass_info['fname']);$i++) {
        $pax_reports = array(
          // 'holi_pass_id'=>'',
          'user_id'=>$user_id,
          'uniqueRefNo'=>$search_details['uniqueRefNo'],
          // 'passenger_type'=>$pass_info['passengertype'][$i],
          // 'title'=>$pass_info['title'][$i],
          'first_name'=>$pass_info['GuestFirstName'],
          // 'middle_name'=>$pass_info['GuestEmailID'][$i],
          'last_name'=>$pass_info['GuestLastName'],
          // 'dob'=>$pass_info['dob'][$i],
          'holiday_id'=>$holiday_id,
          'package_title'=>$holidaydetails->package_title,
          // 'holiday_duration'=>$pass_info['holiday_duration'],
          // 'month_duration'=>$pass_info['month_duration'],
          // 'arrival_date'=>$pass_info['arrival_date'],
          'depart_date'=>$pass_info['departDate'],
        );

        // echo '<pre>';print_r($pax_reports);//exit;
        $this->Holiday_Model->holiday_booking_passenger_info($pax_reports);
        // echo $this->db->last_query();exit;
      // }

      // booking report data
      $booking_reports = array(
        'user_id'=>$user_id,
        'user_no'=>$user_no,
        'agent_id'=>$agent_id,
        'supplier_id'=>$holidaydetails->supplier_id,
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        'user_email'=>$pass_info['GuestEmailID'],
        // 'title'=>$pass_info['title'],
        'first_name'=>$pass_info['GuestFirstName'],
        'last_name'=>$pass_info['GuestLastName'],
        'user_mobile'=>$pass_info['GuestMobileNo'],
        'address'=>$pass_info['GuestAddress'],
        'user_city'=>$pass_info['GuestCity'],                   
        'user_state'=>$pass_info['GuestState'],
        'user_country'=>$pass_info['GuestCountryCode'],
        // 'user_comment'=>$pass_info['comment'],
        'user_pincode'=>$pass_info['GuestPostalCode'],
        'adults_no'=>$pass_info['adults_no'],
        'childs_no'=>$pass_info['childs_no'],
        'seniors_no'=>$pass_info['seniors_no'],
        'holiday_id'=>$holiday_id,
        'package_title'=>$holidaydetails->package_title,
        'package_code'=>$holidaydetails->package_code,
        // 'holiday_duration'=>$pass_info['holiday_duration'],
        // 'month_duration'=>$pass_info['month_duration'],
        // 'arrival_date'=>$pass_info['arrival_date'],
        'depart_date'=>$pass_info['departDate'],
        // 'accommodation_type'=>$pass_info['accommodation_type'],
        // 'single_room_no'=>$pass_info['single_room_no'],
        // 'twin_room_no'=>$pass_info['twin_room_no'],
        // 'triple_room_no'=>$pass_info['triple_room_no'],
        // 'room_details'=>$pass_info['room_details'],
        // 'room_count'=>$pass_info['room_no'],
        'total_cost'=>($search_details['cost']),
        'package_cost'=>$search_details['package_cost'],
        'discount_amount'=>$search_details['discount_amount'],
        // 'promo_code'=>$pass_info['promo_code'],
        'booking_type'=>$pay_type,
        'booking_status'=>'Success',
      );
      // echo '<pre>';print_r($booking_reports);//exit;
      $this->Holiday_Model->holiday_booking_reports($booking_reports);
      // echo $this->db->last_query();exit;

      // booking holiday info data
      $holiday_info_report = array(
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        'user_email'=>$pass_info['GuestEmailID'],
        'user_mobile'=>$pass_info['GuestMobileNo'],
        'first_name'=>$pass_info['GuestFirstName'],
        'last_name'=>$pass_info['GuestLastName'],
        'package_title'=>$holidaydetails->package_title,
        'package_code'=>$holidaydetails->package_code,
        // 'holiday_duration'=>$pass_info['holiday_duration'],
        'booking_status' => 'Success',
      );
      $this->Holiday_Model->holiday_booking_holiday_info($holiday_info_report);
      // echo $this->db->last_query();exit;
      redirect('holiday/package_voucher1?referId='.$search_details['uniqueRefNo'],'refresh');

    } else if($pay_type=='payment_gateway') {
        redirect('payment/index','refresh');
    }
  }

  public function booking_voucher() {
    $search_details = $this->session->userdata('search_details'); 
    $pass_info = $this->session->userdata('passenger_info');

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
    $holi_id = explode('-', base64_decode($pass_info['holiday_param']));
    $holiday_id = $holi_id[1];
    $holidaydetails = $this->Holiday_Model->get_holiday_package_by_id($holiday_id);
    // $activities = $this->Holiday_Model->getActivitiesByid($activity_id);

    // for($i=0;$i<count($pass_info['fname']);$i++) {
      $pax_reports = array(
        'user_id'=>$user_id,
        'uniqueRefNo'=>$search_details['uniqueRefNo'],
        // 'passenger_type'=>$pass_info['passengertype'][$i],
        // 'title'=>$pass_info['title'][$i],
        'first_name'=>$pass_info['GuestFirstName'],
        // 'middle_name'=>$pass_info['GuestEmailID'][$i],
        'last_name'=>$pass_info['GuestLastName'],
        // 'dob'=>$pass_info['dob'][$i],
        'holiday_id'=>$holiday_id,
        'package_title'=>$holidaydetails->package_title,
        // 'holiday_duration'=>$pass_info['holiday_duration'],
        // 'month_duration'=>$pass_info['month_duration'],
        // 'arrival_date'=>$pass_info['arrival_date'],
        'depart_date'=>$pass_info['departDate'],
      );
      $this->Holiday_Model->holiday_booking_passenger_info($pax_reports);
    // }

    $booking_reports = array(
      'user_id'=>$user_id,
      'user_no'=>$user_no,
      'agent_id'=>$agent_id,
      'supplier_id'=>$holidaydetails->supplier_id,
      'uniqueRefNo'=>$search_details['uniqueRefNo'],
      'user_email'=>$pass_info['GuestEmailID'],
      // 'title'=>$pass_info['title'],
      'first_name'=>$pass_info['GuestFirstName'],
      'last_name'=>$pass_info['GuestLastName'],
      'user_mobile'=>$pass_info['GuestMobileNo'],
      'address'=>$pass_info['GuestAddress'],
      'user_city'=>$pass_info['GuestCity'],                   
      'user_state'=>$pass_info['GuestState'],
      'user_country'=>$pass_info['GuestCountryCode'],
      // 'user_comment'=>$pass_info['comment'],
      'user_pincode'=>$pass_info['GuestPostalCode'],
      'adults_no'=>$pass_info['adults_no'],
      'childs_no'=>$pass_info['childs_no'],
      'seniors_no'=>$pass_info['seniors_no'],
      'holiday_id'=>$holiday_id,
      'package_title'=>$holidaydetails->package_title,
      'package_code'=>$holidaydetails->package_code,
      // 'holiday_duration'=>$pass_info['holiday_duration'],
      // 'month_duration'=>$pass_info['month_duration'],
      // 'arrival_date'=>$pass_info['arrival_date'],
      'depart_date'=>$pass_info['departDate'],
      // 'accommodation_type'=>$pass_info['accommodation_type'],
      // 'single_room_no'=>$pass_info['single_room_no'],
      // 'twin_room_no'=>$pass_info['twin_room_no'],
      // 'triple_room_no'=>$pass_info['triple_room_no'],
      // 'room_details'=>$pass_info['room_details'],
      // 'room_count'=>$pass_info['room_no'],
      'total_cost'=>($search_details['cost']),
      'package_cost'=>$search_details['package_cost'],
      'discount_amount'=>$search_details['discount_amount'],
      // 'promo_code'=>$pass_info['promo_code'],
      'booking_type'=>$pay_type,
      'booking_status'=>'Success',
    );
    // echo '<pre>';print_r($booking_reports);//exit;
    $this->Holiday_Model->holiday_booking_reports($booking_reports);

    // booking holiday info data
    $holiday_info_report = array(
      'uniqueRefNo'=>$search_details['uniqueRefNo'],
      'user_email'=>$pass_info['GuestEmailID'],
      'user_mobile'=>$pass_info['GuestMobileNo'],
      'first_name'=>$pass_info['GuestFirstName'],
      'last_name'=>$pass_info['GuestLastName'],
      'package_title'=>$holidaydetails->package_title,
      'package_code'=>$holidaydetails->package_code,
      'operated_by'=>$holidaydetails->operated_by,
      'operator_no'=>$holidaydetails->operator_no,
      'emergency_no'=>$holidaydetails->emergency_no,
      'cancellation_policy'=>$holidaydetails->cancellation_policy,
      // 'holiday_duration'=>$pass_info['holiday_duration'],
      'booking_status' => 'Success',
    );
    $this->Holiday_Model->holiday_booking_holiday_info($holiday_info_report);

    redirect('holiday/package_voucher1?referId='.$search_details['uniqueRefNo'],'refresh');
  }

  public function package_voucher1() {
    if (isset($_GET['referId'])) {
      $uniqueRefNo = $_GET['referId'];
      $data['result'] = $holiday_booking_info = $this->Holiday_Model->get_holiday_booking($uniqueRefNo);
      // $data['supplier_info'] = $this->Holiday_Model->getSupplierInfo($holiday_booking_info->supplier_id);
      // echo "<pre/>";  print_r($holiday_booking_info);exit;
      if(!empty($holiday_booking_info)){
        $data_email = array(
          'user_email'  => $holiday_booking_info->user_email,
          'supplier_id' =>$holiday_booking_info->supplier_id,
          'subject'=>'Holiday Booking'
        );
        $voucher_content =  $this->load->view('voucher_email',$data,true);
        // echo "<pre/>";print_r($data_email);exit;
        $this->load->module('home/sendemail');
        $this->sendemail->ticketing_mail($data_email, $voucher_content);
        redirect('holiday/package_voucher?referId='.$uniqueRefNo,'refresh');
      } else {
        echo 'Permission Denied';
      }
    } else {
      echo 'Permission Denied';
    }
  }

  public function package_voucher() {
    $uniqueRefNo = $_GET['referId'];
    $data['holiday_booking_info'] = $data['result'] = $this->Holiday_Model->get_holiday_booking($uniqueRefNo);
    // $data['supplier_info'] = $this->Holiday_Model->getSupplierInfo($data['holiday_booking_info']->supplier_id);
    $this->load->view('voucher',$data);  
  }

  public function preview_holiday($id='') {
    if(empty($id)){
      redirect('home/index','refresh');
    }
    $holiday_id = base64_decode($id);
    $data['holiday_id'] = $holiday_id;
    // echo '<pre/>';print_r($holi_id);exit;
    $data['galleryimg'] = $this->Holiday_Model->get_gallery($holiday_id,20);
    $data['package_details'] = $this->Holiday_Model->get_all_holiday_package_by_id($holiday_id);
    // echo $this->db->last_query();
    // echo '<pre/>';print_r($data['package_details']);exit;

    $themelist = $this->Holiday_Model->get_all_theme_name();
    $themelistarrary = array();
    for($l=0;$l<count($themelist);$l++) {   
      $themelistarrary[$themelist[$l]->theme_id] = $themelist[$l]->theme_name;
    }
    $data['themelistarrary'] = $themelistarrary;

    $this->load->view('holiday/preview_holiday',$data);  
  }

}