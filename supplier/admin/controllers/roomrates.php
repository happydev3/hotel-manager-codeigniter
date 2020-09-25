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
    $this->load->model('glb_hotel_meal_plan');  
    $this->load->model('supplier_hotel_list');  
    $this->load->model('supplier_room_list');
    $this->load->model('sup_hotel_room_rates_list'); 
    $this->load->model('sup_hotel_room_rates'); 
    $this->load->model('sup_hotel_room_cancellation_rates');
    $this->load->model('sup_hotel_room_supplement_rates');
    $this->load->model('country');
    $this->load->model('Roomrates_Model');   
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
        
        if($hMod == false){
            redirect('home/index');
        }
    }
}

public function triggerNotification($id,$msg=''){
    // $timezone = date_default_timezone_get();
    // date_default_timezone_set("$timezone");
    $data = array(
       'notification_time' => date('Y-m-d H:i:s'),
       'notification_flag' => 1,
       'notification_msg' => $msg
    );
    // echo '<pre>';print_r($data);exit;
    $this->supplier_hotel_list->update($data, $id);
    $this->load->model('supplier_info');
    $this->supplier_info->update(array('notification_flag' => 1), $this->supplier_id);
}

 public function add()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);
  $data['error']='';  
  $data['sub_view'] = 'roomrate/add';
  $this->load->view('_layout_main',$data);   
 }
 
  public function add_room_rates() {
    $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
    $data['seasons'] = $query->result();
    $query2 =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('cancel_policy');
    $data['policy'] = $query2->result();
    $dataarray=array(
      'supplier_room_list_id'=>$_POST['room_id'],
      'supplier_hotel_list_id'=>$_POST['hotel_id'],
      'supplier_id'=>$this->supplier_id,
      'status'=>1
    );
    $data['room_list'] =$this->supplier_room_list->check($dataarray); 
    $hotel_detail =$this->supplier_hotel_list->get_single($_POST['hotel_id']); 
    $meal_plan=array();
    $data['meal_planstr']=implode(',', $_POST['meal_plan']);
    $meal_planarr=$_POST['meal_plan']; 
    for ($i=0;$i <count($meal_planarr)&&!empty($meal_planarr[0]) ; $i++) { 
       $meal_plan[$i] =$this->glb_hotel_meal_plan->get_single($meal_planarr[$i])->meal_plan;
    }  
    $data['mealplan']=implode(',', $meal_plan); 

    /* Meal Plan List */
    $dataarray2=array('supplier_room_list_id'=>$_POST['room_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_mealplan_list=$this->supplier_room_list->check($dataarray2)[0]->mealplan; 
    $data['room_mealplan_list']=explode(',', $room_mealplan_list);
    $mealplanlist=$this->glb_hotel_meal_plan->get(); 
    $mealplanlistnarr=array();
    for($i=0;$i<count($mealplanlist)&&!empty($mealplanlist);$i++) {
      if(!in_array($mealplanlist[$i]->id, $meal_planarr)){
       $mealplanlistnarr[$mealplanlist[$i]->id]=$mealplanlist[$i]->meal_plan;
      }
    }
    $data['mealplanlist'] =$mealplanlistnarr; 
    $data['market'] =$_POST['market'];      
    $data['hotel_id']=$_POST['hotel_id'];
    $data['hotel_code']=$hotel_detail->hotel_code;
    $data['hotel_name']=$hotel_detail->hotel_name; 
    if(!isset($_POST['hotel_id']) || empty($data['room_list'])) {
        redirect('roomrates/add','refresh');
    } else {
       $data['sub_view'] = 'roomrate/add_rates';
    }
    $this->load->view('_layout_main',$data);   
  }

  /* View The Existing Rate */
   public function view_existing_rate()
   {

     $hotel_id=$_POST['hotel_id'];
     $room_id=$_POST['room_id'];
     $dataarray1=array(
        'sup_room_details_id'=>$room_id,
        'sup_hotel_id'=>$hotel_id,
        'supplier_id'=>$this->supplier_id,
        'is_deleted'=>0,
      ); 
     $data['existing_rate']= $this->sup_hotel_room_rates_list->getRoomRatesMealBased($dataarray1);
     // $data['existing_rate']= $this->sup_hotel_room_rates_list->get_roomrates_duplicate($this->supplier_id, $hotel_id, $room_id);
     if(!empty($data['existing_rate']))
     {
          echo json_encode(array('result' =>$this->load->view('roomrate/view_existing_rate', $data, TRUE)));
     }
     else
     {
           echo json_encode(array('result' =>''));
     }
   }
     
  public function add_duplicates_rates() {
    $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
    $data['seasons'] = $query->result();
    $query2 =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('cancel_policy');
    $data['policy'] = $query2->result();

    $data['duplicateroomrates']=$duplicateroomrates=$this->sup_hotel_room_rates_list->get_roomrate_duplicate($this->supplier_id, $_POST['rate_list']);
    // echo '<pre>';print_r($data['duplicateroomrates']);exit;
    $dataarray=array(
      'supplier_room_list_id'=>$duplicateroomrates->sup_room_details_id,
      'supplier_hotel_list_id'=>$duplicateroomrates->sup_hotel_id,
      'supplier_id'=>$this->supplier_id,
      'status'=>1
    );
    $data['room_list'] =$this->supplier_room_list->check($dataarray); 
    $hotel_detail =$this->supplier_hotel_list->get_single($duplicateroomrates->sup_hotel_id);
    $meal_plan=array();
    $meal_planarr=explode(',',$duplicateroomrates->meal_plan); 
    for ($i=0;$i <count($meal_planarr) && !empty($meal_planarr[0]); $i++) { 
       $meal_plan[$i] =$this->glb_hotel_meal_plan->get_single($meal_planarr[$i])->meal_plan;
    }  
    $data['mealplan']=implode(',', $meal_plan); 
   
    /* Meal Plan List */
    $dataarray2=array('supplier_room_list_id'=>$duplicateroomrates->sup_room_details_id,'supplier_id'=>$this->supplier_id,'status'=>1);
    $room_mealplan_list=$this->supplier_room_list->check($dataarray2)[0]->mealplan; 
    $data['room_mealplan_list']=explode(',', $room_mealplan_list);
    $mealplanlist=$this->glb_hotel_meal_plan->get(); 
    $mealplanlistnarr=array();
    for($i=0;$i<count($mealplanlist)&&!empty($mealplanlist);$i++) {
      if(!in_array($mealplanlist[$i]->id, $meal_planarr)){
        $mealplanlistnarr[$mealplanlist[$i]->id]=$mealplanlist[$i]->meal_plan;
      }
    }
    $data['mealplanlist'] =$mealplanlistnarr;
    $data['hotel_id']=$duplicateroomrates->sup_hotel_id;
    $data['hotel_code']=$hotel_detail->hotel_code;
    $data['hotel_name']=$hotel_detail->hotel_name;
    if(empty($duplicateroomrates)||empty($data['room_list'])) {
      $errors_msg="No Rates Exist!!! Kindly add fresh rates....";
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('roomrates/add','refresh');
    } else {
      $data['sub_view'] = 'roomrate/add_duplicates_rates'; 
    }
    $this->load->view('_layout_main',$data);  
  }

  public function update_room_rates($id='') {
    // echo '<pre>'; print_r($_POST); //exit;
    $supplier_id=$this->supplier_id; 
    $hotel_id=isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
    $room_id=isset($_POST['room_id'])?$_POST['room_id']:'';  
    $meal_plan=isset($_POST['meal_plan'])?implode(',',$_POST['meal_plan']):''; 
    // $room_rate=isset($_POST['room_rate'])?$_POST['room_rate']:'';
    $adult_rate=isset($_POST['adult_rate'])?$_POST['adult_rate']:'';
    $double_rate=isset($_POST['double_rate'])?$_POST['double_rate']:'';
    $triple_rate=isset($_POST['triple_rate'])?$_POST['triple_rate']:'';
    $quad_rate=isset($_POST['quad_rate'])?$_POST['quad_rate']:'';
    $child_rate=isset($_POST['child_rate'])?$_POST['child_rate']:'';
    $min_night_stay=isset($_POST['min_night_stay'])?$_POST['min_night_stay']:'';
    $policy_desc=isset($_POST['policy_desc'])?$_POST['policy_desc']:'';
    $policy_name1=isset($_POST['policy_name'])?$_POST['policy_name']:'';
    $policy_name2=isset($_POST['policy_name2'])?$_POST['policy_name2']:'';
    $policy_id=isset($_POST['policy_id'])?$_POST['policy_id']:'';
    $season_name=isset($_POST['season_name'])?$_POST['season_name']:'';
    $non_refundable=isset($_POST['non_refundable'])?$_POST['non_refundable']:'';
    // $discount=isset($_POST['discount'])?$_POST['discount']:'';

    if($policy_name2 != ''){
      $policy_name = $policy_name2;
      $insertarray = array(
        'policy_name' => $policy_name2,
        'policy_desc' => $policy_desc,
        'status' => 1,
        'supplier_id' => $this->supplier_id,
      );
      $this->db->insert('cancel_policy',$insertarray);
      $policy_id = $this->db->insert_id();
    } else {
      $policy_name = $policy_name1;
      $policy_id = $policy_id;
    }
    // echo $policy_id;exit;
    $dataarray=array(
      'supplier_hotel_list_id'=>$id,
      'supplier_id'=>$this->supplier_id,
      'status'=>1
    );
    $data['room_list'] =$this->supplier_room_list->check($dataarray);
    // echo '<pre>'; print_r($data['room_list']); //exit;
    if($id=='' ||$id!=$hotel_id || empty($data['room_list'])) {    
      echo json_encode(array('result' => ''));
    } else if($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->form_validation->set_rules('hotel_id', ' Hotel ', 'required');
      $this->form_validation->set_rules('room_id', ' Room ', 'required');   
      if($this->form_validation->run()) {
        $hotel_code =$this->supplier_hotel_list->get_single($id)->hotel_code;
        $room_detail=$this->supplier_room_list->get_single($room_id);     
        $room_code =$room_detail->room_code;
        $from_date=strtotime($_POST['from_date']);
        $to_date=strtotime($_POST['to_date']);
        $startdate= date("Y-m-d", $from_date);
        $enddate= date("Y-m-d", $to_date);
        // $cancellation_policy=array();
        if($non_refundable != '') {
          // $cancellation_policy[0]='0||'.$_POST['non_refundable'];
          $cancellation_policy = 'non_refundable';
        } else {
          $cancellation_policy = $policy_desc;
          // $cancellation_policy = str_replace('<br />','',nl2br($policy_desc));
          // for($i=0;$i<count($_POST['days_before']) && isset($_POST['days_before']) && isset($_POST['cancel_rates']);$i++) {
          //   // $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
          // } 
        }
        // echo $cancellation_policy;exit;
        $days=floor(($to_date - $from_date) / (60 * 60 * 24));    
        if(!empty($_POST['adult_rate']) && $days>=1) {
          $insertlist = array(
            'supplier_id' =>$supplier_id,
            'sup_hotel_id' => $hotel_id,
            'hotel_code' => $hotel_code,
            'room_code'=>$room_code,              
            'sup_room_details_id'=> $room_id,                 
            'from_date'=> $startdate,
            'to_date'=>$enddate,                   
            'meal_plan'=> $meal_plan,
            // 'room_rate'=> $room_rate,
            'adult_rate'=> $adult_rate,
            'double_rate'=> $double_rate,
            'triple_rate'=> $triple_rate,
            'quad_rate'=> $quad_rate,
            'min_night_stay'=> $min_night_stay,
            'child_rate'=> $child_rate,
            // 'discount' => $discount,
            // 'cancellation_policy'=> json_encode($cancellation_policy),
            'cancellation_policy'=> $cancellation_policy,
            'policy_name'=> $policy_name,
            'policy_id'=> $policy_id,
            'season_id'=> $season_name,
            'status' => '1',
          );
          $this->sup_hotel_room_rates->delete_room_rates_type($insertlist);
          $this->sup_hotel_room_rates_list->delete_room_rates_list_new($insertlist);
          $this->sup_hotel_room_cancellation_rates->delete_room_cancellation_rates($insertlist);
          $list_id = $this->sup_hotel_room_rates_list->insert($insertlist);

          for($i=0;$i<=$days;$i++) { 
            $room_avail_date = date("Y-m-d", strtotime("+".$i." days", $from_date));     
            $insertdata = array(
              'sup_hotel_room_rates_list_id'=>$list_id,    
              'supplier_id' => $supplier_id,
              'sup_hotel_id' => $hotel_id,
              'hotel_code' => $hotel_code,
              'room_code'=>$room_code,                
              'sup_room_details_id'=> $room_id,                 
              'room_avail_date'=> $room_avail_date, 
              'meal_plan'=> $meal_plan,
              // 'room_rate'=> $room_rate,
              'adult_rate'=> $adult_rate,
              'double_rate'=> $double_rate,
              'triple_rate'=> $triple_rate,
              'quad_rate'=> $quad_rate,
              'child_rate'=> $child_rate,
              'min_night_stay'=> $min_night_stay,
              // 'discount' => $discount,
              'status' => '1',
            );
            $this->sup_hotel_room_rates->insert($insertdata);
            $canceldata=array(    
              'sup_hotel_room_rates_list_id'=>$list_id,
              'supplier_id' => $supplier_id,
              'sup_hotel_id' => $hotel_id,
              'hotel_code' => $hotel_code,
              'room_code'=>$room_code,
              'sup_room_details_id'=> $room_id,
              'room_avail_date'=> $room_avail_date,
              'days_before_checkin'=> 0,
              'per_rate_charge'=> 0,
              'cancel_rates_type'=> $cancellation_policy,
              'policy_name'=> $policy_name,
              'policy_id'=> $policy_id,
              'season_id'=> $season_name,
              'meal_plan'=> $meal_plan,
              'date_time' => date('Y-m-d H:i:s'),
            );
            $this->sup_hotel_room_cancellation_rates->insert($canceldata);
            /*if($non_refundable != '') {
              $canceldata['cancel_rates_type'] = 'non_refundable';
              $this->sup_hotel_room_cancellation_rates->insert($canceldata);
            } else {
              // foreach ($_POST['cancel_rates'] as $k=>$cancel_rate) { 
                // $canceldata['days_before_checkin'] = $_POST['days_before'][$k];
                // $canceldata['per_rate_charge'] = $_POST['cancel_rates'][$k];
                // $canceldata['cancel_rates_type'] = $_POST['cancel_rates_type'][$k];
                $this->sup_hotel_room_cancellation_rates->insert($canceldata);
              // }
            }*/
          }
          // trigger_notification
          $this->triggerNotification($hotel_id,'has updated a room rates');
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

  public function getPolicyDesc() {
    $id = isset($_POST['policy_id'])?$_POST['policy_id']:'';
    $policy_desc = '';
    if($id!='' && $id!=0){
      $query2 =  $this->db->select('*')->where('id', $id)->get('cancel_policy');
      $policy_desc = $query2->row()->policy_desc;
    }
    echo json_encode(array('policy_desc' => $policy_desc));
  }

  public function getSeasonDate() {
    $id = isset($_POST['season_id'])?$_POST['season_id']:'';
    $from_date = '';$to_date = '';
    if($id!='' && $id!=0){
      $query2 =  $this->db->select('*')->where('id', $id)->get('season_rate');
      $result = $query2->row();
      // echo $this->db->last_query();exit;
      $from_date = $result->fromdate;
      $to_date = $result->todate;
    }
    echo json_encode(array('from_date' => $from_date,'to_date' => $to_date));
  }


 public function view_room_rates()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray);
  $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
  $data['seasons'] = $query->result();
  $data['sub_view'] = 'roomrate/view';
  $this->load->view('_layout_main',$data);   
 }

public function add_rate_type()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['room_id'],'supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list'] =$this->supplier_room_list->check($dataarray); 

  $data['rate_type']=$_POST['rate_type'];
  if(empty($data['room_list']))
  {
    echo json_encode(array('result' =>'','result1'=>'Check Room Status.....')); 
  }
  else{
  echo json_encode(array('result' =>$this->load->view('roomrate/load_rate_type_ajax', $data, TRUE),'result1'=>''));
}
}


public function edit_rates_room()
 {
  $dataarray=array('status'=>1,'supplier_id'=>$this->supplier_id);
  $data['hotel_list'] =$this->supplier_hotel_list->check($dataarray); 
  // $data['sub_view'] = 'roomrate/edit';
  $data['sub_view'] = 'roomrate/view_cal_edit';
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

    $data['hotel_id']=$hotel_id=isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
    $data['room_id']=$room_id=isset($_POST['room_id'])?$_POST['room_id']:'';
    $data['meal_plan']=$meal_plan=isset($_POST['meal_plan'])?implode(',',$_POST['meal_plan']):'';
    $data['from_date']=$from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
    $data['to_date']=$to_date=isset($_POST['to_date'])?$_POST['to_date']:'';

  $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['hotel_detail']=$hotel_detail =$this->supplier_hotel_list->check($dataarray); 
  $data['hotel_name']=$hotel_detail[0]->hotel_name;
  $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
  $data['room_detail']=$room_detail =$this->supplier_room_list->check($dataarray);
  $data['roomtype']=$roomtype =$this->glb_hotel_room_type->get_single($room_detail[0]->hotel_room_type);
  $data['room_name']=$room_detail[0]->room_name.' ('.$roomtype->room_type.')';
  $hotel_code=$hotel_detail[0]->hotel_code;
  $room_code=$room_detail[0]->room_code;
  $data['currency_type']=$hotel_detail[0]->currency_type;
  $supplier_id=$this->supplier_id;
    // echo '<pre>';print_r($data);exit;

      if(empty($hotel_id)||$hotel_id==''||empty($room_id)||$room_id=='')
      { 
          redirect('roomrates/edit_rates_room','refresh');
      }
      if(empty($room_detail)||empty($hotel_detail))
      {  
         redirect('roomrates/edit_rates_room','refresh');
      }   

$roomrates=$data['roomrates'] = $this->sup_hotel_room_rates->new_cal_get_roomrates_by_date($supplier_id,$hotel_id, $hotel_code, $room_id,$room_code,$meal_plan,$from_date,$to_date);
   
         // echo '<pre>';print_r($roomrates); echo $this->db->last_query(); exit;
          $data['sub_view'] = 'roomrate/view_rate_definition';
          $this->load->view('_layout_main',$data);  
     }


  public function edit_room_rates()
  {
 
   $sup_hotel_room_rates_id=$_POST['rateid'];
   $data['hotel_id']=$hotel_id=$_POST['hotel_id'];
   $data['room_code']=$room_code=$_POST['room_code'];
   $data['hotel_code']=$hotel_code=$_POST['hotel_code'];   
   $data['sup_room_details_id']=$room_id=$_POST['room_id'];   
   $data['meal_plan']=$meal_plan=$_POST['meal_plan'];   
   $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
   $data['room_list'] =$this->supplier_room_list->check($dataarray);
   $data['result']=$this->sup_hotel_room_rates->get_roomrates($sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$room_id,$meal_plan);   
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

 public function update_room_rates_ind()
 {  
  // print_r($_POST); exit;  
  $hotel_id =$_POST['hotel_id'];
  $sup_room_details_id = $_POST['sup_room_details_id'];    
  $sup_hotel_room_rates_list_id = $_POST['sup_hotel_room_rates_list_id'];    
  $sup_hotel_room_rates_id=$_POST['sup_hotel_room_rates_id'];
  $hotel_code =$_POST['hotel_code'];
  $room_code =$_POST['room_code'];
  $meal_plan = $_POST['meal_plan'];           
  $room_avail_date=$_POST['room_avail_date'];      
  $check=$this->sup_hotel_room_rates->get_roomrates_edit($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$meal_plan);
  if($check!='')
  {
    if(isset($_POST['adult_rate'])) {
      $updatadata=array(
        // 'room_rate'=> $_POST['room_rate'],
        'adult_rate'=> $_POST['adult_rate'],
        'double_rate'=> $_POST['double_rate'],
        'triple_rate'=> $_POST['triple_rate'],
        'quad_rate'=> $_POST['quad_rate'],
        'child_rate'=> $_POST['child_rate'],
        'min_night_stay'=> $_POST['min_night_stay'],
        // 'discount'=> $_POST['discount'],
      );
      $this->sup_hotel_room_rates->get_roomrates_update($hotel_id,$sup_hotel_room_rates_list_id,$sup_hotel_room_rates_id, $room_code, $hotel_code,$this->supplier_id,$sup_room_details_id,$meal_plan,$updatadata);

      // trigger_notification
      $this->triggerNotification($hotel_id,'has updated a room rates');

      echo json_encode(array('success' => 'true'));
    } else {
      echo json_encode(array('success' => ''));
    }
  } else {
    echo json_encode(array('success' => ''));
  }       
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


  public function room_rate_list() {  
    $dataarray=array('supplier_hotel_list_id'=>$_POST['hotel_id'],'supplier_id'=>$this->supplier_id,'status'=>1);
    $data['rooms'] =$this->supplier_room_list->check($dataarray);
    $data['hotel_detail'] =$this->supplier_hotel_list->get_single($_POST['hotel_id']);
    $data['rooms_detail'] =$this->supplier_room_list->get_single($_POST['room_id']);
    $data['room_id']=$_POST['room_id'];
    $data['hotel_code']= $data['hotel_detail']->hotel_code;
    $data['hotel_id']=$_POST['hotel_id'];
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];
    $data['startdate'] = date('Y-m-d', strtotime($from_date));
    $data['enddate'] = date('Y-m-d', strtotime($to_date));
    $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
    $data['seasons'] = $query->result();
    if(!isset($_POST['hotel_id']) || empty($data['rooms'])){
      redirect('roomrates/view_room_rates','refresh');
    }
    $data['sub_view'] = 'roomrate/calendar';
    $this->load->view('_layout_main',$data);
  }


public function get_room_rate_monthlist()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code'];  
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate);
   $calendar=array();
   $calendar_date=array(); 
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function get_room_rate_list()
{   
     
    $yearend=$year=$_POST['year'];
    $month=$_POST['month'];
    $monthend=$month+1;
    if($month==12)
    { 
      $monthend=1;
      $yearend=$year+1;
    }   
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate);  
   $calendar=array();
   $calendar_date=array();
   $calendar_date1=array();
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);  
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function get_room_rate_monthcalender()
{   
     
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $startdate = date('Y-m-d', strtotime($from_date));
    $enddate = date('Y-m-d', strtotime($to_date));
    $room_allotment_type=$_POST['room_allotment_type'];
    $calender_data = $this->sup_hotel_room_rates->get_roomallotment_by_date($room_id,$hotel_code,$startdate, $enddate);   
   $calendar=array();
   $calendar_date=array();  
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);   
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date,'startdate'=>$startdate));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array(),'startdate'=>$startdate));
            }
}

