<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    private $supplier_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('supplier_info'); 
        $this->load->model('Login_Model');
        $this->load->model('jamaican_city_list');
        $this->load->helper(array('form', 'url'));
        // $this->load->library('admin_auth');
        $this->supplier_id = $this->session->userdata('supplier_id');
        $this->is_logged_in();

        // error_reporting(1);
    }

    public function index() {
        $data['supplier_info'] = $this->supplier_info->get($this->supplier_id);
        $dataarr = array('supplier_id'=>$this->supplier_id);
        $this->load->model('sup_hotel_booking');
        $data['hotel_booking_list'] =$this->sup_hotel_booking->check($dataarr,5);
        $this->load->model('sup_villa_booking');
        $data['villa_booking_list'] =$this->sup_villa_booking->check($dataarr,5);
        $this->load->model('sup_tour_booking');
        $data['tour_booking_list'] =$this->sup_tour_booking->check($dataarr,5);
        $this->load->view('dashboard', $data);

        // $data['sub_view'] = 'content_panel';
        // $this->load->view('_layout_main', $data);
    }

    private function is_logged_in() {
        if (!$this->session->userdata('supplier_logged_in')) {
            redirect('login/supplier_login');
        }
    }

    function dashboard() {
        $data['supplier_info'] = $this->supplier_info->get($this->supplier_id);
        $dataarr = array('supplier_id'=>$this->supplier_id);
        $this->load->model('sup_hotel_booking');
        $data['hotel_booking_list'] =$this->sup_hotel_booking->check($dataarr,5);
        $this->load->model('sup_villa_booking');
        $data['villa_booking_list'] =$this->sup_villa_booking->check($dataarr,5);
        $this->load->model('sup_tour_booking');
        $data['tour_booking_list'] =$this->sup_tour_booking->check($dataarr,5);
        $this->load->view('dashboard', $data);
    }

    function my_profile() {
        $data['country_list'] = $this->Login_Model->get_country_list();
        $data['sub_view'] = 'account/my_profile';
        $this->load->view('_layout_main', $data);
    }

    function edit_profile() {
        $data['sub_view'] = 'account/my_profile';
        $this->load->view('_layout_main',$data);
    }
    function my_act_summary() {
        //  echo 'entered';exit;
        // $data['admin_act_summary'] = $this->Home_Model->get_admin_act_summary();
        $this->load->view('account/my_act_summary', $data);
    }

    function update_profile() {
        $this->form_validation->set_rules('login_email', 'Email-Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('supplier_no', 'Partner No', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
           $data['sub_view'] = 'account/my_profile';
           $data['error'] = validation_errors();
           $this->load->view('_layout_main', $data);
        } else {
            // echo '<pre/>';print_r($_POST);exit;
            $update_data = array(
                'title'=>$this->input->post('title'),
                'first_name'=>$this->input->post('first_name'),
                'middle_name'=>$this->input->post('middle_name'),
                'last_name'=>$this->input->post('last_name'),
                'supplier_email'=>$this->input->post('supplier_email'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'office_phone_no'=>$this->input->post('office_phone_no'),
                'time_zone'=>$this->input->post('time_zone'),
                'region'=>$this->input->post('region'),
                'nationality'=>$this->input->post('nationality'),
                'state'=>$this->input->post('state'),
                'country'=>$this->input->post('country'),
                'product_list'=>$product_list
            );
            if ($this->supplier_info->update($update_data, $this->supplier_id)) {
                $this->session->set_flashdata('message','Profile Updated successfully!');
                redirect('home/my_profile/' . $this->supplier_id, 'refresh');
            } else {
                $this->session->set_flashdata('message','Profile info not updated!');
                redirect('home/my_profile/' . $this->supplier_id, $data);
            }
        }
    }

    function change_password() {
        $this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $data['supplier_info'] = $supplier_info = $this->supplier_info->get($this->supplier_id);

        if ($this->form_validation->run() == FALSE) {
           $data['sub_view'] = 'account/change_password';
           $data['error'] = validation_errors();
           $this->load->view('_layout_main',$data);
        } else {
            if(!empty($supplier_info)){
                $dbpass = $supplier_info->supplier_password;
                if(password_verify($this->input->post('cpassword'), $dbpass)===true) {
                    // $password = md5($this->input->post('password'));
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $updata = array(
                        'supplier_password' => $password
                    );
                    if ($this->supplier_info->update($updata, $this->supplier_id)) {
                        $this->session->set_flashdata('message','Your Password Successfully Updated...!');
                        // $data['message'] = 'Your Password Successfully Updated...!';
                    } else {
                        $data['error'] = 'Your Password not Updated. Please try after some time...!';
                        $this->session->set_flashdata('error','Your Password not Updated. Please try after some time...!');
                    }
                } else {
                    $data['error'] = 'Current Password is wrong. Please enter correct current password...!';
                    $this->session->set_flashdata('error','Current Password is wrong. Please enter correct current password...!');
                }
            } else {
                $data['error'] = 'Invalid credentials';
            }
            // redirect('home/update_password/' . $this->supplier_id, $data);
            $data['sub_view'] = 'account/change_password';
            $this->load->view('_layout_main',$data);
        }
    }

    // function update_password() {
    //     $data['sub_view'] = 'account/change_password';
    //     $this->load->view('_layout_main',$data);

    // }

     public function hotels_city_list() {
          if (isset($_GET['term'])) {
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->jamaican_city_list->get_hotel_city_list($search);
           // echo '123<pre>';
           // print_r($city_list);
           // exit;
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['id'];

                    $return_arr[] = array(
                        'label' => ucfirst($city) . " ($cityid)",
                        'value' => ucfirst($city) . " ($cityid)",
                        'id'=>$cityid
                    );
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => ""
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => ""
            );
        }

        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
    }





}
