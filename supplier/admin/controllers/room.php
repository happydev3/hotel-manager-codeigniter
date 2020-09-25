<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class room extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('sup_hotels');
    $this->load->model('supplier_hotel_list');
    $this->load->model('supplier_room_list');
    $this->load->model('glb_hotel_facilities_type');
    $this->load->model('glb_hotel_room_type');
    $this->load->model('glb_hotel_business_type');
    $this->load->model('glb_hotel_meal_plan');
    $this->load->model('sup_hotel_room_rates');
    $this->load->model('sup_hotel_room_details');
    $this->load->model('sup_hotel_room_rates_list'); 
    $this->load->model('sup_hotel_room_rates'); 
    $this->load->model('sup_specialoffer_hotel_room_rates_list');
    $this->load->model('sup_specialoffer_hotel_room_rates'); 
    $this->load->model('sup_hotel_room_supplement_rates_list'); 
    $this->load->model('sup_hotel_room_supplement_rates'); 
    $this->load->model('sup_contract'); 
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
    } else{
        $this->load->model('supplier_info');
        $modules = $this->supplier_info->get_spec($this->supplier_id,'module_permission');
        // echo '<pre>';print_r($modules);exit;
        $mod_auth = explode(',', $modules->module_permission);
        $allMod = false;$hMod = false;$vMod = false;$tMod = false;
        if(!empty($mod_auth)) {
            foreach($mod_auth as $mod) {
                if($mod=='1') {
                    $allMod = $hMod = true;
                } elseif($mod=='2') {
                    $allMod = $vMod = true;
                } elseif($mod=='3') {
                    $allMod = $tMod = true;
                } else{
                    $hMod = false;$vMod = false;$tMod = false;
                    $allMod = false;
                }
            }
        }
        
        if($hMod == false){
            redirect('home/index');
        }
    }
}

public function triggerNotification($id,$msg=''){
    // $timezone = date_default_timezone_get();
    // date_default_timezone_set("$timezone");
    $data = array(
       'notification_time' => date('Y-m-d H:i:s'),
       'notification_flag' => 1,
       'notification_msg' => $msg
    );
    // echo '<pre>';print_r($data);exit;
    $this->supplier_hotel_list->update($data, $id);
    $this->load->model('supplier_info');
    $this->supplier_info->update(array('notification_flag' => 1), $this->supplier_id);
}

public function room_list() {   
    $data['hotel_code']=$hotel_code=isset($_GET['hotel_code']) ? $_GET['hotel_code'] : '';
    $data['room_name']=$room_name=isset($_GET['room_name']) ? $_GET['room_name'] : '';    
    $data['room_details'] =$this->supplier_room_list->getroomlist($this->supplier_id,$hotel_code,$room_name); 
    $data['sub_view'] = 'room/room_list';
    $this->load->view('_layout_main',$data);
}

