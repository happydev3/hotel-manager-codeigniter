<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Hotels_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	public function getActiveAPIs()
	{
        $this->db->select('api_name');
        $this->db->from('api_info');
        $this->db->where('service_type', 1);
		$this->db->where('status', 1);
        $this->db->order_by('order_no', 'ASC');
        $query = $this->db->get();

        if($query->num_rows() > 0)
		{
            return $query->result_array();
        }
		else
		{
			return '';
		}

    }

    public function get_hotel_booking_information($sysRefNo) {
        $this->db->select('r.*,h.*');
        $this->db->from('hotel_booking_reports r');
        $this->db->join('hotel_booking_hotels_info h', 'r.uniqueRefNo = h.uniqueRefNo');
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

    public function getSupplierHotelListInfo($supplier_id,$hotel_code) {
        $this->db->select('reservation_email');
        $this->db->from('supplier_hotel_list');
        $this->db->where('supplier_id',$supplier_id);
        $this->db->where('hotel_code',$hotel_code);
        $this->db->limit('1');
        $query = $this->db->get();
        if($query->num_rows() == 0 ) {
            return '';
        } else {
            return $query->row();
        }
    }

	public function get_hotel_booking_passenger_info($sysRefNo) {
		$this->db->select('*');
		$this->db->from('hotel_booking_passengers_info');
		$this->db->where('uniqueRefNo',$sysRefNo);
		$this->db->order_by('pass_id','ASC');

		$query = $this->db->get();
		if($query->num_rows() == 0 ) {
            return '';
		} else {
			return $query->result();
		}

	}

	public function get_nearby_hotels($sess_id,$hotelCode,$lat,$long,$city)
	{
		$this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance, h.image as thumb");
		$this->db->from('hotel_search_result h');
		$this->db->join('api_permanent_hotels p','h.hotel_code = p.hotel_code');
		$this->db->where('p.city_name',$city);
		$this->db->where('p.hotel_code !=',$hotelCode);
		$this->db->where('h.session_id',$sess_id);
		$this->db->group_by('p.hotel_name');
		$this->db->having('distance <',9);
		$this->db->limit(3);
		$query = $this->db->get();
        // echo $this->db->last_query();exit;

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}

	public function get_related_hotels($sess_id,$hotelCode,$lat,$long,$city)
	{
		$this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
		$this->db->from('hotels_search_result h');
		$this->db->join('hb_permanent_hotels p','h.hotel_code = p.hotel_code');
		$this->db->where('p.city_name',$city);
		$this->db->where('p.hotel_code !=',$hotelCode);
		$this->db->where('h.session_id',$sess_id);
		$this->db->group_by('p.hotel_name');
		$this->db->having('distance >',9);
		$this->db->limit(4);
		$query = $this->db->get();

		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}

	}
    public function get_Pay_details(){
        $query=$this->db->select('*')->from('pay_details')->get();
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return false;
        }

    }

    public function update_pay_details($updatpay,$uniqueRefNo,$Amount=''){
        $this->db->where('uniqueRefNo',$uniqueRefNo);
       // $this->db->where('paid_amount',$Amount);
        if($this->db->update('pay_details',$updatpay)){
            return true;
        }else{
            return false;
        }
    }

    /*public function TotalSearchResults1($sess_id, $Sys_RefNo, $minPrice = '', $maxPrice = '', $stars = '', $hotel_name = '', $areas = '') {
        $this->db->select('sr.*');
        $this->db->from('hotel_search_result sr');
        $this->db->join('gta_hotel_details hd', 'sr.hotel_code = hd.hotel_code AND sr.gta_city_code = hd.city_code AND sr.api=hd.api', 'left');
        $this->db->join('rx_permanent_hotels r', 'r.hotel_code = sr.hotel_code AND sr.city_code = r.city_id AND sr.api=r.api', 'left');
        $this->db->where('sr.session_id', $sess_id);
        // $this->db->where('sr.api', $api);
        $this->db->where('sr.AL_RefNo', $Sys_RefNo);

				   $session_data = $this->session->userdata('hotel_search_data');
		 $cityid = $session_data['cityCode'];
		 $this->db->where('city_id',$cityid);

        if ($minPrice != '' && $maxPrice != '') {
            $this->db->where('sr.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }
        if ($stars != '') {
            $st = explode(',', $stars);
            $maxstar = max($st);
            $minstar = min($st);
            foreach ($st as $s) {
                $this->db->where('r.star BETWEEN ' . $minstar . ' AND ' . $maxstar);
                $this->db->where('hd.star BETWEEN ' . $minstar . ' AND ' . $maxstar);
            }
        }

        if ($hotel_name != '') {
            $this->db->like('r.hotel_name', $hotel_name);
            $this->db->like('hd.hotel_name', $hotel_name);
        }
        if ($areas != '') {
            $ar = explode(',', $areas);

            foreach ($ar as $s) {
                $this->db->or_like('r.city', $s);
                $this->db->or_like('hd.location', $s);
            }
            //  $this->db->where_in('h.city', $areas);
        }

        //	$this->db->limit(200);
        $this->db->group_by('sr.hotel_code');
        $this->db->order_by('sr.total_cost', 'ASC');

        $query = $this->db->get();

        return $query->num_rows();
    }*/

    public function get_filter_option_details($sess_id) {
        // $this->db->select('t.nights');
        // $this->db->select_min('t.total_cost', 'min_price');
        // $this->db->select_max('t.total_cost', 'max_price');
        $this->db->select('MIN(t.total_cost) AS min_price, MAX(t.total_cost) AS max_price,t.nights');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);

        // $this->db->group_by('t.hotel_code');
        // $this->db->order_by('min_price', 'ASC');

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function get_filter_min_price($sess_id) {
        $this->db->select('MIN(t.total_cost) AS min_price,t.nights');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
        $this->db->group_by('t.hotel_code');
        $this->db->order_by('min_price', 'ASC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query && $query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function get_filter_max_price($sess_id) {
        $this->db->select('MIN(t.total_cost) AS max_price,t.nights');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
        $this->db->group_by('t.hotel_code');
        $this->db->order_by('max_price', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query && $query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

	public function get_locations_list($sess_id) {
        // $this->db->select('p.location');
        $this->db->select('t.resort_name');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
		// $session_data = $this->session->userdata('hotel_search_data');
		//  $cityid = $session_data['cityCode'];
		//  $this->db->where('unique_cityid',$cityid);

        $this->db->distinct();
       // $this->db->group_by('t.hotel_code');
        $query=$this->db->get();

        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }


    public function all_fetch_search_resultoldd($sess_id, $offset, $perPage, $minPrice = '', $maxPrice = '', $starRating = '',$fac='', $hotelName = '', $location = '', $sortBy = '', $order = '',$accommodation_type='') {
        // echo $hotelName;exit;
        //p.star = t.star  p.city_name=t.city_name


        $this->db->select('t.*, (select search_id from hotel_search_result where session_id = "'.$sess_id.'" order by total_cost ASC limit 1 ) as search_id, t.hotel_code,MIN(t.total_cost) AS total_cost,p.hotel_name,p.latitude,p.longitude,p.image,p.star,t.city_name,p.location,p.hotel_facilities as amenities,p.address as address,p.description as description,t.description as short_desc,p.distances,t.image as hotimage,p.accomodation_type');
        // $this->db->select('t.*, t.hotel_code,MIN(t.total_cost) AS total_cost,p.hotel_name,p.latitude,p.longitude,p.image,p.star,t.city_name,p.location,p.hotel_facilities as amenities,p.address as address,p.description as description,t.description as short_desc,p.distances,t.image as hotimage,p.accomodation_type');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);

        if($minPrice != '' && $maxPrice != '') {
          $this->db->where('t.total_cost BETWEEN '.$minPrice.' AND '.$maxPrice);
        }
        /*if ($minPrice != '' && $maxPrice != '') {
            if($minPrice!='')
            {
               $this->db->where('t.total_cost >= ' , $minPrice);  
            }
             if($maxPrice!='')
            {
               $this->db->where('t.total_cost <= ' , $maxPrice);  
            }

            // $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }*/
        if ($starRating != '') {
            $stars = explode(',', $starRating);
            $this->db->where_in('p.star', $stars);
        }

        if ($location != '') {
            $loc_list = explode(',', $location);
            $this->db->where_in('t.resort_name', $loc_list);
        }
        
        // echo $hotelName;exit;
        if ($accommodation_type != '') {
            $accommodation_type_list = explode(',', $accommodation_type);
            $this->db->where_in('p.accomodation_type', $accommodation_type_list);
        }

        /*if ($fac != '') {
            $where1 = '';
            $facility = explode(',', $fac);
            for($l=0;$l<count($facility);$l++){
                $where1 .= "FIND_IN_SET('".$facility[$l]."', t.amenities)";
                if($l==(count($facility)-1)){

                }else{
                    $where1 .=' OR ';
                }
            }
            $this->db->where($where1);
        }*/

        if($fac !='') {
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

        if ($hotelName != '') {
            $this->db->like('p.hotel_name', $hotelName);
        }
        
        
        if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $this->db->order_by('total_cost', strtoupper($order));
            } else if ($sortBy == 'data-star') {
                $this->db->order_by('p.star', strtoupper($order));
            } else if ($sortBy == 'data-hotel-name') {
                $this->db->order_by('p.hotel_name', strtoupper($order));
            } else {
                $this->db->order_by('total_cost', 'ASC');
            }
        } else {
            $this->db->order_by('total_cost', 'ASC');
        }
        $this->db->limit(20);
        $this->db->group_by('t.hotel_code');
        // $this->db->limit($perPage, $offset);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function all_fetch_search_result($sess_id, $offset, $perPage, $minPrice = '', $maxPrice = '', $starRating = '',$fac='', $hotelName = '', $location = '', $sortBy = '', $order = '',$accommodation_type='') {

        $sql = "SELECT t.*,t.hotel_code,p.hotel_name,p.latitude,p.longitude,p.image,p.star,t.city_name,p.location,p.hotel_facilities as amenities,p.address as address,p.description as description,t.description as short_desc,p.distances,t.image as hotimage,p.accomodation_type FROM (SELECT * FROM `hotel_search_result` ORDER BY `total_cost`) AS t JOIN `api_permanent_hotels` p ON t.hotel_code = p.hotel_code AND t.city_code = p.city_code WHERE t.session_id = '".$sess_id."' ";

        if ($minPrice != '' && $maxPrice != '') {
            $sql .= " AND CAST(t.total_cost AS DECIMAL(10, 2)) BETWEEN " . $minPrice . " AND " . $maxPrice;
        }

        if ($starRating != '') {
            $stars = explode(',', $starRating);
            $str = '';
            for ($s = 0; $s < count($stars); $s++) {
                if ($s == count($stars) - 1) {
                    $str .="'" . $stars[$s] . "'";
                } else {
                    $str .="'" . $stars[$s] . "'" . ",";
                }
            }
            //$this->db->where_in('p.star', $stars);
            $sql .= " AND p.star IN(" . $str . ")";
        }
        if ($location != '') {
            $loc_list = explode(',', $location);
            $strl = '';
            for ($s = 0; $s < count($loc_list); $s++) {
                if ($s == count($loc_list) - 1) {
                    $strl .="'" . $loc_list[$s] . "'";
                } else {
                    $strl .="'" . $loc_list[$s] . "'" . ",";
                }
            }
            $sql .= " AND t.resort_name IN(" . $strl . ")";
        }

        if ($accommodation_type != '') {
            $accommodation_type_list = explode(',', $accommodation_type);
            $stra = '';
            for ($s = 0; $s < count($accommodation_type_list); $s++) {
                if ($s == count($accommodation_type_list) - 1) {
                    $stra .="'" . $accommodation_type_list[$s] . "'";
                } else {
                    $stra .="'" . $accommodation_type_list[$s] . "'" . ",";
                }
            }
            $sql .= " AND p.accomodation_type IN(" . $stra . ")";
        }

        if ($fac != '') {
          $amenity_arr = explode(',', $fac);
          if(count($amenity_arr)>1) {
            $sql .= " AND ( FIND_IN_SET('" . $amenity_arr[0] . "', t.amenities)>0";
            for ($i=1; $i <(count($amenity_arr)-1) ; $i++) {
              $sql .= " OR FIND_IN_SET('" . $amenity_arr[$i] . "', t.amenities)>0";
            }
            $sql .= " OR FIND_IN_SET('" . $amenity_arr[$i] . "', t.amenities)>0 )";
          } else {
            $sql .= " AND FIND_IN_SET('" . $amenity_arr[0] . "', t.amenities)>0 ";
          }
        }

        if ($hotelName != '') {
            // $this->db->like('p.hotel_name', $hotelName);
            $sql .= " AND p.hotel_name LIKE '%".$hotelName."%'";
        }

        $sql .= " GROUP BY t.hotel_code";

        if ($sortBy != '' && $order != '') {
            if ($sortBy == 'data-price') {
                $sql .= " ORDER BY CAST(t.total_cost AS DECIMAL(10,2)) " . strtoupper($order);
            } else if ($sortBy == 'data-star') {
                $sql .= " ORDER BY p.star " . strtoupper($order);
            } else if ($sortBy == 'data-hotel-name') {
                $sql .= " ORDER BY p.hotel_name " . strtoupper($order);
            } else {
                $sql .= " ORDER BY CAST(t.total_cost AS DECIMAL(10,2)) ASC";
            }
        } else {
            // $sql .= " ORDER BY CAST(t.total_cost AS DECIMAL(10,2)) ASC";
            $sql .= " ORDER BY RAND()";
            
        }

        $query = $this->db->query($sql);
        // echo $this->db->last_query();exit;
        if ($query && $query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }

    }

    public function TotalSearchResults($sess_id, $minPrice = '', $maxPrice = '', $starRating = '', $fac='', $hotelName = '', $location = '') {
        $this->db->select('t.hotel_code');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);

		 //   $session_data = $this->session->userdata('hotel_search_data');
		 // $cityid = $session_data['cityCode'];
		 // $this->db->where('unique_cityid',$cityid);

        if ($minPrice != '' && $maxPrice != '') {
            $this->db->where('t.total_cost BETWEEN ' . $minPrice . ' AND ' . $maxPrice);
        }
        if ($starRating != '') {
            $stars = explode(',', $starRating);
            $this->db->where_in('p.star', $stars);
        }
        /*if ($fac != '') {
            $where1 = '';
            $facility = explode(',', $fac);
            for($l=0;$l<count($facility);$l++){
                $where1 .= "FIND_IN_SET('".$facility[$l]."', p.hotel_facilities)";
                if($l==(count($facility)-1)){
                }else{
                    $where1 .=' OR ';
                }
            }
            $this->db->where($where1);
        }*/
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
        if ($location != '') {
            $loc_list = explode(',', $location);
            $this->db->where_in('p.location', $loc_list);
        }
        if ($hotelName != '') {
            $this->db->like('p.hotel_name', $hotelName);
        }
        $this->db->group_by('t.hotel_code');
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->num_rows();
        }
    }


    public function fetchLocationMap($sess_id) {
        $this->db->select('p.latitude,p.longitude');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }


   public function insert_new_invoice($lastboookingid){

  // echo $lastboookingid;
   $lastboookingid1=$lastboookingid-1;

   $query=$this->db->select('invoice_number')->from('hotel_booking_reports')->where('report_id',$lastboookingid1)->get();
 //  echo $this->db->last_query();exit;
		if($query->num_rows()>0){
		$bookdata=$query->row();
		$lastinvoice=$bookdata->invoice_number;
	//	print_r($lastinvoice);exit;
		}else{
		$lastinvoice='00000/O/HOT';
		}
		$re=explode('/',$lastinvoice);

		$re1 = str_pad($re[0]+1, 6, 0, STR_PAD_LEFT);
		$invoice_number=$re1.'/O/HOT';

		$this->db->where('report_id',$lastboookingid);
		$dataupdate=array('invoice_number' => $invoice_number);
		$this->db->update('hotel_booking_reports',$dataupdate);
    return $lastinvoice;
   }



    public function get_hotel_crs_amenities($id)
    {
          $this->db->select('*');           
          $this->db->from('glb_hotel_facilities_type');
          $this->db->where('facility_type','hotel');
          $this->db->where('status','1');
          $this->db->where_in('id',$id);               
          $query=$this->db->get();
             if ($query->num_rows() > 0) {
            return $query->result();
        } 
    }

    public function get_hotel_crs_hotel_amenities($id) {
          $this->db->select('*');
          $this->db->from('glb_hotel_facilities_type');
          $this->db->where('facility_type','hotel');
          $this->db->where('status','1');
          $this->db->where_in('id',$id);
          $query=$this->db->get();
             if ($query->num_rows() > 0) {
            return $query->result();
        } 
    }
     

    public function delete_temp_results($sess_id) {
        $this->db->where('session_id', $sess_id);      
        $this->db->delete('hotel_search_result');
    }

    public function delete_temp_data($sess_id, $uniqueRefNo) {
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->where('session_id', $sess_id);
        $this->db->delete('hotel_search_data');
    }

    public function fetch_hotel_more_details($sess_id,$api,$hotel_code)
    {
          $this->db->select('*');           
          $this->db->from('hotel_search_result');  
          $this->db->where('session_id',$sess_id);
          $this->db->where('api',$api);
          $this->db->where('hotel_code',$hotel_code);                         
          $query=$this->db->get();
          if ($query->num_rows() > 0) 
          {
            return $query->result();
          } 
          else
          {
            return '';
          }
    } 

     public function check_hotel_search_data($sess_id,$uniqueRefNo)
     {
          $this->db->select('*');           
          $this->db->from('hotel_search_data');  
          $this->db->where('session_id',$sess_id);
          $this->db->where('uniqueRefNo',$uniqueRefNo);
          $query=$this->db->get();
            // echo $this->db->last_query();exit;

          if($query->num_rows() > 0) 
          {
            return $query->row();
          } 
          else
          {
            return '';
          }
     }


     public function insertUserWishList($search_id,$ses_id,$hotelCode,$api)
     {
        $data=array('hotel_code'=>$hotelCode,'api_name'=>$api,'user_no'=>$this->session->userdata('user_no'));
        $this->db->insert('user_wish_list',$data);

        $dataupdate=array('wish_list' =>1);
        $this->db->where('search_id',$search_id);
        $this->db->where('session_id',$ses_id);   
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api',$api);
        $this->db->update('hotel_search_result',$dataupdate);
        
     }

      public function removeUserWishList($search_id,$ses_id,$hotelCode,$api)
     { 
        $this->db->where('user_no',$this->session->userdata('user_no'));
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api_name',$api);
        $this->db->delete('user_wish_list');

        $dataupdate=array('wish_list' =>0);
        $this->db->where('search_id',$search_id);
        $this->db->where('session_id',$ses_id);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api',$api);
        $this->db->update('hotel_search_result',$dataupdate);     



     }

      public function insertUserCompareList($search_id,$ses_id,$hotelCode,$api)
     {
        $data=array('hotel_code'=>$hotelCode,'api_name'=>$api,'user_no'=>$this->session->userdata('user_no'));
        $this->db->insert('user_wish_list',$data);

        $dataupdate=array('compare_list' =>1);
        $this->db->where('search_id',$search_id);
        $this->db->where('session_id',$ses_id);   
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api',$api);
        $this->db->update('hotel_search_result',$dataupdate);
        
     }

      public function removeUserCompareList($search_id,$ses_id,$hotelCode,$api)
     { 
        $this->db->where('user_no',$this->session->userdata('user_no'));
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api_name',$api);
        $this->db->delete('user_wish_list');

        $dataupdate=array('compare_list' =>0);
        $this->db->where('search_id',$search_id);
        $this->db->where('session_id',$ses_id);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('api',$api);
        $this->db->update('hotel_search_result',$dataupdate);     



     }


      public function getHotelDetails($hotelCode,$ses_id,$ref) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('session_id',$ses_id);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('uniqueRefNo',$ref);
        $query = $this->db->get();
          // echo $this->db->last_query();exit;
        

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

  public function gethotelcitydetails($code) 
   {  
        if(!empty($code))
        {
          $this->db->select('*');
          $this->db->from('jamaican_city_list');
          $this->db->where('id',$code); 
          $query = $this->db->get();
          // echo $this->db->last_query();exit;
          if ($query->num_rows() == '') 
          {
              return '';
          } else {
              return $query->row();
          }
      }
      else 
      {
              return '';
      }
   }


    public function getCompareListHotel($sess_id,$search_id) 
    {
        $this->db->select('t.*,p.hotel_name,p.latitude,p.longitude,p.image,p.star,t.city_name,p.location,p.hotel_facilities as amenities,p.address as address,p.description as description,p.distances,p.image as hotimage,p.accomodation_type');
        $this->db->from('hotel_search_result t');
        $this->db->join('api_permanent_hotels p', 't.hotel_code = p.hotel_code AND t.city_code = p.city_code');
        $this->db->where('t.session_id', $sess_id);
        $where='t.search_id IN ('.$search_id.')';
        $this->db->where($where);
        $this->db->order_by('t.total_cost', 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) 
        {
            return '';
        } 
        else 
        {
            return $query->result();
        }
    }

    public function getSupHotelDetails($hotelCode) {
        $this->db->select('*');
        $this->db->from('supplier_hotel_list');
        $this->db->where('hotel_code', $hotelCode);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return array();
    }
    
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

?>
