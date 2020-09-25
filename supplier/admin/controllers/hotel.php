<?php
ob_start();
// error_reporting(1);
if (!defined('BASEPATH')) exit('No direct script access allowed');

class hotel extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database(); 
    $this->load->model('sup_hotels');
    $this->load->model('supplier_hotel_list');
    $this->load->model('currency');
    $this->load->model('jamaican_city_list');
    $this->load->model('glb_hotel_facilities_type');
    $this->load->model('glb_hotel_room_type');
    $this->load->model('glb_hotel_meal_plan');
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

public function hotel_list() {

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
    for($i=0;$i<count($propertytypeall);$i++) {
        $propertyarraylist[$propertytypeall[$i]->id]=$propertytypeall[$i]->property_type;
    }
    $data['propertytypeall']=$propertyarraylist;
    $data['hotel_details'] =$this->supplier_hotel_list->gethotellist($this->supplier_id,$hotel_code,$hotel_name,$hotel_city,$hotel_country,$hotel_star_rating,$hotel_property_type);

    // $data['city_list'] = $this->jamaican_city_list->get_data();
    $data['sub_view'] = 'hotel/hotel_list';
    $this->load->view('_layout_main',$data);
}

public function add_hotel() {
    // $dataarray=array('status'=>1);
    // $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray); 
    $data['propertytype'] =$this->glb_hotel_property_type->get();    
      
    $data['currency']=$this->currency->get();
    $data['sub_view'] = 'hotel/add_hotel';
    $this->load->view('_layout_main',$data);
}

public function duplicateHotels(){
    $cityids = isset($_POST['cityid2'])?rtrim($this->input->post('cityid2'), ', '):'';
    $hotel_id = isset($_POST['hotel_id'])?$this->input->post('hotel_id'):'';
    $hotel_code = isset($_POST['hotel_code'])?$this->input->post('hotel_code'):'';
    $flag = '';
    if($cityids !='' && $hotel_id !='' && $hotel_code !=''){
        $cityidarr = explode(', ', $cityids);
        foreach($cityidarr as $cityid){
            $where = array(
                'supplier_id'=>$this->supplier_id,
                'hotel_code'=>$hotel_code,
                'supplier_hotel_list_id'=>$hotel_id
            );
            $hotels = $this->supplier_hotel_list->get_data('*',$where,1,'array');
            $orgcityid = $hotels['cityid'];
            // echo '<pre>';print_r($where);//exit;
            // $where2 = array(
            //     'supplier_id'=>$this->supplier_id,
            //     'hotel_code'=>$hotel_code,
            //     'cityid'=>$cityid
            // );
            // $checkhotels = $this->supplier_hotel_list->get_data('supplier_hotel_list_id',$where2,1);
            // if(empty($checkhotels)){
                if($cityid != $orgcityid){
                    // unset($hotels['supplier_hotel_list_id']);
                    $citylist = $this->jamaican_city_list->get_data('*',array('id'=>$cityid),1);
                    $last_code = $this->supplier_hotel_list->get_last_hotel_code();
                    $newhotel_code = str_pad($last_code + 1, 10, 0, STR_PAD_LEFT);
                    $data = array(
                        'supplier_hotel_list_id' => '',
                        'hotel_city' => $citylist->city_name,
                        'hotel_country' => $citylist->country_name,
                        'cityid' => $cityid,
                        'hotel_code' => $newhotel_code,
                        'latitude' => '',
                        'longitude' => '',
                        'address' => '',
                        'location' => '',
                        'created_date'=>date('Y-m-d'),
                    );
                    $hotelinsert = array_merge($hotels,$data);
                    // echo '<pre>';print_r($hotelinsert);//exit;
                    $insert_id = $this->supplier_hotel_list->insert($hotelinsert);
                    if($insert_id != ''){
                        $flag = 'success';
                        // trigger_notification
                        $this->triggerNotification($hotel_id,'has duplicated a property');
                        unset($hotels);
                        unset($data);
                        unset($hotelinsert);
                    }
                }
            // }
            
        }
    }
    // exit;
    if($flag == ''){
        $this->session->set_flashdata('error','Please try again');
    } else {
        $this->session->set_flashdata('message','Duplication completed!');
    }
    redirect('hotel/hotel_list', 'refresh');
}

