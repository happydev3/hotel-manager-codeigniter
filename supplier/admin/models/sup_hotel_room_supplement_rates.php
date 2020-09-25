<?php

class sup_hotel_room_supplement_rates extends MY_Model {

    protected $_table_name = 'sup_hotel_room_supplement_rates';
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

 
    

 public function check_supplement_data($supplier_id,$hotel_id,$hotel_code,$sup_room_details_id,$room_code,$contract_id,$meal_plan,$market,$avail_date)
 {
     $this->db->select('*');
    $this->db->from('sup_hotel_room_supplement_rates');
        $this->db->where('avail_date',$avail_date);      
        $this->db->where('sup_room_details_id', $sup_room_details_id);      
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->where('hotel_code', $hotel_code);
        $this->db->where('room_code', $room_code);
        $this->db->where('contract_id', $contract_id);        
        $this->db->where('market', $market);
        $this->db->where('meal_plan', $meal_plan);     
        $this->db->where('supplier_id', $supplier_id);
        $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }      
 }



   
      function delete_room_supplement_rates($rowarr)
    {      
       $this->db->where('supplier_id',$rowarr['supplier_id']);
       $this->db->where('sup_hotel_id',$rowarr['sup_hotel_id']);   
       $this->db->where('hotel_code',$rowarr['hotel_code']);   
       $this->db->where('room_code',$rowarr['room_code']);   
       $this->db->where('contract_id',$rowarr['contract_id']); 
       $this->db->where('meal_plan',$rowarr['meal_plan']);
       $this->db->where('supplement_meal_plan',$rowarr['supplement_meal_plan']);   
       $this->db->where('market',$rowarr['market']);   
       $this->db->where('sup_room_details_id',$rowarr['sup_room_details_id']); 
       $this->db->where('avail_date BETWEEN "' . $rowarr['from_date'] . '" and "' . $rowarr['to_date'] . '"');      
       $this->db->where('supplement_roomrate_type_id',$rowarr['supplement_roomrate_type_id']);   
       $this->db->where('supplement_roomrate_type',$rowarr['supplement_roomrate_type']);
       /*
       $this->db->where('supplement_child_min_age',$rowarr['supplement_child_min_age']);
       $this->db->where('supplement_child_max_age',$rowarr['supplement_child_max_age']);
       */
       $this->db->delete($this->_table_name);         
    }


   
         public function get_roomrates_by_date($room_id, $startdate, $enddate,$contract_id,$supplement_roomrate_type_id="") {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_supplement_rates');
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('contract_id', $contract_id);  
        if($supplement_roomrate_type_id!=''){
        $this->db->where('supplement_roomrate_type_id', $supplement_roomrate_type_id);   
        }     
              
        $this->db->where('avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


         public function get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate,$contract_id,$supplement_roomrate_type_id='') {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_supplement_rates');
        $this->db->where('sup_room_details_id', $room_id);
        $this->db->where('hotel_code', $hotel_code);
        
        if($supplement_roomrate_type_id!='')
        {
        $this->db->where('supplement_roomrate_type_id', $supplement_roomrate_type_id);
        }             
        $this->db->where('contract_id', $contract_id);        
        $this->db->where('avail_date BETWEEN "' . $startdate . '" and "' . $enddate . '"');
        $this->db->where('supplier_id',$this->session->userdata('supplier_id'));
        $query = $this->db->get();
        // echo $this->db->last_query($query); exit;
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function new_cal_get_roomrates_by_date($supplier_id,$hotel_id, $hotel_code, $room_id,$room_code,$contract_id='',$supplement_roomrate_type_id='',$supplement_meal_plan='',$market='',$from_date='',$to_date='') {
        $this->db->select('*');
        $this->db->from('sup_hotel_room_supplement_rates');
        $this->db->where('sup_room_details_id', $room_id);        
        $this->db->where('sup_hotel_id', $hotel_id);        
        $this->db->where('hotel_code', $hotel_code);        
        $this->db->where('room_code', $room_code);  
        if($contract_id!='')
        {
           $this->db->where('contract_id', $contract_id);    
        }  
      
        if($supplement_roomrate_type_id!='')
        {
           $this->db->where('supplement_roomrate_type_id', $supplement_roomrate_type_id);    
        }   
         if($supplement_meal_plan!='')
        {
           $this->db->where('supplement_meal_plan', $supplement_meal_plan);    
        }
         if($market!='')
        {
           $this->db->where('market', $market);    
        }
        if($from_date!=''){
            $this->db->where('avail_date >=', date('Y-m-d',strtotime($from_date)));
         }
        if($to_date !=''){
                $this->db->where('avail_date <=', date('Y-m-d',strtotime($to_date)));          
        }
        $this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function get_roomrates($id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$supplement_roomrate_type_id){
     $this->db->select('*');
        $this->db->from('sup_hotel_room_supplement_rates');
    $this->db->where('id',$id);
    $this->db->where('room_code',$room_code);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('supplement_roomrate_type_id',$supplement_roomrate_type_id);
  
 $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }

   public function checksupplementother($supplier_id,$hotel_id,$hotel_code,$sup_room_details_id,$room_code,$contract_id,$meal_plan)
 {
       $this->db->select('*');
       $this->db->from('sup_hotel_room_supplement_rates');         
        $this->db->where('sup_room_details_id', $sup_room_details_id);      
        $this->db->where('sup_hotel_id', $hotel_id);
        $this->db->where('hotel_code', $hotel_code);
        $this->db->where('room_code', $room_code);
        $this->db->where('contract_id', $contract_id);     
        $this->db->where_in('meal_plan', $meal_plan);     
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('supplement_roomrate_type', "other");
        $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        } 
    }

    public function get_roomrates_edit($hotel_id,$id,$room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$supplement_roomrate_type_id,$supplement_roomrate_type){
     $this->db->select('*');
    $this->db->from('sup_hotel_room_supplement_rates');
    $this->db->where('id',$id);   
    $this->db->where('room_code',$room_code);
    $this->db->where('sup_hotel_id',$hotel_id);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('supplement_roomrate_type_id',$supplement_roomrate_type_id);
   $this->db->where('supplement_roomrate_type',$supplement_roomrate_type);  
    $query=$this->db->get();
         if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }     
    }  

    public function get_roomrates_update($hotel_id,$id,$room_code, $hotel_code,$supplier_id,$sup_room_details_id,$contract_id,$supplement_roomrate_type_id,$supplement_roomrate_type,$data)
    {
     $this->db->where('id',$id);   
    $this->db->where('room_code',$room_code);
    $this->db->where('sup_hotel_id',$hotel_id);
    $this->db->where('hotel_code',$hotel_code);
    $this->db->where('supplier_id',$supplier_id);
    $this->db->where('sup_room_details_id',$sup_room_details_id);
    $this->db->where('contract_id',$contract_id);
    $this->db->where('supplement_roomrate_type_id',$supplement_roomrate_type_id);
    $this->db->where('supplement_roomrate_type',$supplement_roomrate_type);
    $this->db->update('sup_hotel_room_supplement_rates',$data);
    }

    function update_set_status($data,$id)
    {
        $this->db->where('sup_hotel_room_supplement_rates_list_id',$id);
        $this->db->update($this->_table_name,$data); 
    }  


}