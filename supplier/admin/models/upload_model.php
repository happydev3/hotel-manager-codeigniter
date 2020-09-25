<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_Model extends CI_Model {

    public function __construct() {
      parent::__construct();
    }

    public function upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$file_name,$day_count=NULL,$supplier_id,$active_day=NULL){
        if($upload_type == 'update'){
            $data=array(
                $column_name => $file_name,
            );
            $this->db->where($unique_id, $id);
            $this->db->update($table_name, $data);
            return true;
        } else if($upload_type == 'edit' || $upload_type == 'insert') {
            if(!empty($day_count)){
                if(!empty($active_day)){
                    $data=array(
                        $unique_id => $id,
                        $column_name => $file_name,
                        'day_count' => $day_count,
                        'supplier_id' => $supplier_id,
                        'active_day' => $active_day,
                    );
                } else {
                    $data=array(
                        $unique_id => $id,
                        $column_name => $file_name,
                        'day_count' => $day_count,
                        'supplier_id' => $supplier_id,
                    );
                }
            } else{
                $data=array(
                    $unique_id => $id,
                    $column_name => $file_name,
                    'supplier_id' => $supplier_id,
                );
            }
            $this->db->insert($table_name, $data);
            return true;
        } else {
            $data = array(
                $unique_id => $id,
                $column_name => $file_name,
                'supplier_id' => $supplier_id,
            );
            $this->db->insert($table_name, $data);
            return true;
        }
    }
    public function custom_upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$file_name,$supplier_id=NULL){
        if($upload_type == 'custom_update'){
            $data = array(
                $column_name => $file_name,
            );
            $this->db->where($unique_id, $id);
            $this->db->where('supplier_id', $supplier_id);
            $this->db->update($table_name, $data);
            return true;
        } else{
            $data = array(
                $unique_id => $id,
                $column_name => $file_name,
                'supplier_id' => $supplier_id,
            );
            $this->db->insert($table_name, $data);
            return true;
        }
    }
    public function delete_first($id,$unique_id,$table_name,$day_count=NULL,$active_day=NULL){
        $this->db->where($unique_id, $id);
        if(!empty($day_count)){
            $this->db->where('day_count',$day_count);
        }
        if(!empty($active_day)){
            $this->db->where('active_day',$active_day);
        }
        $this->db->delete($table_name);
        return true;
    }

    public function get_images($id,$table_name,$column_name,$column_id,$supplier_id){
        $this->db->where($column_id, $id);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function delete_images($img_id,$table_name){
        $this->db->where('id', $img_id);
        $this->db->delete($table_name);
        return true;
    }

    public function delete_images_spec($img_id,$table_name){
        $this->db->where('id', $img_id);
        $this->db->delete($table_name);
        return true;
    }
    function delete_count_images($id,$day_count,$table_name) {
        $this->db->where('package_id', $id);
        $this->db->where('day_count >', $day_count);
        $this->db->delete($table_name);
        return true;
    }

    public function get_supplier_hotel_images($id,$table_name,$column_name){
        $this->db->where('supplier_hotel_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_villa_images($id,$table_name,$column_name){
        $this->db->where('villa_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function supplier_room_images($id,$table_name,$column_name){
        $this->db->where('supplier_room_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

      public function supplier_meeting_room_images($id,$table_name,$column_name){
        $this->db->where('supplier_meeting_room_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

      public function supplier_dining_images($id,$table_name,$column_name){
        $this->db->where('supplier_dining_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function supplier_experience_images($id,$table_name,$column_name){
        $this->db->where('supplier_experience_list_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

      public function supplier_hotel_images($id,$table_name,$column_name){
        $this->db->where('sup_hotel_id', $id);
        $this->db->select($column_name);
        $this->db->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    
}

