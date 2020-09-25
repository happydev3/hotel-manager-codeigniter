<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	private $from;
	private $head;
	private $weburl;
	
	public function __construct() {
		parent::__construct();
		$this->head = 'Vacaymenow';
		$this->weburl = 'www.vacaymenow.com';
		$this->from = 'booking@vacaymenow.com';
	}

	public function send($to, $subject, $message) {
		$this->email->from($this->from, $this->head);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function send_attach($to, $subject, $message, $path) {
		$this->load->library('email');

		$this->email->from($this->from, $this->head);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach($path);
		$this->email->send();
	}

	public function supplier_registration_email($data_email) {
		$msgbody = '<p>Your registration on Vacaymenow was completed successfully.</p>
		<div>Login Details :
		<p>UserName : ' . $data_email['supplier_email'] . '</p>
		</div>
		<div><p>Your Account will be activated within 24 hours.</p></div>		
		<div><p>Please do not hesitate to contact us on '.$this->adminEmails().' for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>Thanking you,</div>
		<div>' . $this->head . '</div>';
		$subject = 'Partner Registration';
		$this->send($data_email['supplier_email'],$subject,$msgbody);
		sleep(2);
		$this->send($this->adminEmails(),$subject,$msgbody);
	}

	public function supplier_activation_email($info) {
		$msgbody = 'Dear, ' . ucfirst($info['first_name']) . '<br><br>
		<p>Your Partner account with Vacaymenow has been activated.</p>
		<div>Login Details :
		<p>UserName : ' . $info['supplier_email'] . '</p>
		</div>
		<div>Please Reset you password from here <a href="' . site_url() . 'supplier/change_user_password/' . $info['supplier_id'] . '/' . $info['activation_key'] . '">click here</a></div>	
		<div><p>Please do not hesitate to contact us on '.$this->adminEmails().' for all your Urgent Queries / Reservation or Requirements.</p></div>
		<div>Thanking you,</div>
		<div>' . $this->head . '</div>';
		$subject = 'Partner Activation';
		$this->send($data_email['supplier_email'],$subject,$msgbody);
		sleep(2);
		$this->send($this->adminEmails(),$subject,$msgbody);
	}

	private function adminEmails() {
		$q = $this->db->select('email')
			->get('admin');
		
		return array_map(function ($u) {
			return $u['email'];
		}, $q->result_array());
	}


}