<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class activity extends CI_CONTROLLER {

    private $supplier_id;
    private $upload_path;
    private $max_image_size = '4000';
    private $max_image_width = '2024';
    private $max_image_height = '2000';
    // private $base_url_fc;

function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('currency');
    $this->load->model('Upload_Model');
    $this->load->model('activity_packages');
    // $this->load->model('activity_theme');
    $this->load->model('activity_itinerary');
    $this->load->model('holiday_city');
    // $this->load->model('activity_accomodation');
    // $this->load->model('activity_rates');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    // $this->load->library('admin_auth');
    $this->supplier_id = $this->session->userdata('supplier_id');

    // $url=str_replace('/admin/','',FCPATH);
    $url= FCPATH;
    // $url_save=str_replace('/admin/','',base_url());//exit; 
    // $this->upload_path = $url. 'uploads/';
    $this->upload_path = $url.'uploads/'.$this->supplier_id.'/';
    // $this->base_url_fc = $url_save.'/'; //exit;
    $this->is_logged_in();
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}
public function activity_list() {
    $fields = 'id,supplier_id,activity_type,activity_name,activity_code,city_covering,status';
    $data['packages'] = $packages = $this->activity_packages->get_only_supplier($fields,$this->supplier_id);
    // echo '<pre>';print_r($data['itinerary']);exit;
    $data['sub_view'] = 'activity/activity_list';
    $this->load->view('_layout_main',$data);
}
public function get_active_packages(){
    $packages = $this->activity_packages->get_active_packages();
    // echo '{"data":'.json_encode($packages).'}';
}
public function add_activity() {
    // $data['theme'] = $this->activity_theme->get_active_themes();
    $city_fields = 'city_id,city_name';
    $data['activity_city'] = $this->holiday_city->get_active($city_fields);
    $data['currency'] = $this->currency->get('*');
    // $data['activity_packages'] = $this->activity_packages->get_active_supplier('id,activity_name,status',$this->supplier_id);
    $this->load->model('closed_reason_metadata');
    $data['closedReasons'] = $this->closed_reason_metadata->get();
    $data['sub_view'] = 'activity/add_activity';
    $this->load->view('_layout_main',$data);
}
public function save_activity_step1($check_insert='') {
    $this->form_validation->set_rules('activity_type', 'activity Type', 'trim|required');
    $this->form_validation->set_rules('activity_name', 'activity Name', 'trim|required');
    $this->form_validation->set_rules('activity_code', 'activity ID', 'trim|required');

    $check_insert = $this->input->post('insert_id');
    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
            'validation_status' => true,
            'insert_id' => $check_insert,
        ));
    } else {
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'activity_type' =>$this->input->post('activity_type'),
            'activity_name' =>$this->input->post('activity_name'),
            'activity_code' =>$this->input->post('activity_code'),
            'themes' =>implode(',', $this->input->post('themes')),
            // 'short_desc' =>$this->input->post('short_desc'),
            // 'accomodation_type' =>implode(',', $this->input->post('accomodation_type')),
            'star_rating' =>$this->input->post('star_rating'),
            'physical_rating' =>$this->input->post('physical_rating'),
            'minChildAge' =>$this->input->post('minChildAge'),
            'maxChildAge' =>$this->input->post('maxChildAge'),
            'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'operation_day' =>implode(',', $this->input->post('operation_day')),
            'closed_dates' =>implode('|', $this->input->post('closed_dates')),
            'closed_reason' =>implode('||', $this->input->post('closed_reason')),
            // 'departure_date' =>implode('|', $this->input->post('departure_date')),
            'city_covering' =>implode(',', $this->input->post('city_covering')),
            'currency_code' =>$this->input->post('currency_code'),
            'pp_price' =>$this->input->post('pp_price'),
            'pick_up' =>implode(',', $this->input->post('pick_up')),
            'drop_off' =>implode(',', $this->input->post('drop_off')),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'resevatoin_no' =>$this->input->post('resevatoin_no'),
            'product_manager_no' =>$this->input->post('product_manager_no'),
            'duration' =>$this->input->post('duration'),
            'no_of_days' =>$this->input->post('no_of_days'),
            'meals_type' =>implode(',', $this->input->post('meals_type')),
            'season_months' =>implode('|', $this->input->post('season_months')),
            'opening_hours' =>implode('|', $this->input->post('opening_hours')),
            'closing_hours' =>implode('|', $this->input->post('closing_hours')),
        );

        if($check_insert == ''){
            $insert_id = $this->activity_packages->insert_activity_packages($data);
            echo json_encode(array('insert_id' => $insert_id));
        } else{
            $insert_id = $check_insert;
            $this->activity_packages->update($data, $insert_id);
            echo json_encode(array('insert_id' => $insert_id));
        }
        $this->session->set_flashdata('message','Step 1 Completed!');
        // echo '<pre>';print_r($insert_id);exit;
        
    }
}

