<?php

class currency extends MY_Model {

    protected $_table_name = 'currency';
    protected $_primary_key = 'currency_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "currency_code asc";

    function __construct() {
        parent :: __construct();
    }

    function get($fields=NULL, $id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal,$fields);
        return $query;
    }
                     
}


