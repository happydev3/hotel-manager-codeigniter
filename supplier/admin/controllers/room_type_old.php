<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class room_type extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_room_type');  
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
  // Manage Room Type
  public function add_roomtype(){          
    $this->form_validation->set_rules('room_type', 'Room Type', 'trim|required|is_unique[glb_hotel_room_type.room_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('room_type/roomtype');
    }else{                   
       
     $insertarray=array(
       'room_type'=>$this->input->post('room_type'), 
       'date_time' => date('Y-m-d H:i:s'),     
       'status' => 1,       
       );    
     $id=$this->glb_hotel_room_type->insert($insertarray);
     if(!empty($id))
     {             
    $this->session->set_flashdata('message','Room Type  Successfully Created!');
       redirect('room_type/roomtype');
     }     
     else
     { 
      $errors_msg= 'Room Type Not Created. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('room_type/roomtype');    
    }
  }
}


 public function roomtype() { 
  $data['error']=''; 
  $data['action']='add_roomtype';
  $data['button']='Add Roomtype';     
  $data['sub_view'] = 'roomtype/list';
  $data['roomtype'] = $this->glb_hotel_room_type->get();
  $this->load->view('_layout_main',$data); 
 }

public function set_room_type_status()
{ 
  if($_POST['id']==''||$_POST['status']=='')
  {
   redirect('room_type/roomtype');
 }
 $message='';
 if($_POST['status'] == 0) { $message='Inactive'; } 
 else if($_POST['status'] == 1) { $message='Active';}
 else if($_POST['status'] == 2) {  $message='Blocked';} 
 $data = array('status' =>$_POST['status']);
 $this->glb_hotel_room_type->update($data, $_POST['id']);
 $this->session->set_flashdata('message','Room Type Successfully '.$message);
 echo "1";
}

public function view_room_type_info($id='')
{
  if($id=='')
  {
    redirect('room_type/roomtype');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_room_type';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['roomtype'] = $this->glb_hotel_room_type->get_single($id);     
  $data['sub_view'] = 'roomtype/edit';
  $this->load->view('_layout_main',$data);       
}

public function update_room_type()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('room_type', 'Room Type', 'trim|required|is_unique[glb_hotel_room_type.room_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('room_type/view_room_type_info/'.$id);  
    }else{   
  $data=array(           
   'room_type'=>$this->input->post('room_type'), 
   'date_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->glb_hotel_room_type->update($data, $id))
  {   
    $this->session->set_flashdata('message','Room Type Successfully Updated');
    redirect('room_type/view_room_type_info/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Room Type Not Updated. Please try after some time...');
    redirect('room_type/view_room_type_info/'.$id);     
  }
}
}

}