public function quick_add() {
    $data['sub_view'] = 'activity/quick_add';
    $this->load->view('_layout_main',$data);
}
public function set_package_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->activity_packages->set_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Package is now '.$msg);
    redirect('activity/activity_list', 'refresh'); 
}

public function edit_activity() {
    $data['package_id'] = $package_id = $_GET['id'];
    // $data['theme'] = $this->activity_theme->get_active_themes();
 // echo '<pre>';print_r($data['theme']);exit;
    $city_fields = 'city_id,city_name';
    $data['activity_city'] = $this->holiday_city->get_active($city_fields);
    $data['currency'] = $this->currency->get('*');

    $fields = '*';
    $data['package_info'] = $package_info = $this->activity_packages->get($fields,$package_id);
    $this->load->model('closed_reason_metadata');
    $data['closedReasons'] = $this->closed_reason_metadata->get();
    $data['sub_view'] = 'activity/edit_activity';
    $this->load->view('_layout_main',$data);
}


public function edit_step2() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'overview,highlights,activity_name,activity_code';
    $data['package_info'] = $this->activity_packages->get($fields,$package_id);

    $data['sub_view'] = 'activity/edit_step2';
    $this->load->view('_layout_main',$data);
}
public function edit_step3() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['city_covering'] = $this->activity_packages->get('city_covering',$package_id);
    $data['activity_itinerary'] = $activity_itinerary = $this->activity_itinerary->get_itinerary('*',$package_id);
    $data['package_info'] = $this->activity_packages->get('activity_name,activity_code',$package_id);
    if(!empty($activity_itinerary)){
        $data['total_iti'] = count($activity_itinerary);
    } else {
         $data['total_iti'] = 1;
    }
    // $data['pkg_accomodation'] = $this->activity_packages->get_only_supplier('id,hotelaccomodation',$this->supplier_id,$package_id);
    // $data['accomodation_info'] = $this->activity_accomodation->get_only_supplier('id,hotel_name',$this->supplier_id);
    // $data['gallery_img'] = $this->Upload_Model->get_images($package_id,'activity_itinerary_images','*','package_id',$this->supplier_id);
    $data['activity_city'] = $this->holiday_city->get_active('city_id,city_name');

    $data['sub_view'] = 'activity/edit_step3';
    $this->load->view('_layout_main',$data);
}
public function edit_step4() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'cancellation_policy,child_policy,insurance,includes,excludes,activity_name,activity_code';
    $data['package_info'] = $package_info = $this->activity_packages->get($fields,$package_id);
    $data['activity_packages'] = $this->activity_packages->get_active_supplier('id,activity_name,status',$this->supplier_id);
    // echo '<pre>';print_r($data['activity_packages']);exit;
    $data['sub_view'] = 'activity/edit_step4';
    $this->load->view('_layout_main',$data);
}


public function edit_step5() {
    $data['package_id'] = $package_id = $_GET['id'];
    
    $data['thumb_img'] = $this->activity_packages->get('thumb_img',$package_id);
    $data['gallery_img'] = $this->Upload_Model->get_images($package_id,'activity_package_images','*','package_id',$this->supplier_id);

    // $data['pkg_accomodation'] = $this->activity_packages->get_only_supplier('id,hotelaccomodation',$this->supplier_id,$package_id);
    $data['package_info'] = $this->activity_packages->get('activity_name,activity_code',$package_id);
    // $data['accomodation_info'] = $this->activity_accomodation->get_only_supplier('id,hotel_name',$this->supplier_id);
    // echo '<pre>';print_r($data['pkg_accomodation']);exit;
    $data['sub_view'] = 'activity/edit_step5';
    $this->load->view('_layout_main',$data);
}

