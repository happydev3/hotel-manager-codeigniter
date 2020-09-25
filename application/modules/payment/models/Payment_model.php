<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Payment_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_pay_tran_id($refno){
        $this->db->select('*');
        $this->db->from('pay_details');
        $this->db->where('uniqueRefNo',$refno);
        $query=$this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }else{
            return false;
        }
        
    }
    
    public function get_pay_details($unique_ref){
        $this->db->select('*');
        $this->db->from('pay_details');
        $this->db->where('uniqueRefNo',$unique_ref);
        
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        }  else {
            return '';
        }
        
    }

    function get_agent_available_balance($agent_no,$agent_type) {
       if ($agent_type == 1) {
        $this->db->select('available_balance')
        ->from('agent_acc_summary')
        ->where('agent_no', $agent_no)
        ->order_by('transaction_datetime', 'DESC')
        ->limit('1');
    }
    if ($agent_type == 2) {
        $this->db->select('available_balance')
        ->from('b2b2b_acc_summary')
        ->where('agent_no', $agent_no)
        ->order_by('transaction_datetime', 'DESC')
        ->limit('1');
    }

    $query = $this->db->get();



    if ($query->num_rows > 0) {

        $res = $query->result();

        $balance = $res[0]->available_balance;
    } else {

        $balance = 0;
    }



    return $balance;
}

public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total, $BOOKING_REFERENCE_NO,$agent_type,$tran_desc) {

    $disc_tran = $tran_desc;

    $data['status'] = 'Accepted';

    $data['available_balance'] = $total;

    $data['agent_no'] = $agent_no;

    $data['transaction_summary'] = $disc_tran;

    $data['agent_id'] = $agent_id;

    $data['withdraw_amount'] = $withdraw_amount;

    $this->db->set('approve_date', 'NOW()', FALSE);

    $this->db->set('transaction_datetime', 'NOW()', FALSE);

    if ($agent_type == 1) {
        $this->db->insert('agent_acc_summary', $data);
    } elseif ($agent_type == 2) {
        $this->db->insert('b2b2b_acc_summary', $data);
    }
}
public function pay_details($payinsert) {
    $this->db->insert('pay_details', $payinsert);
    $insert_id = $this->db->insert_id();
    return $insert_id;
}

public function update_pay_details($ref, $data) {
    $this->db->where('uniqueRefNo', $ref);
    if ($this->db->update('pay_details', $data)) {
        return true;
    } else {
        return false;
    }
}

public function get_converted_price($from, $to, $amount) {

    $this->db->select('value as from_val');

    $this->db->from('currency');

    $this->db->where('currency_code', $from);

    $this->db->limit('1');

    $query = $this->db->get();



    if ($query->num_rows > 0) {

        $res = $query->row();

        $from_curr = $res->from_val;
    } else {

        $from_curr = 0;
    }



    $this->db->select('value as to_val');

    $this->db->from('currency');

    $this->db->where('currency_code', $to);

    $this->db->limit('1');

    $query1 = $this->db->get();



    if ($query1->num_rows > 0) {

        $res1 = $query1->row();

        $to_curr = $res1->to_val;
    } else {

        $to_curr = 0;
    }



    $currency_val = ($to_curr / $from_curr) * $amount;



    return $currency_val;
}

}

?>
