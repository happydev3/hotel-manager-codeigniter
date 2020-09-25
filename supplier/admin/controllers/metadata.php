<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metadata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Metadata_Model');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	public function set_status($id,$status,$table_name,$id_column,$redirect) {
	    $data = array(
	        'status' => $status,          
	    );
	    $where = "$id_column = $id";
	    $this->Metadata_Model->set_status($data,$id,$table_name,$where);
	    if($status == 0){
	        $msg = '<b style="color:#607d8b">Inactive</b>';
	    } else {
	        $msg = '<b style="color:#607d8b">Active</b>';
	    }
	    $this->session->set_flashdata('message','Package is now '.$msg);
	    redirect('metadata/'.$redirect, 'refresh'); 
	}

	public function set_delete($id,$table_name,$id_column,$redirect) {
	    $where = "$id_column = $id";
	    $this->Metadata_Model->set_delete($table_name,$where);
	    $this->session->set_flashdata('message','Package is now deleted');
	    redirect('metadata/'.$redirect, 'refresh'); 
	}

	public function reason_for_closed(){
		$id = $_GET['id'];
		$data['reasons_info'] = $this->Metadata_Model->get_closed_reasons();
		$data['reasons_info_edit'] = $this->Metadata_Model->get_closed_reasons_byid($id);
		// echo '<pre/>11';print_r($data['reasons_info_edit']);exit;
		$data['sub_view'] = 'metadata/reason_for_closed';
		$this->load->view('_layout_main',$data);
	}


	public function add_update_reasons(){
		$this->form_validation->set_rules('closed_reason', 'Closed Reason', 'trim|required');
		$reason_id = $this->input->post('closed_reason_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('metadata/reason_for_closed','refresh');
		} else{
			$closed_reason = $this->input->post('closed_reason');
			$data = array(
				'closed_reason'=>$closed_reason
			);

			$this->Metadata_Model->add_update_reasons($data,$reason_id);

			$this->session->set_flashdata('message','Reason updated');
			redirect('metadata/reason_for_closed','refresh');
		}
	}

	public function transport_metadata(){
		$id = $_GET['id'];
		$data['transport_info'] = $this->Metadata_Model->get_transport_metadata();
		$data['transport_info_edit'] = $this->Metadata_Model->get_transport_metadata_byid($id);
		// echo '<pre/>11';print_r($data['transport_info_edit']);exit;
		$data['sub_view'] = 'metadata/transport_metadata';
		$this->load->view('_layout_main',$data);
	}


	public function add_update_transport_metadata(){
		$this->form_validation->set_rules('transport_name', 'Transport Name', 'trim|required');
		$transport_id = $this->input->post('transport_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('metadata/transport_metadata','refresh');
		} else{
			$transport_name = $this->input->post('transport_name');
			$data = array(
				'transport_name'=>$transport_name
			);

			$this->Metadata_Model->add_update_transport_metadata($data,$transport_id);

			$this->session->set_flashdata('message','Transport updated');
			redirect('metadata/transport_metadata','refresh');
		}
	}

	


}