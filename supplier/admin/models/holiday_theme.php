<?php

class holiday_theme extends MY_Model {

    protected $_table_name = 'holiday_theme';
    protected $_primary_key = 'theme_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "theme_name asc";

    function __construct() {
        parent :: __construct();
    }

    function insert_theme($array) {
        $error = parent::insert($array);
        return TRUE;
    }
    function get_themes($id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    function get_active_themes() {
        $column = 'status';
        $query = parent::get_active($column, 1);
        return $query;
    }
    function get_single_theme($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }
    function set_theme_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    function update_theme($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
                     
}


