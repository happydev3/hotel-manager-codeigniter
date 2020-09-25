<?php

class transportation_mode extends MY_Model {

    protected $_table_name = 'transportation_mode';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "day_count asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function get_transportation_mode($id) {
        $this->db->where('package_id', $id);
        $this->db->select('*');
        $this->db->order_by('day_count');
        $query = $this->db->get('transportation_mode');
        return $query->result();
    }

    function get_city_covering($id) {
        $this->db->where('package_id', $id);
        $this->db->select('location_from,location_to');
        $this->db->group_by('location_from');
        $this->db->group_by('location_to');
        $this->db->order_by('day_count');
        $query = $this->db->get('transportation_mode');
        return $query->result();
    }


    function add_transportation_mode($data) {
        $error = parent::insert($data);
        return $error;
    }
    function delete_transportation_mode($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('transportation_mode');
        return true;
    }
    function update_transportation_mode($id) {
        $data['check_update'] = 1;
        $where = "package_id = '$id'";
        if ($this->db->update('transportation_mode', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    function transportation_mode() {
        
    }
}


