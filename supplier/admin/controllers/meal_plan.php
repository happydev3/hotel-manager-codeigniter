<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class meal_plan extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_meal_plan');  
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
  // Manage Meal Plan
  public function add_mealplan(){          
    // $this->form_validation->set_rules('meal_plan', 'Meal Plan', 'trim|required|is_unique[glb_hotel_meal_plan.meal_plan]');
    $this->form_validation->set_rules('meal_plan', 'Meal Plan', 'trim|required');
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('meal_plan/mealplan');
    }else if($this->check_multiple()){
      $errors_msg='Meal plan should be unique';
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('meal_plan/mealplan');
    }else{                   
       
     $insertarray=array(
       'meal_plan'=>$this->input->post('meal_plan'),
       'supplier_id'=>$this->supplier_id,
       'date_time' => date('Y-m-d H:i:s'),  
       'status' => 1,       
       );    
     $id=$this->glb_hotel_meal_plan->insert($insertarray);
     if(!empty($id))
     {             
    $this->session->set_flashdata('message','Meal Plan  Successfully Created!');
       redirect('meal_plan/mealplan');
     }     
     else
     { 
      $errors_msg= 'Meal Plan Not Created. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('meal_plan/mealplan');    
    }
  }
}

public function check_multiple() {
    $dataarray=array(
      'meal_plan'=>$this->input->post('meal_plan'),
      // 'supplier_id'=>$this->supplier_id,
    );
    $check_multiple = $this->glb_hotel_meal_plan->check($dataarray);
    if($check_multiple!='') {
      return TRUE;
    } else {
      return FALSE;
    }
  }

 public function mealplan() { 
  $data['error']=''; 
  $data['action']='add_mealplan';
  $data['button']='Add mealplan';     
  $data['sub_view'] = 'mealplan/list';
  $data['mealplan'] = $this->glb_hotel_meal_plan->get();
  $this->load->view('_layout_main',$data); 
 }

public function set_meal_plan_status()
{ 
  if($_POST['id']==''||$_POST['status']=='')
  {
   redirect('meal_plan/mealplan');
 }
 $message='';
 if($_POST['status'] == 0) { $message='Inactive'; } 
 else if($_POST['status'] == 1) { $message='Active';}
 else if($_POST['status'] == 2) {  $message='Blocked';} 
 $data = array('status' =>$_POST['status']);
 $this->glb_hotel_meal_plan->update($data, $_POST['id']);
 $this->session->set_flashdata('message','Meal Plan Successfully '.$message);
 echo "1";
}

public function view_meal_plan_info($id='')
{
  if($id=='')
  {
    redirect('meal_plan/mealplan');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_meal_plan';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['mealplan'] = $this->glb_hotel_meal_plan->get_single($id);     
  $data['sub_view'] = 'mealplan/edit';
  $this->load->view('_layout_main',$data);       
}

public function update_meal_plan()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('meal_plan', 'Meal Plan', 'trim|required|is_unique[glb_hotel_meal_plan.meal_plan]');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('meal_plan/view_meal_plan_info/'.$id);  
    }else{   
  $data=array(           
   'meal_plan'=>$this->input->post('meal_plan'), 
   'date_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->glb_hotel_meal_plan->update($data, $id))
  {   
    $this->session->set_flashdata('message','Meal Plan Successfully Updated');
    redirect('meal_plan/view_meal_plan_info/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Meal Plan Not Updated. Please try after some time...');
    redirect('meal_plan/view_meal_plan_info/'.$id);     
  }
}
}

public function view_meal_plan_desc($id='')
{
  if($id=='')
  {
    redirect('meal_plan/mealplan');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_meal_plan_desc';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['mealplan'] = $this->glb_hotel_meal_plan->get_single($id);     
  $data['sub_view'] = 'mealplan/edit_desc';
  $this->load->view('_layout_main',$data);       
}

public function update_meal_plan_desc()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('description', 'Description', 'trim|required');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('meal_plan/view_meal_plan_desc/'.$id);  
    }else{   
  $data=array(           
   'description'=>stripslashes($this->input->post('description')), 
   'date_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->glb_hotel_meal_plan->update($data, $id))
  {   
    $this->session->set_flashdata('message','Meal Plan Description Successfully Updated');
    redirect('meal_plan/view_meal_plan_desc/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Meal Plan Description Not Updated. Please try after some time...');
    redirect('meal_plan/view_meal_plan_desc/'.$id);     
  }
}
}

 

}
