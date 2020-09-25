<?php

class sup_hotel_room_rates extends MY_Model {

    protected $_table_name = 'sup_hotel_room_rates';
    protected $_primary_key = 'sup_hotel_room_rates_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_hotel_room_rates_id Desc";

    function __construct() {
        parent :: __construct();
    }

    function insert($data) {
        $error = parent::insert($data);
        return $error;
    }
      
    function update($data, $id = NULL) {
        $error = parent::update($data, $id);
        return $error;
    }
    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }
    function get_active($fields=NULL) {
        $column = 'status';
        $query = parent::get_active($column,1,$fields);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
   
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }

      function check($array=NULL) {
        $this->db->select()->from($this->_table_name)->where($array);
        $query = $this->db->get();
          if($query->num_rows > 0)
        {
        return $query->result();
       }
       else
       {
        return '';
       }
    }



      function delete_room_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $startdate,$enddate) {
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');      
        $this->db->where('supplier_id', $supplier_id);      
        $this->db->where('room_id', $room_id);      
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_rate_code', $room_rate_code);      
        $this->db->delete($this->_table_name);
    }

    public function update_room_rates($hotel_id,$room_code,$room_rate_code,$sup_hotel_room_rates_id,$supplier_id,$data){
    $this->db->where('sup_hotel_room_rates_id',$sup_hotel_room_rates_id);
    $this->db->where('room_rate_code',$room_rate_code);
    $this->db->where('room_code',$room_code);
    $this->db->where('hotel_id',$hotel_id);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->update('sup_hotel_room_rates',$data);
   }

     public function get_roomrates_by_date($room_code, $startdate, $enddate,$room_rate_code='',$supplier_id) {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_rates');
        $this->db->where('room_code', $room_code);
        if($room_rate_code!='')
        {
         $this->db->where('room_rate_code', $room_rate_code);   
        }     
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$supplier_id);

        $query = $this->db->get();   
        // echo $this->db->last_query(); exit;     
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}