<?php

class holiday_city extends MY_Model {

    protected $_table_name = 'holi_city';
    protected $_primary_key = 'city_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "city_name asc";

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
    
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

      function check($array=NULL)
    {
        $this->db->select()->from($this->_table_name)->where($array);
            $query = $this->db->get();
            return $query->result();
    }

    
                     
}


