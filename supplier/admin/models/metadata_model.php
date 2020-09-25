<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metadata_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function set_status($data, $id = NULL, $table_name=NULL,$where=NULL) {
        if ($this->db->update($table_name, $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function set_delete($table_name,$where) {
        if ($this->db->delete($table_name, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_closed_reasons() {
        $this->db->select('*');
        $this->db->from('closed_reason_metadata');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_closed_reasons_byid($id) {
        $this->db->select('*');
        $this->db->from('closed_reason_metadata');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function add_update_reasons($data,$reason_id='') {
        if(!empty($reason_id)){
            $where = "id = '$reason_id'";
            $submit = $this->db->update('closed_reason_metadata', $data, $where);
        } else{
            $submit = $this->db->insert('closed_reason_metadata', $data);
        }
        return true;
    }

    public function get_transport_metadata() {
        $this->db->select('*');
        $this->db->from('transport_metadata');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_transport_metadata_byid($id) {
        $this->db->select('*');
        $this->db->from('transport_metadata');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function add_update_transport_metadata($data,$update_id='') {
        if(!empty($update_id)){
            $where = "id = '$update_id'";
            $submit = $this->db->update('transport_metadata', $data, $where);
        } else{
            $submit = $this->db->insert('transport_metadata', $data);
        }
        return true;
    }

    

}
