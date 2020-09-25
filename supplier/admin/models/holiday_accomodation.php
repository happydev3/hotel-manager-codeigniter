<?php

class holiday_accomodation extends MY_Model {

    protected $_table_name = 'holiday_accomodation';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id DESC";

    function __construct() {
        parent :: __construct();
    }

    function insert($array) {
        $insert_id = parent::insert($array);
        return $insert_id;
    }

    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    function get($id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    function get_active() {
        $column = 'status';
        $query = parent::get_active($column, 1);
        return $query;
    }
    function get_only_supplier($fields=NULL,$supplier_id, $id=NULL,$single=FALSE) {
        $query = parent::get_supplier($id, $single, $fields,$supplier_id);
        return $query;
    }
    function get_active_supplier($fields=NULL,$supplier_id) {
        $column = 'status';
        $query = parent::get_active_supplier($column, 1,$fields,$supplier_id);
        return $query;
    }
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
                     
}


