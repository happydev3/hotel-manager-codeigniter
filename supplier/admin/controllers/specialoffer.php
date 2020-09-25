<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class specialoffer extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();  
    $this->load->model('specialoffer_type'); 
    $this->load->model('specialoffer_list');  
    $this->load->model('currency');
    $this->load->model('jamaican_city_list');
    $this->load->model('glb_hotel_facilities_type');
    $this->load->model('glb_hotel_room_type');
    $this->load->model('glb_hotel_property_type');
    $this->load->model('Upload_Model');
    $this->load->library('upload');
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
public function type()
{   
   
    $data['error']=''; 
    $data['action']='add_specialoffer_type';
    $data['button']='Add Special Offer Type';    
    $data['type_list']=$this->specialoffer_type->get(); 
    $data['sub_view'] = 'specialoffer/list';   
    $this->load->view('_layout_main',$data); 
}

 public function add_specialoffer_type(){          
    $this->form_validation->set_rules('specialoffer', 'Special Offer Type', 'trim|required');           
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('specialoffer/type');   
    }
    else if($this->check_type()){
      $errors_msg='This Special Offer Type is already exist in Table Row.........';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
     redirect('specialoffer/type');   
    }else{                   
       
     $insertarray=array(     
       'type'=>$this->input->post('specialoffer'), 
       'updated_time' => date('Y-m-d H:i:s'),     
       'status' => 1,       
       );    
     $id=$this->specialoffer_type->insert($insertarray);
     if(!empty($id))
     {             
    $this->session->set_flashdata('message','Special Offer Type Successfully Created!');
      redirect('specialoffer/type');   
     }     
     else
     { 
      $errors_msg= 'Special Offer Type Not Created. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('specialoffer/type');    
    }
  }
}
public function set_specialoffer_status()
{ 
  if($_POST['id']==''||$_POST['status']=='')
  {
   redirect('specialoffer/type');
 }
 $message='';
 if($_POST['status'] == 0) { $message='Inactive'; } 
 else if($_POST['status'] == 1) { $message='Active';}
 else if($_POST['status'] == 2) {  $message='Blocked';} 
 $data = array('status' =>$_POST['status']);
 $this->specialoffer_type->update($data, $_POST['id']);
 $this->session->set_flashdata('message','Special Offer Type  Successfully '.$message);
 echo "1";
}

public function view_specialoffer_info($id='')
{
  if($id=='')
  {
    redirect('specialoffer/type');
  }
  $data['status']='';
  $data['error']='';
  $data['action']='update_specialoffer_type';
  $data['button']='Update'; 
  $data['id']= $id;        
  $data['specialoffer'] = $this->specialoffer_type->get_single($id);     
  $data['sub_view'] = 'specialoffer/edit';
  $this->load->view('_layout_main',$data);       
}

public function update_specialoffer_type()
{
 $id = $this->input->post('id'); 
   $this->form_validation->set_rules('specialoffer', 'Special Offer Type', 'trim|required');       
    if($this->form_validation->run()==FALSE) {
      $errors_msg= validation_errors();
      $this->session->set_flashdata('errors_msg',$errors_msg);       
        redirect('specialoffer/view_specialoffer_info/'.$id);  
    }
    else if($this->check_type()){
      $errors_msg='This Special Offer Type is already exist.......';
      $this->session->set_flashdata('errors_msg',$errors_msg);       
      redirect('specialoffer/view_specialoffer_info/'.$id); 
    }else{   
  $data=array(   
  'type'=>$this->input->post('specialoffer'), 
  'updated_time' => date('Y-m-d H:i:s'),     
   );        
  if($this->specialoffer_type->update($data, $id))
  {   
    $this->session->set_flashdata('message','Special Offer Type Successfully Updated');
    redirect('specialoffer/view_specialoffer_info/'.$id);      
  }
  else
  {
    $this->session->set_flashdata('Special Offer Type Not Updated. Please try after some time...');
    redirect('specialoffer/view_specialoffer_info/'.$id);     
  }
}
}


public function check_type()
{
     $dataarray=array(                    
                      'type'=>$this->input->post('specialoffer'), 
                     );    
     $check_type=$this->specialoffer_type->check($dataarray);   
     if($check_type!='')
     {
      return TRUE;
     }
     else
     {
      
      return FALSE;
     }
}
 
public function add() {
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray);  
    $data['sub_view'] = 'specialoffer/add_specialoffer';
    $this->load->view('_layout_main',$data);
}


