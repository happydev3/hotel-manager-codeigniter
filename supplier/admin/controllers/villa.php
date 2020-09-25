<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class villa extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database(); 
    $this->load->model('villa_list');
    $this->load->model('currency');
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
        
        if($vMod == false){
            redirect('home/index');
        }
    }
    

}

public function add_villa() {  
    $data['currency'] = $this->currency->get();
    $data['sub_view'] = 'villa/add_villa';
    $this->load->view('_layout_main',$data);
}

public function save_step1($check_insert='') {
    // echo '<pre>11';print_r($_POST);exit;
    $this->form_validation->set_rules('property_name', 'Property Name', 'trim|required');
    $this->form_validation->set_rules('availability_type', 'Availability Type', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else { 
        $property_code = $this->villa_list->get_last_property_code();
        $property_code = str_pad($property_code + 1, 10, 0, STR_PAD_LEFT);
        $data = array(
            'supplier_id' =>$this->supplier_id,
            // 'module_permission' => $this->input->post('module_permission'),
            'availability_type' => $this->input->post('availability_type'),
            'property_code' =>  $property_code,
            'property_name' => $this->input->post('property_name'),
            'property_type' => $this->input->post('property_type'),
            'star_rating' => $this->input->post('star_rating'),
            'city_name' => $this->input->post('city_name'),
            'country_name' => $this->input->post('country_name'),
            'cityid' => $this->input->post('cityid'),
            'currency_type' => $this->input->post('currency_type'),
            'min_pax' => $this->input->post('min_pax'),
            'max_pax' => $this->input->post('max_pax'),
            'bedroom' => $this->input->post('bedroom'),
            'bathroom' => $this->input->post('bathroom'),
            'price_type' => $this->input->post('price_type'),
            'price' => $this->input->post('price'),
            'short_desc' => $this->input->post('short_desc'),
            'address' => $this->input->post('address'),
            'created_date'=>date('Y-m-d'),                  
        );
        // echo '<pre>11';print_r($data);exit;
        $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            $insert_id = $this->villa_list->insert($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $this->villa_list->update($data, $check_insert);
            echo json_encode(array('insert_id' => $check_insert));
        }
        $this->session->set_flashdata('message','Step 1 Completed!');
    }
}

public function edit_villa() {
    // echo $_GET['id']; exit;
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray = array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);
    $data['currency']=$this->currency->get(); 
    $data['sub_view'] = 'villa/edit_villa';
    // echo '<pre>';print_r($data);exit;
    $this->load->view('_layout_main',$data);
}

public function edit_step2() {
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray = array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);
    $data['sub_view'] = 'villa/edit_step2';
    // echo '<pre>';print_r($data);exit;
    $this->load->view('_layout_main',$data);
}

public function edit_step3() {
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray=array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);   
    $dataarray1=array('status'=>1,'facility_type'=>'villa');
    $this->load->model('glb_hotel_facilities_type');
    $data['facilities'] =$this->glb_hotel_facilities_type->check($dataarray1);
    $data['sub_view'] = 'villa/edit_step3';
    $this->load->view('_layout_main',$data);
}

public function edit_step4() {
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray=array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);
    $this->load->model('Upload_Model');
    $data['gallery_img'] = $this->Upload_Model->get_villa_images($villa_id,'villa_images','*');
    // echo base_url().'<br><pre>';
    // print_r($data['gallery_img']); exit;
    $data['sub_view'] = 'villa/edit_step4';
    $this->load->view('_layout_main',$data);
}

public function edit_step5() {
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray=array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);
    $data['sub_view'] = 'villa/edit_step5';
    $this->load->view('_layout_main',$data);
}

public function edit_step6() {
    $data['villa_id'] = $villa_id = $_GET['id'];
    $dataarray=array('id'=>$villa_id);
    $data['villa_details'] = $this->villa_list->check($dataarray);
    $this->redirect_check($villa_id,$data['villa_details']);   
    $data['sub_view'] = 'villa/edit_step6';
    $this->load->view('_layout_main',$data);
}

