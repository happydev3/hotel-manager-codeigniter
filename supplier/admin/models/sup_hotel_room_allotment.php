<?php

class sup_hotel_room_allotment extends MY_Model {

    protected $_table_name = 'sup_hotel_room_allotment';
    protected $_primary_key = 'sup_hotel_room_allotment_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_hotel_room_allotment_id Desc";

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

function delete_room_room_allotment($hotel_code, $room_code, $startdate,$enddate,$contract_id,$supplier_id) { 
        $this->db->where('room_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');        
        $this->db->where('room_code', $room_code);      
        $this->db->where('hotel_code', $hotel_code);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('contract_id', $contract_id);

        $this->db->delete('sup_hotel_room_allotment');
    }

}