public function update_all() { 
    //error_reporting(E_ALL);
    // echo '<pre>';print_r($_POST);exit;
    $step_no = $this->input->post('steps');
    $package_id = $this->input->post('insert_id');
    $todo = $this->input->post('todo');
    if($step_no == 1){
        // echo '<pre>';print_r($_POST);exit;
        $this->update_step1($package_id);

        if($todo == 1){
            redirect('activity/edit_step2?id='.$package_id, 'refresh');
        } else {
            redirect('activity/edit_activity?id='.$package_id, 'refresh');
        }
        
    } elseif ($step_no == 2) {
        $this->update_step2($package_id);
        if($todo == 1){
            redirect('activity/edit_step3?id='.$package_id, 'refresh');
        } else {
            redirect('activity/edit_step2?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 3) {
        $this->update_step3($package_id);
        if($todo == 1){
            redirect('activity/edit_step4?id='.$package_id, 'refresh');
        } else {
            redirect('activity/edit_step3?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 4) {
        $this->update_step4($package_id);
        if($todo == 1){
            redirect('activity/edit_step5?id='.$package_id, 'refresh');
        } else {
            redirect('activity/edit_step4?id='.$package_id, 'refresh');
        }
    } else{
        $this->update_step5($package_id);
        redirect('activity/activity_list', 'refresh');
    }
}

public function update_step1($package_id){
    $this->form_validation->set_rules('activity_type', 'activity Type', 'trim|required');
    $this->form_validation->set_rules('activity_name', 'activity Name', 'trim|required');
    // $this->form_validation->set_rules('activity_code', 'activity ID', 'trim|required|is_unique[activity_packages.activity_code]');
    if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'activity/edit_activity';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'activity_type' =>$this->input->post('activity_type'),
            'activity_name' =>$this->input->post('activity_name'),
            'activity_code' =>$this->input->post('activity_code'),
            'themes' =>implode(',', $this->input->post('themes')),
            'short_desc' =>$this->input->post('short_desc'),
            'accomodation_type' =>implode(',', $this->input->post('accomodation_type')),
            'star_rating' =>$this->input->post('star_rating'),
            'physical_rating' =>$this->input->post('physical_rating'),
            'minChildAge' =>$this->input->post('minChildAge'),
            'maxChildAge' =>$this->input->post('maxChildAge'),
            'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'operation_day' =>implode(',', $this->input->post('operation_day')),
            'closed_dates' =>implode('|', $this->input->post('closed_dates')),
            'closed_reason' =>implode('||', $this->input->post('closed_reason')),
            // 'departure_date' =>implode('|', $this->input->post('departure_date')),
            'city_covering' =>implode(',', $this->input->post('city_covering')),
            'currency_code' =>$this->input->post('currency_code'),
            'pp_price' =>$this->input->post('pp_price'),
            'pick_up' =>implode(',', $this->input->post('pick_up')),
            'drop_off' =>implode(',', $this->input->post('drop_off')),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'resevatoin_no' =>$this->input->post('resevatoin_no'),
            'product_manager_no' =>$this->input->post('product_manager_no'),
            'duration' =>$this->input->post('duration'),
            'no_of_days' =>$this->input->post('no_of_days'),
            'meals_type' =>implode(',', $this->input->post('meals_type')),
            'season_months' =>implode('|', $this->input->post('season_months')),
            'opening_hours' =>implode('|', $this->input->post('opening_hours')),
            'closing_hours' =>implode('|', $this->input->post('closing_hours')),
        );
        $this->activity_packages->update($data, $package_id);
        // echo '<pre>';print_r($this->db->last_query());exit;
        $this->session->set_flashdata('message','Step 1 Completed!');
    }
}

public function update_step2($package_id){
    $data = array(
        'overview' =>$this->input->post('overview'),
        'highlights' =>$this->input->post('highlights'),
    );
    $this->activity_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 2 Completed!');
}

public function update_step3($package_id){
    // echo '<pre>';print_r($_POST);exit;
    $itinerary_description = $this->input->post('itinerary_description');
    $day_count = $this->input->post('day_count');
    $this->activity_itinerary->delete_itinerary($package_id);
    // $this->Upload_Model->delete_count_images($package_id,$day_count,'activity_itinerary_images');
    // echo '<pre>';print_r($this->db->last_query());exit;
    for($a=0;$a<$day_count;$a++){
        $acco1 = implode(',', $this->input->post('pkg_accomodation_1_'.($a+1)));
        $acco2 = implode(',', $this->input->post('pkg_accomodation_2_'.($a+1)));
        $acco3 = implode(',', $this->input->post('pkg_accomodation_3_'.($a+1)));
        $join2 = $join3 = NULL;
        if(!empty($acco2)){
            $join2 = '|2|';
        }
        if(!empty($acco3)){
            $join3 = '|3|';
        }
        $accomo = $acco1.$join2.$acco2.$join3.$acco3;
        // echo '<pre>';print_r($accomo);//exit;
        $data = array(
            'package_id' =>$package_id,
            'day_count' =>$a+1,
            'itinerary_destination' =>implode(',',$this->input->post('itinerary_destination_'.($a+1))),
            'itinerary_meals' => implode(',',$this->input->post('itinerary_meals_'.($a+1))),
            'itinerary_description' => $itinerary_description[$a],
            'hotelaccomodation' => $accomo,
            // 'hotelaccomodation2' =>implode(',', $this->input->post('pkg_accomodation_2_'.($a+1))),
            // 'hotelaccomodation3' =>implode(',', $this->input->post('pkg_accomodation_3_'.($a+1))),
            // 'itinerary_gallery' =>implode(',',$this->input->post('itinerary_gallery_'.($a+1)))
        );
        
        $this->activity_itinerary->insert($data);
        // echo '<pre>';print_r($data);exit;
    }
    // exit;
    $this->session->set_flashdata('message','Step 3 Completed!');
}

public function update_step4($package_id){
    $data = array(
        'includes' =>$this->input->post('includes'),
        'excludes' =>$this->input->post('excludes'),
        'cancellation_policy' =>$this->input->post('cancellation_policy'),
        'child_policy' =>$this->input->post('child_policy'),
        'insurance' =>$this->input->post('insurance')
    );
    $this->activity_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 4 Completed!');
}

public function update_step5($package_id){
    // echo '<pre>11';print_r($_POST);exit;

    // $data = array(
    //     'hotelaccomodation' =>implode(',', $this->input->post('pkg_accomodation')),
    // );
    // $this->activity_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Package Completed Successfully!');
}

public function add_theme() {
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[activity_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->activity_theme->get_themes();
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
        // Load common things here
        $data['sub_view'] = 'activity/activity_theme';
        $data['error'] = 'It seems the theme you were adding is already present. Plese add another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->activity_theme->insert_theme($data);
        $this->session->set_flashdata('message','Theme added successfully!');
        redirect('activity/activity_theme', 'refresh');
    }
}

public function edit_theme() {
    $theme_id = $_GET['theme_id'];
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[activity_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->activity_theme->get_themes();
        $data['single_theme'] = $this->activity_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
        // Load common things here
        $data['sub_view'] = 'activity/activity_theme';
        $data['error'] = 'It seems the theme you were updating is already present. Plese update to another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->activity_theme->update_theme($data, $theme_id);
        $this->session->set_flashdata('message','Theme updated successfully!');
        redirect('activity/activity_theme', 'refresh');
    }
}

public function activity_theme() {
    // error_reporting(E_ALL);
    $data['theme_info'] = $this->activity_theme->get_themes();
    if(!empty($_GET['theme_id'])){
        $theme_id = $_GET['theme_id'];
        $data['single_theme'] = $this->activity_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
    } else {
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
    }
    // Load common things here
    $data['sub_view'] = 'activity/activity_theme';
    //print_r($data['sub_view']);exit;
    $this->load->view('_layout_main',$data);
}

public function set_theme_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->activity_theme->set_theme_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Theme is now '.$msg);
    redirect('activity/activity_theme', 'refresh'); 
}

public function do_upload_old(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    if(!empty($day_count)){
        // if($table_name=='activity_itinerary_images'){
        //     $city_id = $this->input->post('city_id');
        //     $imgpath = 'uploads/supp_id/activity/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        //     $uploadpath = $this->upload_path.'supp_id/activity/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // } else {
            $imgpath = 'uploads/activity/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.'activity/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // }
        
    } else {
        if($table_name=='activity_packages' || $table_name=='activity_package_images'){
            $tablepath = 'activity_package_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'uploads/activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    }
    // echo '<pre>';print_r($uploadpath);
    // if($this->input->post('submit')){
        $config['upload_path'] = $uploadpath;
        $config['allowed_types'] = 'gif|jpg|png';
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
            // echo '<pre>';print_r($data['upload_data']);exit;
            // $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
            $total_files = count($data['upload_data']);

            if($upload_type == 'insert'){
                $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count);
            }
            $temp_images = array();
            foreach($data['upload_data'] as $imgfile) {
                //echo '<pre>11 ';print_r($imgfile['file_name']);//exit;
                if($upload_type == 'custom_insert'){
                    $temp_images[] = $imgpath.$imgfile['file_name'];
                } else {
                    $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count);
                }
            }
            if($upload_type == 'custom_insert'){
                $images = implode(',', $temp_images);
                $insert_id = $this->Upload_Model->custom_upload_images($table_name,$column_name,$upload_type,$images);
                echo json_encode(array(
                    'total_files' => 1,
                    'insert_id' => $insert_id
                ));
            } else{
                echo json_encode(array('total_files' => $total_files));
            }
            // echo '<pre>kk';print_r($insert_id);exit;
        } else {
            $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
            // foreach($errors as $k => $error){
            //     echo $error;
            // }
        }
    // } else {
    //     echo '<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>An error occured, please try again later.</div>';
    // }
    // Exit to avoid further execution
    exit();
}

