<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class holiday extends CI_CONTROLLER {

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
    $this->load->model('holiday_packages');
    $this->load->model('holiday_theme');
    $this->load->model('holiday_activity');
    $this->load->model('holiday_attraction');
    $this->load->model('holiday_itinerary');
    $this->load->model('holiday_city');
    $this->load->model('holiday_country');
    $this->load->model('Upload_Model');
    $this->load->model('holiday_accomodation');
    $this->load->model('holiday_rates');
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
        
        if($tMod == false){
            redirect('home/index');
        }
    }
}
public function holiday_list() {
    $fields = 'id,supplier_id,holiday_type,package_title,package_code,destination,status,start_date,end_date';
    $data['packages'] = $packages = $this->holiday_packages->get_only_supplier($fields,$this->supplier_id);
    $data['holiday_city'] = $this->holiday_city->get_active('city_id,city_name,country_id');
    // echo '<pre>';print_r($data['packages']);exit;
    $data['sub_view'] = 'holiday/holiday_list';
    $this->load->view('_layout_main',$data);
}
public function get_active_packages(){
    $packages = $this->holiday_packages->get_active_packages();
    // echo '{"data":'.json_encode($packages).'}';
}
public function add_holiday() {
    $data['theme'] = $this->holiday_theme->get_active_themes();
    $city_fields = 'city_id,city_name,country_id';
    $data['holiday_city'] = $this->holiday_city->get_active($city_fields);
    $data['currency'] = $this->currency->get('*');
    $data['holiday_packages'] = $this->holiday_packages->get_active_supplier('id,package_title,status',$this->supplier_id);
    $this->load->model('closed_reason_metadata');
    $data['closedReasons'] = $this->closed_reason_metadata->get();
    // echo '<pre>';print_r($data['holiday_city']);exit;

    $data['sub_view'] = 'holiday/add_holiday';
    $this->load->view('_layout_main',$data);
}

public function duplicateTours(){
    // echo '<pre>';print_r($_POST);//exit;
    $cityids = isset($_POST['cityid'])?$this->input->post('cityid'):'';
    $package_id = isset($_POST['package_id'])?$this->input->post('package_id'):'';
    $package_code = isset($_POST['package_code'])?$this->input->post('package_code'):'';
    $flag = '';
    if($cityids !='' && $package_id !='' && $package_code !=''){
        foreach($cityids as $cityid){
            $where = array(
                'supplier_id'=>$this->supplier_id,
                'package_code'=>$package_code,
                'id'=>$package_id
            );
            $holidays = $this->holiday_packages->get_data('*',$where,1,'array');
            // echo '<pre>';print_r($cityid);//exit;
            $orgcityid = $holidays['destination'];
            if($cityid != $orgcityid){
                // unset($holidays['supplier_holiday_list_id']);
                $citylist = $this->holiday_city->get_data('state_id,country_id',array('city_id'=>$cityid),1);
                $countrylist = $this->holiday_country->get_data('continent_id',array('country_id'=>$citylist->country_id),1);
                $data = array(
                    'id' => '',
                    'continent' => $countrylist->continent_id,
                    'country' => $citylist->country_id,
                    'state' => $citylist->state_id,
                    'destination' => $cityid,
                );
                $holidayinsert = array_merge($holidays,$data);
                // echo '<pre>';print_r($holidayinsert);//exit;
                $insert_id = $this->holiday_packages->insert($holidayinsert);
                if($insert_id != ''){
                    $holiday_activity = $this->holiday_activity->get_data('*',array('activity_code'=>$package_code,'holiday_id'=>$package_id),0,'array');
                    foreach ($holiday_activity as $act) {
                        $activty_data = array(
                            'id' => '',
                            'holiday_id' => $insert_id,
                        );
                        $actinsert = array_merge($act,$activty_data);
                        // echo '<pre>';print_r($actinsert);//exit;
                        $this->holiday_activity->add_holiday_activity($actinsert);
                    }
                   
                    $flag = 'success';
                    unset($holidays);
                    unset($data);
                    unset($holidayinsert);
                    unset($actinsert);
                    unset($holiday_activity);
                    unset($activty_data);
                }
            }  
        }
    }
    if($flag == ''){
        $this->session->set_flashdata('error','Please try again');
    } else {
        $this->session->set_flashdata('message','Duplication completed!');
    }
    redirect('holiday/holiday_list', 'refresh');
}

