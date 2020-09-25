<?php

class holiday_city extends MY_Model {

    protected $_table_name = 'holiday_city';
    protected $_primary_key = 'city_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "city_name asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL, $id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal,$fields);
        return $query;
    }

    function insert($array) {
        $error = parent::insert($array);
        return TRUE;
    }
    function get_active($fields=NULL) {
        $column = 'status';
        $query = parent::get_active($column,1,$fields);
        return $query;
    }
    function get_iti_city($destination) {
        $this->db->where('city_id', $destination);
        $this->db->select('city_id,city_name');
        $query = $this->db->get('holiday_city');
        return $query->result();
    }
    function get_city_name($id) {
        $this->db->where('city_id', $id);
        $this->db->select('city_name');
        $query = $this->db->get('holiday_city');
        $result = $query->row();
        return $result->city_name;
    }

    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function check($array=NULL) {
        $this->db->select()->from($this->_table_name)->where($array);
        $query = $this->db->get();
        return $query->result();
    }

    function get_cities($fields,$destination) {
        $this->db->where_in('city_id', $destination);
        $this->db->select($fields);
        $query = $this->db->get('holiday_city');
        return $query->result();
    }
            
}


