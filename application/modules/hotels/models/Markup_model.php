<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Markup_Model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_admin_markup($nationality,$api) {
        $admin_markup_process = 1;
        $country = 'India';
        /*$this->db->select('name');
        $this->db->from('country');
        $this->db->where('iso2', $nationality);
        $this->db->limit('1');
        $query = $this->db->get();
        $res = $query->row();
        $country = $res->name;*/

        $this->db->select('markup,markup_process');
        $this->db->from('b2c_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('country', $country);
        $this->db->where('service_type', 1);
        $this->db->where('api_name', $api);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $res1 = $query1->row();
            $admin_markup_val = $res1->markup;
            $admin_markup_process = $res1->markup_process;          
        } else {
            $this->db->select('markup,markup_process');
            $this->db->from('b2c_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', $api);
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();
            if ($query2->num_rows() > 0) {
                $res2 = $query2->row();
                $admin_markup_val = $res2->markup;
                $admin_markup_process = $res2->markup_process;
            } else {
                $admin_markup_val = 0;
            }
        }
        return array($admin_markup_val,$admin_markup_process);
    }

}