<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * AIROOMS 
 * @project     AIROOMS
 * @author      Ashish
 * @copyright   Copyright (c) 2013 - 2014, Ashish
 * @license     http://www.travelpd.com/contactus.html
 * @link        http://www.travelpd.com
 * 
 */

class Zoho extends MX_Controller 
{
    private $EMAIL_ID;
    private $PASSWORD;
    private $DISPLAY_NAME; 
    private $token; 
    public function __construct() 
    {
         parent::__construct();
         $this->load->model('zoho/Zoho_model');  
         $this->EMAIL_ID="prasanna@travelpd.com";
         $this->PASSWORD="Eti9y95G3Peu";
         $this->DISPLAY_NAME="AIROOMS";
         $this->token="547868ccdeaade2e2c486b1a9856a191";        

    }

    public function setCredentials()
    {
       $this->EMAIL_ID="prasanna@travelpd.com";
       $this->PASSWORD="Eti9y95G3Peu";
       $this->DISPLAY_NAME="AIROOMS";
       $this->token="547868ccdeaade2e2c486b1a9856a191"; 
    }

    public function index() 
    {        
         redirect('', 'refresh');
    }
    
  

    public function insertRecordsIntoZohoB2C($user_no,$user_email, $first_name, $last_name, $mobile_no)
    {
     $xml='<CustomModule1>
              <row no="1">
                   <FL val="User Ref">'.$user_no.'</FL>
                   <FL val="First Name">'.$first_name.'</FL>
                   <FL val="Last Name">'.$last_name.'</FL>
                   <FL val="Email">'.$user_email.'</FL>
                   <FL val="Mobile">'.$mobile_no.'</FL>
              </row>
           </CustomModule1>';
         $url = "https://crm.zoho.com/crm/private/xml/CustomModule1/insertRecords";
         $param= "authtoken=".$this->token."&scope=crmapi&newFormat=1&xmlData=".$xml;
         $response=$this->zohoCurlRequest($url,$param);
         file_put_contents(FCPATH . 'dump/fitruums/ZohoInsertResponse.xml', $response);
         if(!empty($response))         
         {
            $this->extractInsertResponse($response,$user_no);
         }
    }

    public function extractInsertResponse($response,$user_no)
    {    

      $resp=new SimpleXMLElement($response);
      $zohoInsertRes=array();
      $zohoInsertRes['Id']='';
      if(isset($resp->result))
      {
         $result=$resp->result;
         $message='';
         $zohoId='';
         if(isset($result->message))
         {
              $message=$result->message;
              $zohoInsertRes['message']=$message;

         }  
         
         if(isset($result->recorddetail))
         { 
            $recorddetail=$result->recorddetail;
             foreach($recorddetail->FL as $val)
             {
                 $index=(string)$val['val'];
                 $zohoInsertRes[$index]=(string)$val;
             }
           
         }
           if(!empty($zohoInsertRes))
             {
               $zohoInsertResJson=json_encode($zohoInsertRes,JSON_FORCE_OBJECT);
                $dataUpdate=array(
                                  'zohoId'=>$zohoInsertRes['Id'],
                                  'zohoInsertResJson'=>$zohoInsertResJson,
                                  );
                $this->Zoho_model->updateZohodata($user_no,$dataUpdate);
             }         
      }
    
    }

