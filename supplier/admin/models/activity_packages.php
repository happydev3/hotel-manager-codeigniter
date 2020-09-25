<?php

class activity_packages extends MY_Model {

    protected $_table_name = 'activity_packages';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id desc";

    function __construct() {
        parent :: __construct();
    }

    function insert_activity_packages($data) {
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



}


