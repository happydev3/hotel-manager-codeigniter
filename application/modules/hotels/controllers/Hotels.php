<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Hotels extends MX_Controller  {

    private $sess_id;

    function __construct() 
    {
        parent::__construct();
        $this->load->model('Hotels_Model');
        $this->load->model('home/Home_Model');
        // $this->load->model('hotel_crs/hotelcrs_model');
        // $this->load->library('Ajax_pagination');
        if ($this->session->session_id == '')
        {
            redirect('home/index', 'refresh');
        }
         $this->sess_id = $this->session->session_id;
    }

    function index() 
    {
      $data['country']= $this->Home_Model->get_country();
      $data['top_deals']= $this->Home_Model->top_deals();
      // echo '<pre>';print_r($data['top_deals']);exit;
      $data['popular_destination']= $this->Home_Model->popular_destination();
      $this->load->view('home/index', $data);
    }
    
   
    function results($results_id='') {
       // echo '<pre>123'; print_r($_POST);exit;
      if(!isset($_POST['cityName'])&&!empty($results_id)) {
        // echo '<pre>123'; print_r($results_id);exit;
        $this->hotelSearchResult($results_id);      
      } else {
        $this->form_validation->set_rules('cityName', 'City Name', 'required|min_length[3]');
        $this->form_validation->set_rules('checkIn', 'Check-In Date', 'required');
        $this->form_validation->set_rules('checkOut', 'Check-Out Date', 'required');
        if($this->form_validation->run() == FALSE && $this->valid_checkin_date($this->input->post('checkIn')) && $this->valid_checkout_date($this->input->post('checkOut'))) {
            echo validation_errors();exit;
            $this->load->view('home/index');
        } else {
           // echo '<pre>123'; print_r($_POST);exit;
          $cityName = $this->input->post('cityName');
          $cityCode = $this->input->post('cityid');
          $checkIn = $this->input->post('checkIn');
          $checkOut = $this->input->post('checkOut');
          $nationality = $this->input->post('nationality');      
          $room_count = $this->input->post('room_count');
          $adults_arr = $this->input->post('adults');
          $childs_arr = $this->input->post('childs');             
          $infant = isset($_POST['infant'])?1:'';             
          $adultList = array_slice((array)$adults_arr, 0, $room_count);
          $childList = array_slice((array)$childs_arr, 0, $room_count);
          $adults = $adultList;
          $childs = $childList;           
          $adults_count = array_sum($adultList);
          $childs_count = array_sum($childList);
          $check_child_age = array_sum($childList);
          // echo '<pre>'; print_r($adults);//exit;
          // echo '<pre>'; print_r($check_child_age);exit;
          $ages = array();
          if ($check_child_age >= 1) {
            for ($r = 0; $r < $room_count; $r++) {
              $childNo = $childs[$r];
              $childs_ages_arr = $this->input->post('childs_ages_room' . ($r + 1));
              $ages_arr = array();
              for ($l = 0; $l < $childNo; $l++) {
                if ($childs_ages_arr) {
                  $ages_arr[$l] = $childs_ages_arr[$l];
                } else {
                  $ages_arr[$l] = '';
                }
              }
              if (!empty($ages_arr)) {
                $ages[] = implode(',', $ages_arr);
              } else {
                $ages[] = 0;
              }
            }
          }
          // echo '<pre>'; print_r($ages);exit;
          $childs_ages = $ages;
          if (!empty($cityName)) {
            $search_data='';
            if(!empty($results_id)) {
              if(!empty($ses_id) && !empty($refNo)) {
              $resultstr = base64_decode($results_id);
              $results_arr=explode('/', $resultstr);
              $ses_id=$results_arr[0];
              $refNo=$results_arr[1];
              $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
              $search_data=json_decode($hotel_search_data->search_data,true);
              }
            }
            /**********   SET SEARCHED DATA VARIABLES  ***************/
            if (!empty($search_data)) {
              $sess_cityName = $search_data['cityName'];
              $sess_checkIn = $search_data['checkIn'];
              $sess_checkOut = $search_data['checkOut'];
              $sess_nationality = $search_data['nationality'];
              $sess_rooms = $search_data['rooms'];
              $sess_adults = $search_data['adults'];
              $sess_childs = $search_data['childs'];
              $sess_childs_ages = $search_data['childs_ages'];
              $sess_infant = $search_data['infant'];
              if($sess_cityName == $cityName && $sess_checkIn == $checkIn && $sess_checkOut == $checkOut && $sess_nationality == $nationality && $sess_rooms == $room_count && $sess_adults == $adults && $sess_childs == $childs && $sess_childs_ages == $childs_ages&& $sess_infant == $infant)
              {
                $uniqueRefNo = $hotel_search_data->uniqueRefNo;
                $ses_id=$hotel_search_data->session_id;
              } else {
                $uniqueRefNo = $this->generateRandomString(8);
                $ses_id=$this->sess_id;
                $this->Hotels_Model->delete_temp_results($this->sess_id);
                $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
              }

            } else {
              $uniqueRefNo = $this->generateRandomString(8);
              $ses_id=$this->sess_id;
              $this->Hotels_Model->delete_temp_results($this->sess_id);
              $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
            }
            $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
            $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
            $nights = $this->dateDiff($cin, $cout);
            $sess_array = array(
              'cityName' => $cityName,
              'cityCode' => $cityCode,
              'checkIn' => $checkIn,
              'checkOut' => $checkOut,
              'nationality' => $nationality,
              'rooms' => $room_count,
              'adults' => $adults,
              'childs' => $childs,
              'infant' => $infant,
              'adults_count' => $adults_count,
              'childs_count' => $childs_count,
              'childs_ages' => $childs_ages,
              'nights' => $nights,
              'uniqueRefNo' => $uniqueRefNo,
            );
             // echo '<pre>';print_r($sess_array);exit;
            $search_data=json_encode($sess_array,JSON_FORCE_OBJECT);
            $hotel_search_data=array(
              'session_id'=>$ses_id,
              'uniqueRefNo'=>$uniqueRefNo,
              'search_data'=>$search_data,
            );
            // echo '<pre>';print_r($hotel_search_data);exit;
            $this->db->insert('hotel_search_data',$hotel_search_data);
            redirect('hotels/results/'.base64_encode($ses_id.'/'.$uniqueRefNo));
          } else {
            $this->load->view('home/index');
          }
        }
      }
    }

    public function fetch_results() {
      $count = 0;     
      $ListMapView = isset($_POST['ListMapView']) ? $_POST['ListMapView'] : 'List';     
      $subdata = array();

      $filter_min_price = $this->Hotels_Model->get_filter_min_price($_POST['ses_id']);
      $filter_max_price = $this->Hotels_Model->get_filter_max_price($_POST['ses_id']);
      // echo $this->db->last_query();
      // echo "<pre>"; print_r($filter_min_price);//exit;
      // echo "<pre>"; print_r($filter_max_price);exit;
      $min_price = $filter_min_price ? round(($filter_min_price->min_price/$filter_min_price->nights), 2) : 0;
      $max_price = $filter_max_price ? round(($filter_max_price->max_price/$filter_max_price->nights), 2) : 0;

      $loc_data['locations'] = $this->Hotels_Model->get_locations_list($_POST['ses_id']);

      $temp_data = $this->Hotels_Model->all_fetch_search_result($_POST['ses_id'], $offset = 0, $this->perPage());
      // echo $this->db->last_query();
      $subdata['ses_id'] = $_POST['ses_id'];
      $subdata['refNo'] = $_POST['refNo'];
      // echo "<pre>"; print_r($_POST);exit;
      $location_result = '';
      if (!empty($loc_data['locations'])) {
        $location_result = $this->load->view('location_list_ajax', $loc_data, TRUE);
      }

      $hotels_search_result = '';
      $count= $temp_data ? count($temp_data) : 0;
      if (!empty($temp_data)) {
        if ($ListMapView=="Map") {
          $hotels_search_result .= '<div class="map-view" id="map-view">';
          // for ($m = 0; $m < $count; $m++) {
            // if ($temp_data[$m]->api == 'hotel_crs') {
                $subdata['mapdata'] = $temp_data;
                $hotels_search_result .= $this->load->view('hotel_crs/map_ajax_list', $subdata, TRUE);
            // }
          // }
          $hotels_search_result .= '</div>';
        } else if ($ListMapView=="List") {
          for ($l = 0; $l < $count; $l++) {
             if ($temp_data[$l]->api == 'hotel_crs') {
                  $subdata['result'] = $temp_data[$l];
                  $hotels_search_result .= $this->load->view('hotel_crs/search_result_ajax', $subdata, TRUE);
             }
          }
          // $hotels_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
        } else if ($ListMapView=="Grid") {
          $hotels_search_result .= '<div class="grid-view">';
          for ($g = 0; $g < $count; $g++) {
             if ($temp_data[$g]->api == 'hotel_crs') {
                  $subdata['result'] = $temp_data[$g];
                  $hotels_search_result .= $this->load->view('hotel_crs/search_result_ajax_grid', $subdata, TRUE);
             }
          }
          $hotels_search_result .= '</div>';
          // $hotels_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
        }
      } else {
        $hotels_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
      }
      echo json_encode(array(
          'hotels_search_result' => $hotels_search_result,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'locations' => $location_result,
          'count'=>$count          
      ));
    }

    public function map_filter_ajax() {
      $temp_data = $this->Hotels_Model->fetchLocationMap($_POST['ses_id']);
      $hotels_search_map = '';
      if (!empty($temp_data)) {
        // $hotels_search_map = '<iframe src = "https://maps.google.com/maps?q='.$temp_data->latitude.','.$temp_data->longitude.'&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>';

        $hotels_search_map = '<iframe src="https://maps.google.com/maps?q='.$temp_data->latitude.','.$temp_data->longitude.'&hl=es;z=14&amp;output=embed" height="250" style="width:100%" frameborder="0" style="border:0;margin-bottom: 10px" allowfullscreen></iframe>';
      }
      echo json_encode(array(
        'result' => $hotels_search_map
      ));
    }

    public function searchresult_ajax($offset = 0) {
      // echo '<pre>';print_r($_POST); exit;
       $count=0;
       $subdata=array();
       $hotel_search_data = $this->Hotels_Model->check_hotel_search_data($_POST['ses_id'],$_POST['refNo']);
       $search_data=json_decode($hotel_search_data->search_data,true);  
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
        
        $pdata['hotelName'] = '';  
        if (isset($_POST['hotelName']) && $_POST['hotelName'] != '') {
            $pdata['hotelName'] = $_POST['hotelName'];
        }   
        if ($_POST['hotelName'] == 'undefined') {
            $pdata['hotelName'] = '';
        }

        $pdata['location'] = '';
        if (isset($_POST['location']) && $_POST['location'] != '') {
            $pdata['location'] = $_POST['location'];
        }

        $sortBy = $order = '';
        if (isset($_POST['sortBy']) && $_POST['sortBy'] != '') {
            $pdata['sortBy']=$sortBy = $_POST['sortBy'];
            $pdata['order']=$order = $_POST['order'];
        }

        $pdata['sessionId']=$_POST['ses_id'];
        $pdata['accommodation_type']=$_POST['accommodation_type'];
        $pdata['TotalRec'] = $this->Hotels_Model->TotalSearchResults($pdata['sessionId'], $minPrice, $maxPrice, $pdata['starRating'],$pdata['facility'],$pdata['hotelName'], $pdata['location']);
        $pdata['perPage'] = $this->perPage();       
   
        $temp_data = $this->Hotels_Model->all_fetch_search_result($pdata['sessionId'], $offset, $this->perPage(), $minPrice, $maxPrice, $pdata['starRating'],$pdata['facility'],$pdata['hotelName'], $pdata['location'], $sortBy, $order, $pdata['accommodation_type']);

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

        $subdata['ses_id'] = $_POST['ses_id'];
        $subdata['refNo'] = $_POST['refNo'];

        $hotels_search_result = '';
        $count = $temp_data ? count($temp_data) : 0;
        if (!empty($temp_data)) {
          if ($ListMapView=="Map") {
            $hotels_search_result .= '<div class="map-view" id="map-view">';
            // for ($m = 0; $m < $count; $m++) {
              // if ($temp_data[$m]->api == 'hotel_crs') {
                  $subdata['mapdata'] = $temp_data;
                  $hotels_search_result .= $this->load->view('hotel_crs/map_ajax_list', $subdata, TRUE);
              // }
            // }
            $hotels_search_result .= '</div>';
          } else if ($ListMapView=="List") {
            // echo 'aaa1';exit;
            for ($l = 0; $l < $count; $l++) {
               if ($temp_data[$l]->api == 'hotel_crs') {
                    $subdata['result'] = $temp_data[$l];
                    $hotels_search_result .= $this->load->view('hotel_crs/search_result_ajax', $subdata, TRUE);
               }
            }
            // $hotels_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
          } else if ($ListMapView=="Grid") {
            // echo '<pre>';print_r($temp_data); exit;
            $hotels_search_result .= '<div class="grid-view">';
            for ($g = 0; $g < $count; $g++) {
               if ($temp_data[$g]->api == 'hotel_crs') {
                    $subdata['result'] = $temp_data[$g];
                    $hotels_search_result .= $this->load->view('hotel_crs/search_result_ajax_grid', $subdata, TRUE);
               }
            }
            $hotels_search_result .= '</div>';
            // $hotels_search_result .= $this->load->view('search_ajax_result_js', $subdata, TRUE);
          }
        } else {
          // echo 'aaa3';exit;
          $hotels_search_result = $this->load->view('no_result_ajax', $subdata, TRUE);
        }

        echo json_encode(array(
            'hotels_search_result' => $hotels_search_result,
             'count'=>$count,
             'minPr'=>$minPr,     
        ));
    }

    public function perPage() {
        return 15;
    }
 
    function hotelSearchResult($results_id) {
          // echo '<pre>123'; print_r($results_id);exit;
          $resultstr = base64_decode($results_id);
          $results_arr=explode('/', $resultstr);
          $ses_id = $results_arr[0];
          $refNo = $results_arr[1];
          if(!empty($ses_id) && !empty($refNo))
          { 
             $hotel_search_data = $this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
             
             if(!empty($hotel_search_data)) {
                $search_data=json_decode($hotel_search_data->search_data,true);
                $api_info = $this->Hotels_Model->getActiveAPIs();       
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

    function hotels_availability() {
        $post_data = $this->input->post(NULL, TRUE);
        if ($post_data !== '') {
            if (isset($post_data['callBackId']) && $post_data['callBackId'] !== '') {
                $api = base64_decode($post_data['callBackId']);
                $ses_id = ($post_data['ses_id']);
                $refNo = ($post_data['refNo']);
                 $refNo = ($post_data['refNo']);                
                $refNo = ($post_data['refNo']);
                $this->load->module('hotels/' . $api);
                $this->{$api}->hotels_availabilty_search($ses_id,$refNo);
            } else {
                redirect('home/index', 'refresh');
            }
        } else {
          redirect('home/index', 'refresh');
        }
    }


    public function details($detail_id='') {
      if(!empty($detail_id)) {
        $detailstr = base64_decode($detail_id);
        $details_arr = explode('/', $detailstr);
        // echo '<pre>'; print_r($details_arr);exit;
        $ses_id=$details_arr[0];
        $refNo=$details_arr[1];
        $searchId=$details_arr[2];
        $hotelCode=$details_arr[3];
        $callBackId=$details_arr[4];
        // if (!empty($ses_id)&&!empty($refNo)&&!empty($searchId)&&!empty($hotelCode)&&!empty($callBackId)) {
        if (!empty($ses_id)&&!empty($refNo)&&!empty($hotelCode)&&!empty($callBackId)) {
          $api = base64_decode($callBackId);
          $this->load->module('hotels/' . $api);
          $this->$api->hotel_details($hotelCode, $searchId,$ses_id,$refNo);
        } else {
          echo 'Permission Denied';
        }
      } else {
        echo 'Permission Denied';
      }
    }

    public function preview($detail_id='') {
      if(!empty($detail_id)) {
        $hotelCode = base64_decode($detail_id);
        $data['hotelDetails'] = $hotelDetails = $this->Hotels_Model->getSupHotelDetails($hotelCode);
        // echo $this->db->last_query();
        // echo '<pre>'; print_r($hotelDetails);exit;
        $data['hotelImages'] = '';
        if (!empty($hotelDetails)) {
          $data['hotelImages'] = $this->Hotels_Model->getHotelImages($hotelCode);
          // $data['rooms'] = $this->rooms;
          // $data['newuniqueRefNo'] = $this->generateRandomString(8);
          // $data['city_code'] = $this->city_code;
          $this->load->view('hotel_crs/hotel_preview', $data);
        } else {
          echo 'Permission Denied';
        }
      } else {
        echo 'Permission Denied';
      }
    }



    public function hoteldetails($detail_id='') {
          if(!empty($detail_id)) {

                  $detailstr = base64_decode($detail_id);
                  $details_arr=explode('/', $detailstr);
                  $ses_id=$details_arr[0];
                  $refNo=$details_arr[1];
                  $searchId=$details_arr[2];
                  $hotelCode=$details_arr[3];
                  $callBackId=$details_arr[4];    
                  $cityCode=$details_arr[5];  
                  $city_list = $this->Hotels_Model->gethotelcitydetails($cityCode);
                  
                   if(!empty($city_list))
                   {
                     $cityName = $city_list->cityname . ', ' . $city_list->countryname;
                   }
                   else
                   {
                     $cityName="";
                   }

                   // echo $cityName; exit;


            $checkIn = date('d/m/Y', strtotime(date("Y/m/d"). ' + 15 days'));
            $checkOut = date('d/m/Y', strtotime(date("Y/m/d"). ' + 16 days'));
            $nationality = 'IN';      
            $room_count = 1;
            $adults_arr[0] = 1;
            $childs_arr[0] = 0;             
            $infant = ''; 
            $adultList = array_slice((array)$adults_arr, 0, $room_count);
            $childList = array_slice((array)$childs_arr, 0, $room_count);
            $adults = $adultList;
            $childs = $childList;           
            $adults_count = array_sum($adultList);
            $childs_count = array_sum($childList);
            $check_child_age = array_sum($childList);
            $ages = array();
            if ($check_child_age >= 1) 
            {
                // for ($r = 0; $r < $room_count; $r++) 
                 for ($r = 0; $r < 1; $r++) 
                {
                    $childNo = $childs[$r];
                    $childs_ages_arr = 0;
                    $ages_arr = array();
                    for ($l = 0; $l < $childNo; $l++)
                    {
                        if ($childs_ages_arr)
                        {
                            $ages_arr[$l] = $childs_ages_arr[$l];
                        } 
                        else
                        {
                            $ages_arr[$l] = '';
                        }
                    }
                    if (!empty($ages_arr))
                    {
                        $ages[] = implode(',', $ages_arr);
                    }
                    else
                    {
                        $ages[] = 0;
                    }
                }
            }

            $childs_ages = $ages;
         
            if (!empty($cityName)) 
            {
                    $search_data='';
                    $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
                   
                      
                  

                   /**********   SET SEARCHED DATA VARIABLES  ***************/

                    if (!empty($hotel_search_data)) 
                    {
                         $search_data=json_decode($hotel_search_data->search_data,true);
                        $sess_cityName = $search_data['cityName'];
                        $sess_checkIn = $search_data['checkIn'];
                        $sess_checkOut = $search_data['checkOut'];
                        $sess_nationality = $search_data['nationality'];                       
                        $sess_rooms = $search_data['rooms'];
                        $sess_adults = $search_data['adults'];
                        $sess_childs = $search_data['childs']; 
                        $sess_childs_ages = $search_data['childs_ages']; 
                        $sess_infant = $search_data['infant'];                     

                        
                        if($sess_cityName == $cityName && $sess_checkIn == $checkIn && $sess_checkOut == $checkOut && $sess_nationality == $nationality && $sess_rooms == $room_count && $sess_adults == $adults && $sess_childs == $childs && $sess_childs_ages == $childs_ages&& $sess_infant == $infant) 
                            {                          
                                $uniqueRefNo = $hotel_search_data->uniqueRefNo;
                                $ses_id=$hotel_search_data->session_id;                        
                            } 
                            else
                            {                         
                                $uniqueRefNo = $refNo;
                                // $uniqueRefNo = $this->generateRandomString(8);
                                $ses_id=$ses_id;                          
                                $ses_id=$this->sess_id;                          
                                $this->Hotels_Model->delete_temp_results($this->sess_id);
                                $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
                            }
                    }
                    else
                    {
                        // $uniqueRefNo = $this->generateRandomString(8);
                         $uniqueRefNo = $refNo;
                         $ses_id=$ses_id;                     
                         // $ses_id=$this->sess_id;                      
                        $this->Hotels_Model->delete_temp_results($this->sess_id);
                        $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
                    }
                    $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
                    $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
                    $nights = $this->dateDiff($cin, $cout);
                    $sess_array = array(
                                        'cityName' => $cityName, 
                                        'cityCode' => $cityCode,
                                        'checkIn' => $checkIn,
                                        'checkOut' => $checkOut,
                                        'nationality' => $nationality,
                                        'rooms' => $room_count,
                                        'adults' => $adults, 
                                        'childs' => $childs,
                                        'infant' => $infant,
                                        'adults_count' => $adults_count,
                                        'childs_count' => $childs_count,                 
                                        'childs_ages' => $childs_ages,
                                        'nights' => $nights,
                                        'uniqueRefNo' => $uniqueRefNo,
                                         );
                   $search_data=json_encode($sess_array,JSON_FORCE_OBJECT);
                   $hotel_search_data=array(
                                             'session_id'=>$ses_id,
                                             'uniqueRefNo'=>$uniqueRefNo,
                                             'search_data'=>$search_data,
                                            );
                   // print_r($hotel_search_data);

                   $this->db->insert('hotel_search_data',$hotel_search_data);
                 
                  
            }             



                 if (!empty($cityCode)&&!empty($hotelCode)&&!empty($callBackId))
                    {
                        $api = base64_decode($callBackId);           
                        $this->load->module('hotels/' . $api);

                       if($this->$api->hotelsdetails_availabilty_search($hotelCode,$ses_id,$refNo))
                      {
                        $hotdetails=$this->Hotels_Model->getHotelDetails($hotelCode, $ses_id,$refNo);
                        //   print_r($hotdetails);
                        // echo $hotdetails->search_id;
                        if(!empty($hotdetails))
                        {
                          redirect('hotels/details/'.base64_encode($ses_id.'/'.$refNo.'/'.$hotdetails->search_id.'/'.$hotelCode.'/'. base64_encode($api)));
                         }
                          else 
                         {
                            redirect('home/index');
                         }
                      }
                    } 
                     else 
                    {
                        echo 'Permission Denied';
                    }
        }
        else 
        {
            echo 'Permission Denied';
        }
    }


    function hotelroomdetails($detail_id='')
    {
      if(!empty($detail_id))
      {
        $detailstr = base64_decode($detail_id);
        $details_arr=explode('/', $detailstr);
        $oldses_id=$details_arr[0];
        $oldrefNo=$details_arr[1];
        $oldsearchId=$details_arr[2];
        $oldhotelCode=$details_arr[3];
        $oldcallBackId=$details_arr[4];
        $oldapi = base64_decode($oldcallBackId);

        if(!isset($_POST['checkIn'])&&!isset($_POST['checkOut'])&&!empty($results_id))
        {
          redirect('hotels/details/'.base64_encode($oldses_id.'/'.$oldrefNo.'/'.$oldsearchId.'/'.$oldhotelCode.'/'. base64_encode($oldapi)));
        }
        else
        {
          // echo '<pre>123'; print_r($_POST); exit;
          $this->form_validation->set_rules('checkIn', 'Check-In Date', 'required');
          $this->form_validation->set_rules('checkOut', 'Check-Out Date', 'required');
          if($this->form_validation->run() == FALSE && $this->valid_checkin_date($this->input->post('checkIn')) && $this->valid_checkout_date($this->input->post('checkOut')))
          {         
            redirect('hotels/details/'.base64_encode($oldses_id.'/'.$oldrefNo.'/'.$oldsearchId.'/'.$oldhotelCode.'/'. base64_encode($oldapi)));
          }
          else
          { 
            $results_id = $this->input->post('results_id');
            $postdetailstr = base64_decode($results_id);
            $postdetailstr=explode('/', $postdetailstr);
            $ses_id=$postdetailstr[0];
            $refNo=$postdetailstr[1];
            $searchId=$postdetailstr[2];
            $hotelCode=$postdetailstr[3];
            $callBackId=$postdetailstr[4];    
            $cityCode=$postdetailstr[5];
            $api = base64_decode($callBackId);
            $city_list = $this->Hotels_Model->gethotelcitydetails($cityCode);
            if(!empty($city_list))
            {
              $cityName = $city_list->city_name . ', ' . $city_list->country_name;
            }
            else
            {
              $cityName="";
            }
            $checkIn = $this->input->post('checkIn');
            $checkOut = $this->input->post('checkOut');
            $nationality = $this->input->post('nationality');      
            $room_count = $this->input->post('room_count');
            $adults_arr = $this->input->post('adults');
            $childs_arr = $this->input->post('childs');             
            $infant = isset($_POST['infant'])?1:'';             
            $adultList = array_slice((array)$this->input->post('adults'), 0, $this->input->post('room_count'));
            $childList = array_slice((array)$this->input->post('childs'), 0, $this->input->post('room_count'));
            $adults = $adultList;
            $childs = $childList;           
            $adults_count = array_sum($adultList);
            $childs_count = array_sum($childList);
            $check_child_age = array_sum($childList);
            $ages = array();
            if ($check_child_age >= 1) 
            {
              for ($r = 0; $r < $room_count; $r++)                 
              {
                $childNo = $childs[$r];
                $childs_ages_arr = $this->input->post('childs_ages_room' . ($r + 1));
                $ages_arr = array();
                for ($l = 0; $l < $childNo; $l++)
                {
                  if ($childs_ages_arr)
                  {
                    $ages_arr[$l] = isset($childs_ages_arr[$l])?$childs_ages_arr[$l]:'';
                  } 
                  else
                  {
                    $ages_arr[$l] = '';
                  }
                }
                if (!empty($ages_arr))
                {
                  $ages[] = implode(',', $ages_arr);
                }
                else
                {
                  $ages[] = 0;
                }
              }
            }
            $childs_ages = $ages;
            if (!empty($cityName)) 
            {
              $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
              /**********   SET SEARCHED DATA VARIABLES  ***************/
              if (!empty($hotel_search_data)) 
              {
                $search_data=json_decode($hotel_search_data->search_data,true);
                $sess_cityName = $search_data['cityName'];
                $sess_checkIn = $search_data['checkIn'];
                $sess_checkOut = $search_data['checkOut'];
                $sess_nationality = $search_data['nationality'];                       
                $sess_rooms = $search_data['rooms'];
                $sess_adults = $search_data['adults'];
                $sess_childs = $search_data['childs']; 
                $sess_childs_ages = $search_data['childs_ages']; 
                $sess_infant = $search_data['infant'];                     
                if($sess_cityName == $cityName && $sess_checkIn == $checkIn && $sess_checkOut == $checkOut && $sess_nationality == $nationality && $sess_rooms == $room_count && $sess_adults == $adults && $sess_childs == $childs && $sess_childs_ages == $childs_ages&& $sess_infant == $infant) 
                {                          
                  $uniqueRefNo = $hotel_search_data->uniqueRefNo;
                  $ses_id=$hotel_search_data->session_id;                        
                } 
                else
                {                         
                  $uniqueRefNo = $refNo;
                  // $uniqueRefNo = $this->generateRandomString(8);
                  $ses_id=$ses_id;                          
                  $ses_id=$this->sess_id;                          
                  $this->Hotels_Model->delete_temp_results($this->sess_id);
                  $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
                }
              }
              else
              {
                // $uniqueRefNo = $this->generateRandomString(8);
                $uniqueRefNo = $refNo;
                $ses_id=$ses_id;
                // $ses_id=$this->sess_id;
                $this->Hotels_Model->delete_temp_results($this->sess_id);
                $this->Hotels_Model->delete_temp_data($this->sess_id,$uniqueRefNo);
              }
              $cin = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
              $cout = date('Y-m-d', strtotime(str_replace('/', '-', $checkOut)));
              $nights = $this->dateDiff($cin, $cout);
              $sess_array = array(
                'cityName' => $cityName, 
                'cityCode' => $cityCode,
                'checkIn' => $checkIn,
                'checkOut' => $checkOut,
                'nationality' => $nationality,
                'rooms' => $room_count,
                'adults' => $adults, 
                'childs' => $childs,
                'infant' => $infant,
                'adults_count' => $adults_count,
                'childs_count' => $childs_count,                 
                'childs_ages' => $childs_ages,
                'nights' => $nights,
                'uniqueRefNo' => $uniqueRefNo,
              );
              $search_data=json_encode($sess_array,JSON_FORCE_OBJECT);
              $hotel_search_data=array(
                'session_id'=>$ses_id,
                'uniqueRefNo'=>$uniqueRefNo,
                'search_data'=>$search_data,
              );
              $this->db->insert('hotel_search_data',$hotel_search_data);
            } 
            if (!empty($cityCode)&&!empty($hotelCode)&&!empty($callBackId))
            {
                      
              $this->load->module('hotels/' . $api);
              if($this->$api->hotelsdetails_availabilty_search($hotelCode,$ses_id,$refNo))
              {
                $hotdetails=$this->Hotels_Model->getHotelDetails($hotelCode, $ses_id,$refNo);
                // print_r($hotdetails); exit;
                // echo $hotdetails->search_id;
                if(!empty($hotdetails))
                {
                  $search_id = $hotdetails->search_id;
                }
                else 
                {
                  // echo "123"; exit;
                  $search_id = 0;
                  // redirect('hotels/details/'.base64_encode($oldses_id.'/'.$oldrefNo.'/'.$oldsearchId.'/'.$oldhotelCode.'/'. base64_encode($oldapi)));
                }
                redirect('hotels/details/'.base64_encode($ses_id.'/'.$refNo.'/'.$search_id.'/'.$hotelCode.'/'. base64_encode($api)));
              }
            } 
            else 
            {
              // echo "1213"; exit;
              $search_id = 0;
              redirect('hotels/details/'.base64_encode($ses_id.'/'.$refNo.'/'.$search_id.'/'.$hotelCode.'/'. base64_encode($api)));
            }
          }
        }
      }
      else 
      {
        echo 'Permission Denied';
      }
    }


  public function itinerary() {
    // echo '<pre/>';print_r($_POST);exit;
    if (isset($_POST['callBackId']) && isset($_POST['hotelCode']) && isset($_POST['refNo'])) {
      $api = base64_decode($_POST['callBackId']);
      $ses_id = trim($_POST['ses_id']);
      $hotelCode = trim($_POST['hotelCode']);
      // $searchId = trim($_POST['searchId']);
      $refNo = trim($_POST['refNo']);
      $room_count = trim($_POST['room_count']);
      $searchId = array();
      for ($i = 0; $i < $room_count; $i++) {
        $searchId[] = $_POST[$i . '_searchId'];
      }
      $this->load->module('hotels/' . $api);
      $this->$api->hotel_itinerary($hotelCode,$searchId,$ses_id,$refNo);
    } else {
      echo 'Permission Denied';
    }
  }

  public function reservation() {
    // echo '<pre/>';print_r($_POST);exit;
    if (isset($_POST['callBackId']) && isset($_POST['hotelCode']) && isset($_POST['searchId'])) {
      // echo 124; exit;
      $this->session->set_userdata('passenger_info', $_POST);
      $api = base64_decode($_GET['callBackId']);
      $hotelCode = trim($_GET['hotelCode']);
      $searchId = $_GET['searchId'];
      $sessionId = $_GET['sessionId'];
      $refNo = $_GET['refNo'];
      // $payment_type = $this->input->post('payment_type');
      $this->load->module('hotels/' . $api);
      if ($this->session->userdata('agent_logged_in')) {
        $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId, $refNo);
      } else {
        // $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId, $refNo);
        $this->$api->payment_process($sessionId, $hotelCode, $searchId, $refNo);
      }
    } else {
      echo 'Permission Denied';
    }
  }

  

    public function confirm_reservation() {
        //echo '<pre/>';print_r($_POST);exit;
        if (isset($_POST['callBackId']) && isset($_POST['hotelCode']) && isset($_POST['searchId'])) {
            $api = base64_decode($_GET['callBackId']);
            $hotelCode = trim($_GET['hotelCode']);
            $searchId = $_GET['searchId'];
            $sessionId = $_GET['sessionId'];

            $this->load->module('hotels/' . $api);
            $this->$api->confirm_reservation($sessionId, $hotelCode, $searchId);
        } else {
            echo 'Permission Denied';
        }
    }


      public function nearby_hotels() {
        // echo '<pre/>';print_r($_POST);exit;
        if (isset($_POST['callBackId']) && isset($_POST['hotelCode'])) {
            $api = base64_decode($_POST['callBackId']);
            $session_id = trim($_POST['sessionId']);
            $hotelCode = trim($_POST['hotelCode']);
            $latitude = trim($_POST['latitude']);
            $longitude = trim($_POST['longitude']);
            $city = trim($_POST['city']);

            $this->load->module('hotels/' . $api);
            $this->$api->nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
        } else {
            echo 'Permission Denied';
        }
    }


        public function payment_return() {
          // echo '<pre>';
          // print_r($_POST);
          // exit;
          $pay_details = $this->session->userdata('pay_details');
          $api = $pay_details['callBackId'];
          $hotelCode = $pay_details['hotelCode'];
          $searchId = $pay_details['searchId'];
          $sessionId = $pay_details['sessionId'];

          $uniqueRefNo = $pay_details['uniqueRefNo'];
          // exit;
          $this->load->module('hotels/' . $api);
          $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId);
       
        }


   


    public function voucher() {
      if (isset($_GET['voucherId'])) {
        $sysRefNo = $_GET['voucherId'];
        $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
        $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);

        if(!empty($data['passenger_info'])){
          $data['supplier_info'] = $this->Hotels_Model->getSupplierInfo($data['hotel_booking_info']->supplier_id);
          $supdata = $this->Hotels_Model->getSupplierHotelListInfo($data['hotel_booking_info']->supplier_id,$data['hotel_booking_info']->hotel_code);
          // echo '<pre>';print_r($supplier_info);exit;
          $data_email = array(
            // 'ticket_url' => site_url().'hotels/voucher1?voucherId='.$sysRefNo,
            'uniqueRefNo' => $sysRefNo,
            'reservation_email' => $supdata->reservation_email,
            'user_email' => $data['hotel_booking_info']->user_email,
            'supplier_id' => $data['hotel_booking_info']->supplier_id,
            'subject' => 'Hotel Booking :: '.$sysRefNo,
          );
          $voucher_content =  $this->load->view('voucher_email',$data,true);
          $this->load->module('home/sendemail');
          $this->sendemail->ticketing_mail($data_email, $voucher_content);
          redirect('hotels/voucher1?voucherId='.$sysRefNo, 'refresh');
        } else {
          echo 'Permission Denied';
        }
        
      } else {
        echo 'Permission Denied';
      }
    }

    public function voucher1() {
      if (isset($_GET['voucherId'])) {
        $sysRefNo = $_GET['voucherId'];
        $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
        $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
        $data['supplier_info'] = $this->Hotels_Model->getSupplierInfo($data['hotel_booking_info']->supplier_id);
        // echo '<pre>';print_r($supplier_info);exit;
        $this->load->view('voucher', $data);
      } else {
        echo 'Permission Denied';
      }
    }

    public function voucher_cancel() {
        if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
            $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
            // echo $this->db->last_query();exit;
            $this->load->view('hotel_can_voch', $data);
        } else {
            echo 'Permission Denied';
        }
    }

    public function admin_voucher() {
        if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            //echo '<pre>';print_r($sysRefNo);exit;
            $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);
            $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
            // echo $this->db->last_query();exit;
            //echo '<pre/>';print_r($data);exit;
        //$this->ticket_email($sysRefNo,$hotelRefNo);
            $this->load->view('admin_voucher', $data);
        } else {
            echo 'Permission Denied';
        }
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

    public function hotel_voucher($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);


        $this->load->view('voucher', $data);
    }

    public function hotel_ticket($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
        $this->load->view('voucher', $data);
    }

    public function voucher_invoice() {
        //echo '<pre>';print_r($this->session->all_userdata());exit;
        if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            //echo '<pre>';print_r($sysRefNo);exit;
            // $hotelRefNo = $_GET['hotelRefId'];

            $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo);

            $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);

            // echo $this->db->last_query();exit;
            //echo '<pre/>';print_r($data);exit;
        //$this->ticket_email($sysRefNo,$hotelRefNo);
            $this->load->view('hotel_invoicer', $data);
        } else {
            echo 'Permission Denied';
        }
    }

 
    function generate_eticket($sysRefNo, $bookRefNo) {
       // $data['voucherId'] = $sysRefNo;
        $data['hotel_booking_info'] = $this->Hotels_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Hotels_Model->get_hotel_booking_passenger_info($sysRefNo);
        // echo '<pre/>';print_r($data);exit;
        //$this->load->view('b2c/hotel/voucher', $data);
        $this->load->view('voucher', $data);
    }

    function back_to_search() {
        $api_info = $this->Hotels_Model->getActiveAPIs();
        $this->session->set_userdata('hotel_search_activate', 1);
        $api_list = array();
        foreach ($api_info as $api) {
            $api_list[] = base64_encode($api['api_name']);
        }
        //echo '<pre/>';print_r($api_list);exit;
        $data['api_list'] = $api_list;

        $this->load->view('search_result', $data);
    }

    function error_page($error) {
        $data['error'] = $error;
        $this->load->view('error_page', $data);
    }

    function hotel_details_error($error) {
        $data['error'] = $error;
        $this->load->view('roomsxml/hotel_details_error', $data);
    }


    function generateRandomString($length = 10) {
      $time = Date('i');
      // echo Date('ydHi');exit;
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'VMN'.$time.$randomString;
    }

    

 
    
  public function cancel_voucher($uniqueRefNo, $booking_ref, $case) {
        //echo '12';
        //print_r($uniqueRefNo);echo 'bid';print_r($booking_ref);
        $hotel_details = $this->Home_Model->get_hotel_booking_report($booking_ref, $uniqueRefNo);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($hotel_details);exit;
        $api = $hotel_details->api;
        //echo '<pre>';print_r($api);exit;
        $this->load->module('hotels/' . $api);

       if($api == 'hotel_crs') {

            $this->$api->cancel_voucher($uniqueRefNo, $booking_ref);
        } 
  }

    public function cancel_voucher_confirm($booking_ref, $uniqueRefNo, $case) {
        $hotel_details = $this->Home_Model->get_hotel_booking_report($booking_ref, $uniqueRefNo);
        //echo $this->db->last_query();
        // echo '<pre>';print_r($hotel_details);exit;
        $api = $hotel_details->api;
        $this->load->module('hotels/' . $api);
       if ($api == 'hotel_crs') {
            //  echo 'hotel_crsaa';
            $this->$api->cancel_voucher_confirm($uniqueRefNo);
        }  
    }

    public function searchAjaxData() {
      if(isset($_POST['val']) && isset($_POST['type'])) {
        $type=$_POST['type'];
        $val=$_POST['val'];
        $detailstr = base64_decode($val);
        $details_arr=explode('/', $detailstr);
        // echo '<pre>';print_r($details_arr);exit;
        $ses_id=$details_arr[0];
        $refNo=$details_arr[1];
        $searchId=$details_arr[2];
        $hotelCode=$details_arr[3];
        $callBackId=$details_arr[4];
        $city_code=$details_arr[5];
        $this->load->model('hotel_crs/hotelcrs_model');
        
        if($type=="maps") {
          $hotelDetails = $this->hotelcrs_model->getHotelDetails($hotelCode, $searchId);
          $result = '<iframe src = "https://maps.google.com/maps?q='.$hotelDetails->latitude.','.$hotelDetails->longitude.'&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>';
          echo json_encode(array('result'=>$result, 'type'=>'mapTypeId'));

        } else if($type=="rooms") {
          $room_info = $this->hotelcrs_model->get_hotel_rooms($city_code,$ses_id,$hotelCode);

          // echo '<pre>';print_r($search_data);exit;
          $result = '<div class="table-responsive">
              <table class="table table-condensed table-bordered table-hover" style="margin-bottom:0">
                <thead>
                  <tr>
                    <th>Room</th>
                    <th width="20%">Net Price</th>
                    <th width="10%" style="text-align:center">Book</th>
                  </tr>
                </thead>
                <tbody>';
                
                foreach ($room_info as $rooms) {
                  $mealplan="";
                  $meal=explode(',', $rooms->board_type);
                  $meal_plan_arr=array();
                  foreach ($meal as $val) {
                    $meal_plan_arr[] = $this->hotelcrs_model->get_hotel_room_meal_plan($val);
                  }
                  if(!empty($meal_plan_arr)) {
                    $mealplan = implode(', ', $meal_plan_arr);
                  }
                  $offer = '';

                  $taxes = $rooms->government_tax+$rooms->resort_fee+$rooms->service_tax;
                  $price_nights = $rooms->nights; //Price based on nights? No=1Yes=total_nights
                  $this->load->module('home');
                  $discount_return = $this->home->priceChangeOnLogin($rooms->search_id,$price_nights);
                  // echo '<pre>';print_r($discount_return);exit;
                  $discount_badge = $discount_return['discount_badge'];
                  $disc_msg = $discount_return['disc_msg'];
                  $per_night_org_cost = $discount_return['org_cost'];
                  $per_night_disc_cost = $discount_return['member_cost'];
                  $member_cost = $discount_return['member_cost'];
                  // $org_price_div = $discount_return['org_price_div'];
                  // $total_discount = $discount_return['discount'];
                  // $promo_id = $discount_return['promo_id'];
                  
                  $without_disc = '';
                  if($per_night_org_cost > $per_night_disc_cost){
                    $without_disc = '<small style="text-decoration: line-through;"><i class="fa fa-dollar"></i>'.number_format($per_night_org_cost,2).' USD</small><br>';
                  }
                  $result .= '<tr>
                    <td style="vertical-align:middle;text-align:left">'.$rooms->room_name.' ( '.$rooms->room_type.' )<br> '.$mealplan.'</td>
                    <td style="vertical-align:middle;text-align:left">'.$without_disc.'<b style="font-size:16px;"><i class="fa fa-dollar"></i>'.number_format($member_cost,2).'</b> USD</td>
                    <td style="vertical-align:middle;text-align:right">
                      <a data-searchid="'.$rooms->search_id.'" data-code="'.$rooms->hotel_code.'" class="btn btn-primary book-btn" title="Continue Booking" href="'.site_url().'/hotels/details/'.base64_encode($ses_id.'/'.$refNo.'/'.$rooms->search_id.'/'.$rooms->hotel_code.'/'.$callBackId).'" style="color:#fff">Reserve</a>
                    </td>
                  </tr>';
                }
              $result .= '</tbody>
            </table>
          </div>';
          echo json_encode(array('result'=>$result, 'type'=>'roomsTypeId'));

        } else if($type=="ratings") {
          $result='';
          // $result = '<iframe src="https://api.trustyou.com/hotels/'.$hotelDetails->trustYouID.'/meta_review.html?iframe_resizer=true" allowtransparency="true" frameborder="0" height="250" scrolling="yes" width="100%"iframe></iframe>';
          echo json_encode(array('result'=>$result,'type'=>'ratingsTypeId'));
        } else {
          echo json_encode(array('result'=>'','type'=>''));
        }
      } else {
        echo json_encode(array('result'=>'','type'=>''));
      }
    }

    public function addWishList()
    {
      if(isset($_POST['val']))
      {
                  $detailstr = base64_decode($_POST['val']);
                  $details_arr=explode('/', $detailstr);
                  $hotelCode=$details_arr[0];                 
                  $api=base64_decode($details_arr[1]);
                  $search_id=$details_arr[2];
                  $ses_id=$details_arr[3];
                  $this->Hotels_Model->insertUserWishList($search_id,$ses_id,$hotelCode,$api);
                  echo true;
                
      }
    }

    public function removeWishList()
    {
      if(isset($_POST['val']))
      {
                  $detailstr = base64_decode($_POST['val']);
                  $details_arr=explode('/', $detailstr);
                  $hotelCode=$details_arr[0];
                  $api=base64_decode($details_arr[1]);
                  $search_id=$details_arr[2];                  
                  $ses_id=$details_arr[3];
                  $this->Hotels_Model->removeUserWishList($search_id,$ses_id,$hotelCode,$api);
                  echo true;
                
      }
    }

    public function addCompareList()
    {
      if(isset($_POST['val']))
      {
                  $detailstr = base64_decode($_POST['val']);
                  $details_arr=explode('/', $detailstr);
                  $hotelCode=$details_arr[0];                 
                  $api=base64_decode($details_arr[1]);
                  $search_id=$details_arr[2];
                  $ses_id=$details_arr[3];
                  $this->Hotels_Model->insertUserCompareList($search_id,$ses_id,$hotelCode,$api);
                  echo true;
                
      }
    }

    public function removeCompareList()
    {
      if(isset($_POST['val']))
      {
                  $detailstr = base64_decode($_POST['val']);
                  $details_arr=explode('/', $detailstr);
                  $hotelCode=$details_arr[0];
                  $api=base64_decode($details_arr[1]);
                  $search_id=$details_arr[2];                  
                  $ses_id=$details_arr[3];
                  $this->Hotels_Model->removeUserCompareList($search_id,$ses_id,$hotelCode,$api);
                  echo true;
                
      }
    }

    public function compareListAjax()
    {
      $compare_results='';
      $count=0;
      if(isset($_POST['compare_list']))
      {  
        $compare_list=$this->Hotels_Model->getCompareListHotel($_POST['ses_id'],$_POST['compare_list']);        
        if(!empty($compare_list)){
           $count=count($compare_list);
          for($i = 0; $i < count($compare_list); $i++) 
            {            
               if ($compare_list[$i]->api == 'hotel_crs') 
               {                
                    $subdata['result'] = $compare_list[$i];
                    $compare_results .= $this->load->view('hotel_crs/compareListAjax', $subdata, TRUE);
               } 
            }
        }
        else
        {
          $compare_results="No Compare List Available ";
        }



                
      }
        echo json_encode(array(
          'compare_results' => $compare_results,
          'count'=>$count,
        ));
    }
   
 
}