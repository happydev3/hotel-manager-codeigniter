<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class facility_type extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('glb_hotel_facilities_type');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
  }
  private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
      redirect('login/supplier_login');
    }
  }
  public function add_facilitytype(){
    $this->form_validation->set_rules('facility', 'Facility', 'trim|required');
    $facility_type = $this->input->post('facility_type');
    $fac_loc = 'room_amenities';
    if($facility_type == 'room'){
      $fac_loc = 'room_amenities';
    } else if($facility_type == 'hotel'){
      $fac_loc = 'hotel_amenities';
    }if($facility_type == 'villa'){
      $fac_loc = 'villa_amenities';
    }
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('facility_type/'.$fac_loc);
    }
    else if($this->check_multiple()){
      $errors_msg='Facility and Facility Type both value are already exist in Table Row.........';
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('facility_type/'.$fac_loc);
    }else{
      $insertarray=array(
        'facility'=>ucwords($this->input->post('facility')),
        'facility_type'=>$this->input->post('facility_type'),
        'supplier_id'=>$this->supplier_id, 
        'date_time' => date('Y-m-d H:i:s'),
        'status' => 1,
      );
      $id = $this->glb_hotel_facilities_type->insert($insertarray);
      if(!empty($id)) {
        $this->session->set_flashdata('message','Facility Successfully Created!');
        redirect('facility_type/'.$fac_loc);
      } else {
        $errors_msg= 'Facility Not Created. Please try after some time...';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('facility_type/'.$fac_loc);
      }
    }
  }
  public function check_multiple() {
    $dataarray=array(
      'facility'=>ucwords($this->input->post('facility')),
      'facility_type'=>$this->input->post('facility_type'),
      // 'supplier_id'=>$this->supplier_id,
    );
    $check_multiple = $this->glb_hotel_facilities_type->check($dataarray);
    if($check_multiple!='') {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function facilitytype() {
    $data['error']='';
    $data['action']='add_facilitytype';
    $data['button']='Add facilitytype';
    $data['sub_view'] = 'facilitytype/list';
    $data['facilitytype'] = $this->glb_hotel_facilities_type->get();
    $this->load->view('_layout_main',$data);
  }
  public function room_amenities() {
    $data['error']='';
    $data['action']='add_facilitytype';
    $data['button']='Add facilitytype';
    $data['sub_view'] = 'facilitytype/room_amenities';
    $data['facilitytype'] = $this->glb_hotel_facilities_type->check(array('facility_type'=>'room'));
    $this->load->view('_layout_main',$data);
  }
  public function hotel_amenities() {
    $data['error']='';
    $data['action']='add_facilitytype';
    $data['button']='Add facilitytype';
    $data['sub_view'] = 'facilitytype/hotel_amenities';
    $data['facilitytype'] = $this->glb_hotel_facilities_type->check(array('facility_type'=>'hotel'));
    $this->load->view('_layout_main',$data);
  }
  public function villa_amenities() {
    $data['error']='';
    $data['action']='add_facilitytype';
    $data['button']='Add facilitytype';
    $data['sub_view'] = 'facilitytype/villa_amenities';
    $data['facilitytype'] = $this->glb_hotel_facilities_type->check(array('facility_type'=>'villa'));
    $this->load->view('_layout_main',$data);
  }
  public function set_facility_type_status($facility_type='') {
    $fac_loc = 'room_amenities';
    if($facility_type == 'room'){
      $fac_loc = 'room_amenities';
    } else if($facility_type == 'hotel'){
      $fac_loc = 'hotel_amenities';
    }if($facility_type == 'villa'){
      $fac_loc = 'villa_amenities';
    }
    if($_POST['id']==''||$_POST['status']=='') {
      redirect('facility_type/'.$fac_loc);
    }
    $message='';
    if($_POST['status'] == 0) { $message='Inactive'; }
    else if($_POST['status'] == 1) { $message='Active';}
    else if($_POST['status'] == 2) {  $message='Blocked';}
    $data = array('status' =>$_POST['status']);
    $this->glb_hotel_facilities_type->update($data, $_POST['id']);
    $this->session->set_flashdata('message','Facility  Successfully '.$message);
    echo "1";
  }
  public function view_facility_type_info($facility_type,$id='') {
    $fac_loc = 'room_amenities';
    if($facility_type == 'room'){
      $fac_loc = 'room_amenities';
    } else if($facility_type == 'hotel'){
      $fac_loc = 'hotel_amenities';
    }if($facility_type == 'villa'){
      $fac_loc = 'villa_amenities';
    }

    if($id=='') {
      redirect('facility_type/'.$fac_loc);
    }
    // echo $id;exit;
    $data['status']='';
    $data['error']='';
    $data['action']='update_facility_type';
    $data['button']='Update';
    $data['id']= $id;
    $data['facilitytype'] = $this->glb_hotel_facilities_type->get_single($id);
    $data['sub_view'] = 'facilitytype/edit';
    $this->load->view('_layout_main',$data);
  }
  public function update_facility_type() {
    // echo '1';exit;
    $id = $this->input->post('id');
    $facility_type = $this->input->post('facility_type');
    $this->form_validation->set_rules('facility', 'Facility', 'trim|required');
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('facility_type/view_facility_type_info/'.$facility_type.'/'.$id);
    }
    else if($this->check_multiple()){
      $errors_msg='Facility and Facility Type both value are already exist.......';
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('facility_type/view_facility_type_info/'.$facility_type.'/'.$id);
    }else{
      $data=array(
        'facility'=>$this->input->post('facility'),
        'facility_type'=>$this->input->post('facility_type'),
        'date_time' => date('Y-m-d H:i:s'),
      );
      if($this->glb_hotel_facilities_type->update($data, $id)) {
        $this->session->set_flashdata('message','Facility Successfully Updated');
        redirect('facility_type/view_facility_type_info/'.$facility_type.'/'.$id);
      } else {
        $this->session->set_flashdata('errors_msg','Facility Not Updated. Please try after some time...');
        redirect('facility_type/view_facility_type_info/'.$facility_type.'/'.$id);
      }
    }
  }
}