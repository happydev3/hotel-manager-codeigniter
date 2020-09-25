<?php

class ace_jac_roomsxml_gta_city extends MY_Model {

    protected $_table_name = 'ace_jac_roomsxml_gta_city';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "city_name asc";

    function __construct() {
        parent :: __construct();
    }

  function get($fields=NULL, $id=NULL, $signal=FALSE) {
        $query = parent::get($id, $signal,$fields);
        return $query;
    }

     public function get_hotel_city_list($search) { 
        $where = "city_name LIKE '%" . $search . "%' OR country_name LIKE '%" . $search . "%'";
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where($where);
        $this->db->where('status', 1);
        $this->db->order_by('city_name');
        $this->db->limit('10');
        $query = $this->db->get();
//echo $this->db->last_query();exit;
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

        public function get_all_city_list($search) {
        $where = "city_name LIKE '%" . $search . "%'";
        $this->db->select('*');
        $this->db->from('ace_jac_roomsxml_gta_city');
        $this->db->where($where);
        //   $this->db->where('status',1);
        $this->db->order_by('city_name');
        $this->db->limit(10);
        $query = $this->db->get();
//echo $this->db->last_query();exit;
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
                     
}