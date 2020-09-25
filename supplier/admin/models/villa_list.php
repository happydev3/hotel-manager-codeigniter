<?php

class villa_list extends MY_Model {

  protected $_table_name = 'villa_list';
  protected $_primary_key = 'id';
  protected $_primary_filter = 'intval';
  protected $_order_by = "property_name asc";
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
    if($query->num_rows > 0) {
      return $query->result();
    } else {
      return '';
    }
  }

  function get_single($id, $signal=TRUE) {
    $query = parent::get($id, $signal);
    return $query;
  }

  function getVillaList($supplier_id) {
   $this->db->select()->from($this->_table_name);  
   $this->db->where('supplier_id',$supplier_id);
   $query=$this->db->get();
   if ($query->num_rows>0) {
    return $query->result();
  }
  else  {       
    return '';   
  }
}


public function get_last_property_code() {
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

    public function getVillaImages($villa_id){
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('villa_id',$villa_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function getVillaImagesById($id){
        $this->db->select('*');
        $this->db->from('villa_images');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function deleteVillaImages($villa_id) {
        $this->db->where('villa_id', $villa_id);
        $this->db->delete('villa_images');
        return $this->db->affected_rows();
    }

    public function insertVillaImages($data){
        if ($this->db->insert_batch('villa_images', $data)) {
            return true;
        } else {
            return false;
        }
    }



}