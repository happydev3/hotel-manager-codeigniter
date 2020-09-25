<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Role_Manager');
		$this->load->library('admin_auth');
		$this->supplier_id = $this->session->userdata('supplier_id');
	}

	public function add_roles(){
		$data['sub_view'] = 'roles/add_roles';
		$this->load->view('_layout_main',$data);
	}

	public function create_roles(){

		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('department', 'Department Name', 'trim|required');
	
		if($this->form_validation->run()==FALSE){
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('role/add_roles','refresh');
		}

		else{

			$data= array(
				'supplier_id'=>$this->supplier_id,
				'designation'=>$this->input->post('designation'),
				'head_office'=>$this->input->post('head_office'),
				'department'=>$this->input->post('department'),
				'screen_opt'=>$this->input->post('screen_opt'),
				'dashboard_opt'=>$this->input->post('dashboard_opt'),
				'reports_opt'=>$this->input->post('reports_opt'),
				'notification_opt'=>$this->input->post('notification_opt')
			);

			// echo '<pre/>';print_r($data);exit;

			$this->Role_Manager->add($data);
			$this->session->set_flashdata('message','New Role added');
			redirect('role/role_list','refresh');	

		}
	}

	public function set_status($id,$status) {
	    $data = array(
	        'status' => $status,          
	    );
	    $this->Role_Manager->set_status($data,$id);
	    if($status == 0){
	        $msg = '<b style="color:#607d8b">inactive</b>';
	    } else {
	        $msg = '<b style="color:#607d8b">Active</b>';
	    }
	    $this->session->set_flashdata('message','User is now '.$msg);
	    redirect('role/role_list', 'refresh'); 
	}

	public function role_list() {
		// echo 1;exit;
		$data['role_manager'] = $role_manager = $this->Role_Manager->get_roles_list('*', $this->supplier_id);
		$data['sub_view'] = 'roles/role_list';
		$this->load->view('_layout_main',$data);
	}

	public function edit_role($role_id='') {
		$data['role_id'] = $role_id = $_GET['id'];
		// echo $role_id;exit;
		$data['role_manager'] = $this->Role_Manager->get('*',$role_id);
		// echo '<pre/>';print_r($data);exit;
		$data['sub_view'] = 'roles/edit_role';
		// echo 1;exit;
		$this->load->view('_layout_main',$data);
	}

	public function update_role(){
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('department', 'Department Name', 'trim|required');

		$role_id = $this->input->post('role_id');
		// echo $role_id;exit;
		if($this->form_validation->run()==FALSE) {
			$errors_msg=validation_errors();
			$this->session->set_flashdata('errors_msg',$errors_msg);
			redirect('role/edit_role?id='.$role_id,'refresh');

		} else{
			$data= array(
				'designation'=>$this->input->post('designation'),
				'head_office'=>$this->input->post('head_office'),
				'department'=>$this->input->post('department'),
				'screen_opt'=>$this->input->post('screen_opt'),
				'dashboard_opt'=>$this->input->post('dashboard_opt'),
				'reports_opt'=>$this->input->post('reports_opt'),
				'notification_opt'=>$this->input->post('notification_opt')
			);

			$this->Role_Manager->update($data,$role_id);

			$this->session->set_flashdata('message','Role updated');
			redirect('role/role_list','refresh');
			// echo $id;

		}
	}





}