<?php

class country extends MY_Model {

    protected $_table_name = 'country';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "name asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL, $id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal,$fields);
        return $query;
    }
      function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }
  
            
}
