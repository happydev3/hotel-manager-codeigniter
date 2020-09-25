<?php

class B2c_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validate_credentials($loginEmailId, $loginPassword) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $loginEmailId)
                // ->where('user_password', $loginPassword)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function insert_login_activity() {
        $user_no = $this->session->userdata('user_no');
        $session_id = $this->session->session_id;
        $ip_address = $this->input->ip_address();     
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'user_no' => $user_no,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,            
        );

        if ($this->db->insert('user_login_history', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo($user_no) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_no', $user_no)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return '';
    }

  public function addUser($user_email, $user_password, $first_name, $last_name, $mobile_no,$recaptcharesponse='') 
  {
        $data = array(
            'user_email' => $user_email,
            'user_password' => $user_password,            
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,			 
            'status' => 1,
            'recaptcharesponse'=>$recaptcharesponse,
         );
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->insert('user_info', $data);
        $id = $this->db->insert_id();       
        if(!empty($id)) 
        {            
            $user_no = 'VM'.$id.rand(1000, 9999);          
            $data1 = array('user_no' => $user_no);
            $this->db->where('id', $id);
            $this->db->update('user_info', $data1);
            return $user_no;
        } 
        else
        {   
            return '';
        }
    }

    public function update_user($user_no, $title, $first_name, $middle_name,$last_name,$gender, $mobile_no, $address, $pin_code, $city, $state, $country) {
        $data = array(
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'mobile_no' => $mobile_no,           
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,             
        );

        $this->db->where('user_no', $user_no);
        if ($this->db->update('user_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_password($user_no, $password = '') {
        if (!empty($password)) {
            $data['user_password'] = $password;
            $where = "user_no = '$user_no'";
            if ($this->db->update('user_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

//     public function reset_password($user_no, $password = '') {
//        if (!empty($password)) {
//            $data['user_password'] = $password;
//            $where = "user_no = '$user_no'";
//            if ($this->db->update('user_info', $data, $where)) {
//                return true;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }

    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2c_hotel_booking_summary($user_no) {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                ->where('hr.user_no', $user_no)
                ->order_by('hr.report_id', 'DESC')
                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
         // echo '<pre>';print_r($this->db->last_query()); exit;

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2c_villa_booking_summary($user_no) {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*')
                ->from('villa_booking_reports hr')
                ->join('villa_booking_villa_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('villa_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                ->where('hr.user_no', $user_no)
                ->order_by('hr.report_id', 'DESC')
                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
         // echo '<pre>';print_r($this->db->last_query()); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2c_holiday_booking_summary($user_no) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('holiday_booking_reports hr')
                ->join('holiday_booking_holiday_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('holiday_booking_passenger_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                ->where('hr.user_no', $user_no)
                ->order_by('hr.holiday_booking_id', 'DESC')
                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
         // echo '<pre>';print_r($this->db->last_query()); //exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }



    public function get_forgot_password($loginEmailId) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('user_email', $loginEmailId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
public function update_user_activation_key($activation_key,$user_no) {
		$data = array(
			'activation_key' => $activation_key,
		);
		$this->db->where('user_no',$user_no);
		$this->db->update('user_info',$data);
	}
    public function getUserdetail($email_id, $user_no) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email_id)
                ->where('user_no', $user_no)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_hotel_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                // ->join('user_info u', 'hr.user_no = u.user_no')
                ->where('hr.uniqueRefNo', $sysRefno);
               // ->order_by('hh.hotel_booking_id', 'DESC')
               // ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
        // echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function get_villa_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('villa_booking_reports hr')
                ->join('villa_booking_villa_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('villa_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                // ->join('user_info u', 'hr.user_no = u.user_no')
                ->where('hr.uniqueRefNo', $sysRefno);
               // ->order_by('hh.hotel_booking_id', 'DESC')
               // ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
        //echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }


    public function get_client_id($api) {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', $api);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function update_b2c_hotel_booking_status($Book_reference) {
        $data['Booking_Status'] = 'Cancelled';
        $where = "Booking_RefNo = '$Book_reference'";
        if ($this->db->update('hotel_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
	 public function get_b2c_bus_booking_summary($user_no) {
        $this->db->select('br.*,br.trip_type as triptype,bp.*')
                ->from('bus_booking_reports br')
                ->join('bus_booking_pass_info bp', 'br.uniqueRefNo = bp.uniqueRefNo')
                ->where('br.user_no', $user_no)
                ->order_by('br.report_id', 'DESC')
                ->group_by('bp.uniqueRefNo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getUserInfoDetails($user_no,$activation_key) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_no', $user_no)
                ->like('activation_key', $activation_key)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

   public function get_b2c_holiday_booking_report($user_no) {
    $this->db->select('hr.*,raz.paid_amount as paid_amount,raz.email as email,raz.contact as contact')
                ->from('holiday_booking_reports hr')
                ->join('pay_details_razorpay raz', 'hr.uniqueRefNo = raz.uniqueRefNo')
                ->where('hr.user_no', $user_no)
                ->where('raz.service_type', 6)
                ->order_by('hr.holiday_booking_id', 'DESC')
                ->group_by('hr.uniqueRefNo');
        $query = $this->db->get();




        //  $this->db->select('*');
        // $this->db->from('holiday_booking_reports');      
        // $this->db->where('user_no',$user_no);
        // $query = $this->db->get();
        // echo '<pre>';print_r($this->db->last_query()); exit;

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }
    public function get_country_fulllist() {
    $where = "(name NOT LIKE 'India')";
        $this->db->select('*');
         $this->db->from('country');
         $this->db->where($where);
        $query = $this->db->get();
        //$this->db->limit(0,5);
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return false;
    }

    public function get_hotel_booking_pass_info($unique_ref){
        $this->db->select('hr.*')
            ->from('hotel_booking_passengers_info hr')
            ->where('hr.uniqueRefNo', $unique_ref);      
            // ->where('hr.agent_id',0);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else{
            return false;
        }
    
    }

    public function updateHotelBookingCancel($uniqueRefNo){
        $data['Booking_Status'] = 'Cancelled';
        $data['Cancellation_Status'] = 'Cancelled';
        $where = "uniqueRefNo = '$uniqueRefNo'";
        if ($this->db->update('hotel_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVillaBookingCancel($uniqueRefNo){
        $data['booking_status'] = 'Cancelled';
        $data['Cancellation_Status'] = 'Cancelled';
        $where = "uniqueRefNo = '$uniqueRefNo'";
        if ($this->db->update('villa_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function updateHotelsRoomAllotment($room_allotment_id,$total_rooms) {
        $this->db->set('total_booking', '`total_booking` - '.$total_rooms, FALSE);
        $this->db->where('sup_hotel_room_allotment_id',$room_allotment_id);
        $this->db->update('sup_hotel_room_allotment');
    }

    function updateVillaAllotment($villa_allotment_id,$total_villa) {
        $data = array(
            'villas_available' => 1
        );
        $this->db->where('sup_villa_rates_id',$villa_allotment_id);
        $this->db->update('sup_villa_rates',$data);
    }


}
