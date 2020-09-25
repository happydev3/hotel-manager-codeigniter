<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 
 *  
 *
 * @package		
 * @author		Saahil
 * @copyright	Copyright (c) 2013 - 2014, Travelpd
 * @license		http://www.travelpd.com/support/license-agreement
 * @link		http://www.travelpd.com
 * 
 */

class fitruums_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function set_credientials($api) {
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

    public function get_city_code($city_code) {
        $this->db->select('city_name,city_id,area_code');
        $this->db->from('gta_city_list');
        $this->db->where('city_code', $city_code);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_unique_city_code($id) {
        $this->db->select('*')->from('ace_jac_roomsxml_gta_city')->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $city_code = $query->row();
            return $city_code->gta_city_code;
        } else {
            return '';
        }
    }

    public function get_room_types($adults_num, $childs_num, $infants_num) {
        $this->db->select('*');
        $this->db->from('gta_room_types');
        $this->db->where('adults', $adults_num);
        $this->db->where('childs', $childs_num);
        $this->db->where('infants', $infants_num);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_hotel_result_rooms($session_id, $hotelCode) {
        $this->db->select('*');
        $this->db->from('hotel_search_result');
        $this->db->where('session_id', $session_id);
        $this->db->where('hotel_code', $hotelCode);
        $this->db->order_by('currency_conv_value', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function delete_temp_results($sess_id, $api) 
    {
        $this->db->where('session_id', $sess_id);
        $this->db->where('api', $api);
        $this->db->delete('hotel_search_result');
    }

    public function insert_temp_search_result($availability_data) {
        //$this->db->insert_batch('hotel_search_result', $availability_data);
        $this->db->insert_batch('hotel_search_result', $availability_data);

        return true;
    }

    public function fetch_search_result($sess_id, $api, $Sys_RefNo) {
        $this->db->select('sr.*,hd.hotel_name,hd.location,hd.image_thumbnail as image,hd.star');
        $this->db->from('hotel_search_result sr');
        $this->db->join('fitruums_hoteldetails hd', 'sr.hotel_code = hd.hotel_code AND sr.gta_city_code = hd.city_code');
        $this->db->where('sr.session_id', $sess_id);
        $this->db->where('sr.api', $api);
        $this->db->where('sr.uniqueRefNo', $Sys_RefNo);
        $this->db->group_by('sr.hotel_code');
        $this->db->order_by('sr.total_cost', 'ASC');

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    public function getHotelDetails($hotelCode, $searchId) {
        $this->db->select('*');
        $this->db->from('hotel_search_result t');
        $this->db->join('fitruums_hoteldetails p', 't.hotel_code = p.hotel_code AND t.city_code=p.city_code');
        $this->db->where('t.search_id', $searchId);
        $this->db->where('t.hotel_code', $hotelCode);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function getHotelImages($hotelCode,$city_code) {
        $this->db->select('image as images');
        $this->db->from('fitruums_hoteldetails');
        $this->db->where('hotel_code', $hotelCode);
          $this->db->where('city_code', $city_code);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function getHotelDescriptions($hotelCode,$city_code) {
        $this->db->select('description');
        $this->db->from('fitruums_hoteldetails');
        $this->db->where('hotel_code', $hotelCode);
          $this->db->where('city_code', $city_code);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return '';
    }

    public function get_hotel_facility_details($hotelCode) {
        $this->db->select('fac as amenities');
        $this->db->from('gta_hotel_facilities');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->group_by('fac_type');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    public function get_room_facility_details() {
        $this->db->select('fac as amenities,fac_type as amenity_code');
        $this->db->from('gta_room_facilities');
//        $this->db->where('hotel_code', $hotelCode);
        $this->db->group_by("fac_type");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_hotel_rooms($city_code, $session_id, $hotelCode) {
        $this->db->select('t.*,p.*');
        $this->db->from('hotel_search_result t');
        $this->db->join('fitruums_hoteldetails p', 't.hotel_code = p.hotel_code');
        $this->db->where('p.city_code', $city_code);
        $this->db->where('t.session_id', $session_id);
        $this->db->where('t.hotel_code', $hotelCode);
      //  $this->db->order_by('t.currency_conv_value', 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return '';
    }

    function get_country_list() {
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_nearby_hotels($sess_id, $hotelCode, $lat, $long, $city) {
        $this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long - `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
        $this->db->from('hotel_search_result h');
        $this->db->join('fitruums_hoteldetails p', 'h.hotel_code = p.hotel_code');
        $this->db->where('p.city', $city);
        $this->db->where('p.hotel_code !=', $hotelCode);
        $this->db->where('h.session_id', $sess_id);
        $this->db->group_by('p.hotel_name');
        $this->db->having('distance <', 9);
        $this->db->limit(5);
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_related_hotels($sess_id, $hotelCode, $lat, $long, $city) {
        $this->db->select("*,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long - `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance");
        $this->db->from('hotel_search_result h');
        $this->db->join('fitruums_hoteldetails p', 'h.hotel_code = p.hotel_code');
        $this->db->where('p.city', $city);
        $this->db->where('p.hotel_code !=', $hotelCode);
        $this->db->where('h.session_id', $sess_id);
        $this->db->group_by('p.hotel_name');
        $this->db->having('distance >', 9);
        $this->db->limit(4);
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function getRoomDetails($api, $sess_id, $hotelCode, $searchId) {
        $this->db->select('a.*,b.*');
        $this->db->from('hotel_search_result a');
        $this->db->join('fitruums_hoteldetails b', 'a.hotel_code = b.hotel_code AND a.city_code=b.city_code', 'left');
        $this->db->where('b.hotel_code', $hotelCode);
        $this->db->where('a.session_id', $sess_id);
        $this->db->where('a.api', $api);
        $this->db->where('a.search_id', $searchId);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function update_gta_temp_hotel_result_price($data) {
        $data1 = array(
            'org_amt' => $data['org_cost'],
         'admin_markup' => $data['admin_markup'],
                  'admin_agent_markup' => $data['admin_agent_markup'],
                        'di_markup' => $data['di_markup'],
                        'di_agent_markup'=> $data['di_agent_markup'],
                      'sub_agent_markup' => $data['sub_agent_markup'],
             'payment_charge' => $data['payment_charge'],
            'total_cost' => $data['total_cost'],
            'cancel_amount' => $data['cancel_amount'],
            // 'cancel_till_date' => $data['cancel_till_date'],
            'cancel_policy' => $data['can_pal'],
        );
        $where = array(
            'search_id' => $data['search_id'],
            'session_id' => $data['session_id'],
            'api' => $data['api'],
        );
        $this->db->update('hotel_search_result', $data1, $where);
        // echo $this->db->last_query(); exit;
    }

    public function insert_booking_report_data($user_id, $agent_id, $agent_type,$bookingItemCodeval, $book_noval, $book_noval_api, $CMH_RefNo, $booking_status, $Booking_Date, $Booking_Amount, $total_cost, $Admin_Markup, $Admin_Agent_Markup,$di_markup,$di_agent_markup,$sub_agent_markup, $Payment_Charge, $Currecy, $Xml_Currency, $Booking_Done_By, $cancel_policy,$pay_type) {
        $data = array('user_id' => $user_id,
            'agent_id' => $agent_id,
            'Api_Name' => 'gta',
            'Hotel_RefNo' => $bookingItemCodeval,
            'Booking_RefNo' => $book_noval,
            'Api_Booking_RefNo' => $book_noval_api,
            'uniqueRefNo' => $CMH_RefNo,
            'Booking_Status' => $booking_status,
            'Booking_Date' => $Booking_Date,
            'Booking_Amount' => $Booking_Amount,
            'total_cost' => $total_cost,
            'Admin_Markup' => $Admin_Markup,
            'Admin_Agent_Markup' => $Admin_Agent_Markup,
            'Payment_Charge' => $Payment_Charge,
            'Currecy' => $Currecy,
            'Xml_Currency' => $Xml_Currency,
            //'Cancel_Till_Date' => $Cancel_Till_Date,
            'Booking_Done_By' => $Booking_Done_By,
            // 'payment_type'=>$payment_type
            'cancel_policy' => $cancel_policy,
            'Di_Markup'=>$di_markup,
            'Di_Agent_Markup'=>$di_agent_markup,
            'Sub_Agent_Markup'=>$sub_agent_markup,
            'payment_type'=>$pay_type,
            'agent_type'=>$agent_type,
        );


        $this->db->insert('hotel_booking_reports', $data);
        //echo $this->db->last_query();exit;	
        return $this->db->insert_id();
    }

    public function insert_hotel_booking_information_data($user_id,$user_no, $agent_id, $CMH_RefNo, $hotel_code, $hotel_name, $room_code, $city_code, $check_in, $check_out, $voucher_date, $city, $room_type, $inclusion, $star, $address, $room_count, $cancellation_policy, $adult, $child,$infant, $description, $phone, $fax, $image, $nights, $api,$fitruums_notes,$childs_ages,$latitude,$longitude,$nationality) {
        // $this->set_variables();
        $data = array(
            'user_id' => $user_id,
            'user_no' => $user_no,
            'agent_id' => $agent_id,
            'uniqueRefNo' => $CMH_RefNo,
            'hotel_code' => $hotel_code,
            'hotel_name' => $hotel_name,
            'room_code' => $room_code,            
            'city_code' => $city_code,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'voucher_date' => $voucher_date,
            'city' => $city,
            'room_type'=> $room_type,
            'inclusion'=>$inclusion,
            'star' => $star,
            'address' => $address,
            'room_count' => $room_count,
            'cancellation_policy' => $cancellation_policy,
            'adult' => $adult,
            'child' => $child,
            'infant'=>$infant,
            'childage'=>$childs_ages,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
            'description' => $description,
            'phone' => $phone,
            'fax' => $fax,
            'image' => $image,
            'nights' => $nights,
            'api' => $api,
            'fitruums_notes'=>$fitruums_notes
        );

        $this->db->insert('hotel_booking_hotels_info', $data);
        //echo $this->db->last_query();exit;	
        $insert_id = $this->db->insert_id();

        $passenger_info = $this->session->userdata('passenger_info');
        $session_data = $this->session->userdata('hotel_search_data');
        // echo '<pre>';print_r($passenger_info);exit;

        if ($insert_id) 
        {
            $adt = 0;
            $chd = 0;
            for ($i = 0; $i < 1; $i++)
            {               
                $adultFNames = $passenger_info['adults_fname'];
                $adultLNames = $passenger_info['adults_lname'];
                if (isset($passenger_info['childs_fname']))
                {                  
                    $childFNames = $passenger_info['childs_fname'];
                    $childLNames = $passenger_info['childs_lname'];
                }

                $mobile = $passenger_info['user_mobile'];
                $email = $passenger_info['user_email'];

                $country = $this->getCountryName($nationality);
                /*Adult Info*/
                for ($a = 0; $a < $adult; $a++)
                {
                    $adult_data = array(
                                        'uniqueRefNo' => $CMH_RefNo,
                                        'passenger_type' => 'adult',
                                        // 'title' => $adultTitles[$adt],
                                        'first_name' => $adultFNames[$adt],
                                        'last_name' => $adultLNames[$adt],
                                        'room_no' => $i + 1,
                                        'mobile' => $mobile,
                                        'email' => $email,
                                        'country' => $country
                                       );
                    $this->db->insert('hotel_booking_passengers_info', $adult_data);
                    $adt++;
                }
                /*Childs Info*/
                if ($child != 0)
                {
                    $childages = explode(',', $childs_ages);
                    for ($c = 0; $c < $child; $c++) 
                    {
                        if (isset($childages[$c]) && $childages[$c] != '')
                         {
                            $age = $childages[$c];
                         }
                        else
                        {
                            $age = 0;
                        }

                        $child_data = array(
                                            'uniqueRefNo' => $CMH_RefNo,
                                            'passenger_type' => 'child',
                                            // 'title' => $childTitles[$chd],
                                            'first_name' => $childFNames[$chd],
                                            'last_name' => $childLNames[$chd],
                                            'room_no' => $i + 1,
                                            'child_age' => $age
                                          );
                        $this->db->insert('hotel_booking_passengers_info', $child_data);
                        $chd++;
                    }
                }
                /*Infant Info*/
                if($infant==1)
                {
                      $adult_data = array(
                                        'uniqueRefNo' => $CMH_RefNo,
                                        'passenger_type' => 'infant',
                                        // 'title' => $adultTitles[$adt],
                                        'first_name' => $passenger_info['infant_fname'],
                                        'last_name' =>$passenger_info['infant_lname'],
                                        'room_no' => $i + 1,
                                          );
                      $this->db->insert('hotel_booking_passengers_info', $adult_data);
                }
            }
        }
        return true;
    }

    function set_variables() {
        $session_data = $this->session->userdata('hotel_search_data');
        //echo '<pre/>';print_r($session_data);exit;
        $this->city_name = $session_data['cityName'];
        $this->city_code = $session_data['cityCode'];

        $this->cin = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkIn'])));
        $this->cout = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkOut'])));

        $this->nationality = $session_data['nationality'];

        $this->nights = $session_data['nights'];
        $this->rooms = $session_data['rooms'];
        $this->adults = $session_data['adults'];
        $this->childs = $session_data['childs'];
        $this->childs_ages = $session_data['childs_ages'];
        $this->adults_count = $session_data['adults_count'];
        $this->childs_count = $session_data['childs_count'];

        $this->base_currency = 'GBP';
    }

    function get_admin_markup($nationality) {
        $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        $res = $query->row();
        $country = $res->name;


        $this->db->select('markup');
        $this->db->from('b2c_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('country', $country);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', 'gta');
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $admin_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('b2c_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', 'gta');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();
            if ($query2->num_rows > 0) {
                $res2 = $query2->row();
                $admin_markup_val = $res2->markup;
            } else {
                $admin_markup_val = 0;
            }
        }
        return $admin_markup_val;
    }

    function get_payment_charge() {
        $this->db->select('charge');
        $this->db->from('payment_gateway');
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $payment_charge_val = $res->charge;
        } else {
            $payment_charge_val = 0;
        }
        return $payment_charge_val;
    }

    function get_admin_agent_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('b2b_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', 'gta');
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $agent_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('b2b_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('agent_no', $agent_no);
            $this->db->where('service_type', 1);
            $this->db->where('api_name', 'gta');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();
            if ($query2->num_rows > 0) {
                $res2 = $query2->row();
                $agent_markup_val = $res2->markup;
            } else {
                $agent_markup_val = 0;
            }
        }
        return $agent_markup_val;
    }

    function get_agent_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('agent_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $agent_markup = $res->markup;
        } else {
            $agent_markup = 0;
        }
        return $agent_markup;
    }

//    function get_agent_available_balance($agent_no) {
//        $this->db->select('available_balance')
//                ->from('agent_acc_summary')
//                ->where('agent_no', $agent_no)
//                ->order_by('transaction_datetime', 'DESC')
//                ->limit('1');
//        $query = $this->db->get();
//
//        if ($query->num_rows() > 0) {
//            $res = $query->result();
//            $balance = $res[0]->available_balance;
//        } else {
//            $balance = 0;
//        }
//
//        return $balance;
//    }

    public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total, $BOOKING_REFERENCE_NO, $agent_type) {
        $disc_tran = 'Regarding Hotel Booking Ref: ' . $BOOKING_REFERENCE_NO;
        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;

        $data['agent_no'] = $agent_no;
        $data['transaction_summary'] = $disc_tran;
        $data['agent_id'] = $agent_id;
        $data['withdraw_amount'] = $withdraw_amount;
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($agent_type == 1) {
            $this->db->insert('distributor_acc_summary', $data);
        } elseif ($agent_type == 2) {
            $this->db->insert('agent_acc_summary', $data);
        } elseif ($agent_type == 3) {
            $this->db->insert('b2b2b_acc_summary', $data);
        }
    }

    public function get_facility_details($hotelCode) {
        $result = array();
        $this->db->select('fac as amenities');
        $this->db->from('gta_hotel_facilities');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->group_by('fac_type');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            $result = $query->result();

        $this->db->select('fac as amenities');
        $this->db->from('gta_room_facilities');
        $this->db->where('hotel_code', $hotelCode);
        $this->db->group_by('fac_type');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return array_merge($result, $query->result());
        else
            return array();
    }

    public function get_gta_room_types($room_type_id) {
        $this->db->select('*');
        $this->db->from('gta_room_types');
        $this->db->where('room_type_id', $room_type_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return array();
    }

    public function get_b2b_hotel_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*,a.agent_no,a.agency_name')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                ->join('agent_info a', 'hr.agent_id = a.agent_id')
                ->where('hr.uniqueRefNo', $sysRefno);
//                ->order_by('hh.hotel_booking_id', 'DESC')
//                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_b2c_hotel_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                ->join('user_info u', 'hr.user_id = u.user_id')
                ->where('hr.uniqueRefNo', $sysRefno);
//                ->order_by('hh.hotel_booking_id', 'DESC')
//                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
//echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_guest_hotel_booking_details($sysRefno) {
        $this->db->select('hr.*,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.uniqueRefNo = hh.uniqueRefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.uniqueRefNo = hp.uniqueRefNo')
                // ->join('user_info u', 'hr.user_id = u.user_id')
                ->where('hr.uniqueRefNo', $sysRefno);
//                ->order_by('hh.hotel_booking_id', 'DESC')
//                ->group_by('hp.uniqueRefNo');
        $query = $this->db->get();
//echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function update_hotel_booking_cancellation($Book_reference, $Amount, $cancel_id) {
        $data['Booking_Status'] = 'Cancelled';
        //$data['Cancellation_ID'] = $cancel_id;
        $data['Cancellation_Charge'] = $Amount;
        $data['Cancel_Till_Date'] = date('Y-m-d');
        $data['Cancellation_Status'] = 'Cancelled';
        $where = "Booking_RefNo = '$Book_reference'";
        if ($this->db->update('hotel_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_agent_balance($agent_no) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_no', $agent_no)
                ->where('status', 'Accepted')
                ->order_by('transaction_datetime', 'DESC');
        //->order_by('acc_id', 'DESC');
        $query = $this->db->get();
        //  echo $this-db->last_query();


        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    public function insert_b2b_cancel_refund_amt($agent_id, $agent_no, $refund_amount, $total, $BOOKING_REFERENCE_NO) {
        $disc_tran = 'Refund Hotel Booking Amount Ref: ' . $BOOKING_REFERENCE_NO;
        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;
        $data['agent_no'] = $agent_no;
        $data['transaction_summary'] = $disc_tran;
        $data['agent_id'] = $agent_id;
        $data['deposit_amount'] = $refund_amount;
        $this->db->set('approve_date', 'NOW()', FALSE);
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($this->db->insert('agent_acc_summary', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function pay_details($payinsert) {
        $this->db->insert('pay_details', $payinsert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_pay_tran_id($refno) {
        $this->db->select('*');
        $this->db->from('pay_details');
        $this->db->where('uniqueRefNo', $refno);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update_gta_search($total, $payment_charge, $sessionId, $hotelCode, $searchId) {
        $data = array(
            'total_cost' => $total,
            'payment_charge' => $payment_charge,
        );
        $this->db->where('search_id', $searchId);
        $this->db->where('session_id', $sessionId);
        $this->db->where('hotel_code', $hotelCode);
        $this->db->update('hotel_search_result', $data);
    }

    function get_agent_available_balance($agent_no, $agent_type) {
        if ($agent_type == 1) {
            $this->db->select('available_balance')
                    ->from('distributor_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }
        if ($agent_type == 2) {
            $this->db->select('available_balance')
                    ->from('agent_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }
        if ($agent_type == 3) {
            $this->db->select('available_balance')
                    ->from('b2b2b_acc_summary')
                    ->where('agent_no', $agent_no)
                    ->order_by('transaction_datetime', 'DESC')
                    ->limit('1');
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        return $balance;
    }

      public function get_roomsxml_gta_city($id) {
        $this->db->select('*')->from('ace_jac_roomsxml_gta_city')->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {         
            return $query->row();
        } else {
            return '';
        }
    }

      public function get_fitruums_city($cityname,$countryname) {
        $this->db->select('*')->from('fitruums_city_list');
        $this->db->where('cityname', $cityname);
        $this->db->where('countryname', $countryname);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $city_code = $query->row();
            return $city_code->cityid;          
        } else {
            return '';
        }
    }

       public function get_resort_details($resortid,$cityid) {
        $this->db->select('*')->from('fitruums_resort_list');
        $this->db->where('resortid', $resortid);
        $this->db->where('cityid', $cityid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $resort = $query->row();
            return $resort->resortname;          
        } else {
            return '';
        }
    }

    public function get_meal_name($mealid) 
    {
        $this->db->select('*')->from('fitruums_meal_list');
        $this->db->where('mealid', $mealid);     
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $meal = $query->row();
            return $meal->mealname;          
        } else {
            return '';
        }
    }
     public function get_meallabel_name($mealid,$labelid) 
    {
        $this->db->select('*')->from('fitruums_meallabel_list');
        $this->db->where('mealid', $mealid);     
        $this->db->where('labelid', $labelid);     
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $meallabel = $query->row();
            return $meallabel->labeltext;          
        } else {
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
          if ($query->num_rows() > 0) 
          {
            return $query->row();
          } 
          else
          {
            return '';
          }
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

      public function getFitruumsRoomTypes($room_type_id)
       {
        $this->db->select('*');
        $this->db->from('fitruums_roomtype_list');
        $this->db->where('roomtypeid', $room_type_id);
        $this->db->limit('1');
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {            
            return $query->row();
        }
    }
     public function updatePrebookingPrice($session_id, $hotelCode, $searchId, $refNo,$dataUpdate)
     {
          $this->db->where('search_id',$searchId);
          $this->db->where('hotel_code',$hotelCode);
          $this->db->where('session_id',$session_id);
          $this->db->where('uniqueRefNo',$refNo);
          $this->db->update('hotel_search_result',$dataUpdate);  
     }

       public function getTrustYouID($IDs)
     {
          $this->db->select('*');           
          $this->db->from('trustyou_ty_id');  
          $this->db->where('IDs',$IDs);        
          $query=$this->db->get();
          if($query->num_rows() > 0) 
          {
            $res=$query->row();
             return $res->TrustYou;
          } 
          else
          {
            return '';
          }
     }

       public function gethotelcodes($cityid,$start,$end)
       {
            $this->db->select('hotel_code');
            $this->db->from('fitruums_hoteldetails'); 
            $this->db->where('city_code',$cityid);
            $this->db->limit($end,$start);
            $query=$this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return '';
            }
    }

     function getCountryName($nationality) 
     {
        $this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
        {
            $res = $query->row();
            $country = $res->name;
            return $country;
        } 
        else
        {
                return '';
         }
    }

    function getWishList($user_no)
    {
        $this->db->select('hotel_code');
        $this->db->where('user_no',$user_no);        
        $this->db->from('user_wish_list');       
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
        {
            $res=$query->result_array(); 
            $hotelCode=array(); 
            foreach ($res as $val) 
            {
               $hotelCode[]=$val['hotel_code'];
            }
            return $hotelCode;         
        } 
        else
        {
                return '';
         } 
    }

    function updateWishList($sess_id,$api,$uniqueRefNo,$res)
    {
        $dataupdate=array('wish_list' =>1);
        $this->db->where('uniqueRefNo',$uniqueRefNo);
        $this->db->where('session_id',$sess_id);
        $this->db->where('api',$api);
        $this->db->where_in('hotel_code',$res);   
        $this->db->update('hotel_search_result',$dataupdate); 
        // echo $this->db->last_query();exit;


    } 

    

}

?>