public function manage_rate_status() {
  // print_r($_POST);
  $supplier_id=$this->supplier_id;
  $data['supplier_room_list_id']=$supplier_room_list_id=isset($_POST['supplier_room_list_id']) ? $_POST['supplier_room_list_id'] : '';
  $data['room_code']=$room_code=isset($_POST['room_code']) ? $_POST['room_code'] : '';
  $data['hotel_code']=$hotel_code=isset($_POST['hotel_code']) ? $_POST['hotel_code'] : '';
  if(!empty($supplier_room_list_id)&&!empty($room_code)&&!empty($hotel_code)) {
    $dataarray=array(
      'supplier_room_list_id'=>$supplier_room_list_id,
      'room_code'=>$room_code,
      'hotel_code'=>$hotel_code,
      'supplier_id'=>$supplier_id,
    );
    $check=$this->supplier_room_list->check($dataarray);
    if(!empty($check)) {
      $dataarray1=array(
        'sup_room_details_id'=>$supplier_room_list_id,
        'room_code'=>$room_code,
        'hotel_code'=>$hotel_code,
        'supplier_id'=>$supplier_id,
        'is_deleted'=>0,
      );
      $dataarray2=array('hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id);
      $data['hotel_detail']=$hotel_detail =$this->supplier_hotel_list->check($dataarray2);
      $data['hotel_name']=$hotel_detail[0]->hotel_name;
      $data['roomtype']=$roomtype =$this->glb_hotel_room_type->get_single($check[0]->hotel_room_type);
      $data['room_name']=$check[0]->room_name.' ('.$roomtype->room_type.')';
      $data['normal_room_rate']=$this->sup_hotel_room_rates_list->getRoomRatesMealBased($dataarray1);
      $data['sub_view'] = 'room/manage_room_rate_status_list';
      $this->load->view('_layout_main',$data);
    } else {
      redirect('room/room_list','refresh');
    }
  } else {
    redirect('room/room_list','refresh');
  }
}

public function room_list_excel() {   
    $data['sub_view'] = 'room/room_list_excel';
    $this->load->view('_layout_main',$data);
}
public function room_image_gallery() {   
    $data['sub_view'] = 'room/add_room_image';
    $this->load->view('_layout_main',$data);
}

public function add_room() { 
   $data['hotel_details'] = $this->supplier_hotel_list->get_only_supplier('*',$this->supplier_id);   
    $data['roomtype'] =$this->glb_hotel_room_type->get();  
    $data['mealplan'] =$this->glb_hotel_meal_plan->get();
    $dataarray=array('facility_type'=>'room');
    $data['room_facilities'] =$this->glb_hotel_facilities_type->check($dataarray);
    $data['sub_view'] = 'room/add_room';
    $this->load->view('_layout_main',$data);
}
public function add_room_details()
{
   $this->form_validation->set_rules('room_name', 'Room Name', 'trim|required');
   $this->form_validation->set_rules('hotelname', 'Hotel Name', 'trim|required');   
    if($this->form_validation->run()==FALSE) {       
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('room/add_room','refresh');
    } else {   
        $hotelname = $this->input->post('hotelname');
        $hotelnamelist=explode('*', $hotelname);
        $room_code = $this->supplier_room_list->get_last_room_code();
        $room_code = str_pad($room_code + 1, 10, 0, STR_PAD_LEFT);
     
    $insertdata=array(
      'supplier_id' =>$this->supplier_id,
      'supplier_hotel_list_id'=> $hotelnamelist[0],
      'hotel_code' => $hotelnamelist[1],
      'room_code'=>$room_code,
      'room_name' => $this->input->post('room_name'),
      'hotel_room_type' => $this->input->post('hotel_room_type'),
      'room_desc' => $this->input->post('room_desc'),
      'inclusions' => implode(',',$this->input->post('inclusions')),
      'exclusions' => implode(',',$this->input->post('exclusions')),
      'mealplan' => implode(',',$this->input->post('mealplan')),
      'room_facilities' => implode(',',$this->input->post('room_facilities')),
      'childageminlimit' =>0,
      'childagemaxlimit' =>11,
      'minadult' => $this->input->post('minadult'),
      'maxadult' => $this->input->post('maxadult'),
      'minchild' => $this->input->post('minchild'),
      'maxchild' => $this->input->post('maxchild'),
      'maxperson' => $this->input->post('maxperson'),
      'minperson' => $this->input->post('minperson'),                    
      'room_policies' => stripslashes($this->input->post('room_policies')),
      'room_cancel_policies' => stripslashes($this->input->post('room_cancel_policies')),
      'created_date'=>date('Y-m-d')
    );
    $this->supplier_room_list->insert($insertdata);
    // trigger_notification
    $this->triggerNotification($hotelnamelist[0],'has added a room');
    $this->session->set_flashdata('message','Room  Updated Successfully!');
    redirect('room/room_list','refresh');
}
}
public function update_room_details()
{
    $data['room_id'] = $room_id = $_POST['id'];
    $dataarray=array('supplier_room_list_id'=>$room_id );
    $data['room_details'] =$this->supplier_room_list->check($dataarray); 
    if(!isset($_POST['id']))
    {
        redirect('room/room_list','refresh');
    }    
    if(empty($data['room_details']))
    {
        redirect('room/room_list','refresh');
    }  
   $this->form_validation->set_rules('room_name', 'Room Name', 'trim|required');
   $this->form_validation->set_rules('hotelname', 'Hotel Name', 'trim|required');    
    if($this->form_validation->run()==FALSE) {       
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('room/edit_room?id='.$room_id,'refresh');
    } else {  
    $hotelname = $this->input->post('hotelname');
    $hotelnamelist=explode('*', $hotelname);  
     
    $updatedata=array(                   
      'supplier_hotel_list_id'=> $hotelnamelist[0],
      'hotel_code' => $hotelnamelist[1], 
      'room_name' => $this->input->post('room_name'),
      'hotel_room_type' => $this->input->post('hotel_room_type'),
      'room_desc' => $this->input->post('room_desc'),
      'inclusions' => implode(',',$this->input->post('inclusions')),
      'exclusions' => implode(',',$this->input->post('exclusions')),
      'mealplan' => implode(',',$this->input->post('mealplan')),
      'room_facilities' => implode(',',$this->input->post('room_facilities')),
      'childageminlimit' =>0,
      'childagemaxlimit' =>11,
      'minadult' => $this->input->post('minadult'),
      'maxadult' => $this->input->post('maxadult'),
      'minchild' => $this->input->post('minchild'),
      'maxchild' => $this->input->post('maxchild'),
      'maxperson' => $this->input->post('maxperson'),
      'minperson' => $this->input->post('minperson'),  
      'room_policies' => stripslashes($this->input->post('room_policies')),
      'room_cancel_policies' => stripslashes($this->input->post('room_cancel_policies'))
    );
   $this->supplier_room_list->update($updatedata, $room_id);
   // trigger_notification
    $this->triggerNotification($hotelnamelist[0],'has updated a room');
    $this->session->set_flashdata('message','Room  Updated Successfully!');
    redirect('room/room_list','refresh');
}
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
            // $insert_id = $this->sup_hotels->insert($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            // $this->sup_hotels->update($data, $check_insert);
            echo json_encode(array('insert_id' => $check_insert));
        }
        $this->session->set_flashdata('message','Step 1 Updated Successfully!');
        
    }
}

