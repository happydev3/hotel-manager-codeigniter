<?php

class Role_Manager extends MY_Model {

    protected $_table_name = 'role_manager';
    protected $_primary_key = 'role_id';
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
    function get_roles_list($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    
}


