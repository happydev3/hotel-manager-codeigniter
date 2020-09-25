<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Holiday_Model extends CI_Model {
  
    public function __construct() {
        parent::__construct();
    }

    
function search_holiday_package_result($city_id='',$fromDate='',$toDate='') {
  $this->db->select('*');
  $this->db->from('holiday_packages');
  if($city_id!='') {
    $this->db->where("FIND_IN_SET('".$city_id."',destination)>",0); 
  }
  if($fromDate!='') {
    $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $fromDate)));
    $this->db->where('start_date <=', $start_date); 
  }
  if($toDate!='') {
    $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $toDate)));
    $this->db->where('end_date >=', $end_date); 
  }
  /*if($holiduration!='') {
    $this->db->where("FIND_IN_SET('".$holiduration."',month_dur)>",0);  
  }
  if($theme_arr!='') {
    $where = "FIND_IN_SET('".$theme_arr."', theme_id)"; 
    $this->db->where($where); 
  }*/

  $this->db->where('status',1);              
  $this->db->order_by('RAND()');              
  $query = $this->db->get(); 
  if ($query->num_rows() > 0) {
      return $query->result();
  } else {
      return '';
  }
}

function search_holiday_package_filter_results($city_id='',$holiduration='',$theme_arr='') {
  $this->db->select('*');
  $this->db->from('holiday_packages');  

  if($city_id != '') {
    $cityids = explode(',', $city_id);
    $where1 = '(';
    foreach($cityids as $ids) {
      $where1 .= "FIND_IN_SET('".$ids."', destination) OR "; 
    }
    $where1 .= ')';
    // $this->db->where(rtrim($where1, 'OR '));
    $this->db->where(str_replace('OR )', ')', $where1));
  }

  if($holiduration != '') {
    $holidurations = explode(',', $holiduration);
    $where2 = '(';
    foreach($holidurations as $dids) {
      $where2 .= "FIND_IN_SET('".$dids."', duration) OR "; 
    }
    $where2 .= ')';
    $this->db->where(str_replace('OR )', ')', $where2));
  }

  if($theme_arr != '') {
    $themeids = explode(',', $theme_arr);
    $where3 = '(';
    foreach($themeids as $tids) {
      $where3 .= "FIND_IN_SET('".$tids."', theme_id) OR "; 
    }
    $where3 .= ')';
    // $this->db->where(rtrim($where3, 'OR '));
    $this->db->where(str_replace('OR )', ')', $where3));
  }

  $this->db->where('status',1);
  $query = $this->db->get();
  // echo $this->db->last_query();exit;
  if ($query->num_rows() > 0) {
    return $query->result();
  } else {
    return '';
  }
}

function get_holiday_package_by_id($id) { 
        $this->db->select('*');
        $this->db->from('holiday_packages');
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

function get_all_holiday_package_by_id($id) { 
    $this->db->select('*');
    $this->db->from('holiday_packages');
    $this->db->where('id',$id);
    $query = $this->db->get(); 
    // echo $this->db->last_query(); exit;
     if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return '';
    }
}

