<?php

class sightseeing_activity extends MY_Model {

    protected $_table_name = 'sightseeing_activity';
    protected $_primary_key = 'activity_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "activity_name asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function add_sightseeing_activity($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_activity($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('sightseeing_activity');
        return true;
    }
    function get_activity($fields=NULL,$id) {
        $this->db->where('package_id', $id);
        $this->db->select($fields);
        $query = $this->db->get('sightseeing_activity');
        return $query->result();
    }
}


