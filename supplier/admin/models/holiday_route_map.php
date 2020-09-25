<?php

class holiday_route_map extends MY_Model {

    protected $_table_name = 'holiday_route_map';
    protected $_primary_key = 'route_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "transport_day asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function get_route_map($id) {
        $this->db->where('package_id', $id);
        $this->db->select('*');
        $this->db->order_by('transport_day');
        $query = $this->db->get('holiday_route_map');
        return $query->result();
    }

    function groupby_route_map($id) {
        $this->db->where('package_id', $id);
        $this->db->select('*');
        // $this->db->group_by('to_location');
        $this->db->group_by('from_location');
        $this->db->order_by('transport_day');
        $query = $this->db->get('holiday_route_map');
        return $query->result();
    }

    function add_route_map($data) {
        $inserts = parent::insert($data);
        return $inserts;
    }

    function delete_route_map($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('holiday_route_map');
        return true;
    }

}


