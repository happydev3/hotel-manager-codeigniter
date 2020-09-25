<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
  
class Fblogin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
      public function insert_login_activity() {        
        $user_no = $this->session->userdata('user_no');
        $session_id = $this->session->session_id;
        $ip_address = $this->input->ip_address();     
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'user_no' => $user_no,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,            
        );

       $this->db->insert('user_login_history', $data);
      }

      public function addb2cuser($data)
      {
          $this->db->set('created_at', 'NOW()', FALSE);
          $this->db->insert('user_info', $data);
          $id = $this->db->insert_id();   
          if(!empty($id)) 
          {          
            $user_no = 'AI' . $id . rand(1000, 9999);
            $data1 = array('user_no' => $user_no);
            $this->db->where('id', $id);
            $this->db->update('user_info', $data1);
            return $user_no;
          }
          else
          {           
             return '';
          }
    
 	 }
  public function validateuser($email)
  {
  	 $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        else
            return '';          
  }
}