public function specialoffer_list() {

    $data['hotel_code']=$hotel_code=isset($_GET['hotel_code']) ? $_GET['hotel_code'] : '';
    $data['hotel_name']=$hotel_name=isset($_GET['hotel_name']) ? $_GET['hotel_name'] : ''; 
    $data['hotel_city']=$hotel_city=isset($_GET['hotel_city']) ? $_GET['hotel_city'] : '';   
    $data['hotel_country']=$hotel_country=isset($_GET['hotel_country']) ? $_GET['hotel_country'] : '';   
    $data['hotel_star_rating']=$hotel_star_rating=isset($_GET['hotel_star_rating']) ? $_GET['hotel_star_rating'] : '';     
     $data['hotel_property_type']=$hotel_property_type=isset($_GET['hotel_property_type']) ? $_GET['hotel_property_type'] : '';
    $dataarray=array('status'=>1);
    $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray);    
    $propertytypeall =$this->glb_hotel_property_type->get(); 
    $propertyarraylist=array();
    for($i=0;$i<count($propertytypeall);$i++)
    {
     $propertyarraylist[$propertytypeall[$i]->id]=$propertytypeall[$i]->property_type;
    }
    $data['propertytypeall']=$propertyarraylist;
    $data['specialoffer'] =$this->specialoffer_list->gethotellist($this->supplier_id,$hotel_code,$hotel_name,$hotel_city,$hotel_country,$hotel_star_rating,$hotel_property_type);  
    $data['sub_view'] = 'specialoffer/specialoffer_list';
    $this->load->view('_layout_main',$data);
}


public function save_step1($check_insert='') {
    // echo '<pre>11';print_r($_POST);exit;
    $this->form_validation->set_rules('specialoffer_type', 'Specialoffer Type', 'trim|required');  
     $this->form_validation->set_rules('specialoffer_code', 'Specialoffer Code', 'trim|required');  
    $this->form_validation->set_rules('specialoffer_desc', 'Description', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => validation_errors(),
            'insert_id' => $check_insert
        ));
    } else {        
        $data=array(
                    'supplier_id' =>$this->supplier_id,
                    'specialoffer_type' =>$this->input->post('specialoffer_type'),
                    'specialoffer_code' => $this->input->post('specialoffer_code'),                   
                    'specialoffer_desc' => $this->input->post('specialoffer_desc'),
                    'specialoffer_enable' => $this->input->post('specialoffer_enable'),
                    'superseeds' =>implode(',',$this->input->post('superseeds')),
                     'updated_time' => date('Y-m-d H:i:s')
                    );
                      // echo '<pre>11';print_r($data);exit;
        $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            $insert_id = $this->specialoffer_list->insert($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $this->specialoffer_list->update($data, $check_insert);
            echo json_encode(array('insert_id' => $check_insert));
        }
        $this->session->set_flashdata('message','Step 1 Updated Successfully!');
        
    }
}

public function save_step2($check_insert) {
    // echo '<pre>';print_r($_POST);exit;
    $this->session->set_flashdata('message','Hotel is added successfully!');
    echo json_encode(array('insert_id' => $check_insert));
}

public function set_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->specialoffer_list->set_status($data,$id);
   if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Hotel is now '.$msg);
    redirect('specialoffer/specialoffer_list', 'refresh'); 
}

public function edit_specialoffer() {
    $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->checkrow($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray);  
    // print_r($data['specialoffer']); exit;
    $data['sub_view'] = 'specialoffer/edit_specialoffer';
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
   $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->checkrow($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }   
    $data['sub_view'] = 'specialoffer/edit_step2';
    $this->load->view('_layout_main',$data);
}

