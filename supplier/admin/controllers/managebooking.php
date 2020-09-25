<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class managebooking extends CI_Controller {

    private $supplier_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('supplier_info');
        $this->load->model('sup_hotel_booking');
        $this->load->model('sup_villa_booking');
        $this->load->model('sup_tour_booking');
         // $this->load->model('sup_excursion_booking');
        $this->load->helper(array('form', 'url'));
        // $this->load->library('admin_auth');
        $this->supplier_id = $this->session->userdata('supplier_id');
        $this->is_logged_in();
    }

  private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
  }

  public function hotel_booking() {
    $dataarray=array('supplier_id'=>$this->supplier_id);
    $data['hotel_booking_list'] =$this->sup_hotel_booking->check($dataarray);  
        // echo '<pre>';print_r($data['hotel_booking_list']);exit;
    $data['sub_view'] = 'managebooking/hotel_booking_list';
    $this->load->view('_layout_main',$data);
  }
  
  public function villa_booking() {
    $dataarray=array('supplier_id'=>$this->supplier_id);
    $data['villa_booking_list'] =$this->sup_villa_booking->check($dataarray);  
    $data['sub_view'] = 'managebooking/villa_booking_list';
    $this->load->view('_layout_main',$data);
  }

  public function holiday_booking() {
    $dataarray=array('supplier_id'=>$this->supplier_id);
    $data['tour_booking_list'] =$this->sup_tour_booking->check($dataarray);  
    $data['sub_view'] = 'managebooking/holiday_booking_list';
    $this->load->view('_layout_main',$data);
  }


}