public function redirect_check($villa_id='',$villa_details) {
    if(empty($villa_id)) {
        redirect('villa/villa_list','refresh');
    }    
    if(empty($villa_details)) {
        redirect('villa/villa_list','refresh');
    }
}
public function update_all() {
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $villa_id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
        $this->update_step1($villa_id);
        if($todo == 1){
            redirect('villa/edit_step2?id='.$villa_id, 'refresh');
        } else {
            redirect('villa/edit_villa?id='.$villa_id, 'refresh');
        }
    } elseif($step_no == 2){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step2($villa_id);
        if($todo == 1){
            redirect('villa/edit_step3?id='.$villa_id, 'refresh');
        } else {
            redirect('villa/edit_step2?id='.$villa_id, 'refresh');
        }
    } elseif($step_no == 3){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step3($villa_id);
        if($todo == 1){
            redirect('villa/edit_step4?id='.$villa_id, 'refresh');
        } else {
            redirect('villa/edit_step3?id='.$villa_id, 'refresh');
        }
    } elseif($step_no == 4){
        $this->update_step4($villa_id);
        if($todo == 1){
            redirect('villa/edit_step5?id='.$villa_id, 'refresh');
        } else {
            redirect('villa/edit_step4?id='.$villa_id, 'refresh');
        }
    } elseif($step_no == 5){
        $this->update_step5($villa_id);
        if($todo == 1){
            redirect('villa/edit_step6?id='.$villa_id, 'refresh');
        } else {
            redirect('villa/edit_step5?id='.$villa_id, 'refresh');
        }
    } elseif($step_no == 6){
        $this->update_step6($villa_id);
        if($todo == 1){
            redirect('villa/villa_list', 'refresh');
        } else {
            redirect('villa/edit_step6?id='.$villa_id, 'refresh');
        }
    } else {
        redirect('villa/villa_list', 'refresh');
    } 
    
}

public function update_step1($villa_id){
    // echo '<pre>11';print_r($villa_id);exit;
    $this->form_validation->set_rules('property_name', 'Property Name', 'trim|required');
    $this->form_validation->set_rules('availability_type', 'Availability Type', 'trim|required');

    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else {
        $data = array(
            // 'module_permission' => $this->input->post('module_permission'),
            'availability_type' => $this->input->post('availability_type'),
            'property_name' => $this->input->post('property_name'),
            'property_type' => $this->input->post('property_type'),
            'star_rating' => $this->input->post('star_rating'),
            'city_name' => $this->input->post('city_name'),
            'country_name' => $this->input->post('country_name'),
            'cityid' => $this->input->post('cityid'),
            'currency_type' => $this->input->post('currency_type'),
            'min_pax' => $this->input->post('min_pax'),
            'max_pax' => $this->input->post('max_pax'),
            'bedroom' => $this->input->post('bedroom'),
            'bathroom' => $this->input->post('bathroom'),
            'price_type' => $this->input->post('price_type'),
            'price' => $this->input->post('price'),
            'short_desc' => $this->input->post('short_desc'),
            'address' => $this->input->post('address')
        );
        $this->villa_list->update($data, $villa_id);
        $this->session->set_flashdata('message','Step 1 Completed!');
    }
}

