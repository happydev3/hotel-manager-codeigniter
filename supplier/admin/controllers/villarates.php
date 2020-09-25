<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class villarates extends CI_CONTROLLER {
  function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('Villarates_Model');
    $this->load->model('Villa_List');
    $this->load->model('Villa_List');
    $this->load->model('sup_villa_rates_list');
    $this->load->model('sup_villa_rates');
    $this->load->model('sup_villa_cancellation_rates');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->supplier_id = $this->session->userdata('supplier_id');
    $this->is_logged_in();
  }
  private function is_logged_in() {
    if (!$this->session->userdata('supplier_logged_in')) {
      redirect('login/supplier_login');
    } else{
      $this->load->model('supplier_info');
      $modules = $this->supplier_info->get_spec($this->supplier_id,'module_permission');
      // echo '<pre>';print_r($modules);exit;
      $mod_auth = explode(',', $modules->module_permission);
      $allMod = false;$hMod = false;$vMod = false;$tMod = false;
      if(!empty($mod_auth)) {
        foreach($mod_auth as $mod) {
          if($mod=='1') {
            $allMod = $hMod = true;
          } elseif($mod=='2') {
            $allMod = $vMod = true;
          } elseif($mod=='3') {
            $allMod = $tMod = true;
          } else{
            $hMod = false;$vMod = false;$tMod = false;
            $allMod = false;
          }
        }
      }
      if($vMod == false){
        redirect('home/index');
      }
    }
  }

  public function add() {
    $dataarray = array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray);
    $data['error']='';  
    $data['sub_view'] = 'villarate/add';
    $this->load->view('_layout_main',$data);
  }


  public function addRates() {
    $dataarray=array(
      'id'=>$_POST['villa_id'],
      'supplier_id'=>$this->supplier_id,
      'status'=>1
    );

    $data['villa_list'] = $this->Villa_List->check($dataarray);
    $villa_details = $this->Villa_List->get_single($_POST['villa_id']);
    $data['villa_id'] = $_POST['villa_id'];
    $data['villa_code']=$villa_details->property_code;
    $data['villa_name']=$villa_details->property_name;
    if(!isset($_POST['villa_id'])) {
      redirect('villarates/add','refresh');
    } else {
      $data['sub_view'] = 'villarate/add_rates';
    }
    $this->load->view('_layout_main',$data);
  }

  public function updateRates($id='') {
    // echo '<pre>'; print_r($_POST);exit;
    $supplier_id = $this->supplier_id; 
    $villa_id = isset($_POST['villa_id'])?$_POST['villa_id']:'';  
    $villa_rate = isset($_POST['villa_rate'])?$_POST['villa_rate']:'';
    $dataarray = array(
      'id'=>$id,
      'supplier_id'=>$supplier_id,
      'status'=>1
    );
    $data['villa_list'] = $this->Villa_List->check($dataarray);
    if($id == '' || $id != $villa_id || empty($data['villa_list'])) {
      echo json_encode(array('result' => ''));
    } else if($this->input->server('REQUEST_METHOD') === 'POST') { 
      $this->form_validation->set_rules('villa_id', ' Villa ', 'required');
      if($this->form_validation->run()) {
        $villa_code = $this->Villa_List->get_single($id)->property_code;
        $from_date = strtotime($_POST['from_date']);
        $to_date = strtotime($_POST['to_date']);
        $startdate = date("Y-m-d", $from_date);
        $enddate = date("Y-m-d", $to_date);
        $cancellation_policy = array();
        if(isset($_POST['non_refundable'])) {
          $cancellation_policy[0] = '0||'.$_POST['non_refundable'];
        } else {
          for($i=0;$i<count($_POST['days_before']) && isset($_POST['days_before']) && isset($_POST['cancel_rates']);$i++) {
            $cancellation_policy[$_POST['days_before'][$i]] = $_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
          } 
        }

        $days = floor(($to_date - $from_date) / (60 * 60 * 24));
        if(!empty($_POST['villa_rate']) && $days >= 1) {
          $insert_villa_rates_list = array(
            'supplier_id' =>$supplier_id,
            'sup_villa_id' => $villa_id,
            'villa_code' => $villa_code,
            'from_date'=> $startdate,
            'to_date'=>$enddate,
            'villa_rate'=> $villa_rate,
            'cancellation_policy'=> json_encode($cancellation_policy),
            'status' => '1',
          );
          // echo '<pre>'; print_r($insert_villa_rates_list);exit;
          $this->sup_villa_rates->delete_villa_rates_type($insert_villa_rates_list);
          $this->sup_villa_cancellation_rates->delete_villa_cancellation_rates($insert_villa_rates_list);
          $sup_villa_rates_list_id = $this->sup_villa_rates_list->insert($insert_villa_rates_list);

          for($i=0;$i<=$days;$i++) {
            $incr_date = strtotime("+".$i." days", $from_date);
            $villa_avail_date=date("Y-m-d", $incr_date);
            $insert_villa_rates = array(
              'sup_villa_rates_list_id'=>$sup_villa_rates_list_id,
              'supplier_id' => $supplier_id,
              'sup_villa_id' => $villa_id,
              'villa_code' => $villa_code,
              'villa_avail_date'=> $villa_avail_date,
              'villa_rate'=> $villa_rate,
              'status' => '1',
            );
            $this->sup_villa_rates->insert($insert_villa_rates);
            if(isset($_POST['non_refundable'])) {
              $insertcancellationdata = array(    
                'sup_villa_rates_list_id'=>$sup_villa_rates_list_id,
                'supplier_id' => $supplier_id,
                'sup_villa_id' => $villa_id,
                'villa_code' => $villa_code,
                'villa_avail_date'=> $villa_avail_date,
                'days_before_checkin'=>0,
                'per_rate_charge'=> 0,
                'cancel_rates_type'=>$_POST['non_refundable'],
                'date_time' => date('Y-m-d H:i:s'),
              );
              $this->sup_villa_cancellation_rates->insert($insertcancellationdata);
            } else {
              $k=0;
              $insertcancellationdata=array();
              foreach ($_POST['cancel_rates'] as $cancel_rate) { 
                $insertcancellationdata[$k] = array(
                  'sup_villa_rates_list_id'=>$sup_villa_rates_list_id,
                  'supplier_id' => $supplier_id,
                  'sup_villa_id' => $villa_id,
                  'villa_code' => $villa_code,
                  'villa_avail_date'=> $villa_avail_date,
                  'days_before_checkin'=> $_POST['days_before'][$k],
                  'per_rate_charge'=> $_POST['cancel_rates'][$k],
                  'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                  'date_time' => date('Y-m-d H:i:s'),
                );
                $this->sup_villa_cancellation_rates->insert($insertcancellationdata[$k]);
                $k++;
              }
            }
          }
          echo json_encode(array('result' => '1'));
        } else { 
          echo json_encode(array('result' => ''));
        }
      } else {  
        echo json_encode(array('result' => ''));
      }
    } else {    
      echo json_encode(array('result' => ''));
    }   
  }

  public function view_existing_rate() {
    $villa_id = $_POST['villa_id'];
    $data['existing_rate']= $this->sup_villa_rates_list->get_villarates_edit($this->supplier_id,$villa_id);
    if(!empty($data['existing_rate'])) {
      echo json_encode(array('result' =>$this->load->view('villarate/view_existing_rate', $data, TRUE)));
    } else {
      echo json_encode(array('result' =>''));
    }
  }

  public function update_existing_rates() {
    $data['edit_rates'] = $edit_rates = $this->sup_villa_rates_list->get_villarate_edit($this->supplier_id, $_POST['rate_list']);
    $dataarray = array(
      'id'=>$edit_rates->sup_villa_id,
      'supplier_id'=>$this->supplier_id,
      'status'=>1
    );
    $data['villa_list'] = $this->Villa_List->check($dataarray);
    $villa_detail =$this->Villa_List->get_single($edit_rates->sup_villa_id);
    $data['villa_id']=$edit_rates->sup_villa_id;
    $data['villa_code']=$villa_detail->property_code;
    $data['villa_name']=$villa_detail->property_name;
    if(empty($edit_rates)||empty($data['villa_list'])) {
      $errors_msg="No Rates Exist!!! Please add fresh rates....";
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('villarates/add','refresh');
    }
    else
    {
      $data['sub_view'] = 'villarate/update_existing_rates';
    }
    $this->load->view('_layout_main',$data);
  }

  public function view_villa_rates() {
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray); 
    $data['sub_view'] = 'villarate/view';
    $this->load->view('_layout_main',$data);   
  }

  public function villa_rate_list() {
    $dataarray=array('id'=>$_POST['villa_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
    $data['villas'] = $this->Villa_List->check($dataarray);
    $data['villa_detail'] = $this->Villa_List->get_single($_POST['villa_id']);
    // echo '<pre>';print_r($data['villa_detail'] );exit;
    $data['villa_code'] = $data['villa_detail']->property_code;
    $data['villa_id'] = $_POST['villa_id'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $data['startdate'] = date('Y-m-d', strtotime($from_date));
    $data['enddate'] = date('Y-m-d', strtotime($to_date));
    if(!isset($_POST['villa_id']) || empty($data['villas'])){
      redirect('villarates/view_villa_rates','refresh');
    }
    $data['sub_view'] = 'villarate/calendar';
    $this->load->view('_layout_main',$data);
  }


  public function get_villa_rate_monthlist() {
    $villa_id = $_POST['villa_id'];
    $villa_code = $_POST['villa_code'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $calender_data = $this->sup_villa_rates->get_villarates_by_date($villa_id, $startdate, $enddate);
    $calendar=array();
    $calendar_date=array();
    list($calendar,$calendar_date) = $this->villarates_calendar($calender_data);
    if (!empty($calender_data)) {
      echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
    } else {
      echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
    }
  }

  public function villarates_calendar($calender_data) {
    $calendar=array();
    $calendar_date=array();
    $k=0;
    for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++) {
      $status='';
      if($calender_data[$i]->status==0)
      {
        $status="<br>Rate Status : InActive";
      } else if($calender_data[$i]->status==1) {
        $status="<br>Rate Status : Active";
      } else if($calender_data[$i]->status==2) {
        $status="<br>Rate Status : Blocked";
      }
      $calendar[$k]="<small>Villa Rate : ".$calender_data[$i]->villa_rate.
      "</small>";
      $calendar_date[$k]=$calender_data[$i]->villa_avail_date;
    }
    return array($calendar,$calendar_date);
  }

  public function get_villa_rate_list() {
    $yearend=$year=$_POST['year'];
    $month=$_POST['month'];
    $monthend=$month+1;
    if($month==12) {
      $monthend=1;
      $yearend=$year+1;
    }
    $villa_id = $_POST['villa_id'];
    $villa_code = $_POST['villa_code'];
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));
    $calender_data = $this->sup_villa_rates->get_villarates_by_date($villa_id, $startdate, $enddate);
    $calendar=array();
    $calendar_date=array();
    $calendar_date1=array();
    list($calendar,$calendar_date) = $this->villarates_calendar($calender_data);
    if (!empty($calender_data)) {
      echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
    } else {
      echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
    }
  }

  public function get_villa_rate_monthcalender() {
    $villa_id = $_POST['villa_id'];
    $villa_code = $_POST['villa_code'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
    $villa_allotment_type = $_POST['villa_allotment_type'];
    $calender_data = $this->sup_villa_rates->get_villaallotment_by_date($villa_id,$villa_code,$startdate, $enddate);
    // echo $this->db->last_query();
    // echo '<pre>'; print_r($calender_data);exit;
    $calendar = array();
    $calendar_date = array();
    list($calendar,$calendar_date) = $this->villarates_calendar($calender_data);
    if (!empty($calender_data)) {
      echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date,'startdate'=>$startdate));
    } else {
      echo json_encode(array('success' => 1, 'result' => array(),'result1' => array(),'startdate'=>$startdate));
    }
  }

  public function edit_rates_villa() {
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] =$this->Villa_List->check($dataarray); 
    // $data['sub_view'] = 'villarate/edit';
    $data['sub_view'] = 'villarate/view_cal_edit';
    $this->load->view('_layout_main',$data);   
  }

  public function get_villa_rates_def(){
    $data['villa_id'] = $villa_id=isset($_POST['villa_id'])?$_POST['villa_id']:'';
    $data['from_date'] = $from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
    $data['to_date'] = $to_date=isset($_POST['to_date'])?$_POST['to_date']:'';
    $dataarray = array('id'=>$villa_id,'supplier_id'=>$this->supplier_id);
    $data['villa_detail'] = $villa_detail =$this->Villa_List->check($dataarray);
    $data['villa_name'] = $villa_detail[0]->property_name;
    $dataarray=array('id'=>$villa_id,'supplier_id'=>$this->supplier_id);
    $villa_code = $villa_detail[0]->property_code;
    $data['currency_type'] = $villa_detail[0]->currency_type;
    $supplier_id = $this->supplier_id;
    // echo '<pre>';print_r($data);exit;
    if(empty($villa_id)||$villa_id=='') {
      redirect('villarates/edit_rates_villa','refresh');
    }
    if(empty($villa_detail)) {  
      redirect('villarates/edit_rates_villa','refresh');
    }   
    $villarates=$data['villarates'] = $this->sup_villa_rates->new_cal_get_villarates_by_date($supplier_id,$villa_id,$villa_code,$from_date,$to_date);
    // echo '<pre>';print_r($villarates); echo $this->db->last_query(); exit;
    $data['sub_view'] = 'villarate/view_rate_definition';
    $this->load->view('_layout_main',$data);  
  }

  public function edit_villa_rates() {
    $sup_villa_rates_id = $_POST['rateid'];
    $data['villa_id'] = $villa_id = $_POST['villa_id'];
    $data['villa_code'] = $villa_code = $_POST['villa_code'];
    $dataarray = array('id'=>$villa_id,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray);
    $data['result'] = $this->sup_villa_rates->get_villarates($sup_villa_rates_id, $villa_code,$this->supplier_id,$villa_id);
    $edit_villa_rates = '';
    if (!empty($data['result'])) {
      $edit_villa_rates.= $this->load->view('villarate/load_ajax_villa_rate', $data, TRUE);
      echo json_encode(array('edit_villa_rates' => $edit_villa_rates));
    } else {
      echo json_encode(array());
    }
  }

  public function update_villa_rates_ind() {
    // print_r($_POST); exit;
    $villa_id =$_POST['villa_id'];
    $sup_villa_rates_list_id = $_POST['sup_villa_rates_list_id'];
    $sup_villa_rates_id=$_POST['sup_villa_rates_id'];
    $villa_code =$_POST['villa_code'];
    $villa_avail_date=$_POST['villa_avail_date'];
    $check=$this->sup_villa_rates->get_villarates_edit($villa_id,$sup_villa_rates_list_id,$sup_villa_rates_id,$villa_code,$this->supplier_id);
    if($check!='') {
      if(isset($_POST['villa_rate'])) {
        $updatadata=array('villa_rate'=> $_POST['villa_rate']);
        $this->sup_villa_rates->get_villarates_update($villa_id,$sup_villa_rates_list_id,$sup_villa_rates_id,$villa_code,$this->supplier_id,$updatadata);
        echo json_encode(array('success' => 'true'));
      } else {
        echo json_encode(array('success' => ''));
      }
    } else {
      echo json_encode(array('success' => ''));
    }
  }
  
  public function villa_block_dates() {
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray);  
    // echo '<pre>';print_r($data['villa_list']);exit;
    $data['block_list'] = $this->Villarates_Model->get_block_list($this->supplier_id);
        // echo '<pre>';print_r($data['block_list']);exit;

    $data['sub_view'] = 'villarate/villa_block_dates';
    $this->load->view('_layout_main',$data);
  }

  public function add_villa_block_dates() {
    // echo '<pre>';print_r($_POST);exit;
    $villa_id = $_POST['villa_id'];
    $data['supplier_id']= $supplier_id = $this->supplier_id;
    $from_date = $_POST['from_date'];
    // $to_date = $_POST['to_date'];
    $blocking_reason = $_POST['blocking_reason'];
    $startdate = implode(',', $from_date);
    // $enddate = date("Y-m-d",strtotime($to_date));
    $blocking_reason = $_POST['blocking_reason'];

    $insert_data = array(
        'villa_id' => $villa_id,
        'from_date' => $startdate,
        // 'to_date' => '',
        'blocking_reason' => $blocking_reason,
        'supplier_id' => $supplier_id
      );
    // echo '<pre>';print_r($insert_data);exit;
    $id = $this->input->post('id');
        if($id == ''){
           $this->Villarates_Model->add_block_dates($insert_data);
        } else{
            $this->Villarates_Model->update_block_dates($insert_data, $id);
             $this->session->set_flashdata('message','Updated succesfully!');

        }
    redirect('villarates/villa_block_dates','refresh');
  }

  public function edit_block_date(){
    $data['block_id'] = $block_id =isset($_GET['id'])?$_GET['id']:'';
      // echo '<pre>';print_r($data['block_id']);exit;
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray);  
    $data['block_list'] = $this->Villarates_Model->get_block_list($this->supplier_id);
    $data['block_details'] = $this->Villarates_Model->get_block_list_by_id($block_id,$this->supplier_id);
      // echo '<pre>';print_r($data['block_details']);exit;
    $data['sub_view'] = 'villarate/edit_block_dates';
    $this->load->view('_layout_main',$data);
  }

  public function delete_block_date(){
    $data['block_id'] = $block_id =isset($_GET['id'])?$_GET['id']:'';
    $this->Villarates_Model->delete_block_date($block_id,$this->supplier_id);
    redirect('villarates/villa_block_dates','refresh');
  }

  public function villa_allotment_list() {
    $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
    $data['villa_list'] = $this->Villa_List->check($dataarray);  
    // echo '<pre>';print_r($data['villa_list']);exit;
    $data['sub_view'] = 'villarate/villa_allotment';
    $this->load->view('_layout_main',$data);
  }

  public function get_villa_allotments() {
    $dataarray=array('sup_villa_rates_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
    $data['rate_list'] = $this->sup_villa_rates_list->check($dataarray);
     // echo '<pre>'; print_r($data);exit;
    // echo json_encode(array('rate_list'=>$this->load->view('roomrate/load_ajax_room_list', $data, TRUE)));
  }

   public function villa_allotment_rates() {  
    // echo '<pre>'; print_r($_POST);exit;
    $dataarray=array('id'=>$_POST['villa_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
    $data['villas'] = $this->Villa_List->check($dataarray);
    $data['villa_detail'] = $this->Villa_List->get_single($_POST['villa_id']);
    // $data['villa_detail'] =$this->sup_villa_rates_list->get_single($_POST['villa_id']);
    // echo '<pre>'; print_r($data['villa_detail']); exit;
    $data['villa_code']= $data['villa_detail']->property_code;
    $data['villa_id']=$_POST['villa_id']; 
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];
    $data['startdate'] = date('Y-m-d', strtotime($from_date));
    $data['enddate'] = date('Y-m-d', strtotime($to_date));
    if(!isset($_POST['villa_id']) || empty($data['villas'])) {
      redirect('villarates/villa_allotment_list','refresh');
    }
    $data['sub_view'] = 'villarate/calendar';
    $this->load->view('_layout_main',$data);
  }

  public function get_allotment_monthlist() {
    $villa_id = $_POST['villa_id'];
    $villa_code = $_POST['villa_code'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
     $data['villa_detail'] = $this->Villa_List->get_single($_POST['villa_id']);

    // $dataarray=array('sup_villa_rates_list_id'=>$villa_id,'villa_code'=>$villa_code,'supplier_id'=>$this->supplier_id,'status'=>1);
    $dataarray=array('villa_code'=>$villa_code,'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_list=$this->sup_villa_rates->check($dataarray);
    // echo $this->db->last_query();
    // echo '<pre>'; print_r($room_list); exit;
    $calendar=array();
    $calendar_room_name=array();
    $calendar_date=array();
    if(!empty($room_list[0]))
    {
      $k=0;
      // for($i=0;$i<count($room_list);$i++) {
        $days=floor((strtotime($enddate) - strtotime($startdate)) / (60 * 60 * 24));
        for($l=0;$l<=$days;$l++)
        {
          $incr_date = strtotime("+".$l." days", strtotime($startdate));
          $villa_avail_date=date("Y-m-d", $incr_date);
          $dataarray1=array(
            'sup_villa_id'=>$this->supplier_id,
            'villa_avail_date'=>$villa_avail_date,
            'villas_available'=>1,
            'villa_code'=>$villa_code,
            'supplier_id'=>$this->supplier_id
          );
          // $room_allotment_list=$this->sup_villa_rates->check($dataarray1);
          $room_allotment_list=$this->sup_villa_rates->check_room_allot($this->supplier_id,$villa_avail_date,$villa_code);
          // echo $this->db->last_query();
          // echo '<pre>'; print_r($room_allotment_list); exit;

          // $price_type=$this->sup_villa_rates->get_price_type($villa_code);
          $block_list = $this->sup_villa_rates->get_block_list($villa_code,$villa_avail_date);
          // echo $this->db->last_query();
          // echo '<pre>'; print_r($block_list); //exit;

          if($room_allotment_list[0]->price_type == 2){
            $rate_type = "</br>Rate Type : per week";}
          else{
            $rate_type = "</br>Rate Type : per night";
          }

          if($room_allotment_list!='') {
            // $room_allotment=$room_allotment_list[0]->rooms_available;
            $blockeddate = '';
            if($block_list != ''){
              $blockeddate = "</br><span style='color:red'>Villa is blocked for <b>".$block_list[0]->blocking_reason."</b></span></br>";
              // echo $blockeddate;
              // exit;
            }
            $calendar[$k]= "<span style='color:green'>Available</br>
                    Rate : ".$room_allotment_list[0]->villa_rate.' '.$rate_type."</span>".$blockeddate;
            $calendar_date[$k]=$villa_avail_date;
            $k++;
          } else {
            $calendar[$k]= "<span style='color:red'>Not Available</span>";
            $calendar_date[$k]=$villa_avail_date;
            $k++;
          }
        }
      // }
    }
    if (!empty($calendar)) {
      echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
    } else {
      echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
    }
  }




}