public function save_holiday_step1($check_insert='') {
    // $this->form_validation->set_rules('holiday_type', 'Holiday Type', 'trim|required');
    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    $this->form_validation->set_rules('holiday_code', 'Holiday ID', 'trim|required');
    $this->form_validation->set_rules('desti', 'Destination', 'trim|required');

    if($this->form_validation->run()==FALSE) {
        echo json_encode(array(
            'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
            'validation_status' => true,
            'insert_id' => $check_insert,
        ));
    } else {
        $dates = explode(' - ', $this->input->post('package_validity'));
        $data = array(
            'supplier_id' =>$this->supplier_id,
            'package_title' =>$this->input->post('holiday_name'),
            'package_code' =>$this->input->post('holiday_code'),
            'destination' =>$this->input->post('desti'),
            'theme_id' =>implode(',', $this->input->post('themes')),
            'short_desc' =>$this->input->post('short_desc'),
            'package_rating' =>$this->input->post('star_rating'),
            'start_date' =>$dates[0],
            'end_date' =>$dates[1],
            'minChildAge' =>$this->input->post('minChildAge'),
            'maxChildAge' =>$this->input->post('maxChildAge'),
            'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'discount_type' =>$this->input->post('discount_type'),
            'discount_price' =>$this->input->post('discount_price'),
            // 'operation_day' =>implode(',', $this->input->post('operation_day')),
            // 'closed_dates' =>implode('|', $this->input->post('closed_dates')),
            // 'closed_reason' =>implode('||', $this->input->post('closed_reason')),
            'currency_code' =>$this->input->post('currency_code'),
            'price' =>$this->input->post('pp_price'),
            'reservation_email' =>$this->input->post('reservation_email'),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            'duration' =>$this->input->post('duration'),
        );
        // $check_insert = $this->input->post('insert_id');
        if($check_insert == ''){
            $insert_id = $this->holiday_packages->insert_holiday_packages($data);
        } else{
            $insert_id = $check_insert;
            $this->holiday_packages->update($data, $insert_id);
        }
        $this->session->set_flashdata('message','Step 1 Completed!');
        // echo '<pre>';print_r($insert_id);exit;
        echo json_encode(array('insert_id' => $insert_id));
    }
}

public function set_package_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->holiday_packages->set_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Package is now '.$msg);
    redirect('holiday/holiday_list', 'refresh'); 
}
public function edit_holiday() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['theme'] = $this->holiday_theme->get_active_themes();
    // echo '<pre>';print_r($data['theme']);exit;
    $city_fields = 'city_id,city_name,country_id';
    $data['holiday_city'] = $this->holiday_city->get_active($city_fields);
    $data['currency'] = $this->currency->get('*');

    $data['package_info'] = $package_info = $this->holiday_packages->get('*',$package_id);
    // echo '<pre>';print_r($data['package_info']);exit;
    $this->load->model('closed_reason_metadata');
    $data['closedReasons'] = $this->closed_reason_metadata->get();
    $data['sub_view'] = 'holiday/edit_holiday';
    $this->load->view('_layout_main',$data);
}
public function edit_step2() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'package_desc,highlights,package_title,package_code';
    $data['package_info'] = $this->holiday_packages->get($fields,$package_id);

    $data['sub_view'] = 'holiday/edit_step2';
    $this->load->view('_layout_main',$data);
}
public function edit_step3() {
    $data['package_id'] = $package_id = $_GET['id'];

    $data['holiday_activity'] = $holiday_activity = $this->holiday_activity->get_activity('*',$package_id);
    if(!empty($holiday_activity)){
        $data['total_acti'] = count($holiday_activity);
    } else {
         $data['total_acti'] = 1;
    }
    $data['package_info'] = $this->holiday_packages->get('package_title,package_code,duration',$package_id);
    // $data['gallery_img'] = $this->Upload_Model->get_images($package_id,'holiday_activity_images','*','package_id',$this->supplier_id);

    $data['sub_view'] = 'holiday/edit_step3';
    $this->load->view('_layout_main',$data);
}
public function edit_step4() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'inclusion,exclusion,package_title,package_code';
    $data['package_info'] = $this->holiday_packages->get($fields,$package_id);
    $data['holiday_packages'] = $this->holiday_packages->get_active_supplier('id,package_title,status',$this->supplier_id);
    // echo '<pre>';print_r($data['holiday_packages']);exit;
    $data['sub_view'] = 'holiday/edit_step4';
    $this->load->view('_layout_main',$data);
}
public function edit_step5() {
    $data['package_id'] = $package_id = $_GET['id'];
    $fields = 'terms,package_good,things_to_bring,package_title,package_code,policy,child_policy,cancellation_policy,photo_policy,rate_desc';
    $data['package_info'] = $package_info = $this->holiday_packages->get($fields,$package_id);
    $data['currency'] = $this->currency->get('currency_id,currency_code');
    $data['sub_view'] = 'holiday/edit_step5';
    $this->load->view('_layout_main',$data);
}
public function edit_step6() {
    $data['package_id'] = $package_id = $_GET['id'];
    $data['previous_id'] = $previous_id = isset($_GET['prev_id'])?$_GET['prev_id']:'';
    // $data['package_info'] = $this->holiday_packages->get('duration,package_title,package_code',$package_id);

    $data['packages'] = $this->holiday_packages->getPackagesNotThisId($package_id,$this->supplier_id);

    $this->load->model('meeting_points');
    if($previous_id != ''){
      $data['meeting_points'] = $this->meeting_points->get_meeting_points($previous_id);  
    } else {
        $data['meeting_points'] = $this->meeting_points->get_meeting_points($package_id);
    }
    
    if(!empty($data['meeting_points'])){
        $data['total_points'] = count($data['meeting_points']);
    } else{
         $data['total_points'] = 1;
    }
    // echo '<pre>';print_r($data['route_info2']);exit;

    $data['sub_view'] = 'holiday/edit_step6';
    $this->load->view('_layout_main',$data);
}

