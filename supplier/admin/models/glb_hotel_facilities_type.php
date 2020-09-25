<?php

class glb_hotel_facilities_type extends MY_Model {

    protected $_table_name = 'glb_hotel_facilities_type';
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
        return true;
    }
    function get($fields=NULL,$id=NULL,$single=FALSE) {
        // $query = parent::get($id, $single, $fields);
        // $query = parent::get_supplier($id,$single,$fields,$this->supplier_id);
        // return $query;
        $where = "(supplier_id=$this->supplier_id OR supplier_id=0)";
        $this->db->select($fields);
        $this->db->from($this->_table_name);
        if($id!=NULL){
            $this->db->where($this->_primary_key,$id);
        } else {
            $this->db->where($where);
        }
        $query = $this->db->get();
        if($query->num_rows > 0) {
            if($single==FALSE){
                return $query->result();
            } else {
                return $query->row();
            }
        } else {
            return '';
        }
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        // $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        // return $query;
        $where = "(supplier_id=$supplier_id OR supplier_id=0)";
        $this->db->select($fields);
        $this->db->from($this->_table_name);
        if($id!=NULL){
            $this->db->where($this->_primary_key,$id);
        } else {
            $this->db->where($where);
        }
        $query = $this->db->get();
        if($query->num_rows > 0) {
            if($single==FALSE){
                return $query->result();
            } else {
                return $query->row();
            }
        } else {
            return '';
        }
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
        $where = "(supplier_id=$this->supplier_id OR supplier_id=0)";
        $this->db->select();
        $this->db->from($this->_table_name);
        if($array!=NULL){
            $this->db->where($array);
        }
        $this->db->where($where);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        if($query->num_rows > 0) {
            return $query->result(); 
        } else {
            return '';
        }
    }


}