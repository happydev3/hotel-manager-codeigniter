<?php

class holiday_continent extends MY_Model {

    protected $_table_name = 'holiday_continent';
    protected $_primary_key = 'continent_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "continent_name asc";

    function __construct() {
        parent :: __construct();
    }

    function insert($array) {
        $error = parent::insert($array);
        return TRUE;
    }
    function get($id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal);
        return $query;
    }
   
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
                     
}


