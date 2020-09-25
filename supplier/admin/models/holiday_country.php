<?php

class holiday_country extends MY_Model {

    protected $_table_name = 'holiday_country';
    protected $_primary_key = 'country_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "country_name asc";

    function __construct() {
        parent :: __construct();
    }

    function insert($array) {
        $error = parent::insert($array);
        return TRUE;
    }
    function get($id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal);
        return $query;
    }
   
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }

    function get_single_name($id) {
        $this->db->where('country_id', $id);
        $this->db->select('country_name');
        $query = $this->db->get('holiday_country');
        $result = $query->row();
        return $result->country_name;
    }
    
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
                     
}


