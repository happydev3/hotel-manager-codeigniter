<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class holidaydestination extends CI_CONTROLLER {

private $supplier_id;
private $max_image_size = '2000';
private $max_image_width = '1024';
private $max_image_height = '900';

function __construct() {
    parent :: __construct();
    $this->load->database();    
    $this->load->model('holiday_country');  
    $this->load->model('holiday_continent');
    $this->load->model('holiday_state');  
    $this->load->model('holiday_city');  
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    // $this->load->library('admin_auth');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
}
private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}

public function add_country() {
    $this->form_validation->set_rules('country_name', 'country Name', 'trim|required|is_unique[holiday_country.country_name]');
    if($this->form_validation->run()==FALSE) {        
        $errors_msg=validation_errors();
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/country');      
    } else {
        $data = array(
            'country_name' =>$this->input->post('country_name'), 
            'continent_id' =>$this->input->post('continent'),          
        );
        $this->holiday_country->insert($data);
        $this->session->set_flashdata('message','Country added successfully!');
        redirect('holidaydestination/country', 'refresh');
    }
}

public function edit_country() {
     // error_reporting(E_ALL);
    
    $country_id = $_GET['country_id'];
    if(empty($country_id)){
      redirect('holidaydestination/country', 'refresh');  
    }
    $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|is_unique[holiday_country.country_name]');
    $data['country_list'] = $this->holiday_country->get();
    $data['continent_list'] = $this->holiday_continent->get();
    $data['single_country'] = $this->holiday_country->get_single($country_id);
    $data['action'] = 'edit_country?country_id='.$country_id;
    $data['button'] = 'Update country';
    if($this->form_validation->run()==FALSE) { 
        // Load common things here
        $data['sub_view'] = 'holiday_destination/country';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
        $data = array( 
            'country_name' =>$this->input->post('country_name'), 
            'continent_id' =>$this->input->post('continent'),          
        );
        $this->holiday_country->update($data, $country_id);
        $this->session->set_flashdata('message','Country updated successfully!');
        redirect('holidaydestination/country', 'refresh');
    }
}

public function country() {
    // error_reporting(E_ALL);
    $data['country_list'] = $this->holiday_country->get();
    $data['continent_list'] = $this->holiday_continent->get();   
    if(!empty($_GET['country_id'])){
        $country_id = $_GET['country_id'];
        $data['single_country'] = $this->holiday_country->get_single($country_id);
        $data['action'] = 'edit_country?country_id='.$country_id;
        $data['button'] = 'Update Country';
    } else {
        $data['action'] = 'add_country';
        $data['button'] = 'Add Country';
    }
    // print_r($data); exit;
    // Load common things here
    $data['sub_view'] = 'holiday_destination/country';
    //print_r($data['sub_view']);exit;
    $this->load->view('_layout_main',$data);
}


//State
public function add_state() {
    $this->form_validation->set_rules('state_name', 'State Name', 'trim|required');
         $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
    if($this->form_validation->run()==FALSE) {    
     
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/state', 'refresh');
    } else {    
        
        $dataarray = array(
            'state_name' =>trim($this->input->post('state_name')), 
            'country_id' =>trim($this->input->post('country')),         
        );
         $check = $this->holiday_state->check($dataarray);
         // print_r($check); exit;
           if (!empty($check)) {
        $errors_msg= 'It seems the State you were adding is already present. Please add another one.';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/state', 'refresh');
           }
           else{
        $this->holiday_state->insert($dataarray);
        $this->session->set_flashdata('message','State added successfully!');
        redirect('holidaydestination/state', 'refresh');
    }
    }
}

public function edit_state() {  
    
    $state_id = $_GET['state_id'];
     if(empty($state_id)){
      redirect('holidaydestination/state', 'refresh');  
    }
    $this->form_validation->set_rules('state_name', 'State Name', 'trim|required');
       $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
       $data['country_list'] = $this->holiday_country->get();
        $data['state_list'] = $this->holiday_state->get();
        $data['single_state'] = $this->holiday_state->get_single($state_id);
        $data['action'] = 'edit_state?state_id='.$state_id;
        $data['button'] = 'Update State';
    if($this->form_validation->run()==FALSE) {  
      
        // Load common things here
        $data['sub_view'] = 'holiday_destination/state';
        $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
       
      $dataarray = array(
            'state_name' =>trim($this->input->post('state_name')), 
            'country_id' =>trim($this->input->post('country')),         
        );
         $check = $this->holiday_state->check($dataarray);
           if (!empty($check)) {
         $errors_msg= 'It seems the State you were updating is already present. Please update to another one.';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/edit_state?state_id='.$state_id, 'refresh');
           }
           else{
        $this->holiday_state->update($dataarray, $state_id);
        $this->session->set_flashdata('message','State updated successfully!');
        redirect('holidaydestination/state', 'refresh');
    }
    }
}

public function state() {
    // error_reporting(E_ALL);
    $data['country_list'] = $this->holiday_country->get();
    $data['state_list'] = $this->holiday_state->get();   
    if(!empty($_GET['state_id'])){
        $state_id = $_GET['state_id'];
        $data['single_state'] = $this->holiday_state->get_single($state_id);
        $data['action'] = 'edit_state?state_id='.$state_id;
        $data['button'] = 'Update State';
    } else {
        $data['action'] = 'add_state';
        $data['button'] = 'Add State';
    } 
    $data['sub_view'] = 'holiday_destination/state'; 
    $this->load->view('_layout_main',$data);
}