public function update_step2($villa_id){
    // print_r($_POST); exit;
    $this->form_validation->set_rules('location', 'Location', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else {
        $data = array(
            'reservation_email' =>$this->input->post('reservation_email'),
            'sales_email' =>$this->input->post('sales_email'),
            'phone' =>$this->input->post('phone'),
            'mobile' =>$this->input->post('mobile'),
            'website' =>$this->input->post('website'),
            'location' =>$this->input->post('location'),
            'latitude' =>$this->input->post('latitude'),
            'longitude' =>$this->input->post('longitude')
        );
        // echo '<pre>';print_r($data);exit;
        $this->villa_list->update($data, $villa_id);
        $this->session->set_flashdata('message','Step 2 Completed!');
    }
}

public function update_step3($villa_id){
    // echo '<pre>';print_r($_POST);exit;
    $this->form_validation->set_rules('facilities[]', 'Facilities', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else {
        $data = array(
            'facilities' =>implode(',',$_REQUEST['facilities']),
            'check_in' =>$_REQUEST['check_in'],
            'check_out' =>$_REQUEST['check_out'],
            'highlights' =>$_REQUEST['highlights'],
            'imp_info' =>$_REQUEST['imp_info'],
        );
        // echo '<pre>';print_r($data);exit;
        $this->villa_list->update($data, $villa_id);
        $this->session->set_flashdata('message','Step 3 Completed!');
    }
}

public function update_step4($villa_id){
    $this->session->set_flashdata('message','Step 4 Completed!');
}

public function update_step5($villa_id) {
    $data = array(
        'meta_title' => $_REQUEST['meta_title'],
        'meta_keywords' => $_REQUEST['meta_keywords'],
        'meta_description' =>$_REQUEST['meta_description']    
    );
    // echo '<pre>';print_r($data);exit;
    $this->villa_list->update($data, $villa_id);
    $this->session->set_flashdata('message','Step 5 Completed!');
}

public function update_step6($villa_id){
    $this->form_validation->set_rules('policy', 'Policy', 'trim|required');
    // $this->form_validation->set_rules('child_policy', 'Child Policy', 'trim|required');
    $this->form_validation->set_rules('terms_and_condition', 'Terms and Condition', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $this->session->set_flashdata('error',validation_errors());
    } else {
        $data = array(
            'policy' => addslashes($_REQUEST['policy']),
            'child_policy' => addslashes($_REQUEST['child_policy']),
            'cancellation_policy' => addslashes($_REQUEST['cancellation_policy']),
            'terms_and_condition' =>addslashes($_REQUEST['terms_and_condition']),
            'photo_policy' =>addslashes($_REQUEST['photo_policy']),
            'rate_desc' =>addslashes($_REQUEST['rate_desc']),
            // 'room_charge_disclosure' =>addslashes($_REQUEST['room_charge_disclosure']),
        );
        // echo '<pre>';print_r($data);exit;
        $this->villa_list->update($data, $villa_id);
        $this->session->set_flashdata('message','Step 6 Completed!');
    }
}

public function villa_list() {
    $data['villa_details'] =$this->villa_list->getVillaList($this->supplier_id);  
    $data['sub_view'] = 'villa/villa_list';
    $this->load->view('_layout_main',$data);
}

public function set_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->villa_list->set_status($data,$id);
   if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Villa is now '.$msg);
    redirect('villa/villa_list', 'refresh'); 
}

public function sortImages(){
    // echo '<pre/>';print_r($_POST);//exit;
    if(isset($_POST['item']) && !empty($_POST['item']) && $_POST['villa_id']!=''){
        $item = $this->input->post('item');
        $villa_id = $this->input->post('villa_id');

        $tempitem = $item;
        sort($tempitem);
        $temp = array();
        for($i=0;$i<count($item);$i++){
            $images = $this->villa_list->getVillaImagesById($item[$i]);
            if(!empty($images)){
               $temp[$i] = $images;
               $temp[$i]->id = $tempitem[$i];
               // unset($temp[$i]->id);
            }
        }
        // echo '<pre/>';print_r($temp);exit;
        $delete = $this->villa_list->deleteVillaImages($villa_id);
        if($delete) {
            $this->villa_list->insertVillaImages($temp);
        }
        echo '200';
    }
}

public function do_upload_img(){
    $id = $this->input->post('id');
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type1 = $this->input->post('img_type1');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $this->input->post('property_code');
    $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = 'uploads';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($config['upload_path']))
    {
      mkdir($config['upload_path'], 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
            $dataarray=array(
                'villa_id'=>$id,
                'supplier_id'=>$this->supplier_id,
                'property_code'=>$property_code,
                'gallery_img'=>$imgpath.$imgfile['file_name'],
                'img_type'=>$img_type1,
            );
         $this->db->insert('villa_images', $dataarray);
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
public function delete_img(){
    // echo '<pre>';print_r($_POST);exit;
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    delete_s3_file($img_url);
    // unlink($img_url);
    $this->load->model('Upload_Model');
    $this->Upload_Model->delete_images_spec($img_id,$table_name);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
}

public function citylist() {

  if (isset($_GET['term'])) {
        $return_arr = array();
        $search = $_GET["term"];
        $this->load->model('jamaican_city_list');
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
                    'city_name'=>$city_list[$i]['city_name'],
                    'country_name'=>$city_list[$i]['country_name']
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => "",
                'id'=>'',
                'city_name'=>'',
                'country_name'=>''
            );
        }
    } else {
        $return_arr[] = array(
            'label' => "No Results Found",
            'value' => "",
            'id'=>'',
            'city_name'=>'',
            'country_name'=>''
        );
    }
    echo json_encode($return_arr);
}

}

