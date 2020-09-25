<?php

class activity_itinerary extends MY_Model {

    protected $_table_name = 'activity_itinerary';
    protected $_primary_key = 'itinerary_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "itinerary_id asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function insert($data) {
        $error = parent::insert($data);
        return $error;
    }
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    function delete_itinerary($id) {
        $this->db->where('package_id', $id);
        $this->db->delete('activity_itinerary');
        return true;
    }
    function delete_itinerary_images($id,$day_count) {
        $this->db->where('package_id', $id);
        $this->db->where('day_count >', $day_count);
        $this->db->delete('activity_itinerary_images');
        return true;
    }
    function get_itinerary($fields=NULL,$id) {
        $this->db->where('package_id', $id);
        $this->db->select($fields);
        $query = $this->db->get('activity_itinerary');
        return $query->result();
    }
    // function get_itinerary($id=NULL, $single=FALSE) {
    //     $fields = 'package_id';
    //     $query = parent::get($id, $single, $fields);
    //     return $query;
    // }
}


