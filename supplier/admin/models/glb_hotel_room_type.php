<?php

class glb_hotel_room_type extends MY_Model {

    protected $_table_name = 'glb_hotel_room_type';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id Desc";
    private $supplier_id;

    function __construct() {
        parent :: __construct();
        $this->supplier_id = $this->session->userdata('supplier_id');
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
        // $query = parent::get($id, $single, $fields);
        $query = parent::get_supplier($id,$single,$fields,$this->supplier_id);
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
        $this->db->select()
            ->from($this->_table_name)
            ->where($array)
            ->where('supplier_id',$this->supplier_id);
        $query = $this->db->get();
        if($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

}