public function do_upload(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    if(!empty($day_count)){
        $imgpath = 'supplier/uploads/activity/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'activity/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';     
    } else {
        if($table_name=='activity_packages' || $table_name=='activity_package_images'){
            $tablepath = 'activity_package_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'supplier/uploads/activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    }
    $config['upload_path'] = 'uploads';
    // $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png';
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
        // $total_files = count($data['upload_data']);

        if($upload_type == 'insert'){
            $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count);
        }
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
            //echo '<pre>11 ';print_r($imgfile['file_name']);//exit;
            $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count);

            s3Upload($imgpath.$imgfile['file_name'],'uploads');
        }
        // echo json_encode(array('total_files' => $total_files));
        echo $success_msg;
        
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function custom_upload($insert_id,$post,$to_do){
    // echo '<pre>';print_r($post);exit;
    $supplier_id = $this->supplier_id;
    $id = $insert_id;
    $unique_id = $post['unique_id'];
    $controller = $post['controller'];
    $table_name = $post['table_name'];
    $column_name = $post['column_name'];
    $img_type = $post['img_type'];
    $upload_type = $post['upload_type'];

    $tablepath = $table_name;

    // $imgpath = 'uploads/'.$supplier_id.'/activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    // $uploadpath = $this->upload_path.'activity/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        
    $imgpath = 'supplier/uploads/'.$supplier_id.'/'.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    
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
    // echo '<pre>11 ';print_r($post);exit;
    if($this->upload->do_multi_upload("uploadfile")){
        // echo '<pre>11 ';print_r($post);exit;
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $total_files = count($data['upload_data']);

        // echo '<pre>11 ';print_r($data['upload_data']);exit;

        if($upload_type == 'insert'){
            $this->Upload_Model->delete_first($id,$unique_id,$table_name);
        }
        foreach($data['upload_data'] as $imgfile) {
            // echo '<pre>11 ';print_r($imgfile['file_name']);exit;
            $this->Upload_Model->custom_upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$supplier_id);

            s3Upload($imgpath.$imgfile['file_name'],'uploads');
        }
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
    }
    if($to_do == 'update'){
        $this->session->set_flashdata('message','Updated successfully!');
        redirect('activity/add_accomodation?id='.$id, 'refresh');
    } else if($to_do == 'insert'){
        $this->session->set_flashdata('message','Added successfully!');
        redirect('activity/add_accomodation', 'refresh');
    } else {
        // echo $to_do;exit;
    }
}