public function save_step2($check_insert) {
    // echo '<pre>';print_r($_POST);exit;
    $this->session->set_flashdata('message','Step 2 Updated successfully!');
    echo json_encode(array('insert_id' => $check_insert));
}

public function set_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->supplier_room_list->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Room is now '.$msg);
    redirect('room/room_list', 'refresh'); 
}

public function set_specialoffer_room_rate_status() {
   $dataarray=array('sup_hotel_room_rates_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
   $check=$this->sup_specialoffer_hotel_room_rates_list->check($dataarray);
    if(isset($_POST['id']) && isset($_POST['status'])&&!empty($check)){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_specialoffer_hotel_room_rates_list->set_status($data,$_POST['id']);
    $this->sup_specialoffer_hotel_room_rates->update_set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = 'Successfully Active';       
    } else {
        $msg = 'Successfully InActive';      
    }
   echo json_encode(array('result' => $msg));
   }
   else
   {
     echo json_encode(array('result' =>'Try After Sometimes.....'));
   }
}

public function set_normal_room_rate_status() {
   $dataarray=array('sup_hotel_room_rates_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
   $check=$this->sup_hotel_room_rates_list->check($dataarray);
    if(isset($_POST['id']) && isset($_POST['status'])&&!empty($check)){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_hotel_room_rates_list->set_status($data,$_POST['id']);
    $this->sup_hotel_room_rates->update_set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = 'Successfully Active';       
    } else {
        $msg = 'Successfully InActive';      
    }
   echo json_encode(array('result' => $msg));
   }
   else
   {
     echo json_encode(array('result' =>'Try After Sometimes.....'));
   }
}

