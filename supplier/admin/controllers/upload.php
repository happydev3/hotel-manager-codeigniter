<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_CONTROLLER {

    private $upload_path;
    private $supplier_id;
    private $max_image_size = '4000';
    private $max_image_width = '2024';
    private $max_image_height = '2000';
    // private $base_url_fc;

function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('Upload_Model');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    // $this->load->library('admin_auth');

    // $url=str_replace('/admin/','',FCPATH);
    $url= FCPATH;
    // $url_save=str_replace('/admin/','',base_url());//exit;
    $this->supplier_id = $supplier_id = $this->session->userdata('supplier_id');
    $this->upload_path = $url.'uploads/'.$supplier_id.'/';
    //$this->base_url_fc = $url_save.'/'; //exit;
    // $this->is_logged_in();
}

private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}

public function do_upload_old(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    if(!empty($day_count)){
        // if($table_name=='holiday_itinerary_images'){
        //     $city_id = $this->input->post('city_id');
        //     $imgpath = 'uploads/supp_id/holiday/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        //     $uploadpath = $this->upload_path.'supp_id/holiday/'.$city_id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // } else {
            $imgpath = 'uploads/holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$table_name.'/'.$day_count.'/'.$img_type.'/';
        // }
        
    } else {
        if($table_name=='holiday_packages' || $table_name=='holiday_package_images'){
            $tablepath = 'holiday_package_images';
        } else{
            $tablepath = $table_name;
        }
        $imgpath = 'uploads/holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
        $uploadpath = $this->upload_path.'holiday/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    }
    // echo '<pre>';print_r($uploadpath);
    // if($this->input->post('submit')){
        $config['upload_path'] = $uploadpath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        
        if($this->upload->do_multi_upload("uploadfile")){
            $data['upload_data'] = $this->upload->get_multi_upload_data();
            // echo '<pre>';print_r($data['upload_data']);exit;
            // $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
            $total_files = count($data['upload_data']);

            if($upload_type == 'insert'){
                $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count);
            }
            $temp_images = array();
            foreach($data['upload_data'] as $imgfile) {
                //echo '<pre>11 ';print_r($imgfile['file_name']);//exit;
                if($upload_type == 'custom_insert'){
                    $temp_images[] = $imgpath.$imgfile['file_name'];
                } else {
                    $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count);
                }
            }
            if($upload_type == 'custom_insert'){
                $images = implode(',', $temp_images);
                $insert_id = $this->Upload_Model->custom_upload_images($table_name,$column_name,$upload_type,$images);
                echo json_encode(array(
                    'total_files' => 1,
                    'insert_id' => $insert_id
                ));
            } else{
                echo json_encode(array('total_files' => $total_files));
            }
            // echo '<pre>kk';print_r($insert_id);exit;
        } else {
            $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
            // foreach($errors as $k => $error){
            //     echo $error;
            // }
        }
    // } else {
    //     echo '<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>An error occured, please try again later.</div>';
    // }
    // Exit to avoid further execution
    exit();
}

public function do_upload(){
    // echo '<pre>';print_r($_POST);exit;
    $id = $this->input->post('id');
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $day_count = $this->input->post('day_count');
    $active_day = $this->input->post('active_day');
    if(!empty($day_count)){
        $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$day_count.'/';
        $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$table_name.'/'.$day_count.'/';
        // echo '<pre>1';print_r($uploadpath);exit;
    } else {
        if($table_name=='holiday_packages' || $table_name=='holiday_package_images'){
            $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$img_type.'/';
        } else{
            $imgpath = 'supplier/uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
            $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
        }
        // echo '<pre>2';print_r($uploadpath);exit;
        
    }
    $config['upload_path'] = 'uploads';
    // $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0755, TRUE);
    }
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
        // $total_files = count($data['upload_data']);

        if($upload_type == 'insert'){
            $this->Upload_Model->delete_first($id,$id_column,$table_name,$day_count,$active_day);
        }
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
            // echo '<pre>11 ';print_r($imgpath.$imgfile['file_name']);exit;
            $this->Upload_Model->upload_images($id,$id_column,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$day_count,$this->supplier_id,$active_day);
            s3Upload($imgpath.$imgfile['file_name'],'uploads');
        }
        // echo json_encode(array('total_files' => $total_files));
        echo $success_msg;
        
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function custom_upload($insert_id,$post,$to_do){
    // echo '<pre>';print_r($post);exit;
    $supplier_id = $this->supplier_id;
    $id = $insert_id;
    $unique_id = $post['unique_id'];
    $controller = $post['controller'];
    $table_name = $post['table_name'];
    $column_name = $post['column_name'];
    $img_type = $post['img_type'];
    $upload_type = $post['upload_type'];

    $tablepath = $table_name;
        
    $imgpath = 'supplier/uploads/'.$supplier_id.'/'.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    $uploadpath = $this->upload_path.$controller.'/'.$id.'/'.$tablepath.'/'.$img_type.'/';
    
    $config['upload_path'] = 'uploads';
    // $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
    if($this->upload->do_multi_upload("uploadfile")){
        // echo '<pre>11 ';print_r($post);exit;
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $total_files = count($data['upload_data']);

        // echo '<pre>11 ';print_r($data['upload_data']);exit;

        if($upload_type == 'insert'){
            $this->Upload_Model->delete_first($id,$unique_id,$table_name);
        }
        foreach($data['upload_data'] as $imgfile) {
            // echo '<pre>11 ';print_r($imgfile);exit;
            $this->Upload_Model->custom_upload_images($id,$unique_id,$table_name,$column_name,$upload_type,$imgpath.$imgfile['file_name'],$supplier_id);

            s3Upload($imgpath.$imgfile['file_name'],'uploads');
        }
        // echo '<pre>kk';print_r($insert_id);exit;
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
    }
    if($to_do == 'update'){
        $this->session->set_flashdata('message','Updated successfully!');
        redirect('holiday/add_accomodation?id='.$id, 'refresh');
    } else{
        $this->session->set_flashdata('message','Added successfully!');
        redirect('holiday/add_accomodation', 'refresh');
    }
}


public function delete_img(){
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    delete_s3_file($img_url);
    // unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
    // echo '<pre>kk';print_r($this->db->last_query());exit;
}



}


