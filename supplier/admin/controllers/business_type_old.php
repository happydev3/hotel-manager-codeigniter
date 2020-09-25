<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class business_type extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_business_type');  
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
  // Manage Business Type
  public function add_businesstype(){          
    $this->form_validation->set_rules('business_type', 'Business Type', 'trim|required|is_unique[glb_hotel_business_type.business_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('business_type/businesstype');
    }else{                   
       
     $insertarray=array(
       'business_type'=>$this->input->post('business_type'), 
       'date_time' => date('Y-m-d H:i:s'),     
       'status' => 1,       
       );    
     $id=$this->glb_hotel_business_type->insert($insertarray);
     if(!empty($id))
     {             
    $this->session->set_flashdata('message','Business Type  Successfully Created!');
       redirect('business_type/businesstype');
     }     
     else
     { 
      $errors_msg= 'Business Type Not Created. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('business_type/businesstype');    
    }
  }
}


 public function businesstype() { 
  $data['error']=''; 
  $data['action']='add_businesstype';
  $data['button']='Add Businesstype';     
  $data['sub_view'] = 'businesstype/list';
  $data['businesstype'] = $this->glb_hotel_business_type->get();
  $this->load->view('_layout_main',$data); 
 }

public function set_business_type_status()
{ 
  if($_POST['id']==''||$_POST['status']=='')
  {
   redirect('business_type/businesstype');
 }
 $message='';
 if($_POST['status'] == 0) { $message='Inactive'; } 
 else if($_POST['status'] == 1) { $message='Active';}
 else if($_POST['status'] == 2) {  $message='Blocked';} 
 $data = array('status' =>$_POST['status']);
 $this->glb_hotel_business_type->update($data, $_POST['id']);
 $this->session->set_flashdata('message','Business Type Successfully '.$message);
 echo "1";
}

public function view_business_type_info($id='')
{
  if($id=='')
  {
    redirect('business_type/businesstype');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_business_type';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['businesstype'] = $this->glb_hotel_business_type->get_single($id);     
  $data['sub_view'] = 'businesstype/edit';
  $this->load->view('_layout_main',$data);       
}

public function update_business_type()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('business_type', 'Business Type', 'trim|required|is_unique[glb_hotel_business_type.business_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('business_type/view_business_type_info/'.$id);  
    }else{   
  $data=array(           
   'business_type'=>$this->input->post('business_type'), 
   'date_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->glb_hotel_business_type->update($data, $id))
  {   
    $this->session->set_flashdata('message','Business Type Successfully Updated');
    redirect('business_type/view_business_type_info/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Business Type Not Updated. Please try after some time...');
    redirect('business_type/view_business_type_info/'.$id);     
  }
}
}

 

}
