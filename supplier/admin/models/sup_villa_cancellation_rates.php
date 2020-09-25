<?php

class sup_villa_cancellation_rates extends MY_Model {

    protected $_table_name = 'sup_villa_cancellation_rates';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id desc";

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

      function delete($id) {
        $error = parent::delete($id);
        return $error;
    }
    

 public function check_cancellation_data($supplier_id,$villa_id,$villa_code,$villa_avail_date)
 {
    $this->db->select('*');
    $this->db->from('sup_villa_cancellation_rates');
    $this->db->where('villa_avail_date',$villa_avail_date);          
    $this->db->where('sup_villa_id', $villa_id);
    $this->db->where('villa_code', $villa_code);    
    $this->db->where('supplier_id', $supplier_id);
    $query=$this->db->get();
     if ($query->num_rows > 0) {
        return $query->row();
    } else {
        return '';
    }      
 }

   function delete_villa_cancellation_data($supplier_id,$villa_id,$villa_code,$villa_avail_date,$sup_villa_rates_list_id) {

        $this->db->where('sup_villa_rates_list_id',$sup_villa_rates_list_id);  
        $this->db->where('villa_avail_date',$villa_avail_date);      
        $this->db->where('sup_villa_details_id', $sup_villa_details_id);      
        $this->db->where('sup_villa_id', $villa_id);
        $this->db->where('villa_code', $villa_code);    
        $this->db->where('supplier_id', $supplier_id);       
        $this->db->delete('sup_villa_cancellation_rates');
    }

   
    function delete_villa_cancellation_rates($rowarr) {      
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
       $this->db->where('villa_code',$rowarr['villa_code']);     
       $this->db->where('villa_avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');    
       $this->db->delete($this->_table_name);         
    }

  


}