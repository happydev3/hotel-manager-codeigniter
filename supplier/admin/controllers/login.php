<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    // private $supplier_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_Model');
        $this->load->model('Email_Model');
        // $this->supplier_id = $this->session->userdata('supplier_id');
        // $this->is_logged_in();
    }

    private function is_logged_in() {
        if (!$this->session->userdata('supplier_logged_in')) {
            redirect('home/index');
        }
    }

    public function index() {
        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Login_Model->validate_credentials($loginEmailId, $loginPassword);
            //echo '<pre/>';print_r($res);exit;
            if (!empty($res)) {
                $dbpass = $res->supplier_password;
                if(password_verify($loginPassword, $dbpass)===true) {
                    $sessionSupplierInfo = array(
                        'supplier_id' => $res->id,
                        'supplier_email' => $res->supplier_email,
                        'supplier_name' => $res->first_name,
                        'supplier_logged_in' => TRUE
                    );
                    $this->session->set_userdata($sessionSupplierInfo);
                    $this->Login_Model->insert_login_activity();
                    redirect('home/dashboard', 'refresh');
                } else {
                    $data['status'] = 'Sign-in failed. Please check credentials';
                }
            } else {
                $data['status'] = 'Sign-in failed. Please check credentials';
            }
        }
        $this->load->view('login', $data);
    }


    public function supplier_login() {
        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Login_Model->validate_credentials($loginEmailId, $loginPassword);
                   // echo '<pre/>';print_r($res);exit;
            if (!empty($res)) {
                $dbpass = $res->supplier_password;
                if(password_verify($loginPassword, $dbpass)===true) {
                    $sessionSupplierInfo = array(
                        'supplier_id' => $res->id,
                        'supplier_no' => $res->supplier_no,
                        'supplier_email' => $res->supplier_email,
                        'supplier_name' => $res->first_name,
                        'supplier_logged_in' => TRUE
                        );
                    $this->session->set_userdata($sessionSupplierInfo);
                    $this->Login_Model->insert_login_activity();
                    redirect('home/dashboard', 'refresh');
                } else {
                    $data['status'] = 'Sign-in failed. Please check credentials';
                }
            } else {
                $data['status'] = 'Sign-in failed. Please check credentials';
            }
        }
        $this->load->view('login', $data);
    }

    public function supplier_logout() {
        // $this->session->unset_userdata('admin_id');
        // $this->session->unset_userdata('admin_email');
        // $this->session->unset_userdata('admin_name');
        // $this->session->unset_userdata('role_id');
        // $this->session->unset_userdata('admin_logged_in');

        $this->session->unset_userdata('supplier_id');
        $this->session->unset_userdata('supplier_no');
        $this->session->unset_userdata('supplier_email');
        $this->session->unset_userdata('supplier_name');
        $this->session->unset_userdata('supplier_logged_in');
        
        $this->session->sess_destroy();
        redirect('home', 'refresh');
    }


    public function supplierSignup(){
        $data['country_list'] = $this->Login_Model->get_country_list();
        $this->load->view('registration',$data);
    }

    public function supplier_registration(){
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('supplier_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required');

        // $loginEmailId = $this->input->post('supplier_email');
        // $data_email = base64_encode($loginEmailId);
        // $activation_key = sha1($loginEmailId);
        if($this->form_validation->run()==FALSE) {
            $this->load->view('registration',$data);
        } else{
            // $product_list = implode(',', $this->input->post('product_list'));
            $data = array(
                'supplier_name'=>$this->input->post('supplier_name'),
                'title'=>$this->input->post('title'),
                'first_name'=>$this->input->post('first_name'),
                'middle_name'=>$this->input->post('middle_name'),
                'last_name'=>$this->input->post('last_name'),
                'supplier_email'=>$this->input->post('supplier_email'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'office_phone_no'=>$this->input->post('office_phone_no'),
                'time_zone'=>$this->input->post('time_zone'),
                // 'region'=>$this->input->post('region'),
                'nationality'=>$this->input->post('nationality'),
                'state'=>$this->input->post('state'),
                'country'=>$this->input->post('country'),
                // 'product_list'=>$product_list,
                'status'=>0
            );
            // echo '<pre/>';print_r($data);exit;
           $id=$this->Login_Model->add_supplier_info($data);
            // echo $id;exit;
            $data_email = array(
                'title'         => $this->input->post('title'),
                'first_name'    => $this->input->post('first_name'),
                'supplier_email' => $this->input->post('supplier_email'),
                // 'activation_key' => $activation_key,
                // 'supplier_id' => $id,
                'subject'       => 'Partner Registration!'
            );
            $this->Email_Model->supplier_registration_email($data_email);
            redirect('login','refresh');
        }
    }

    public function set_password($supplier_id,$decode='') {
        $supplierinfo=$this->Login_Model->get_supplierInfo($supplier_id);
        //echo $this->db->last_query();//exit;
        // echo '<pre>';print_r($supplierinfo);exit;
        
        $data['supplier_id'] =$supplierinfo->id;
        $data['supplier_email'] =$supplierinfo->supplier_email;
        // echo $supplier_email;exit;
        $data['decode'] = $decode;
        $data['status'] = '';
        $this->load->view('change_password',$data);
    }

    public function forgot_password() {
        // echo '<pre>'; print_r($_POST);exit;
        $this->form_validation->set_rules('loginEmailId', 'Email', 'trim|required|xss_clean');
        $loginEmailId = $this->input->post('loginEmailId');
        // echo $loginEmailId;
        $data = base64_encode($loginEmailId);
        $getpassword = $this->Login_Model->get_forgot_password($loginEmailId);
        // echo '<pre>';print_r($getpassword);exit;
        $supplier_id = $getpassword->id;
        if ($supplier_id != '') {
            $activation_key = sha1($loginEmailId . 'Vacaymenow'); 
            $data = array(
                'active_url' => site_url().'login/load_forgot_password/'.$supplier_id.'/'.$activation_key,
                'email' => $loginEmailId,
                'module' => 'partner',
            );
            $this->Login_Model->update_activation_key($activation_key,$supplier_id);
            $this->Email_Model->forgot_password($data);
            $message = "A link has been sent to your email address to reset the password.";
            $this->session->set_flashdata('message',$message);
        } else{
            $message="Please enter registered email";
            $this->session->set_flashdata('error',$message);
        }
        redirect('login','refresh');
    }
    

    public function load_forgot_password($supplier_id, $decode) {
        $userinfo=$this->Login_Model->getActivationInfoDetails($supplier_id,$decode);
        if(!empty($userinfo)){
            $data['supplier_id']=$userinfo->id;
            $data['email'] = $userinfo->supplier_email;
            $data['decode'] = $decode;
            $this->load->view('forgot_password', $data);
        } else {
            $message="Link expired!";
            $this->session->set_flashdata('error',$message);
            redirect('login','refresh');
        }
        
    }

    function restore_password() {
        $this->form_validation->set_rules('supplier_password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $supplier_email = $this->input->post('supplier_email');
        $supplier_id = $this->input->post('supplier_id');
        $data['supplier_id'] = $supplier_id;
        $supplier_infoo = $this->Login_Model->getSupplierdetail($supplier_email,$supplier_id);
        // echo '<pre>43';print_r($supplier_infoo); exit;
        $supp_id = $supplier_infoo->id;
        if ($this->form_validation->run() == FALSE) {
            $data['email'] = $supplier_infoo->supplier_email;
            $this->load->view('forgot_password', $data);
        } else {
            // $password = md5($this->input->post('supplier_password'));
            $password = password_hash($_POST['supplier_password'], PASSWORD_BCRYPT);
            if ($this->Login_Model->update_password($supplier_id, $password)) {
                $message = 'Your Password Updated Successfully. Please login to cotinue';
                $this->session->set_flashdata('message',$message);
            } else {
                $message = 'Your Password not Updated. Please try after some time...';
                $this->session->set_flashdata('error',$message);
            }
            redirect('login','refresh');
        }
    }


}