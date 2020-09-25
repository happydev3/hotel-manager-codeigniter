<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() 
    {
        parent::__construct();
        parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
        $this->load->model('Home_Model');   
        $this->sess_id = $this->session->session_id; 
    }

    function index() {
      $data['country']= $this->Home_Model->get_country();
      $data['top_deals']= $this->Home_Model->top_deals();
      $data['popular_destination']= $this->Home_Model->popular_destination();
    	$this->load->view('index',$data);
    }
    function hotels() {
      $data['country']= $this->Home_Model->get_country();
      $data['top_deals'] = $this->Home_Model->top_deals();
      $data['popular_destination']= $this->Home_Model->popular_destination();
      // echo '<pre>';print_r($data['top_deals']);exit;
      $this->load->view('index',$data);
    }
    function villa() {
      $data['country']= $this->Home_Model->get_country();
      $data['top_deals']= $this->Home_Model->top_deals();
      $data['popular_destination']= $this->Home_Model->popular_destination();
      $this->load->view('index',$data);
    }
    function tours() {
      $data['country']= $this->Home_Model->get_country();
      $data['top_deals']= $this->Home_Model->top_deals();
      $data['popular_destination']= $this->Home_Model->popular_destination();
      $this->load->view('index',$data);
    }

    function popularcities() {
        $module_type = $_POST['module_type'];
        $last_click = $_POST['last_click'];
        $popular_cities = $this->Home_Model->popularCities($module_type);
        $content = '<div class="ajax_dropdown_div" id="ajax_dropdown_div" click-type="'.$module_type.'"><div class="title">Popular Cities</div><div class="dropdown-div"><ul class="dropdown-list row2" id="ajax-result">';
        // echo '<pre>'; print_r($popular_cities[0]->code);exit;
        if(!empty($popular_cities)){
            for ($i = 0; $i < count($popular_cities); $i++) {
                $class = '';
                if(!empty($last_click) && ($last_click == $popular_cities[$i]->code)){
                    $class = 'active';
                }
                $content .= '<li class="num_'.$popular_cities[$i]->code.'" data-num="'.$popular_cities[$i]->code.'">
                    <div class="'.$class.'">
                      <span class="name" data-val="'.$popular_cities[$i]->code.'" data-country="'.$popular_cities[$i]->country.'">'.$popular_cities[$i]->name.'</span>
                    </div>
                  </li>';
            }
        }
        $content .= '</ul></div></div>';
        echo json_encode(
            array('result' => $content)
        );
        // echo '<pre>'; print_r($content);exit;
    }

    public function hotelcitylist()
    {
      if (isset($_GET['term']))
      {
           
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->Home_Model->get_hotel_city_list($search);
             if (!empty($city_list)) 
             {
                for ($i = 0; $i < count($city_list); $i++)
                {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['id'];
                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=>$cityid
                    );
                }
              }         
            else 
            {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => "",
                    'id' => ''
                );
            }
        }
        else 
        {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => ''
            );
        }
        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
    }

    public function holidaycitylist()
    {
        if (isset($_GET['term'])) {
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->Home_Model->get_holiday_city_list($search);
            if (!empty($city_list)) 
            {
                for ($i = 0; $i < count($city_list); $i++)
                {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['city_id'];
                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=>$cityid
                    );
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => "",
                    'id' => ''
                );
            }
        }
        else 
        {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => ''
            );
        }
        echo json_encode($return_arr);
    }

    public function villacitylist()
    {
      if (isset($_GET['term'])) {
           
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->Home_Model->get_villa_city_list($search);
             if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['id'];
                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=>$cityid
                    );
                }
              }         
            else 
            {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => "",
                    'id' => ''
                );
            }
        }
        else 
        {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => ''
            );
        }
        echo json_encode($return_arr);
    }


    public function aboutUs()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=1);
         $this->load->view('cms',$data);
    }

    public function error404() {
      echo 'Page not found';
    }

    function error_page($error) {
        $data['error'] = $error;
        $this->load->view('error_page', $data);
    }

    public function thankyou() {
      $this->load->view('thankyou');
    }

    public function contactUs()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=2);
         $this->load->view('cms',$data);
    } 

    public function privacyPolicy()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=3);
         $this->load->view('cms',$data);
    } 

    public function termsCondition()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=4);
         $this->load->view('cms',$data);
    } 

    public function Testimonial()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=5);
         $this->load->view('cms',$data);
    } 

    public function faq()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=6);
         $this->load->view('cms',$data);
    } 

    public function disclaimer()
    {       
         $data['content'] = $this->Home_Model->getcontent($type=7);
         $this->load->view('cms',$data);
    } 

    public function popularHotelAjax()
    {
      if(isset($_POST['code']))
      {
        $popularhotel = $this->Home_Model->popularhotel($_POST['code']);
         if(!empty($popularhotel))
         {
           $hoteldetails=array();
           foreach ($popularhotel as $val) 
           {
            $permanentHotels = $this->Home_Model->getApiPermanentHotels($val->city_code,$val->hotel_code,$val->api);
             if(!empty($permanentHotels))
             {
                 $hoteldetails[]=$permanentHotels;
             }
           }
            if(!empty($hoteldetails))
           {
           $data['hoteldetails']=$hoteldetails;
            $data['uniqueRefNo'] = $this->generateRandomString(8);
            echo json_encode(array('popularhotel'=>$this->load->view('popularHotelAjax',$data,true)));
          }
           else
          {
            echo json_encode(array('popularhotel'=>'No Hotels Avialable'));
          }      

      }
      else
      {
            echo json_encode(array('popularhotel'=>'No Hotels Avialable'));
       
      }
      }
     else
      {
              echo json_encode(array('popularhotel'=>'No Hotels Avialable'));
       
      }
    }

   function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'AI' . $randomString;
    }


    function topdeals($id='') 
    {
        if(!empty($id))
        {
            $code = base64_decode($id);
            $data['country']= $this->Home_Model->get_country();
            $data['topdeals']= $this->Home_Model->getTopdealsDetails($code);
            $topdealshotel= $this->Home_Model->getTopdealsHotelDetails($code);

             $hoteldetails=array();
           if(!empty($topdealshotel))
           {
               foreach($topdealshotel as $val) 
               {
                $permanentHotels = $this->Home_Model->getFitruumsPermanentHotels($val->hotel_code);
                 if(!empty($permanentHotels))
                 {
                     $hoteldetails[]=$permanentHotels;
                 }
               }
          }
           if(!empty($hoteldetails))
           {
             $data['topdealshotel']=$hoteldetails;
             $data['uniqueRefNo'] = $this->generateRandomString(8);
             $this->load->view('topdeals',$data);
            }
            else
            {
                 redirect('home/index');
            }
        }
        else
        {
             redirect('home/index');
        }
    }

    public function subscribe(){
      $email = $this->input->post('email');
      $check_email = $this->Home_Model->check_email($email);
      // echo '<pre>';print_r($check_email);exit;
      if(empty($check_email)){
        $data_enquiry = array(
          'subject'     => 'You are now Subscribed!',
          'email'    => $email,
        );

        if($this->db->insert('email_subscribers',array('email' => $email))){
          // echo '<pre>';print_r($data_enquiry);
          $this->load->module('home/sendemail');
          $this->sendemail->send_subscription($data_enquiry);
          redirect('home/thankyou','refresh');
        } else{
          redirect('home/error_page/'.base64_encode('Something went wrong, please try again!'), 'refresh');
        }
      } else{
        redirect('home/error_page/'.base64_encode('You are already subscribed to our offers and packages!'), 'refresh');
      }
    }

    public function subscribeAjax(){
      $email = $this->input->post('email');
      $member_signup = isset($_POST['member_signup'])?$this->input->post('member_signup'):'';
      if($member_signup=='1'){
        $check_email = $this->Home_Model->check_email_availability($email);
      } else {
        $check_email = $this->Home_Model->check_email($email);
      }
      // echo '<pre>';print_r($member_signup);exit;
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(empty($check_email)){
          if($member_signup=='1'){
            $msg = '';
            $status = 1;
          } else {
            $data_enquiry = array(
              'subject'     => 'You are now Subscribed!',
              'email'    => $email,
            );
            if($this->db->insert('email_subscribers',array('email' => $email))){
              // echo '<pre>';print_r($data_enquiry);
              $this->load->module('home/sendemail');
              $this->sendemail->send_subscription($data_enquiry);
              $msg = 'You are successfully subscribed to our offers and packages!';
              $status = 1;
            } else{
              $msg = 'Something went wrong, please try again!';
              $status = 0;
            }
          }
        } else{
          if($member_signup=='1'){
            $msg = 'You are already registered to our offers and packages!';
          } else {
            $msg = 'You are already subscribed to our offers and packages!';
          }
          $status = 0;
        }
      } else{
        $msg = 'Please enter valid email address!';
        $status = 0;
      }

      echo json_encode(array(
        'msg' => $msg,
        'status' => $status
      ));
    }
    
    public function phpinfo(){
      echo CI_VERSION;
      echo phpinfo();
    }

    public function priceChangeOnLogin($search_idss='',$promo_night='') {
      if($search_idss == '') {
        $tempsearch_id = $this->input->post('search_id');
        $search_ids = explode(',', $this->input->post('search_id'));
        $promo_night = $this->input->post('promo_night');
      } else {
        $tempsearch_id = $search_idss;
        $search_ids = explode(',', $search_idss);
      }
      $roomDetails = array();
      if(!empty($search_ids)) {
        $this->load->model('hotels/hotel_crs/Hotelcrs_Model');
        foreach ($search_ids as $val) {
          $roomDetails[] = $this->Hotelcrs_Model->get_merged_rooms_new('hotel_crs',$val);
        }
      }
      // echo '<pre>';print_r($roomDetails);//exit;

      $discount_return = array();
      if(!empty($roomDetails[0])) {
        $total_taxes = $roomDetails[0]->government_tax+$roomDetails[0]->resort_fee+$roomDetails[0]->service_tax;
        $this->load->model('hotels/Hotels_Model');
        $sess_id = $roomDetails[0]->session_id;
        $uniqueRefNo = $roomDetails[0]->uniqueRefNo;
        $search_datas = $this->Hotels_Model->check_hotel_search_data($sess_id,$uniqueRefNo);
        $search_data = json_decode($search_datas->search_data, true);
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $search_data['checkIn'])));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $search_data['checkOut'])));
        
        foreach ($roomDetails as $res) {
          // $total_cost += $res->total_cost;
          $admin_data = array(
            'discount_value' => $res->discount_value,
            'discount_type' => $res->discount_type,
            'member_discount' => $res->member_discount,
          );

          $promo_data = array(
            'promo_id' => '',
            'room_code' => $res->room_code,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
          );
          $discount_return[] = getRoomsPromotion($res->total_cost,$promo_night,$promo_data,$admin_data,$total_taxes,$tempsearch_id);
        }
      }
      // echo '<pre>';print_r($discount_return);exit;
      if(!empty($discount_return)) {
        $member_cost=0;$member_discount=0;$org_cost=0;$disc_cost=0;$total_discount=0;
        $promo_ids = array();
        for($i=0;$i<count($discount_return);$i++) {
          $promo_ids[] = $discount_return[$i]['promo_id'];
          $org_cost += $discount_return[$i]['org_cost'];
          $disc_cost += $discount_return[$i]['disc_cost'];
          $member_cost += $discount_return[$i]['member_cost'];
          $total_discount += $discount_return[$i]['total_discount'];
          $member_discount += $discount_return[$i]['member_discount'];
        }

        $disc_msg = $discount_return[0]['disc_msg'];
        $discount_badge = $discount_return[0]['discount_badge'];
        $org_price_div = $discount_return[0]['org_price_div'];
        $promo_id = implode(',', $promo_ids);

        if($total_taxes == '' || $total_taxes == 'undefined') {
          $total_taxes = $discount_return[0]['taxes'];
        }
        $returnarr = array(
          'org_cost' => $org_cost,
          'disc_cost' => $disc_cost,
          'total_discount' => $total_discount,
          'discount' => $member_discount,
          'discount_badge' => $discount_badge,
          'member_cost' => $member_cost,
          'total_cost' => $member_cost,
          'member_discount' => $member_discount,
          'disc_msg' => $disc_msg,
          'org_price_div' => $org_price_div,
          'promo_id' => $promo_id,
          'taxes' => $total_taxes,
        );
        
        if(isset($_POST['search_id']) && $_POST['search_id'] != '') {
          echo json_encode($returnarr);
        } else {
          return $returnarr;
        }
      }
    }


}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */