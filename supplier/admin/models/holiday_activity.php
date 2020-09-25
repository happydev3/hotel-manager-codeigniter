<?php

class holiday_activity extends MY_Model {

    protected $_table_name = 'holiday_activity';
    protected $_primary_key = 'activity_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "activity_title asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function add_holiday_activity($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_activity($id) {
        $this->db->where('holiday_id', $id);
        $this->db->delete('holiday_activity');
        return true;
    }
    function get_activity($fields=NULL,$id) {
        $this->db->where('holiday_id', $id);
        $this->db->select($fields);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('holiday_activity');
        return $query->result();
    }
}


