<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Villa_Model extends CI_Model {
  
    public function __construct() {
        parent::__construct();
    }

    public function check_search_data($sess_id,$uniqueRefNo) {
      $this->db->select('*');           
      $this->db->from('villa_search_data');  
      $this->db->where('session_id',$sess_id);
      $this->db->where('uniqueRefNo',$uniqueRefNo);
      $query=$this->db->get();
      if($query->num_rows() > 0) {
        return $query->row();
      } else {
        return '';
      }
    }

   
    public function delete_temp_results($sess_id) {
        $this->db->where('session_id', $sess_id);      
        $this->db->delete('villa_search_result');
    }

    public function delete_temp_data($sess_id, $uniqueRefNo) {
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->where('session_id', $sess_id);
        $this->db->delete('villa_search_data');
    }

    public function getActiveAPIs() {
      $this->db->select('api_name');
      $this->db->from('api_info');
      $this->db->where('service_type', 9);
      $this->db->where('status', 1);
      $this->db->order_by('order_no', 'ASC');
      $query = $this->db->get();

      if($query->num_rows() > 0) {
          return $query->result_array();
      } else {
        return '';
      }
    }

    

    
function search_villa_package_result($city_id='',$bedrooms='',$bathrooms='') {

  $this->db->select('*');
  $this->db->from('villa_list');
  if($city_id!='') {
    // $this->db->where("FIND_IN_SET('".$city_id."',cityid)>",0);
    $this->db->where('cityid', $city_id); 
  }
  if($bedrooms!='') {
    $this->db->where('bedroom', $bedrooms); 
  }
  if($bathrooms!='') {
    $this->db->where('bathroom', $bathrooms); 
  }

  $this->db->where('status',1);              
  $this->db->order_by('price','asc');              
  $query = $this->db->get();
  // echo $this->db->last_query();//exit;
  if ($query->num_rows() > 0) {
      return $query->result();
  } else {
      return '';
  }
}

function search_villa_package_filter_results($city_id='',$bedrooms='',$bathrooms='') {

  $this->db->select('*');
  $this->db->from('villa_list');
  if($city_id!='') {
    // $this->db->where("FIND_IN_SET('".$city_id."',cityid)>",0);
    $this->db->where('cityid', $city_id); 
  }
  if($bedrooms!='') {
    $this->db->where('bedroom', $bedrooms); 
  }
  if($bathrooms!='') {
    $this->db->where('bathroom', $bathrooms); 
  }

  $this->db->where('status',1);              
  $this->db->order_by('price','asc');              
  $query = $this->db->get();
  // echo $this->db->last_query();//exit;
  if ($query->num_rows() > 0) {
      return $query->result();
  } else {
      return '';
  }
}

function get_villa_package_by_id($id) { 
        $this->db->select('*');
        $this->db->from('villa_list');
        $this->db->where('id',$id);
        $this->db->where('status',1); 
          // $this->db->where('status',1); 
        $query = $this->db->get(); 
        // echo $this->db->last_query(); exit;
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }
function get_villa_package_itinerary_by_id($id)
{
        $this->db->select('*');
        $this->db->from('villa_itinerary');
        $this->db->where('package_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

}
function get_villa_package_itinerary_images_by_id($id)
{
        $this->db->select('*');
        $this->db->from('villa_itinerary_images');
        $this->db->where('package_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

}
function get_city_details($id) {
       $this->db->select('*');
        $this->db->from('villa_city');
        $this->db->where('city_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
}
function get_country_details($id)
{
       $this->db->select('*');
        $this->db->from('villa_country');
        $this->db->where('country_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
}
function get_continent_details($id)
{
       $this->db->select('*');
        $this->db->from('villa_continent');
        $this->db->where('continent_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
}

function get_villa_package_images_by_id($id)
{
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('villa_list_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

}

function get_transportation_mode_by_id($id) {
        $this->db->select('*');
        $this->db->from('transportation_mode');
        $this->db->where('package_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

}

function get_route_map($id) {
    $this->db->where('package_id', $id);
    $this->db->select('*');
    $this->db->order_by('transport_day');
    $query = $this->db->get('villa_route_map');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return '';
    }
}



    public function getminmaxprice()
    {
      $this->db->select('MIN(t.pp_price) as minprice, MAX(t.pp_price) as maxprice');
      $this->db->from('villa_list t');
       $query = $this->db->get();
      if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    public function get_accomodation($id){
        $this->db->where('id', $id);
        $this->db->select('*');
        $this->db->from('villa_accomodation');     
        $query=$this->db->get();
        return $query->row();
    }


    function get_accomodation_images($id) {
       $this->db->select('*');
        $this->db->from('accomodation_images');
        $this->db->where('accomodation_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function get_popup_images($id,$table_name,$id_column,$active_day=NULL) {
       $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($id_column,$id);
        if(!empty($active_day)){
            $this->db->where('active_day',$active_day);
        }   
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function check_gallery_img($id,$table_name,$id_column) {
       $this->db->select('gallery_img');
        $this->db->from($table_name);
        $this->db->where($id_column,$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return '';
        }
    }

    function get_activity_by_id($id){
        $this->db->select('*');
        $this->db->from('villa_activity');
        $this->db->where('package_id',$id); 
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    function get_attraction_by_id($id){
        $this->db->select('*');
        $this->db->from('villa_attraction');
        $this->db->where('package_id',$id); 
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function get_acco_desc($id){
        $this->db->where('id', $id);
        $this->db->select('description,hotel_name');
        $this->db->from('villa_accomodation');     
        $query=$this->db->get();
        return $query->row();
    }

    function get_activity_desc($id, $tablename){
        $this->db->where('package_id', $id);
        $this->db->select('activity_description,activity_name');
        $this->db->from('villa_activity');     
        $query=$this->db->get();
        return $query->row();
    }
    function get_attraction_desc($id, $tablename){
        $this->db->where('package_id', $id);
        $this->db->select('attraction_description,attraction_name');
        $this->db->from('villa_attraction');     
        $query=$this->db->get();
        return $query->row();
    }

    function get_economy_rates($id){
        $this->db->select('*');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','Economy');
        $this->db->from('villa_rates');
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    
    function get_superior_rates($id){
        $this->db->select('*');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','Superior');
        $this->db->from('villa_rates');
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    function get_first_class_rates($id){
        $this->db->select('*');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','First class');
        $this->db->from('villa_rates');
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function get_luxury_rates($id){
        $this->db->select('*');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','Luxury');
        $this->db->from('villa_rates');
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_villa_pass_rate($id,$accom_type,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('villa_rates');
        $this->db->where('package_id',$id);
        $this->db->where('validity_from <=',$arrivaldate);
        if(!empty($end_date)){
          $this->db->where('validity_to >=',$end_date);
        }
        // $this->db->where('accomodation_type',$accom_type);
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }
    public function get_economy_pass_rate($id,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('villa_rates');
        $this->db->where('package_id',$id);
        $this->db->where('validity_from <=',$arrivaldate);
        if(!empty($end_date)){
          $this->db->where('validity_to >=',$end_date);
        }
        $this->db->where('accomodation_type','Economy');
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }
    public function get_superior_pass_rate($id,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('villa_rates');
        $this->db->where('package_id',$id);
        $this->db->where('validity_from <=',$arrivaldate);
        if(!empty($end_date)){
          $this->db->where('validity_to >=',$end_date);
        }
        $this->db->where('accomodation_type','Superior');
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }
    public function get_first_class_pass_rate($id,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('villa_rates');
        $this->db->where('package_id',$id);
        $this->db->where('validity_from <=',$arrivaldate);
        if(!empty($end_date)){
          $this->db->where('validity_to >=',$end_date);
        }
        $this->db->where('accomodation_type','First class');
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }
    public function get_luxury_pass_rate($id,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('villa_rates');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','Luxury');
        $this->db->where('validity_from <=',$arrivaldate);
        if(!empty($end_date)){
          $this->db->where('validity_to >=',$end_date);
        }
        $query=$this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_economy_rate_date($id){
      $this->db->select('validity_from,validity_to');
      $this->db->from('villa_rates');
      $this->db->where('package_id', $id);
      $this->db->where('accomodation_type','Economy');
      $query = $this->db->get();
      if ($query->num_rows > 0) {
        return $query->row();
        //  return true;
      }else{
        return false;
      }
    }
    public function get_superior_rate_date($id){
      $this->db->select('validity_from,validity_to');
      $this->db->from('villa_rates');
      $this->db->where('package_id', $id);
      $this->db->where('accomodation_type','Superior');
      $query = $this->db->get();
      if ($query->num_rows > 0) {
        return $query->row();
        //  return true;
      }else{
        return false;
      }
    }
    public function get_first_class_rate_date($id){
      $this->db->select('validity_from,validity_to');
      $this->db->from('villa_rates');
      $this->db->where('package_id', $id);
      $this->db->where('accomodation_type','First class');
      $query = $this->db->get();
      if ($query->num_rows > 0) {
        return $query->row();
        //  return true;
      }else{
        return false;
      }
    }
    public function get_luxury_rate_date($id){
      $this->db->select('validity_from,validity_to');
      $this->db->from('villa_rates');
      $this->db->where('package_id', $id);
      $this->db->where('accomodation_type','Luxury');
      $query = $this->db->get();
      if ($query->num_rows > 0) {
        return $query->row();
        //  return true;
      }else{
        return false;
      }
    }
    public function get_passrate_date($id,$accom_type){
      $this->db->select('validity_from,validity_to');
      $this->db->from('villa_rates');
      $this->db->where('package_id', $id);
      $this->db->where('accomodation_type',$accom_type);
      $query = $this->db->get();
      if ($query->num_rows > 0) {
        return $query->row();
        //  return true;
      }else{
        return false;
      }
    }

    public function get_other_rates($package_id) {
      $this->db->select('*');
      $this->db->from('villa_rates_packages');
      $this->db->where('package_id', $package_id);
      $query = $this->db->get();
      if ($query->num_rows > 0) {
          return $query->result();
      }else {
        return false;
      }
    }

    public function get_villa($package_id) {
        $this->db->select('*');
        $this->db->from('villa_list');
        $this->db->where('id',$package_id);
        $this->db->where('status','1');
        // $this->db->order_by('priority','ASC');
        $query=$this->db->get();
        return $query->row();
    }
    public function get_country_fulllist() {
        $where = "(name NOT LIKE 'India')";
        $this->db->select('*');
        $this->db->from('country');
        // $this->db->where($where);
        $query = $this->db->get();
        //$this->db->limit(0,5);
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_villa_booking($sysRefNo) {
        $this->db->select('r.*,h.*');
        $this->db->from('villa_booking_reports r');
        $this->db->join('villa_booking_villa_info h', 'r.uniqueRefNo = h.uniqueRefNo');
        //$this->db->where('r.Hotel_RefNo',$hotelRefNo);
        $this->db->where('h.uniqueRefNo',$sysRefNo);
        $this->db->limit('1');
        $query = $this->db->get();
        if($query->num_rows() == 0 ) {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_villa_pass_info($sysRefNo) {
    $this->db->select('*');
    $this->db->from('villa_booking_passengers_info');
    $this->db->where('uniqueRefNo',$sysRefNo);
    $this->db->order_by('pass_id','ASC');

    $query = $this->db->get();
    
    if($query->num_rows() == 0 ) {
       return '';
    } else {
      return $query->result();
    }

  }


    public function get_villa_pay_info($hol_unique) {
      $this->db->select('*');
      $this->db->from('pay_details_razorpay');      
      $this->db->where('uniqueRefNo',$hol_unique);
      $query = $this->db->get();
      if($query->num_rows() == 0 ) {
        return '';
      } else {
        return $query->row();
      }
    }

    public function villa_booking_reports($data){
        $this->db->insert('villa_booking_reports',$data);
        return true;
    }

    public function villa_booking_passenger_info($data){
        $this->db->insert('villa_booking_passenger_info',$data);
        return true;
    }

    public function villa_booking_villa_info($data){
        $this->db->insert('villa_booking_villa_info',$data);
        return true;
    }

    public function update_villa_booking_villa_info($uniqueRefNo,$user_email,$data) {
      $this->db->where('uniqueRefNo', $uniqueRefNo);
      $this->db->where('user_email', $user_email);
      $this->db->update('villa_booking_villa_info',$data);
    }

    public function get_img_by_type($villaid,$img_type) {
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('villa_list_id', $villaid);
          $this->db->where('img_type', $img_type);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_gallery($villaid,$lt) {
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('property_code', $villaid);
        $this->db->limit($lt);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }


    public function get_img_holi_details($villaid,$img_type,$lt)
    {
         $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('villa_list_id', $villaid);
        //$this->db->where('img_type', $img_type);
        $this->db->limit($lt);
        $query=$this->db->get(); 
         // echo $this->db->last_query();exit;     
          if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';

    }

    public function get_continent_name($id) {
        $this->db->select('continent_name')
        ->from('holi_continent')
        ->where('continent_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $obj = $query->row();
            return $obj->continent_name;
        }
    }

    public function get_city_name($id) {
        $this->db->select('city_name')
        ->from('villa_city')
        ->where('city_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $obj = $query->row();
            return $obj->city_name;
        }
    }


    public function getSimialrPackages($city_id,$villa_id){
        $this->db->select('*');
        $this->db->from('villa_list');
        $this->db->where('id !=',$villa_id);
        $this->db->where("FIND_IN_SET('".$city_id."',cityid)>",0); 
        $this->db->limit(3);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function getActivities($villa_id, $adults='', $fromDate='', $toDate=''){
        $this->db->select('*');
        $this->db->from('villa_activity');
        $this->db->where('villa_id',$villa_id);
        /*if(!empty($fromDate)){
          $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $fromDate)));
          $this->db->where('start_date <=', $start_date);
        }
        if(!empty($toDate)){
          $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $toDate)));
          $this->db->where('end_date >=', $end_date);
        }
        if(!empty($adults)){
          $this->db->where('minPaxOperating <=', $adults);
          $this->db->where('maxPaxOperating >=', $adults);
        }*/
         
        $query = $this->db->order_by('price_adt','asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function checkPackageValidity($villa_id, $departDate=''){
        $this->db->select('id');
        $this->db->from('villa_list');
        $this->db->where('id',$villa_id);

        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $departDate)));
        $this->db->where('start_date <=', $start_date);
        $this->db->where('end_date >=', $start_date);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->num_rows();
        }
    }

    public function getActivitiesByid($activity_id){
        $this->db->select('*');
        $this->db->from('villa_activity');
        $this->db->where('id',$activity_id);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->row();
        }
    }

    public function getMeetingPoints($villa_id){
        $this->db->select('*');
        $this->db->from('meeting_points');
        $this->db->where('villa_id',$villa_id);
        $query = $this->db->order_by('id','asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function get_filter_option_details($sess_id) {
        $this->db->select('MIN(p.price) as min_price, MAX(p.price) as max_price');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid');
        $this->db->where('t.session_id', $sess_id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    public function get_filter_min_price($sess_id) {
        $this->db->select('MIN(t.total_cost) AS min_price');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid');
        $this->db->where('t.session_id', $sess_id);
        $this->db->group_by('t.villa_code');
        $this->db->order_by('min_price', 'ASC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function get_filter_max_price($sess_id) {
        $this->db->select('MIN(t.total_cost) AS max_price');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid');
        $this->db->where('t.session_id', $sess_id);
        $this->db->group_by('t.villa_code');
        $this->db->order_by('max_price', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function TotalSearchResults($sess_id,$minPrice = '', $maxPrice = '', $starRating = '', $villaName = '', $fac='', $location = '') {
      $this->db->select('t.villa_code');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid AND t.bedrooms = p.bedroom AND t.bathrooms = p.bathroom');
        $this->db->where('t.session_id', $sess_id);

        if ($minPrice != '' && $maxPrice != '') {
            $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }
        if ($starRating != '') {
            $stars = explode(',', $starRating);
            $this->db->where_in('p.star_rating', $stars);
            // $this->db->where("FIND_IN_SET('".$starRating."',star_rating)>",0);
        }
        if ($location != '') {
            $loc_list = explode(',', $location);
            $this->db->where_in('p.location', $loc_list);
        }
        if ($villaName != '') {
            $this->db->like('p.property_name', $villaName);
        }
        if ($fac != '') {
            $where1 = '';
            $facility = explode(',', $fac);
            for($l=0;$l<count($facility);$l++){
                $where1 .= "FIND_IN_SET('".$facility[$l]."', p.facilities)";
                if($l==(count($facility)-1)){
                }else{
                    $where1 .=' OR ';
                }
            }
            $this->db->where($where1);
        }
        $this->db->group_by('t.villa_code');
        $query = $this->db->get();
        // echo $this->db->last_query();//exit;
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->num_rows();
        }
    }

    // public function all_fetch_search_result($city_id,$bedrooms,$bathrooms,$minPrice = '', $maxPrice = '', $starRating = '', $villaName = '', $sortBy = '', $order = '') {
    public function all_fetch_search_result($sess_id, $offset, $perPage, $minPrice = '', $maxPrice = '', $starRating = '',$fac='', $villaName = '', $location = '',$bedrooms='',$bathrooms='', $sortBy = '', $order = '') {
      $this->db->select('t.*,p.price,p.property_name,p.latitude,p.longitude,t.image,p.star_rating,t.city_name,p.location,p.facilities as amenities,p.address as address,p.short_desc as description,t.image as hotimage,p.bedroom AS bedrooms,p.bathroom AS bathrooms');
        $this->db->from('villa_search_result t');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid');

        $this->db->where('t.session_id', $sess_id);

        if ($minPrice != '' && $maxPrice != '') {
            $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }

        if($bedrooms!='') {
          $this->db->where('p.bedroom >=', $bedrooms); 
        }
        if($bathrooms!='') {
          $this->db->where('p.bathroom >=', $bathrooms); 
        }

        if ($fac != '') {
          $where = '';
          $amenity_arr = explode(',', $fac);
          if(count($amenity_arr) > 1) {
            $where .= "( FIND_IN_SET('".$amenity_arr[0]."',t.amenities)>0";
            for ($i=1; $i <(count($amenity_arr)-1) ; $i++) {
              $where .= " OR FIND_IN_SET('".$amenity_arr[$i]."',t.amenities)>0";
            }
            $where .= " OR FIND_IN_SET('".$amenity_arr[$i]."',t.amenities)>0 )";
            $this->db->where($where);
          } else {
            $this->db->where("FIND_IN_SET('".$amenity_arr[0]."',t.amenities)>",0);
          }
        }

        if ($starRating != '') {
            $stars = explode(',', $starRating);
            $this->db->where_in('p.star_rating', $stars);
        }
        if ($villaName != '') {
            $this->db->like('t.villa_name', $villaName);
        }
        $this->db->group_by('t.villa_code');
        if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('t.total_cost', strtoupper($order));
            } else if ($sortBy == 'data-star') {
                $this->db->order_by('t.star', strtoupper($order));
            } else if ($sortBy == 'data-villa-name') {
                $this->db->order_by('t.villa_name', strtoupper($order));
            } else {
                $this->db->order_by('t.total_cost', 'ASC');
            }
        } else {
            $this->db->order_by('t.total_cost', 'RANDOM');
        }
        // $this->db->limit(20);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    public function getVillaDetails($villaCode) {
        $this->db->select('latitude,longitude');
        $this->db->from('villa_list');
        $this->db->where('property_code', $villaCode);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function getVillaFullDetails($villaCode) {
        $this->db->select('*');
        $this->db->from('villa_list');
        $this->db->where('property_code', $villaCode);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_amenities($id) {
          $this->db->select('*');           
          $this->db->from('glb_hotel_facilities_type');
          $this->db->where('status','1');
          $this->db->where('facility_type','villa');
          $this->db->where_in('id',$id);  
          $this->db->limit('50');             
          $query=$this->db->get();
            if ($query->num_rows() > 0) {
            return $query->result();
        }
        else {
           return '';
         } 
    }

  public function get_nearby_items($sess_id,$villaCode,$lat,$long,$city) {
    $this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance, h.image as thumb");
    $this->db->from('villa_search_result h');
    $this->db->join('villa_list p','h.villa_code = p.property_code');
    $this->db->where('p.city_name',$city);
    $this->db->where('p.property_code !=',$villaCode);
    $this->db->where('h.session_id',$sess_id);
    $this->db->group_by('p.property_name');
    $this->db->having('distance <',9);
    $this->db->limit(3);
    $query = $this->db->get();
        // echo $this->db->last_query();exit;
    if($query->num_rows()>0) {
      return $query->result();
    } else {
      return array();
    }

  }


public function fetchLocationMap($sess_id) {
        $this->db->select('p.latitude,p.longitude');
        $this->db->from('villa_search_result t');
        // $this->db->join('api_permanent_hotels p', 't.villa_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->join('villa_list p', 't.villa_code = p.property_code AND t.city_code = p.cityid');
        $this->db->where('t.session_id', $sess_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

}
