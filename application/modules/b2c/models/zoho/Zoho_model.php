<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zoho_model extends CI_Model{

    function __construct() 
    {
        parent::__construct();
    }    

    public function updateZohodata($user_no,$dataUpdate)
    {

        $this->db->where('user_no', $user_no);
        $this->db->update('user_info', $dataUpdate);
    }

    public function updateBookingZohodata($report_id,$uniqueRefNo,$dataUpdate)
    {

        $this->db->where('report_id', $report_id);
        $this->db->where('uniqueRefNo', $uniqueRefNo);
        $this->db->update('hotel_booking_reports', $dataUpdate);
    }

  
}
