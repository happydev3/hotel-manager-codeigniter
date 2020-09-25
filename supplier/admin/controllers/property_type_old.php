<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class property_type extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_property_type');  
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
  // Manage Property Type
  public function add_propertytype(){          
    $this->form_validation->set_rules('property_type', 'Property Type', 'trim|required|is_unique[glb_hotel_property_type.property_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('property_type/propertytype');
    }else{                   
       
     $insertarray=array(
       'property_type'=>$this->input->post('property_type'), 
       'date_time' => date('Y-m-d H:i:s'),     
       'status' => 1,       
       );    
     $id=$this->glb_hotel_property_type->insert($insertarray);
     if(!empty($id))
     {             
    $this->session->set_flashdata('message','Property Type  Successfully Created!');
       redirect('property_type/propertytype');
     }     
     else
     { 
      $errors_msg= 'Property Type Not Created. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('property_type/propertytype');    
    }
  }
}


 public function propertytype() { 
  $data['error']=''; 
  $data['action']='add_propertytype';
  $data['button']='Add propertytype';     
  $data['sub_view'] = 'propertytype/list';
  $data['propertytype'] = $this->glb_hotel_property_type->get();
  $this->load->view('_layout_main',$data); 
 }

public function set_property_type_status()
{ 
  if($_POST['id']==''||$_POST['status']=='')
  {
   redirect('property_type/propertytype');
 }
 $message='';
 if($_POST['status'] == 0) { $message='Inactive'; } 
 else if($_POST['status'] == 1) { $message='Active';}
 else if($_POST['status'] == 2) {  $message='Blocked';} 
 $data = array('status' =>$_POST['status']);
 $this->glb_hotel_property_type->update($data, $_POST['id']);
 $this->session->set_flashdata('message','Property Type Successfully '.$message);
 echo "1";
}

public function view_property_type_info($id='')
{
  if($id=='')
  {
    redirect('property_type/propertytype');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_property_type';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['propertytype'] = $this->glb_hotel_property_type->get_single($id);     
  $data['sub_view'] = 'propertytype/edit';
  $this->load->view('_layout_main',$data);       
}

public function update_property_type()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('property_type', 'Property Type', 'trim|required|is_unique[glb_hotel_property_type.property_type]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('property_type/view_property_type_info/'.$id);  
    }else{   
  $data=array(           
   'property_type'=>$this->input->post('property_type'), 
   'date_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->glb_hotel_property_type->update($data, $id))
  {   
    $this->session->set_flashdata('message','Property Type Successfully Updated');
    redirect('property_type/view_property_type_info/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Property Type Not Updated. Please try after some time...');
    redirect('property_type/view_property_type_info/'.$id);     
  }
}
}

 

}
