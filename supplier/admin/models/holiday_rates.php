<?php

class holiday_rates extends MY_Model {

    protected $_table_name = 'holiday_rates';
    protected $_primary_key = 'rate_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "package_id asc";

    function __construct() {
        parent :: __construct();
    }

    function insert($data) {
        $error = parent::insert($data);
        return $error;
    }
    function insert_in_packages($data) {
        if ($this->db->insert('holiday_rates_packages', $data)) {
            return true;
        } else {
            return false;
        }
    }
    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function get_rates($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->select('*');
        // $this->db->group_by('validity');
        $this->db->from('holiday_rates');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_rates_pack($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->select('*');
        $this->db->from('holiday_rates_packages');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    function get_economy_rates($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->where('accomodation_type', 'Economy');
        $this->db->select('*');
        $this->db->from('holiday_rates');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    function get_superior_rates($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->where('accomodation_type', 'Superior');
        $this->db->select('*');
        $this->db->from('holiday_rates');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    function get_first_class_rates($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->where('accomodation_type', 'First class');
        $this->db->select('*');
        $this->db->from('holiday_rates');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    function get_luxury_rates($package_id=NULL) {
        if(!empty($package_id)){
            $this->db->where('package_id', $package_id);
        }
        $this->db->where('accomodation_type', 'luxury');
        $this->db->select('*');
        $this->db->from('holiday_rates');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    function delete($id, $acc_type=NULL) {
        // $this->db->where('accomodation_type', $acc_type);
        $this->db->where('package_id', $id);
        $this->db->delete('holiday_rates');
        return true;
    }
    function delete_in_packages($id, $acc_type=NULL) {
        // $this->db->where('accomodation_type', $acc_type);
        $this->db->where('package_id', $id);
        $this->db->delete('holiday_rates_packages');
        return true;
    }
}


