<?php
ob_start();

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract extends CI_Controller {
	private $supplier_id;
    private $upload_path;
    private $max_image_size = '4000';
    private $max_image_width = '2024';
    private $max_image_height = '2000';


	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Contract_Management');
		$this->load->library('admin_auth');
		$this->load->library('upload');
		// $this->load->library('MY_Upload');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->supplier_id = $supplier_id = $this->session->userdata('supplier_id');
		$url= FCPATH;
		$this->upload_path = $url.'uploads/'.$supplier_id.'/';
	}

	public function add_contract(){
		$data['contracts'] = $this->Contract_Management->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'contract/add';
		$this->load->view('_layout_main',$data);
	}

	public function create_contract(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('contract/add_contract','refresh');
		} else{
			$data= array(
				'bank_name'=>$this->input->post('bank_name'),
				'supplier_id'=>$this->supplier_id,
				'branch_name'=>$this->input->post('branch_name'),
				'account_no'=>$this->input->post('account_no'),
				'ifsc_code'=>$this->input->post('ifsc_code'),
				'rtgs_neft_code'=>$this->input->post('rtgs_neft_code'),
				'swift_no'=>$this->input->post('swift_no'),
				'micr_no'=>$this->input->post('micr_no'),
				'billing_currency'=>$this->input->post('billing_currency'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date')
			);

			// echo '<pre/>';print_r($data);exit;

			$insert_id = $this->Contract_Management->add($data);

			$to_do = 'insert';
			$this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','New contract added');
			redirect('contract/contract_list','refresh');	
		}
	}

	public function contract_list() {
		// echo 1;exit;
		$data['contracts'] = $this->Contract_Management->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'contract/list';
		$this->load->view('_layout_main',$data);
	}

	public function edit_contract() {
		$data['contract_id'] = $contract_id = $_GET['id'];
		// echo $user_id;exit;
		$data['contract_info'] = $this->Contract_Management->get('*',$contract_id);
		// echo '<pre/>';print_r($data['contract_info']);exit;
		$data['sub_view'] = 'contract/edit';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_contract(){
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');

		$contract_id = $this->input->post('contract_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('contract/edit_contract?id='.$contract_id,'refresh');

		} else{
			$data= array(
				'bank_name'=>$this->input->post('bank_name'),
				// 'supplier_id'=>$this->supplier_id,
				'branch_name'=>$this->input->post('branch_name'),
				'account_no'=>$this->input->post('account_no'),
				'ifsc_code'=>$this->input->post('ifsc_code'),
				'rtgs_neft_code'=>$this->input->post('rtgs_neft_code'),
				'swift_no'=>$this->input->post('swift_no'),
				'micr_no'=>$this->input->post('micr_no'),
				'billing_currency'=>$this->input->post('billing_currency'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date')
			);

			$this->Contract_Management->update($data, $contract_id);

			$to_do = 'update';
			$insert_id = $contract_id;
			$this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','Contract updated');
			redirect('contract/contract_list','refresh');
			// echo $id;

		}
	}


	public function upload_docs($insert_id,$post,$to_do){
	    // echo '<pre>';print_r($post);exit;
	    $supplier_id = $this->supplier_id;
	    $id = $insert_id;
	    $controller = 'contract';
	        
	    $imgpath = 'uploads/'.$supplier_id.'/contract/'.$id.'/';
	    $uploadpath = $this->upload_path.'/contract/'.$id.'/';
	    
	    $config['upload_path'] = $uploadpath;
	    $config['allowed_types'] = 'doc|docs|pdf|docx|png|jpg';
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
	    if($this->upload->do_multi_upload("upload_docs")){
	        // echo '<pre>11 ';print_r($post);exit;
	        $data['upload_data'] = $this->upload->get_multi_upload_data();
	        // echo '<pre>11 ';print_r($data['upload_data']);exit;

	        foreach($data['upload_data'] as $imgfile) {
	            // echo '<pre>11 ';print_r($imgfile['file_name']);exit;
	            $this->Contract_Management->upload_docs($id,$imgpath.$imgfile['file_name']);

	        }
	        // echo '<pre>kk';print_r($insert_id);exit;
	    } else {
	        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
	        $this->session->set_flashdata('errors_msg',$errors);
	    }
	}

}