public function edit_step3() {
    // $data['id'] = $id = $_GET['id'];
    // $dataarray=array('id'=>$id);
    // $data['specialoffer'] = $this->specialoffer_list->check($dataarray);
    // if(!isset($_GET['id']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }    
    // if(empty($data['specialoffer']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }   
    // $dataarray1=array('status'=>1,'facility_type'=>'hotel');
    // $data['hotel_facilities'] =$this->glb_hotel_facilities_type->check($dataarray1);
    // $data['sub_view'] = 'specialoffer/edit_step3';
    // $this->load->view('_layout_main',$data);
   $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->checkrow($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray);  
    // print_r($data['specialoffer']); exit;
    $data['sub_view'] = 'specialoffer/edit_specialoffer';
    $this->load->view('_layout_main',$data);
}
public function edit_step4() {
    // $data['id'] = $id = $_GET['id'];
    // $dataarray=array('id'=>$id);
    // $data['specialoffer'] = $this->specialoffer_list->check($dataarray);
    // if(!isset($_GET['id']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }    
    // if(empty($data['specialoffer']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }    
    // $data['gallery_img'] = $this->Upload_Model->get_supplier_hotel_images($id,'supplier_hotel_images','*');
    // $data['sub_view'] = 'specialoffer/edit_step4';
    // $this->load->view('_layout_main',$data);
   $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->checkrow($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray);  
    // print_r($data['specialoffer']); exit;
    $data['sub_view'] = 'specialoffer/edit_specialoffer';
    $this->load->view('_layout_main',$data);
}
public function edit_step5() {
    // $data['id'] = $id = $_GET['id'];
    // $dataarray=array('id'=>$id);
    // $data['specialoffer'] = $this->specialoffer_list->check($dataarray);
    // if(!isset($_GET['id']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }    
    // if(empty($data['specialoffer']))
    // {
    //     redirect('specialoffer/specialoffer_list','refresh');
    // }   
    // $data['sub_view'] = 'specialoffer/edit_step5';
    // $this->load->view('_layout_main',$data);
   $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->checkrow($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }
    $dataarray=array('status'=>1);
    $data['specialoffer_type'] =$this->specialoffer_type->check($dataarray);  
    // print_r($data['specialoffer']); exit;
    $data['sub_view'] = 'specialoffer/edit_specialoffer';
    $this->load->view('_layout_main',$data);
}
public function edit_step6() {
    $data['id'] = $id = $_GET['id'];
    $dataarray=array('id'=>$id);
    $data['specialoffer'] = $this->specialoffer_list->check($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }    
    if(empty($data['specialoffer']))
    {
        redirect('specialoffer/specialoffer_list','refresh');
    }   
    $data['sub_view'] = 'specialoffer/edit_step6';
    $this->load->view('_layout_main',$data);
}
public function edit_step7() {
    $data['id'] = $id = $_GET['id'];
    $data['sub_view'] = 'specialoffer/edit_step7';
    $this->load->view('_layout_main',$data);
}


public function update_all() {
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
        // echo '<pre>123';print_r($_POST);exit;
        $this->update_step1($id);
        if($todo == 1){
            redirect('specialoffer/edit_step2?id='.$id, 'refresh');
        } else {
            redirect('specialoffer/edit_specialoffer?id='.$id, 'refresh');
        }
    } elseif($step_no == 2){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step2($id);
        if($todo == 1){
            redirect('specialoffer/edit_step3?id='.$id, 'refresh');
        } else {
            redirect('specialoffer/edit_step2?id='.$id, 'refresh');
        }
    } elseif($step_no == 3){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step3($id);
        if($todo == 1){
            redirect('specialoffer/edit_step4?id='.$id, 'refresh');
        } else {
            redirect('specialoffer/edit_step3?id='.$id, 'refresh');
        }
    } elseif($step_no == 4){
        $this->update_step4($id);
        if($todo == 1){
            redirect('specialoffer/edit_step5?id='.$id, 'refresh');
        } else {
            redirect('specialoffer/edit_step4?id='.$id, 'refresh');
        }
    } elseif($step_no == 5){
        $this->update_step5($id);
        if($todo == 1){
            redirect('specialoffer/edit_step6?id='.$id, 'refresh');
        } else {
            redirect('specialoffer/edit_step5?id='.$id, 'refresh');
        }
    } elseif($step_no == 6){
        $this->update_step6($id);
        if($todo == 1){
            redirect('specialoffer/specialoffer_list', 'refresh');
        } else {
            redirect('specialoffer/edit_step6?id='.$id, 'refresh');
        }
    } else {
       
            redirect('specialoffer/specialoffer_list', 'refresh');
        } 
    
}

public function update_step1($id){
    // echo '<pre>11';print_r($_POST);exit;
   $this->form_validation->set_rules('specialoffer_type', 'Specialoffer Type', 'trim|required');  
     $this->form_validation->set_rules('specialoffer_code', 'Specialoffer Code', 'trim|required');  
    $this->form_validation->set_rules('specialoffer_desc', 'Description', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => validation_errors(),
            'insert_id' => $check_insert
        ));
    } else {        
        $data=array(
                    'supplier_id' =>$this->supplier_id,
                    'specialoffer_type' =>$this->input->post('specialoffer_type'),
                    'specialoffer_code' => $this->input->post('specialoffer_code'),                   
                    'specialoffer_desc' => $this->input->post('specialoffer_desc'),
                    'specialoffer_enable' => $this->input->post('specialoffer_enable'),
                    'superseeds' =>implode(',',$this->input->post('superseeds')),
                     'updated_time' => date('Y-m-d H:i:s')
                    );
                      // echo '<pre>11';print_r($data);exit;
          
        $this->specialoffer_list->update($data, $id);
        // echo json_encode(array('insert_id' => $id));        
        $this->session->set_flashdata('message','Step 1 Updated Successfully!');
        
    }
}

