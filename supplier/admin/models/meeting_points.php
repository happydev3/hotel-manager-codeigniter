<?php

class meeting_points extends MY_Model {

    protected $_table_name = 'meeting_points';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function get_meeting_points($id) {
        $this->db->where('holiday_id', $id);
        $this->db->select('*');
        $this->db->order_by('id');
        $query = $this->db->get('meeting_points');
        return $query->result();
    }

    function add_meeting_points($data) {
        $inserts = parent::insert($data);
        return $inserts;
    }

    function delete_meeting_points($id) {
        $this->db->where('holiday_id', $id);
        $this->db->delete('meeting_points');
        return true;
    }

}


