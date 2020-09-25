<?php

class sup_hotel_room_supplement_rates_list extends MY_Model {

    protected $_table_name = 'sup_hotel_room_supplement_rates_list';
    protected $_primary_key = 'sup_hotel_room_supplement_rates_list_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_hotel_room_supplement_rates_list_id desc";

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
        $this->db->order_by($this->_order_by);
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

      function delete($id) {
        $error = parent::delete($id);
        return $error;
    }


       function update_delete_room_supplement_rates_list($rowarr)
    {    
        $data=array('status'=>2,'is_deleted'=>1); 
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']); 
       $this->db->where('from_date',$rowarr['from_date']);   
       $this->db->where('to_date',$rowarr['to_date']);  
       $this->db->where('meal_plan',$rowarr['meal_plan']);
       $this->db->where('supplement_meal_plan',$rowarr['supplement_meal_plan']);   
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);
      
       $this->db->where('supplement_roomrate_type_id',$rowarr['supplement_roomrate_type_id']);   
       $this->db->where('supplement_roomrate_type',$rowarr['supplement_roomrate_type']);
     
       $this->db->update($this->_table_name,$data);         
    }
}