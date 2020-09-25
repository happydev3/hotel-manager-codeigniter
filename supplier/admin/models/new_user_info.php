<?php

class New_User_Info extends MY_Model {

    protected $_table_name = 'new_user_info';
    protected $_primary_key = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "first_name asc";

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

    function update($data, $user_id=NULL) {
        parent::update($data, $user_id);
        return $user_id;
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    
}