public function get_available_rates()
{   
    $year=$_POST['year'];
    $room_id = $_POST['room_id'];
    $hotel_code = $_POST['hotel_code']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .'1'. '-1'));
    $enddate = date('Y-m-t', strtotime($year . '-' . '12'. '-1'));
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_id, $startdate, $enddate); 
   $calendar=array();
   $calendar_date=array();
    list($calendar,$calendar_date)=$this->roomrates_calendar($calender_data);
  
    if (!empty($calender_data)) {     
      
          echo json_encode(array('success' => 1, 'result' => $calendar,'result1' => $calendar_date));
               
         } else {
                echo json_encode(array('success' => 1, 'result' => array(),'result1' => array()));
            }
}

public function roomrates_calendar($calender_data)
{
  $calendar=array();
  $calendar_date=array();
  $k=0;
  for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++)
  {
         
           $meal_arrr=explode(',',$calender_data[$i]->meal_plan);
           $meal_plan=array();
            for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
            {
              $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
            }
            $meal_plan_str=implode(' , ', $meal_plan);  
            $status='';
            if($calender_data[$i]->status==0)
            {
              $status="<br>Rate Status : InActive";
            }
            else if($calender_data[$i]->status==1)
            {
              $status="<br>Rate Status : Active";
            }
             else if($calender_data[$i]->status==2)
            {
              $status="<br>Rate Status : Blocked";
            }
            // $calendar[$k]="<small>Room Rate : ".$calender_data[$i]->room_rate."<br>Meal Plan : ".$meal_plan_str.$status."<br>Discount : ".$calender_data[$i]->discount."</small>";

            $calendar[$k]="<small>Single Rate : ".$calender_data[$i]->adult_rate.
                        "<br>Double Rate : ".$calender_data[$i]->double_rate.
                        "<br>Triple Rate : ".$calender_data[$i]->triple_rate.
                        "<br>Quad Rate : ".$calender_data[$i]->quad_rate.
                        "<br>Child Rate : ".$calender_data[$i]->child_rate.
                        "<br>Minimum Night Stay : ".$calender_data[$i]->min_night_stay.
                        "<br>Meal Plan : ".$meal_plan_str.$status.
                        // "<br>Discount : ".$calender_data[$i]->discount.
                        "</small>";
           $calendar_date[$k]=$calender_data[$i]->room_avail_date;
      
    }
      return array($calendar,$calendar_date); 
}

