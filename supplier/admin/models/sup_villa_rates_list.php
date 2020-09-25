<?php

class sup_villa_rates_list extends MY_Model {

    protected $_table_name = 'sup_villa_rates_list';
    protected $_primary_key = 'sup_villa_rates_list_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_villa_rates_list_id desc";

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


     public function get_villarates_edit($supplier_id, $sup_villa_id) {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('sup_villa_id', $sup_villa_id);   
        $this->db->order_by($this->_order_by);        
        $query = $this->db->get();      
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

      public function get_villarate_edit($supplier_id, $id)
      {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('sup_villa_rates_list_id', $id);
        $query = $this->db->get();      
        if ($query->num_rows > 0)
        {
            return $query->row();
        }
       else
         {
            return '';
         }
    }


    function delete_room_rates_list($rowarr)
    {      
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
       $this->db->where('villa_code',$rowarr['villa_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('from_date',$rowarr['from_date']);   
       $this->db->where('to_date',$rowarr['to_date']);   
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rowarr['rate_type']);  
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       if($rowarr['min_adults_without_extra_bed']!='')
        {
           $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
        }
        if($rowarr['max_adults_without_extra_bed']!='')
        {
           $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
        }
        if($rowarr['min_child_without_extra_bed']!='')
        {
           $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        }
        if($rowarr['max_child_without_extra_bed']!='')
        {
           $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        }
        if($rowarr['extra_bed_for_adults']!='')
        {
           $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        }
        if($rowarr['extra_bed_for_child']!='')
        {
           $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']);   
        }       
         $this->db->delete($this->_table_name); 
         
    }

   function delete_room_rates_type_list($rowarr)
    {
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
       $this->db->where('villa_code',$rowarr['villa_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('from_date',$rowarr['from_date']);   
       $this->db->where('to_date',$rowarr['to_date']); 
       $this->db->where('rate_type !=',$rowarr['rate_type']);  
       $this->db->delete($this->_table_name); 
         
    }


      function update_delete_room_rates_list($rowarr)
    {  
       $data=array('status'=>2,'is_deleted'=>1);    
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
       $this->db->where('villa_code',$rowarr['villa_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']);   
       $this->db->where('from_date',$rowarr['from_date']);   
       $this->db->where('to_date',$rowarr['to_date']);   
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('meal_plan',$rowarr['meal_plan']);   
       $this->db->where('rate_type',$rowarr['rate_type']);  
       $this->db->where('min_room_occupancy',$rowarr['min_room_occupancy']);   
       $this->db->where('max_room_occupancy',$rowarr['max_room_occupancy']);   
       if($rowarr['min_adults_without_extra_bed']!='')
        {
           $this->db->where('min_adults_without_extra_bed',$rowarr['min_adults_without_extra_bed']);   
        }
        if($rowarr['max_adults_without_extra_bed']!='')
        {
           $this->db->where('max_adults_without_extra_bed',$rowarr['max_adults_without_extra_bed']);   
        }
        if($rowarr['min_child_without_extra_bed']!='')
        {
           $this->db->where('min_child_without_extra_bed',$rowarr['min_child_without_extra_bed']);   
        }
        if($rowarr['max_child_without_extra_bed']!='')
        {
           $this->db->where('max_child_without_extra_bed',$rowarr['max_child_without_extra_bed']);   
        }
        if($rowarr['extra_bed_for_adults']!='')
        {
           $this->db->where('extra_bed_for_adults',$rowarr['extra_bed_for_adults']);   
        }
        if($rowarr['extra_bed_for_child']!='')
        {
           $this->db->where('extra_bed_for_child',$rowarr['extra_bed_for_child']);   
        }       
         $this->db->update($this->_table_name,$data); 
         
    }


}