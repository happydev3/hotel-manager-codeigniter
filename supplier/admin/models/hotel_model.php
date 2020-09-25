<?php

class hotel_model extends MY_Model {

    protected $_table_name = 'supplier_hotel';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "hotel_name asc";

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

    public function getHotelImages($hotel_id){
        $this->db->select('*');
        $this->db->from('supplier_hotel_images');
        $this->db->where('supplier_hotel_list_id',$hotel_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function getHotelImagesById($id){
        $this->db->select('*');
        $this->db->from('supplier_hotel_images');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function deleteHotelImages($hotel_id) {
        $this->db->where('supplier_hotel_list_id', $hotel_id);
        $this->db->delete('supplier_hotel_images');
        return $this->db->affected_rows();
    }

    public function insertHotelImages($data){
        if ($this->db->insert_batch('supplier_hotel_images', $data)) {
            return true;
        } else {
            return false;
        }
    }

}