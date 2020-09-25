<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Headoffice extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Suppliers_Headoffice');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	public function addHeadoffice(){
		$data['timezones'] = $this->Suppliers_Headoffice->get_timezone();
		$data['headoffice'] = $this->Suppliers_Headoffice->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'headoffice/add';
		$this->load->view('_layout_main',$data);
	}

	public function create_headoffice(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('headoffice_name', 'Head Office Name', 'trim|required');
		$this->form_validation->set_rules('office_type', 'Office Type', 'trim|required');
		$this->form_validation->set_rules('physical_address', 'Physical Address', 'trim|required');
		$this->form_validation->set_rules('telephone_no', 'Telephone Number', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('branch/add_branch','refresh');
		} else{
			$data= array(
				'office_name'=>$this->input->post('headoffice_name'),
				'office_type'=>$this->input->post('office_type'),
				'physical_address'=>$this->input->post('physical_address'),
				'supplier_id'=>$this->supplier_id,
				'telephone_no'=>$this->input->post('telephone_no'),
				'emergency_contact'=>$this->input->post('emergency_contact'),
				'timezone'=>$this->input->post('timezone'),
			);

			// echo '<pre/>';print_r($data);exit;

			$this->Suppliers_Headoffice->add($data);
			$this->session->set_flashdata('message','New Head Office added');
			redirect('headoffice/addHeadoffice','refresh');	
		}
	}

	public function edit_headoffice() {
		$data['office_id'] = $office_id = $_GET['id'];
		$data['headoffice_info'] = $this->Suppliers_Headoffice->get('*',$office_id);
		$data['timezones'] = $this->Suppliers_Headoffice->get_timezone();
		$data['sub_view'] = 'headoffice/edit';
		$this->load->view('_layout_main',$data);
	}

	public function update_headoffice(){
		$this->form_validation->set_rules('headoffice_name', 'Head Office Name', 'trim|required');
		$this->form_validation->set_rules('office_type', 'Office Type', 'trim|required');
		$this->form_validation->set_rules('physical_address', 'Physical Address', 'trim|required');
		$this->form_validation->set_rules('telephone_no', 'Telephone Number', 'trim|required');

		$office_id = $this->input->post('office_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('headoffice/edit_headoffice?id='.$office_id,'refresh');

		} else{
			$data= array(
				'office_name'=>$this->input->post('headoffice_name'),
				'office_type'=>$this->input->post('office_type'),
				'physical_address'=>$this->input->post('physical_address'),
				'telephone_no'=>$this->input->post('telephone_no'),
				'emergency_contact'=>$this->input->post('emergency_contact'),
				'timezone'=>$this->input->post('timezone'),
			);

			$this->Suppliers_Headoffice->update($data, $office_id);
			$this->session->set_flashdata('message','Head Office updated');
			redirect('headoffice/addHeadoffice','refresh');
			// echo $id;

		}
	}

}