public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    delete_s3_file($img_url);
    // unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
}

public function order_location(){
    $list = $this->input->post('list');
    // echo '<pre>';print_r($list);//exit;
    $loc = '';
    for($i=0;$i<count($list)-1;$i++){
        $loc .= '<div class="row trans_row"><div class="col-sm-12"><div class="col-sm-3">';
        $loc .= '<div class="col-sm-5">'.$list[$i]['location'].'<input type="hidden" name="location_from[]" value="'.$list[$i]['id'].'"></div><div class="col-sm-2">→</div><div class="col-sm-5"><input type="hidden" name="location_to[]" value="'.$list[$i+1]['id'].'">'.$list[$i+1]['location'].'</div>';
        $loc .= '</div><div class="col-sm-3"><select name="transport_type[]" class="form-control">
                    <option value="Flight">Flight</option>
                    <option value="Bus">Bus</option>
                    <option value="Train">Train</option>
                    <option value="Ship">Ship</option>
                </select>';
        $loc .= '</div></div></div>';
        // echo '<pre>';print_r($li->location);
    }
    // print_r($li['location']);

    echo json_encode(array('location' => $loc));
}

public function add_rates() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['rates_info'] = $this->activity_packages->get('activity_code,activity_name,accomodation_type',$package_id);
    $data['currency'] = $this->currency->get('currency_id,currency_code');  

    $data['edit_rates_pack'] = $edit_rates_pack = $this->activity_rates->get_rates_pack($package_id);
    if(empty($edit_rates_pack)){
        $data['sub_view'] = 'activity/add_rates';
    } else {
        $data['edit_rates'] = $this->activity_rates->get_rates($package_id);
        $data['economy_rates'] = $this->activity_rates->get_economy_rates($package_id);
        $data['superior_rates'] = $this->activity_rates->get_superior_rates($package_id);
        $data['first_class_rates'] = $this->activity_rates->get_first_class_rates($package_id);
        $data['luxury_rates'] = $this->activity_rates->get_luxury_rates($package_id);
        $data['sub_view'] = 'activity/edit_rates';
    }
    $this->load->view('_layout_main',$data);
}
public function update_rates() {
    // echo '<pre>';print_r($_POST);exit;
    $package_id = $this->input->post('package_id');
    $economy = $this->input->post('economy');
    $superior = $this->input->post('superior');
    $first_class = $this->input->post('first_class');
    $luxury = $this->input->post('luxury');
    $currency = $this->input->post('currency');
    $total_day = $this->input->post('total_day');
    $day_count = $this->input->post('counter');
    $counter = count($this->input->post('counter'));
    $validity = $this->input->post('validity');
    $validity_from = $validity_to = [];
    for($v=0;$v<count($validity);$v++) {
        $valid = explode(' - ', $validity[$v]);
        $validity_from[] = date('Y-m-d', strtotime(str_replace('/', '-', $valid[0])));
        $validity_to[] = date('Y-m-d', strtotime(str_replace('/', '-', $valid[1])));
    }
    // echo '<pre>';print_r($datefrm);//exit;
    // echo '<pre>';print_r($validity_from);//exit;
    // echo '<pre>';print_r($validity_to);exit;
    $this->activity_rates->delete($package_id);
    $this->activity_rates->delete_in_packages($package_id);

    if(!empty($economy)){
        $economy_adults_two = $this->input->post('economy_adults_two');
        $economy_adults_four = $this->input->post('economy_adults_four');
        $economy_adults_six = $this->input->post('economy_adults_six');
        $economy_adults_eight = $this->input->post('economy_adults_eight');
        $economy_adults_ten = $this->input->post('economy_adults_ten');
        $economy_single_suppliment = $this->input->post('economy_single_suppliment');
        $economy_triple_sharing = $this->input->post('economy_triple_sharing');
        $economy_child_withbed = $this->input->post('economy_child_withbed');
        $economy_child_withoutbed = $this->input->post('economy_child_withoutbed');

        $economy_transfer = $this->input->post('economy_transfer');
        $economy_activity = $this->input->post('economy_activity');
        $economy_hotel_rating = $this->input->post('economy_hotel_rating');

        for($r=0; $r<$counter;$r++){
            $economy_data = array(
                'package_id' => $package_id,
                'total_day' => $total_day,
                'day_count' => $day_count[$r],
                'currency' => $currency[$r],
                'validity' => $validity[$r],
                'validity_from' => $validity_from[$r],
                'validity_to' => $validity_to[$r],
                'accomodation_type' => $economy,
                'adults_two' => $economy_adults_two[$r],
                'adults_four' => $economy_adults_four[$r],
                'adults_six' => $economy_adults_six[$r],
                'adults_eight' => $economy_adults_eight[$r],
                'adults_ten' => $economy_adults_ten[$r],
                'single_suppliment' => $economy_single_suppliment[$r],
                'triple_sharing' => $economy_triple_sharing[$r],
                'child_withbed' => $economy_child_withbed[$r],
                'child_withoutbed' => $economy_child_withoutbed[$r],
            );
            $this->activity_rates->insert($economy_data);
        }
        $economy_data2 = array(
            'package_id' => $package_id,
            'transfer' => $economy_transfer,
            'activity' => $economy_activity,
            'hotel_rating' => $economy_hotel_rating,
            'accomodation_type' => $economy,
        );
        $this->activity_rates->insert_in_packages($economy_data2);
    }

    if(!empty($superior)){
        $superior_adults_two = $this->input->post('superior_adults_two');
        $superior_adults_four = $this->input->post('superior_adults_four');
        $superior_adults_six = $this->input->post('superior_adults_six');
        $superior_adults_eight = $this->input->post('superior_adults_eight');
        $superior_adults_ten = $this->input->post('superior_adults_ten');
        $superior_single_suppliment = $this->input->post('superior_single_suppliment');
        $superior_triple_sharing = $this->input->post('superior_triple_sharing');
        $superior_child_withbed = $this->input->post('superior_child_withbed');
        $superior_child_withoutbed = $this->input->post('superior_child_withoutbed');

        $superior_transfer = $this->input->post('superior_transfer');
        $superior_activity = $this->input->post('superior_activity');
        $superior_hotel_rating = $this->input->post('superior_hotel_rating');

        for($s=0; $s<$counter;$s++){
            $superior_data = array(
                'package_id' => $package_id,
                'day_count' => $day_count[$s],
                'total_day' => $total_day,
                'currency' => $currency[$s],
                'validity' => $validity[$s],
                'validity_from' => $validity_from[$s],
                'validity_to' => $validity_to[$s],
                'accomodation_type' => $superior,
                'adults_two' => $superior_adults_two[$s],
                'adults_four' => $superior_adults_four[$s],
                'adults_six' => $superior_adults_six[$s],
                'adults_eight' => $superior_adults_eight[$s],
                'adults_ten' => $superior_adults_ten[$s],
                'single_suppliment' => $superior_single_suppliment[$s],
                'triple_sharing' => $superior_triple_sharing[$s],
                'child_withbed' => $superior_child_withbed[$s],
                'child_withoutbed' => $superior_child_withoutbed[$s],
            );
            $this->activity_rates->insert($superior_data);
        }
        
        $superior_data2 = array(
            'package_id' => $package_id,
            'transfer' => $superior_transfer,
            'activity' => $superior_activity,
            'hotel_rating' => $superior_hotel_rating,
            'accomodation_type' => $superior,
        );
        $this->activity_rates->insert_in_packages($superior_data2);
    }

    if(!empty($first_class)){
        $first_class_adults_two = $this->input->post('first_class_adults_two');
        $first_class_adults_four = $this->input->post('first_class_adults_four');
        $first_class_adults_six = $this->input->post('first_class_adults_six');
        $first_class_adults_eight = $this->input->post('first_class_adults_eight');
        $first_class_adults_ten = $this->input->post('first_class_adults_ten');
        $first_class_single_suppliment = $this->input->post('first_class_single_suppliment');
        $first_class_triple_sharing = $this->input->post('first_class_triple_sharing');
        $first_class_child_withbed = $this->input->post('first_class_child_withbed');
        $first_class_child_withoutbed = $this->input->post('first_class_child_withoutbed');

        $first_class_transfer = $this->input->post('first_class_transfer');
        $first_class_activity = $this->input->post('first_class_activity');
        $first_class_hotel_rating = $this->input->post('first_class_hotel_rating');

        for($f=0; $f<$counter;$f++){
            $first_class_data = array(
                'package_id' => $package_id,
                'total_day' => $total_day,
                'day_count' => $day_count[$f],
                'currency' => $currency[$f],
                'validity' => $validity[$f],
                'validity_from' => $validity_from[$f],
                'validity_to' => $validity_to[$f],
                'accomodation_type' => $first_class,
                'adults_two' => $first_class_adults_two[$f],
                'adults_four' => $first_class_adults_four[$f],
                'adults_six' => $first_class_adults_six[$f],
                'adults_eight' => $first_class_adults_eight[$f],
                'adults_ten' => $first_class_adults_ten[$f],
                'single_suppliment' => $first_class_single_suppliment[$f],
                'triple_sharing' => $first_class_triple_sharing[$f],
                'child_withbed' => $first_class_child_withbed[$f],
                'child_withoutbed' => $first_class_child_withoutbed[$f],
            );
            $this->activity_rates->insert($first_class_data);
        }
        
        $first_class_data2 = array(
            'package_id' => $package_id,
            'transfer' => $first_class_transfer,
            'activity' => $first_class_activity,
            'hotel_rating' => $first_class_hotel_rating,
            'accomodation_type' => $first_class,
        );
        $this->activity_rates->insert_in_packages($first_class_data2);
    }

    if(!empty($luxury)){
        $luxury_adults_two = $this->input->post('luxury_adults_two');
        $luxury_adults_four = $this->input->post('luxury_adults_four');
        $luxury_adults_six = $this->input->post('luxury_adults_six');
        $luxury_adults_eight = $this->input->post('luxury_adults_eight');
        $luxury_adults_ten = $this->input->post('luxury_adults_ten');
        $luxury_single_suppliment = $this->input->post('luxury_single_suppliment');
        $luxury_triple_sharing = $this->input->post('luxury_triple_sharing');
        $luxury_child_withbed = $this->input->post('luxury_child_withbed');
        $luxury_child_withoutbed = $this->input->post('luxury_child_withoutbed');

        $luxury_transfer = $this->input->post('luxury_transfer');
        $luxury_activity = $this->input->post('luxury_activity');
        $luxury_hotel_rating = $this->input->post('luxury_hotel_rating');

        for($l=0; $l<$counter;$l++){
            $luxury_data = array(
                'package_id' => $package_id,
                'day_count' => $day_count[$l],
                'total_day' => $total_day,
                'currency' => $currency[$l],
                'validity' => $validity[$l],
                'validity_from' => $validity_from[$l],
                'validity_to' => $validity_to[$l],
                'accomodation_type' => $luxury,
                'adults_two' => $luxury_adults_two[$l],
                'adults_four' => $luxury_adults_four[$l],
                'adults_six' => $luxury_adults_six[$l],
                'adults_eight' => $luxury_adults_eight[$l],
                'adults_ten' => $luxury_adults_ten[$l],
                'single_suppliment' => $luxury_single_suppliment[$l],
                'triple_sharing' => $luxury_triple_sharing[$l],
                'child_withbed' => $luxury_child_withbed[$l],
                'child_withoutbed' => $luxury_child_withoutbed[$l],
            );
            $this->activity_rates->insert($luxury_data);
        } 

        $luxury_data2 = array(
            'package_id' => $package_id,
            'transfer' => $luxury_transfer,
            'activity' => $luxury_activity,
            'hotel_rating' => $luxury_hotel_rating,
            'accomodation_type' => $luxury,
        );
        $this->activity_rates->insert_in_packages($luxury_data2);
    }

    $this->session->set_flashdata('message','Rate Added successfully!');
    redirect('activity/add_rates?id='.$package_id, 'refresh');

}