public function edit_step7() {
    $data['package_id'] = $package_id = $_GET['id'];
    
    $data['thumb_img'] = $this->holiday_packages->get('thumb_img',$package_id);
    $data['gallery_img'] = $this->holiday_packages->get_holi_images($package_id,$this->supplier_id);

    // $data['pkg_accomodation'] = $this->holiday_packages->get_only_supplier('id,hotelaccomodation',$this->supplier_id,$package_id);
    $data['package_info'] = $this->holiday_packages->get('package_title,package_code',$package_id);
    // $data['accomodation_info'] = $this->holiday_accomodation->get_only_supplier('id,hotel_name',$this->supplier_id);
    // echo '<pre>';print_r($data['gallery_img']);exit;
    $data['sub_view'] = 'holiday/edit_step7';
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
            redirect('holiday/edit_step2?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_holiday?id='.$package_id, 'refresh');
        }
        
    } elseif ($step_no == 2) {
        $this->update_step2($package_id);
        if($todo == 1){
            redirect('holiday/edit_step3?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step2?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 3) {
        $this->update_step3($package_id);
        if($todo == 1){
            redirect('holiday/edit_step4?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step3?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 4) {
        $this->update_step4($package_id);
        if($todo == 1){
            redirect('holiday/edit_step5?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step4?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 5) {
        $this->update_step5($package_id);
        if($todo == 1){
            redirect('holiday/edit_step6?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step5?id='.$package_id, 'refresh');
        }
    } elseif ($step_no == 6) {
        $this->update_step6($package_id);
        if($todo == 1){
            redirect('holiday/edit_step7?id='.$package_id, 'refresh');
        } else {
            redirect('holiday/edit_step6?id='.$package_id, 'refresh');
        }
    } else{
        $this->update_step7($package_id);
        redirect('holiday/holiday_list', 'refresh');
    }
}

public function update_step1($package_id){
    // $this->form_validation->set_rules('holiday_type', 'Holiday Type', 'trim|required');
    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    $this->form_validation->set_rules('desti', 'Destination', 'trim|required');
    // $this->form_validation->set_rules('holiday_code', 'Holiday ID', 'trim|required|is_unique[holiday_packages.package_code]');
    $this->form_validation->set_rules('holiday_code', 'Holiday ID', 'trim|required');
    if($this->form_validation->run()==FALSE) {
        $data['sub_view'] = 'holiday/edit_holiday';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $dates = explode(' - ', $this->input->post('package_validity'));
        // $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $dates[0])));
        // $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $dates[1])));
        $data = array(
            // 'holiday_type' =>$this->input->post('holiday_type'),
            'package_title' =>$this->input->post('holiday_name'),
            'package_code' =>$this->input->post('holiday_code'),
            'destination' =>$this->input->post('desti'),
            'theme_id' =>implode(',', $this->input->post('themes')),
            'short_desc' =>$this->input->post('short_desc'),
            'package_rating' =>$this->input->post('star_rating'),
            'start_date' =>$dates[0],
            'end_date' =>$dates[1],
            'minChildAge' =>$this->input->post('minChildAge'),
            'maxChildAge' =>$this->input->post('maxChildAge'),
            'minAdultAge' =>$this->input->post('minAdultAge'),
            'minPaxOperating' =>$this->input->post('minPaxOperating'),
            'maxPaxOperating' =>$this->input->post('maxPaxOperating'),
            'child_allowed' =>$this->input->post('child_allowed'),
            'discount_type' =>$this->input->post('discount_type'),
            'discount_price' =>$this->input->post('discount_price'),
            // 'operation_day' =>implode(',', $this->input->post('operation_day')),
            // 'closed_dates' =>implode('|', $this->input->post('closed_dates')),
            // 'closed_reason' =>implode('||', $this->input->post('closed_reason')),

            // 'departure_date' =>implode('|', $this->input->post('departure_date')),
            // 'city_covering' =>implode(',', $this->input->post('city_covering')),
            'currency_code' =>$this->input->post('currency_code'),
            'price' =>$this->input->post('pp_price'),
            // 'pick_up' =>implode(',', $this->input->post('pick_up')),
            // 'drop_off' =>implode(',', $this->input->post('drop_off')),
            'reservation_email' =>$this->input->post('reservation_email'),
            'operated_by' =>$this->input->post('operated_by'),
            'operator_no' =>$this->input->post('operator_no'),
            'emergency_no' =>$this->input->post('emergency_no'),
            // 'resevatoin_no' =>$this->input->post('resevatoin_no'),
            // 'product_manager_no' =>$this->input->post('product_manager_no'),
            'duration' =>$this->input->post('duration'),
        );
        // echo '<pre>';print_r($data);exit;
        $this->holiday_packages->update($data, $package_id);
        // echo '<pre>';print_r($this->db->last_query());exit;
        $this->session->set_flashdata('message','Step 1 Completed!');
    }
}

public function update_step2($package_id){
    $data = array(
        'package_desc' =>$this->input->post('overview'),
        'highlights' =>$this->input->post('highlights'),
    );
    $this->holiday_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 2 Completed!');
}
public function update_step3($package_id){
    // echo '<pre>';print_r($_POST);exit;
    $activity_code = $this->input->post('activity_code');
    $activity_name = $this->input->post('activity_name');
    $duration = $this->input->post('duration');
    $operating_hours = $this->input->post('operating_hours');
    $pickup_location = $this->input->post('pickup_location');
    $pickup_time = $this->input->post('pickup_time');
    $activity_description = $this->input->post('activity_description');
    $cancel_policy = $this->input->post('cancel_policy');
    $activity_child_cost = $this->input->post('activity_child_cost');
    $activity_adult_cost = $this->input->post('activity_adult_cost');
    $activity_senior_cost = $this->input->post('activity_senior_cost');
    $day_count = $this->input->post('activity_count');
    $this->holiday_activity->delete_activity($package_id);
    // echo '<pre>';print_r($this->db->last_query());exit;
    for($a=0;$a<count($activity_name);$a++){
        $data = array(
                'holiday_id' =>$package_id,
                'activity_code' =>$activity_code,
                'activity_title' =>$activity_name[$a],
                'duration' =>$duration[$a],
                'operating_hours' =>$operating_hours[$a],
                'pickup_location' =>$pickup_location[$a],
                'pickup_time' =>$pickup_time[$a],
                'activity_desc' =>$activity_description[$a],
                'cancel_policy' =>$cancel_policy[$a],
                'price_chd' =>$activity_child_cost[$a],
                'price_adt' =>$activity_adult_cost[$a],
                'price_sen' =>$activity_senior_cost[$a]
            );
        $this->holiday_activity->add_holiday_activity($data);
    }
    $this->session->set_flashdata('message','Step 3 Completed!');
}

public function update_step4($package_id){
    $data = array(
        'inclusion' =>$this->input->post('includes'),
        'exclusion' =>$this->input->post('excludes'),
    );
    $this->holiday_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 4 Completed!');
}

public function update_step5($package_id){
    $data = array(
        'package_good' =>$this->input->post('package_good'),
        'things_to_bring' =>$this->input->post('things_to_bring'),
        'policy' =>$this->input->post('policy'),
        'child_policy' =>$this->input->post('child_policy'),
        'cancellation_policy' =>$this->input->post('cancellation_policy'),
        'terms' =>$this->input->post('terms_and_condition'),
        'photo_policy' =>$this->input->post('photo_policy'),
        'rate_desc' =>$this->input->post('rate_desc')
    );
    $this->holiday_packages->update($data, $package_id);
    $this->session->set_flashdata('message','Step 5 Completed!');
}

public function update_step6($package_id){
    // echo '<pre>';print_r($_POST);exit;
    $pickup_location = $this->input->post('pickup_location');
    $latitude = $this->input->post('latitude');
    $longitude = $this->input->post('longitude');
    $pickup_type = $this->input->post('pickup_type');
    $pickup_time = $this->input->post('pickup_time');
    
    $this->load->model('meeting_points');
    $this->meeting_points->delete_meeting_points($package_id);
    for($a=0;$a<count($pickup_location);$a++){
        $data = array(
            'holiday_id' =>$package_id,
            'pickup_type' => $pickup_type[$a],
            'pickup_time' => $pickup_time[$a],
            'pickup_location' => $pickup_location[$a],
            'latitude' => $latitude[$a],
            'longitude' => $longitude[$a],
        );
        $this->meeting_points->add_meeting_points($data);
    }
    $this->session->set_flashdata('message','Step 6 Completed!');
}

public function update_step7($package_id){

    $this->session->set_flashdata('message','Package Completed Successfully!');
}

public function add_theme() {
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[holiday_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->holiday_theme->get_themes();
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
        // Load common things here
        $data['sub_view'] = 'holiday/holiday_theme';
        $data['error'] = 'It seems the theme you were adding is already present. Plese add another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->holiday_theme->insert_theme($data);
        $this->session->set_flashdata('message','Theme added successfully!');
        redirect('holiday/holiday_theme', 'refresh');
    }
}

public function edit_theme() {
    $theme_id = $_GET['theme_id'];
    $this->form_validation->set_rules('theme_name', 'Theme Name', 'trim|required|is_unique[holiday_theme.theme_name]');
    if($this->form_validation->run()==FALSE) {
        $data['theme_info'] = $this->holiday_theme->get_themes();
        $data['single_theme'] = $this->holiday_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
        // Load common things here
        $data['sub_view'] = 'holiday/holiday_theme';
        $data['error'] = 'It seems the theme you were updating is already present. Plese update to another one.';
        $this->load->view('_layout_main',$data);
    } else {
        $data = array(
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $this->holiday_theme->update_theme($data, $theme_id);
        $this->session->set_flashdata('message','Theme updated successfully!');
        redirect('holiday/holiday_theme', 'refresh');
    }
}

public function holiday_theme() {
    // error_reporting(E_ALL);
    $data['theme_info'] = $this->holiday_theme->get_themes();
    if(!empty($_GET['theme_id'])){
        $theme_id = $_GET['theme_id'];
        $data['single_theme'] = $this->holiday_theme->get_single_theme($theme_id);
        $data['action'] = 'edit_theme?theme_id='.$theme_id;
        $data['button'] = 'Update Theme';
    } else {
        $data['action'] = 'add_theme';
        $data['button'] = 'Add Theme';
    }
    // Load common things here
    $data['sub_view'] = 'holiday/holiday_theme';
    //print_r($data['sub_view']);exit;
    $this->load->view('_layout_main',$data);
}

public function set_theme_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->holiday_theme->set_theme_status($data,$id);
    if($status == 0){
        $msg = '<b style="color:#607d8b">Inactive</b>';
    } else {
        $msg = '<b style="color:#607d8b">Active</b>';
    }
    $this->session->set_flashdata('message','Theme is now '.$msg);
    redirect('holiday/holiday_theme', 'refresh'); 
}

public function sortImages(){
    // echo '<pre/>';print_r($_POST);//exit;
    if(isset($_POST['item']) && !empty($_POST['item']) && $_POST['package_id']!=''){
        $item = $this->input->post('item');
        $package_id = $this->input->post('package_id');

        $tempitem = $item;
        sort($tempitem);
        $temp = array();
        for($i=0;$i<count($item);$i++){
            $images = $this->holiday_packages->getTourImagesById($item[$i]);
            if(!empty($images)){
               $temp[$i] = $images;
               $temp[$i]->holi_image_id = $tempitem[$i];
               // unset($temp[$i]->holi_image_id);
            }
        }
        // echo '<pre/>';print_r($temp);exit;
        $delete = $this->holiday_packages->deleteTourImages($package_id);
        if($delete) {
            $this->holiday_packages->insertTourImages($temp);
        }
        echo '200';
    }
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
            $imgpath = 'supplier/uploads/holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';     
    } else {
        if($table_name=='holiday_packages' || $table_name=='holiday_images'){
            $tablepath = 'holiday_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'supplier/uploads/holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
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

    // $imgpath = 'uploads/'.$supplier_id.'/holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    // $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        
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
        redirect('holiday/add_accomodation?id='.$id, 'refresh');
    } else if($to_do == 'insert'){
        $this->session->set_flashdata('message','Added successfully!');
        redirect('holiday/add_accomodation', 'refresh');
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
    $this->holiday_packages->delete_images($img_id,$table_name);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
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
    // $package_info = $this->holiday_packages->get('closed_reason',$package_id);
    // $close_reason = explode('||',$package_info->closed_reason);
    // $selected = '';
    
    $options .= '<option value="">Select Reason</option>';
    foreach($result as $val) {
        $options .= '<option value="'.$val->closed_reason.'">'.$val->closed_reason.'</option>';
    }
    // echo '<pre>'; print_r($options);exit;

    echo json_encode(array('closed_reasons' => $options));
}

public function holiday_block_dates() {
    $fields = 'id,package_title';
    $data['holiday_list'] = $this->holiday_packages->get_only_supplier($fields,$this->supplier_id);
    $data['block_list'] = $this->holiday_packages->get_block_list($this->supplier_id);
    // echo '<pre>';print_r($data['holiday_list']);exit;
    $data['sub_view'] = 'holiday/holiday_block_dates';
    $this->load->view('_layout_main',$data);
}

public function add_holiday_block_dates() {
    // echo '<pre>';print_r($_POST);exit;
    $holiday_id = $_POST['holiday_id'];
    $activity_id = $_POST['activity_id'];
    $supplier_id = $this->supplier_id;
    $from_date = $_POST['from_date'];
    // $to_date = $_POST['to_date'];
    $blocking_reason = $_POST['blocking_reason'];
    $startdate = implode(',', $from_date);
    // $enddate = date("Y-m-d",strtotime($to_date));

    $insert_data = array(
        'holiday_id' => $holiday_id,
        'activity_id' => $activity_id,
        'from_date' => $startdate,
        // 'to_date' => '',
        'blocking_reason' => $blocking_reason,
        'supplier_id' => $supplier_id,
        'status' => 1
    );
    // echo '<pre>';print_r($insert_data);exit;
    $id = $this->input->post('id');
    if($id == ''){
        $this->holiday_packages->add_block_dates($insert_data);
    } else{
        $this->holiday_packages->update_block_dates($insert_data, $id);
        $this->session->set_flashdata('message','Updated succesfully!');
    }
    redirect('holiday/holiday_block_dates','refresh');
}

public function edit_block_date(){
    $data['block_id'] = $block_id =isset($_GET['id'])?$_GET['id']:'';
    // echo '<pre>';print_r($data['block_id']);exit;
    $fields = 'id,package_title';
    $data['holiday_list'] = $this->holiday_packages->get_only_supplier($fields,$this->supplier_id); 
    $data['block_list'] = $this->holiday_packages->get_block_list($this->supplier_id);
    $data['block_details'] = $this->holiday_packages->get_block_list_by_id($block_id,$this->supplier_id);
    // echo '<pre>';print_r($data['block_details']);exit;
    $data['sub_view'] = 'holiday/edit_block_dates';
    $this->load->view('_layout_main',$data);
}

public function delete_block_date(){
    $data['block_id'] = $block_id =isset($_GET['id'])?$_GET['id']:'';
    $this->holiday_packages->delete_block_date($block_id,$this->supplier_id);
    redirect('holiday/holiday_block_dates','refresh');
}

public function get_holiday_activities() {
    $holiday_id =isset($_POST['id'])?$_POST['id']:'';
    $activity_list = '';
    $options = '<option value="">Select Activity</option>';
    if($holiday_id != '') {
        $field = 'id,activity_title';
        $activity_list = $this->holiday_activity->get_activity($field,$holiday_id);
        if(!empty($activity_list)) {
           foreach($activity_list as $act) {
                $options .= '<option value="'.$act->id.'">'.$act->activity_title.'</option>';
            }
        }
    }
    echo $options;
    // echo '<pre>';print_r($options);exit;
}


}


