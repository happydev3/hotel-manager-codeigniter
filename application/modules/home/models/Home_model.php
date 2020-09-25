<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {
    function __construct() 
    {
       parent::__construct();
    } 
    public function get_supplier_email($supplier_id) {
        $this->db->select('supplier_email');
        $this->db->from('supplier_info');
        $this->db->where('id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
          $result = $query->row();
          return $result->supplier_email;
        } else  {
          return '';
        }
    }

  public function get_hotel_city_list($search) { 
        $where = "city_name LIKE '%" . $search . "%' OR country_name LIKE '%" . $search . "%'";
        $this->db->select('*');
        // $this->db->from('ace_jac_roomsxml_gta_city');
        $this->db->from('jamaican_city_list');
        $this->db->where($where);
        // $this->db->where('status', 1);
        $this->db->order_by('city_name');
         $this->db->limit(10);        
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    public function get_holiday_city_list($search='',$region_id=''){
        $where = "(holiday_city.city_name LIKE '%".$search."%' OR holiday_country.country_name LIKE '%".$search."%' OR holiday_continent.continent_name LIKE '%".$search."%')";
       $this->db->select('*');
        $this->db->from('holiday_city');      
        $this->db->join('holiday_country', 'holiday_country.country_id= holiday_city.country_id');
        $this->db->join('holiday_continent', 'holiday_continent.continent_id= holiday_country.continent_id');
        if($region_id!='')
        {
           $this->db->where('holiday_continent.continent_id',$region_id); 
        }
        $this->db->where('holiday_city.status','1');
         $this->db->where($where);
         $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return '';
        }
    }

    public function get_villa_city_list($search) { 
        $where = "city_name LIKE '%" . $search . "%' OR country_name LIKE '%" . $search . "%'";
        $this->db->select('*');
        // $this->db->from('ace_jac_roomsxml_gta_city');
        $this->db->from('jamaican_city_list');
        $this->db->where($where);
        // $this->db->where('status', 1);
        $this->db->order_by('city_name');
         $this->db->limit(10);        
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
    
   public function get_hotel_city_listold($search) { 
        $where = "cityname LIKE '%" . $search . "%' OR countryname LIKE '%" . $search . "%'";
        $this->db->select('*');
        $this->db->from('fitruums_city_list');
        $this->db->where($where);
        // $this->db->where('status', 1);
        $this->db->order_by('cityname');
         $this->db->limit(10);        
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

   public function popularCities($module_type='') {
      if($module_type == 'hotels-tab'){
        $mod = 1;
      } elseif($module_type == 'villas-tab'){
        $mod = 2;
      } elseif($module_type == 'tours-tab'){
        $mod = 3;
      } else{
        $mod = '';
      }
      $this->db->select('*');
      $this->db->from('popularcities');      
      $this->db->where('module_type', $mod);
      $this->db->where('status', 1);
      $this->db->order_by('name');
      $this->db->limit(13);        
      $query = $this->db->get();
       if ($query->num_rows() == '') {
          return '';
       } else {
          return $query->result();
       }
    }

   public function get_country()
   {
        $this->db->select('iso2 as country_code,name as country_name');
        $this->db->from('country');
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        if ($query->num_rows() == '')
        {
             return '';
        }
        else 
        {
            return $query->result();
        }
    }
    
     public function get_hotel_booking_summary($user_email, $mobile_no, $booking_ref) {
                 $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo','LEFT')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo','LEFT')
                ->where('hr.uniqueRefNo', $booking_ref)
                ->group_by('hr.uniqueRefNo');
        $query = $this->db->get();
//echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
      public function get_tran_booking_summary($booking_ref) {
                 $this->db->select('hr.*,hh.*')
                ->from('transfer_booking_reports hr')
                ->join('transfer_passengers_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->where('hr.uniqueRefNo', $booking_ref);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
      public function get_sight_booking_summary($booking_ref) {
                 $this->db->select('sr.*,sp.*,ss.*')
                ->from('sight_booking_reports sr')
                ->join('sight_booking_passengers_info sp', 'sr.uniqueRefNo = sp.uniqueRefNo')
                ->join('sight_booking_sights_info ss', 'sr.uniqueRefNo = ss.uniqueRefNo')
                ->where('sr.uniqueRefNo', $booking_ref);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
      public function get_hotel_booking_report($booking_ref,$unique_ref) {  
                 $this->db->select('hr.*,hh.city as hotel_city,hh.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                 ->where('hr.uniqueRefNo', $unique_ref)
                           ->where('hr.Booking_RefNo', $booking_ref);    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function getcontent($type)
    {    
        $this->db->select('*');
        $this->db->from('cms');
        $this->db->where('type',$type);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function getTopdeals( )
    {    
        $this->db->select('*');
        $this->db->from('topdeals');
        $this->db->where('status',1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function aboutcity($code)
    {    
        if(!empty($code))
        {
          $this->db->select('*');
          $this->db->from('aboutcity');
          $this->db->where('code',$code);
          $this->db->where('status',1);
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
              return $query->row();
          }
        }
        return '';
    }

     public function popularhotel($code)
    {    
        if(!empty($code))
        {
          $this->db->select('*');
          $this->db->from('popularhotel');
          $this->db->where('city_code',$code);         
          $this->db->where('status',1);
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
              return $query->result();
          }
        }
        return '';
    }

    public function popularcityhotel()
    {    
         $this->db->select('*');
          $this->db->from('popularcityhotel');
          $this->db->where('status',1);
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
              return $query->result();
          }
      
        return '';
    }


     public function getApiPermanentHotels($code,$hotel_code,$api)
    {    
        if(!empty($code))
        {
          $this->db->select('*');
          $this->db->from('api_permanent_hotels');
          $this->db->where('city_code',$code);         
          $this->db->where('hotel_code',$hotel_code);         
          $this->db->where('api',$api);         
          $this->db->where('status',1);
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
              return $query->row();
          }
        }
        return '';
    }


    public function getTopdealsDetails($id)
    {    
        $this->db->select('*');
        $this->db->from('topdeals');
        $this->db->where('id',$id);
        $this->db->where('status',1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function getTopdealsHotelDetails($id)
    {    
        $this->db->select('*');
        $this->db->from('topdealshotel');
        $this->db->where('topdealscode',$id);
        $this->db->where('status',1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function getFitruumsPermanentHotels($hotel_code)
    {    
        if(!empty($hotel_code))
        {
          $this->db->select('*');
          $this->db->from('fitruums_hoteldetails');
          $this->db->where('hotel_code',$hotel_code);         
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
              return $query->row();
          }
        }
        return '';
    }

    public function getBanners($module_type) {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where('module_type',$module_type);
        // $this->db->where('status',1);
        $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->banner_path;
        }
        return '';
    }

    public function top_deals() {
        $this->db->select('*');
        $this->db->from('top_deals');
        $this->db->where('status',1);
        // $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function popular_destination() {
        $this->db->select('*');
        $this->db->from('popular_destination');
        $this->db->where('status',1);
        // $this->db->limit(1);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function check_email($email){
      $this->db->select('email');
      $this->db->from('email_subscribers');
      $this->db->where('email',$email);
      // $this->db->where('status',1);
      $this->db->limit(1);
      $query=$this->db->get();
      if ($query->num_rows() > 0) {
          $result = $query->row();
          return $result->email;
      } else{
        return '';
      }
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email)
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function getSubscriptionText($module_type) {
        $this->db->select('*');
        $this->db->from('subscription');
        $this->db->where('module_type',$module_type);
        $this->db->where('status',1);
        $this->db->limit(1);
        $query=$this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0){
            return $query->row();
        } else{
          return '';
        }
    }
    public function getRoomsPromotion($promo_id) {
        $sql = "SELECT *,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate`  FROM promotion_ota WHERE id=?";
        $query = $this->db->query($sql,[$promo_id]);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

}