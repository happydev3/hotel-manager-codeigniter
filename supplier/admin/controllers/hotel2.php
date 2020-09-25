<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class hotel extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('hotel_model');
    // $this->load->model('home_model');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    // $this->load->library('admin_auth');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}
public function calendar() {
    $data['sub_view'] = 'hotel/calendar';
    $this->load->view('_layout_main',$data);
}
public function hotel_list() {
    $data['hotel'] = $hotel = $this->hotel_model->get_only_supplier('*',$this->supplier_id);
    $data['sub_view'] = 'hotel/hotel_list';
    $this->load->view('_layout_main',$data);
}
public function add_hotel() {
    $data['sub_view'] = 'hotel/add_hotel';
    $this->load->view('_layout_main',$data);
}

public function save_step1($check_insert) {
    // echo '<pre>11';print_r($_POST);exit;
    $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
    $this->form_validation->set_rules('hotel_code', 'Hotel ID', 'trim|required');
    // $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => validation_errors(),
            'insert_id' => $check_insert
        ));
    } else {
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'hotel_name' =>$this->input->post('hotel_name'),
            'hotel_code' =>$this->input->post('hotel_code'),
            // 'hotel_type' =>$this->input->post('hotel_type'),
            'room_count' =>$this->input->post('room_count'),
            'star_rating' =>$this->input->post('star_rating'),
            'hotel_address' =>$this->input->post('hotel_address'),
            'hotel_area' =>$this->input->post('hotel_area'),
            'hotel_city' =>$this->input->post('hotel_city'),
            'hotel_state' =>$this->input->post('hotel_state'),
            'hotel_pin' =>$this->input->post('hotel_pin'),
        );
        // $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            $insert_id = $this->hotel_model->insert($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $this->hotel_model->update($data, $check_insert);
            echo json_encode(array('insert_id' => $check_insert));
        }
        
    }
}

public function save_step2($check_insert) {
    // echo '<pre>';print_r($_POST);exit;
    $this->session->set_flashdata('message','Hotel is added successfully!');
    echo json_encode(array('insert_id' => $check_insert));
}

public function quick_add() {
    $data['sub_view'] = 'hotel/quick_add';
    $this->load->view('_layout_main',$data);
}
public function set_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->hotel_model->set_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Active</b>';
    } else {
        $msg = '<b style="color:#607d8b">inactive</b>';
    }
    $this->session->set_flashdata('message','Hotel is now '.$msg);
    redirect('hotel/hotel_list', 'refresh'); 
}

public function edit_hotel() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];

    $data['hotel_info'] = $this->hotel_model->get('*',$hotel_id);

    $data['sub_view'] = 'hotel/edit_hotel';
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    // $this->load->model('Upload_Model');
    // $data['thumb_img'] = $this->holiday_packages->get('thumb_img',$hotel_id);
    // $data['gallery_img'] = $this->Upload_Model->get_images($hotel_id);
    $data['sub_view'] = 'hotel/edit_step2';
    $this->load->view('_layout_main',$data);
}

public function update_all() {
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $hotel_id = $this->input->post('insert_id');
    if($step_no == 1){
        $this->update_step1($hotel_id);
    } else{
        $this->update_step2($hotel_id);
    }
}

public function update_step1($hotel_id){
    // echo '<pre>11';print_r($_POST);exit;
    $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
    $this->form_validation->set_rules('hotel_code', 'Hotel ID', 'trim|required');
    $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'hotel/edit_hotel';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'hotel_name' =>$this->input->post('hotel_name'),
            'hotel_code' =>$this->input->post('hotel_code'),
            'hotel_type' =>$this->input->post('hotel_type'),
            'room_count' =>$this->input->post('room_count'),
            'star_rating' =>$this->input->post('star_rating'),
            'hotel_address' =>$this->input->post('hotel_address'),
            'hotel_area' =>$this->input->post('hotel_area'),
            'hotel_city' =>$this->input->post('hotel_city'),
            'hotel_state' =>$this->input->post('hotel_state'),
            'hotel_pin' =>$this->input->post('hotel_pin'),
        );
        $this->hotel_model->update($data, $hotel_id);
        $this->session->set_flashdata('message','Hotel Updated Successfully!');
        redirect('hotel/edit_hotel?id='.$hotel_id, 'refresh'); 
    }
}

public function update_step2($hotel_id){
    $this->session->set_flashdata('message','Hotel Updated Successfully!');
    redirect('holiday/edit_step9?id='.$hotel_id, 'refresh');
}

public function add_rooms() {
    $data['sub_view'] = 'hotel/add_rooms';
    $this->load->view('_layout_main',$data);
}







}