public function update_step2($id){
    $this->form_validation->set_rules('hotel_phone', 'Hotel Phone', 'trim|required');
    $this->form_validation->set_rules('emergency_no', 'Emergency No', 'trim|required');
       if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'specialoffer/edit_specialoffer';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'location' =>$this->input->post('location'),
            'latitude' =>$this->input->post('latitude'),
            'longitude' =>$this->input->post('longitude'),
            'places_near_by' =>addslashes($this->input->post('places_near_by')),
            'hotel_email' =>$this->input->post('hotel_email'),
            'reservation_email' =>$this->input->post('reservation_email'),
            'sales_email' =>$this->input->post('sales_email'),
            'hotel_phone' =>$this->input->post('hotel_phone'),
            'hotel_fax' =>$this->input->post('hotel_fax'),
            'hotel_mobile' =>$this->input->post('hotel_mobile'),
            'booking_phone' =>$this->input->post('booking_phone'),
            'management_phone' =>$this->input->post('management_phone'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'hotel_website' =>$this->input->post('hotel_website')
            );
        // echo '<pre>';print_r($data);exit;
     $this->specialoffer_list->update($data, $id);
    $this->session->set_flashdata('message','Step 2 Updated Successfully!');
}
}
public function update_step3($id){
      $this->form_validation->set_rules('check_in', 'Check In', 'trim|required');
    $this->form_validation->set_rules('check_out', 'Check Out', 'trim|required');
       if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'specialoffer/edit_specialoffer';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'hotel_facilities' =>implode(',',$this->input->post('hotel_facilities')),
            'check_in' =>$this->input->post('check_in'),
            'check_out' =>$this->input->post('check_out'),           
            );
        // echo '<pre>';print_r($data);exit;
     $this->specialoffer_list->update($data, $id);
    $this->session->set_flashdata('message','Step 3 Updated Successfully!');
}
}
public function update_step4($id){
    $this->session->set_flashdata('message','Step 4 Updated Successfully!');
}
public function update_step5($id){
     $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
     $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');
     $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
       if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'specialoffer/edit_specialoffer';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
          'meta_title' => $this->input->post('meta_title'),
          'meta_keywords' => $this->input->post('meta_keywords'),
          'meta_description' =>$this->input->post('meta_description')    
            );
        // echo '<pre>';print_r($data);exit;
     $this->specialoffer_list->update($data, $id);
    $this->session->set_flashdata('message','Step 5 Updated Successfully!');
}
}
public function update_step6($id){
     $this->form_validation->set_rules('policy', 'Policy', 'trim|required');
     $this->form_validation->set_rules('cancellation_policy', 'Cancellation Policy', 'trim|required');
     $this->form_validation->set_rules('terms_and_condition', 'Terms and Condition', 'trim|required');
       if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'specialoffer/edit_specialoffer';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
           'policy' => addslashes($this->input->post('policy')),
           'cancellation_policy' => addslashes($this->input->post('cancellation_policy')),
           'terms_and_condition' =>addslashes($this->input->post('terms_and_condition'))  
            );
        // echo '<pre>';print_r($data);exit;
     $this->specialoffer_list->update($data, $id);
    $this->session->set_flashdata('message','Step 6 Updated Successfully!');
}
}
public function update_step7($id){
    $this->session->set_flashdata('message','Step 7 Updated Successfully!');
}

public function calendar() {
    $data['sub_view'] = 'specialoffer/calendar';
    $this->load->view('_layout_main',$data);
}

public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
    
}

public function citylist()
    {
      if (isset($_GET['term'])) {
            //print_r($_GET['term']);exit;
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->jamaican_city_list->get_hotel_city_list($search);
            //print_r($city_list);exit;
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['id'];
                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=>$cityid,
                        'city_name'=>$city_list[$i]['city_name'],
                        'country_name'=>$city_list[$i]['country_name']
                    );
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => ""
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => ""
            );
        }
        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
    } 



}

