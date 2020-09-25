<?php

class supplier_meeting_room_list extends MY_Model {

    protected $_table_name = 'supplier_meeting_room_list';
    protected $_primary_key = 'supplier_meeting_room_list_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "meeting_room_name asc";
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
        $this->db->select('*')->from($this->_table_name)->where($array);
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

    function getmeeting_roomlist($supplier_id,$property_code='',$meeting_room_name='')
    {
         $this->db->select()->from($this->_table_name);  
         $this->db->where('supplier_id',$supplier_id);
          if($property_code!=''){
            $where = "property_code LIKE '%" . $property_code . "%'";
            $this->db->where($where);      
          }
         if($meeting_room_name!=''){
            $where = "meeting_room_name LIKE '%" . $meeting_room_name . "%'";
            $this->db->where($where); 
        }
         $query=$this->db->get();
         if ($query->num_rows>0) {
            return $query->result();
        }
         else  {       
            return '';   
        }
    }


       public function get_last_meeting_room_code() {
        $this->db->select('meeting_room_code');
        $this->db->from($this->_table_name);
        $this->db->limit(1);
        $this->db->order_by('meeting_room_code', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->meeting_room_code;
        } else {
            return self::CODE_START;
        }
    }



}