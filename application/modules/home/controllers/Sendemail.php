<?php

//	error_reporting(E_ALL);
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Sendemail extends MX_Controller 
{	
	private $from;
	private $head;
	private $weburl;
	
	public function __construct() {
		parent::__construct();
		$this->head = 'Vacaymenow';
		$this->weburl = 'www.vacaymenow.com';
		// $this->from = 'hello@vacaymenow.com';
		$this->from = 'booking@vacaymenow.com';
	}

	public function send($to, $subject, $message) {
		$this->email->from($this->from, $this->head);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function ticketing_mail($data, $voucher_content) {
		$msgbody = $voucher_content;
		$subject = 'Thank You for Booking With Us!';
		$this->send($data['user_email'],$subject,$msgbody);
		// $supplier_mail = $this->getSupplierEmail($data['supplier_id']);
		if($data['reservation_email'] !='') {
			sleep(2);
			$this->send($data['reservation_email'], $subject, $msgbody);
		}
		sleep(2);
		$this->send($this->adminEmails(), $subject, $msgbody);
	}

	public function getSupplierEmail($supplier_id){
		$this->load->model('Home_Model');
		$supplier_mail = $this->Home_Model->get_supplier_email($supplier_id);

		return $supplier_mail;
	}

	public function send_enquiry($data) {
		$subject = $data["subject"];    
		$msgbody = 'Dear Admin,<br>
		One of your customer has requested for <b>'.$data["subject"].'</b>, below are the details: <br>
		<table width="100%" border="1" cellspacing="5" cellpadding="5" style="text-align: left;border-collapse:collapse">
			<tr>
				<td width="30%"><strong>Package Reference</strong></td>
				<td>'.$data["uniqueRefNo"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Name</strong></td>
				<td>'.$data["user_name"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email</strong></td>
				<td>'.$data["user_email"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Mobile</strong></td>
				<td>'.$data["user_mobile"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Package Details</strong></td>
				<td>'.$data["package_details"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Subject</strong></td>
				<td>'.$data["subject"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Comments</strong></td>
				<td>'.$data["user_message"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Email Subscription</strong></td>
				<td>'.$data["email_subscription"].'</td>
			</tr>
			<tr>
				<td width="30%"><strong>Request Date</strong></td>
				<td>'.$data["request_date"].'</td>
			</tr>
		</table>';
		// echo $msgbody;exit;
		// $this->send($data['user_email'],$subject,$msgbody);
		// sleep(2);
		$this->send($this->adminEmails(),$subject,$msgbody);
	}

	public function send_subscription($data) {
		$subject = $data["subject"];    
		$msgbody = 'Thank you for subscribing! Look out for special offers soon.';
		// echo $msgbody;exit;
		$this->send($data['email'],$subject,$msgbody);
		// sleep(2);
		// $this->send($this->adminEmails(),$subject,$msgbody);
	}

	public function emailtest(){
		$this->send($this->adminEmails(), 'Vacaymenow: Please Confirm Subscription', 'This is just another test to admin emails.');
	}

	private function adminEmails() {
		$q = $this->db->select('email')
			->get('admin');
		
		return array_map(function ($u) {
			return $u['email'];
		}, $q->result_array());
	}
}	