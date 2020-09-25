<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validate_credentials($loginEmailId, $loginPassword) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('supplier_email', $loginEmailId)
                // ->where('supplier_password', md5($loginPassword))
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function insert_login_activity() {
        $supplier_id = $this->session->userdata('supplier_id');
        $session_id = $this->session->userdata('session_id');
        $ip_address = $this->session->userdata('ip_address');
        //$user_agent = $this->session->userdata('user_agent');
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        $data = array('session_id' => $session_id,
            'supplier_id' => $supplier_id,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,
        );
        if ($this->db->insert('supplier_login_histroy', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_supplier_info($supplier_id) {
        $this->db->select('*')
                ->from('supplier_info')
                ->where('supplier_id', $supplier_id)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function update_supplier_profile($supplier_id, $username, $sup_name, $first_name, $last_name, $mobile_no, $address, $pin_code, $city, $state) {
        $data = array(
            'supplier_email' => $username,
            'supplier_name' => $sup_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
        );

        $where = "supplier_id = '$supplier_id'";
        if ($this->db->update('supplier_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_sup_password($supplier_id, $password = '') {
        if (!empty($password)) {
            $data['login_password'] = $password;
            $where = "supplier_id = '$supplier_id'";
            if ($this->db->update('supplier_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function manage_currency_status($currency_id, $status) {
        $data['status'] = $status;
        $where = "currency_id = '$currency_id'";
        if ($this->db->update('currency', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    
     public function get_all_city_list($search) {
        $where = "city_name LIKE '%" . $search . "%'";
        $this->db->select('*');
        $this->db->from('jamaican_city_list');
        $this->db->where($where);
        //   $this->db->where('status',1);
        $this->db->order_by('city_name');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

   

}
