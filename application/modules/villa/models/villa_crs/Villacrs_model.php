<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class villacrs_model extends CI_Model {

    const CODE_START = '10000000';

    function __construct() {
        parent::__construct();
    }

    function getApiAuthDetails($api) {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', $api);
        $this->db->where('service_type', 9);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
     public function get_block_list($villaCode) {
        $this->db->select('*');
        $this->db->where('villa_id',$villaCode);
        $this->db->from('villa_blocking_dates');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function check_block_list($checkIn,$checkOut,$villaCode) {
        $this->db->select('*');
        $this->db->from('villa_blocking_dates');
        $this->db->where('villa_id',$villaCode);
        $begin = new DateTime($checkIn);
        $end   = new DateTime($checkOut);
        $whereb = '';
        $intervals = $begin->diff($end);
        $interval = $intervals->d;
        if($interval > 1) {
          // $begin->modify('+1 day');
          $whereb .= "(FIND_IN_SET('".$begin->format("d/m/Y")."',from_date)>0";
          $begin->modify('+1 day');
          for($i = 1; $i <= ($interval-1); $i++) {
            $whereb .= " OR FIND_IN_SET('".$begin->format("d/m/Y")."',from_date)>0";
            $begin->modify('+1 day');
          }
          $whereb .= " OR FIND_IN_SET('".$begin->format("d/m/Y")."',from_date)>0 )";
          $this->db->where($whereb);
        } else {
          // $begin->modify('+1 day');
          $this->db->where("FIND_IN_SET('".$begin->format("d/m/Y")."',from_date)>",0);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function check_search_data($sess_id,$uniqueRefNo) {
          $this->db->select('*');           
          $this->db->from('villa_search_data');  
          $this->db->where('session_id',$sess_id);
          $this->db->where('uniqueRefNo',$uniqueRefNo);
          $query=$this->db->get();
          if($query->num_rows() > 0)  {
            return $query->row();
          } else {
            return '';
          }
     }

    public function delete_temp_results($sess_id,$api) {
        $this->db->where('session_id', $sess_id);
         $this->db->where('api', $api);
        $this->db->delete('villa_search_result');
    }

    public function get_crs_villa_rates($checkin,$checkout,$villa_code='') {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        // $occupancy = $guests;
        $this->db->select('a.*,rr.*');
        $this->db->from('villa_list a');
        $this->db->join('sup_villa_rates rr', 'a.property_code = rr.villa_code');
        $this->db->where('rr.status', 1);
        if(!empty($villa_code)){
          $this->db->where('rr.villa_code', $villa_code);
        }
        $this->db->where('rr.villa_avail_date >=', $checkin);
        $this->db->where('rr.villa_avail_date <=', $checkout);
        $this->db->where('rr.villas_available', 1);
        $this->db->order_by('rr.villa_rate', 'ASC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function get_villa_blocks($checkin,$checkout,$villa_code){
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $this->db->select('villa_avail_date');
        $this->db->from('sup_villa_rates');
        // $this->db->where('status', 1);
        $this->db->where('villa_code', $villa_code);
        $this->db->where('villa_avail_date >=', $checkin);
        $this->db->where('villa_avail_date <=', $checkout);
        $this->db->where('villas_available', 0);
        $this->db->order_by('villa_rate', 'ASC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return array();
        }
    }

    function check_crs_villa_normal_cancel_policy($rowarr,$checkIn) {     
        $this->db->select('days_before_checkin,per_rate_charge,cancel_rates_type');
        $this->db->from('sup_villa_cancellation_rates');
        $this->db->where('supplier_id',$rowarr['supplier_id']);
        $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
        $this->db->where('villa_code',$rowarr['villa_code']);
        $this->db->where('villa_avail_date', $checkIn);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';  
    }

    function check_villa_search($api,$sess_id,$villa_code) {
        $this->db->select('*');
        $this->db->from('villa_search_result'); 
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('villa_code', $villa_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';  
        }
    }

    public function insert_crs_data($insertion_data) {
        $this->db->insert_batch('villa_search_result', $insertion_data);
    }

    public function getVillaDetails($villaCode, $searchId) {
        $this->db->select('p.*,t.*,p.facilities as amenities,c.city_name');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code');
        $this->db->join('jamaican_city_list c', 'p.cityid = c.id', 'left');
        $this->db->where('t.search_id', $searchId);
        $this->db->where('t.villa_code', $villaCode);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function getSupVillaDetails($villaCode) {
        $this->db->select('p.*,c.city_name,t.image,t.description,t.session_id,t.xml_currency,t.api,t.search_id,t.total_cost,p.hotel_facilities as amenities');
        $this->db->from('hotel_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code');
        $this->db->join('jamaican_city_list c', 'p.cityid = c.id', 'left');
        // $this->db->where('t.search_id', $searchId);
        $this->db->where('t.villa_code', $villaCode);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function get_gallery($villaCode,$lt) {
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('property_code', $villaCode); 
        $this->db->limit($lt);      
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_villa_details($api, $sess_id, $villaCode, $searchId) {
        // echo '<pre>';print_r($searchId);
        $this->db->select('a.*,b.*');
        $this->db->from('villa_search_result a');
        $this->db->join('villa_list b', 'a.villa_code = b.property_code', 'left');
        $this->db->where('b.property_code', $villaCode);
          //$this->db->where('b.api', $api);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where('a.search_id', $searchId);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {

            return $query->row();
        } else {
            return '';
        }
    }

    public function get_block_date($villaCode) {
        // echo '<pre>';print_r($searchId);
        $this->db->select('villa_blocking_dates.from_date');
        $this->db->from('villa_blocking_dates');
        $this->db->where('villa_id', $villaCode);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {

            return $query->row();
        } else {
            return '';
        }
    }


    public function update_villa_availability($sess_id,$uniqueRefNo,$data) {
      $this->db->where('uniqueRefNo', $uniqueRefNo);
      $this->db->where('session_id', $sess_id);
      $this->db->update('villa_search_data',$data);
    }
    public function update_villa_price($villa_code,$search_id,$session_id,$data) {
      $this->db->where('search_id', $search_id);
      $this->db->where('villa_code', $villa_code);
      $this->db->where('session_id', $session_id);
      $this->db->update('villa_search_result',$data);
    }

    public function preBookDetails($api, $sess_id, $villaCode, $searchId) {
        $this->db->select('a.*,b.*');     
        $this->db->from('villa_search_result a'); 
        $this->db->join('villa_list b', 'a.villa_code = b.property_code', 'left');
        $this->db->where('b.property_code', $villaCode);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where('a.search_id', $searchId);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();           
        } else {
            return '';
        }
    }

    function get_last_booking_code() {
        $this->db->select('b.booking_id');
        $this->db->from('(select booking_id from sup_villa_booking order by booking_id DESC) as b');
        $this->db->limit(1);
        // $this->db->group_by('b.booking_id');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->booking_id;
        } else {
            return self::CODE_START;
        }
    }

    public function insert_crs_booking($data) {
        $insert = $this->db->insert('sup_villa_booking', $data);
        return $insert;
    }

    public function insert_crs_booking_pass($booking_id,$uniqueRefNo) {
        $passenger_info = $this->session->userdata('passenger_info');
        // $adultTitles = $passenger_info['adults_title'];
        $GuestFirstName = $passenger_info['GuestFirstName'];
        $GuestLastName = $passenger_info['GuestLastName'];

        $mobile = $passenger_info['GuestMobileNo'];
        $email = $passenger_info['GuestEmailID'];
        $user_pincode = $passenger_info['GuestPostalCode'];
        $user_city =  $passenger_info['GuestCity'];
        $user_state =  $passenger_info['GuestState'];
        $user_country =  $passenger_info['GuestCountryCode'];
        $address = $passenger_info['GuestAddress'];

        $data = array(
            'booking_id' => $booking_id,
            'uniqueRefNo' => $uniqueRefNo,
            'pass_type' => 'guests',
            'title' => '',
            'first_name' => $GuestFirstName,
            'last_name' => $GuestLastName,
            'mobile' => $mobile,
            'email' => $email,
            'zip_code'=>$user_pincode,
            'city'=>$user_city,
            'state'=>$user_state,
            'country'=>$user_country,
            'address'=>$address,
        );
        $this->db->insert('sup_villa_booking_pass', $data);
    }

    function get_supplier_balance($supplier_id) {
        $this->db->select('available_balance')
                ->from('sup_acc_summary')
                ->where('supplier_id', $supplier_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }
        return $balance;
    }

    function insert_supplier_act_summary($insertion_data) {
        $this->db->insert('sup_acc_summary', $insertion_data);
            return true;
    }

    function update_crs_villa_allotment($id,$total_booking) {
        $this->db->set('villas_available', 0, FALSE);
        $this->db->where('sup_villa_rates_id',$id);
        $this->db->update('sup_villa_rates');
    }

    public function insert_villa_booking_information_data($data) {
        $this->db->insert('villa_booking_villa_info', $data);
        // echo $this->db->last_query();exit;
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $passenger_info = $this->session->userdata('passenger_info');
            $GuestFirstName = $passenger_info['GuestFirstName'];
            $GuestLastName = $passenger_info['GuestLastName'];

            $mobile = $passenger_info['GuestMobileNo'];
            $email = $passenger_info['GuestEmailID'];
            $user_pincode = $passenger_info['GuestPostalCode'];
            $user_city =  $passenger_info['GuestCity'];
            $user_state =  $passenger_info['GuestState'];
            $user_country =  $passenger_info['GuestCountryCode'];
            $address = $passenger_info['GuestAddress'];

            $guest_data = array(
                'uniqueRefNo' => $data['uniqueRefNo'],
                'passenger_type' => 'guest',
                'title' => '',
                'first_name' => $GuestFirstName,
                'last_name' => $GuestLastName,
                'mobile' => $mobile,
                'email' => $email,
                'city'=>$user_city,
                'state'=>$user_state,
                'zip_code'=>$user_pincode,
                'address'=>$address,
                'country'=>$user_country,
            );
            $this->db->insert('villa_booking_passengers_info', $guest_data);
        }
        return true;
    }

    public function getvillacodes($cityid,$start,$end){
        $this->db->select('property_code');
        $this->db->where('cityid',$cityid); 
        // $this->db->where('admin_status','1');
        $this->db->where('status','1');
        $this->db->limit($end,$start);
        $this->db->from('villa_list');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function check_crs_villa_price($rowarr,$checkIn,$checkout) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $this->db->select('sp.*,b.price');
        $this->db->from('sup_villa_rates sp');
        $this->db->join('villa_list b', 'sp.villa_code = b.property_code', 'left'); 
        $this->db->where('sp.villas_available',1);
        $this->db->where('sp.supplier_id',$rowarr['supplier_id']);
        $this->db->where('sp.sup_villa_id',$rowarr['sup_villa_id']);   
        $this->db->where('sp.villa_code',$rowarr['villa_code']);   
        $this->db->where('sp.villa_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"');  
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';  
    }

    function check_crs_villa_allotment($id) {
        $this->db->select('*');
        $this->db->from('sup_villa_rates'); 
        $this->db->where('sup_villa_rates_id',$id);
        $this->db->where('villas_available', 1);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';  
        } 
    }


    function update_crs_villa_search($searchId,$sessionId,$villaCode,$data) {
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('villa_code',$villaCode);
        $this->db->update('villa_search_result',$data);
    }

    public function getCountry() {
        $this->db->select('name');
        $this->db->from('country');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
           return '';
        } 
    }


}