public function edit_room() {
    $data['room_id'] = $room_id = $_GET['id'];
    $dataarray=array('supplier_room_list_id'=>$room_id );
    $data['room_details'] =$this->supplier_room_list->check($dataarray); 
    if(!isset($_GET['id']))
    {
        redirect('room/room_list','refresh');
    }    
    if(empty($data['room_details']))
    {
        redirect('room/room_list','refresh');
    }  
    $data['hotel_details'] = $this->supplier_hotel_list->get_only_supplier('*',$this->supplier_id);   
    $data['roomtype'] =$this->glb_hotel_room_type->get();  
    $data['mealplan'] =$this->glb_hotel_meal_plan->get();
    $dataarray=array('facility_type'=>'room');
    $data['room_facilities'] =$this->glb_hotel_facilities_type->check($dataarray);
    $data['sub_view'] = 'room/edit_room';
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
    $data['room_id'] = $room_id = $_GET['id'];
    $data['sub_view'] = 'room/edit_step2';
    $this->load->view('_layout_main',$data);
}
public function edit_step3() {
    $data['room_id'] = $room_id = $_GET['id'];
    $data['sub_view'] = 'room/edit_step3';
    $this->load->view('_layout_main',$data);
}

public function edit_step4() {
    $data['room_id'] = $room_id = $_GET['id'];
    $data['sub_view'] = 'room/edit_step4';
    $this->load->view('_layout_main',$data);
}
public function update_all() {
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $room_id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
        $this->update_step1($room_id);
        if($todo == 1){
            redirect('room/edit_step2?id='.$room_id, 'refresh');
        } else {
            redirect('room/edit_room?id='.$room_id, 'refresh');
        }
    } elseif($step_no == 2){
        $this->update_step2($room_id);
        if($todo == 1){
            redirect('room/edit_step3?id='.$room_id, 'refresh');
        } else {
            redirect('room/edit_step2?id='.$room_id, 'refresh');
        }
    } elseif($step_no == 3){
        $this->update_step3($room_id);
        if($todo == 1){
            redirect('room/edit_step4?id='.$room_id, 'refresh');
        } else {
            redirect('room/edit_step3?id='.$room_id, 'refresh');
        }
    } else {
        // $this->update_step4($room_id);
        if($todo == 1){
            redirect('room/room_list', 'refresh');
        } else {
            redirect('room/edit_step4?id='.$room_id, 'refresh');
        }
    }
}


public function update_step1($room_id){
    // echo '<pre>11';print_r($_POST);exit;
    // $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
    // $this->form_validation->set_rules('hotel_code', 'Hotel ID', 'trim|required');
    // $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'room/edit_room';
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
        // $this->sup_hotels->update($data, $room_id);
        $this->session->set_flashdata('message','Step 1 Updated Successfully!');
    }
}

public function update_step2($room_id){
    $this->session->set_flashdata('message','Step 2 Updated Successfully!');
}
public function update_step3($room_id){
    $this->session->set_flashdata('message','Step 3 Updated Successfully!');
}
public function update_step4($room_id){
    $this->session->set_flashdata('message','Step 4 Updated Successfully!');
}

public function room_rate_list() {
    $data['calender_data'] =$this->sup_hotel_room_rates->get();
    $dataarray=array('sup_hotel_id'=>'26');
    $data['rooms']=$this->sup_hotel_room_details->check($dataarray);
    
     $hotel_detail = $this->sup_hotels->get_single('26');
    $data['room_id'] = 26;
    $data['hotel_code'] = $hotel_detail->hotel_code;
    // echo '<pre>'; print_r($data); exit;
    $data['sub_view'] = 'roomrate/calendar';
    $this->load->view('_layout_main',$data);
}


