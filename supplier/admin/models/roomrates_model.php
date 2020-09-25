<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roomrates_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_hotel_by_id($id) {
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('sup_hotel_id', $id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_hotels() {
        $this->db->select('*');
        $this->db->from('sup_hotels');
        $this->db->where('status', 1);
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_rooms_by_id($id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        //$this->db->where('supplier_id', $this->session->userdata('supplier_id'));
        $this->db->where('sup_hotel_id', $id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * Get room by his is
     * @param int $id 
     * @return array
     */
    public function get_room_by_id($id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        // $this->db->where('status', 1);
        $this->db->where('sup_room_details_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_roomrates_by_date($room_id, $startdate, $enddate) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_rates');
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function new_cal_get_roomrates_by_date($sup_room_details_id, $sup_hotel_id, $hotel_code,$room_code,$from_date,$to_date) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_rates');
        $this->db->where('sup_room_details_id', $sup_room_details_id);        
		$this->db->where('sup_hotel_id', $sup_hotel_id);        
		$this->db->where('hotel_code', $hotel_code);        
	//	$this->db->where('room_code', $room_code);        
		if($from_date){
			$this->db->where('room_avail_date >=', date('Y-m-d',strtotime($from_date)));
				}
				if($to_date !=''){
				$this->db->where('room_avail_date <=', date('Y-m-d',strtotime($to_date)));			
				}
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_rooms() {

        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function add_room_rates($data) {

        $this->db->insert('sup_hotel_room_rates', $data);
        return true;
    }

    function update_room($sup_room_details_id, $data) {

        $this->db->where('sup_room_details_id', $sup_room_details_id);

        $this->db->update('sup_hotel_room_details', $data);
        return true;
    }

    function delete_room($id) {
        $this->db->where('id', $id);
        //$this->db->where('supplier_id', $this->session->userdata('supplier_id'));
        $this->db->delete('sup_hotel_room_details');
    }

    function delete_room_rates_old($hotel_id, $room_id, $dates) {
        $this->db->where_in('room_avail_date', $dates);
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->delete('sup_hotel_room_rates');
    }

      function delete_room_rates($hotel_id, $room_id, $startdate,$enddate,$contract_id,$market,$meal_plan) {
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');      
        $this->db->where('sup_room_details_id', $room_id);      
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->where('contract_id', $contract_id);
        $this->db->where('market', $market);
         $this->db->where('meal_plan', $meal_plan);
        $this->db->delete('sup_hotel_room_rates');
    }
    function get_room_by_room_id($room_id){
        $this->db->select('*');
        $this->db->from('sup_hotel_room_details');
        $this->db->where('sup_room_details_id',$room_id);
        $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }
	public function manage_room_rates_status($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$status){
	
	$this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
	$this->db->where('room_code',$room_code);
	$this->db->where('hotel_code',$hotel_code);
	$this->db->where('supplier_id',$supplier_id);
	$this->db->where('sup_room_details_id',$sup_room_details_id);
$data=array(
'status'=>$status
);	
$this->db->update('sup_hotel_room_rates',$data);
	}
	public function get_roomrates_edit($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$status){
	 $this->db->select('*');
        $this->db->from('sup_hotel_room_rates');
	$this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
	$this->db->where('room_code',$room_code);
	$this->db->where('hotel_code',$hotel_code);
	$this->db->where('supplier_id',$supplier_id);
	$this->db->where('sup_room_details_id',$sup_room_details_id);
 $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
	}
public function get_roomrates_update_old($sup_hotel_room_rates_id, $room_code, $hotel_code,$sup_room_details_id,$room_fixed_rate,$extra_bed_adult,$extra_bed_child){
	$this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
	$this->db->where('room_code',$room_code);
	$this->db->where('hotel_code',$hotel_code);
	$this->db->where('sup_room_details_id',$sup_room_details_id);
	$data=array(
	'room_fixed_rate'=>$room_fixed_rate,
	'extra_bed_adult'=>$extra_bed_adult,
    'extra_bed_child'=>$extra_bed_child,	
	);
	$this->db->update('sup_hotel_room_rates',$data);
}

public function get_roomrates_update($sup_hotel_room_rates_id, $room_code, $hotel_code,$sup_room_details_id,$supplier_id,$data){
    $this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
    $this->db->where('room_code',$room_code);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);    
    $this->db->where('sup_room_details_id',$sup_room_details_id);   
    $this->db->update('sup_hotel_room_rates',$data);
}


}