public function save_step1($check_insert='') {
    // echo '<pre>11';print_r($_POST);exit;
    $this->form_validation->set_rules('hotel_name', 'Property Name', 'trim|required');  
    // $this->form_validation->set_rules('hotel_type', 'Property Type', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else { 
        $hotel_code = $this->supplier_hotel_list->get_last_hotel_code();
        $hotel_code = str_pad($hotel_code + 1, 10, 0, STR_PAD_LEFT);  
        $data=array(
            'supplier_id' =>$this->supplier_id,
            'hotel_code' =>  $hotel_code,
            'hotel_name' => $this->input->post('hotel_name'),                   
            'hotel_star_rating' => $this->input->post('hotel_star_rating'),
            'hotel_property_type' => $this->input->post('hotel_property_type'),
            'hotel_city' => $this->input->post('hotel_city'),
            'hotel_country' => $this->input->post('hotel_country'),
            'cityid' => $this->input->post('cityid'),
            // 'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),                    
            // 'hotel_desc' => $this->input->post('hotel_desc'),
            // 'totalnoofbookings' => $this->input->post('totalnoofbookings'),
            // 'release_day' => $this->input->post('release_day'),
          
            'currency_type' => $this->input->post('currency_type'),
            // 'module_permission' => $this->input->post('module_permission'),
            // 'supplier_tax_percent' =>$this->input->post('supplier_tax_percent'),
            'government_tax' =>$this->input->post('government_tax'),
            'resort_fee' =>$this->input->post('resort_fee'),
            'service_tax' =>$this->input->post('service_tax'),
            'created_date'=>date('Y-m-d'),
        );
                      // echo '<pre>11';print_r($data);exit;
        $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            $insert_id = $this->supplier_hotel_list->insert($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $this->supplier_hotel_list->update($data, $check_insert);
            echo json_encode(array('insert_id' => $check_insert));
        }
        $this->session->set_flashdata('message','Step 1 Completed!');
        
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
    $this->supplier_hotel_list->set_status($data,$id);
   if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Hotel is now '.$msg);
    redirect('hotel/hotel_list', 'refresh'); 
}

public function edit_hotel() {
    // echo $_GET['id']; exit;
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    /*
        if(!isset($_GET['id'])) {
            redirect('hotel/hotel_list','refresh');
        }    
        if(empty($data['hotel_details'])) {
            redirect('hotel/hotel_list','refresh');
        }
        $dataarray=array('status'=>1);
        $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray);
    */ 
    $data['propertytype'] =$this->glb_hotel_property_type->get();
    $data['currency']=$this->currency->get(); 
    $data['sub_view'] = 'hotel/edit_hotel';
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
   $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    if(empty($data['hotel_details']))
    {
        redirect('hotel/hotel_list','refresh');
    }   
    $data['sub_view'] = 'hotel/edit_step2';
    $this->load->view('_layout_main',$data);
}

