<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class hotelcrs_model extends CI_Model {

    const CODE_START = '10000000';

    function __construct() {
        parent::__construct();
    }

    public function getPromotionOta($hotel_code,$checkIn,$checkOut) {
        $sql = "SELECT id,discount,promo_type,promo_name,promo_audience,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate`  FROM promotion_ota WHERE status=1 AND hotel_code=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y')<=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y')>=? ORDER BY discount ASC";
        $query = $this->db->query($sql,[$hotel_code,$checkIn,$checkOut]);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function getRoomsPromotion($room_code,$checkIn,$checkOut) {
        $sql = "SELECT *,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y') AS `fromdate`,STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y') AS `todate`  FROM promotion_ota WHERE status=1 AND FIND_IN_SET(?,room_code) AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', 1),'%d/%m/%Y')<=? AND STR_TO_DATE(SUBSTRING_INDEX(`stay_period`, ' - ', -1),'%d/%m/%Y')>=? ORDER BY discount ASC";
        $query = $this->db->query($sql,[$room_code,$checkIn,$checkOut]);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function getApiAuthDetails($api) {
        $this->db->select('*');
        $this->db->from('api_info');
        $this->db->where('api_name', $api);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function delete_temp_results($sess_id,$api) {
        $this->db->where('session_id', $sess_id);
         $this->db->where('api', $api);
        $this->db->delete('hotel_search_result');
    }

    public function getsearchhotelcodes($session_id, $api) {
        $this->db->select('hotel_code');
        $this->db->from('hotel_search_result');     
        $this->db->where('session_id', $session_id);
        $this->db->where('api', $api);
        $this->db->group_by('hotel_code');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    function check_hotel_search($api,$sess_id,$hotel_code,$room_runno) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('hotel_code', $hotel_code);
        $this->db->where('room_runno', $room_runno);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function check_hotel_search_data($sess_id,$uniqueRefNo) {
      $this->db->select('*');           
      $this->db->from('hotel_search_data');  
      $this->db->where('session_id',$sess_id);
      $this->db->where('uniqueRefNo',$uniqueRefNo);
      $query=$this->db->get();
      if ($query->num_rows() > 0) {
        return $query->row();
      } else {
        return '';
      }
    }

    public function delete_hotel_results($api,$sess_id,$hotel_code) {
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('hotel_code', $hotel_code);  
        $this->db->delete('hotel_search_result');
    }

    public function gethotelcodes($cityid,$start,$end){
        $this->db->select('hotel_code');
        $this->db->where('cityid',$cityid); 
        $this->db->where('admin_status','1');
        $this->db->where('status','1');
        $this->db->limit($end,$start);
        $this->db->from('supplier_hotel_list');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function getroomcodes($hotel_code,$start,$end){
        $this->db->select('room_code,hotel_code');
        $this->db->from('supplier_room_list');
        $this->db->where_in('hotel_code',$hotel_code);      
        $this->db->where('status','1');
        $this->db->limit($end,$start);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            return '';
        }

    }

    public function get_crs_hotels_rates($hotel_code,$room_code,$city, $checkin, $checkout, $adults, $childs,$room_count) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $occupancy = $adults+$childs;
        $this->db->select('a.discount_type,a.discount_value,a.supplier_hotel_list_id,a.hotel_code,a.hotel_name,a.hotel_star_rating,a.hotel_desc,a.hotel_country,a.address,a.latitude,a.longitude,a.currency_type,a.check_in,a.check_out,a.thumb_img,a.hotel_facilities,t.room_desc,t.room_facilities,t.room_name,t.room_code,t.*,ct.city_name');
        $this->db->from('supplier_hotel_list a');
        $this->db->join("(select hotel_code from supplier_hotel_list s where s.cityid in (select id from jamaican_city_list where id = '$city') and admin_status='1' and status='1') s", 'a.hotel_code = s.hotel_code');
        $this->db->join("(select d.room_desc,d.room_facilities,d.room_name,e.room_type,d.hotel_room_type,r.sup_room_details_id as room_details_id, r.*,d.inclusions,d.room_policies,d.room_cancel_policies,d.exclusions
        from supplier_room_list as d JOIN ( select id,room_type from glb_hotel_room_type) as e on e.id = d.hotel_room_type JOIN (select rr.*, ra.sup_hotel_room_allotment_id from sup_hotel_room_allotment ra, sup_hotel_room_rates as rr where rr.status=1  AND  rr.room_avail_date BETWEEN '" . $checkin . "' AND '" . $checkout . "' and rr.room_avail_date=ra.room_avail_date  and rr.room_code=ra.room_code and ( ra.rooms_available>=ra.total_booking +'$room_count') order by rr.adult_rate ASC) as r on r.sup_room_details_id = d.supplier_room_list_id where ((minadult<=$adults) AND (maxadult>=$adults)) AND ((minchild<=$childs) AND (maxchild>=$childs) ) AND ((minperson<=$occupancy) AND (maxperson>=$occupancy)) )  t", "a.hotel_code = t.hotel_code AND t.hotel_code IN ($hotel_code) AND t.room_code IN ($room_code) ");
        $this->db->join("(select id,city_name from jamaican_city_list) ct", 'a.cityid = ct.id', 'left');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return array();
        }
    }


    function check_crs_hotels_normal_cancel_policy($rowarr,$checkIn) {     
        $this->db->select('days_before_checkin,per_rate_charge,cancel_rates_type,policy_id');
        $this->db->from('sup_hotel_room_cancellation_rates'); 
        $this->db->where('supplier_id',$rowarr['supplier_id']);
        $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
        $this->db->where('hotel_code',$rowarr['hotel_code']);   
        $this->db->where('room_code',$rowarr['room_code']);  
        $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
        $this->db->where('room_avail_date', $checkIn);     
        $this->db->where('meal_plan',$rowarr['meal_plan']);   
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';  
    }

    function check_hotel_room_search($api,$sess_id,$hotel_code,$room_code,$room_runno) {
        $this->db->select('*');
        $this->db->from('hotel_search_result'); 
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->where('hotel_code', $hotel_code);
        $this->db->where('room_code', $room_code);
        $this->db->where('room_runno', $room_runno);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';  
        }
    }

    public function insert_crs_data($insertion_data) {
        // $this->db->insert_batch('crs_search_result', $insertion_data);
        $this->db->insert_batch('hotel_search_result', $insertion_data);
    }

    public function getHotelDetails($hotelCode, $searchId, $ses_id='') {
        $this->db->select('p.*,c.city_name,t.image,t.description,t.session_id,t.xml_currency,t.api,t.search_id,t.total_cost,p.hotel_facilities as amenities,t.discount,t.sup_tax_amt,t.government_tax,t.resort_fee,t.service_tax');
        $this->db->from('hotel_search_result t');
        $this->db->join('supplier_hotel_list p', 't.hotel_code = p.hotel_code');
        $this->db->join('jamaican_city_list c', 'p.cityid = c.id', 'left');

        if($ses_id != '')
            $this->db->where('t.session_id', $ses_id);

        $this->db->where('t.search_id', $searchId);
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->order_by('t.total_cost', 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function getMinMaxCostHotel($hotelCode,$sess_id){
        // $this->db->select_min('t.total_cost', 'min_price');
        // $this->db->select_max('t.total_cost', 'max_price');
        $this->db->select('MIN(t.total_cost) AS min_price, MAX(t.total_cost) AS max_price,t.nights,discount,discount_value,member_discount,discount_type,t.promotion_ota');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->group_by('t.hotel_code', $hotelCode);
        $this->db->order_by('t.total_cost', 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    public function getSupHotelDetails($hotelCode) {
        $this->db->select('p.*,c.city_name,t.image,t.description,t.session_id,t.xml_currency,t.api,t.search_id,t.total_cost,p.hotel_facilities as amenities,t.discount,t.sup_tax_amt,t.government_tax,t.resort_fee,t.service_tax');
        $this->db->from('hotel_search_result t');
        $this->db->join('supplier_hotel_list p', 't.hotel_code = p.hotel_code');
        $this->db->join('jamaican_city_list c', 'p.cityid = c.id', 'left');
        // $this->db->where('t.search_id', $searchId);
        $this->db->where('t.hotel_code', $hotelCode);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }

    // public function getSupHotelDetails($hotelCode) {
    //     $this->db->select('*');
    //     $this->db->from('supplier_hotel_list');
    //     $this->db->where('hotel_code', $hotelCode);
    //     $query = $this->db->get();
    //     // echo $this->db->last_query();
    //     if ($query->num_rows() > 0)
    //         return $query->row();
    //     else
    //         return array();
    // }

    public function getHotelImages($hotelCode) {
        $this->db->select('gallery_img,img_type');
        $this->db->from('supplier_hotel_images');
        $this->db->where('hotel_code', $hotelCode);       
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_hotel_rooms($city_code,$session_id, $hotelCode) {
        $this->db->select('*');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code');
        $this->db->where('p.city_code', $city_code);
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.hotel_code', $hotelCode);
        // $this->db->group_by('SectionUniqueId');
        $this->db->order_by('total_cost','ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_hotel_rooms_group($city_code,$session_id, $hotelCode) {
        $this->db->select('*');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code');
        $this->db->where('p.city_code', $city_code);
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.hotel_code', $hotelCode);
        $this->db->group_by('t.room_code');
        $this->db->order_by('total_cost','ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_hotel_room_by_code($roomcode) {
        $this->db->select('*');
        $this->db->from('supplier_room_list');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_hotel_crs_amenities($id) {
          $this->db->select('*');           
          $this->db->from('glb_hotel_facilities_type');  
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

    public function get_hotel_room_image_by_code($roomcode) {
        $this->db->select('*');
        $this->db->from('supplier_room_gallery_images');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_room_gallery_image_by_code($roomcode) {
        $this->db->select('gallery_img');
        $this->db->from('supplier_room_gallery_images');
        $this->db->where('room_code', $roomcode);
        $query = $this->db->get();
        // $this->db->limit('1');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_hotel_room_meal_plan($meal_plan) {     
        $this->db->select('meal_plan');
        $this->db->from('glb_hotel_meal_plan');       
        $this->db->where_in('id',$meal_plan);
        $this->db->limit('1');
        $query = $this->db->get(); 
        if ($query->num_rows() > 0) {
           return $query->row()->meal_plan; 
        } else {
         return '';
        }
    }

    public function get_merged_rooms($api, $sess_id, $hotelCode, $searchId) {
        // echo '<pre>';print_r($searchId);
        $this->db->select('a.*,b.*,a.sup_tax_amt,a.government_tax,a.resort_fee,a.service_tax');
        $this->db->from('hotel_search_result a');
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
        $this->db->where('b.hotel_code', $hotelCode);
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

    public function get_merged_rooms_new($api,$searchId) {
        $this->db->select('a.*,b.*,a.sup_tax_amt,a.government_tax,a.resort_fee,a.service_tax');
        $this->db->from('hotel_search_result a');
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
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

    function getCountryName($nationality) {
        $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $country = $res->name;
            return $country;
        } else {
            return '';
        }
    }


    public function insert_hotel_booking_information_data($user_id, $agent_id, $AL_RefNo, $Book_Hotelcode, $Book_Roomcode, $Book_HotelName, $city, $checkIn, $checkOut, $Booking_Date, $roomcount, $Book_Nights, $api, $star, $image, $description, $address, $phone, $fax, $adultcount, $childcount, $adults, $childs, $childs_ages, $cancellation_policy,$additional_info) {
        $data = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'uniqueRefNo' => $AL_RefNo,
            'hotel_code' => $Book_Hotelcode,
            'room_code' => $Book_Roomcode,
            'hotel_name' => $Book_HotelName,
            'city_code' => $city,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'voucher_date' => $Booking_Date,
            'city' => $city,
            //'room_type' => $Book_RoomTypeval,
            'room_count' => $roomcount,
            'nights' => $Book_Nights,
            'api' => $api,
            'star' => $star,
            'image' => $image,
            'description' => $description,
            'address' => $address,
            'phone' => $phone,
            'fax' => $fax,
            'adult' => $adultcount,
            'child' => $childcount,
            'childage'=>implode(',', $childs_ages),
            'cancellation_policy' => $cancellation_policy,
            'hp_additional_info' => $additional_info
        );

        $this->db->insert('hotel_booking_hotels_info', $data);
        // echo $this->db->last_query();exit;
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $adt = 0;
            $chd = 0;
            $ex_adt = 0;
            $ex_chd = 0;
            for ($i = 0; $i < $roomcount; $i++) {
                $passenger_info = $this->session->userdata('passenger_info');

                $adultTitles = $passenger_info['adults_title'];
                $adultFNames = $passenger_info['adults_fname'];
                $adultLNames = $passenger_info['adults_lname'];
                if (isset($passenger_info['childs_title'])) {
                    $childTitles = $passenger_info['childs_title'];
                    $childFNames = $passenger_info['childs_fname'];
                    $childLNames = $passenger_info['childs_lname'];
                }
                $mobile = $passenger_info['GuestMobileNo'];
                $email = $passenger_info['GuestEmailID'];
                $user_pincode = $passenger_info['GuestPostalCode'];
                $user_city =  $passenger_info['GuestCity'];
                $user_state =  $passenger_info['GuestState'];
                $user_country =  $passenger_info['GuestCountryCode'];
                $address = $passenger_info['GuestAddress'];

                for ($a = 0; $a < $adults[$i]; $a++) {
                    $adult_data = array(
                        'uniqueRefNo' => $AL_RefNo,
                        'passenger_type' => 'adult',
                        'title' => $adultTitles[$adt],
                        'first_name' => $adultFNames[$adt],
                        'last_name' => $adultLNames[$adt],
                        'room_no' => $i + 1,
                        // 'mobile' => $mobile,
                        // 'email' => $email,
                        // 'city'=>$user_city,
                        // 'state'=>$user_state,
                        // 'zip_code'=>$user_pincode,
                        // 'address'=>$address,
                        // 'country'=>$user_country,
                    );
                    $this->db->insert('hotel_booking_passengers_info', $adult_data);
                    $adt++;
                }
                if (array_key_exists($i, $childs) && $childs[$i] != '') {
                    for ($c = 0; $c < $childs[$i]; $c++) {
                        if (isset($childs_ages[$c]) && $childs_ages[$c] != '')
                            $age = $childs_ages[$c];
                        else
                            $age = 0;

                        $child_data = array(
                            'uniqueRefNo' => $AL_RefNo,
                            'passenger_type' => 'child',
                            'title' => $childTitles[$chd],
                            'first_name' => $childFNames[$chd],
                            'last_name' => $childLNames[$chd],
                            'room_no' => $i + 1,
                            'child_age' => $age,
                            // 'city'=>$user_city,
                            // 'state'=>$user_state,
                            // 'zip_code'=>$user_pincode,
                            // 'address'=>$address,
                            // 'country'=>$user_country,
                        );
                        $this->db->insert('hotel_booking_passengers_info', $child_data);
                        $chd++;
                    }
                } 

            }
        }

        return true;
    }

    public function getRoomDetails($api, $sess_id, $hotelCode, $searchId) {
        $this->db->select('a.cancel_policy,a.image,a.admin_markup,a.admin_agent_markup,a.payment_charge,a.total_cost,a.api,a.xml_currency,a.currency,a.currency_conv_value,a.search_id,a.session_id, b.*,a.room_type,a.room_code,a.room_name,a.room_description,a.star,a.city_name,c.supplier_no,a.hotel_property_id,a.hotel_supplier_id,a.room_details_info,a.board_type,a.child_age,a.adult,a.child,a.room_runno, a.room_count, a.nights, a.room_amenities,a.hotel_crs_cancellation_json,a.net_fare,a.discount,a.sup_tax_amt,a.government_tax,a.resort_fee,a.service_tax,b.imp_information');     
        $this->db->from('hotel_search_result a'); 
        $this->db->join('supplier_hotel_list b', 'a.hotel_code = b.hotel_code', 'left');
        $this->db->join('supplier_info c', 'c.id = b.supplier_id', 'left');
        //$this->db->join('sup_hotel_room_details d','a.room_code = d.room_code');
        //$this->db->join('glb_hotel_room_type h','d.room_type_id = h.id','left');    
        //$this->db->join('glb_hotel_city_list c', 'b.hotel_city = c.id','left');   
        $this->db->where('b.hotel_code', $hotelCode);
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

    function check_crs_hotels_price($rowarr,$checkIn,$checkout) {
        $checkout = date('Y-m-d', strtotime('-1 days', strtotime($checkout)));
        $this->db->select('*');
        $this->db->from('sup_hotel_room_rates'); 
        $this->db->where('supplier_id',$rowarr['supplier_id']);
        $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
        $this->db->where('hotel_code',$rowarr['hotel_code']);   
        $this->db->where('room_code',$rowarr['room_code']);          
        $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
        $this->db->where('room_avail_date BETWEEN "' . $checkIn . '" and "' . $checkout . '"');     
        $this->db->where('meal_plan',$rowarr['meal_plan']);   
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';  
    }

    function check_crs_hotels_room_allotment($id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_allotment'); 
        $this->db->where('sup_hotel_room_allotment_id',$id);
        $this->db->where('rooms_available !=',0);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';  
        } 
    }

    function update_crs_hotels_room_total_cost($searchId,$sessionId,$hotelCode,$total_cost) {
        $data=array('total_cost'=>$total_cost);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

    function update_crs_hotels_room_net_fare($searchId,$sessionId,$hotelCode,$net_fare) {
        $data=array('net_fare'=>$net_fare);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

   function update_crs_hotels_room_discount($searchId,$sessionId,$hotelCode,$discount) {
        $data=array('discount'=>$discount);
        $this->db->where('search_id',$searchId);
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->update('hotel_search_result',$data);
    }

    function get_last_booking_code() {
        $this->db->select('b.booking_id');
        $this->db->from('(select booking_id from sup_hotel_booking order by booking_id DESC) as b');
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
        $insert = $this->db->insert('sup_hotel_booking', $data);
        // echo $this->db->last_query();exit;
        return $insert;
    }

    public function insert_crs_booking_room_details($data) {
        $insert = $this->db->insert('sup_hotel_booking_room_details', $data);
        return $insert;
    }

    public function insert_crs_booking_pass($booking_id, $roomcount, $adults, $childs,$uniqueRefNo) {
        $adt = 0;
        $chd = 0;
        $ex_adt = 0;
        $ex_chd = 0;
        $passenger_info = $this->session->userdata('passenger_info');

        $adultTitles = $passenger_info['adults_title'];
        $adultFNames = $passenger_info['adults_fname'];
        $adultLNames = $passenger_info['adults_lname'];

        if (isset($passenger_info['childs_title'])) {
            $childTitles = $passenger_info['childs_title'];
            $childFNames = $passenger_info['childs_fname'];
            $childLNames = $passenger_info['childs_lname'];
        }

        $mobile = $passenger_info['GuestMobileNo'];
        $email = $passenger_info['GuestEmailID'];
        $user_pincode = $passenger_info['GuestPostalCode'];
        $user_city =  $passenger_info['GuestCity'];
        $user_state =  $passenger_info['GuestState'];
        $user_country =  $passenger_info['GuestCountryCode'];
        $address = $passenger_info['GuestAddress'];

        for ($i = 0; $i < $roomcount; $i++) 
        {        
             for ($a = 0; $a < $adults[$i]; $a++) 
             {
                $adult_data = array(
                    'booking_id' => $booking_id,
                    'uniqueRefNo' => $uniqueRefNo,
                    'pass_type' => 'adult',
                    'title' => $adultTitles[$adt],
                    'first_name' => $adultFNames[$adt],
                    'last_name' => $adultLNames[$adt],
                    'room_no' => $i + 1,
                    'mobile' => $mobile,
                    'email' => $email,
                    'zip_code'=>$user_pincode,
                    'city'=>$user_city,
                    'state'=>$user_state,
                    'country'=>$user_country,
                    'address'=>$address,
                  
                );
                $this->db->insert('sup_hotel_booking_pass', $adult_data);

                $adt++;
            }


            if (array_key_exists($i, $childs) && $childs[$i] != '') {
                for ($c = 0; $c < $childs[$i]; $c++) {
                    if (isset($childs_ages[$c]) && $childs_ages[$c] != '')
                        $age = $childs_ages[$c];
                    else
                        $age = 0;

                    $child_data = array(
                        'booking_id' => $booking_id,
                        'uniqueRefNo' => $uniqueRefNo,
                        'pass_type' => 'child',
                        'title' => $childTitles[$chd],
                        'first_name' => $childFNames[$chd],
                        'last_name' => $childLNames[$chd],
                        'room_no' => $i + 1,
                        'child_age' => $age,
                         'zip_code'=>$user_pincode,
                         'city'=>$user_city,
                        'state'=>$user_state,
                        'country'=>$user_country,
                        'address'=>$address,
                    );
                    $this->db->insert('sup_hotel_booking_pass', $child_data);
                    $chd++;
                }
            }
     
        }
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

    function update_crs_hotels_room_allotment($id,$total_booking) {
        $this->db->set('total_booking', '`total_booking` + '.$total_booking, FALSE);
        $this->db->where('sup_hotel_room_allotment_id',$id);
        // $this->db->where('sup_hotel_room_allotment_id',$id);
        $this->db->update('sup_hotel_room_allotment');
    }

    function insert_supplier_act_summary($insertion_data) {
        $this->db->insert('sup_acc_summary', $insertion_data);
        // $report = array();
        // $report['error'] = $this->db->error();
        // if ($report !== 0) {
            return true;
        // } else {
        //     return false;
        // }
    }

    function get_supplement_meal_plan($id) {
        $this->db->select('meal_plan');
        $this->db->from('glb_hotel_meal_plan');
        $this->db->where_in('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res=$query->result();
            $meal_plan=array();
            foreach ($res as $val) {
                $meal_plan[]=$val->meal_plan;
            }
            $mealstr=implode(',', $meal_plan);
                return $mealstr;
        } else {
            return '';
        }  
    }

    public function get_converted_price($from, $to, $amount) {
        $this->db->select('value as from_val');
        $this->db->from('currency');
        $this->db->where('currency_code', $from);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->row();
            $from_curr = $res->from_val;
        } else {
            $from_curr = 0;
        }

        $this->db->select('value as to_val');
        $this->db->from('currency');
        $this->db->where('currency_code', $to);
        $this->db->limit('1');
        $query1 = $this->db->get();

        if ($query1->num_rows() > 0) {
            $res1 = $query1->row();
            $to_curr = $res1->to_val;
        } else {
            $to_curr = 0;
        }

        $currency_val = ($to_curr / $from_curr) * $amount;

        return $currency_val;
    }


    public function check_hotel_search_result($sessionId, $uniqueRefNo) {
          $this->db->select('*');           
          $this->db->from('hotel_search_result');  
          $this->db->where('session_id',$sessionId);
          $this->db->where('uniqueRefNo',$uniqueRefNo);
          $query=$this->db->get();
          if ($query->num_rows() > 0) 
          {
            return true;
          } 
          else
          {
            return false;
          }
    }

    function get_agent_available_balance($agent_no,$agent_type='') {
        $this->db->select('available_balance')
                ->from('agent_acc_summary')
                ->where('agent_no', $agent_no)
                ->order_by('transaction_datetime', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        return $balance;
    }

    public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total, $BOOKING_REFERENCE_NO, $agent_type='') {
        $disc_tran = 'Regarding Hotel Booking Ref: ' . $BOOKING_REFERENCE_NO;
        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;

        $data['agent_no'] = $agent_no;
        $data['transaction_summary'] = $disc_tran;
        $data['agent_id'] = $agent_id;
        $data['withdraw_amount'] = $withdraw_amount;
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        // if ($agent_type == 1) {
            // $this->db->insert('distributor_acc_summary', $data);
        // } elseif ($agent_type == 2) {
            $this->db->insert('agent_acc_summary', $data);
        // } elseif ($agent_type == 3) {
            // $this->db->insert('b2b2b_acc_summary', $data);
        // }
    }


}