    public function zohoCurlRequest($url,$param)
    {
            
              // header("Content-type: application/xml");
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_TIMEOUT, 30);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
              $response = curl_exec($ch);
              curl_close($ch);
              return $response; 
    }


    public function updateRecordsIntoZohoB2C($zohoId,$user_no, $title, $first_name, $middle_name,$last_name,$gender, $mobile_no,$address, $pin_code, $city, $state, $country)
    {
     $xml='<CustomModule1>
              <row no="1">                   
                   <FL val="Title">'.$title.'</FL>
                   <FL val="First Name">'.$first_name.'</FL>
                   <FL val="Middle Name">'.$middle_name.'</FL>
                   <FL val="Last Name">'.$last_name.'</FL>              
                   <FL val="Gender">'.$gender.'</FL>              
                   <FL val="Mobile">'.$mobile_no.'</FL>                   
                   <FL val="Address">'.$address.'</FL>
                   <FL val="Pin Code">'.$pin_code.'</FL>
                   <FL val="City">'.$city.'</FL>
                   <FL val="State">'.$state.'</FL>
                   <FL val="Country">'.$country.'</FL>               
                </row>
           </CustomModule1>'; 
         $url = "https://crm.zoho.com/crm/private/xml/CustomModule1/updateRecords";
        $param= "authtoken=".$this->token."&scope=crmapi&id=".$zohoId."&xmlData=".$xml;
         $response=$this->zohoCurlRequest($url,$param);

         file_put_contents(FCPATH . 'dump/fitruums/ZohoUpdateResponse.xml', $response);
         if(!empty($response))         
         {
            $this->extractUpdateResponse($response,$user_no);
         }
       
    }


    public function extractUpdateResponse($response,$user_no)
    {    

      $resp=new SimpleXMLElement($response);
      $zohoUpdateRes=array();
      $zohoUpdateRes['Id']='';
      if(isset($resp->result))
      {
         $result=$resp->result;
         $message='';
         $zohoId='';
         if(isset($result->message))
         {
              $message=$result->message;
              $zohoUpdateRes['message']=$message;

         }  
         
         if(isset($result->recorddetail))
         { 
            $recorddetail=$result->recorddetail;
             foreach($recorddetail->FL as $val)
             {
                 $index=(string)$val['val'];
                 $zohoUpdateRes[$index]=(string)$val;
             }
           
         }
           if(!empty($zohoUpdateRes))
             {
               $zohoUpdateResJson=json_encode($zohoUpdateRes,JSON_FORCE_OBJECT);
                $dataUpdate=array('zohoUpdateResJson'=>$zohoUpdateResJson,);
                $this->Zoho_model->updateZohodata($user_no,$dataUpdate);
             }         
      }
    
    }


     public function insertRecordsIntoZohoBooking($id,$user_no,$Booking_Done_By,$CMH_RefNo,$api,$bookingnumber, $hotel_name,$Booking_Date,$check_in, $check_out,$total_cost,$booking_status, $room_count,$adult,$child,$children_age,$infant, $city, $room_type, $inclusion,$phone,$star, $address, $mobile, $passaddress,$nationality)
    {
     $xml='<CustomModule2>
                <row no="1">
                <FL val="USER NO">'.$user_no.'</FL>
                <FL val="BOOKING DONE BY">'.$Booking_Done_By.'</FL>
                <FL val="AIROOMS REF">'.$CMH_RefNo.'</FL>
                <FL val="API NAME">'.$api.'</FL>
                <FL val="API BOOKING REF">'.$bookingnumber.'</FL>
                <FL val="HOTEL NAME">'.$hotel_name.'</FL>             
                <FL val="BOOKING DATE">'.$Booking_Date.'</FL>               
                <FL val="CHECK IN DATE">'.$check_in.'</FL>
                <FL val="CHECK OUT DATE">'.$check_out.'</FL>
                <FL val="BOOKING TOTAL AMOUNT">'.$total_cost.'</FL>
                <FL val="BOOKING STATUS">'.$booking_status.'</FL>
                <FL val="ROOM COUNT">'.$room_count.'</FL>
                <FL val="NO OF ADULTS">'.$adult.'</FL> 
                <FL val="NO OF CHILDS">'.$child.'</FL>
                <FL val="CHILDREN AGE">'.$children_age.'</FL>
                <FL val="NO OF INFANT">'.$infant.'</FL>
                <FL val="HOTEL CITY">'.$city.'</FL>
                <FL val="ROOM TYPE">'.$room_type.'</FL>
                <FL val="MEAL NAME">'.$inclusion.'</FL>
                <FL val="HOTEL PHONE NO">'.$phone.'</FL>
                <FL val="HOTEL RATING">'.$star.'</FL>
                <FL val="HOTEL ADDRESS">'.$address.'</FL>
                <FL val="PASSENGER CONTACT NO">'.$mobile.'</FL>
                <FL val="PASSENGER ADDRESS">'.$passaddress.'</FL>
                <FL val="PASSENGER NATIONALITY">'.$nationality.'</FL>
                </row>
           </CustomModule2>';
         /* <FL val="CANCELLATION DATE"></FL> */
         $url = "https://crm.zoho.com/crm/private/xml/CustomModule2/insertRecords";
         $param= "authtoken=".$this->token."&scope=crmapi&newFormat=1&xmlData=".$xml;
         $response=$this->zohoCurlRequest($url,$param);
         file_put_contents(FCPATH . 'dump/fitruums/ZohoInsertBookingResponse.xml', $response);
         if(!empty($response))         
         {
            $this->extractInsertBookingResponse($response,$id,$CMH_RefNo);
         }
    }

    public function extractInsertBookingResponse($response,$id,$CMH_RefNo)
    {    

      $resp=new SimpleXMLElement($response);
      $zohoInsertRes=array();
      $zohoInsertRes['Id']='';
      if(isset($resp->result))
      {
         $result=$resp->result;
         $message='';
         $zohoId='';
         if(isset($result->message))
         {
              $message=$result->message;
              $zohoInsertRes['message']=$message;

         }  
         
         if(isset($result->recorddetail))
         { 
            $recorddetail=$result->recorddetail;
             foreach($recorddetail->FL as $val)
             {
                 $index=(string)$val['val'];
                 $zohoInsertRes[$index]=(string)$val;
             }
           
         }
           if(!empty($zohoInsertRes))
             {
               $zohoInsertResJson=json_encode($zohoInsertRes,JSON_FORCE_OBJECT);
                $dataUpdate=array(
                                  'zohoId'=>$zohoInsertRes['Id'],
                                  'zohoInsertResJson'=>$zohoInsertResJson,
                                  );
                $this->Zoho_model->updateBookingZohodata($id,$CMH_RefNo,$dataUpdate);
             }         
      }
    
    }

}

/* End of file agent.php */
/* Location: ./application/controllers/agent.php */