public function add_accomodation() {
    // echo '<pre>';print_r($_GET);exit;
    $accomodation_id = $_REQUEST['id'];
    if(!empty($accomodation_id)){
        $data['accomodation_id'] = $accomodation_id;
        $data['edit_accomodation'] = $this->activity_accomodation->get_single($accomodation_id);
    }
    $data['accomodation_info'] = $this->activity_accomodation->get_only_supplier('*',$this->supplier_id);

    $data['gallery_img'] = $this->Upload_Model->get_images($accomodation_id,'accomodation_images','*','accomodation_id',$this->supplier_id);

    $data['activity_city'] = $this->activity_city->get_active('city_id,city_name');
    $data['sub_view'] = 'activity/add_accomodation';
    $this->load->view('_layout_main',$data);
}

public function submit_accomodation() {
    // echo '<pre>';print_r($_POST);exit;
    $supplier_id = $this->supplier_id;
    $accomodation_id = $this->input->post('accomodation_id');
    $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
    $this->form_validation->set_rules('hotel_city', 'Hotel City', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $data['activity_city'] = $this->activity_city->get_active('city_id,city_name');
        $data['sub_view'] = 'activity/add_accomodation';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'supplier_id' => $supplier_id,
            'hotel_name' => $this->input->post('hotel_name'),
            'hotel_city' => $this->input->post('hotel_city'),
            'description' => $this->input->post('description'),
            'contact_no' => $this->input->post('contact_no'),
            'address' => $this->input->post('address'),
            'accomodation_type' =>implode(',', $this->input->post('accomodation_type')),
        );
        if(!empty($accomodation_id)){
            $this->activity_accomodation->update($data, $accomodation_id);
            $insert_id = $accomodation_id;
            $to_do = 'update';
        } else {
            $insert_id = $this->activity_accomodation->insert($data);
            $to_do = 'insert';
        }
        $add_meta = trim($_POST['add_meta']);
        if($add_meta == 1){
            $to_do = 'add_meta';
        }
        // echo '<pre>11';print_r($to_do);exit;
        $this->custom_upload($insert_id,$_POST,$to_do);
        // exit;
        if($add_meta == '1'){
            // $meta_type = trim($_POST['meta_type']);
            $result = $this->activity_accomodation->get_only_supplier('id,hotel_name',$this->supplier_id);
            // echo '<pre>11';print_r($result);exit;
            $options .= '';
            foreach($result as $val) {
                $options .= '<option value="'.$val->id.'">'.$val->hotel_name.'</option>';
            }
            // echo '<pre>'; print_r($options);exit;

            echo json_encode(array(
                'meta_option' => $options,
                // 'meta_type' => $meta_type
            ));

        } else {
            $this->session->set_flashdata('message','Hotel Added successfully!');
            redirect('activity/add_accomodation', 'refresh');
        }
    }
}

