<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Payment extends MX_Controller {

  private $sess_id;
  private $pay_id;
  private $payment_gateway;
  private $secret_key = '';
  private $publishable_key = '';

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Payment_Model');
    $this->sess_id = $this->session->userdata('session_id');

    // $this->secret_key = "sk_test_3ZhoCiF3pdW5CBDhnpJCvGsG";
    // $this->publishable_key = "pk_test_iAH41GROAKolcgQlxHd4qZ71";
    $this->secret_key = 'sk_live_PLBQzUVUlkwEfJ6aG7C2rMyp';
    $this->publishable_key = 'pk_live_jlNtH1Imu4aohott2xCkaRvk';
  }

  public function index() {
    // echo $this->secret_key;exit;
    $pass_info=$this->session->userdata('passenger_info');
    $search_details=$this->session->userdata('search_details');
    // echo '<pre>';print_r($this->session->all_userdata());exit;
    if(empty($search_details['uniqueRefNo'])) {
      $msg = 'Session expired';
      redirect('payment/error_page/'.base64_encode($msg),'refresh');
    }

    $ip=$_SERVER['REMOTE_ADDR'];
    $payinsert= array(
      'uniqueRefNo' => $search_details['uniqueRefNo'],
      'paid_amount' => $search_details['cost'],
      'passenger_name' => $pass_info['GuestFirstName'].$pass_info['GuestLastName'],
      'passenger_email' => $pass_info['GuestEmailID'],
      'passenger_mobile' => $pass_info['GuestMobileNo'],
      'service_type' => $search_details['service_type'],
      'IP' => $ip,
      'TransactionDate'=> date('Y-m-d'),
    );
    // echo '<pre>';print_r($payinsert);exit;
    if(!empty($payinsert)){
      $payinsert_id = $this->Payment_Model->pay_details($payinsert);
      $dataup = array(
        'payment_gateway'=>1,
        'payment_start'=> date('Y-m-d G:i:s')
      );
      $this->updatelogdata($dataup);
    }
    // $data['secret_key'] = $this->secret_key;
    $data['publishable_key'] = $this->publishable_key;
    $this->load->view('payment/payment_load', $data);
    // exit;
  }

  public function payment_return(){
    // echo '<pre>';print_r($_POST);exit();
    $search_details = $this->session->userdata('search_details');
    $msg = 'Your reservation request was cancelled. Don’t worry we have not charged you anything';
    if(!empty($search_details)) {
      require APPPATH.'libraries/stripe2/lib/Stripe.php';
      // require_once(APPPATH.'libraries/Stripe/init.php');
      $error = '';
      $success = '';
      if ($_POST) {
        \Stripe\Stripe::setApiKey($this->secret_key);
        $token  = $_POST['stripeToken'];
        $source  = $_POST['stripeToken'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        // $state = $_POST['state'];
        $postal_code = $_POST['postal_code'];
        $country = $_POST['country'];

        try {
          if (empty($_POST['address']) || empty($_POST['city']) || empty($_POST['postal_code']))
            throw new Exception("Fill out all required fields.");
          if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");

          // $respJsonRS =  \Stripe\Charge::create([
          //   "amount" => round($search_details['cost']*100),
          //   "currency" => "usd",
          //   "source"   => $_POST['stripeToken'], // obtained with Stripe.js
          //   "description" => $_POST['email']
          // ]);
          $respJsonRS = $this->firstCard($this->secret_key,$email,$token,$source,$search_details);
          // echo '<pre>';print_r($respJsonRS);exit();
          if(!empty($respJsonRS)) {
            if($respJsonRS['amount_refunded'] == 0 && empty($respJsonRS['failure_code']) && $respJsonRS['paid'] == 1 && $respJsonRS['captured'] == 1) {

              $ChargeID = $respJsonRS['id'];
              $Amount = $respJsonRS['amount']/100; //converted to dollar
              $TransactionID = $respJsonRS['balance_transaction'];
              $CustomerID = $respJsonRS['customer'];
              $Description = $respJsonRS['description'];
              $RespondCode = $respJsonRS['paid'];
              $Message = $respJsonRS['outcome']['seller_message'];
              $outcome = serialize($respJsonRS['outcome']);

              $source = $respJsonRS['source'];
              $SourceID = $source['id'];
              $client_secret = $source['client_secret'];
              $PaymentType = $source['type'];
              $owner = serialize($source['owner']);
              $card = serialize($source['card']);

              $uniqueRefNo = $respJsonRS['metadata']['order_id'];
              $status = $respJsonRS['status'];
              $ResponseDescription = $respJsonRS['statement_descriptor'];

              $data = array(
                'ChargeID'=>$ChargeID,
                'amount'=>$Amount,
                'TransactionID'=>$TransactionID,
                'CustomerID'=>$CustomerID,
                'Description'=>$Description,
                'RespondCode'=>$RespondCode,
                'Message'=>$Message,
                'outcome'=>$outcome,
                'SourceID'=>$SourceID,
                'client_secret'=>$client_secret,
                'PaymentType'=>$PaymentType,
                'owner'=>$owner,
                'card'=>$card,
                'uniqueRefNo'=>$uniqueRefNo,
                'status'=>$status,
                'ResponseDescription'=>$ResponseDescription,
                'TransactionDate'=> Date('Y-m-d'),
                'api'=> $search_details['callBackId'],
              );
              // echo '<pre>';print_r($data);exit();
              $this->Payment_Model->update_pay_details($uniqueRefNo,$data);
            } else {
              redirect('payment/error_page/'.base64_encode($msg),'refresh');
            }
          } else {
            redirect('payment/error_page/'.base64_encode($msg),'refresh');
          }
          // echo '<div class="alert alert-success"><strong>Success!</strong> Your payment was successful.</div>';
          echo '<div style="margin-top: 100px;text-align: center;"><p>Please do not refresh... We are processing your request.</p>';
          echo '<img src="'.get_image_aws('public/img/load_circle.GIF').'"></div>';
          $url='<meta http-equiv="refresh" content="10;url='.site_url().'payment/payment_return_new" />';
          echo $url;
        }
        catch (Exception $e) {
          // echo '<div class="alert alert-danger"><strong>Error!</strong> '.$e->getMessage().'</div>';
          redirect('payment/error_page/'.base64_encode($msg),'refresh');
        }
      } else {
         // echo 'edrfgh';
        redirect('payment/error_page/'.base64_encode($msg),'refresh');
      }
    } else {
      redirect('payment/error_page/'.base64_encode($msg),'refresh');
    }
  }

  public function payment_returnold(){
    $search_details = $this->session->userdata('search_details');
    if(!empty($search_details)) {
      // echo '<pre>';print_r($_POST);exit();
      if(!empty($_POST['stripeToken'])) {
        //get token, card and user info from the form
        $token  = $_POST['stripeToken'];
        $source  = $_POST['stripeSource'];
        // $name = $_POST['name'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        // $state = $_POST['state'];
        $postal_code = $_POST['postal_code'];
        $country = $_POST['country'];
        // $country_code = $_POST['country_code'];
        // $stripeToken = $_POST['stripeToken'];
        // $card_num = $_POST['card_num'];
        // $card_cvc = $_POST['cvc'];
        // $card_exp_month = $_POST['exp_month'];
        // $card_exp_year = $_POST['exp_year'];
        
        // include Stripe PHP library
        require_once(APPPATH.'libraries/Stripe/init.php');
        //set api key
        $stripe = array(
          "secret_key"      => $this->secret_key,
          "publishable_key" => $this->publishable_key
        );
        $msg = 'Your reservation request was cancelled. Don’t worry we have not charged you anything';
        // call the function to create charges
        $respJsonRS = $this->firstCard($stripe['secret_key'],$email,$token,$source,$search_details);
        echo '<pre>';print_r($respJsonRS);exit();
        if(!empty($respJsonRS)) {
          if($respJsonRS['amount_refunded'] == 0 && empty($respJsonRS['failure_code']) && $respJsonRS['paid'] == 1 && $respJsonRS['captured'] == 1) {

            $ChargeID = $respJsonRS['id'];
            $Amount = $respJsonRS['amount']/100; //converted to dollar
            $TransactionID = $respJsonRS['balance_transaction'];
            $CustomerID = $respJsonRS['customer'];
            $Description = $respJsonRS['description'];
            $RespondCode = $respJsonRS['paid'];
            $Message = $respJsonRS['outcome']['seller_message'];
            $outcome = serialize($respJsonRS['outcome']);

            $source = $respJsonRS['source'];
            $SourceID = $source['id'];
            $client_secret = $source['client_secret'];
            $PaymentType = $source['type'];
            $owner = serialize($source['owner']);
            $card = serialize($source['card']);

            $uniqueRefNo = $respJsonRS['metadata']['order_id'];
            $status = $respJsonRS['status'];
            $ResponseDescription = $respJsonRS['statement_descriptor'];

            $data = array(
              'ChargeID'=>$ChargeID,
              'amount'=>$Amount,
              'TransactionID'=>$TransactionID,
              'CustomerID'=>$CustomerID,
              'Description'=>$Description,
              'RespondCode'=>$RespondCode,
              'Message'=>$Message,
              'outcome'=>$outcome,
              'SourceID'=>$SourceID,
              'client_secret'=>$client_secret,
              'PaymentType'=>$PaymentType,
              'owner'=>$owner,
              'card'=>$card,
              'uniqueRefNo'=>$uniqueRefNo,
              'status'=>$status,
              'ResponseDescription'=>$ResponseDescription,
              'TransactionDate'=> Date('Y-m-d'),
              'api'=> $search_details['callBackId'],
            );
            $this->Payment_Model->update_pay_details($uniqueRefNo,$data);
            // echo $this->db->last_query();
            // echo '<pre>';print_r($data);exit;
            echo '<div style="margin-top: 100px;text-align: center;"><p>Please do not refresh... We are processing your request.</p>';
            echo '<img src="'.get_image_aws('public/img/load_circle.GIF').'"></div>';
            $url='<meta http-equiv="refresh" content="10;url='.site_url().'payment/payment_return_new" />';
            echo $url;
          } else {
            redirect('payment/error_page/'.base64_encode($msg),'refresh');
          }
        } else {
          redirect('payment/error_page/'.base64_encode($msg),'refresh');
        }
      } else {
        redirect('payment/error_page/'.base64_encode($msg),'refresh');
      }
    } else {
      redirect('payment/error_page/'.base64_encode($msg),'refresh');
    }

  }

  public function payment_return_new() {
    
    $search_details=$this->session->userdata('search_details');
    // echo '<pre>';print_r($search_details);exit;
    $uniqueRefNo = $search_details['uniqueRefNo'];
    $service_type = $search_details['service_type'];
    
    if($service_type == 6) {
      $searchId = '';
      $sessionId = '';
      $api = '';
    } else {
      $searchId = $search_details['searchId'];
      $sessionId = $search_details['sessionId'];
      $api = $search_details['callBackId'];
    }

    $trans_detail = $this->Payment_Model->get_pay_details($uniqueRefNo);
    // echo '<pre>';print_r($trans_detail);exit;

    $dataup = array('payment_end'=> date('Y-m-d G:i:s'));
    $this->updatelogdata($dataup);
    
    if($trans_detail->RespondCode == 1) {
      if($service_type == 1) {
        // echo 1;exit;
        $hotelCode = $search_details['hotelCode'];
        $this->load->module('hotels/' . $api);
        $this->$api->hotel_reservation($sessionId, $hotelCode, $searchId,$uniqueRefNo);
      } else if($service_type == 6) {
        // echo 6;exit;
        $this->load->module('holiday');
        $this->holiday->booking_voucher();
      } else if($service_type == 9) {
        // echo 6;exit;
        $villaCode = $search_details['villaCode'];
        $this->load->module('villa/' . $api);
        // $this->villa->booking_voucher();
        $this->$api->villa_reservation($sessionId,$villaCode,$searchId,$uniqueRefNo);
      }
    } else {
        $msg='Your reservation request was cancelled. Don’t worry we have not charged you anything';
        redirect('payment/error_page/'.base64_encode($msg),'refresh');
    }
  }

  function error_page($error) {
    $data['error'] = $error;
    $this->load->view('error_page', $data);
  }

  public function updatelogdata($data){ 
      $search_details = $this->session->userdata('search_details');
      $uni = $search_details['uniqueRefNo'];
      $this->db->where('unique_ref_no',$uni);
      $this->db->update('user_logger',$data);
  }

  public function firstCard($secret_key,$email,$token,$source,$search_details) {
    \Stripe\Stripe::setApiKey("$secret_key");

    // Create a Customer:
    $customer = \Stripe\Customer::create([
      'source' => $token,
      'email' => $email,
    ]);
    //retrieve customer details
    $customerJson = $customer->jsonSerialize();
    // echo '<pre>';print_r($customerJson);exit();
    $customerID = $customerJson['id'];
    
    //item information
    $itemName = $search_details['desc'];
    // $itemNumber = $search_details["PS123456"];
    $itemPrice = round($search_details['cost']*100); //price in cents
    $currency = "usd";
    $orderID = $search_details['uniqueRefNo'];
    
    //charge a credit or a debit card
    $charge = \Stripe\Charge::create(array(
      // 'customer' => $customerID,
      'amount'   => $itemPrice,
      'currency' => $currency,
      'description' => $itemName,
      'statement_descriptor' => 'VACAYMENOW',
      // 'source' => $token,
      // "capture" => false,
      'metadata' => array('order_id' => $orderID),
      'customer' => $customerID,
      // 'receipt_email' => $email,
      // 'source'  => $source
    ));
    //retrieve charge details
    $respJsonRS = $charge->jsonSerialize();
    // echo '<pre>';print_r($respJsonRS);exit();
    return $respJsonRS;
  }

  public function savedCards($secret_key,$customer_id,$search_details){
    \Stripe\Stripe::setApiKey("$secret_key");

    //item information
    $itemName = $search_details['desc'];
    // $itemNumber = $search_details["PS123456"];
    $itemPrice = round($search_details['cost']*100); //price in cents
    $currency = "usd";
    $orderID = $search_details['uniqueRefNo'];

    // When it's time to charge the customer again, retrieve the customer ID.
    $charge = \Stripe\Charge::create([
      'amount' => $itemPrice, // 1500, $15.00 this time
      'currency' => $currency,
      'description' => $itemName,
      'statement_descriptor' => 'VACAYMENOW',
      'metadata' => array('order_id' => $orderID),
      'customer' => $customer_id, // Previously stored, then retrieved
      // 'receipt_email' => 'akgupta.nit@gmail.com'
    ]);

    //retrieve charge details
    $respJsonRS = $charge->jsonSerialize();
    // echo '<pre>';print_r($chargeJson);exit();
    return $respJsonRS;
  }


}
