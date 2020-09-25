<?php

class Bank_Details extends MY_Model {

    protected $_table_name = 'bank_details';
    protected $_primary_key = 'bank_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "supplier_id asc";

    function __construct() {
        parent :: __construct();
    }

    function add($data) {
        $insert_id = parent::insert($data);
        return $insert_id;
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

    public function upload_docs($id,$file_name){
        $data = array(
            'upload_docs' => $file_name,
        );
        $this->db->where('bank_id', $id);
        $this->db->update('bank_details', $data);
        return true;
    }

}