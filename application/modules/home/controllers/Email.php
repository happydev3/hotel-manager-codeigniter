<?php

//	error_reporting(E_ALL);
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Sendemail extends MX_Controller {
	
	private $from;
	private $to;
	private $subject;
	private $message;
	private $head;
	private $weburl;
	private $config;
	private $prasanna, $abhishek;
	private $footer;
	
	public function __construct() {
		parent::__construct();
		$this->prasanna = 'prasanna@travelpd.com';
		$this->abhishek = 'abhishek@travelpd.com';
		$this->query='';
		$this->footer='';
		$this->special_msg='';       
		$this->head = 'Vacaymenow';
		$this->weburl = 'www.vacaymenow.com';
	
		$this->from = 'it@tpdtechnosoft.com';
		$this->config = Array(
        'protocol' => 'telnet',
        'smtp_host' => 'mail.tpdtechnosoft.com',
        'smtp_port' => '25',
        'smtp_user' => 'it@tpdtechnosoft.com',
        'smtp_pass' => 'travelpd@2015',
        'mailtype' => 'html',
        'starttls' => true,
        'newline' => "\r\n"
		); 
	}

	public function send($to, $subject, $message) {
		$this->load->library('email');

		$this->email->from($this->from, $this->head);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function ticketing_mail($data, $voucher_content) {
		$msgbody = $voucher_content;
		$subject = 'Thank You for Booking With Us!';
		// echo $msgbody;exit;
		$this->send($data['user_email'],$subject,$msgbody);
		sleep(1);
		$subject = 'Hotel Booking - '.$data['uniqueRefNo'];
		$this->send($data['reservation_email'],$subject,$msgbody);
		// sleep(2);
		// $this->send('akgupta.nit@gmail.com',$subject,$msgbody);
	}

	public function send_enquiry($data) {  
		$subject = 'Enquiry';      
		$msgbody= '<div> Name : '.$data["user_name"].'<br/>
		email : '.$data["user_email"].'<br/>
		Booking Reference : '.$data["bookingref"].'<br/>
		Subject : '.$data["subject"].'<br/>
		Comments : '.$data["comments"].'<br/></div>';  
		$this->send('abhishek@travelpd.com,prasanna@travelpd.com', $subject, $msgbody);     
	}

	public function emailtest(){
		$this->send('abhishek@travelpd.com', 'Vacaymenow: Please Confirm Subscription', 'tesfdf');
		$this->send('akgupta.nit@gmail.com', 'Vacaymenow: Please Confirm Subscription', 'tesfdf');
	}

}	