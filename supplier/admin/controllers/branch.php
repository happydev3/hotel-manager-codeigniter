<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Suppliers_Branch');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	public function add_branch($branch_type=''){
		// $branch_type=1;
		$data['timezones'] = $this->Suppliers_Branch->get_timezone();
		if($branch_type==1){
		// $data['branches'] = $this->Suppliers_Branch->get_only_supplier('*', $this->supplier_id);
			$data['branches'] = $this->Suppliers_Branch->get_head_office_list('1');
		}
		else if($branch_type==2){
			$data['branches'] = $this->Suppliers_Branch->get_branch_office_list('2');
		}
		if($branch_type==1){
			$data['sub_view'] = 'branch/add';
			$this->load->view('_layout_main',$data);
		}
		else if($branch_type==2){
			$data['sub_view'] = 'branch/add_head';
			$this->load->view('_layout_main',$data);
		}
	}

	public function create_branch(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('branch_type', 'Branch Type', 'trim|required');
		$this->form_validation->set_rules('physical_address', 'Physical Address', 'trim|required');
		$this->form_validation->set_rules('telephone_no', 'Telephone Number', 'trim|required');
		
		$branch_type=$this->input->post('branch_type');
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('branch/add_branch','refresh');
		} else{
			$data= array(
				'branch_name'=>$this->input->post('branch_name'),
				'branch_type'=>$this->input->post('branch_type'),
				'physical_address'=>$this->input->post('physical_address'),
				'supplier_id'=>$this->supplier_id,
				'telephone_no'=>$this->input->post('telephone_no'),
				'emergency_contact'=>$this->input->post('emergency_contact'),
				'timezone'=>$this->input->post('timezone'),
			);

			// echo '<pre/>';print_r($data);exit;

			$this->Suppliers_Branch->add($data);
			$this->session->set_flashdata('message','New Office added');
			redirect('branch/add_branch/'.$branch_type,'refresh');	
		}
	}

	public function branch_list() {
		// echo 1;exit;
		$data['branches'] = $this->Suppliers_Branch->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'branch/list';
		$this->load->view('_layout_main',$data);
	}

	public function edit_branch() {
		$data['branch_id'] = $branch_id = $_GET['id'];
		// echo $user_id;exit;
		$data['branch_info'] = $branch_info=$this->Suppliers_Branch->get('*',$branch_id);
		// echo '<pre/>';print_r($data['branch_info']);exit;
		// echo $branch_type;exit;
		$data['timezones'] = $this->Suppliers_Branch->get_timezone();
		$data['sub_view'] = 'branch/edit';
		$this->load->view('_layout_main',$data);
		
	}
	public function edit_head() {
		$data['branch_id'] = $branch_id = $_GET['id'];
		// echo $user_id;exit;
		$data['branch_info'] = $branch_info=$this->Suppliers_Branch->get('*',$branch_id);
		// echo '<pre/>';print_r($data['branch_info']);exit;
		// echo $branch_type;exit;
		$data['timezones'] = $this->Suppliers_Branch->get_timezone();
		$data['sub_view'] = 'branch/edit_head';
		$this->load->view('_layout_main',$data);
		
	}

	public function update_branch(){
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('physical_address', 'Physical Address', 'trim|required');
		$this->form_validation->set_rules('telephone_no', 'Telephone Number', 'trim|required');

		$branch_id = $this->input->post('branch_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('branch/edit_branch?id='.$branch_id,'refresh');

		} else{
			$data= array(
				'branch_name'=>$this->input->post('branch_name'),
				'physical_address'=>$this->input->post('physical_address'),
				// 'supplier_id'=>$this->supplier_id,
				'telephone_no'=>$this->input->post('telephone_no'),
				'emergency_contact'=>$this->input->post('emergency_contact'),
				'timezone'=>$this->input->post('timezone'),
			);

			$this->Suppliers_Branch->update($data,$branch_id);
			$this->session->set_flashdata('message','Branch updated');
			redirect('branch/add_branch'.'/1','refresh');
			// echo $id;

		}
	}

	public function update_headoffice(){
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('physical_address', 'Physical Address', 'trim|required');
		$this->form_validation->set_rules('telephone_no', 'Telephone Number', 'trim|required');

		$branch_id = $this->input->post('branch_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('branch/edit_branch?id='.$branch_id,'refresh');

		} else{
			$data= array(
				'branch_name'=>$this->input->post('branch_name'),
				'physical_address'=>$this->input->post('physical_address'),
				'telephone_no'=>$this->input->post('telephone_no'),
				'emergency_contact'=>$this->input->post('emergency_contact'),
				'timezone'=>$this->input->post('timezone'),
			);

			$this->Suppliers_Branch->update($data,$branch_id);
			$this->session->set_flashdata('message','Head Office updated');
			redirect('branch/add_branch'.'/2','refresh');
			// echo $id;

		}
	}

}