public function edit_step3() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    // echo '<pre>';print_r($data['hotel_details']);exit;
    // $data['mealplan'] =$this->glb_hotel_meal_plan->get();
    if(!isset($_GET['id']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    if(empty($data['hotel_details']))
    {
        redirect('hotel/hotel_list','refresh');
    }   
    $dataarray1=array('status'=>1,'facility_type'=>'hotel');
    $data['hotel_facilities'] =$this->glb_hotel_facilities_type->check($dataarray1);
    $data['sub_view'] = 'hotel/edit_step3';
    $this->load->view('_layout_main',$data);
}
public function edit_step4() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    if(empty($data['hotel_details']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    $data['gallery_img'] = $this->Upload_Model->get_supplier_hotel_images($hotel_id,'supplier_hotel_images','*');
    // echo base_url().'<br><pre>';
     // print_r($data['gallery_img']); exit;
    $data['sub_view'] = 'hotel/edit_step4';
    $this->load->view('_layout_main',$data);
}
public function edit_step5() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    // echo '<pre>';print_r($data['hotel_details']); exit;
    // $data['mealplan'] =$this->glb_hotel_meal_plan->get();
    if(!isset($_GET['id']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    if(empty($data['hotel_details']))
    {
        redirect('hotel/hotel_list','refresh');
    }
    $data['sub_view'] = 'hotel/edit_step5';
    $this->load->view('_layout_main',$data);
}

public function edit_step6() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $dataarray=array('supplier_hotel_list_id'=>$hotel_id);
    $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
    if(!isset($_GET['id']))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    if(empty($data['hotel_details']))
    {
        redirect('hotel/hotel_list','refresh');
    }   
    $data['sub_view'] = 'hotel/edit_step6';
    $this->load->view('_layout_main',$data);
}
public function edit_step7() {
    $data['hotel_id'] = $hotel_id = $_GET['id'];
    $data['sub_view'] = 'hotel/edit_step7';
    $this->load->view('_layout_main',$data);
}
public function update_all() {
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $hotel_id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
        $this->update_step1($hotel_id);
        if($todo == 1){
            redirect('hotel/edit_step2?id='.$hotel_id, 'refresh');
        } else {
            redirect('hotel/edit_hotel?id='.$hotel_id, 'refresh');
        }
    } elseif($step_no == 2){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step2($hotel_id);
        if($todo == 1){
            redirect('hotel/edit_step3?id='.$hotel_id, 'refresh');
        } else {
            redirect('hotel/edit_step2?id='.$hotel_id, 'refresh');
        }
    } elseif($step_no == 3){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step3($hotel_id);
        if($todo == 1){
            redirect('hotel/edit_step4?id='.$hotel_id, 'refresh');
        } else {
            redirect('hotel/edit_step3?id='.$hotel_id, 'refresh');
        }
    } elseif($step_no == 4){
        $this->update_step4($hotel_id);
        if($todo == 1){
            redirect('hotel/edit_step5?id='.$hotel_id, 'refresh');
        } else {
            redirect('hotel/edit_step4?id='.$hotel_id, 'refresh');
        }
    } elseif($step_no == 5){
        $this->update_step5($hotel_id);
        if($todo == 1){
            redirect('hotel/edit_step6?id='.$hotel_id, 'refresh');
        } else {
            redirect('hotel/edit_step5?id='.$hotel_id, 'refresh');
        }
    } elseif($step_no == 6){
        $this->update_step6($hotel_id);
        if($todo == 1){
            redirect('hotel/hotel_list', 'refresh');
        } else {
            redirect('hotel/edit_step6?id='.$hotel_id, 'refresh');
        }
    } else {
       
            redirect('hotel/hotel_list', 'refresh');
        } 
    
}

public function update_step1($hotel_id){
    // echo '<pre>11';print_r($_REQUEST);
    $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');    
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else {
        $data = array(                  
            'hotel_name' => $_REQUEST['hotel_name'],                  
            'hotel_star_rating' => $_REQUEST['hotel_star_rating'],
            'hotel_property_type' => $_REQUEST['hotel_property_type'],
            'hotel_city' => $_REQUEST['hotel_city'],
            'hotel_country' => $_REQUEST['hotel_country'],
            'cityid' => $_REQUEST['cityid'],
            'email' => $_REQUEST['email'],
            'address' => $_REQUEST['address'],                    
            // 'hotel_desc' => $_REQUEST['hotel_desc'],
            'totalnoofbookings' => $_REQUEST['totalnoofbookings'],
            'release_day' => $_REQUEST['release_day'],                  
            'currency_type' => $_REQUEST['currency_type'],
            // 'module_permission' => $_REQUEST['module_permission'],
            // 'supplier_tax_percent' => $_REQUEST['supplier_tax_percent'],
            'government_tax' => $_REQUEST['government_tax'], 
            'resort_fee' => $_REQUEST['resort_fee'], 
            'service_tax' => $_REQUEST['service_tax'],
        );
        $this->supplier_hotel_list->update($data, $hotel_id);
        // trigger_notification
        $this->triggerNotification($hotel_id,'has updated a property');
         // echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 1 Completed!');
    }
}

public function update_step2($hotel_id){
    // print_r($_POST); exit;
    // $this->form_validation->set_rules('reservation_email', 'Reservation Email', 'trim|required');
    // $this->form_validation->set_rules('emergency_no', 'Emergency No', 'trim|required');
    // if($this->form_validation->run()==FALSE) {
    //    $this->session->set_flashdata('error',validation_errors());
    // } else {
        $data = array(
            'location' =>$_REQUEST['location'],
            'latitude' =>$_REQUEST['latitude'],
            'longitude' =>$_REQUEST['longitude'],
            'hotel_email' =>$_REQUEST['hotel_email'],
            'reservation_email' =>$_REQUEST['reservation_email'],
            'sales_email' =>$_REQUEST['sales_email'],
            'hotel_phone' =>$_REQUEST['hotel_phone'],
            'hotel_fax' =>$_REQUEST['hotel_fax'],
            'hotel_mobile' =>$_REQUEST['hotel_mobile'],
            'booking_phone' =>$_REQUEST['booking_phone'],
            'management_phone' =>$_REQUEST['management_phone'],
            'emergency_no' =>$_REQUEST['emergency_no'],
            'hotel_website' =>$_REQUEST['hotel_website']
        );
        // echo '<pre>';print_r($data);exit;
        $this->supplier_hotel_list->update($data, $hotel_id);
        // trigger_notification
        $this->triggerNotification($hotel_id,'has updated a property');
        // echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 2 Completed!');
    // }
}

public function update_step3($hotel_id){
    // $this->form_validation->set_rules('check_in', 'Check In', 'trim|required');
    // $this->form_validation->set_rules('check_out', 'Check Out', 'trim|required');
    // if($this->form_validation->run()==FALSE) {
    //     $this->session->set_flashdata('error',validation_errors());
    // } else {
        $data = array(
            'hotel_facilities' =>implode(',',$_REQUEST['hotel_facilities']),
            'check_in' =>$_REQUEST['check_in'],
            'check_out' =>$_REQUEST['check_out'],
        );
         // echo '<pre>';print_r($data);

        $this->supplier_hotel_list->update($data, $hotel_id);
        // trigger_notification
        $this->triggerNotification($hotel_id,'has updated a property');
        // echo $this->db->last_query();exit;
        // echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 3 Completed!');
    // }
}

public function update_step4($hotel_id){
    $this->session->set_flashdata('message','Step 4 Completed!');
}

public function update_step5($hotel_id){
    // echo '<pre>';print_r($_POST);exit;
    // $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
    // $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');
    // $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
    // if($this->form_validation->run()==FALSE) {
    //     $this->session->set_flashdata('error',validation_errors());
    // } else {
        $data = array(
            // 'meta_title' => $_REQUEST['meta_title'],
            // 'meta_keywords' => $_REQUEST['meta_keywords'],
            // 'meta_description' =>$_REQUEST['meta_description']  
            'minimum_check_in' =>$_REQUEST['minimum_check_in'],
            'Check_in_instructions' =>$_REQUEST['Check_in_instructions'],
            'hotel_desc' => $_REQUEST['hotel_desc'],
            'mealplan' =>implode(',',$_REQUEST['mealplan']),
            'meal_plan_desc' =>$_REQUEST['meal_plan_desc'],
            'internet' =>$_REQUEST['internet'],
            // 'language' =>$_REQUEST['language'],
            'language' =>implode(',', $_REQUEST['language']),
            'close_by' =>implode(',', $_REQUEST['close_by']),
            'hotel_parking_type' =>$_REQUEST['hotel_parking_type'],
            'pets_allow' =>$_REQUEST['pets_allow'],
            'nearby' =>implode(',', $_REQUEST['nearby']),
            'entertainment' =>implode(',', $_REQUEST['entertainment']),
            'pool' =>implode(',', $_REQUEST['pool']),
            // 'pool' =>$_REQUEST['pool'],
            'imp_information' =>$_REQUEST['imp_information'],
            'exclusions' =>$_REQUEST['exclusions'],
            'transfers' =>$_REQUEST['transfers'],
            // 'child_policy' =>$_REQUEST['child_policy'],
            'fees' =>$_REQUEST['fees'],
        );
        // echo '<pre>123';print_r($data);exit;
        $this->supplier_hotel_list->update($data, $hotel_id);
        // trigger_notification
        $this->triggerNotification($hotel_id,'has updated a property');
        // echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 5 Completed!');
    // }
}

public function update_step6($hotel_id){
    // $this->form_validation->set_rules('policy', 'Policy', 'trim|required');
     // $this->form_validation->set_rules('child_policy', 'Child Policy', 'trim|required');
     // $this->form_validation->set_rules('terms_and_condition', 'Terms and Condition', 'trim|required');
    // if($this->form_validation->run()==FALSE) {
    //     $this->session->set_flashdata('error',validation_errors());
    // } else {
        $data = array(
           'policy' => addslashes($_REQUEST['policy']),
           'child_policy' => addslashes($_REQUEST['child_policy']),
           'terms_and_condition' =>addslashes($_REQUEST['terms_and_condition']),
           'photo_policy' =>addslashes($_REQUEST['photo_policy']),
           'rate_desc' =>addslashes($_REQUEST['rate_desc']),
           'room_charge_disclosure' =>addslashes($_REQUEST['room_charge_disclosure'])
        );
        // echo '<pre>';print_r($data);exit;
        $this->supplier_hotel_list->update($data, $hotel_id);
        // trigger_notification
        $this->triggerNotification($hotel_id,'has updated a property');
        // echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 6 Completed!');
    // }
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

public function update_step7($hotel_id){
    $this->session->set_flashdata('message','Step 7 Completed!');
}

public function calendar() {
    $data['sub_view'] = 'hotel/calendar';
    $this->load->view('_layout_main',$data);
}

public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    delete_s3_file($img_url);
    // echo $img_url;exit;
    // unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
}

public function citylist()
{
  if (isset($_GET['term'])) {
        //print_r($_GET['term']);exit;
        $return_arr = array();
        $search = $_GET["term"];
        // $city_list = $this->jamaican_city_list->get_hotel_city_list($search);
        $city_list = $this->jamaican_city_list->get_all_city_list($search);
        //print_r($city_list);exit;
        if (!empty($city_list)) {
            for ($i = 0; $i < count($city_list); $i++) {
                $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                $cityid = $city_list[$i]['id'];
                $return_arr[] = array(
                    'label' => ucfirst($city),
                    'value' => ucfirst($city),
                    'id'=>$cityid,
                    'city_name'=>ucfirst($city_list[$i]['city_name']),
                    'country_name'=>$city_list[$i]['country_name']
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id' => "",
                'city_name' => "",
                'country_name' => "",
            );
        }
    } else {
        $return_arr[] = array(
            'label' => "No Results Found",
            'value' => "",
            'id' => "",
            'city_name' => "",
            'country_name' => "",
        );
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

public function sortImages(){
    // echo '<pre/>';print_r($_POST);//exit;
    if(isset($_POST['item']) && !empty($_POST['item']) && $_POST['hotel_id']!=''){
        $item = $this->input->post('item');
        $hotel_id = $this->input->post('hotel_id');
        $this->load->model('Hotel_Model');
        // $images = $this->Hotel_Model->getHotelImages($hotel_id);

        $tempitem = $item;
        sort($tempitem);
        $temp = array();
        for($i=0;$i<count($item);$i++){
            $images = $this->Hotel_Model->getHotelImagesById($item[$i]);
            if(!empty($images)){
               $temp[$i] = $images;
               $temp[$i]->id = $tempitem[$i];
               // unset($temp[$i]->id);
            }
        }
        // echo '<pre/>';print_r($temp);exit;
        $delete = $this->Hotel_Model->deleteHotelImages($hotel_id);
        if($delete) {
            $this->Hotel_Model->insertHotelImages($temp);
        }
        echo '200';
    }
}

public function do_upload_hotel_img(){
    $id = $this->input->post('id');
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type1 = $this->input->post('img_type1');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $hotel_code = $this->input->post('hotel_code');
    $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = 'uploads';
    // $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
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
                'supplier_hotel_list_id'=>$id,
                'supplier_id'=>$this->supplier_id,
                'hotel_code'=>$hotel_code,
                'gallery_img'=>$imgpath.$imgfile['file_name'],
                'img_type'=>$img_type1,
            );
            $this->db->insert('supplier_hotel_images', $dataarray);
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


}

