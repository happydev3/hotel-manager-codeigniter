<?php

class holiday_attraction extends MY_Model {

    protected $_table_name = 'holiday_attraction';
    protected $_primary_key = 'attraction_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "attraction_name asc";

    function __construct() {
        parent :: __construct();
    }

    function add_holiday_attraction($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_attraction($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('holiday_attraction');
        return true;
    }
    function get_attraction($fields=NULL,$id) {
        $this->db->where('package_id', $id);
        $this->db->select($fields);
        $query = $this->db->get('holiday_attraction');
        return $query->result();
    }
}


