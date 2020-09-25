<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class hotel extends CI_CONTROLLER 
{
    private $supplier_id;
    private $max_image_size = '2000';
    private $max_image_width = '1024';
    private $max_image_height = '900';
    function __construct() 
    {
        parent :: __construct();
        $this->load->database(); 
        $this->load->model('supplier_hotel_list');
        $this->load->model('supplier_room_list'); 
        $this->load->model('supplier_meeting_room_list');
        $this->load->model('glob_supplier_property_type');   
        $this->load->model('glob_supplier_hotel_group_chain');    
        $this->load->model('glob_supplier_room_type'); 
        $this->load->model('glob_supplier_salutation');   
        $this->load->model('glob_supplier_meal');   
        $this->load->model('glob_supplier_department');  
        $this->load->model('glob_supplier_designation'); 
        $this->load->model('glob_supplier_hotel_features_amenities');
        $this->load->model('glob_supplier_hotel_features_amenities_group'); 
        $this->load->model('glob_supplier_room_features_amenities');
        $this->load->model('glob_supplier_room_features_amenities_group'); 
        $this->load->model('glob_supplier_meeting_features_amenities');
        $this->load->model('glob_supplier_meeting_features_amenities_group');  
        $this->load->model('glob_supplier_cuisine'); 
        $this->load->model('glob_supplier_dining_type');         
        $this->load->model('glob_supplier_indian_cuisine_type'); 
        $this->load->model('glob_supplier_room_rate_includes'); 
        $this->load->model('glob_supplier_hotel_package_rate_includes'); 
        $this->load->model('glob_supplier_hotel_neighbourhood'); 
        $this->load->model('supplier_hotel_list_contact'); 
        $this->load->model('supplier_dining_list'); 
        $this->load->model('supplier_experience_list');
        $this->load->model('sup_hotel_room_rates_list'); 
        $this->load->model('sup_hotel_room_rates'); 
        $this->load->model('sup_hotel_package_cancellation_rates');
        $this->load->model('sup_hotel_package_rates_list'); 
        $this->load->model('sup_hotel_package_rates'); 
        $this->load->model('sup_hotel_room_cancellation_rates');
        $this->load->model('Upload_Model'); 
        $this->load->model('currency'); 
        $this->load->model('country'); 
        $this->load->model('ace_jac_roomsxml_gta_city'); 
        $this->load->model('glb_hotel_facilities_type');
        $this->load->model('glb_hotel_room_type');
        $this->load->model('glb_hotel_property_type');      
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->supplier_id = $this->session->userdata('supplier_id');
        $this->is_logged_in();
    }

    /* Check Partner  Login */
    private function is_logged_in() 
    {
        if (!$this->session->userdata('supplier_logged_in'))
        {
            redirect('login/supplier_login');
        }
    }


    public function add_hotel()
    {
        $dataarray=array('status'=>1);
        // $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray); 
        $data['propertytype'] =$this->glob_supplier_property_type->check($dataarray);
        $data['hotelgroup'] =$this->glob_supplier_hotel_group_chain->check($dataarray); 
        $data['hotel_neighbourhood'] =$this->glob_supplier_hotel_neighbourhood->check($dataarray); 
        // $dataarray=array('status'=>1,'facility_type'=>'hotel');  
        // $data['hotel_facilities'] =$this->glb_hotel_facilities_type->check($dataarray);
        $data['currency']=$this->currency->get('*');
        $data['country']=$this->country->get('*');
        $data['sub_view'] = 'hotel/add_hotel';
        $this->load->view('_layout_main',$data);
    }   

    public function edit_hotel() 
    {
        $data['hotel_id'] = $hotel_id = $_GET['id'];
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        // print_r($data['hotel_details']);exit;
        $dataarray=array('status'=>1);
        // $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray);
        $data['propertytype'] =$this->glob_supplier_property_type->check($dataarray);
        $data['hotelgroup'] =$this->glob_supplier_hotel_group_chain->check($dataarray);
        $data['hotel_neighbourhood'] =$this->glob_supplier_hotel_neighbourhood->check($dataarray);
        $data['country']=$this->country->get('*');
        $data['sub_view'] = 'hotel/edit_hotel';
        $this->load->view('_layout_main',$data);
    }

    public function edit_step2()
    {
        $data['hotel_id'] = $hotel_id = $_GET['id'];
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        $data['contact_details'] = $this->supplier_hotel_list_contact->check($dataarray);
          $dataarray2=array('status'=>1);
        $data['salutation'] = $this->glob_supplier_salutation->check($dataarray2);
        $data['designation'] = $this->glob_supplier_designation->check($dataarray2);
        $data['department'] = $this->glob_supplier_department->check($dataarray2);
        
        
        
        $data['currency']=$this->currency->get('*');
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        $dataarray1=array('status'=>1,'facility_type'=>'hotel');
        $data['hotel_facilities'] =$this->glb_hotel_facilities_type->check($dataarray1);
        $data['sub_view'] = 'hotel/edit_step2';
        $this->load->view('_layout_main',$data);
    }

     public function contact_form($id)
     {
        $dataarray2=array('status'=>1);
        $data['salutation'] = $this->glob_supplier_salutation->check($dataarray2);
        $data['designation'] = $this->glob_supplier_designation->check($dataarray2);
        $data['department'] = $this->glob_supplier_department->check($dataarray2);
        $data['hotel_id']=$id;
        echo json_encode(array('contact_form'=>$this->load->view('hotel/contact_form', $data, TRUE)));
     }

     public function reservations_number()
     {
        echo json_encode(array('reservations_number'=>$this->load->view('hotel/reservations_number', '', TRUE)));
     }
     public function business_hours()
     {
        echo json_encode(array('business_hours'=>$this->load->view('hotel/business_hours', '', TRUE)));
     }


    public function edit_step3()
    {
        $data['hotel_id'] = $hotel_id = $_GET['id'];
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        $dataarray1=array('status'=>1);
        $data['hotel_facilities_group']=$hotel_facilities_group =$this->glob_supplier_hotel_features_amenities_group->check($dataarray1);
         $hotel_facilities=$this->glob_supplier_hotel_features_amenities->check($dataarray1);
         $hotel_facilities_arr=array();
         for($i=0;$i<count($hotel_facilities_group);$i++)
          {
            for($j=0;$j<count($hotel_facilities);$j++)
            {
                if($hotel_facilities[$j]->group_id==$hotel_facilities_group[$i]->id)
                {
                 $hotel_facilities_arr[$hotel_facilities_group[$i]->id][]=$hotel_facilities[$j];
                }
            }
        }
         $data['hotel_facilities']=$hotel_facilities_arr;   
           $data['supplier_hotel_gallery_images'] = $this->Upload_Model->supplier_hotel_images($hotel_id,'supplier_hotel_gallery_images','*');    
       

        $data['sub_view'] = 'hotel/edit_step3';
        $this->load->view('_layout_main',$data);
    }

    public function edit_step4()
    {
        $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:'';
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }

        $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details'] =$this->supplier_room_list->check($dataarray);
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details_list'] =$this->supplier_room_list->check($dataarray);
        if(!empty($data['room_details_list']))
        {
            $data['total_room_count']=count($data['room_details_list']);
        }
        else
        {
           $data['total_room_count']=0;
        }
        $dataarray1=array('status'=>1);
        $data['room_facilities_group']=$room_facilities_group =$this->glob_supplier_room_features_amenities_group->check($dataarray1);
         $room_facilities=$this->glob_supplier_room_features_amenities->check($dataarray1);
         $room_facilities_arr=array();
         for($i=0;$i<count($room_facilities_group);$i++)
          {
            for($j=0;$j<count($room_facilities);$j++)
            {
                if($room_facilities[$j]->group_id==$room_facilities_group[$i]->id)
                {
                 $room_facilities_arr[$room_facilities_group[$i]->id][]=$room_facilities[$j];
                }
            }
        }
        $data['room_facilities']=$room_facilities_arr;   
        $data['supplier_room_gallery_images'] = $this->Upload_Model->supplier_room_images($room_id,'supplier_room_gallery_images','*');  
        $dataarray=array('status'=>1);
        $data['roomtype'] =$this->glob_supplier_room_type->check($dataarray); 
        $data['sub_view'] = 'hotel/edit_step4';
        $this->load->view('_layout_main',$data);
    }

    public function edit_step5() 
    {   
        $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:'';
        $data['weekdays'] = $weekdays = isset($_GET['weekdays'])?$_GET['weekdays']:'';
        $data['sup_hotel_room_rates_list_id'] = $sup_hotel_room_rates_list_id = isset($_GET['id2'])?$_GET['id2']:'';
        $data['code'] = $code = isset($_GET['code'])?$_GET['code']:'';
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);

        $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details'] =$this->supplier_room_list->check($dataarray);
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details_list'] =$this->supplier_room_list->check($dataarray);
    
        $dataarray=array('sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,'room_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);
        $data['room_rate_details']=$this->sup_hotel_room_rates_list->check($dataarray);
        // print_r($data['room_rate_details']); exit;
        if($code!='')
        {
          $dataarray=array('room_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);  
        }
        else
        {
         $dataarray=array('hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);   
        }
        $data['room_rate_list']=$this->sup_hotel_room_rates_list->check($dataarray);

        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        else if(empty($data['room_details_list']))
        { 
          $this->session->set_flashdata('message','Kindly Add The Rooms !!!!!'); 
           redirect('hotel/edit_step4?id='.$hotel_id,'refresh'); 
        }
        else if(empty($data['room_details'])&&isset($_GET['id1']))
        {
           redirect('hotel/edit_step5?id='.$hotel_id,'refresh'); 
        }
        else if(empty($data['room_rate_details'])&&isset($_GET['code']))
        {
            redirect('hotel/edit_step5?id='.$hotel_id.'&id1='.$room_id,'refresh'); 
        }



      
        $dataarray=array('status'=>1);
        $data['roomtype'] =$this->glob_supplier_room_type->check($dataarray);      
        $data['room_rate_include'] =$this->glob_supplier_room_rate_includes->check($dataarray);
        $data['currency']=$this->currency->get('*');
        $data['sub_view'] = 'hotel/edit_step5';
        $this->load->view('_layout_main',$data);
    }

    public function view_step5() 
    {  
        $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:'';
        $data['sup_hotel_room_rates_list_id'] = $sup_hotel_room_rates_list_id = isset($_GET['id2'])?$_GET['id2']:'';
        $data['code'] = $code = isset($_GET['code'])?$_GET['code']:'';
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] =$hotel_details= $this->supplier_hotel_list->check($dataarray);

        $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details'] =$this->supplier_room_list->check($dataarray);
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details_list'] =$this->supplier_room_list->check($dataarray);
    
   
        if($room_id!='')
        {
          $dataarray=array('hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);  
        }
        else
        {
         $dataarray=array('hotel_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);   
        }
        $data['room_rate_list']=$rate_list=$this->sup_hotel_room_rates_list->check($dataarray);

        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
       else if(empty($data['room_details_list']))
        { 
          $this->session->set_flashdata('message','Kindly Add The Rooms !!!!!'); 
           redirect('hotel/edit_step4?id='.$hotel_id,'refresh'); 
        }
        else if(empty($data['room_details'])&&isset($_GET['id1']))
        {
           redirect('hotel/view_step5?id='.$hotel_id,'refresh'); 
        }

        $rate_list_arr=array();
        foreach($rate_list as $val)
        {
            $rate_list_arr[$val->rate_name]=$val->room_rate_code;
        }
         $data['rate_list']=$rate_list_arr;
        $data['sub_view'] = 'hotel/view_step5';
        $this->load->view('_layout_main',$data);
    }

public function room_rate_list()
{
    if(isset($_POST['code']))
    {
         $room_code=$_POST['code']; 
         $dataarray=array('room_code'=>$room_code,'supplier_id'=>$this->supplier_id);
         $rate_list =$this->sup_hotel_room_rates_list->check($dataarray);
         $rate_list_arr=array();
         foreach($rate_list as $val)
         {
             $rate_list_arr[$val->rate_name]=$val->room_rate_code;
         }      
         $data['rate_list']=$rate_list_arr;
         echo json_encode(array('rate_list'=>$this->load->view('hotel/rate_list', $data, TRUE)));
    }
}

public function view_rate_list($id='')
{
    if(isset($_POST['todo']))
    {
         $from_date=strtotime($_POST['start_date']);
         $to_date=strtotime($_POST['end_date']);
         $start_date= date("Y-m-d", $from_date);
         $end_date= date("Y-m-d", $to_date);
         $todo =  isset($_POST['todo'])?$_POST['todo']:'';
         $room_code =  isset($_POST['room_list'])?$_POST['room_list']:'';
         $room_rate_code =  isset($_POST['rate_list'])?$_POST['rate_list']:'';
         $hotel_id =  isset($_POST['insert_id'])?$_POST['insert_id']:'';
        if($id==2&&$todo==$id)
        {
             if($room_rate_code!='')
            {
              $dataarray=array('room_rate_code'=>$room_rate_code,'hotel_id'=>$hotel_id,'room_code'=>$room_code,'supplier_id'=>$this->supplier_id);  
            }
            else
            {
             $dataarray=array('hotel_id'=>$hotel_id,'room_code'=>$room_code,'supplier_id'=>$this->supplier_id);   
            }
            $data['room_rate_list']=$this->sup_hotel_room_rates->check($dataarray);
            $dataarray=array('room_code'=>$room_code,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
             $data['room_details'] =$this->supplier_room_list->check($dataarray);
             echo json_encode(array('data_list'=>$this->load->view('hotel/room_rate_list', $data, TRUE)));
                
        }
        else if($id==1&&$todo==$id)
        {
            if($room_rate_code!='')
            {
              $dataarray=array('room_rate_code'=>$room_rate_code,'hotel_id'=>$hotel_id,'room_code'=>$room_code,'supplier_id'=>$this->supplier_id);  
            }
            else
            {
             $dataarray=array('hotel_id'=>$hotel_id,'room_code'=>$room_code,'supplier_id'=>$this->supplier_id);   
            }
            $data['room_rate_list']=$this->sup_hotel_room_rates->check($dataarray);
            $dataarray=array('room_code'=>$room_code,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
             $data['startdate']=$start_date;
             $data['enddate']=$end_date;            
             $data['room_code']=$room_code;
             $data['room_rate_code']=$room_rate_code;
             $data['hotel_id']=$hotel_id;
             $data['room_details'] =$this->supplier_room_list->check($dataarray);
             // print_r($data); exit;
             echo json_encode(array('data_list'=>$this->load->view('hotel/calendar', $data, TRUE)));
                
        }
    }
}

public function edit_rates()
{
    if(isset($_POST))
    {
        $data['id']=$id=$_POST['id'];
        $data['id1']=$id1=$_POST['id1'];
        $data['list_id']=$list_id=$_POST['list_id'];
        $data['code']=$code=$_POST['code'];
        $data['index']=$index=$_POST['index'];
        $dataarray=array('hotel_id'=>$id,'room_code'=>$id1,'sup_hotel_room_rates_id'=>$list_id,'room_rate_code'=>$code,'supplier_id'=>$this->supplier_id);
        $rate_details=$this->sup_hotel_room_rates->check($dataarray);
        $data['rate_details']=$rate_details[0];
        $dataarray=array('supplier_hotel_list_id'=>$id,'room_code'=>$id1,'supplier_id'=>$this->supplier_id);
        $room_details=$this->supplier_room_list->check($dataarray);
        $data['room_details']=$room_details[0];
        if(!empty($room_details)&&!empty($rate_details))
        {
          echo  json_encode(array('loadmodal'=>$this->load->view('hotel/load_ajax_rate_modal', $data, TRUE)));         
        }
   }
}

public function update_room_rates($id='')
{   
    if(isset($_POST)&&$id==$_POST['hotel_id'])
    {
            $data['id1']=$room_code=$_POST['room_code'];
            $data['id']=$hotel_id=$_POST['hotel_id'];
            $data['code']=$room_rate_code=$_POST['room_rate_code'];
            $data['list_id']=$sup_hotel_room_rates_id=$_POST['sup_hotel_room_rates_id'];
            $data['index']=$index=$_POST['index'];
            $dataarray=array(
                              'rate_type'=>$_POST['rate_type'],
                              'commission'=>$_POST['commission'],
                              'published_rate'=>$_POST['published_rate'],
                              'single_occupancy_rate'=>$_POST['single_occupancy_rate'],
                              'twin_occupancy_rate'=>$_POST['twin_occupancy_rate'],
                              'triple_occupancy_rate_extrabed'=>$_POST['triple_occupancy_rate_extrabed'],
                              'triple_occupancy_rate'=>$_POST['triple_occupancy_rate'],
                              'quad_occupancy_rate'=>$_POST['quad_occupancy_rate'],
                              'child_rate'=>$_POST['child_rate'],
                            );
             $this->sup_hotel_room_rates->update_room_rates($hotel_id,$room_code,$room_rate_code,$sup_hotel_room_rates_id,$this->supplier_id,$dataarray);
         
        $dataarray=array('hotel_id'=>$hotel_id,'room_code'=>$room_code,'sup_hotel_room_rates_id'=>$sup_hotel_room_rates_id,'room_rate_code'=>$room_rate_code,'supplier_id'=>$this->supplier_id);
        $rate_details=$this->sup_hotel_room_rates->check($dataarray);
        $data['rate_details']=$rate_details[0]; 
         if(!empty($rate_details))
        {
         echo json_encode(array('modalservermsg'=>' Successfully Updated!','modal_index'=>$this->load->view('hotel/modal_room_rate_index', $data, TRUE)));     
        }
        else
        {
         echo json_encode(array('modalservermsg'=>' Try After Sometimes..','modal_index'=>''));     
        }
 
   }
   else{
    echo json_encode(array('modalservermsg'=>' Illegal Access.. ','modal_index'=>''));  
    }
}

public function get_room_rate_monthlist()
{   
     
    $room_code = $_POST['room_code'];
    $hotel_id = $_POST['hotel_id']; 
    $room_rate_code = $_POST['room_rate_code']; 
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_code, $startdate, $enddate,$room_rate_code,$this->supplier_id);
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
    $room_code = $_POST['room_code'];
    $hotel_id = $_POST['hotel_id']; 
    $room_rate_code = $_POST['room_rate_code']; 
    $startdate = date('Y-m-d', strtotime($year . '-' .$month. '-1'));
    $enddate = date('Y-m-d', strtotime($yearend . '-' . $monthend. '-1'));
    $calender_data = $this->sup_hotel_room_rates->get_roomrates_by_date($room_code, $startdate, $enddate,$room_rate_code,$this->supplier_id);  
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



public function roomrates_calendar($calender_data)
{
// print_r($calender_data); exit;
  $calendar=array();
  $calendar_date=array();
   $k=0;
   for($i=0;$i<count($calender_data)&&!empty($calender_data[0]);$i++,$k++)
  {   
          
          $room_rate_include=$this->glob_supplier_room_rate_includes->check(array('status'=>1));

           $room_rate_include_arr=explode(',',$calender_data[$i]->room_rate_include);

           $rate_include=array();
           for($j=0;$j<count($room_rate_include);$j++)
            {
              if(in_array($room_rate_include[$j]->id, $room_rate_include_arr))
              {
                  $rate_include[]=$room_rate_include[$j]->name;
              }
            }
            $rate_include_str=implode(' , ', $rate_include); 
 
           
          $calendar[$k]="<small>Rate Name : ".$calender_data[$i]->rate_name. 
            "<br>Rate Code (WhiteLight) : ".$calender_data[$i]->room_rate_code.
             "<br>Rate Code : ".$calender_data[$i]->rate_code.
            "<br>Currency : ".$calender_data[$i]->currency_type.        
            "<br>Single Occupancy : ".$calender_data[$i]->single_occupancy_rate.
            "<br>Double/Twin Occupancy : ".$calender_data[$i]->twin_occupancy_rate.
            "<br>Extra Bed(Triple Occupancy) : ".$calender_data[$i]->triple_occupancy_rate_extrabed.
            "<br>Triple Occupancy : ".$calender_data[$i]->triple_occupancy_rate.
            "<br>Quad Occupancy : ".$calender_data[$i]->quad_occupancy_rate.
            "<br>Child Age : ".$calender_data[$i]->max_room_occupancy.
            "<br>Child Rate : ".$calender_data[$i]->childminage.' - '.$calender_data[$i]->childmaxage.           
            "<br>Room Rate Includes : ".$rate_include_str."</small>";
            $calendar_date[$k]=$calender_data[$i]->room_avail_date;

     
      
    }
      return array($calendar,$calendar_date); 
}



  public function edit_step6() 
    {  
        $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:'';
        $data['sup_hotel_package_rates_list_id'] = $sup_hotel_package_rates_list_id = isset($_GET['id2'])?$_GET['id2']:'';
        $data['code'] = $code = isset($_GET['code'])?$_GET['code']:'';
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);

        $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details'] =$this->supplier_room_list->check($dataarray);
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['room_details_list'] =$this->supplier_room_list->check($dataarray);
    
        $dataarray=array('sup_hotel_package_rates_list_id'=>$sup_hotel_package_rates_list_id,'package_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);
        $data['package_rate_details']=$this->sup_hotel_package_rates_list->check($dataarray);
        // print_r($data['room_rate_details']); exit;
        if($code!='')
        {
          $dataarray=array('package_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);  
        }
        else
        {
         $dataarray=array('hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);   
        }
        $data['package_rate_list']=$this->sup_hotel_package_rates_list->check($dataarray);

        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        else if(empty($data['room_details_list']))
        {  
           $this->session->set_flashdata('message','Kindly Add The Rooms !!!!!'); 
           redirect('hotel/edit_step4?id='.$hotel_id,'refresh'); 
        }
        else if(empty($data['room_details'])&&isset($_GET['id1']))
        {
           redirect('hotel/edit_step6?id='.$hotel_id,'refresh'); 
        }
        else if(empty($data['package_rate_details'])&&isset($_GET['code']))
        {
            redirect('hotel/edit_step6?id='.$hotel_id.'&id1='.$room_id,'refresh'); 
        }
             
        $dataarray=array('status'=>1);
        $data['roomtype'] =$this->glob_supplier_room_type->check($dataarray);   
        $data['currency']=$this->currency->get('*');
        $data['sub_view'] = 'hotel/edit_step6';
        $this->load->view('_layout_main',$data);
    }



   public function edit_step7()
    {
        $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
        $data['meeting_room_id'] = $meeting_room_id = isset($_GET['id1'])?$_GET['id1']:'';
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }

        $dataarray=array('supplier_meeting_room_list_id'=>$meeting_room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['meeting_room_details'] =$this->supplier_meeting_room_list->check($dataarray);
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['meeting_room_details_list'] =$this->supplier_meeting_room_list->check($dataarray);
        $dataarray1=array('status'=>1);
        $data['meeting_room_facilities_group']=$meeting_facilities_group =$this->glob_supplier_meeting_features_amenities_group->check($dataarray1);
         $meeting_facilities=$this->glob_supplier_meeting_features_amenities->check($dataarray1);
         $meeting_facilities_arr=array();
         for($i=0;$i<count($meeting_facilities_group);$i++)
          {
            for($j=0;$j<count($meeting_facilities);$j++)
            {
                if($meeting_facilities[$j]->group_id==$meeting_facilities_group[$i]->id)
                {
                 $meeting_facilities_arr[$meeting_facilities_group[$i]->id][]=$meeting_facilities[$j];
                }
            }
        }
         $data['meeting_room_facilities']=$meeting_facilities_arr; 

        $data['supplier_meeting_gallery_images'] = $this->Upload_Model->supplier_meeting_room_images($meeting_room_id,'supplier_meeting_gallery_images','*');  
         $data['supplier_meeting_outdoor_venue_gallery_images'] = $this->Upload_Model->supplier_meeting_room_images($meeting_room_id,'supplier_meeting_outdoor_venue_gallery_images','*');  
        // echo "<pre>"; print_r($data); exit;

        

        $data['sub_view'] = 'hotel/edit_step7';
        $this->load->view('_layout_main',$data);
    }

     public function edit_step8()
     {
            $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
            $data['dining_id'] = $dining_id = isset($_GET['id1'])?$_GET['id1']:'';
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
            if(empty($data['hotel_details'])||!isset($_GET['id']))
            {
                redirect('hotel/hotel_list','refresh');
            }

            $dataarray=array('supplier_dining_list_id'=>$dining_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['dining_details'] =$this->supplier_dining_list->check($dataarray);
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['dining_details_list'] =$this->supplier_dining_list->check($dataarray);
            $dataarray1=array('status'=>1);
            $data['cuisine']=$this->glob_supplier_cuisine->check($dataarray1); 
            $data['dining_type']=$this->glob_supplier_dining_type->check($dataarray1);
            $data['indian_cuisine_type']=$this->glob_supplier_indian_cuisine_type->check($dataarray1); 
            $data['supplier_dining_gallery_images'] = $this->Upload_Model->supplier_dining_images($dining_id,'supplier_dining_gallery_images','*');
            // print_r( $data['cuisine']);exit;

            $data['sub_view'] = 'hotel/edit_step8';
            $this->load->view('_layout_main',$data);
    }

     public function edit_step9()
     {
            $data['hotel_id'] = $hotel_id =  isset($_GET['id'])?$_GET['id']:'';
            $data['experience_id'] = $experience_id = isset($_GET['id1'])?$_GET['id1']:'';
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
            if(empty($data['hotel_details'])||!isset($_GET['id']))
            {
                redirect('hotel/hotel_list','refresh');
            }

            $dataarray=array('supplier_experience_list_id'=>$experience_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['experience_details'] =$this->supplier_experience_list->check($dataarray);
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['experience_details_list'] =$this->supplier_experience_list->check($dataarray);        
            $data['supplier_experience_gallery_images'] = $this->Upload_Model->supplier_experience_images($experience_id,'supplier_experience_gallery_images','*');         

            $data['sub_view'] = 'hotel/edit_step9';
            $this->load->view('_layout_main',$data);
    }




     public function edit_step10()
    {
        $data['hotel_id'] = $hotel_id = $_GET['id'];
        $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
        $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
        if(empty($data['hotel_details'])||!isset($_GET['id']))
        {
            redirect('hotel/hotel_list','refresh');
        }
        $data['sub_view'] = 'hotel/edit_step10';
        $this->load->view('_layout_main',$data);
    }

    public function save_step1($check_insert='') 
    {
        // echo '<pre>11';print_r($_POST);exit;
        $this->form_validation->set_rules('hotel_name', 'Property Name', 'trim|required');
        if($this->form_validation->run()==FALSE) 
        {
            echo json_encode(array(
                            'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                            'validation_status' => true,
                            'insert_id' => $check_insert,
                           ));
        }
        else
        { 
            $property_code = $this->supplier_hotel_list->get_last_hotel_code();
            $property_code = str_pad($property_code + 1, 10, 0, STR_PAD_LEFT);
             $hotel_telephone=explode(',', $this->input->post('hotel_telephone')); 
            $hotel_telephone_arr=array();
            foreach ($hotel_telephone as $val) {
               $len=strlen($val);
               $first=substr($val, 0,1);
               $second=substr($val, 1,$len-1);             
               if($first=="+" && ctype_digit($second))
               {

                    $hotel_telephone_arr[]=$val;
               }
             } 
            $cityName = $this->input->post('cityName');
            preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $cityName, $out);
            $cityCode = $out[1][0];
            $data = array(
                'supplier_id' =>$this->supplier_id,             
                'property_code' =>  $property_code,
                'hotel_name' => $this->input->post('hotel_name'),
                'hotel_property_type' =>implode(',',$this->input->post('hotel_property_type')),
                'hotel_desc' => stripslashes($this->input->post('hotel_desc')),
                'hotel_star_rating' => $this->input->post('hotel_star_rating'),
                'hotel_group' =>$this->input->post('hotel_group'),
                'hotel_code' => $this->input->post('hotel_code'),
                'property_address' => $this->input->post('hotel_address').', '.$this->input->post('hotel_city').', '.$this->input->post('hotel_state').', '.$this->input->post('hotel_country').', '.$this->input->post('hotel_pin'),
                'hotel_address' => $this->input->post('hotel_address'),
                'hotel_neighbourhood' => $this->input->post('hotel_neighbourhood'),
                'hotel_city' => $this->input->post('hotel_city'),
                'hotel_state' => $this->input->post('hotel_state'),
                'hotel_pin' => $this->input->post('hotel_pin'),
                'hotel_country' => $this->input->post('hotel_country'),
                'hotel_telephone' => implode(',', $hotel_telephone_arr),
                'hotel_website' => $this->input->post('hotel_web'),
                'hotel_fax' => $this->input->post('hotel_fax'),
                'hotel_email' => $this->input->post('hotel_email'),
                'location' => $this->input->post('location'),
                'latitude' =>$this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'cityid'=> $cityCode,             
                'cityName'=> $cityName,             
                'created_date'=>date('Y-m-d')
            );
            // echo '<pre>11';print_r($data);exit;
            $check_insert = $this->input->post('insert_id');
            if($check_insert == '')
            {
                $insert_id = $this->supplier_hotel_list->insert($data);
                echo json_encode(array('insert_id' => $insert_id));
            } 
            else
            {
                $this->supplier_hotel_list->update($data, $check_insert);
                echo json_encode(array('insert_id' => $check_insert));
            }
            $this->session->set_flashdata('message','Step 1 Completed!');
        }
    }

    public function update_step1($hotel_id)
    {
        // echo '<pre>11';print_r($_REQUEST); exit;
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');    
        if($this->form_validation->run()==FALSE)
        {   
             echo json_encode(array(
                                    'validation_error' => validation_errors(),
                                    'insert_id' => $hotel_id
                                ));
         }
         else 
         {
             $hotel_telephone=explode(',', $this->input->post('hotel_telephone')); 
            $hotel_telephone_arr=array();
            foreach ($hotel_telephone as $val) {
               $len=strlen($val);
               $first=substr($val, 0,1);
               $second=substr($val, 1,$len-1);             
               if($first=="+" && ctype_digit($second))
               {

                    $hotel_telephone_arr[]=$val;
               }
             } 
            $cityName = $this->input->post('cityName');
            preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $cityName, $out);
            $cityCode = $out[1][0];
            $data = array(          
                       'hotel_name' => $this->input->post('hotel_name'),
                        'hotel_property_type' =>implode(',',$this->input->post('hotel_property_type')),
                        'hotel_desc' => stripslashes($this->input->post('hotel_desc')),
                        'hotel_star_rating' => $this->input->post('hotel_star_rating'),
                        'hotel_group' =>$this->input->post('hotel_group'),
                        'hotel_code' => $this->input->post('hotel_code'),
                        'property_address' => $this->input->post('hotel_address').', '.$this->input->post('hotel_city').', '.$this->input->post('hotel_state').', '.$this->input->post('hotel_country').', '.$this->input->post('hotel_pin'),
                        'hotel_address' => $this->input->post('hotel_address'),
                        'hotel_neighbourhood' => $this->input->post('hotel_neighbourhood'),
                        'hotel_city' => $this->input->post('hotel_city'),
                        'hotel_state' => $this->input->post('hotel_state'),
                        'hotel_pin' => $this->input->post('hotel_pin'),
                        'hotel_country' => $this->input->post('hotel_country'),
                        'hotel_telephone' => implode(',', $hotel_telephone_arr),
                        'hotel_website' => $this->input->post('hotel_web'),
                        'hotel_fax' => $this->input->post('hotel_fax'),
                        'hotel_email' => $this->input->post('hotel_email'),
                        'location' => $this->input->post('location'),
                        'latitude' =>$this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),   
                        'longitude' =>$this->input->post('longitude'),
                        'cityid'=> $cityCode,             
                        'cityName'=> $cityName, 
                        );
           
                    $this->supplier_hotel_list->update($data, $hotel_id);
                     echo json_encode(array('insert_id' => $hotel_id));
                    $this->session->set_flashdata('message','Step 1 Updated Successfully!');
        }
    }

    public function update_step2($hotel_id)
    {   

          
        if(!empty($_POST['contact_mobile']))
        {
             $this->supplier_hotel_list_contact->delete_contact($this->supplier_id,$hotel_id);
              $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
             $hotel_details=$this->supplier_hotel_list->check($dataarray);

             for($i=0;$i<count($_POST['contact_mobile']);$i++)
            {
              $contactdata=array(
                                'supplier_id' =>$this->supplier_id,
                                'supplier_hotel_list_id' =>$hotel_id,
                                'property_code' =>$hotel_details[0]->property_code,
                                'contact_title' => $_POST['contact_title'][$i],
                                'contact_name' => $_POST['contact_name'][$i],
                                'contact_surname' => $_POST['contact_surname'][$i],
                                'contact_department' => $_POST['contact_department'][$i],
                                'contact_role' => $_POST['contact_role'][$i],
                                'contact_telephone' => $_POST['contact_telephone'][$i],
                                'contact_mobile' => $_POST['contact_mobile'][$i],
                                'contact_email' => $_POST['contact_email'][$i],
                                'created_date'=>date('Y-m-d'),
                                );                  
              $this->supplier_hotel_list_contact->insert($contactdata);  
            }
        }   
      
          echo json_encode(array('insert_id' => $hotel_id));
          $this->session->set_flashdata('message','Step 2 Updated Successfully!');
      
    }
    
    public function update_step3($hotel_id)
    {
          // print_r($_POST); exit;
         $dataarray1=array('status'=>1);
         $hotel_facilities_group =$this->glob_supplier_hotel_features_amenities_group->check($dataarray1);
         $hotel_facilities_arr=array();
         for($i=0;$i<count($hotel_facilities_group);$i++)
         {
           if(isset($_POST['hotel_facilities_'.$hotel_facilities_group[$i]->id]))
           {
              $hotel_facilities_arr[$hotel_facilities_group[$i]->id]=implode(',', $_POST['hotel_facilities_'.$hotel_facilities_group[$i]->id]);
           
           }
         }
         if(!empty($hotel_facilities_arr))
         {          
            $data = array(
                'hotel_facilities' =>json_encode($hotel_facilities_arr),
                 );    
             $this->supplier_hotel_list->update($data, $hotel_id);
         }
        echo json_encode(array('insert_id' => $hotel_id));
        $this->session->set_flashdata('message','Step 3 Updated Successfully!');

    }


    public function update_step4($hotelid,$roomid)
    {
         $this->form_validation->set_rules('room_name', 'Room Name', 'trim|required');
          if($hotelid!==$_POST['hotel_id'])
          {
            redirect('hotel/hotel_list','refresh');
          }
         else if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {   
                $hotel_id=$this->input->post('hotel_id'); 
                $room_id=$this->input->post('room_id');
                 $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $hotel_details=$this->supplier_hotel_list->check($dataarray);
                if(!empty($room_id)){
                $dataarray=array('supplier_room_list_id'=>$room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $room_details=$this->supplier_room_list->check($dataarray);
                 }
                 else
                 {
                    $room_details='';
                 }
                $dataarray1=array('status'=>1);
                $room_facilities_group =$this->glob_supplier_room_features_amenities_group->check($dataarray1);
                 $room_facilities_arr=array();
                 for($i=0;$i<count($room_facilities_group);$i++)
                 {
                   if(isset($_POST['room_facilities_'.$room_facilities_group[$i]->id]))
                   {
                      $room_facilities_arr[$room_facilities_group[$i]->id]=implode(',', $_POST['room_facilities_'.$room_facilities_group[$i]->id]);
                   
                   }
                 }          
           
            if(!empty($room_details))
            {
                $updatedata=array(
                            'supplier_id' =>$this->supplier_id,
                            'room_name' => $this->input->post('room_name'),
                            'hotel_room_type' => $this->input->post('hotel_room_type'),
                            'room_desc' => $this->input->post('room_desc'), 
                            'no_of_rooms' => $this->input->post('no_of_rooms'),
                            'room_size' => $this->input->post('room_size'),   
                            'room_unit' => $this->input->post('room_unit'),
                            'minadult' => $this->input->post('minadult'),
                            'maxadult' => $this->input->post('maxadult'),
                            'minchild' => $this->input->post('minchild'),
                            'maxchild' => $this->input->post('maxchild'),
                            'room_facilities' =>json_encode($room_facilities_arr),
                             );
                 $this->supplier_room_list->update($updatedata,$room_id);
                 echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$room_id));
                 $this->session->set_flashdata('message','Step 4 Updated Successfully!');
            }
            else
            {
                
                $room_code = $this->supplier_room_list->get_last_room_code();
                $room_code = str_pad($room_code + 1, 10, 0, STR_PAD_LEFT);
                $insertdata=array(
                                'supplier_id' =>$this->supplier_id,
                                'supplier_hotel_list_id'=>$this->input->post('hotel_id'),
                                'property_code' => $hotel_details[0]->property_code,
                                'room_code'=>$room_code,
                                'room_name' => $this->input->post('room_name'),
                                'hotel_room_type' => $this->input->post('hotel_room_type'),
                                'room_desc' => $this->input->post('room_desc'), 
                                'no_of_rooms' => $this->input->post('no_of_rooms'),
                                'room_size' => $this->input->post('room_size'),  
                                'room_unit' => $this->input->post('room_unit'), 
                                'minadult' => $this->input->post('minadult'),
                                'maxadult' => $this->input->post('maxadult'),
                                'minchild' => $this->input->post('minchild'),
                                'maxchild' => $this->input->post('maxchild'),
                                'room_facilities' =>json_encode($room_facilities_arr),
                                'created_date'=>date('Y-m-d')
                                 );
                $insert_id = $this->supplier_room_list->insert($insertdata);               
                echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$insert_id));
                $this->session->set_flashdata('message','Step 4 Updated Successfully!');
            }
           
        }
    }


  public function update_step5($hotelid,$roomid)
    {      
       $dataarray=array(
                  'supplier_hotel_list_id'=>$hotelid,                 
                  'supplier_id'=>$this->supplier_id,                
                 );
         $data['room_list'] =$this->supplier_room_list->check($dataarray);
          if($hotelid!==$_POST['hotel_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/hotel_list';
            </script>
          <?php
          
          }
          else if($roomid!==$_POST['room_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/edit_step5?id=<?php echo $hotelid; ?>';
            </script>
        <?php
            
          }
        else if($this->input->server('REQUEST_METHOD') === 'POST')
        { 
          $this->form_validation->set_rules('rate_name', 'Rate Name', 'trim|required');
          if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {       $supplier_id=$this->supplier_id; 
                    $rate_name =isset($_POST['rate_name'])?$_POST['rate_name']:'';
                    $weekdays =isset($_POST['weekdays'])?$_POST['weekdays']:'';
                    $room_id =isset($_POST['room_id'])?$_POST['room_id']:'';
                    $hotel_id = isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
                    $rate_code = isset($_POST['rate_code'])?$_POST['rate_code']:'';
                    $rate_desc = isset($_POST['rate_desc'])?stripslashes($_POST['rate_desc']):'';
                    $rate_type = isset($_POST['rate_type'])?$_POST['rate_type']:'';
                    $commission = isset($_POST['commission'])?$_POST['commission']:'';
                    $published_rate = isset($_POST['published_rate'])?$_POST['published_rate']:'';
                    $taxes_included=isset($_POST['taxes_included'])?$_POST['taxes_included']:'';
                    $supplier_tax_percent = isset($_POST['supplier_tax_percent'])?$_POST['supplier_tax_percent']:'';
                    $currency_type =  isset($_POST['currency_type'])?$_POST['currency_type']:'';
                   
                    $room_rate_include = isset($_POST['room_rate_include'])?$_POST['room_rate_include']:'';
                    $single_occupancy_rate = isset($_POST['single_occupancy_rate'])?$_POST['single_occupancy_rate']:'';
                    $twin_occupancy_rate = isset($_POST['twin_occupancy_rate'])?$_POST['twin_occupancy_rate']:'';
                    $triple_occupancy_rate_extrabed = isset($_POST['triple_occupancy_rate_extrabed'])?$_POST['triple_occupancy_rate_extrabed']:'';
                    $triple_occupancy_rate =  isset($_POST['triple_occupancy_rate'])?$_POST['triple_occupancy_rate']:'';
                    $quad_occupancy_rate =  isset($_POST['quad_occupancy_rate'])?$_POST['quad_occupancy_rate']:'';
                    $childminage = isset($_POST['childminage'])?$_POST['childminage']:'';
                    $childmaxage = isset($_POST['childmaxage'])?$_POST['childmaxage']:'';
                    $child_rate =  isset($_POST['child_rate'])?$_POST['child_rate']:'';
                   

                    $check_in_policy =  isset($_POST['check_in_policy'])?$_POST['check_in_policy']:'';
                    $check_out_policy =  isset($_POST['check_out_policy'])?$_POST['check_out_policy']:'';
                    $children_policy =  isset($_POST['children_policy'])?stripslashes($_POST['children_policy']):'';

                    $cancellation_policy=array();      
                    if(isset($_POST['non_refundable']))
                    {
                       $cancellation_policy[0]='0||'.$_POST['non_refundable'];
                    }
                    else
                    {
                      for($i=0;$i<count($_POST['days_before'])&&isset($_POST['days_before'])&&isset($_POST['cancel_rates']);$i++)
                      {
                         $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
                      } 
                    }
                      $property_code =$this->supplier_hotel_list->get_single($hotel_id)->property_code;
                     $room_detail=$this->supplier_room_list->get_single($room_id);     
                     $room_code =$room_detail->room_code;


                       $from_date=strtotime($_POST['start_date']);
                        $to_date=strtotime($_POST['end_date']);
                        $start_date= date("Y-m-d", $from_date);
                        $end_date= date("Y-m-d", $to_date);
                 $days=floor(($to_date - $from_date) / (60 * 60 * 24));   

                if(!isset($_POST['room_rate_code']))
                {

              
                  $room_rate_code = $this->sup_hotel_room_rates_list->get_last_room_rate_code();
                  $room_rate_code = str_pad($room_rate_code + 1, 10, 0, STR_PAD_LEFT);  


                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'room_rate_include' => implode(',',$room_rate_include),
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
       
          $sup_hotel_room_rates_list_id=$this->sup_hotel_room_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Step 5 Updated Successfully!'); 
           }
           else
           {     
                  
                   $room_rate_code=$_POST['room_rate_code'];
                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'weekdays'=>implode(',', $weekdays),
                    'room_rate_include' => implode(',',$room_rate_include),
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
          if(empty($weekdays)){
          $this->sup_hotel_room_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $start_date,$end_date);
          $this->sup_hotel_room_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $start_date,$end_date);
            }
       
          $sup_hotel_room_rates_list_id=$this->sup_hotel_room_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);  
              if(!empty($weekdays)){ 
              $day = date('D', strtotime($room_avail_date));
              if(in_array($day,$weekdays)){ 
              $this->sup_hotel_room_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $room_avail_date,$room_avail_date);
              $this->sup_hotel_room_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $room_avail_date,$room_avail_date); 
             
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
           }else{   
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Step 5 Updated Successfully!'); 
           }                   
                
       
         }
           
        }
    }

   
  public function update_step6($hotelid,$roomid)
    {   
     // echo "<pre>"; print_r($_POST); exit;   
       $dataarray=array(
                  'supplier_hotel_list_id'=>$hotelid,                 
                  'supplier_id'=>$this->supplier_id,                
                 );
         $data['room_list'] =$this->supplier_room_list->check($dataarray);
          if($hotelid!==$_POST['hotel_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/hotel_list';
            </script>
          <?php
          
          }
          else if($roomid!==$_POST['room_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/edit_step6?id=<?php echo $hotelid; ?>';
            </script>
        <?php
            
          }
        else if($this->input->server('REQUEST_METHOD') === 'POST')
        { 
          $this->form_validation->set_rules('package_name', 'Rate Name', 'trim|required');
          if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {       $supplier_id=$this->supplier_id;
                    $package_name =isset($_POST['package_name'])?$_POST['package_name']:'';
                    $room_id =isset($_POST['room_id'])?$_POST['room_id']:'';
                    $hotel_id = isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
                    $package_code = isset($_POST['package_code'])?$_POST['package_code']:'';
                    $package_desc = isset($_POST['package_desc'])?stripslashes($_POST['package_desc']):'';
                    $rate_type = isset($_POST['rate_type'])?$_POST['rate_type']:'';
                    $commission = isset($_POST['commission'])?$_POST['commission']:'';
                    $published_rate = isset($_POST['published_rate'])?$_POST['published_rate']:'';
                    $taxes_included=isset($_POST['taxes_included'])?$_POST['taxes_included']:'';
                    $supplier_tax_percent = isset($_POST['supplier_tax_percent'])?$_POST['supplier_tax_percent']:'';
                    $currency_type =  isset($_POST['currency_type'])?$_POST['currency_type']:'';
                   
                    $rate_include = isset($_POST['rate_include'])?stripslashes($_POST['rate_include']):'';
                     $rate_exclude = isset($_POST['rate_exclude'])?stripslashes($_POST['rate_exclude']):'';                     
                     $number_of_nights = isset($_POST['number_of_nights'])?$_POST['number_of_nights']:'';
                    $single_occupancy_rate = isset($_POST['single_occupancy_rate'])?$_POST['single_occupancy_rate']:'';
                    $twin_occupancy_rate = isset($_POST['twin_occupancy_rate'])?$_POST['twin_occupancy_rate']:'';
                    $triple_occupancy_rate_extrabed = isset($_POST['triple_occupancy_rate_extrabed'])?$_POST['triple_occupancy_rate_extrabed']:'';
                    $triple_occupancy_rate =  isset($_POST['triple_occupancy_rate'])?$_POST['triple_occupancy_rate']:'';
                    $quad_occupancy_rate =  isset($_POST['quad_occupancy_rate'])?$_POST['quad_occupancy_rate']:'';
                    $childminage = isset($_POST['childminage'])?$_POST['childminage']:'';
                    $childmaxage = isset($_POST['childmaxage'])?$_POST['childmaxage']:'';
                    $child_rate =  isset($_POST['child_rate'])?$_POST['child_rate']:'';
                   

                    $check_in_policy =  isset($_POST['check_in_policy'])?$_POST['check_in_policy']:'';
                    $check_out_policy =  isset($_POST['check_out_policy'])?$_POST['check_out_policy']:'';
                    $children_policy =  isset($_POST['children_policy'])?stripslashes($_POST['children_policy']):'';

                    $cancellation_policy=array();      
                    if(isset($_POST['non_refundable']))
                    {
                       $cancellation_policy[0]='0||'.$_POST['non_refundable'];
                    }
                    else
                    {
                      for($i=0;$i<count($_POST['days_before'])&&isset($_POST['days_before'])&&isset($_POST['cancel_rates']);$i++)
                      {
                         $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
                      } 
                    }
                      $property_code =$this->supplier_hotel_list->get_single($hotel_id)->property_code;
                     $room_detail=$this->supplier_room_list->get_single($room_id);     
                     $room_code =$room_detail->room_code;


                       $from_date=strtotime($_POST['start_date']);
                        $to_date=strtotime($_POST['end_date']);
                        $start_date= date("Y-m-d", $from_date);
                        $end_date= date("Y-m-d", $to_date);
                 $days=floor(($to_date - $from_date) / (60 * 60 * 24));   

                if(!isset($_POST['package_rate_code']))
                {

              
                  $package_rate_code = $this->sup_hotel_package_rates_list->get_last_package_rate_code();
                  $package_rate_code = str_pad($package_rate_code + 1, 10, 0, STR_PAD_LEFT);  


                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'rate_include' =>$rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
       
          $sup_hotel_package_rates_list_id=$this->sup_hotel_package_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'rate_include' => $rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_package_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Step 6 Updated Successfully!'); 
           }
           else
           {            
                   $package_rate_code=$_POST['package_rate_code'];
                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'rate_include' => $rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
          $this->sup_hotel_package_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$package_rate_code, $start_date,$end_date);
          $this->sup_hotel_package_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$package_rate_code, $start_date,$end_date);
       
          $sup_hotel_package_rates_list_id=$this->sup_hotel_package_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'rate_include' => $rate_include,
                     'rate_exclude' =>$rate_exclude,
                     'number_of_nights'=>$number_of_nights,
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_package_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Step 6 Updated Successfully!'); 
           }                   
                
       
         }
           
        }
    }

    public function update_step7($hotelid,$meeting_roomid)
    {
          // print_r($_POST); exit;
         $this->form_validation->set_rules('meeting_room_name', 'Room Name', 'trim|required');
          if($hotelid!==$_POST['hotel_id'])
          {
            redirect('hotel/hotel_list','refresh');
          }
         else if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {   
                $hotel_id=$this->input->post('hotel_id'); 
                $meeting_room_id=$this->input->post('meeting_room_id');
                 $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $hotel_details=$this->supplier_hotel_list->check($dataarray);
                if(!empty($meeting_room_id)){
                $dataarray=array('supplier_meeting_room_list_id'=>$meeting_room_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $meeting_room_details=$this->supplier_meeting_room_list->check($dataarray);
                 }
                 else
                 {
                    $meeting_room_details='';
                 }
                $dataarray1=array('status'=>1);
                $meeting_room_facilities_group =$this->glob_supplier_meeting_features_amenities_group->check($dataarray1);
                 $meeting_room_facilities_arr=array();
                 for($i=0;$i<count($meeting_room_facilities_group);$i++)
                 {
                   if(isset($_POST['meeting_room_facilities_'.$meeting_room_facilities_group[$i]->id]))
                   {
                      $meeting_room_facilities_arr[$meeting_room_facilities_group[$i]->id]=implode(',', $_POST['meeting_room_facilities_'.$meeting_room_facilities_group[$i]->id]);
                   
                   }
                 }          
           
            if(!empty($meeting_room_details))
            {
                $updatedata=array(
                            'supplier_id' =>$this->supplier_id,
                            'meeting_room_name' => $this->input->post('meeting_room_name'),                         
                            'meeting_room_desc' => stripslashes($this->input->post('meeting_room_desc')), 
                            'meeting_room_dimension'=> $this->input->post('meeting_room_dimension'),
                            'area'=> $this->input->post('area'),
                            'meeting_room_dimension_unit'=> $this->input->post('meeting_room_dimension_unit'),
                            'area_unit' => $this->input->post('area_unit'),
                            'prefunction'=> $this->input->post('prefunction'),
                            'breakout_room'=> $this->input->post('breakout_room'),
                            'theatre'=> $this->input->post('theatre'),
                            'class_room'=> $this->input->post('class_room'),
                            'ushape'=> $this->input->post('ushape'),
                            'sit_down'=> $this->input->post('sit_down'),
                            'board_room'=> $this->input->post('board_room'),
                            'cocktail_dinner'=> $this->input->post('cocktail_dinner'),
                            'venue_name'=> $this->input->post('venue_name'),
                            'capacity'=> $this->input->post('capacity'),
                          
                            'meeting_room_facilities' =>json_encode($meeting_room_facilities_arr),
                             );
                 $this->supplier_meeting_room_list->update($updatedata,$meeting_room_id);
                 echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$meeting_room_id));
                 $this->session->set_flashdata('message','Step 7 Updated Successfully!');
            }
            else
            {
                
                $meeting_room_code = $this->supplier_meeting_room_list->get_last_meeting_room_code();
                $meeting_room_code = str_pad($meeting_room_code + 1, 10, 0, STR_PAD_LEFT);
                $insertdata=array(
                                'supplier_id' =>$this->supplier_id,
                                'supplier_hotel_list_id'=>$this->input->post('hotel_id'),
                                'property_code' => $hotel_details[0]->property_code,
                                'meeting_room_code'=>$meeting_room_code,
                                'meeting_room_name' => $this->input->post('meeting_room_name'),
                               
                                'meeting_room_desc' => stripslashes($this->input->post('meeting_room_desc')),
                                 'meeting_room_dimension'=> $this->input->post('meeting_room_dimension'),
                                'area'=> $this->input->post('area'),
                                 'meeting_room_dimension_unit'=> $this->input->post('meeting_room_dimension_unit'),
                                'area_unit' => $this->input->post('area_unit'),
                                'prefunction'=> $this->input->post('prefunction'),
                                'breakout_room'=> $this->input->post('breakout_room'),
                                'theatre'=> $this->input->post('theatre'),
                                'class_room'=> $this->input->post('class_room'),
                                'ushape'=> $this->input->post('ushape'),
                                'sit_down'=> $this->input->post('sit_down'),
                                'board_room'=> $this->input->post('board_room'),
                                'cocktail_dinner'=> $this->input->post('cocktail_dinner'),
                                'venue_name'=> $this->input->post('venue_name'),
                                'capacity'=> $this->input->post('capacity'),
                                'meeting_room_facilities' =>json_encode($meeting_room_facilities_arr),
                                'created_date'=>date('Y-m-d')
                                 );
                $insert_id = $this->supplier_meeting_room_list->insert($insertdata);               
                echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$insert_id));
                $this->session->set_flashdata('message','Step 7 Updated Successfully!');
            }
           
        }
    }

     public function update_step8($hotelid,$diningid)
    {
          // print_r($_POST); exit;
         $this->form_validation->set_rules('dining_name', 'Restaurant/Bar Name', 'trim|required');
          if($hotelid!==$_POST['hotel_id'])
          {
            redirect('hotel/hotel_list','refresh');
          }
         else if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {   
                $hotel_id=$this->input->post('hotel_id'); 
                $dining_id=$this->input->post('dining_id');
                 $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $hotel_details=$this->supplier_hotel_list->check($dataarray);
                if(!empty($dining_id))
                {
                $dataarray=array('supplier_dining_list_id'=>$dining_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $dining_details=$this->supplier_dining_list->check($dataarray);
                 }
                 else
                 {
                    $dining_details='';
                 }
              
                if(isset($_POST['open_hours'])&&($_POST['open_hours']=='true'))
                {
                  $business_hours='';

                }
                else
                {
                    $from_time=implode(',', $this->input->post('from_time'));
                    $to_time=implode(',', $this->input->post('to_time'));
                    $business_hours=array('from_time'=>$from_time,'to_time'=>$to_time);
                    $business_hours=json_encode($business_hours);
                }
           
            if(!empty($dining_details))
            {
             
                $updatedata=array(
                            'supplier_id' =>$this->supplier_id,
                            'dining_name' => $this->input->post('dining_name'),                         
                            'dining_desc' => stripslashes($this->input->post('dining_desc')), 
                            'capacity'=>$this->input->post('capacity'), 
                            'cuisine'=> implode(',', $this->input->post('cuisine')),
                            'dining_type'=> implode(',', $this->input->post('dining_type')),
                            'indian_cuisine_type'=> implode(',', $this->input->post('indian_cuisine_type')),
                            'days_of_operations_checkbox'=>$this->input->post('days_of_operations_checkbox'),                         
                            'days_of_operations'=> implode(',', $this->input->post('days_of_operations')),
                            'open_hours'=>$this->input->post('open_hours'),                         
                            'business_hours'=> $business_hours,
                            'reservations_number'=> implode(',', $this->input->post('reservations_number')),
                            'category'=> $this->input->post('category'),
                            'pricing'=> $this->input->post('pricing'),
                            'location_neighbourhood'=> $this->input->post('location_neighbourhood'),
                         
                             );
                 $this->supplier_dining_list->update($updatedata,$dining_id);
                 echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$dining_id));
                 $this->session->set_flashdata('message','Step 8 Updated Successfully!');
            }
            else
            {
                
                $dining_code = $this->supplier_dining_list->get_last_dining_code();
                $dining_code = str_pad($dining_code + 1, 10, 0, STR_PAD_LEFT);
                $insertdata=array(
                                'supplier_id' =>$this->supplier_id,
                                'supplier_hotel_list_id'=>$this->input->post('hotel_id'),
                                'property_code' => $hotel_details[0]->property_code,
                                'dining_code'=>$dining_code,
                                'dining_name' => $this->input->post('dining_name'),
                               
                                'dining_desc' => stripslashes($this->input->post('dining_desc')),
                               'capacity'=>$this->input->post('capacity'), 
                                'cuisine'=> implode(',', $this->input->post('cuisine')),
                                'dining_type'=> implode(',', $this->input->post('dining_type')),
                                'indian_cuisine_type'=> implode(',', $this->input->post('indian_cuisine_type')),
                                'days_of_operations_checkbox'=>$this->input->post('days_of_operations_checkbox'), 
                                'days_of_operations'=> implode(',', $this->input->post('days_of_operations')),
                                'open_hours'=>$this->input->post('open_hours'),                         
                                'business_hours'=>$business_hours,
                                'reservations_number'=> implode(',', $this->input->post('reservations_number')),
                                'category'=> $this->input->post('category'),
                                'pricing'=> $this->input->post('pricing'),
                                'location_neighbourhood'=> $this->input->post('location_neighbourhood'),
                                'created_date'=>date('Y-m-d')
                                 );
                $insert_id = $this->supplier_dining_list->insert($insertdata);               
                echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$insert_id));
                $this->session->set_flashdata('message','Step 8 Updated Successfully!');
            }
           
        }
    }

    public function update_step9($hotelid,$experienceid)
    {
          // print_r($_POST); exit;
         $this->form_validation->set_rules('experience_name', 'Restaurant/Bar Name', 'trim|required');
          if($hotelid!==$_POST['hotel_id'])
          {
            redirect('hotel/hotel_list','refresh');
          }
         else if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {   
                $hotel_id=$this->input->post('hotel_id'); 
                $experience_id=$this->input->post('experience_id');
                 $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $hotel_details=$this->supplier_hotel_list->check($dataarray);
                if(!empty($experience_id))
                {
                $dataarray=array('supplier_experience_list_id'=>$experience_id,'supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
                $experience_details=$this->supplier_experience_list->check($dataarray);
                 }
                 else
                 {
                    $experience_details='';
                 }
              
                if(isset($_POST['open_hours'])&&($_POST['open_hours']=='true'))
                {
                  $business_hours='';

                }
                else
                {
                    $from_time=implode(',', $this->input->post('from_time'));
                    $to_time=implode(',', $this->input->post('to_time'));
                    $business_hours=array('from_time'=>$from_time,'to_time'=>$to_time);
                    $business_hours=json_encode($business_hours);
                }
           
            if(!empty($experience_details))
            {
             
                $updatedata=array(
                            'supplier_id' =>$this->supplier_id,
                            'experience_name' => $this->input->post('experience_name'),                         
                            'experience_desc' => stripslashes($this->input->post('experience_desc')),                          
                            'days_of_operations_checkbox'=>$this->input->post('days_of_operations_checkbox'),                         
                            'days_of_operations'=> implode(',', $this->input->post('days_of_operations')),
                            'open_hours'=>$this->input->post('open_hours'),                         
                            'business_hours'=> $business_hours,
                            'reservations_number'=> implode(',', $this->input->post('reservations_number')),
                            'pricing'=> $this->input->post('pricing'),
                           );
                 $this->supplier_experience_list->update($updatedata,$experience_id);
                 echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$experience_id));
                 $this->session->set_flashdata('message','Step 9 Updated Successfully!');
            }
            else
            {
                
                $experience_code = $this->supplier_experience_list->get_last_experience_code();
                $experience_code = str_pad($experience_code + 1, 10, 0, STR_PAD_LEFT);
                $insertdata=array(
                                'supplier_id' =>$this->supplier_id,
                                'supplier_hotel_list_id'=>$this->input->post('hotel_id'),
                                'property_code' => $hotel_details[0]->property_code,
                                'experience_code'=>$experience_code,
                                'experience_name' => $this->input->post('experience_name'),
                               
                                'experience_desc' => stripslashes($this->input->post('experience_desc')),
                               'days_of_operations_checkbox'=>$this->input->post('days_of_operations_checkbox'), 
                                'days_of_operations'=> implode(',', $this->input->post('days_of_operations')),
                                'open_hours'=>$this->input->post('open_hours'),                         
                                'business_hours'=>$business_hours,
                                'reservations_number'=> implode(',', $this->input->post('reservations_number')),
                                'pricing'=> $this->input->post('pricing'),
                               'created_date'=>date('Y-m-d')
                                 );
                $insert_id = $this->supplier_experience_list->insert($insertdata);               
                echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$insert_id));
                $this->session->set_flashdata('message','Step 9 Updated Successfully!');
            }
           
        }
    }


    public function update_step10($hotel_id)
    {
        // echo '<pre>11';print_r($_REQUEST); exit;
        $this->form_validation->set_rules('general_notes', 'General Notes', 'trim|required'); 
        $this->form_validation->set_rules('cancellation_policy', 'Cancellation Policy', 'trim|required'); 
        $this->form_validation->set_rules('children_policy', 'Children Policy', 'trim|required'); 
        $this->form_validation->set_rules('check_in_policy', 'Check-in Policy', 'trim|required'); 
        $this->form_validation->set_rules('check_out_policy', 'Check-out Policy', 'trim|required'); 
        $data['error']='';
       
        if($this->form_validation->run()==FALSE)
        {   
             echo json_encode(array(
                                    'validation_error' => validation_errors(),
                                    'insert_id' => $hotel_id
                                ));
          $this->session->set_flashdata('error_message',validation_errors());
         }
         else 
         {
            $data = array(          
                        'general_notes' => stripslashes($this->input->post('general_notes')),
                        'cancellation_policy' =>stripslashes($this->input->post('cancellation_policy')),
                        'children_policy' => stripslashes($this->input->post('children_policy')),
                        'check_in_policy' => stripslashes($this->input->post('check_in_policy')),
                        'check_out_policy' => stripslashes($this->input->post('check_out_policy')),            
                        'pet_policy' => stripslashes($this->input->post('pet_policy')),
                       );
                    $this->supplier_hotel_list->update($data, $hotel_id);
                     echo json_encode(array('insert_id' => $hotel_id));
                    $this->session->set_flashdata('message','Step 1 Updated Successfully!');
        }
    }