//City

public function add_city() {
    $this->form_validation->set_rules('city_name', 'City Name', 'trim|required');
    $this->form_validation->set_rules('state', 'State Name', 'trim|required');
    $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
    $data['country_list'] = $this->holiday_country->get();
    $data['state_list'] = $this->holiday_state->get();
    $data['city_list'] = $this->holiday_city->get();
    $data['action'] = 'add_city';
    $data['button'] = 'Add City';
    if($this->form_validation->run()==FALSE) {       
        // Load common things here
        $errors_msg = validation_errors();      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/city', 'refresh');
    } else {
         $dataarray = array(
            'city_name' =>trim($this->input->post('city_name')), 
            'state_id' =>trim($this->input->post('state')),
            'country_id' =>trim($this->input->post('country')),          
        );
         $check = $this->holiday_city->check($dataarray);
           if (!empty($check)) {
        $errors_msg = 'It seems the City you were adding is already present. Plese add another one.';      
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/city', 'refresh');      
         }
       else{
        $this->holiday_city->insert($dataarray);
        $this->session->set_flashdata('message','City added successfully!');
        redirect('holidaydestination/city', 'refresh');
    }
    }
}

public function edit_city() {
     // error_reporting(E_ALL);
    
    $city_id = $_GET['city_id'];
      if(empty($city_id)){
      redirect('holidaydestination/city', 'refresh');  
    }
     $this->form_validation->set_rules('city_name', 'City Name', 'trim|required');
    $this->form_validation->set_rules('state', 'State Name', 'trim|required');
    $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
    $data['country_list'] = $this->holiday_country->get();
    $data['state_list'] = $this->holiday_state->get();
    $data['city_list'] = $this->holiday_city->get();
    $data['single_city'] = $this->holiday_city->get_single($city_id);
    $data['action'] = 'edit_city?city_id='.$city_id;
    $data['button'] = 'Update City';
    if($this->form_validation->run()==FALSE) {
         $data['sub_view'] = 'holiday_destination/city';
         $data['error'] = validation_errors();
        $this->load->view('_layout_main',$data);
    } else {
       
        $dataarray = array(
            'city_name' =>trim($this->input->post('city_name')), 
            'state_id' =>trim($this->input->post('state')),
            'country_id' =>trim($this->input->post('country')),          
        );
         $check = $this->holiday_city->check($dataarray);
           if (!empty($check)) { 
      $errors_msg= 'It seems the City you were updating is already present. Plese update to another one.';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('holidaydestination/edit_city?city_id='.$city_id, 'refresh');       
           }
           else{
        $this->holiday_city->update($dataarray, $city_id);
        $this->session->set_flashdata('message','City updated successfully!');
        redirect('holidaydestination/city', 'refresh');
    }
    }
}

public function city() {
    // error_reporting(E_ALL);
    $data['country_list'] = $this->holiday_country->get();
    $data['state_list'] = $this->holiday_state->get(); 
    $data['city_list'] = $this->holiday_city->get();    
    if(!empty($_GET['city_id'])){
        $city_id = $_GET['city_id'];
        $data['single_city'] = $this->holiday_city->get_single($city_id);
        $data['action'] = 'edit_city?city_id='.$city_id;
        $data['button'] = 'Update City';
    } else {
        $data['action'] = 'add_city';
        $data['button'] = 'Add City';
    }  
    $data['sub_view'] = 'holiday_destination/city';   
    $this->load->view('_layout_main',$data);
}

public function set_city_status($id,$status) {
    $data = array(
        'status' => $status,          
    );
    $this->holiday_city->update($data,$id);
    if($status == 1){
        $msg = '<b style="color:#607d8b">Active</b>';
    } else {
        $msg = '<b style="color:#607d8b">Inactive</b>';
    }
    $this->session->set_flashdata('message','City is now '.$msg);
   redirect('holidaydestination/city', 'refresh');
}

public function holistate_info() {
    $id=$_POST['country_id'];  
    $data=array('country_id' => $id);
    $state_list = $this->holiday_state->check($data);   
    $state='<select  id="state" name="state" class="form-control" tabindex="-1" required>
    <option value="">Select Your State</option>';
    if(!empty($state_list)){ 
        $state.='<optgroup label="State List">';
        for($i=0;$i<count($state_list);$i++) {
            $state.='<option value="'.$state_list[$i]->state_id.'">'.$state_list[$i]->state_name.'</option>';
        }                  
            $state.='</optgroup>';   
    } else {  
        $state.='<optgroup label="No State List found"></optgroup>'; 
    }         
    $state.='</select>';
    echo json_encode(array('state' => $state));
}

public function city_images() {
    $data['city_id'] = $city_id = $_GET['city_id'];
    $this->load->model('Upload_Model');
    $data['gallery_img'] = $this->Upload_Model->get_images($city_id,'destination_images','*','city_id',$this->supplier_id);
    $data['single_city'] = $this->holiday_city->get_single($city_id);
    // echo '<pre>';print_r($data['gallery_img']);exit;
    $data['sub_view'] = 'holiday_destination/city_images';
    $this->load->view('_layout_main',$data);
}




}