public function set_acc_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->activity_accomodation->set_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Accomodation is now '.$msg);
    redirect('activity/add_accomodation', 'refresh'); 
}

public function update_route($package_id) {
    $this->load->model('transportation_mode');
    $this->transportation_mode->update_transportation_mode($package_id);
}

public function demo_add_routes() {
    $data['sub_view'] = 'activity/route_demo';
    $this->load->view('_layout_main',$data);
}
public function demo_view_routes() {
    // echo '<pre>'; print_r($_POST);exit;
    $data['routes'] = $_POST;
    $data['sub_view'] = 'activity/route_map_demo';
    $this->load->view('_layout_main',$data);
}

public function add_transport_mode() {
    // echo '<pre>'; print_r($_POST);exit;
    // transport_metadata
    $data = array(
        'transport_name' => $this->input->post('transport_name'),
    );
    $this->load->model('transport_metadata');
    $this->transport_metadata->insert($data);
    $result = $this->transport_metadata->get();
    $options .= '<option value="">None</option>';
    foreach($result as $val) {
        $options .= '<option value="'.$val->transport_name.'">'.$val->transport_name.'</option>';
    }
    // echo '<pre>'; print_r($options);exit;

    echo json_encode(array('transoptions' => $options));
}

public function add_closed_rasons() {
    // echo '<pre>'; print_r($_POST);exit;
    // closed_reason_metadata
    $data = array(
        'closed_reason' => $this->input->post('closed_reason'),
    );
    $this->load->model('closed_reason_metadata');
    $this->closed_reason_metadata->insert($data);
    $result = $this->closed_reason_metadata->get();
    // $package_info = $this->activity_packages->get('closed_reason',$package_id);
    // $close_reason = explode('||',$package_info->closed_reason);
    // $selected = '';
    
    $options .= '<option value="">Select Reason</option>';
    foreach($result as $val) {
        $options .= '<option value="'.$val->closed_reason.'">'.$val->closed_reason.'</option>';
    }
    // echo '<pre>'; print_r($options);exit;

    echo json_encode(array('closed_reasons' => $options));
}


}