public function get_available_rates()
{   
     
    $year=$_POST['year'];
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code'];
    // $startdate = date('Y-m-d', strtotime($year . '-' . $month . '-1'));
    // $enddate = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $roomrates = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate);
    $result = array();
    if (!empty($roomrates)) {
                foreach ($roomrates as $row) {
                    $result[] = array(
                        'room_available' => $row->rooms_available,
                        'room_price' => $row->room_fixed_rate,
                        'date' => $row->room_avail_date,
                    );
                }
                // print_r($result); exit;
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
}


 public function edit_room_rate(){
         // echo '<pre>';print_r($_POST);exit;
         // $sup_room_details_id=$_POST['sup_room_details_id'];
         // $supplier_id=$_POST['supplier_id'];
         // $sup_room_id=$_POST['sup_room_id'];
         // $hotel_code=$_POST['hotel_code'];
         // $room_code=$_POST['room_code'];
         // $start_date=$_POST['start_date'];
         // $end_date=$_POST['end_date'];
         
         // $dataarray=array(
         //                'sup_room_details_id'=>$_POST['sup_room_details_id'],
         //                'sup_room_id'=>$_POST['sup_room_id'],
         //                'hotel_code'=>$_POST['hotel_code'],
         //                'room_avail_date >= '=>!empty($_POST['start_date'])?$_POST['start_date']:'',
         //                'room_avail_date <='=>!empty($_POST['start_date'])?$_POST['end_date']:'',
                             // 'supplier_id'=>$this->supplier_id
         //                 );
          $dataarray=array(
                        'sup_room_details_id'=>'1',
                        'sup_room_id'=>'26',
                        'hotel_code'=>'0000180012',
                        // 'room_avail_date >= '=>'',
                        // 'room_avail_date <='=>'',
                        'supplier_id'=>$this->supplier_id
                         );
        $data['roomrates'] = $this->sup_hotel_room_rates->check($dataarray);
                 // $roomrates=$data['roomrates'] = $this->Roomrates_Model->new_cal_get_roomrates_by_date($sup_room_details_id, $sup_room_id, $hotel_code,$room_code,$start_date,$end_date);
       // echo '<pre>'; print_r($data); exit; 
       $data['sub_view'] = 'roomrate/edit_room_rate';
    $this->load->view('_layout_main',$data);
     }

public function edit_room_gallery_image()
{
    $data['room_id'] = $room_id = $_GET['id'];
    $dataarray=array('supplier_room_list_id'=>$room_id );
    $data['room_details'] =$this->supplier_room_list->check($dataarray); 
    if(!isset($_GET['id']))
    {
        redirect('room/room_list','refresh');
    }    
    if(empty($data['room_details']))
    {
        redirect('room/room_list','refresh');
    } 
     $data['supplier_room_gallery_images'] = $this->Upload_Model->supplier_room_images($room_id,'supplier_room_gallery_images','*');  
    $data['sub_view'] = 'room/edit_room_gallery_image';
    $this->load->view('_layout_main',$data);
}
public function edit_room_food_and_drink_gallery_image()
{
    $data['room_id'] = $room_id = $_GET['id'];
    $dataarray=array('supplier_room_list_id'=>$room_id );
    $data['room_details'] =$this->supplier_room_list->check($dataarray); 
    if(!isset($_GET['id']))
    {
        redirect('room/room_list','refresh');
    }    
    if(empty($data['room_details']))
    {
        redirect('room/room_list','refresh');
    } 
      $data['supplier_room_food_and_drink_gallery_images'] = $this->Upload_Model->supplier_room_images($room_id,'supplier_room_food_and_drink_gallery_images','*');
    $data['sub_view'] = 'room/edit_room_food_and_drink_gallery_image';
    $this->load->view('_layout_main',$data);
}
public function delete_img(){ 
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    delete_s3_file($img_url);
    // unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
    
}

public function addagerange()
{
    echo json_encode(array('result' =>$this->load->view('room/load_ajax_addagerange', '', TRUE)));
}


public function do_upload_room_img(){

    $room_id =$id= $this->input->post('id');
    $res=$this->supplier_room_list->check(array('supplier_room_list_id'=>$room_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $hotel_code = $res[0]->hotel_code;
    $room_code = $res[0]->room_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = 'uploads';
    // $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($config['upload_path'])) {
      mkdir($config['upload_path'], 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
            'supplier_room_list_id'=>$room_id,
            'sup_hotel_id'=>$sup_hotel_id,
            'supplier_id'=>$this->supplier_id,
            'hotel_code'=>$hotel_code,
            'room_code'=>$room_code,
            'gallery_img'=>$imgpath.$imgfile['file_name'],
          );
          $this->db->insert('supplier_room_gallery_images', $dataarray);
          s3Upload($imgpath.$imgfile['file_name'],'uploads');
        }      
        echo $success_msg;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}


public function manage_supplements_status()
{
    // print_r($_POST);
   $supplier_id=$this->supplier_id;
   $data['supplier_room_list_id']=$supplier_room_list_id=isset($_POST['supplier_room_list_id']) ? $_POST['supplier_room_list_id'] : ''; 
   $data['room_code']=$room_code=isset($_POST['room_code']) ? $_POST['room_code'] : ''; 
   $data['hotel_code']=$hotel_code=isset($_POST['hotel_code']) ? $_POST['hotel_code'] : '';
   if(!empty($supplier_room_list_id)&&!empty($room_code)&&!empty($hotel_code))
   {
       $dataarray=array(
                        'supplier_room_list_id'=>$supplier_room_list_id,
                        'room_code'=>$room_code,
                        'hotel_code'=>$hotel_code,
                        'supplier_id'=>$supplier_id,
                       );
       $check=$this->supplier_room_list->check($dataarray);
       if(!empty($check))
       {
        $dataarray1=array(
                        'sup_room_details_id'=>$supplier_room_list_id,
                        'room_code'=>$room_code,
                        'hotel_code'=>$hotel_code,
                        'supplier_id'=>$supplier_id,
                        'is_deleted'=>0,
                       );
  $dataarray2=array('hotel_code'=>$hotel_code,'supplier_id'=>$this->supplier_id);
  $data['hotel_detail']=$hotel_detail =$this->supplier_hotel_list->check($dataarray2); 
  $data['hotel_name']=$hotel_detail[0]->hotel_name;
     $data['roomtype']=$roomtype =$this->glb_hotel_room_type->get_single($check[0]->hotel_room_type);
     $data['room_name']=$check[0]->room_name.' ('.$roomtype->room_type.')';
     $data['supplement_room_rates']=$this->sup_hotel_room_supplement_rates_list->check($dataarray1);
     // $data['specialoffer_room_rate']=$this->sup_specialoffer_hotel_room_rates_list->check($dataarray1);
     $data['sub_view'] = 'room/manage_room_supplements_status_list';
     $this->load->view('_layout_main',$data);
       }
       else
       {
         redirect('room/room_list','refresh');
       } 
   }
   else
   {
    redirect('room/room_list','refresh');
   }
}

public function set_room_supplements_rate_status() {
   $dataarray=array('sup_hotel_room_supplement_rates_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
   $check=$this->sup_hotel_room_supplement_rates_list->check($dataarray);
    if(isset($_POST['id']) && isset($_POST['status'])&&!empty($check)){
    $data = array(
        'status' => $_POST['status'],          
    );
    $this->sup_hotel_room_supplement_rates_list->set_status($data,$_POST['id']);
    $this->sup_hotel_room_supplement_rates->update_set_status($data,$_POST['id']);
    if( $_POST['status']==1){
        $msg = 'Successfully Active';       
    } else {
        $msg = 'Successfully InActive';      
    }
   echo json_encode(array('result' => $msg));
   }
   else
   {
     echo json_encode(array('result' =>'Try After Sometimes.....'));
   }
}




}

