<?php

class closed_reason_metadata extends MY_Model {

    protected $_table_name = 'closed_reason_metadata';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "closed_reason asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL,$id=NULL,$single=FALSE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function insert($array) {
        $error = parent::insert($array);
        return TRUE;
    }
}