function get_holiday_package_itinerary_by_id($id)
{
        $this->db->select('*');
        $this->db->from('holiday_itinerary');
        $this->db->where('package_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

}
function get_holiday_package_itinerary_images_by_id($id)
{
        $this->db->select('*');
        $this->db->from('holiday_itinerary_images');
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
        $this->db->from('holiday_city');
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
        $this->db->from('holiday_country');
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
        $this->db->from('holiday_continent');
        $this->db->where('continent_id',$id);    
        $query = $this->db->get();  
         if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
}

function get_holiday_package_images_by_id($id)
{
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id',$id);    
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
    $query = $this->db->get('holiday_route_map');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return '';
    }
}

   public function get_all_theme_name() {
        $this->db->select('*');
        $this->db->from('holiday_theme');     
        $query=$this->db->get();
        return $query->result();
    }

    

    public function getminmaxprice()
    {
      $this->db->select('MIN(t.pp_price) as minprice, MAX(t.pp_price) as maxprice');
      $this->db->from('holiday_packages t');
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
        $this->db->from('holiday_accomodation');     
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
        $this->db->from('holiday_activity');
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
        $this->db->from('holiday_attraction');
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
        $this->db->from('holiday_accomodation');     
        $query=$this->db->get();
        return $query->row();
    }

    function get_activity_desc($id, $tablename){
        $this->db->where('package_id', $id);
        $this->db->select('activity_description,activity_name');
        $this->db->from('holiday_activity');     
        $query=$this->db->get();
        return $query->row();
    }
    function get_attraction_desc($id, $tablename){
        $this->db->where('package_id', $id);
        $this->db->select('attraction_description,attraction_name');
        $this->db->from('holiday_attraction');     
        $query=$this->db->get();
        return $query->row();
    }

    function get_economy_rates($id){
        $this->db->select('*');
        $this->db->where('package_id',$id);
        $this->db->where('accomodation_type','Economy');
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
        $query = $this->db->get(); 
         if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_holiday_pass_rate($id,$accom_type,$arrivaldate,$end_date=NULL) {
        $this->db->select('*');
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
        $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates');
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
      $this->db->from('holiday_rates_packages');
      $this->db->where('package_id', $package_id);
      $query = $this->db->get();
      if ($query->num_rows > 0) {
          return $query->result();
      }else {
        return false;
      }
    }

    public function get_holiday($package_id) {
        $this->db->select('*');
        $this->db->from('holiday_packages');
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

    public function get_holiday_booking($hol_unique) {
      $this->db->select('*');
      $this->db->from('holiday_booking_reports');      
      $this->db->where('uniqueRefNo',$hol_unique);
      $this->db->limit('1');
      $query = $this->db->get();
      // echo $this->db->last_query();exit;
      if ($query->num_rows() > 0) {
        return $query->row();
      }
      return false;
    }

    public function get_holiday_pass_info($hol_unique) {
      $this->db->select('*');
      $this->db->from('holiday_booking_passenger_info');      
      $this->db->where('uniqueRefNo',$hol_unique);
      $query = $this->db->get();
      if($query->num_rows() == 0 ) {
        return '';
      } else {
        return $query->result();
      }
    }

    public function get_holiday_pay_info($hol_unique) {
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

    public function holiday_booking_reports($data){
        $this->db->insert('holiday_booking_reports',$data);
        return true;
    }

    public function holiday_booking_passenger_info($data){
        $this->db->insert('holiday_booking_passenger_info',$data);
        return true;
    }

    public function holiday_booking_holiday_info($data){
        $this->db->insert('holiday_booking_holiday_info',$data);
        return true;
    }

    public function update_holiday_booking_holiday_info($uniqueRefNo,$user_email,$data) {
      $this->db->where('uniqueRefNo', $uniqueRefNo);
      $this->db->where('user_email', $user_email);
      $this->db->update('holiday_booking_holiday_info',$data);
    }

    public function get_img_by_type($holidayid,$img_type) {
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holidayid);
          $this->db->where('img_type', $img_type);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_gallery($holidayid,$lt) {
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holidayid);
        $this->db->limit($lt);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }


    public function get_img_holi_details($holidayid,$img_type,$lt)
    {
         $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holidayid);
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
        return '';
    }

    public function get_city_name($id) {
        $this->db->select('city_name')
        ->from('holiday_city')
        ->where('city_id',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;

        if ($query->num_rows() > 0) {
            $obj = $query->row();
            return $obj->city_name;
        }
        return '';
    }

    public function get_theme_name($theme_id) {
        $this->db->select('*');
        $this->db->from('holiday_theme');
        $this->db->where('theme_id',$theme_id);
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            $obj = $query->row();
            return $obj->theme_name;
        }
        return '';
    }


    public function getSimialrPackages($city_id,$holiday_id){
        $this->db->select('*');
        $this->db->from('holiday_packages');
        $this->db->where('id !=',$holiday_id);
        $this->db->where('status',1);
        $this->db->where("FIND_IN_SET('".$city_id."',destination)>",0); 
        $this->db->limit(3);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function getActivities($holiday_id, $adults='', $fromDate='', $toDate=''){
        $this->db->select('*');
        $this->db->from('holiday_activity');
        $this->db->where('holiday_id',$holiday_id);
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
         
        $this->db->order_by('id','asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function checkPackageValidity($holiday_id, $departDate=''){
        $this->db->select('id');
        $this->db->from('holiday_packages');
        $this->db->where('id',$holiday_id);

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
        $this->db->from('holiday_activity');
        $this->db->where('id',$activity_id);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->row();
        }
    }

    public function getMeetingPoints($holiday_id){
        $this->db->select('*');
        $this->db->from('meeting_points');
        $this->db->where('holiday_id',$holiday_id);
        $query = $this->db->order_by('id','asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
          return $query->result();
        }
    }

    public function getSupplierInfo($supplier_id) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('id', $supplier_id)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }


}
