<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Accountant_Details');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}


	public function add_accountant(){
		$data['accountant_info'] = $accountant_info = $this->Accountant_Details->
		get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] ='finance/add_accountant';
		$this->load->view('_layout_main',$data);
	}


	public function create_accountant(){

		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email','Email', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
	
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('accountant/add_accountant','refresh');
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
				'status' => 1
			);

			$this->Accountant_Details->add($data);
			$this->session->set_flashdata('message','New Accountant added');
			redirect('accountant/accountant_list','refresh');	

		}
	}

	public function accountant_list() {
		// echo 1;exit;
		$data['accountant_info'] = $accountant_info = $this->Accountant_Details->
		get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'finance/add_accountant';
		$this->load->view('_layout_main',$data);
	}

	public function edit_accountant($account_id='') {
		$data['account_id'] = $account_id = $_GET['id'];
		// echo $role_id;exit;
		$data['accountant_info'] = $this->Accountant_Details->get('*',$account_id);
		// echo '<pre/>';print_r($data);exit;
		$data['sub_view'] ='finance/edit_accountant';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_accountant(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email','Email', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');

		$account_id = $this->input->post('account_id');

		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('accountant/edit_accountant?id='.$account_id,'refresh');

		} else{
			$data= array(
				'title'=>$this->input->post('title'),
				'first_name'=>$this->input->post('first_name'),
				'middle_name'=>$this->input->post('middle_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'mobile_no'=>$this->input->post('mobile_no'),
				'telephone_no'=>$this->input->post('telephone_no')
			);

			$this->Accountant_Details->update($data,$account_id);

			$this->session->set_flashdata('message','Accountant updated');
			redirect('accountant/accountant_list','refresh');
			// echo $id;

		}
	}

	public function set_status($id,$status) {
	    $data = array(
	        'status' => $status,          
	    );
	    $this->Accountant_Details->set_status($data,$id);
	    if($status == 0){
	        $msg = '<b style="color:#607d8b">Inactive</b>';
	    } else {
	        $msg = '<b style="color:#607d8b">Active</b>';
	    }
	    $this->session->set_flashdata('message','User is now '.$msg);
	    redirect('accountant/accountant_list', 'refresh'); 
	}







}