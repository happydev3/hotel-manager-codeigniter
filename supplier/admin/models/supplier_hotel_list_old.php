<?php

class supplier_hotel_list extends MY_Model {

    protected $_table_name = 'supplier_hotel_list';
    protected $_primary_key = 'supplier_hotel_list_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "hotel_name asc";
    const CODE_START = '0000100000';

    function __construct() {
        parent :: __construct();
    }

    function insert($data) {
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
    function set_status($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }


    function check($array=NULL) {
        $this->db->select()->from($this->_table_name)->where($array);
        $query = $this->db->get();
          if($query->num_rows > 0)
        {
        return $query->result();
       }
       else
       {
        return '';
       }
    }

     function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
    }

     function gethotellist($supplier_id,$hotel_code='',$hotel_name='',$hotel_city='',$hotel_country='',$hotel_star_rating='',$hotel_property_type)
    {
         $this->db->select()->from($this->_table_name);  
         $this->db->where('supplier_id',$supplier_id);
          if($hotel_code!=''){
            $where = "hotel_code LIKE '%" . $hotel_code . "%'";
            $this->db->where($where);      
          }
         if($hotel_name!=''){
            $where = "hotel_name LIKE '%" . $hotel_name . "%'";
            $this->db->where($where); 
        }
          if($hotel_city!=''){
            $where = "hotel_city LIKE '%" . $hotel_city . "%'";
            $this->db->where($where); 
          }   
           if($hotel_country!=''){
            $where = "hotel_country LIKE '%" . $hotel_country . "%'";
            $this->db->where($where); 
          }             
        if($hotel_star_rating!=''){
           $this->db->where('hotel_star_rating',$hotel_star_rating);
        }
          if($hotel_property_type!=''){
           $this->db->where('hotel_property_type',$hotel_property_type);
        }
         $query=$this->db->get();
         if ($query->num_rows>0) {
            return $query->result();
        }
         else  {       
            return '';   
        }
    }


      public function get_last_hotel_code() {
        $this->db->select('property_code');
        $this->db->from($this->_table_name);
        $this->db->limit(1);
        $this->db->order_by('property_code', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->property_code;
        } else {
            return self::CODE_START;
        }
    }



}