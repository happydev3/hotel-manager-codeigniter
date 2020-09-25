<?php

class holiday_packages extends MY_Model {

    protected $_table_name = 'holiday_packages';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id desc";

    function __construct() {
        parent :: __construct();
    }

    function insert_holiday_packages($data) {
        $error = parent::insert($data);
        return $error;
    }
      
    function update($data, $id = NULL) {
        $error = parent::update($data, $id);
        return $error;
    }
    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }

    function get_active($fields=NULL) {
        $column = 'status';
        $query = parent::get_active($column,1,$fields);
        return $query;
    }
    function get_active_supplier($fields=NULL,$supplier_id) {
        $column = 'status';
        $query = parent::get_active_supplier($column, 1,$fields,$supplier_id);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function check_unique($fields, $id) {
        $query = parent::get_unique($id,$fields);
        return $query;
    }

    public function delete_images($img_id,$table_name){
        $this->db->where('holi_image_id', $img_id);
        $this->db->delete($table_name);
        return true;
    }

    public function getTourImages($holiday_list_id){
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id',$holiday_list_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function getTourImagesById($id){
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holi_image_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function deleteTourImages($holiday_list_id) {
        $this->db->where('holiday_list_id', $holiday_list_id);
        $this->db->delete('holiday_images');
        return $this->db->affected_rows();
    }

    public function insertTourImages($data){
        if ($this->db->insert_batch('holiday_images', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_holi_images($holiday_id,$supplier_id){
        
        $this->db->select('*');
        $this->db->from('holiday_images');
        $this->db->where('holiday_list_id', $holiday_id);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->order_by('holi_image_id');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getPackagesNotThisId($holiday_id,$supplier_id){
        $this->db->select('id,package_title,package_code');
        $this->db->from('holiday_packages');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('id !=',$holiday_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function add_block_dates($data) {
        $this->db->insert('holiday_blocking_dates', $data);
        return true;
    }

    public function get_block_list($supplier_id) {
        $this->db->select('d.*');
        
        $this->db->from('holiday_blocking_dates d');
        // $this->db->join('holiday_packages l','l.id = d.holiday_id');
        // $this->db->join('holiday_activity h','h.holiday_id = d.holiday_id');
        $this->db->where('d.supplier_id',$supplier_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function get_block_list_by_id($id,$supplier_id) {
        $this->db->select('*');
        $this->db->from('holiday_blocking_dates');
        $this->db->where('id', $id);
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    function update_block_dates($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('holiday_blocking_dates', $data);
        return true;
    }

    function delete_block_date($id,$supplier_id) {
        $this->db->where('id', $id);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->delete('holiday_blocking_dates');
    }

}


