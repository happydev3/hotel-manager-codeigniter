<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financial extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Statutory_Info');
		$this->load->model('Accountant_Details');
		$this->load->model('Bank_Details');
		$this->load->model('Contract_Management');
		$this->load->model('Credit_Limits');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	
	// Statutory Details
	public function add_statutory(){
		$data['statutory_info'] = $statutory_info = $this->Statutory_Info->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'finance/add_statutory';
		$this->load->view('_layout_main',$data);
	}
	public function create_statutory(){

		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('pan_num', 'PAN Number', 'trim|required');
		$this->form_validation->set_rules('gst_num', 'GST Number', 'trim|required');
		$this->form_validation->set_rules('service_tax_num','Service Tax Number', 'trim|required');
		$this->form_validation->set_rules('cin_num', 'CIN Number', 'trim|required');
	
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/add_statutory','refresh');
		}

		else{

			$data= array(
				'supplier_id'=>$this->supplier_id,
				'pan_num'=>$this->input->post('pan_num'),
				'gst_num'=>$this->input->post('gst_num'),
				'service_tax_num'=>$this->input->post('service_tax_num'),
				'tds'=>$this->input->post('tds'),
				'cin_num'=>$this->input->post('cin_num'),
				'status' => 1
			);

			$this->Statutory_Info->add($data);
			$this->session->set_flashdata('message','New Statutory added');
			redirect('financial/add_statutory','refresh');	

		}
	}
	public function edit_statutory($statutory_id='') {
		$data['statutory_id'] = $statutory_id = $_GET['id'];
		// echo $statutory_id;exit;
		$data['statutory_info'] = $this->Statutory_Info->get('*',$statutory_id);
		// echo '<pre/>';print_r($data);exit;
		$data['sub_view'] ='finance/edit_statutory';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}
	public function update_statutory(){
		$this->form_validation->set_rules('pan_num', 'PAN Number', 'trim|required');
		$this->form_validation->set_rules('gst_num', 'GST Number', 'trim|required');
		$this->form_validation->set_rules('service_tax_num','Service Tax Number', 'trim|required');
		$this->form_validation->set_rules('cin_num', 'CIN Number', 'trim|required');

		$statutory_id = $this->input->post('statutory_id');

		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/edit_statutory?id='.$statutory_id,'refresh');

		} else{
			$data= array(
				'pan_num'=>$this->input->post('pan_num'),
				'gst_num'=>$this->input->post('gst_num'),
				'service_tax_num'=>$this->input->post('service_tax_num'),
				'tds'=>$this->input->post('tds'),
				'cin_num'=>$this->input->post('cin_num')
			);

			$this->Statutory_Info->update($data,$statutory_id);

			$this->session->set_flashdata('message','Statutory updated');
			redirect('financial/add_statutory','refresh');
			// echo $id;

		}
	}

	// Head Accountant Details
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
			redirect('financial/add_accountant','refresh');
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
			redirect('financial/add_accountant','refresh');	

		}
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
			redirect('financial/edit_accountant?id='.$account_id,'refresh');

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
			redirect('financial/add_accountant','refresh');
			// echo $id;

		}
	}

	// Bank Details
	public function add_banks(){
		$data['banks'] = $this->Bank_Details->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'finance/add_banks';
		$this->load->view('_layout_main',$data);
	}

	public function create_banks(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/add_banks','refresh');
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
				// 'start_date'=>$this->input->post('start_date'),
				// 'end_date'=>$this->input->post('end_date')
			);

			// echo '<pre/>';print_r($data);exit;

			$insert_id = $this->Bank_Details->add($data);

			// $to_do = 'insert';
			// $this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','New bank added');
			redirect('financial/add_banks','refresh');	
		}
	}

	public function edit_banks() {
		$data['bank_id'] = $bank_id = $_GET['id'];
		// echo $user_id;exit;
		$data['bank_info'] = $this->Bank_Details->get('*',$bank_id);
		// echo '<pre/>';print_r($data['bank_info']);exit;
		$data['sub_view'] = 'finance/edit_banks';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_banks(){
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required');

		$bank_id = $this->input->post('bank_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/edit_banks?id='.$bank_id,'refresh');

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
				// 'start_date'=>$this->input->post('start_date'),
				// 'end_date'=>$this->input->post('end_date')
			);

			$this->Bank_Details->update($data, $bank_id);

			// $to_do = 'update';
			// $insert_id = $bank_id;
			// $this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','Bank updated');
			redirect('financial/add_banks','refresh');
		}
	}

	// Contract Management
	public function add_contract(){
		$data['contracts'] = $this->Contract_Management->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'finance/add_contract';
		$this->load->view('_layout_main',$data);
	}

	public function create_contract(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('contract_template', 'Contract Template', 'trim|required');
		$this->form_validation->set_rules('contract_comment', 'Comment', 'trim|required');
		$this->form_validation->set_rules('contract_version', 'Contract Version', 'trim|required');
		$this->form_validation->set_rules('contract_status', 'Contract Status', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/add_contract','refresh');
		} else{
			$data= array(
				'contract_template'=>$this->input->post('contract_template'),
				'supplier_id'=>$this->supplier_id,
				'contract_comment'=>$this->input->post('contract_comment'),
				'contract_version'=>$this->input->post('contract_version'),
				'contract_status'=>$this->input->post('contract_status'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date')
			);

			// echo '<pre/>';print_r($data);exit;

			// $insert_id = $this->Contract_Management->add($data);

			$to_do = 'insert';
			$this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','New contract added');
			redirect('financial/add_contract','refresh');	
		}
	}

	public function edit_contract() {
		$data['contract_id'] = $contract_id = $_GET['id'];
		// echo $user_id;exit;
		$data['contract_info'] = $this->Contract_Management->get('*',$contract_id);
		// echo '<pre/>';print_r($data['contract_info']);exit;
		$data['sub_view'] = 'finance/edit_contract';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_contract(){
		$this->form_validation->set_rules('contract_template', 'Contract Template', 'trim|required');
		$this->form_validation->set_rules('contract_comment', 'Comment', 'trim|required');
		$this->form_validation->set_rules('contract_version', 'Contract Version', 'trim|required');
		$this->form_validation->set_rules('contract_status', 'Contract Status', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');

		$contract_id = $this->input->post('contract_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/edit_contract?id='.$contract_id,'refresh');

		} else{
			$data= array(
				'contract_template'=>$this->input->post('contract_template'),
				// 'supplier_id'=>$this->supplier_id,
				'contract_comment'=>$this->input->post('contract_comment'),
				'contract_version'=>$this->input->post('contract_version'),
				'contract_status'=>$this->input->post('contract_status'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date')
			);

			// $this->Contract_Management->update($data, $contract_id);

			$to_do = 'update';
			$insert_id = $contract_id;
			// $this->upload_docs($insert_id,$_POST,$to_do);

			$this->session->set_flashdata('message','Contract updated');
			redirect('financial/add_contract','refresh');
			// echo $id;

		}
	}
	public function upload_docs($insert_id,$post,$to_do){
	    // echo '<pre>';print_r($post);exit;
	    $supplier_id = $this->supplier_id;
	    $id = $insert_id;
	    $controller = 'financial';
	        
	    $imgpath = 'uploads/'.$supplier_id.'/financial/'.$id.'/';
	    $uploadpath = $this->upload_path.'/financial/'.$id.'/';
	    
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
	            $this->Bank_Details->upload_docs($id,$imgpath.$imgfile['file_name']);

	        }
	        // echo '<pre>kk';print_r($insert_id);exit;
	    } else {
	        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
	        $this->session->set_flashdata('errors_msg',$errors);
	    }
	}

	// Credit Limits
	public function credit_limits(){
		$data['credit_limits'] = $this->Credit_Limits->get_only_supplier('*', $this->supplier_id);
		$data['sub_view'] = 'finance/credit_limits';
		$this->load->view('_layout_main',$data);
	}

	public function create_credit_limits(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('bank_guarantee', 'Bank Gurantee', 'trim|required');
		$this->form_validation->set_rules('floating_deposit', 'Floating Deposit', 'trim|required');
		$this->form_validation->set_rules('trading_limit', 'Trading Limit', 'trim|required');
		$this->form_validation->set_rules('credit_type', 'Credit Type', 'trim|required');
		$this->form_validation->set_rules('current_balance', 'Current Balance', 'trim|required');
		$this->form_validation->set_rules('email_to', 'Email TO', 'trim|required');
		$this->form_validation->set_rules('sms_to', 'SMS TO', 'trim|required');
		
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/credit_limits','refresh');
		} else{
			$data= array(
				'bank_guarantee'=>$this->input->post('bank_guarantee'),
				'supplier_id'=>$this->supplier_id,
				'floating_deposit'=>$this->input->post('floating_deposit'),
				'trading_limit'=>$this->input->post('trading_limit'),
				'credit_type'=>$this->input->post('credit_type'),
				'current_balance'=>$this->input->post('current_balance'),
				'email_to'=>$this->input->post('email_to'),
				'micr_no'=>$this->input->post('sms_to'),
				'billing_currency'=>$this->input->post('billing_currency'),
			);

			// echo '<pre/>';print_r($data);exit;

			$insert_id = $this->Credit_Limits->add($data);

			$this->session->set_flashdata('message','New bank added');
			redirect('financial/credit_limits','refresh');	
		}
	}

	public function edit_credit_limits() {
		$data['credit_id'] = $credit_id = $_GET['id'];
		// echo $user_id;exit;
		$data['credit_info'] = $this->Credit_Limits->get('*',$credit_id);
		// echo '<pre/>';print_r($data['bank_info']);exit;
		$data['sub_view'] = 'finance/edit_credit_limits';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_credit_limits(){
		$this->form_validation->set_rules('bank_guarantee', 'Bank Gurantee', 'trim|required');
		$this->form_validation->set_rules('floating_deposit', 'Floating Deposit', 'trim|required');
		$this->form_validation->set_rules('trading_limit', 'Trading Limit', 'trim|required');
		$this->form_validation->set_rules('credit_type', 'Credit Type', 'trim|required');
		$this->form_validation->set_rules('current_balance', 'Current Balance', 'trim|required');
		$this->form_validation->set_rules('email_to', 'Email TO', 'trim|required');
		$this->form_validation->set_rules('sms_to', 'SMS TO', 'trim|required');

		$credit_id = $this->input->post('credit_id');
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('financial/edit_credit_limits?id='.$credit_id,'refresh');

		} else{
			$data= array(
				'bank_guarantee'=>$this->input->post('bank_guarantee'),
				'supplier_id'=>$this->supplier_id,
				'floating_deposit'=>$this->input->post('floating_deposit'),
				'trading_limit'=>$this->input->post('trading_limit'),
				'credit_type'=>$this->input->post('credit_type'),
				'current_balance'=>$this->input->post('current_balance'),
				'email_to'=>$this->input->post('email_to'),
				'micr_no'=>$this->input->post('sms_to'),
				'billing_currency'=>$this->input->post('billing_currency'),
			);

			$this->Credit_Limits->update($data, $credit_id);

			$this->session->set_flashdata('message','Bank updated');
			redirect('financial/credit_limits','refresh');
		}
	}



	public function set_status($id,$status) {
	    $data = array(
	        'status' => $status,          
	    );
	    $this->Statutory_Info->set_status($data,$id);
	    if($status == 0){
	        $msg = '<b style="color:#607d8b">Inactive</b>';
	    } else {
	        $msg = '<b style="color:#607d8b">Active</b>';
	    }
	    $this->session->set_flashdata('message','User is now '.$msg);
	    redirect('financial/list_statutory', 'refresh'); 
	}

}