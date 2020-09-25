<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class roomrates extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();     
    $this->load->model('glb_hotel_room_type');  
    $this->load->model('supplier_hotel_list'); 
    $this->load->model('supplier_room_list');
    // $this->load->model('sup_contract');
    $this->load->model('country');
    $this->load->model('Roomrates_Model');
    $this->load->model('sup_hotel_room_rates');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
  }
 private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
        redirect('login/supplier_login');
    }
}

 public function add()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray); 
  $data['sub_view'] = 'roomrate/add';
  $this->load->view('_layout_main',$data);   
 }
 public function add_room_rates_old($id='')
 {
  $dataarray=array('supplier_hotel_list_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 
  $hotel_detail =$this->supplier_hotel_list->get_single($id); 
  $data['roomtype'] =$this->glb_hotel_room_type->get();
  $dataarray1=array('supplier_id'=>$this->supplier_id);
  $data['contract_list'] =$this->sup_contract->check($dataarray1);
  $data['country'] =$this->country->get();      
  $data['hotel_id']=$id;
  $data['hotel_code']=$hotel_detail->hotel_code;
   $data['message'] =FALSE;
    // echo '<pre>';print_r($data['roomtype']);exit;
  if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->form_validation->set_rules('hotel_id', ' Hotel ', 'required');
      $this->form_validation->set_rules('room_id', ' Room ', 'required');
      if ($this->form_validation->run()) {
          $hotel_id = $this->input->post('hotel_id');
          $room_id = $this->input->post('room_id');
          // $get_selected_room_code=$this->Roomrates_Model->get_room_by_room_id($room_id);       
          $get_selected_room_code =$this->supplier_room_list->get_single($room_id);         
         // $hotel_detail = $this->Roomrates_Model->get_hotel_by_id($hotel_id);


          $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
          $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);


          $date_from = $this->input->post('from_date');
          $fromda = explode("-", $date_from);
          $room_avail_date_from = $fromda[2] . '-' . $fromda[1] . '-' . $fromda[0];
          $date_to = $this->input->post('to_date');
          $toda = explode("-", $date_to);
          $room_avail_date_to = $toda[2] . '-' . $toda[1] . '-' . $toda[0];
          $dates = $this->input->post('dates');
          //print '<pre />';print_r($dates);exit;
          $weekday = $this->input->post('weekday');
          $avilable_rooms = $this->input->post('avilable_rooms');
          $cost_price = $this->input->post('cost_price');
          $extra_bed_adult = $this->input->post('extra_bed_adult');
          $extra_bed_child = $this->input->post('extra_bed_child');
          $this->Roomrates_Model->delete_room_rates($hotel_id, $room_id, $dates);
          if (!empty($dates)) {
              $i = 0;
              foreach ($dates as $date) {
                  if (!empty($avilable_rooms[$i]) || !empty($cost_price[$i])) {
                      $insertinfo = array(
                          'supplier_id' => $this->session->userdata('supplier_id'),
                          'sup_hotel_id' => $hotel_id,
                          'hotel_code' => $hotel_detail->hotel_code,
                          'room_code'=>$get_selected_room_code->room_code,
                          'sup_room_details_id' => $room_id,
                          'room_avail_date' => $date,
                          'rooms_available' => $avilable_rooms[$i],
                          'room_fixed_rate' => $cost_price[$i],
                          'extra_bed_adult'=> $extra_bed_adult[$i],
                          'extra_bed_child'=> $extra_bed_child[$i],
                          'status' => '1',
                      );
                      $this->Roomrates_Model->add_room_rates($insertinfo);
                  }
                  $i++;
              }
          }
          $data['message'] =TRUE;
        unset($_POST);
      }

  }
  else if($id=='' || empty($data['room_list'])){
    redirect('roomrates/add','refresh');
  }

  $data['sub_view'] = 'roomrate/add_rates';
  $this->load->view('_layout_main',$data);   
 }
 public function view_room_rates()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray); 
  $data['sub_view'] = 'roomrate/view';
  $this->load->view('_layout_main',$data);   
 }


