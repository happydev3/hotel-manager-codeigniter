<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class B2c extends MX_Controller 
{

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('B2c_Model');
		//$this->load->module('message');
    }

    public function index() {
        // redirect('b2c/dashboard', 'refresh');
         redirect('b2c/dashboard', 'refresh');
    }

    public function dashboard() {
        // redirect('', 'refresh');
        // echo $this->session->userdata('user_logged_in');
        if (!$this->session->userdata('user_logged_in'))
        redirect('home/index', 'refresh');

        $data['user_no']= $user_no = $this->session->userdata('user_no');
        $data['lefttab']="My Dashboard";
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_no);
        // echo '<pre/>';print_r($data['user_info']);exit;

        $this->load->view('b2c/home/b2c_index', $data);
    }


    function user_login() {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean');

        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('user_email');
            // $loginPassword = md5($this->input->post('user_password'));
            $loginPassword = $this->input->post('user_password');

            $res = $this->B2c_Model->validate_credentials($loginEmailId, $loginPassword);
            //echo '<pre/>';print_r($res);exit;
            if (!empty($res)) {
                $dbpass = $res->user_password;
                if(password_verify($loginPassword, $dbpass)===true) {
                    $sessionUserInfo = array(                   
                        'user_id' => $res->id,
                        'user_no' => $res->user_no,
                        'user_email' => $res->user_email,
                        'first_name' => $res->first_name,
                        'last_name' => $res->last_name,
                        'user_logged_in' => TRUE
                    );
                    $this->session->set_userdata($sessionUserInfo);
                    $this->B2c_Model->insert_login_activity();
                    redirect('b2c/index', 'refresh');
                } else {
                    $error = 'Invalid Email Id/Password.';
                    redirect('b2c/error_page/' . base64_encode($error));
                }
            } else {
                $error = 'Invalid Email Id/Password.';
                redirect('b2c/error_page/' . base64_encode($error));
            }
        }

        redirect('home/index', $data);
    }

    function user_register() {		
		// echo "<pre/>";print_r($_POST);exit;
	    //echo "fhj";exit;
        $this->form_validation->set_rules('user_email', 'Email', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        // $data['country_list'] = $this->B2c_Model->get_country_list();
        if ($this->form_validation->run() == FALSE) {
			$msg = 'Please Give Valid Details To Continue Registration...';
            $status = 'false';
            // redirect('b2c/error_page/' . base64_encode($error));
        } else {
            $user_email=$_POST['user_email'];
            // $user_password=md5($_POST['user_password']); 
            $user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT); 
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $mobile_no=$_POST['mobile_no'];
            $recaptcharesponse=$_POST['g-recaptcha-response'];
            $email_check = $this->B2c_Model->check_email_availability($user_email);

            if($email_check != '' || !empty($email_check)) {
                $msg = 'Email Already Exists. Please use different email id to continue registration...';
                $status = 'false';
                // redirect('b2c/error_page/' . base64_encode($error));
            } else { 
                $user_no=$this->B2c_Model->addUser($user_email, $user_password, $first_name, $last_name, $mobile_no,$recaptcharesponse);      
                if(!empty($user_no)) {
                    $res = $this->B2c_Model->validate_credentials($user_email,$user_password);
                    if ($res !== false) {
                        $this->setLogin($res);
                    }
                    $msg = '';
                    $status = 'true';
				    // $msg = base64_encode("Your Registration is successful. Please login now.");
                    // $this->load->module('home/sendemail');
                    // $this->sendemail->registration_email($data_email);
                    // redirect('b2c/success_page/'.$success); 
                } else {
                    $status = 'false';
                    $msg = 'User Registration Not Done. Please try after some time...';
                    // redirect('b2c/error_page/' . base64_encode($error));
                }
            }
        }

        $results=$this->load->view('home/user_menu','', TRUE);
        echo json_encode(array(
           'msg'=> $msg,
           'results'=>$results,
           'stat'=>$status,
        ));
    }

    public function my_profile() {
        // $data['country_list'] = $this->B2c_Model->get_country_list();
        $data['country_list'] = $this->B2c_Model->get_country_fulllist();
        $data['user_no']= $user_no = $this->session->userdata('user_no');

        $data['status'] = '';
        $data['errors'] = '';
        $data['lefttab']="My Account";
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_no);
        //echo '<pre/>';print_r($data['user_info']);exit;
        $this->load->view('b2c/account/view_profile', $data);
    }

    function update_profile() 
    {
        // echo '<pre/>';print_r($_POST);exit;		
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->B2c_Model->get_country_list();

        $data['user_no']= $user_no = $this->input->post('user_no');
        $data['user_info'] = $this->B2c_Model->getUserInfo($user_no);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2c/view_profile', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $user_no = $this->input->post('user_no');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name'); 
            $gender = $this->input->post('gender');
            $mobile_no = $this->input->post('mobile_no'); 
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $user_email = $this->input->post('user_email'); 
            $user_info = $this->B2c_Model->getUserInfo($user_no);
            // $zohoId=$user_info->zohoId;
            // echo $zohoId; exit;
            if ($this->B2c_Model->update_user($user_no, $title, $first_name, $middle_name,$last_name,$gender, $mobile_no,$address, $pin_code, $city, $state, $country)&&!empty($user_no)) 
            {
                // if(!empty($zohoId)){
                //    $this->load->module('b2c/zoho');
                //    $this->zoho->updateRecordsIntoZohoB2C($zohoId,$user_no, $title, $first_name, $middle_name,$last_name,$gender, $mobile_no, $address, $pin_code, $city, $state, $country); 
                //    }
                redirect('b2c/my_profile', 'refresh');
            } 
            else 
            {
                $data['errors'] = 'Your Profile not Updated...';
                $this->load->view('b2c/account/view_profile', $data);
            }
             
        }
    }

    function change_password() {
        // $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';
        $data['lefttab']="My Account";
        $data['user_no']= $user_no = $this->session->userdata('user_no');
        $data['user_info'] = $user_info = $this->B2c_Model->getUserInfo($user_no);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2c/account/change_password', $data);
        } else {
            if (!empty($user_info)) {
                if (password_verify($this->input->post('current_password'), $user_info->user_password)) {
                    // $password = md5($this->input->post('password'));
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    if ($this->B2c_Model->update_password($user_no, $password)) {
                        $data['status'] = 1;
                    } else {
                        $data['errors'] = 'Your Password not Updated';
                    }
                } else {
                    // $data['errors'] = 'New Password and Confirm Password is miss matched';
                    $data['errors'] = 'Invalid current password';
                }
            } else {
                $data['errors'] = 'Invalid credentials';
            }

            $this->load->view('b2c/account/change_password', $data);
        }
    }

    public function my_bookings() {
        if (!$this->session->userdata('user_logged_in'))
            redirect('home/index', 'refresh');

        $data['user_no']= $this->session->userdata('user_no');
        $user_no = $data['user_no'];
        $data['lefttab']="My Bookings";
        $data['hotel_booking_summary'] = $this->B2c_Model->get_b2c_hotel_booking_summary($user_no);
        $data['villa_booking_summary'] = $this->B2c_Model->get_b2c_villa_booking_summary($user_no);
     	$data['holiday_booking_summary'] = $this->B2c_Model->get_b2c_holiday_booking_summary($user_no);
        // echo '<pre>';print_r($data['villa_booking_summary']);exit;
        // echo $this->db->last_query();exit;

        $this->load->view('b2c/bookings/view_booking_summary', $data);
    }

  

   
    function registration_conformation($user_email, $title, $first_name) {
        $curr_date = date("d/m/Y");

        $mess = 'Dear, ' . $title . ' ' . $first_name . '

					<br />
					<br />

					You have beeen Registered with our services,<br />
					<br />

					<div align="center" style="color:#F90;">User Registration Request from <a href="www.Vacaymenow.com">Vacaymenow</a></div>
					<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
					  <tr>
						<th>Name</th>
						<th>Email</th>
						<th>Date</th>
					  </tr>
					  <tr>
						<td>' . $first_name . '</td>
						<td>' . $user_email . '</td>
						<td>' . $curr_date . '</td>
					  </tr>
					</table>';	




        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@travelpd.com', 'Vacaymenow');
        $list = $user_email;
        $ci->email->to($list);
        $this->email->reply_to('bhavya@travelpd.com');
        $ci->email->subject('Registration');
        $ci->email->message($mess);

        $ci->email->send();


        $curr_date = date("d/m/Y");
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@travelpd.com', 'Vacaymenow');
        // $list = $user_email;
        $ci->email->to('bhavya@travelpd.com');
        $this->email->reply_to('bhavya@travelpd.com');
        $ci->email->subject('Registration');
        $ci->email->message($mess);

        $ci->email->send();


        //echo $this->email->print_debugger();
    }

    public function forgot_password() {
        // echo '<pre>'; print_r($_POST); exit;
         $this->form_validation->set_rules('email_id', 'Email', 'trim|required|xss_clean');
        $loginEmailId = $this->input->post('email_id');
        // echo $loginEmailId;
		$data = base64_encode($loginEmailId);
        $getpassword = '';
        $getpassword = $this->B2c_Model->get_forgot_password($loginEmailId);
		//print_r($getpassword);exit;
        $user_no = $getpassword->user_no;
        if ($getpassword) {
			  $activation_key = sha1($loginEmailId . 'Vacaymenow');	
			  $data = array(
				'emailid'	=> $loginEmailId,
				'user_no'	=> $user_no,
				'activation_key' => $activation_key,
			  );
			  $this->B2c_Model->update_user_activation_key($activation_key,$user_no);
			  // $this->load->module('home/email');						  
			  // $this->email->b2c_forgot_password($data);
			  $message = "A link has been sent to your email address to reset the password.";
             redirect('b2c/success_page/'.base64_encode($message), 'refresh');
            }
			else{
				$error="Please enter registered email-id";
				$this->error_page($error);
            }
        }
    

    public function load_forgot_password($user_no, $decode) {
       
        $userinfo=$this->B2c_Model->getUserInfoDetails($user_no,$decode);
        $data['user_no']=$userinfo->user_no;
        $data['email'] = $userinfo->user_email;
        $data['decode'] = $decode;
        $data['status'] = '';
        
        $this->load->view('b2c/account/forgot_password', $data);
    }

    function restore_password() {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $email_id = $this->input->post('email');
        $data['status'] = '';
        $data['errors'] = '';
        $user_no = $this->input->post('user_no');
        $data['user_no']= $user_no;
        $user_infoo = $this->B2c_Model->getUserdetail($email_id, $user_no);
        //echo '<pre>';print_r($agent_info); exit;
        $user_info = $user_infoo->user_no;

        if ($this->form_validation->run() == FALSE) {
            $data['email'] = $user_infoo->user_email;
            $this->load->view('account/forgot_password', $data);
        } else {
            // $password = md5($this->input->post('password'));
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            if ($this->B2c_Model->update_password($user_no, $password)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Your Password not Updated. Please try after some time...';
            }
            $data['email'] = $user_infoo->user_email;
            $data['user_no']= $user_info;
            $this->load->view('account/forgot_password', $data);
        }
    }
    
    function cancel_voucherold($case = '') {
        $uniqueRefNo = $_GET['voucherId'];
        $hotelRefId = $_GET['hotelRefId'];
        $data['book_details'] = $book_details = $this->B2c_Model->get_hotel_booking_details($uniqueRefNo);
        // echo '<pre>';print_r($book_details);exit;
        $api = $book_details->api;
        // $data['Currency'] = $Currency;
        // $data['boookingno'] = $hotelRefId;
        $email = $book_details->email;
        //$user_no = $book_details->user_no;

        if ($api == 'hotel_crs') {
            $checkin = date('d M Y', strtotime($book_details->check_in));
            $checkin = str_replace(' ', '-', $checkin);
            $checkout = date('d M Y', strtotime($book_details->check_out));
            $checkout = str_replace(' ', '-', $checkout);

            if ($case == 'prepare') {
                // echo '<pre>';print_r($book_details);exit;
                $data['CancellationCharge'] = $book_details->cancellation_policy;
                $data['DisplayCurrencyCode'] = $book_details->Currency;
                $this->load->view('b2c/bookings/booking_cancel_details', $data);
            } else {
                $error = 'The ' . $bookref . ' ticket is successfully ' . $status . ' and the cancellation charge would be ' . $currency . ' ' . $charge;
                $data['status'] = $error;

                // $this->refund_cancelled_hotel($Booking_reference_ID, $status, $charge, $email);
                $this->B2b_Model->update_b2b_hotel_booking_status($Booking_reference_ID);
                $agent_available_balance = $this->B2b_Model->get_agent_available_balance($agent_no);
                $refund_amount = $charge;
                $available_balance = $agent_available_balance->available_balance;
                $agent_id = $agent_available_balance->agent_id;
                $closing_balance = $available_balance + $refund_amount;
                $this->B2b_Model->insert_b2b_cancel_refund_amt($agent_id, $agent_no, $refund_amount, $closing_balance, $Book_reference);


                $this->load->view('b2b/booking_cancel_confirm', $data);
            }
        }
    }

    function cancel_voucher($case = '') {
        $uniqueRefNo = isset($_GET['voucherId'])?$_GET['voucherId']:'';
        $bookRefId = isset($_GET['bookRefId'])?$_GET['bookRefId']:'';
        $callbackId = isset($_GET['callbackId'])?$_GET['callbackId']:'';
        $error = false;
        if(!empty($bookRefId) || !empty($callbackId) || !empty($uniqueRefNo)) {
            $api = base64_decode($callbackId);
            // echo '<pre>';print_r($api);exit;
            if ($api == 'hotel_crs') {
                $data['book_details'] = $book_details = $this->B2c_Model->get_hotel_booking_details($uniqueRefNo);
                // echo  $this->db->last_query();
                // echo '<pre>';print_r($book_details);exit;
                if(!empty($book_details)){
                    $email = $book_details->email;
                    $checkin = date('d M Y', strtotime($book_details->check_in));
                    $checkin = str_replace(' ', '-', $checkin);
                    $checkout = date('d M Y', strtotime($book_details->check_out));
                    $checkout = str_replace(' ', '-', $checkout);
                    // echo '<pre>';print_r($book_details);exit;
                    $data['CancellationCharge'] = $book_details->cancellation_policy;
                    $data['DisplayCurrencyCode'] = $book_details->Currency;
                    $this->load->view('b2c/bookings/booking_cancel_details', $data);
                } else {
                    $error = true;
                }
                
            } else if ($api == 'villa_crs') {
                $data['book_details'] = $book_details = $this->B2c_Model->get_villa_booking_details($uniqueRefNo);
                if(!empty($book_details)){
                    $email = $book_details->email;
                    $checkin = date('d M Y', strtotime($book_details->check_in));
                    $checkin = str_replace(' ', '-', $checkin);
                    $checkout = date('d M Y', strtotime($book_details->check_out));
                    $checkout = str_replace(' ', '-', $checkout);
                    // echo '<pre>';print_r($book_details);exit;
                    $data['CancellationCharge'] = $book_details->cancellation_policy;
                    $data['DisplayCurrencyCode'] = $book_details->Currency;
                    // $this->load->view('b2c/bookings/booking_cancel_details', $data);
                    $this->load->view('b2c/bookings/booking_cancel_details_villa', $data);
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        if($error) {
            $errordata = 'No booking found.';
            redirect('b2c/error_page/' . base64_encode($errordata), 'refresh');
        }
    }


    function cancel_voucher_confirm() {
        //echo 'hi';echo $bookref; exit;
        $uniqueRefNo = isset($_GET['voucherId'])?$_GET['voucherId']:'';
        $bookRefId = isset($_GET['bookRefId'])?$_GET['bookRefId']:'';
        $callbackId = isset($_GET['callbackId'])?$_GET['callbackId']:'';
        $error = false;
        if(!empty($bookRefId) || !empty($callbackId) || !empty($uniqueRefNo)) {
            $api = base64_decode($callbackId);
            if($api == 'villa_crs'){
                $book_details = $this->B2c_Model->get_villa_booking_details($uniqueRefNo);
            } else if($api == 'hotel_crs'){
                $book_details = $this->B2c_Model->get_hotel_booking_details($uniqueRefNo);
                // echo  $this->db->last_query();
                // echo '<pre>';print_r($book_details);exit;
            } else{
                $error = true;
            }
        } else {
            $error = true;
        }

        if($error) {
            $errordata = 'No booking found.';
            redirect('b2c/error_page/' . base64_encode($errordata), 'refresh');exit;
        }
        
        // echo $this->db->last_query();
        // echo '<pre>11';print_r($book_details);exit;
        $this->hotel_cancellation($book_details,$bookRefId,$api);
    }

    function hotel_cancellation($book_details,$Booking_RefNo,$api) {
        $error = false;
        if($api == 'villa_crs') {
            $allotment_arr = unserialize($book_details->allotment_arr);
            // echo '<pre>11';print_r($allotment_arr);exit;
            foreach ($allotment_arr as $key=>$val) {
              $this->B2c_Model->updateVillaAllotment($key,$val);
            }
            $cancel_report = $this->B2c_Model->updateVillaBookingCancel($book_details->uniqueRefNo);
        } else if($api == 'hotel_crs') {
            $allotment_arr = unserialize($book_details->allotment_arr);
            // echo '<pre>11';print_r($book_details);exit;
            if(!empty($allotment_arr)) {
                foreach ($allotment_arr as $key=>$val) {
                    $this->B2c_Model->updateHotelsRoomAllotment($key,$val);
                }
                $cancel_report = $this->B2c_Model->updateHotelBookingCancel($book_details->uniqueRefNo);
            } else {
                $error = true;
                $cancel_report = false;
            }
        } else {
            $error = true;
            $cancel_report = false;
        }
        if($error) {
            $errordata = 'Something went wrong or no booking found.';
            redirect('b2c/error_page/' . base64_encode($errordata), 'refresh'); exit;
        }
        
        if($cancel_report) {
            $CancellationCharge = $book_details->cancellation_policy;
            // $pass_info = $this->B2c_Model->get_hotel_booking_pass_info($book_details->uniqueRefNo);
            // redirect('home/cancel_requested/'.$book_details->Booking_RefNo.'/'.$book_details->uniqueRefNo.'/'.$CancellationCharge,'refresh');
            redirect('b2c/cancel_requested?voucherId='.$book_details->uniqueRefNo.'&bookRefId='.$Booking_RefNo.'&callbackId='.base64_encode($api),'refresh');
        } else {
            $errordata = 'Try again.';
            redirect('b2c/error_page/' . base64_encode($errordata), 'refresh');
        } 
    }

    public function cancel_requested() {
        $uniqueRefNo = isset($_GET['voucherId'])?$_GET['voucherId']:'';
        $bookRefId = isset($_GET['bookRefId'])?$_GET['bookRefId']:'';
        $callbackId = isset($_GET['callbackId'])?$_GET['callbackId']:'';
        $error = false;
        if(!empty($bookRefId) || !empty($callbackId) || !empty($uniqueRefNo)) {
            $api = base64_decode($callbackId);
            $Booking_RefNo = $bookRefId;
            $data['booking_ref'] = $Booking_RefNo;
             // echo '<pre>';print_r($data['booking_ref'] );exit;

            $data['api'] = $api;

            if($api == 'villa_crs') {
                $data['booking_type'] = 'villa';
                $data['book_details'] = $book_details = $this->B2c_Model->get_villa_booking_details($uniqueRefNo);
             // echo '<pre>';print_r($data['book_details'] );exit;
                if(!empty($book_details)){
                    $data['DisplayCurrencyCode'] = $book_details->Currency;
                    $data['CancellationCharge'] = $book_details->cancellation_policy;
                    $this->load->view('b2c/bookings/booking_cancel_confirm', $data);
                } else {
                    $error = true;
                }
            } elseif($api == 'hotel_crs') {
                $data['book_details'] = $book_details = $this->B2c_Model->get_hotel_booking_details($uniqueRefNo);
                if(!empty($book_details)){
                    $data['DisplayCurrencyCode'] = $book_details->currency;
                    $data['CancellationCharge'] = $book_details->cancellation_policy;
                    $this->load->view('b2c/bookings/booking_cancel_confirm', $data);
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }

        if($error) {
            $errordata = 'Try again.';
            redirect('b2c/error_page/' . base64_encode($errordata), 'refresh'); exit;
        }

    }


    function error_page($error) {
        $data['error'] = $error;
        $this->load->view('error_page', $data);
    }
    function success_page($success) {
        $data['success'] = $success;
        $this->load->view('success_page', $data);
    }
    
    public function checklogin() {
        $loginEmailId = $_POST['email'];    
        $loginPassword = $_POST['pass'];    
        // $loginPassword = md5($_POST['pass']);
        // $loginPassword = password_hash($_POST['pass'], PASSWORD_BCRYPT, ['cost' => 12]);
        $email_check = $this->B2c_Model->check_email_availability($loginEmailId);
        $res = $this->B2c_Model->validate_credentials($loginEmailId, $loginPassword);

        if (empty($email_check)) {
            $stat = 'false';
            $msg = 'Email Address is Incorrect';
        } else if (empty($res)) {
            $stat = 'false';
            $msg = 'Either Email Address or Password is Incorrect';
        } else if(!empty($res)) {
            $dbpass = $res->user_password;
            if(password_verify($loginPassword, $dbpass)===true) {
                $this->setLogin($res);
                $stat = 'true';
                $msg = '';
            } else {
                $stat = 'false';
                $msg = 'Password is Incorrect';
            }
        } else {
            $stat = 'false';
            $msg = 'Either Email Address or Password is Incorrect';
        }
        $results=$this->load->view('home/user_menu','', TRUE);
        echo json_encode(array(
           'msg'=> $msg,
           'results'=>$results,
           'stat'=>$stat,
       ));
    }

    public function setLogin($res){
        $sessionUserInfo = array(
            'user_no' => $res->user_no,
            'user_id' => $res->id,
            'user_email' => $res->user_email,
            'first_name' => $res->first_name,
            'last_name' => $res->last_name,
            'user_logged_in' => TRUE
        );
        $this->session->set_userdata($sessionUserInfo);
        $this->B2c_Model->insert_login_activity();
        return 1;
    }


    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_no');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('fbuser_login');
        $this->session->unset_userdata('guser_login');
        $this->session->unset_userdata('fbpicurl');
        $this->session->unset_userdata('gpicurl');
        // $this->session->sess_destroy();
        $results = $this->load->view('home/user_menu','', TRUE);
        echo json_encode(array(
            'results'=>$results,
        ));
        // redirect('home/index', 'refresh');
    }
	
	
}

/* End of file agent.php */
/* Location: ./application/controllers/agent.php */