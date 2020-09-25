<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		// $this->load->model('Home_Model');
		$this->load->model('New_User_Info');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	public function add_user(){
		$this->load->model('Suppliers_Branch');
		$data['branches'] = $this->Suppliers_Branch->get_only_supplier('*', $this->supplier_id);
		// echo '<pre/>';print_r($data['branches']);exit;
		$data['sub_view'] = 'supplier_user/add_user';
		$this->load->view('_layout_main',$data);
	}

	public function create_user(){

		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('user/add_user','refresh');
		}

		else{

			$data= array(
				'supplier_id'=>$this->supplier_id,
				'title'=>$this->input->post('title'),
				'first_name'=>$this->input->post('first_name'),
				'middle_name'=>$this->input->post('middle_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'mobile_no'=>$this->input->post('mobile_no'),
				'telephone_no'=>$this->input->post('telephone_no'),
				'department'=>$this->input->post('department'),
				'designation'=>$this->input->post('designation'),
				'product'=>$this->input->post('product'),
				'company'=>$this->input->post('company'),
				'branch_office'=>$this->input->post('branch_office')
			);

			// echo '<pre/>';print_r($data);exit;

			$this->New_User_Info->add($data);
			$this->session->set_flashdata('message','New User added');
			redirect('user/user_list','refresh');	

			
		}
	}

	public function user_list() {
		// echo 1;exit;
		$data['new_user_info'] = $new_user_info = $this->New_User_Info->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'supplier_user/user_list';
		$this->load->view('_layout_main',$data);
	}

	public function edit_user($user_id='') {
		$data['user_id'] = $user_id = $_GET['id'];
		// echo $user_id;exit;
		$data['new_user_info'] = $this->New_User_Info->get('*',$user_id);
		$this->load->model('Suppliers_Branch');
		$data['branches'] = $this->Suppliers_Branch->get_only_supplier('*', $this->supplier_id);
		// echo '<pre/>';print_r($data);exit;
		$data['sub_view'] = 'supplier_user/edit_user';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_user(){

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');

		$user_id=$this->input->post('user_id');

		// echo $user_id;exit;

		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('user/edit_user/'.$user_id,'refresh');
		}

		else{

				$data= array(
				'title'=>$this->input->post('title'),
				'first_name'=>$this->input->post('first_name'),
				'middle_name'=>$this->input->post('middle_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'mobile_no'=>$this->input->post('mobile_no'),
				'telephone_no'=>$this->input->post('telephone_no'),
				'department'=>$this->input->post('department'),
				'designation'=>$this->input->post('designation'),
				'product'=>$this->input->post('product'),
				'company'=>$this->input->post('company'),
				'branch_office'=>$this->input->post('branch_office')
			);

		$this->New_User_Info->update($data, $user_id);
		// echo $user_id;
		// echo '<pre/>';print_r($data);exit;
		$this->session->set_flashdata('message','User Updated');
		redirect('user/user_list','refresh');
		// echo $id;

		}
	}


	public function set_status($id,$status) {
	    $data = array(
	        'status' => $status,          
	    );
	    $this->New_User_Info->set_status($data,$id);
	    if($status == 0){
	        $msg = '<b style="color:#607d8b">Active</b>';
	    } else {
	        $msg = '<b style="color:#607d8b">inactive</b>';
	    }
	    $this->session->set_flashdata('message','User is now '.$msg);
	    redirect('user/user_list', 'refresh'); 
	}




}