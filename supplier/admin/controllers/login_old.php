<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
    }
    public function index() {
        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required|xss_clean');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Home_Model->validate_credentials($loginEmailId, $loginPassword);
            //echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionAdminInfo = array(
                    'admin_id' => $res->admin_id,
                    'admin_email' => $res->login_email,
                    'admin_name' => $res->first_name,
                    'role_id' => $res->role_id,
                    'admin_group' => $res->admin_group,
                    'admin_logged_in' => TRUE
                    );
                $this->session->set_userdata($sessionAdminInfo);
                $this->Home_Model->insert_login_activity();
                redirect('home/dashboard', 'refresh');
            } else {
                $data['status'] = 'Login Failed. Please check Login details';
            }
        }
        $this->load->view('login', $data);
    }
    public function admin_login() {
        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required|xss_clean');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Home_Model->validate_credentials($loginEmailId, $loginPassword);
            
               // echo '<pre/>';print_r($res);//exit;
            if ($res !== false) {
                $is_admin = false;
                if ($res->admin_grp_level == 1) {
                    $is_admin = true;
                }
                $priv = $this->Home_Model->get_user_privileges($res->admin_id);
                          // echo $this->db->last_query(); 
                                   //echo '<pre/>';print_r($priv);exit;
                $privileges = array();$i=0;
                $submoduleprivileges = array();$k=0;
                foreach ($priv as $row) {
                               // $privileges[$row->admin_id] = $row->sub_admin_module_id;
                   
                            //$privileges[$i++] = $row->sub_admin_module_id;
                   $privileges[$i++] = $row->privilege_name;
                   $submodpriv = $this->Home_Model->get_user_submodule_privileges($res->admin_id,$row->privilege_id);
                   foreach ($submodpriv as $val) {
                    $submoduleprivileges[$k++]=$val->submodule_privilege_name;
                }
            }
            //print_r($privileges );
            $sessionAdminInfo = array(
                'admin_id' => $res->admin_id,
                'admin_email' => $res->login_email,
                'admin_name' => $res->first_name,
                'role_id' => $res->role_id,
                'admin_group' => $res->admin_group,
                'admin_group_name' => $res->admin_grp_name,
                'admin_logged_in' => TRUE,
                'is_admin' => $is_admin,
                'privileges' => $privileges,
                'submoduleprivileges' => $submoduleprivileges,
                );
            $this->session->set_userdata($sessionAdminInfo);
            //echo '<pre>';print_r($sessionAdminInfo);exit;
            $this->Home_Model->insert_login_activity();
                                // assign sub admin authorisation to session //
            $admin_auth = $this->Home_Model->get_admin_auth($res->admin_id);
                                  // echo '<pre>';print_r($admin_auth);exit;
            if ($admin_auth != '') {
               foreach ($admin_auth as $adm) {
                   $aut = array(
                       'admin_auth_' . $adm->admin_privilege_id => $adm->admin_privilege_id
                       );
                   $this->session->set_userdata($aut);
               }
           }
                                    // assign sub admin authorisation to session //
           
           redirect('home/dashboard', 'refresh');
               } else {
                $data['status'] = 'Login Failed. Please check Login details';
            }
        }
        $this->load->view('login', $data);
    }
    public function admin_logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_email');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('admin_logged_in');
        $this->session->sess_destroy();
        redirect('home', 'refresh');
    }
}
/* End of file login.php */
                    /* Location: ./admin/controllers/login.php */