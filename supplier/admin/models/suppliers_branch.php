<?php

class Suppliers_Branch extends MY_Model {

    protected $_table_name = 'suppliers_branch';
    protected $_primary_key = 'branch_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "supplier_id asc";

    function __construct() {
        parent :: __construct();
    }

    function add($data) {
        $error = parent::insert($data);
        return $error;
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }

    function update($data, $id) {
        parent::update($data, $id);
        return $id;
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }

    function get_timezone() {
        $this->db->select('*');
        $this->db->from('timezone');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_head_office_list()
    {
        $this->db->select('*')
        ->from('suppliers_branch')
        ->where('branch_type',2);
        $query = $this->db->get();

        if($query->num_rows > 0 )
        {
            return $query->result();
        }

        return false;
    }
    public function get_branch_office_list()
    {
        $this->db->select('*')
        ->from('suppliers_branch')
        ->where('branch_type',1);
        $query = $this->db->get();

        if($query->num_rows > 0 )
        {
            return $query->result();
        }

        return false;
    }

}