public function calendar() {
    $data['sub_view'] = 'hotel/calendar';
    $this->load->view('_layout_main',$data);
}

public function do_upload_hotel_img(){

    $hotel_id =$id= $this->input->post('id');
    $res=$this->supplier_hotel_list->check(array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;  
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,                           
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_hotel_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function do_upload_room_img(){

    $room_id =$id= $this->input->post('id');
    $res=$this->supplier_room_list->check(array('supplier_room_list_id'=>$room_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;
    $room_code = $res[0]->room_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'supplier_room_list_id'=>$room_id,
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,
                            'room_code'=>$room_code,
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_room_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function do_upload_meeting_room_img(){

    $meeting_room_id =$id= $this->input->post('id');
    $res=$this->supplier_meeting_room_list->check(array('supplier_meeting_room_list_id'=>$meeting_room_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;
    $meeting_room_code = $res[0]->meeting_room_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'supplier_meeting_room_list_id'=>$meeting_room_id,
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,
                            'meeting_room_code'=>$meeting_room_code,
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_meeting_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}




public function do_upload_outdoor_venue_img(){

    $meeting_room_id =$id= $this->input->post('id');
    $res=$this->supplier_meeting_room_list->check(array('supplier_meeting_room_list_id'=>$meeting_room_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;
    $meeting_room_code = $res[0]->meeting_room_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'supplier_meeting_room_list_id'=>$meeting_room_id,
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,
                            'meeting_room_code'=>$meeting_room_code,
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_meeting_outdoor_venue_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function do_upload_dining_img(){

    $dining_id =$id= $this->input->post('id');
    $res=$this->supplier_dining_list->check(array('supplier_dining_list_id'=>$dining_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;
    $dining_code = $res[0]->dining_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'supplier_dining_list_id'=>$dining_id,
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,
                            'dining_code'=>$dining_code,
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_dining_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function do_upload_experience_img(){

    $experience_id =$id= $this->input->post('id');
    $res=$this->supplier_experience_list->check(array('supplier_experience_list_id'=>$experience_id,'supplier_id'=>$this->supplier_id));
    if(empty($res)||$res=='')
    {
        exit;
    }
    $controller = $this->input->post('controller');
    $id_column = $this->input->post('id_column');
    $table_name = $this->input->post('table_name');
    $column_name = $this->input->post('column_name');   
    $img_type = $this->input->post('img_type');
    $upload_type = $this->input->post('upload_type');
    $property_code = $res[0]->property_code;
    $experience_code = $res[0]->experience_code;
    $sup_hotel_id = $res[0]->supplier_hotel_list_id; 

    $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';
    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();
        $success_msg = '<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
      
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {
           $dataarray=array(
                            'supplier_experience_list_id'=>$experience_id,
                            'sup_hotel_id'=>$sup_hotel_id,
                            'supplier_id'=>$this->supplier_id,
                            'property_code'=>$property_code,
                            'experience_code'=>$experience_code,
                            'gallery_img'=>$imgpath.$imgfile['file_name'],
                            
                            );
         $this->db->insert('supplier_experience_gallery_images', $dataarray);
        }      
        echo $success_msg;
     
    } else {
        $errors = array('error' => $this->upload->display_errors('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>'));
        foreach($errors as $k => $error){
            echo $error;
        }
    }
    exit();
}

public function delete_img(){  
    $img_id = $this->input->post('img_id');
    $table_name = $this->input->post('table_name');
    $img_url = $this->input->post('img_url');
    unlink($img_url);
    $this->Upload_Model->delete_images($img_id,$table_name);
}

public function set_room_status($id,$status,$hotel_id) {
    if(!isset($hotel_id))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    $data = array(
        'status' => $status,          
    );
    $this->supplier_room_list->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Room is now '.$msg);
    redirect('hotel/edit_step4?id='.$hotel_id.'&id1='.$id, 'refresh'); 
}

public function set_meeting_room_status($id,$status,$hotel_id) {
    if(!isset($hotel_id))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    $data = array(
        'status' => $status,          
    );
    $this->supplier_meeting_room_list->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Meeting Room is now '.$msg);
    redirect('hotel/edit_step7?id='.$hotel_id.'&id1='.$id, 'refresh'); 
}

public function set_dining_status($id,$status,$hotel_id) {
    if(!isset($hotel_id))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    $data = array(
        'status' => $status,          
    );
    $this->supplier_dining_list->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Dining is now '.$msg);
    redirect('hotel/edit_step8?id='.$hotel_id.'&id1='.$id, 'refresh'); 
}

public function set_experience_status($id,$status,$hotel_id) {
    if(!isset($hotel_id))
    {
        redirect('hotel/hotel_list','refresh');
    }    
    $data = array(
        'status' => $status,          
    );
    $this->supplier_experience_list->set_status($data,$id);
    if($status == 1){
        $msg = '<label class="label label-success">Active</label>';
    } else {
        $msg = '<label class="label label-danger">Inactive</label>';
    }
    $this->session->set_flashdata('message','Experience is now '.$msg);
    redirect('hotel/edit_step9?id='.$hotel_id.'&id1='.$id, 'refresh'); 
}

public function citylist() 
    {
      if (isset($_GET['term'])) {
            //print_r($_GET['term']);exit;
            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->ace_jac_roomsxml_gta_city->get_hotel_city_list($search);
            //print_r($city_list);exit;
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $city = $city_list[$i]['city_name'] . ', ' . $city_list[$i]['country_name'];
                    $cityid = $city_list[$i]['id'];
                    $return_arr[] = array(
                        'label' => ucfirst($city),
                        'value' => ucfirst($city),
                        'id'=>$cityid,
                        'city_name'=>$city_list[$i]['city_name'],
                        'country_name'=>$city_list[$i]['country_name']
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

    /* List Hotels */
    public function hotel_list() 
    {
        $data['hotel_code']=$hotel_code=isset($_GET['hotel_code']) ? $_GET['hotel_code'] : '';
        $data['hotel_name']=$hotel_name=isset($_GET['hotel_name']) ? $_GET['hotel_name'] : ''; 
        $data['hotel_city']=$hotel_city=isset($_GET['hotel_city']) ? $_GET['hotel_city'] : '';   
        $data['hotel_country']=$hotel_country=isset($_GET['hotel_country']) ? $_GET['hotel_country'] : '';   
        $data['hotel_star_rating']=$hotel_star_rating=isset($_GET['hotel_star_rating']) ? $_GET['hotel_star_rating'] : '';     
         $data['hotel_property_type']=$hotel_property_type=isset($_GET['hotel_property_type']) ? $_GET['hotel_property_type'] : '';
        $dataarray=array('status'=>1);
        $data['propertytype'] =$this->glb_hotel_property_type->check($dataarray);    
        $propertytypeall =$this->glb_hotel_property_type->get(); 
        $propertyarraylist=array();
        for($i=0;$i<count($propertytypeall);$i++)
        {
         $propertyarraylist[$propertytypeall[$i]->id]=$propertytypeall[$i]->property_type;
        }
        $data['propertytypeall'] = $propertyarraylist;
        $data['hotel_details'] = $this->supplier_hotel_list->gethotellist($this->supplier_id,$hotel_code,$hotel_name,$hotel_city,$hotel_country,$hotel_star_rating,$hotel_property_type);
        // echo $this->db->last_query();
        // echo '<pre>';print_r($data['hotel_details']);exit;
        $data['sub_view'] = 'hotel/hotel_list';
        $this->load->view('_layout_main',$data);
    }
    
    /* Set Hotels Status Hotels */
    public function set_status($id,$status) 
    {
        $data = array('status' => $status);
        $this->supplier_hotel_list->set_status($data,$id);
        if($status == 1)
        {
            $msg = '<label class="label label-success">Active</label>';
        } 
        else
        {
            $msg = '<label class="label label-danger">Inactive</label>';
        }
        $this->session->set_flashdata('message','Hotel is now '.$msg);
        redirect('hotel/hotel_list', 'refresh'); 
    }


 public function property_type()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_property_type";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="property_type";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Property Type";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }

   public function hotel_group()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_hotel_group_chain";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="hotel_group";
      $data['button']="Save";
      $data['action']="update_hotel_chain_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Hotel Group/Chain";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatahotelchainmodal', $data, TRUE))); 
    
  }

    public function update_hotel_chain_metadata()
  {  
  // print_r($_POST); exit;  
      $this->form_validation->set_rules('name', $_POST['tag_name'], 'trim|required');
      if($this->form_validation->run()==FALSE) 
      {
          echo json_encode(array('modalservermsg'=>validation_errors(),'modal_index'=>'')); 
       
      }
      else
      {

          $data['hotel_id_index']=$hotel_id=trim($_POST['hotel_id_index']); 
          $data['type']=$type=trim($_POST['type']);
          $data['ctrl']=trim($_POST['ctrl']);
          $data['mode']=trim($_POST['mode']);    
          $data['modetype']=trim($_POST['modetype']);    
          $data['feildname']=trim($_POST['feildname']);    
          $data['modal_index']=trim($_POST['modal_index']);    
          $data['tag_name']=trim($_POST['tag_name']); 
          $data['supplier_id']=$this->supplier_id;

        
           $name=trim($_POST['name']);         
           $dataarray=array('name'=>$name);
           $check=$this->$type->check($dataarray);          
         
           if(!empty($check))
           {
            
             echo json_encode(array('modalservermsg'=>$_POST['tag_name'].' ( '.$name.' ) Already Exist','modal_index'=>''));
              
           }
           else
           {
             
                $insertdata=array(
                                    'name' =>$name,
                                    'supplier_id'=>$this->supplier_id,
                                    'status'=>1,
                                    'created_date'=>date('Y-m-d')
                                   );
                $id = $this->$type->insert($insertdata);                 
                $this->updatehotelchainlogo($id); 
                if(!empty($hotel_id))
                {           
                   $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
               $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
                 }
                 else
                 {
                  $data['hotel_details']='';
                 }
                $dataarray=array('status'=>1);
                $data['infolist'] =$this->$type->check($dataarray);         
                echo json_encode(array('modalservermsg'=>$name.' Successfully Created!','modal_index'=>$this->load->view('hotel/modal_hotel_chain_index', $data, TRUE)));
               
              }
       }
      }

  public function updatehotelchainlogo($id)
  {
     $controller = $this->input->post('ctrl');  
     $table_name = $this->input->post('type');
     $img_type = 'gallery'; 
     $imgpath = 'uploads/'.$this->supplier_id.'/'.$controller.'/'.$id.'/'.$table_name.'/'.$img_type.'/';

    $uploadpath = FCPATH.$imgpath;
    $config['upload_path'] = $uploadpath;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['overwrite'] = TRUE;
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!is_dir($uploadpath))
    {
      mkdir($uploadpath, 0755, TRUE);
    } 
    
    if($this->upload->do_multi_upload("uploadfile")){
        $data['upload_data'] = $this->upload->get_multi_upload_data();       
        $temp_images = array();
        foreach($data['upload_data'] as $imgfile) {

         $dataarray=array('img_path'=>$imgpath.$imgfile['file_name'],);
        $this->glob_supplier_hotel_group_chain->update($dataarray, $id);
        }      
   
    } 
  }

   public function hotel_neighbourhood()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_hotel_neighbourhood";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="hotel_neighbourhood";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Area/Neighbourhood";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }

   public function contact_department()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_department";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="contact_department";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Department";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodalimpcon', $data, TRUE))); 
    
  }
   public function contact_role()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_designation";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="contact_role";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Designation/Role";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodalimpcon', $data, TRUE))); 
    
  }

  public function cuisine()
  {
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_cuisine";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="cuisine";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Cuisine";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
  }

public function dining_type()
  {
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_dining_type";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="dining_type";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Dining Type";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
  }

    public function indian_cuisine_type()
  {
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_indian_cuisine_type";
      $data['type1']="";
      $data['group_id']="";
      $data['ctrl']="indian_cuisine_type";
      $data['button']="Save";
      $data['action']="update_metadata";    
      $data['mode']=$_POST['mode'];    
      $data['modetype']=$_POST['modetype'];    
      $data['feildname']=$_POST['feildname'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']="Indian Cuisne Type";    
     echo json_encode(array('loadmodal'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
  }

  public function update_metadata()
  {  
  // print_r($_POST); exit;  
      $this->form_validation->set_rules('name', $_POST['tag_name'], 'trim|required');
      if($this->form_validation->run()==FALSE) 
      {
          echo json_encode(array('modalservermsg'=>validation_errors(),'modal_index'=>'')); 
       
      }
      else
      {

          $data['hotel_id_index']=$hotel_id=trim($_POST['hotel_id_index']); 
          $data['type']=$type=trim($_POST['type']);
          $data['ctrl']=trim($_POST['ctrl']);
          $data['mode']=trim($_POST['mode']);    
          $data['modetype']=trim($_POST['modetype']);    
          $data['feildname']=trim($_POST['feildname']);    
          $data['modal_index']=trim($_POST['modal_index']);    
          $data['tag_name']=trim($_POST['tag_name']); 
          $data['supplier_id']=$this->supplier_id;

        
           $name=trim($_POST['name']);         
           $dataarray=array('name'=>$name);
           $check=$this->$type->check($dataarray);          
         
           if(!empty($check))
           {
            
             echo json_encode(array('modalservermsg'=>$_POST['tag_name'].' ( '.$name.' ) Already Exist','modal_index'=>''));
              
           }
           else
           {
             
                $insertdata=array(
                                    'name' =>$name,
                                    'supplier_id'=>$this->supplier_id,
                                    'status'=>1,
                                    'created_date'=>date('Y-m-d')
                                   );
                $this->$type->insert($insertdata);   
                if(!empty($hotel_id))
                {           
                   $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
               $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
                 }
                 else
                 {
                  $data['hotel_details']='';
                 }
                $dataarray=array('status'=>1);
                $data['infolist'] =$this->$type->check($dataarray);         
                echo json_encode(array('modalservermsg'=>$name.' Successfully Created!','modal_index'=>$this->load->view('hotel/modal_index', $data, TRUE)));
               
              }
       }
      }

  public function hotel_facilities()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_hotel_features_amenities";
      $data['type1']="glob_supplier_hotel_features_amenities_group";
      $data['group_id']=$_POST['group_id'];
      $data['ctrl']="hotel_facilities";
      $data['button']="Save";
      $data['action']="update_group_metadata";    
      $data['mode']='multiple';    
      $data['modetype']='check';     
      $data['feildname']=$_POST['index'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']=$_POST['group_name'];    
     echo json_encode(array('loadmodalgroup'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }

 public function room_facilities()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_room_features_amenities";
      $data['type1']="glob_supplier_room_features_amenities_group";
      $data['group_id']=$_POST['group_id'];
      $data['ctrl']="hotel_facilities";
      $data['button']="Save";
      $data['action']="update_group_metadata";    
      $data['mode']='multiple';    
      $data['modetype']='check';     
      $data['feildname']=$_POST['index'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']=$_POST['group_name'];    
     echo json_encode(array('loadmodalgroup'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }

   public function meeting_room_facilities()
  {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_meeting_features_amenities";
      $data['type1']="glob_supplier_meeting_features_amenities_group";
      $data['group_id']=$_POST['group_id'];
      $data['ctrl']="hotel_facilities";
      $data['button']="Save";
      $data['action']="update_group_metadata";    
      $data['mode']='multiple';    
      $data['modetype']='check';     
      $data['feildname']=$_POST['index'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']=$_POST['group_name'];    
     echo json_encode(array('loadmodalgroup'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }

   public function room_rate_include()
   {  
      $data['hotel_id_index']=$_POST['id']; 
      $data['type']="glob_supplier_room_rate_includes";
      $data['type1']="";
      $data['group_id']=$_POST['group_id'];
      $data['ctrl']="hotel_facilities";
      $data['button']="Save";
      $data['action']="update_group_metadata";    
      $data['mode']='multiple';    
      $data['modetype']='check';     
      $data['feildname']=$_POST['index'];    
      $data['modal_index']=$_POST['index'];    
      $data['tag_name']=$_POST['group_name'];    
     echo json_encode(array('loadmodalgroup'=>$this->load->view('hotel/metadatamodal', $data, TRUE))); 
    
  }



   public function update_group_metadata()
  {  
  // print_r($_POST); exit;  
      $this->form_validation->set_rules('name', $_POST['tag_name'], 'trim|required');
      if($this->form_validation->run()==FALSE) 
      {
          echo json_encode(array('modalservermsg'=>validation_errors(),'modal_index'=>'')); 
       
      }
      else
      {

          $data['hotel_id_index']=$hotel_id=trim($_POST['hotel_id_index']); 
          $data['type']=$type=trim($_POST['type']);
          $data['type1']=$type1=trim($_POST['type1']);
          $data['group_id']=$group_id=trim($_POST['group_id']);
          $data['ctrl']=trim($_POST['ctrl']);
          $data['mode']=trim($_POST['mode']);    
          $data['modetype']=trim($_POST['modetype']);    
          $data['feildname']=trim($_POST['feildname']);    
          $data['modal_index']=trim($_POST['modal_index']);    
          $data['tag_name']=trim($_POST['tag_name']); 
          $data['supplier_id']=$this->supplier_id;
          $name=trim($_POST['name']);         
           $dataarray=array('name'=>$name);
           $check=$this->$type->check($dataarray);          
         
           if(!empty($check))
           {
            
             echo json_encode(array('modalservermsg'=>$_POST['tag_name'].' ( '.$name.' ) Already Exist','modal_index'=>''));
              
           }
           else
           {             
                $insertdata=array(
                                    'name' =>$name,
                                    'supplier_id'=>$this->supplier_id,
                                    'group_id'=>$group_id,
                                    'status'=>1,
                                    'created_date'=>date('Y-m-d')
                                   );
                $this->$type->insert($insertdata);   
                if(!empty($hotel_id))
                {           
                   $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
               $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
                 }
                 else
                 {
                  $data['hotel_details']='';
                 }
                $dataarray=array('status'=>1,'group_id'=>$group_id);
                $data['infolist'] =$this->$type->check($dataarray);         
                echo json_encode(array('modalservermsg'=>$name.' Successfully Created!','modal_index'=>$this->load->view('hotel/modal_group_index', $data, TRUE)));
               
              }
       }
      }


 public function manageRoomRates()
    {
        $data['hotel_id'] = $hotel_id = isset($_GET['id'])?$_GET['id']:"";
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:"";
        $data['weekdays'] = $weekdays = isset($_GET['weekdays'])?$_GET['weekdays']:'';
        $data['sup_hotel_room_rates_list_id'] = $sup_hotel_room_rates_list_id = isset($_GET['id2'])?$_GET['id2']:'';
        $data['code'] = $code = isset($_GET['code'])?$_GET['code']:'';
        $dataarray=array('supplier_id'=>$this->supplier_id);
        $data['hotel_list'] = $this->supplier_hotel_list->check($dataarray);
        $data['hotel_details']='';
        $data['room_list']='';
        $data['room_details_list']='';
        $data['room_rate_details']='';
        $data['room_rate_list']='';
        if(!empty($hotel_id))
        {
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
            $data['room_details_list'] = $this->supplier_room_list->check($dataarray);
            
        }
        if(!empty($hotel_id)&&!empty($room_id))
        {
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_room_list_id'=>$room_id, 'supplier_id'=>$this->supplier_id);
            $data['room_details'] = $this->supplier_room_list->check($dataarray);
            $dataarray=array('sup_hotel_room_rates_list_id'=>$sup_hotel_room_rates_list_id,'room_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);
            $data['room_rate_details']=$this->sup_hotel_room_rates_list->check($dataarray);
            if($code!='')
            {
              $dataarray=array('room_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);  
            }
            else
            {
             $dataarray=array('hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);   
            }
            $data['room_rate_list']=$this->sup_hotel_room_rates_list->check($dataarray);
        }      
         if(empty($data['room_rate_details'])&&isset($_GET['code']))
        {
            redirect('hotel/manageRoomRates?id='.$hotel_id.'&id1='.$room_id,'refresh'); 
        }      
            $dataarray=array('status'=>1);
            $data['roomtype'] =$this->glob_supplier_room_type->check($dataarray);      
            $data['room_rate_include'] =$this->glob_supplier_room_rate_includes->check($dataarray);
            $data['currency']=$this->currency->get('*'); 
            $data['sub_view'] = 'hotel/manageRoomRates';
            $this->load->view('_layout_main',$data);
    }



public function updateHotelRoomRates($hotelid,$roomid)
    {      
       $dataarray=array(
                  'supplier_hotel_list_id'=>$hotelid,                 
                  'supplier_id'=>$this->supplier_id,                
                 );
         $data['room_list'] =$this->supplier_room_list->check($dataarray);
          if($hotelid!==$_POST['hotel_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/manageRoomRates';
            </script>
          <?php
          
          }
          else if($roomid!==$_POST['room_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/manageRoomRates; ?>';
            </script>
        <?php
            
          }
        else if($this->input->server('REQUEST_METHOD') === 'POST')
        { 
          $this->form_validation->set_rules('rate_name', 'Rate Name', 'trim|required');
          if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {       $supplier_id=$this->supplier_id; 
                    $rate_name =isset($_POST['rate_name'])?$_POST['rate_name']:'';
                    $weekdays =isset($_POST['weekdays'])?$_POST['weekdays']:'';
                    $room_id =isset($_POST['room_id'])?$_POST['room_id']:'';
                    $hotel_id = isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
                    $rate_code = isset($_POST['rate_code'])?$_POST['rate_code']:'';
                    $rate_desc = isset($_POST['rate_desc'])?stripslashes($_POST['rate_desc']):'';
                    $rate_type = isset($_POST['rate_type'])?$_POST['rate_type']:'';
                    $commission = isset($_POST['commission'])?$_POST['commission']:'';
                    $published_rate = isset($_POST['published_rate'])?$_POST['published_rate']:'';
                    $taxes_included=isset($_POST['taxes_included'])?$_POST['taxes_included']:'';
                    $supplier_tax_percent = isset($_POST['supplier_tax_percent'])?$_POST['supplier_tax_percent']:'';
                    $currency_type =  isset($_POST['currency_type'])?$_POST['currency_type']:'';
                   
                    $room_rate_include = isset($_POST['room_rate_include'])?$_POST['room_rate_include']:'';
                    $single_occupancy_rate = isset($_POST['single_occupancy_rate'])?$_POST['single_occupancy_rate']:'';
                    $twin_occupancy_rate = isset($_POST['twin_occupancy_rate'])?$_POST['twin_occupancy_rate']:'';
                    $triple_occupancy_rate_extrabed = isset($_POST['triple_occupancy_rate_extrabed'])?$_POST['triple_occupancy_rate_extrabed']:'';
                    $triple_occupancy_rate =  isset($_POST['triple_occupancy_rate'])?$_POST['triple_occupancy_rate']:'';
                    $quad_occupancy_rate =  isset($_POST['quad_occupancy_rate'])?$_POST['quad_occupancy_rate']:'';
                    $childminage = isset($_POST['childminage'])?$_POST['childminage']:'';
                    $childmaxage = isset($_POST['childmaxage'])?$_POST['childmaxage']:'';
                    $child_rate =  isset($_POST['child_rate'])?$_POST['child_rate']:'';
                   

                    $check_in_policy =  isset($_POST['check_in_policy'])?$_POST['check_in_policy']:'';
                    $check_out_policy =  isset($_POST['check_out_policy'])?$_POST['check_out_policy']:'';
                    $children_policy =  isset($_POST['children_policy'])?stripslashes($_POST['children_policy']):'';

                    $cancellation_policy=array();      
                    if(isset($_POST['non_refundable']))
                    {
                       $cancellation_policy[0]='0||'.$_POST['non_refundable'];
                    }
                    else
                    {
                      for($i=0;$i<count($_POST['days_before'])&&isset($_POST['days_before'])&&isset($_POST['cancel_rates']);$i++)
                      {
                         $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
                      } 
                    }
                      $property_code =$this->supplier_hotel_list->get_single($hotel_id)->property_code;
                     $room_detail=$this->supplier_room_list->get_single($room_id);     
                     $room_code =$room_detail->room_code;


                       $from_date=strtotime($_POST['start_date']);
                        $to_date=strtotime($_POST['end_date']);
                        $start_date= date("Y-m-d", $from_date);
                        $end_date= date("Y-m-d", $to_date);
                 $days=floor(($to_date - $from_date) / (60 * 60 * 24));   

                if(!isset($_POST['room_rate_code']))
                {

              
                  $room_rate_code = $this->sup_hotel_room_rates_list->get_last_room_rate_code();
                  $room_rate_code = str_pad($room_rate_code + 1, 10, 0, STR_PAD_LEFT);  


                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'room_rate_include' => implode(',',$room_rate_include),
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
       
          $sup_hotel_room_rates_list_id=$this->sup_hotel_room_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Room Rates Successfully Updated!'); 
           }
           else
           {     
                  
                   $room_rate_code=$_POST['room_rate_code'];
                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'weekdays'=>implode(',', $weekdays),
                    'room_rate_include' => implode(',',$room_rate_include),
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
          if(empty($weekdays)){
          $this->sup_hotel_room_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $start_date,$end_date);
          $this->sup_hotel_room_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $start_date,$end_date);
            }
       
          $sup_hotel_room_rates_list_id=$this->sup_hotel_room_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);  
              if(!empty($weekdays)){ 
              $day = date('D', strtotime($room_avail_date));
              if(in_array($day,$weekdays)){ 
              $this->sup_hotel_room_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $room_avail_date,$room_avail_date);
              $this->sup_hotel_room_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$room_rate_code, $room_avail_date,$room_avail_date); 
             
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
           }else{   
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'rate_name' =>$rate_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'rate_code' => $rate_code,
                    'room_rate_code'=>$room_rate_code,
                    'rate_desc' => $rate_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'room_rate_include' => implode(',',$room_rate_include),
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_room_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'rate_name' =>$rate_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'rate_code' => $rate_code,
                        'room_rate_code'=>$room_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_room_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Room Rate Successfully Updated!'); 
           }                   
                
       
         }
           
        }
    }

    public function managePackageRates() 
    {  
        
        $data['hotel_id'] = $hotel_id = isset($_GET['id'])?$_GET['id']:"";
        $data['room_id'] = $room_id = isset($_GET['id1'])?$_GET['id1']:"";     
       $data['sup_hotel_package_rates_list_id'] = $sup_hotel_package_rates_list_id = isset($_GET['id2'])?$_GET['id2']:'';
        $data['code'] = $code = isset($_GET['code'])?$_GET['code']:'';
        $dataarray=array('supplier_id'=>$this->supplier_id);
        $data['hotel_list'] = $this->supplier_hotel_list->check($dataarray);
        $data['hotel_details']='';
        $data['room_list']='';
        $data['room_details_list']='';
        $data['package_rate_details']='';
        $data['package_rate_list']='';
        if(!empty($hotel_id))
        {
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_id'=>$this->supplier_id);
            $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
            $data['room_details_list'] = $this->supplier_room_list->check($dataarray);
            
        }
        if(!empty($hotel_id)&&!empty($room_id))
        {
            $dataarray=array('supplier_hotel_list_id'=>$hotel_id,'supplier_room_list_id'=>$room_id, 'supplier_id'=>$this->supplier_id);
            $data['room_details'] = $this->supplier_room_list->check($dataarray);
          $dataarray=array('sup_hotel_package_rates_list_id'=>$sup_hotel_package_rates_list_id,'package_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);
           $data['package_rate_details']=$this->sup_hotel_package_rates_list->check($dataarray);
              if($code!='')
            {
              $dataarray=array('package_rate_code'=>$code,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);  
            }
            else
            {
             $dataarray=array('hotel_id'=>$hotel_id,'room_id'=>$room_id,'supplier_id'=>$this->supplier_id);   
            }
            $data['package_rate_list']=$this->sup_hotel_package_rates_list->check($dataarray);
        }      
        if(empty($data['package_rate_details'])&&isset($_GET['code']))
        {
            redirect('hotel/managePackageRates?id='.$hotel_id.'&id1='.$room_id,'refresh'); 
        }
             
        $dataarray=array('status'=>1);
        $data['roomtype'] =$this->glob_supplier_room_type->check($dataarray);   
        $data['currency']=$this->currency->get('*');
        $data['sub_view'] = 'hotel/managePackageRates';
        $this->load->view('_layout_main',$data);
    }


   
  public function updateHotelPackagesRates($hotelid,$roomid)
    {   
     // echo "<pre>"; print_r($_POST); exit;   
       $dataarray=array(
                  'supplier_hotel_list_id'=>$hotelid,                 
                  'supplier_id'=>$this->supplier_id,                
                 );
         $data['room_list'] =$this->supplier_room_list->check($dataarray);
          if($hotelid!==$_POST['hotel_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/updateHotelPackagesRates';
            </script>
          <?php
          
          }
          else if($roomid!==$_POST['room_id'])
          {
            ?>
            <script type="text/javascript">
            location.href='<?php echo site_url();?>hotel/updateHotelPackagesRates';
            </script>
        <?php
            
          }
        else if($this->input->server('REQUEST_METHOD') === 'POST')
        { 
          $this->form_validation->set_rules('package_name', 'Rate Name', 'trim|required');
          if($this->form_validation->run()==FALSE) 
            {
                echo json_encode(array(
                                'validation_error' => '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>'.validation_errors().'</div>',
                                'validation_status' => true,
                                'insert_id' => $hotelid,
                               ));
            }
            else
            {       $supplier_id=$this->supplier_id;
                    $package_name =isset($_POST['package_name'])?$_POST['package_name']:'';
                    $room_id =isset($_POST['room_id'])?$_POST['room_id']:'';
                    $hotel_id = isset($_POST['hotel_id'])?$_POST['hotel_id']:'';
                    $package_code = isset($_POST['package_code'])?$_POST['package_code']:'';
                    $package_desc = isset($_POST['package_desc'])?stripslashes($_POST['package_desc']):'';
                    $rate_type = isset($_POST['rate_type'])?$_POST['rate_type']:'';
                    $commission = isset($_POST['commission'])?$_POST['commission']:'';
                    $published_rate = isset($_POST['published_rate'])?$_POST['published_rate']:'';
                    $taxes_included=isset($_POST['taxes_included'])?$_POST['taxes_included']:'';
                    $supplier_tax_percent = isset($_POST['supplier_tax_percent'])?$_POST['supplier_tax_percent']:'';
                    $currency_type =  isset($_POST['currency_type'])?$_POST['currency_type']:'';
                   
                    $rate_include = isset($_POST['rate_include'])?stripslashes($_POST['rate_include']):'';
                     $rate_exclude = isset($_POST['rate_exclude'])?stripslashes($_POST['rate_exclude']):'';                     
                     $number_of_nights = isset($_POST['number_of_nights'])?$_POST['number_of_nights']:'';
                    $single_occupancy_rate = isset($_POST['single_occupancy_rate'])?$_POST['single_occupancy_rate']:'';
                    $twin_occupancy_rate = isset($_POST['twin_occupancy_rate'])?$_POST['twin_occupancy_rate']:'';
                    $triple_occupancy_rate_extrabed = isset($_POST['triple_occupancy_rate_extrabed'])?$_POST['triple_occupancy_rate_extrabed']:'';
                    $triple_occupancy_rate =  isset($_POST['triple_occupancy_rate'])?$_POST['triple_occupancy_rate']:'';
                    $quad_occupancy_rate =  isset($_POST['quad_occupancy_rate'])?$_POST['quad_occupancy_rate']:'';
                    $childminage = isset($_POST['childminage'])?$_POST['childminage']:'';
                    $childmaxage = isset($_POST['childmaxage'])?$_POST['childmaxage']:'';
                    $child_rate =  isset($_POST['child_rate'])?$_POST['child_rate']:'';
                   

                    $check_in_policy =  isset($_POST['check_in_policy'])?$_POST['check_in_policy']:'';
                    $check_out_policy =  isset($_POST['check_out_policy'])?$_POST['check_out_policy']:'';
                    $children_policy =  isset($_POST['children_policy'])?stripslashes($_POST['children_policy']):'';

                    $cancellation_policy=array();      
                    if(isset($_POST['non_refundable']))
                    {
                       $cancellation_policy[0]='0||'.$_POST['non_refundable'];
                    }
                    else
                    {
                      for($i=0;$i<count($_POST['days_before'])&&isset($_POST['days_before'])&&isset($_POST['cancel_rates']);$i++)
                      {
                         $cancellation_policy[$_POST['days_before'][$i]]=$_POST['cancel_rates'][$i].'||'.$_POST['cancel_rates_type'][$i];
                      } 
                    }
                      $property_code =$this->supplier_hotel_list->get_single($hotel_id)->property_code;
                     $room_detail=$this->supplier_room_list->get_single($room_id);     
                     $room_code =$room_detail->room_code;


                       $from_date=strtotime($_POST['start_date']);
                        $to_date=strtotime($_POST['end_date']);
                        $start_date= date("Y-m-d", $from_date);
                        $end_date= date("Y-m-d", $to_date);
                 $days=floor(($to_date - $from_date) / (60 * 60 * 24));   

                if(!isset($_POST['package_rate_code']))
                {

              
                  $package_rate_code = $this->sup_hotel_package_rates_list->get_last_package_rate_code();
                  $package_rate_code = str_pad($package_rate_code + 1, 10, 0, STR_PAD_LEFT);  


                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'rate_include' =>$rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
       
          $sup_hotel_package_rates_list_id=$this->sup_hotel_package_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'rate_include' => $rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_package_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Hotel Package Rate Successfully Updated!'); 
           }
           else
           {            
                   $package_rate_code=$_POST['package_rate_code'];
                   $insert_room_rates_list=array(    
                    'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'rate_include' => $rate_include,
                    'rate_exclude' =>$rate_exclude,
                    'number_of_nights'=>$number_of_nights,
                     'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                     'cancellation_policy'=> json_encode($cancellation_policy),
                     'check_in_policy' => $check_in_policy,
                    'check_out_policy' => $check_out_policy,
                    'children_policy' => $children_policy,
                     'status' => '1',
                    );
          $this->sup_hotel_package_rates->delete_room_rates($hotel_id, $room_id,$supplier_id,$package_rate_code, $start_date,$end_date);
          $this->sup_hotel_package_cancellation_rates->delete_room_cancellation_rates($hotel_id, $room_id,$supplier_id,$package_rate_code, $start_date,$end_date);
       
          $sup_hotel_package_rates_list_id=$this->sup_hotel_package_rates_list->insert($insert_room_rates_list);
          
           
            for($i=0;$i<=$days;$i++)
            {  
              $incr_date = strtotime("+".$i." days", $from_date);
              $room_avail_date=date("Y-m-d", $incr_date);     
              $insertdata=array(
                   'supplier_id' =>$supplier_id,
                    'package_name' =>$package_name,
                    'room_id' => $room_id,
                    'room_code'=>$room_code,
                    'hotel_id' => $hotel_id,
                    'property_code'=>$property_code,
                    'package_code' => $package_code,
                    'package_rate_code'=>$package_rate_code,
                    'package_desc' => $package_desc,
                     'rate_type' => $rate_type,
                    'commission' =>$commission,
                    'published_rate' =>$published_rate, 
                    'supplier_tax_percent' => $supplier_tax_percent,
                    'taxes_included'=>$taxes_included,
                    'currency_type' => $currency_type,
                    'room_avail_date'=> $room_avail_date,  
                    'rate_include' => $rate_include,
                     'rate_exclude' =>$rate_exclude,
                     'number_of_nights'=>$number_of_nights,
                    'single_occupancy_rate' => $single_occupancy_rate,
                    'twin_occupancy_rate' => $twin_occupancy_rate,
                    'triple_occupancy_rate_extrabed' => $triple_occupancy_rate_extrabed,
                    'triple_occupancy_rate' => $triple_occupancy_rate,
                    'quad_occupancy_rate' => $quad_occupancy_rate,
                    'childminage' => $childminage,
                    'childmaxage' => $childmaxage,
                    'child_rate' => $child_rate,
                    'status' => '1',
                );
                $this->sup_hotel_package_rates->insert($insertdata);
              
         
              if(isset($_POST['non_refundable']))
              {
                   $insertcancellationdata=array(    
                       'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date,  
                        'days_before_checkin'=>0,
                        'per_rate_charge'=> 0,
                        'cancel_rates_type'=>$_POST['non_refundable'],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata);
              }
              else
              {
                  $k=0;
                  $insertcancellationdata=array();
                  foreach ($_POST['cancel_rates'] as $cancel_rate)
                  { 
                    $insertcancellationdata[$k]=array(    
                        'supplier_id' =>$supplier_id,
                        'package_name' =>$package_name,
                        'room_id' => $room_id,
                        'room_code'=>$room_code,
                        'hotel_id' => $hotel_id,
                        'property_code'=>$property_code,
                        'package_code' => $package_code,
                        'package_rate_code'=>$package_rate_code,           
                        'room_avail_date'=> $room_avail_date, 
                        'days_before_checkin'=> $_POST['days_before'][$k],
                        'per_rate_charge'=> $_POST['cancel_rates'][$k],
                        'cancel_rates_type'=>$_POST['cancel_rates_type'][$k],
                        'date_time' => date('Y-m-d H:i:s'),
                       );
                    $this->sup_hotel_package_cancellation_rates->insert($insertcancellationdata[$k]);
                   $k++;
                }
            }
           }
            echo json_encode(array('insert_id' => $hotelid,'insert_id1'=>$roomid));
            $this->session->set_flashdata('message','Hotel Package Rate Successfully Updated!'); 
           }                   
                
       
         }
           
        }
    }

public function roomListAjax()
{
        if(isset($_POST['id']))
        {
            $dataarray=array('supplier_hotel_list_id'=>$_POST['id'],'supplier_id'=>$this->supplier_id);
            $data['hotel_details'] = $this->supplier_hotel_list->check($dataarray);
            $data['room_list'] = $this->supplier_room_list->check($dataarray);
            $data['hotel_id']=$_POST['id'];
            if(!empty($data['hotel_details'])&&!empty($data['room_list']))
            {
                echo json_encode(array('room_list'=>$this->load->view('hotel/room_list',$data,TRUE),'viewEditRoomRates'=>$this->load->view('hotel/viewEditRoomRates',$data,TRUE)));
            }
            else
            {
                echo json_encode(array('room_list'=>'','viewEditRoomRates'=>''));
            }
            
        }
        else
        {
            echo json_encode(array('room_list'=>'','viewEditRoomRates'=>''));
        }

}
  
 
}
