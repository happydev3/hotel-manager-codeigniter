<?php

class sup_villa_rates extends MY_Model {

    protected $_table_name = 'sup_villa_rates';
    protected $_primary_key = 'sup_villa_rates_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "sup_villa_rates_id Desc";

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
   
    function get_single($id, $signal=TRUE) {
        $query = parent::get($id, $signal);
        return $query;
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

    function check_room_allot($supplier_id,$villa_avail_date,$villa_code) {
        $this->db->select('s.*,v.price_type');
        $this->db->from('sup_villa_rates s');
        $this->db->join('villa_list v','s.villa_code = v.property_code');
        // $this->db->join('villa_blocking_dates b','s.villa_code = b.villa_id');
        $this->db->where('s.villa_code',$villa_code);
        $this->db->where('s.sup_villa_id',$supplier_id);
        $this->db->where('s.villa_avail_date',$villa_avail_date);
        $this->db->where('s.villas_available',1);
        $this->db->where('s.supplier_id',$supplier_id);
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

    function get_block_list($villa_code,$villa_avail_date) {
        $this->db->select('*');
        $this->db->from('villa_blocking_dates');
        $this->db->where('villa_id',$villa_code);

        $date = date('d/m/Y', strtotime($villa_avail_date));
        // $this->db->FIND_IN_SET($villa_avail_date,'from_date');
        $where = "FIND_IN_SET('".$date."', from_date)";  
        $this->db->where( $where ); 

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

    function get_price_type($villa_code) {
        $this->db->select('sup_villa_rates.*,villa_list.price_type');
        $this->db->from($this->_table_name);
        $this->db->join('villa_list','sup_villa_rates.villa_code = villa_list.property_code');
        $this->db->where('sup_villa_rates.villa_code',$villa_code);
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

public function new_cal_get_villarates_by_date($supplier_id,$villa_id, $villa_code,$from_date='',$to_date='') {
        $this->db->select('*');
        $this->db->from('sup_villa_rates');   
        $this->db->where('sup_villa_id', $villa_id);
        $this->db->where('villa_code', $villa_code);

        if($from_date!=''){
            $this->db->where('villa_avail_date >=', date('Y-m-d',strtotime($from_date)));
         }
        if($to_date !=''){
          $this->db->where('villa_avail_date <=', date('Y-m-d',strtotime($to_date)));          
        }
        $this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

public function get_villarates($sup_villa_rates_id,$villa_code,$supplier_id){
    $this->db->select('*');
    $this->db->from('sup_villa_rates');
    $this->db->where('sup_villa_rates_id',$sup_villa_rates_id);
    $this->db->where('villa_code',$villa_code);
    $this->db->where('supplier_id',$supplier_id);
   $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

 public function get_villarates_edit($sup_villa_id,$sup_villa_rates_list_id,$sup_villa_rates_id, $villa_code,$supplier_id){
     $this->db->select('*');
    $this->db->from('sup_villa_rates');
    $this->db->where('sup_villa_rates_id',$sup_villa_rates_id);
    $this->db->where('sup_villa_rates_list_id',$sup_villa_rates_list_id);
    $this->db->where('villa_code',$villa_code);
    $this->db->where('sup_villa_id',$sup_villa_id);
    $this->db->where('supplier_id',$supplier_id);
    $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

public function get_villarates_update($villa_id,$sup_villa_rates_list_id,$sup_villa_rates_id, $villa_code,$supplier_id,$data){
    $this->db->where('sup_villa_rates_id',$sup_villa_rates_id);
    $this->db->where('sup_villa_rates_list_id',$sup_villa_rates_list_id);
    $this->db->where('villa_code',$villa_code);
    $this->db->where('sup_villa_id',$villa_id);
    $this->db->where('supplier_id',$supplier_id); 
    $this->db->update('sup_villa_rates',$data);
}
 
 function update_villa_allotment($supplier_id,$villa_id,$villa_code,$villa_avail_date,$updatadata) 
 {   
    $this->db->where('villa_code',$villa_code);
    $this->db->where('sup_villa_id',$villa_id);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('villa_avail_date',$villa_avail_date); 

    $this->db->update('sup_villa_rates',$updatadata);
    // echo  $this->db->last_query();exit;

 }

   
    function delete_villa_rates($rowarr) {
      $this->db->where('supplier_id',$rowarr['supplier_id']);
      $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);
      $this->db->where('villa_code',$rowarr['villa_code']);
      $this->db->where('villa_avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');
      $this->db->where('rate_type',$rowarr['rate_type']);
      $this->db->where('min_villa_occupancy',$rowarr['min_villa_occupancy']);
      $this->db->where('max_villa_occupancy',$rowarr['max_villa_occupancy']);
      $this->db->delete($this->_table_name);
    }

    public function get_villarates_by_date($villa_id, $startdate, $enddate) {
        $this->db->select('*');
        $this->db->from('sup_villa_rates');
        $this->db->where('sup_villa_id', $villa_id);
        $this->db->where('villa_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_villaallotment_by_date($villa_id,$villa_code,$startdate, $enddate) {
        $this->db->select('*');
        $this->db->from('sup_villa_rates');
        $this->db->where('sup_villa_id', $villa_id);
        $this->db->where('villa_code', $villa_code);
       $this->db->where('villa_avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function delete_villa_rates_type($rowarr) {
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_villa_id',$rowarr['sup_villa_id']);   
       $this->db->where('villa_code',$rowarr['villa_code']);     
       $this->db->where('villa_avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');
      $this->db->delete($this->_table_name); 
    }

    function update_set_status($data,$id) {
        $this->db->where('sup_villa_rates_list_id',$id);
        $this->db->update($this->_table_name,$data); 
    }

}