public function room_rate_list($id='') {  

  $dataarray=array('sup_hotel_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['calender_data'] =$this->sup_hotel_room_rates->check($dataarray); 

  if($id=='' || empty($data['calender_data'])){
    redirect('roomrates/view_room_rates','refresh');
  }

  $dataarray=array('supplier_hotel_list_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['rooms'] =$this->supplier_room_list->check($dataarray); 
  $hotel_detail =$this->supplier_hotel_list->get_single($id); 
    $data['sub_view'] = 'roomrate/calendar';
    $this->load->view('_layout_main',$data);
}

 



   



public function add_room_rates($id='')
 {
  $dataarray=array('supplier_hotel_list_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray);
  // echo $this->db->last_query();
  $hotel_detail =$this->supplier_hotel_list->get_single($id); 
  $data['roomtype'] =$this->glb_hotel_room_type->get();
  $dataarray1=array('supplier_id'=>$this->supplier_id);
  // $data['contract_list'] =$this->sup_contract->check($dataarray1);
  $data['country'] =$this->country->get();    
  $data['hotel_id']=$id;
  $data['hotel_code']=$hotel_detail->hotel_code;
  // echo '<pre>11'; print_r($data['room_list']);exit;
 if($id=='' || empty($data['room_list'])){
    redirect('roomrates/add','refresh');
  }

  $data['sub_view'] = 'roomrate/add_rates';
  $this->load->view('_layout_main',$data);   
 }

public function update_room_rates($id='')
 {  
  $dataarray=array('supplier_hotel_list_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 
  $hotel_detail =$this->supplier_hotel_list->get_single($id);
    if($id=='' || empty($data['room_list'])){    
     echo json_encode(array('result' => ''));
  }
  else if($this->input->server('REQUEST_METHOD') === 'POST') {    
      $this->form_validation->set_rules('hotel_id', ' Hotel ', 'required');
      $this->form_validation->set_rules('room_id', ' Room ', 'required');
      if($this->form_validation->run()) {
      $hotel_id = $this->input->post('hotel_id');
      $room_id = $this->input->post('room_id');
      $contract_id = $this->input->post('contract');
      $market = $this->input->post('market');
      $meal_plan = $this->input->post('meal_plan');           
      $get_selected_room_code =$this->supplier_room_list->get_single($room_id);
      $from_date=strtotime($_POST['from_date']);
      $to_date=strtotime($_POST['to_date']);
      $startdate= date("Y-m-d", $from_date);
      $enddate= date("Y-m-d", $to_date);
       $this->Roomrates_Model->delete_room_rates($hotel_id, $room_id, $startdate,$enddate,$contract_id,$market,$meal_plan);         
      $days=floor(($to_date - $from_date) / (60 * 60 * 24));     
         if($_POST['rate_type']=='PPPN' && !empty($_POST['adult_rate']))
         {
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(    
                  'supplier_id' => $this->session->userdata('supplier_id'),
                 'sup_hotel_id' => $hotel_id,
                 'hotel_code' => $hotel_detail->hotel_code,
                  'room_code'=>$get_selected_room_code->room_code,
                  'contract_id' => $_POST['contract'],
                  'sup_room_details_id'=> $_POST['room_id'],
                  'room_avail_date'=> $room_avail_date,   
                  'market'=> $_POST['market'],
                  'meal_plan'=> $_POST['meal_plan'],
                  'rate_type'=> $_POST['rate_type'],
                  'adult_rate'=> $_POST['adult_rate'],
                  'child_rate'=> $_POST['child_rate'],
                  'min_room_occupancy'=> $_POST['min_room_occupancy'],
                  'max_room_occupancy'=> $_POST['max_room_occupancy'],
                  'cancellation_policy'=> stripslashes($_POST['cancellation_policy']),
                'status' => '1',
                );
               $this->Roomrates_Model->add_room_rates($insertdata);
            }         
             echo json_encode(array('result' => '1'));
          }
          else if($_POST['rate_type']=='PRPN' && !empty($_POST['room_rate']))
          {
            for($i=0;$i<=$days;$i++)
              {  
                $incr_date = strtotime("+".$i." days", $from_date);
                $room_avail_date=date("Y-m-d", $incr_date);     
            $insertdata=array(    
            'supplier_id' => $this->session->userdata('supplier_id'),
            'sup_hotel_id' => $hotel_id,
            'hotel_code' => $hotel_detail->hotel_code,
            'room_code'=>$get_selected_room_code->room_code,
            'contract_id' => $_POST['contract'],
            'sup_room_details_id'=> $_POST['room_id'],
            'room_avail_date'=> $room_avail_date,   
            'market'=> $_POST['market'],
            'meal_plan'=> $_POST['meal_plan'],
            'rate_type'=> $_POST['rate_type'],
            'room_rate'=> $_POST['room_rate'],
            'min_adults_without_extra_bed'=> $_POST['min_adults_without_extra_bed'],
            'max_adults_without_extra_bed'=> $_POST['max_adults_without_extra_bed'],
            'min_child_without_extra_bed'=> $_POST['min_child_without_extra_bed'],
            'max_child_without_extra_bed'=> $_POST['max_child_without_extra_bed'],
            'extra_bed_for_adults'=> $_POST['extra_bed_for_adults'],
            'extra_bed_for_child'=> $_POST['extra_bed_for_child'],
            'extra_bed_for_adults_rate'=> $_POST['extra_bed_for_adults_rate'],
            'extra_bed_for_child_rate'=> $_POST['extra_bed_for_child_rate'],
            'min_room_occupancy'=> $_POST['min_room_occupancy'],
            'max_room_occupancy'=> $_POST['max_room_occupancy'],
            'cancellation_policy'=> stripslashes($_POST['cancellation_policy']),
            'status' => '1',
            );
             $this->Roomrates_Model->add_room_rates($insertdata);
          }    
          echo json_encode(array('result' => '1'));
        }
        else
        {        
           echo json_encode(array('result' => ''));
        }
      }
      else
        {       
           echo json_encode(array('result' => ''));
        }
    }
    else
        {         
           echo json_encode(array('result' => ''));
        }
       
 }

public function add_rate_type()
{
  $data['rate_type']=$_POST['rate_type'];
  echo json_encode(array('result' =>$this->load->view('roomrate/load_rate_type_ajax', $data, TRUE)));
}


public function edit_rates_room()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray); 
  $data['sub_view'] = 'roomrate/edit';
  $this->load->view('_layout_main',$data);   
 } 

 public function view_cal_edit($id='')
 {
  $dataarray=array('supplier_hotel_list_id'=>$id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 
  $hotel_detail =$this->supplier_hotel_list->get_single($id); 
  $data['hotel_id']=$id;
  $data['hotel_code']=$hotel_detail->hotel_code;
  $data['hotel_name']=$hotel_detail->hotel_name;
  $data['roomtype'] =$this->glb_hotel_room_type->get();
  if($id=='' || empty($data['room_list']))
  {
    redirect('roomrates/edit_rates_room','refresh');
  }
  $data['sub_view'] = 'roomrate/view_cal_edit';
  $this->load->view('_layout_main',$data);  

 }


   public function get_hotel_room_rates_def(){
         // echo '<pre>';print_r($_POST);exit;
      if(!isset($_POST['sup_hotel_id']))
      {
          redirect('roomrates/edit_rates_room','refresh');
      }
         $supplier_room_list_id=explode('|', $_POST['supplier_room_list_id']);
         $sup_room_details_id=trim($supplier_room_list_id[1]);
         $supplier_id=$this->supplier_id;
         $sup_hotel_id=$_POST['sup_hotel_id'];
         $hotel_code=$_POST['hotel_code'];
         $room_code=trim($supplier_room_list_id[0]);
         $start_date=$_POST['start_date'];
         $end_date=$_POST['end_date'];
          // $data['contract_info'] =$this->sup_contract->get();
         $roomrates=$data['roomrates'] = $this->Roomrates_Model->new_cal_get_roomrates_by_date($sup_room_details_id, $sup_hotel_id, $hotel_code,$room_code,$start_date,$end_date);
         // echo '<pre>';print_r($roomrates); echo $this->db->last_query(); exit;
          $data['sub_view'] = 'roomrate/view_rate_definition';
          $this->load->view('_layout_main',$data);  
     }


      public function edit_room_rates($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id,$index){
 
    $data['result']=$this->Roomrates_Model->get_roomrates_edit($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id);
    $data['index']=$index;
    $edit_room_rates='';
         if (!empty($data['result'])) {

           $edit_room_rates.= $this->load->view('roomrate/load_ajax_room_rate', $data, TRUE);
             echo json_encode(array('edit_room_rates' => $edit_room_rates));
            } else {
                echo json_encode(array());
            }     



    // $data['sub_view'] = 'roomrate/edit_room_rate_view_file';
    // $this->load->view('_layout_main',$data); 
 }
 public function update_room_rates_ind(){
 $supplier_id=$this->supplier_id;
 $room_fixed_rate = $this->input->post('room_fixed_rate');
 $extra_bed_adult=$this->input->post('extra_bed_adult');
 $extra_bed_child=$this->input->post('extra_bed_child');
 $hotel_code=$this->input->post('hotel_code');
 $room_code=$this->input->post('room_code');
 $sup_room_details_id=$this->input->post('sup_room_details_id');
 $sup_hotel_room_rates_id=$this->input->post('sup_hotel_room_rates_id');
 $this->Roomrates_Model->get_roomrates_update($sup_hotel_room_rates_id, $room_code, $hotel_code,$sup_room_details_id,$room_fixed_rate,$extra_bed_adult,$extra_bed_child);
 // redirect('roomrates/edit_rates_room','refresh');
  $result=$this->Roomrates_Model->get_roomrates_edit($sup_hotel_room_rates_id, $room_code, $hotel_code,$supplier_id,$sup_room_details_id);
 echo json_encode(array(
                        'success' => 'true',
                        'room_fixed_rate'=>$result->room_fixed_rate,
                        'extra_bed_adult'=>$result->extra_bed_adult,
                        'extra_bed_child'=>$result->extra_bed_child,
                        ));
 }
  public function available_rates() {
       // print '<pre />';print_r($_GET);exit;
        if (isset($_GET['month']) && isset($_GET['year']) && isset($_GET['hotel_code']) && isset($_GET['room_id'])) {

            $month = $_GET['month'];
            $year = $_GET['year'];
            $hotel_code = $_GET['hotel_code'];
            $room_id = $_GET['room_id'];
            $startdate = date('Y-m-d', strtotime($year . '-' . $month . '-1'));
            $enddate = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
            $roomrates = $this->Roomrates_Model->get_roomrates_by_date($room_id, $startdate, $enddate);
            $result = array();
            if (!empty($roomrates)) {
                foreach ($roomrates as $row) {
                    $result[] = array(
                        'room_available' => $row->rooms_available,
                        'room_price' => $row->room_fixed_rate,
                        'date' => $row->room_avail_date,
                    );
                }
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
        }
        $sd = $this->input->post('sd');
        $ed = $this->input->post('ed');
        $room_id = $this->input->post('room_id');
        if (!empty($sd) && !empty($ed) && !empty($room_id)) {

            $startdate = date('Y-m-d', strtotime($sd));
            $enddate = date('Y-m-t', strtotime($ed));
            $roomrates = $this->Roomrates_Model->get_roomrates_by_date($room_id, $startdate, $enddate);
            $result = array();
            if (!empty($roomrates)) {
                foreach ($roomrates as $row) {
                    $result[] = array(
                        'room_available' => $row->rooms_available,
                        'room_price' => $row->room_fixed_rate,
                        'date' => $row->room_avail_date,
                    );
                }
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
        }
        die();
    }
public function get_available_rates()
{   
     
    $year=$_POST['year'];
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code'];
    // $startdate = date('Y-m-d', strtotime($year . '-' . $month . '-1'));
    // $enddate = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $roomrates = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate);
    $result = array();
    if (!empty($roomrates)) {
                foreach ($roomrates as $row) {
                    $result[] = array(
                        'room_available' => $row->rooms_available,
                        'room_price' => $row->room_fixed_rate,
                        'date' => $row->room_avail_date,
                    );
                }
                // print_r($result); exit;
                echo json_encode(array('success' => 1, 'result' => $result));
            } else {
                echo json_encode(array('success' => 1, 'result' => array()));
            }
}


}
