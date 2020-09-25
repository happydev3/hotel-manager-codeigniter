<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('supplier_room_list');
		$this->load->model('glb_hotel_room_type');
		$this->load->model('supplier_hotel_list');
		$this->load->model('promotion_ota');
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

	public function get_room_lists() {
		$room_code = isset($_POST['room_code'])?explode(',', $_POST['room_code']):'';
		$dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
		$room_list = $this->supplier_room_list->check($dataarray);

		// $options = '<option value="">Select Room</option>';
		$options = '';
		foreach($room_list as $val) {
			if(!empty($room_code)){
				$selected = '';
				foreach ($room_code as $rm) {
					if($val->room_code == $rm) $selected = "selected='selected'";
				}
			}
			
			$options .= '<option value="'.$val->room_code.'" '.$selected.'>'.$val->room_name.' ('.$this->glb_hotel_room_type->get_single($val->hotel_room_type)->room_type.')</option>';
		}
		echo json_encode(array('contract_list'=>'','room_list'=>$options));
	}

	public function addPromo(){
		$dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  		$data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);
		$data['sub_view'] = 'promotions/add_promo';
		$this->load->view('_layout_main',$data);
	}

	public function save_step1($check_insert='') {
	    // echo '<pre>11';print_r($_POST);exit;
	    $this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');  
	    if($this->form_validation->run()==FALSE) {
	        $this->session->set_flashdata('error',validation_errors());
	    } else { 
	        $data=array(
	            'supplier_id' => $this->supplier_id,
	            'promo_type' =>  $this->input->post('promo_type'),
	            'promo_name' =>  $this->input->post('promo_name'),
	            'hotel_code' =>  $this->input->post('hotel_id'),
	            'room_code' => implode(',', $this->input->post('room_id')),
	            'created_at'=>date('Y-m-d'),
	        );
	        // echo '<pre>11';print_r($data);exit;
	        $check_insert = $this->input->post('insert_id');
	        if($check_insert == ''){
	            $insert_id = $this->promotion_ota->insert($data);
	            echo json_encode(array('insert_id' => $insert_id));
	        } else{
	            $this->promotion_ota->update($data, $check_insert);
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

	public function editPromo() {
	    // echo $_GET['id']; exit;
	    $data['promo_id'] = $promo_id = $_GET['id'];
	    $dataarray = array('id'=>$promo_id);
	    $data['promo_details'] = $this->promotion_ota->check($dataarray);
	    $dataarray2=array('status'=>1,'supplier_id'=>$this->supplier_id);
  		$data['hotel_list'] =$this->supplier_hotel_list->check($dataarray2);
  		// echo '<pre>11';print_r($data['promo_details']);exit;
  		$data['steps'] = 1;
	    $data['sub_view'] = 'promotions/edit_promo';
	    $this->load->view('_layout_main',$data);
	}

	public function edit_step2() {
		$data['promo_id'] = $promo_id = $_GET['id'];
		$dataarray=array('id'=>$promo_id);
		$data['promo_details'] = $this->promotion_ota->check($dataarray);
		// echo '<pre>11';print_r($data['promo_details']);exit;
		if(!isset($_GET['id']) || empty($data['promo_details'])) {
			redirect('promotions/listPromo','refresh');
		}
		$data['steps'] = 2;
		$data['sub_view'] = 'promotions/edit_step2';
		$this->load->view('_layout_main',$data);
	}

	public function update_all() {
	    // echo '<pre>';print_r($_POST);exit;
	    $step_no = $this->input->post('steps');
	    $promo_id = $this->input->post('insert_id');
	    $todo = $this->input->post('todo');
	    if($step_no == 1){
	        $this->update_step1($promo_id);
	        if($todo == 1){
	            redirect('promotions/edit_step2?id='.$promo_id, 'refresh');
	        } else {
	            redirect('promotions/editPromo?id='.$promo_id, 'refresh');
	        }
	    } elseif($step_no == 2){
	        // echo '<pre>';print_r($_POST);exit;
	        $this->update_step2($promo_id);
	        if($todo == 1){
	            redirect('promotions/listPromo', 'refresh');
	        } else {
	            redirect('promotions/edit_step2?id='.$promo_id, 'refresh');
	        }
	    } else {
            redirect('promotions/listPromo', 'refresh');
        } 
	    
	}

	public function update_step1($promo_id){
	    // echo '<pre>11';print_r($_POST);exit;
	    $this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');    
	    if($this->form_validation->run()==FALSE) {
	        $this->session->set_flashdata('error',validation_errors());
	    } else {
	        $data = array(
	        	// 'supplier_id' =>$this->supplier_id,
	            'promo_type' =>  $this->input->post('promo_type'),
	            'promo_name' =>  $this->input->post('promo_name'),
	            'hotel_code' =>  $this->input->post('hotel_id'),
	            'room_code' => implode(',', $this->input->post('room_id')),
	            // 'created_at'=>date('Y-m-d'),
	        );
	        // echo '<pre>11';print_r($data);exit;
	        $this->promotion_ota->update($data, $promo_id);
	        // trigger_notification
	        // $this->triggerNotification($promo_id,'has updated a property');
	         // echo json_encode(array('insert_id' => $promo_id));
	        $this->session->set_flashdata('message','Step 1 Completed!');
	    }
	}

	public function update_step2($promo_id) {
		// echo '<pre>11';print_r($_POST);exit;
		$applicable_day = '';
		if(isset($_POST['applicable_day']) && !empty($_POST['applicable_day'])){
			$applicable_day = implode(',', $_POST['applicable_day']);
		}
		$block_date = '';
		if(isset($_POST['block_date']) && !empty($_POST['block_date'])){
			$block_date = implode(',', $_POST['block_date']);
		}
		$booking_period = isset($_POST['booking_period'])?$_POST['booking_period']:'';
		$before_checkin_days = isset($_POST['before_checkin_days'])?$_POST['before_checkin_days']:'';
		$before_checkin_hours = isset($_POST['before_checkin_hours'])?$_POST['before_checkin_hours']:'';
        $data = array(
            'promo_audience' =>$_POST['promo_audience'],
            'minimum_night' =>$_POST['minimum_night'],
            'booking_period' =>$booking_period,
            'before_checkin_days' =>$before_checkin_days,
            'before_checkin_hours' =>$before_checkin_hours,
            'stay_period' =>$_POST['stay_period'],
            'applicable_days' =>$_POST['applicable_days'],
            'applicable_day' =>$applicable_day,
            'discount' =>$_POST['discount'],
            'block_date' =>$block_date,
            'status'=>1
        );
        // echo '<pre>';print_r($data);exit;
        $this->promotion_ota->update($data, $promo_id);
        // trigger_notification
        // $this->triggerNotification($promo_id,'has updated a property');
        // echo json_encode(array('insert_id' => $promo_id));
        $this->session->set_flashdata('message','Step 2 Completed!');
	}

	public function listPromo() {
		$data['promo_id'] = $promo_id = $_GET['id'];
	    // $dataarray = array('supplier_id'=>$this->supplier_id);
	    $data['promo_details'] = $this->promotion_ota->get_only_supplier('*',$this->supplier_id);
	    $dataarray2=array('status'=>1,'supplier_id'=>$this->supplier_id);
  		$data['hotel_list'] =$this->supplier_hotel_list->check($dataarray2);
	    $data['sub_view'] = 'promotions/list_promo';
	    $this->load->view('_layout_main',$data);
	}

	public function set_status($id,$status) {
		$data = array(
			'status' => $status,
		);
		$this->promotion_ota->set_status($data,$id);
		if($status == 1){
			$msg = '<label class="label label-success">Active</label>';
		} else {
			$msg = '<label class="label label-danger">Inactive</label>';
		}
		$this->session->set_flashdata('message','Promotion is now '.$msg);
		redirect('promotions/listPromo', 'refresh');
	}

	public function deletePromo() {
	    // echo $_GET['id']; exit;
	    $promo_id = isset($_GET['id'])?$_GET['id']:'';
	    if($promo_id != ''){
	    	$this->promotion_ota->delete($promo_id);
			$msg = '<label class="label label-success">deleted</label>';
		} else {
			$msg = '<label class="label label-danger">not deleted</label>';
		}
		$this->session->set_flashdata('message','Promotion '.$msg);
		redirect('promotions/listPromo', 'refresh');
	}


}