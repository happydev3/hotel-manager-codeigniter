<?php

class sup_hotel_room_allotment_list extends MY_Model {

    protected $_table_name = 'sup_hotel_room_allotment_list';
    protected $_primary_key = 'sup_hotel_room_allotment_list_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_hotel_room_allotment_list_id Desc";

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

function delete_room_room_allotment_list($hotel_id, $room_id, $startdate,$enddate,$contract_id) {
        $this->db->where('from_date',$startdate);
        $this->db->where('to_date',$enddate);      
        $this->db->where('sup_room_details_id', $room_id);      
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->where('contract_id', $contract_id);
        $this->db->delete('sup_hotel_room_allotment_list');
    }

}