public function get_hotel_details()
{
  $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $data['room_list']=$this->supplier_room_list->check($dataarray);
   // echo '<pre>'; print_r($data);  exit;
  echo json_encode(array('contract_list'=>'','room_list'=>$this->load->view('roomrate/load_ajax_room_list', $data, TRUE)));
}

 

public function get_mealplan_details()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray)[0]->mealplan; 
  $data['room_mealplan_list']=explode(',', $room_mealplan_list);
  $mealplan=$this->glb_hotel_meal_plan->get(); 
  $mealplanarr=array();
  for($i=0;$i<count($mealplan)&&!empty($mealplan);$i++)
  {
     $mealplanarr[$mealplan[$i]->id]=$mealplan[$i]->meal_plan;
  }
  $data['mealplan'] =$mealplanarr; 
  // print_r($data); exit;
  echo json_encode(array('meal_list'=>$this->load->view('roomrate/load_ajax_meal_list', $data, TRUE)));
}

public function get_selected_mealplan_details()
{
  $dataarray=array('supplier_room_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray)[0]->mealplan; 
  $data['room_mealplan_list']=explode(',', $room_mealplan_list);
  $mealplan=$this->glb_hotel_meal_plan->get(); 
  $mealplanarr=array();
  for($i=0;$i<count($mealplan)&&!empty($mealplan);$i++)
  {
     $mealplanarr[$mealplan[$i]->id]=$mealplan[$i]->meal_plan;
  }
  $data['sel_meal_plan']=isset($_POST['sel_meal_plan'])?$_POST['sel_meal_plan']:'';
  $data['mealplan'] =$mealplanarr; 
  // print_r($data); exit;
  echo json_encode(array('meal_list'=>$this->load->view('roomrate/load_ajax_meal_list', $data, TRUE)));
}

public function season_list() {
  $data['season_info'] = '';
  $data['error']='';
  $data['action']='add_season';
  $data['button']='Add Season';
  $data['sub_view'] = 'roomrate/season_rate';
  $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
  $data['seasons'] = $query->result();
  $this->load->view('_layout_main',$data);
}

public function add_season() {
  $this->form_validation->set_rules('season_name', 'Season Name', 'trim|required');
  $this->form_validation->set_rules('fromdate', 'Period', 'trim|required');
  $this->form_validation->set_rules('todate', 'Period', 'trim|required');
  if($this->form_validation->run()==FALSE) {
    $errors_msg = validation_errors();
    $this->session->set_flashdata('errors_msg',$errors_msg);
    redirect('roomrates/season_list');
  } else {
    $insertarray = array(
      'season_name' => $_POST['season_name'],
      'fromdate' => $_POST['fromdate'],
      'todate' => $_POST['todate'],
      'status' => 1,
      'supplier_id' => $this->supplier_id,
    );
    $this->db->insert('season_rate',$insertarray);
    $id = $this->db->insert_id();
    if($id != '') {
      $this->session->set_flashdata('message','Season added!');
      redirect('roomrates/season_list');
    } else {
      $errors_msg = 'Season not added. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('roomrates/season_list');
    }
  }
}

public function edit_season($id='') {
  // $id = isset($_GET['id'])?$_GET['id']:'';
  if($id != '') {
    $data['error']='';
    $data['action']='update_season';
    $data['button']='Update Season';
    $data['sub_view'] = 'roomrate/season_rate';
    $query = $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('season_rate');
    $data['seasons'] = $query->result();
    $query2 = $this->db->select('*')->where('id', $id)->get('season_rate');
    $data['season_info'] = $query2->row();
    $this->load->view('_layout_main',$data);
  } else {
    redirect('roomrates/season_list');
  }
}

public function update_season() {
  $this->form_validation->set_rules('season_name', 'Season Name', 'trim|required');
  $this->form_validation->set_rules('fromdate', 'Period', 'trim|required');
  $this->form_validation->set_rules('todate', 'Period', 'trim|required');
  if($this->form_validation->run()==FALSE) {
    $errors_msg = validation_errors();
    $this->session->set_flashdata('errors_msg',$errors_msg);
    redirect('roomrates/season_list');
  } else {
    $id = $this->input->post('season_id');
    if($id != '') {
      $updata = array(
        'season_name' => $_POST['season_name'],
        'fromdate' => $_POST['fromdate'],
        'todate' => $_POST['todate'],
        // 'status' => 1,
        // 'supplier_id' => $this->supplier_id,
      );
      $this->db->where('id',$id);
      if($this->db->update('season_rate',$updata)) {
        $this->session->set_flashdata('message','Season updated!');
        redirect('roomrates/season_list');
      } else {
        $errors_msg = 'Season not updated. Please try after some time...';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('roomrates/season_list');
      }
    } else {
        $errors_msg = 'Season not updated. Please try after some time...';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('roomrates/season_list');
      }
    
  }
}

public function policy_list() {
  $data['policy_info'] = '';
  $data['error']='';
  $data['action']='add_policy';
  $data['button']='Add Policy';
  $data['sub_view'] = 'roomrate/cancel_policy';
  $query =  $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('cancel_policy');
  $data['policy'] = $query->result();
  $this->load->view('_layout_main',$data);
}

public function add_policy() {
  $this->form_validation->set_rules('policy_name', 'Policy Name', 'trim|required');
  $this->form_validation->set_rules('policy_desc', 'Policy Description', 'trim|required');
  if($this->form_validation->run()==FALSE) {
    $errors_msg = validation_errors();
    $this->session->set_flashdata('errors_msg',$errors_msg);
    redirect('roomrates/policy_list');
  } else {
    $insertarray = array(
      'policy_name' => $_POST['policy_name'],
      'policy_desc' => $_POST['policy_desc'],
      'status' => 1,
      'supplier_id' => $this->supplier_id,
    );
    $this->db->insert('cancel_policy',$insertarray);
    $id = $this->db->insert_id();
    if($id != '') {
      $this->session->set_flashdata('message','Policy added!');
      redirect('roomrates/policy_list');
    } else {
      $errors_msg = 'Policy not added. Please try after some time...';
      $this->session->set_flashdata('errors_msg',$errors_msg);
      redirect('roomrates/policy_list');
    }
  }
}

public function edit_policy($id='') {
  // $id = isset($_GET['id'])?$_GET['id']:'';
  if($id != '') {
    $data['error']='';
    $data['action']='update_policy';
    $data['button']='Update Policy';
    $data['sub_view'] = 'roomrate/cancel_policy';
    $query = $this->db->select('*')->where('supplier_id', $this->supplier_id)->get('cancel_policy');
    $data['policy'] = $query->result();
    $query2 = $this->db->select('*')->where('id', $id)->get('cancel_policy');
    $data['policy_info'] = $query2->row();
    $this->load->view('_layout_main',$data);
  } else {
    redirect('roomrates/policy_list');
  }
}

public function update_policy() {
  $this->form_validation->set_rules('policy_name', 'Policy Name', 'trim|required');
  $this->form_validation->set_rules('policy_desc', 'Policy Description', 'trim|required');
  if($this->form_validation->run()==FALSE) {
    $errors_msg = validation_errors();
    $this->session->set_flashdata('errors_msg',$errors_msg);
    redirect('roomrates/policy_list');
  } else {
    $id = $this->input->post('policy_id');
    if($id != '') {
      $updata = array(
        'policy_name' => $_POST['policy_name'],
        'policy_desc' => $_POST['policy_desc'],
        // 'status' => 1,
        // 'supplier_id' => $this->supplier_id,
      );
      $this->db->where('id',$id);
      if($this->db->update('cancel_policy',$updata)) {
        $this->session->set_flashdata('message','Policy updated!');
        redirect('roomrates/policy_list');
      } else {
        $errors_msg = 'Policy not updated. Please try after some time...';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('roomrates/policy_list');
      }
    } else {
        $errors_msg = 'Policy not updated. Please try after some time...';
        $this->session->set_flashdata('errors_msg',$errors_msg);
        redirect('roomrates/policy_list');
      }
    
  }
}

public function set_status() {
  if($_POST['id']==''||$_POST['status']==''||$_POST['table']=='') {
    redirect('roomrates/'.$_POST['redirect']);
  }
  $message='';
  if($_POST['status'] == 0) { $message='Inactive'; }
  else if($_POST['status'] == 1) { $message='Active';}
  $updata = array('status' =>$_POST['status']);
  $this->db->where('id',$_POST['id']);
  if($this->db->update($_POST['table'],$updata)) {
    $this->session->set_flashdata('message','Status '.$message);
    echo "1";
  } else {
    echo "0";
  }
}


}
