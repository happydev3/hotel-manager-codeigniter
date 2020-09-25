<?php

class sup_contract extends MY_Model {

    protected $_table_name = 'sup_contract';
    protected $_primary_key = 'contract_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "contract_id desc";
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

     public function get_last_contract_number() {
        $this->db->select('contract_number');
        $this->db->from($this->_table_name);
        $this->db->limit(1);
        $this->db->order_by('contract_number', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->contract_number;
        } else {
            return self::CODE_START;
        }
    }

  function getcontractlist($supplier_id,$contract_number='',$hotel_code='',$status='',$status1='',$from_date='',$to_date='',$created_fromdate='',$created_todate='')
    {
         $this->db->select()->from($this->_table_name);  
         $this->db->where('supplier_id',$supplier_id);
          if($contract_number!=''){
            $where = "contract_number LIKE '%" . $contract_number . "%'";
            $this->db->where($where);      
          }
         if($hotel_code!=''){
            $where = "hotel_code LIKE '%" . $hotel_code . "%'";
            $this->db->where($where); 
        }
                  
        if($status!=''){
           $this->db->where('status',$status);
        }
          if($from_date!=''){
           $this->db->where('end_date >=',date("Y-m-d",strtotime($from_date)));
        }
         if($to_date!=''){
           $this->db->where('end_date <=',date("Y-m-d",strtotime($to_date)));
        }
         if($created_fromdate!=''){
           $this->db->where('created_date >=',date("Y-m-d",strtotime($created_fromdate)));
        }
         if($created_todate!=''){
           $this->db->where('created_date <=',date("Y-m-d",strtotime($created_todate)));
        }
          if($status1!=''){
           $this->db->where('status1',$status1);
        }
        $this->db->order_by('contract_id','desc');
         $query=$this->db->get();
         if ($query->num_rows>0) {
            return $query->result();   
        }
         else  {       
            return '';   
        }
    }

}