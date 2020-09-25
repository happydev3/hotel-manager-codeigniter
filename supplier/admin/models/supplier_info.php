<?php

class supplier_info extends MY_Model {

    protected $_table_name = 'supplier_info';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id asc";

    function __construct() {
        parent :: __construct();
    }

    function get($id=NULL,$fields=NULL,$single=TRUE) {
        $query = parent::get($id, $single);
        return $query;
    }
    function get_spec($id=NULL,$fields=NULL,$single=TRUE) {
        $query = parent::get($id, $single, $fields);
        return $query;
    }
    function update($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
            
}


