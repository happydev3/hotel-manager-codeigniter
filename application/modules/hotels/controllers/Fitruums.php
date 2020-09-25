<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 
 *  
 *
 * @package		
 * @author		Saahil
 * @copyright	Copyright (c) 2013 - 2014, Travelpd
 * @license		http://www.travelpd.com/support/license-agreement
 * @link		http://www.travelpd.com
 * 
 */

class fitruums extends MX_Controller {
    /*     * ***** START SET CREDENTIAL ********* */

    private $base_currency;
    private $client_id;
    private $username;
    private $password;
    private $mode;
    private $post_url;
    private $language;
    private $request_mode;
    private $api_flag;
    private $active_api;
    /*     * ***** START SET CREDENTIAL ********* */

    /*     * ***** START SET VARIABLES ********* */
    private $city_name;
    private $city_code;
    private $cin;
    private $cout;
    private $rooms;
    private $nights;
    private $adults;
    private $childs;
    private $infant;
    private $adults_count;
    private $childs_count;
    private $childs_ages;
    private $nationality;
    private $sess_id;
    private $uniqueRefNo;
    /*     * ***** END SET VARIABLES ********* */
    /*     * ***** Payment Gateway ********* */

    /*     * ***** START MARKUP VARIABLES ********* */
    private $admin_markup;
    private $agent_markup;
    private $payment_charge;
    private $Logger;

    private $adt_cnt;
    private $chd_cnt;
    private $inf_cnt;
    private $childage_str;

    /*     * ***** END MARKUP VARIABLES ********* */

    function __construct() {
        parent::__construct();
        $this->load->model('fitruums/fitruums_model');

        $this->active_api = 'fitruums';
        // $this->sess_id = $this->session->session_id;
        // $this->load->library('Logger');
        // $this->Logger = new Logger();
        $this->set_credientials();

        // $this->set_variables();
    }

    function set_credientials() {
        $authDetails = $this->fitruums_model->set_credientials($this->active_api);
        if ($authDetails != '') {
            $this->api_flag = true;
            // $this->post_url = ($authDetails->mode == 0 ? $authDetails->demo_url : $authDetails->live_url);

            if ($authDetails->mode == 0) {              
                $this->username = 'SHXMLTEST';
                $this->password = 'SHtest2017';
                $this->post_url = '';
            } else {                
                $this->username = 'SHXMLTEST';
                $this->password = 'SHtest2017';
                $this->post_url = '';
            }
            $this->language = 'en';
            $this->request_mode = 'SYNCHRONOUS'; // 'ASYNCHRONOUS';	
        } else {
            $this->api_flag = false;
        }
    }

   
    
    function set_variables($ses_id,$refNo) 
     {
        $this->sess_id = $ses_id;
        $hotel_search_data=$this->fitruums_model->check_hotel_search_data($ses_id,$refNo);
        $search_data=json_decode($hotel_search_data->search_data,true);
            // echo '<pre/>';print_r($search_data);exit;
        $this->city_code = $search_data['cityCode'];
        $cityNamearr=explode(',', $search_data['cityName']); 
        $this->city_name = $cityNamearr[0];     
        $code = $this->fitruums_model->get_fitruums_city(trim($cityNamearr[0]), trim($cityNamearr[1]));    
        // echo $code; exit;   
          if ($code == '') {
            $this->city_code = '';
        } else {
            $this->city_code = $code;
        }   
        
        
       
        $this->cin = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['checkIn'])));
        $this->cout = date('Y-m-d', strtotime(str_replace('/', '-', $search_data['checkOut'])));

        $this->nationality = $search_data['nationality'];

        $this->nights = $search_data['nights'];
        $this->rooms = $search_data['rooms'];
        $this->uniqueRefNo = $search_data['uniqueRefNo'];
        $this->adults = $search_data['adults'];
        $this->childs = $search_data['childs'];
        $this->infant = $search_data['infant'];
        $this->childs_ages = $search_data['childs_ages'];
        $this->adults_count = $search_data['adults_count'];
        $this->childs_count = $search_data['childs_count'];
        $this->base_currency = 'USD';

        $this->adt_cnt = 0;
        $this->chd_cnt = 0;
        if(!empty($this->infant))
        {
            $this->inf_cnt = $this->infant;
        }
        else
        {
            $this->inf_cnt = 0;
        }
        $this->childage_str='';
        $childage_arr=array();       
        // for ($i = 0; $i < $this->rooms; $i++) 
        for ($i = 0; $i < 1; $i++)         
        {
            $this->adt_cnt += $this->adults[$i];
            $adults_num = $this->adults[$i];
            $childs_num = 0;
            $infants_num = 0;
            if ($this->childs[$i] != 0) 
            {
                $ages = explode(',', $this->childs_ages[$i]);
                for ($a = 0; $a < count($ages); $a++) 
                {
                        $this->chd_cnt += 1;
                        $childs_num += 1;
                        $childage_arr[]=$ages[$a];                  
                }
            }
        }

      $this->childage_str=implode(',', $childage_arr);

   
    }

    public function hotels_availabilty_search($ses_id,$refNo) 
    {
        //Set fitruums Variables
        // $this->set_variables(); 
        $this->set_variables($ses_id,$refNo);

        if ($this->fitruums_model->check_hotel_search_result($ses_id,$refNo)) 
        {
            //   $this->fetch_search_result();
            echo json_encode(array('results' => 'success'));
        } 
        else
        {

           // $session_data = $this->session->userdata('hotel_search_data');
         $hotel_search_data=$this->fitruums_model->check_hotel_search_data($ses_id,$refNo);
         $search_data=json_decode($hotel_search_data->search_data,true);
         $cityNamearr=explode(',', $search_data['cityName']); 
         $this->city_name = $cityNamearr[0];     
         $checkCityCode = $this->fitruums_model->get_fitruums_city(trim($cityNamearr[0]), trim($cityNamearr[1])); 

         $this->fitruums_model->delete_temp_results($this->sess_id, $this->active_api);
          if ($checkCityCode != '' && $this->api_flag == 1)
          {
              $SearchHotelRS = $this->SearchHotelRQ();            
              
              if ($SearchHotelRS != NULL) 
              {
                    $this->extracthotels($SearchHotelRS);                  
              }
          }      
          echo json_encode(array('results' => 'success'));
         }
      
  }


   public function hotelsdetails_availabilty_search($hotelCode,$ses_id,$refNo) 
    {
        //Set fitruums Variables
        $this->set_variables($ses_id,$refNo);

        if ($this->fitruums_model->check_hotel_search_result($ses_id,$refNo)) 
        {
             
             return 1;
        } 
        else
        {

           // $session_data = $this->session->userdata('hotel_search_data');
         $hotel_search_data=$this->fitruums_model->check_hotel_search_data($ses_id,$refNo);
         $search_data=json_decode($hotel_search_data->search_data,true);
         $cityNamearr=explode(',', $search_data['cityName']); 
         $this->city_name = $cityNamearr[0];     
         $checkCityCode = $this->fitruums_model->get_fitruums_city(trim($cityNamearr[0]), trim($cityNamearr[1])); 

         $this->fitruums_model->delete_temp_results($this->sess_id, $this->active_api);
          if ($checkCityCode != '' && $this->api_flag == 1)
          {
            
              $SearchHotelRS = $this->SearchHotelDetailsRQ($hotelCode);            
              
              if ($SearchHotelRS != NULL) 
              {
                    $this->extracthotels($SearchHotelRS); 
                     return 1;                 
              }

          }      
          
         }
          return 0;
      
  }

  function SearchHotelDetailsRQ($hotelCode)
    {
               
       $url="http://search.fitruums.com/1/PostGet/NonStaticXMLAPI.asmx/Search?userName=".$this->username."&password=".$this->password."&language=".$this->language."&currencies=".$this->base_currency."&checkInDate=".$this->cin."&checkOutDate=".$this->cout."&numberOfRooms=".$this->rooms."&destination=&destinationID=&hotelIDs=".$hotelCode."&resortIDs=&accommodationTypes=&numberOfAdults=".$this->adt_cnt."&numberOfChildren=".$this->chd_cnt."&childrenAges=".$this->childage_str."&infant=".$this->inf_cnt."&sortBy=&sortOrder=&exactDestinationMatch=&blockSuperdeal=&showTransfer=&mealIds=&showCoordinates=&showReviews=&referencePointLatitude=&referencePointLongitude=&maxDistanceFromReferencePoint=&minStarRating=&maxStarRating=&featureIds=&minPrice=&maxPrice=&themeIds=&excludeSharedRooms=&excludeSharedFacilities=&prioritizedHotelIds=&totalRoomsInBatch=&paymentMethodId=&CustomerCountry=".$this->nationality."&B2C=1";  
       // echo $url;   
        file_put_contents(FCPATH . 'dump/fitruums/hotelsearchDetRequest.txt', $url);
        $response=$this->curl_request($url);
        file_put_contents(FCPATH . 'dump/fitruums/hotelsearchDetResponse.xml', $response);
        return $response;

   }



    function SearchHotelRQ()
    {
               
       $url="http://search.fitruums.com/1/PostGet/NonStaticXMLAPI.asmx/Search?userName=".$this->username."&password=".$this->password."&language=".$this->language."&currencies=".$this->base_currency."&checkInDate=".$this->cin."&checkOutDate=".$this->cout."&numberOfRooms=".$this->rooms."&destination=&destinationID=".$this->city_code."&hotelIDs=&resortIDs=&accommodationTypes=&numberOfAdults=".$this->adt_cnt."&numberOfChildren=".$this->chd_cnt."&childrenAges=".$this->childage_str."&infant=".$this->inf_cnt."&sortBy=&sortOrder=&exactDestinationMatch=&blockSuperdeal=&showTransfer=&mealIds=&showCoordinates=&showReviews=&referencePointLatitude=&referencePointLongitude=&maxDistanceFromReferencePoint=&minStarRating=&maxStarRating=&featureIds=&minPrice=&maxPrice=&themeIds=&excludeSharedRooms=&excludeSharedFacilities=&prioritizedHotelIds=&totalRoomsInBatch=&paymentMethodId=&CustomerCountry=".$this->nationality."&B2C=1";     
        file_put_contents(FCPATH . 'dump/fitruums/hotelsearchRequest.txt', $url);
        $response=$this->curl_request($url);
        file_put_contents(FCPATH . 'dump/fitruums/hotelsearchResponse.xml', $response);
        return $response;

   }

   function extracthotels($SearchHotelRS)
   {    
      $result=new SimpleXMLElement($SearchHotelRS);
      if(isset($result->hotels))
      {
        $hotels=$result->hotels;
        foreach($hotels->hotel as $val)
        {
            $hotel_code=(string)$val->{'hotel.id'};
            $city_code=(string)$val->destination_id;
            $resort_id=(string)$val->resort_id;
            $resort_name='';
            if(!empty($resort_id))
            {
                $resort_name=$this->fitruums_model->get_resort_details($resort_id,$this->city_code);
            }
            $transfer=(string)$val->transfer;
            if(isset($val->roomtypes))
            {
                $roomtypes=$val->roomtypes;
                foreach($roomtypes->roomtype as $val1)
                {
                    $room_type_id=(string)$val1->{'roomtype.ID'};
                    if(isset($val1->rooms))
                    {
                       $rooms=$val1->rooms;
                        foreach($rooms->room as $val2)   
                        {
                            $room_code=(string)$val2->id;
                            $beds=(string)$val2->beds;
                            $extrabeds=(string)$val2->extrabeds;                           
                            $cancellation_policies_json='';
                            if(isset($val2->cancellation_policies))
                            {
                                 $cancellation_policies_arr=array();
                                 $cancellation_policies=$val2->cancellation_policies;
                                 foreach($cancellation_policies->cancellation_policy as $val3)
                                 {
                                    $deadline=(string)$val3->deadline;
                                    $percentage=(string)$val3->percentage;
                                    $cancellation_policies_arr[$deadline]=$percentage;
                                 }
                                 $cancellation_policies_json=json_encode($cancellation_policies_arr);
                        
                            }
                            $notes_json='';
                            if(isset($val2->notes))
                            {
                                 $notes_arr=array();
                                 $notes=$val2->notes;
                                 foreach($notes->note as $val4)
                                 {
                                    $start_date=(string)$val4["start_date"];
                                    $end_date=(string)$val4["end_date"];
                                    $text=(string)$val4->text;
                                    $notes_arr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
                                 }
                                 $notes_json=json_encode($notes_arr);
                            }
                            $isSuperDeal=(string)$val2->isSuperDeal;
                            $isBestBuy=(string)$val2->isBestBuy;
                            $paymentMethods=$val2->paymentMethods;
                            $paymentMethod=$paymentMethods->paymentMethod;
                            $paymentMethod_id=(string)$paymentMethod['id'];
                            $property_json='';
                            if(isset($paymentMethod->property))
                            {
                                $property_arr=array();
                                foreach($paymentMethod->property as $val5)
                                {
                                    $property_key=(string)$val5['key'];
                                    $property_value=(string)$val5['value'];
                                    $property_arr[$property_key]=$property_value;
                                }
                                $property_json=json_encode($property_arr);
                            }

                           /* $session_data = $this->session->userdata('hotel_search_data');
                            $this->load->module('hotels/hotel_markup');
                            $markup_array = $this->hotel_markup->markup_calculation($amountv1, $this->nationality, $this->active_api); */
                        $room_type_det=$this->fitruums_model->getFitruumsRoomTypes($room_type_id);

                        if(isset($val2->meals))
                            {
                                $meals=$val2->meals;
                                $meal=$meals->meal;
                                foreach($meal as $val)
                                {
                                    $mealid=(string)$val->id;
                                    $mealName='';
                                    if(isset($mealid))
                                    {
                                        $mealName=$this->fitruums_model->get_meal_name($mealid);
                                    }
                                    $labelId=(string)$val->labelId;
                                    $labeltext='';
                                    if(isset($labelId)&&isset($mealid))
                                    {
                                        $labelIdarr=explode(',', $labelId);
                                        $labeltext_arr=array();
                                        foreach($labelIdarr as $labelval)
                                        {
                                            $labeltext_arr[]=$this->fitruums_model->get_meallabel_name($mealid,$labelval);
                                        }
                                        $labeltext=implode(',', $labeltext_arr);
                                    }
                                    $prices=$val->prices;
                                    $price=$prices->price;
                                    $currency=(string)$price['currency'];
                                    $paymentMethods=(string)$price['paymentMethods'];
                                    $tot_cost=(string)$price;
                                    $typeId='';
                                    $discount_amount=0;
                                    if(isset($meals->discount))
                                    {
                                        $discount=$meals->discount;
                                        $typeId=(string)$discount->typeId;
                                        $amounts=$discount->amounts;
                                        $discount_amount=(string)$amounts->amount; 
                                        
                                    }

                          
                            $trustYouID=$this->fitruums_model->getTrustYouID($hotel_code);
                        

                            $availability_data = array(
                                            'session_id' => $this->sess_id,
                                            'api' => $this->active_api,
                                            'hotel_code' => $hotel_code,
                                            'room_code' => $room_code,
                                            'room_type_id' => $room_type_id,
                                            'room_type'=>$room_type_det->roomtypename,
                                            'share_bed'=>$beds,
                                            'extrabeds'=>$extrabeds,
                                            'mealType' => $mealid, 
                                            'mealName' => $mealName,                        
                                            'meallabelid' => $labelId,                        
                                            'meallabeltext' => $labeltext,                        
                                            'adult' => $this->adt_cnt,
                                            'child' => $this->chd_cnt,
                                            'infant' => $this->inf_cnt,
                                            'child_age'=>$this->childage_str,
                                            'currency_val' => 1,
                                            'xml_currency' => $currency,
                                            'currency' => $this->base_currency,
                                            'org_amt' => $tot_cost,
                                            'cancel_policy' => $cancellation_policies_json,
                                            'city_code' => $city_code,
                                            'city_name'=>$this->city_name,
                                            'resort_id'=>$resort_id,
                                            'resort_name'=>$resort_name,
                                            'transfer'=>$transfer,
                                            'room_count' => $this->rooms,
                                            'nights'=>$this->nights,
                                            'discount_coupon' => $typeId,
                                            'discount' => $discount_amount,
                                            'uniqueRefNo' => $this->uniqueRefNo,
                                            'unique_cityid' => $this->city_code,
                                            'currency_conv_value' => $tot_cost,
                                            'ROE' => 1,
                                            'total_cost' =>$tot_cost,
                                            'fitruums_notes'=>$notes_json,
                                            'fitruums_isSuperDeal'=>$isSuperDeal,
                                            'fitruums_isBestBuy'=>$isBestBuy,
                                            'fitruums_paymentMethod_id'=>$paymentMethod_id,
                                            'fitruums_payment_property'=>$property_json,
                                            'trustYouID'=>$trustYouID,
                                          
                                           );
                                if (!empty($availability_data)) 
                                {
                                  $this->db->insert('hotel_search_result',$availability_data);
                                }
                                if($this->session->userdata('user_no'))
                                {
                                    $user_no=$this->session->userdata('user_no');
                                    $res=$this->fitruums_model->getWishList($user_no);
                                    if(!empty($res))
                                    {
                                          
                                      $this->fitruums_model->updateWishList($this->sess_id,$this->active_api,$this->uniqueRefNo,$res);
                                    }
                                }


                         }
                                
                       }

                      }

                   }                
               }
            }
        }
    }

  }

   

    public function fetch_search_result() {
        $temp_data = $this->fitruums_model->fetch_search_result($this->sess_id, $this->active_api, $this->uniqueRefNo);
        $data['result'] = $temp_data;

        //echo '<pre/>ss';print_r($data['result']);exit;
        $hotels_search_result = $this->load->view('fitruums/search_result_ajax', $data, true);
        if (empty($hotels_search_result)) {
            $hotels_search_result = '';
        }
        echo json_encode(array(
            'hotels_search_result' => $hotels_search_result
        ));
    }

    public function hotel_details($hotelCode, $searchId,$ses_id,$refNo)
     {
        $this->set_variables($ses_id,$refNo);
        $data['searchId'] = $searchId;
        $data['hotelDetails'] = $hotelDetails = $this->fitruums_model->getHotelDetails($hotelCode, $searchId);
         $data['room_info'] =  $this->fitruums_model->get_hotel_rooms($this->city_code, $this->sess_id, $hotelCode);
         // print_r($data['room_info']); exit;
             $address='';
             if(!empty($hotelDetails))
             {
             if($hotelDetails->street1!="")
              {
                 $address.=$hotelDetails->street1.', ';
              }
               if($hotelDetails->street2!="")
              {
                 $address.=$hotelDetails->street2.', ';
              }
                if($hotelDetails->city!="")
              {
                 $address.=$hotelDetails->city.', ';
              }
                if($hotelDetails->state!="")
              {
               $address.=$hotelDetails->state.', ';
              }
                if($hotelDetails->country!="")
              {
                 $address.=$hotelDetails->country;
              }
               if($hotelDetails->zipcode!="")
              {
                 $address.=' - '.$hotelDetails->zipcode;
              }
            
        $data['address']=$address;
        $data['ses_id'] = $ses_id;                
        $data['refNo'] = $refNo;  
        $data['checkdate'] = $this->cin;    
        $data['newuniqueRefNo'] = $this->generateRandomString(8);;    
        $this->load->view('fitruums/hotel_details', $data);
      }
      else
      {

            echo 'Permission Denied';
        
      }
    }
 


   public function hotel_itinerary($hotelCode,$searchId,$session_id,$refNo)
   {

        $this->set_variables($session_id,$refNo);
        $roomDetails = $this->fitruums_model->getRoomDetails($this->active_api, $session_id, $hotelCode, $searchId); 
        // echo "<pre>"; print_r($roomDetails); exit;
        
         if(!empty($roomDetails))
         {
             $preBookRS = $this->preBookRQ($roomDetails->room_code,$roomDetails->mealType,$roomDetails->xml_currency,$roomDetails->org_amt);
              $errorMsg='';
              if ($preBookRS != NULL) 
              {
                    $errorMsg=$this->extractpreBookRS($preBookRS, $session_id, $hotelCode, $searchId, $refNo,$roomDetails->org_amt);
              }                    

              
                /*
                $this->load->module('hotels/hotel_markup');
                $markup_array = $this->hotel_markup->markup_calculation($cost_val, $this->nationality, $this->active_api);

                $dataAr['session_id'] = $this->sess_id;
                $dataAr['search_id'] = $searchId;
                $dataAr['api'] = $this->active_api;
                $dataAr['admin_markup'] = $markup_array['admin_markup'];
                $dataAr['admin_agent_markup'] = $markup_array['admin_agent_markup'];
                $dataAr['di_markup'] = $markup_array['di_markup'];
                $dataAr['di_agent_markup'] = $markup_array['di_agent_markup'];
                $dataAr['sub_agent_markup'] = $markup_array['sub_agent_markup'];
                $dataAr['payment_charge'] = $markup_array['payment_charge'];
                $dataAr['org_cost'] = $amountv1;

                $dataAr['total_cost'] = $markup_array['total_cost'];
                $dataAr['cancel_amount'] = $cancel_amount;
                $dataAr['cancel_till_date'] = $cancel_till_date;
                $dataAr['can_pal'] = $can_pal;

                $rm_info = $this->fitruums_model->update_fitruums_temp_hotel_result_price($dataAr);
                */
                $data['roomDetails'] = $roomDetails = $this->fitruums_model->getRoomDetails($this->active_api, $session_id, $hotelCode, $searchId);
                $data['tempSearchId'] = $searchId;
                $data['countryList'] = $this->fitruums_model->get_country_list();
                $data['ses_id'] = $session_id;                
                $data['refNo'] = $refNo;  
           
                if (!empty($roomDetails)&&$errorMsg=='') 
                {
                    // $deposit_check_status = $this->deposit_check($roomDetails);
                    // $data['deposit_check_status'] = $deposit_check_status;

                    $this->load->view('fitruums/hotel_itinerary', $data);
                } 
                else 
                {                    
                         $error = 'One of the selected room type is not available. Please search again';
                         redirect('hotels/error_page/' . base64_encode($error));
                         exit;                 
                    // $this->hotel_details($hotelCode, $searchId,$session_id,$refNo);
                  
                }
           
        }
       else 
        {
           $error = 'One of the selected room type is not available. Please search again';
           redirect('hotels/error_page/' . base64_encode($error));
           exit;  
            // $this->hotel_details($hotelCode, $searchId,$session_id,$refNo);
          
        }
    }


    function preBookRQ($roomId,$mealId,$currency,$searchPrice)
    {
     
      $url="http://book.fitruums.com/1/PostGet/Booking.asmx/PreBook?userName=".$this->username."&password=".$this->password."&currency=".$currency."&language=".$this->language."&checkInDate=".$this->cin."&checkOutDate=".$this->cout."&roomId=".$roomId."&rooms=".$this->rooms."&adults=".$this->adt_cnt."&children=".$this->chd_cnt."&childrenAges=".$this->childage_str."&infant=".$this->inf_cnt."&mealId=".$mealId."&CustomerCountry=".$this->nationality."&B2C=1&searchPrice=".$searchPrice;  
        file_put_contents(FCPATH . 'dump/fitruums/hotelpreBookRequest.txt', $url);

       

        $response=$this->curl_request($url);
        file_put_contents(FCPATH . 'dump/fitruums/hotelpreBookResponse.xml', $response);
        return $response;

   }

   function curl_request($url)
   {
       $httpHeader = array(
                        "Content-Type: text/xml; charset=UTF-8",
                        "Content-Encoding: UTF-8",
                        "Accept-Encoding: gzip,deflate"
                         );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        $response = curl_exec($ch);
        $errno = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
   }
   
   function extractpreBookRS($preBookRS, $session_id, $hotelCode, $searchId, $refNo,$org_amt)
   {    
      $result=new SimpleXMLElement($preBookRS);
      $notes_json='';
      $preBookCode='';
      $price='';
      $currency='';
      $cancellation_policies_json='';
      $errorType="";
      $errorMessage="";
      if(isset($result->Notes))
      {
             $notes_arr=array();
             $notes=$result->Notes;
             foreach($notes->Note as $val1)
             {
                $start_date=(string)$val1["start_date"];
                $end_date=(string)$val1["end_date"];
                $text=(string)$val1->text;
                $notes_arr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
             }
             $notes_json=json_encode($notes_arr);
               if(!empty($notes_arr))
                 {
                  $dataUpdate=array(
                                'fitruums_notes'=>$notes_json,
                                );
                    $this->fitruums_model->updatePrebookingPrice($session_id, $hotelCode, $searchId, $refNo,$dataUpdate);
                 }
      }
      if(isset($result->PreBookCode))
      {
        $preBookCode=(string)$result->PreBookCode; 
        $dataUpdate=array(
                         'fitruumsPreBookCode' => $preBookCode,
                         );
            $this->fitruums_model->updatePrebookingPrice($session_id, $hotelCode, $searchId, $refNo,$dataUpdate);       
      }
      if(isset($result->Price))
      {
        $price=(string)$result->Price;      
        $currency=(string)$result->Price['currency']; 
        if($price>1)
        {
            $priceChange='';
            if($org_amt!=$price)
            {
                $priceChange="price has been changed";
            }
            $dataUpdate=array(
                         'org_amt' => $price,
                         'currency_conv_value' => $price,
                         'total_cost' =>$price,
                         'xml_currency' => $currency,
                         'priceChange'=>$priceChange,
                        );
            $this->fitruums_model->updatePrebookingPrice($session_id, $hotelCode, $searchId, $refNo,$dataUpdate);     
        }
      }
     if(isset($result->CancellationPolicies))
     {
         $cancellation_policies_arr=array();
         $cancellation_policies=$result->CancellationPolicies;
         foreach($cancellation_policies->CancellationPolicy as $val2)
         {
            $deadline=(string)$val2->deadline;
            $percentage=(string)$val2->percentage;
            $text=(string)$val2->text;
            $cancellation_policies_arr[$deadline]=$percentage."|".$text;
         }
         $cancellation_policies_json=json_encode($cancellation_policies_arr);
         if(!empty($cancellation_policies_arr))
         {
          $dataUpdate=array(
                         'cancel_policy' => $cancellation_policies_json,
                        );
            $this->fitruums_model->updatePrebookingPrice($session_id, $hotelCode, $searchId, $refNo,$dataUpdate);
         }

     }
      if(isset($result->Error))
      {
        $error=$result->Error; 
        $errorType=(string)$error->ErrorType;     
        $errorType=(string)$error->ErrorType;     
        $errorMessage=(string)$error->Message;      
      }

      return $errorMessage;
   }


   
    public function payment_gateway($sessionId, $hotelCode, $searchId) {
        $this->set_variables();

        $data['roomDetails'] = $roomDetails = $this->fitruums_model->getRoomDetails($this->active_api, $sessionId, $hotelCode, $searchId);

        $pass_info = $this->session->userdata('passenger_info');
        //	if($passenger_info['payment_type'] == 'icici'){ $pay_type='PG';  }else{ $pay_type='deposit';  }
        $totsend = 0;


        $totsend = $roomDetails->total_cost;


        $ip = $_SERVER['REMOTE_ADDR'];
        //$payinsert = array('uniqueRefNo' => $this->uniqueRefNo, 'amount' => $totsend, 'passenger_email' => $pass_info['user_email'], 'passenger_mobile' => $pass_info['user_mobile'], 'service_type' => 1, 'ip' => $_SERVER['REMOTE_ADDR']);
        //$payinsert_id = $this->fitruums_model->pay_details($payinsert);
        $pay_details = array(
            'callBackId' => 'fitruums',
            'searchId' => $searchId,
            'hotelCode' => $hotelCode,
            'sessionId' => $sessionId,
            //'payinsert_id' => $payinsert_id,
            'uniqueRefNo' => $this->uniqueRefNo,
            'total_cost' => round($totsend),
            'desc' => 'Airooms Hotel Booking : ' . $this->uniqueRefNo,
            'paytype' => $pass_info['paytype'],
            'passenger_email' => $pass_info['user_email'],
            'passenger_mobile' => $pass_info['user_mobile'],
            'service_type' => 1,
            'ip' => $ip,
            'currency' => 'USD',
            'return_url' => site_url() . "hotels/payment_return",
        );
        $this->session->set_userdata('pay_details', $pay_details);
        redirect('payment/index', 'refresh');
        exit;
    }

    public function hotel_reservation($session_id, $hotelCode, $searchId,$refNo)
    {
        $this->set_variables($session_id,$refNo);
        $pass_info = $this->session->userdata('passenger_info');
        $data['roomDetails'] = $roomDetails = $this->fitruums_model->getRoomDetails($this->active_api, $session_id, $hotelCode, $searchId);
        $data['tempSearchId'] = $searchId;


        if ($this->session->userdata('user_logged_in'))
         {

            $user_id = $this->session->userdata('user_id');
            $user_no = $this->session->userdata('user_no');

            $Booking_Done_By = 'user';
            $agent_type = '0';
            $agent_id = 0;
            $deposit_withdraw_markup = '0';
         } 
         else
          {

            $agent_id = 0;
            $user_id = 0;
            $user_no = '';
            $agent_type = 0;
            $Booking_Done_By = 'guest';
            $deposit_withdraw_markup = '0';
          }
          $pay_type = 'payment_gateway';
       



        //Booking Request    

        $bookingRS = $this->bookingRQ($roomDetails->room_code,$roomDetails->mealType,$roomDetails->xml_currency,$roomDetails->fitruumsPreBookCode);



      $result=new SimpleXMLElement($bookingRS);
      $bookingnumber='';
      $bookingdatajson='';
      if(isset($result->booking))
      {
             $booking=$result->booking;
             $bookingnumber=isset($booking->bookingnumber)?(string)$booking->bookingnumber:'';      
             $hotel_code=isset($booking->{'hotel.id'})?(string)$booking->{'hotel.id'}:'';
             $hotel_name=isset($booking->{'hotel.name'})?(string)$booking->{'hotel.name'}:'';
             $hotel_address=isset($booking->{'hotel.address'})?(string)$booking->{'hotel.address'}:'';
             $hotel_phone=isset($booking->{'hotel.phone'})?(string)$booking->{'hotel.phone'}:'';
             $numberofrooms=isset($booking->numberofrooms)?(string)$booking->numberofrooms:'';
             $roomtype=isset($booking->{'room.type'})?(string)$booking->{'room.type'}:'';
             $roomEnglishType=isset($booking->{'room.englishType'})?(string)$booking->{'room.englishType'}:'';
             $mealId=isset($booking->mealId)?(string)$booking->mealId:'';
             $mealName=isset($booking->meal)?(string)$booking->meal:'';
             $mealLabel=isset($booking->mealLabel)?(string)$booking->mealLabel:'';
             $englishMeal=isset($booking->englishMeal)?(string)$booking->englishMeal:'';
             $englishMealLabel=isset($booking->englishMealLabel)?(string)$booking->englishMealLabel:'';
             $checkindate=isset($booking->checkindate)?(string)$booking->checkindate:'';
             $checkoutdate=isset($booking->checkoutdate)?(string)$booking->checkoutdate:'';
             $i=0;
             $currency1='';
             $paymentMethods1='';
             $price1='';
             $currency2='';
             $price2='';
             $paymentMethods2='';
             if(isset($booking->prices))
             {
                 $prices=$booking->prices;
                 foreach($prices->price as $val)
                 {
                      if($i==0)
                      {
                          $currency1=(string)$val['currency'];
                          $paymentMethods1=(string)$val['paymentMethods'];
                          $price1=(string)$val->price;
                          $i++;
                      }
                      if($i==1)
                      {
                          $currency2=(string)$val['currency'];
                          $paymentMethods2=(string)$val['paymentMethods'];
                          $price2=(string)$val->price;
                          break;
                      }
                 }
             } 
             $currency=isset($booking->currency)?(string)$booking->currency:'';
             $bookingdate=isset($booking->bookingdate)?(string)$booking->bookingdate:'';
             $bookingdateTimezone=isset($booking->{'bookingdate.timezone'})?(string)$booking->{'bookingdate.timezone'}:'';

             $cancellation_policies_json='';
             if(isset($booking->cancellationpolicies))
             {
                 $cancellation_policies_arr=array();
                 $cancellation_policies=$booking->cancellationpolicies;
                  foreach($cancellation_policies as $val)
                 {
                         $deadline=(string)$val->deadline;
                         $percentage=(string)$val->percentage;
                         $text=(string)$val->text;
                         $cancellation_policies_arr[$deadline]=$percentage."|".$text; 
                 }
                               
                 if(!empty($cancellation_policies_arr))
                 {
                   $cancellation_policies_json=json_encode($cancellation_policies_arr);
                 }

             }
             $earliestNonFreeCancellationDateCET=isset($booking->{'earliestNonFreeCancellationDate.CET'})?(string)$booking->{'earliestNonFreeCancellationDate.CET'}:'';
             $earliestNonFreeCancellationDateLocal=isset($booking->{'earliestNonFreeCancellationDate.CET'})?(string)$booking->{'earliestNonFreeCancellationDate.Local'}:'';
             $yourref=isset($booking->yourref)?(string)$booking->yourref:'';
             $voucher=isset($booking->voucher)?(string)$booking->voucher:'';
             $bookedBy=isset($booking->bookedBy)?(string)$booking->bookedBy:'';
             $transferbooked=isset($booking->transferbooked)?(string)$booking->transferbooked:'';
             if(isset($booking->paymentmethod))
             {
                 $paymentmethod=$booking->paymentmethod;
                 $paymentmethodId=(string)$paymentmethod['id'];
                 $paymentmethodName=(string)$paymentmethod['name'];
             }
             $notes_json='';
             if(isset($booking->hotelNotes))
             {
                     $notes_arr=array();
                     $notes=$booking->hotelNotes;
                     foreach($notes->hotelNote as $val1)
                     {
                        $start_date=(string)$val1["start_date"];
                        $end_date=(string)$val1["end_date"];
                        $text=(string)$val1->text;
                        $notes_arr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
                     }
                     if(!empty($notes_arr))
                     {
                       $notes_json=json_encode($notes_arr);
                     }                    
              }

             $englishHotelNotesJson='';             
             if(isset($booking->englishHotelNotes))
             {
                     $englishHotelNotesArr=array();
                     $englishHotelNotes=$booking->englishHotelNotes;
                     foreach($englishHotelNotes->englishHotelNote as $val1)
                     {
                        $start_date=(string)$val1["start_date"];
                        $end_date=(string)$val1["end_date"];
                        $text=(string)$val1->text;
                        $englishHotelNotesArr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
                     }
                     if(!empty($englishHotelNotesArr))
                     {
                       $englishHotelNotesJson=json_encode($englishHotelNotesArr);
                     }
                }

                    $roomNotesJson='';
                     if(isset($booking->roomNotes))
                     {
                          $roomNotesArr=array();
                          $roomNotes=$booking->roomNotes;
                         foreach($roomNotes->roomNote as $val2)
                         {
                            $start_date=(string)$val2["start_date"];
                            $end_date=(string)$val2["end_date"];
                            $text=(string)$val2->text;
                            $roomNotesArr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
                         }
                         if(!empty($roomNotesArr))
                         {
                           $roomNotesJson=json_encode($roomNotesArr);
                         } 
                      } 

                 $englishroomNotesJson='';
                     if(isset($booking->englishRoomNotes))
                     {
                          $englishroomNotesArr=array();
                          $englishRoomNotes=$booking->englishRoomNotes;
                         foreach($englishRoomNotes->englishRoomNote as $val2)
                         {
                            $start_date=(string)$val2["start_date"];
                            $end_date=(string)$val2["end_date"];
                            $text=(string)$val2->text;
                            $englishroomNotesArr[]='Valid From '.$start_date.' To '.$end_date.'<br>'.$text.'<br>';
                         }
                         if(!empty($englishroomNotesArr))
                         {
                           $englishroomNotesJson=json_encode($englishroomNotesArr);
                         } 
                      }                                             
              

            $invoiceref=isset($booking->invoiceref)?(string)$booking->invoiceref:'';

            $dataArr=array(
                        'bookingnumber'=>$bookingnumber,
                        'hotel_code'=>$hotel_code,
                        'hotel_name'=>$hotel_name,
                        'hotel_address'=>$hotel_address,
                        'hotel_phone'=>$hotel_phone,
                        'numberofrooms'=>$numberofrooms,
                        'roomtype'=>$roomtype,
                        'roomEnglishType'=>$roomEnglishType,
                        'mealId'=>$mealId,
                        'mealName'=>$mealName,
                        'mealLabel'=>$mealLabel,
                        'englishMeal'=>$englishMeal,
                        'englishMealLabel'=>$englishMealLabel,
                        'checkindate'=>$checkindate,
                        'checkoutdate'=>$checkoutdate,
                        'price1'=>$price1,
                        'currency1'=>$currency1,
                        'paymentMethods1'=>$paymentMethods1,
                        'price2'=>$price2,
                        'currency2'=>$currency2,
                        'paymentMethods2'=>$paymentMethods2,
                        'currency'=>$currency,
                        'bookingdate'=>$bookingdate,
                        'bookingnumber'=>$bookingnumber,
                        'bookingdateTimezone'=>$bookingdateTimezone,
                        'cancellation_policies_json'=>$cancellation_policies_json,
                        'earliestNonFreeCancellationDateCET'=>$earliestNonFreeCancellationDateCET,
                        'earliestNonFreeCancellationDateLocal'=>$earliestNonFreeCancellationDateLocal,
                        'yourref'=>$yourref,
                        'voucher'=>$voucher,
                        'bookedBy'=>$bookedBy,
                        'transferbooked'=>$transferbooked,
                        'paymentmethodId'=>$paymentmethodId,
                        'paymentmethodName'=>$paymentmethodName,
                        'hotelNotesjson'=>$notes_json,
                        'englishHotelNotesJson'=>$englishHotelNotesJson,
                        'roomNotesJson'=>$roomNotesJson,
                        'englishroomNotesJson'=>$englishroomNotesJson,
                        'invoiceref'=>$invoiceref,
                      );  
        $bookingdatajson=json_encode($dataArr,JSON_FORCE_OBJECT);
      }
      
      $errorType='';
      $errorMessage='';
      if(isset($result->Error))
      {
        $error=$result->Error;          
        $errorType=(string)$error->ErrorType;     
        $errorMessage=(string)$error->Message;      
      }    
        

       if ($bookingnumber=='')
       {
           $booking_status = 'Failed';
           $bookingnumber="XXXXXXXXXXX";
       }
       else 
       {
            $booking_status = 'Success';

        }

        $Booking_Date = date('Y-m-d');
    
    $this->getBookingInformationRQ($refNo);

        
       $datainsert= array(
            'user_id' => $user_id,
            'user_no' => $user_no,
            'agent_id' => 0,
            'Api_Name' => 'fitruums',
            'Hotel_RefNo' => $bookingnumber,
            'Booking_RefNo' => $bookingnumber,            
            'uniqueRefNo' => $refNo,
            'Booking_Status' => $booking_status,
            'Booking_Date' => $Booking_Date,
            'Booking_Amount' => $roomDetails->total_cost,
            'total_cost' => $roomDetails->total_cost,
            'Admin_Markup' => 0,
            'Admin_Agent_Markup' => 0,
            'Payment_Charge' => 0,
            'Currency' => $roomDetails->currency,
            'Xml_Currency' => $roomDetails->xml_currency,
            //'Cancel_Till_Date' => $Cancel_Till_Date,
            'Booking_Done_By' => $Booking_Done_By,
            // 'payment_type'=>$payment_type
            'cancel_policy' => $cancellation_policies_json,
            'Di_Markup'=>0,
            'Di_Agent_Markup'=>0,
            'Sub_Agent_Markup'=>0,
            'payment_type'=>$pay_type,
            'agent_type'=>$agent_type,
            'fitruumsBookingRs'=>$bookingdatajson,
            'fitruumsPreBookCode'=>$roomDetails->fitruumsPreBookCode,
            'user_name'=>$pass_info['user_fname'].' '.$pass_info['user_lname'],
            'user_email'=>$pass_info['user_email'],
            'user_mobile'=>$pass_info['user_mobile'],
            'country_residence'=>$pass_info['country_residence'],
        );
        // echo "<pre>"; print_r($datainsert); exit;
        $this->db->insert('hotel_booking_reports', $datainsert);
       
        $id=$this->db->insert_id(); 
          $address='';
         if($roomDetails->street1!="")
          {
             $address.=$roomDetails->street1.', ';
          }
           if($roomDetails->street2!="")
          {
             $address.=$roomDetails->street2.', ';
          }
            if($roomDetails->city!="")
          {
             $address.=$roomDetails->city.', ';
          }
            if($roomDetails->state!="")
          {
           $address.=$roomDetails->state.', ';
          }
            if($roomDetails->country!="")
          {
             $address.=$roomDetails->country;
          }
           if($roomDetails->zipcode!="")
          {
             $address.=' - '.$roomDetails->zipcode;
          }

            // Hotel Booking Hotels Information Data
         $this->fitruums_model->insert_hotel_booking_information_data($user_id,$user_no, $agent_id, $refNo, $roomDetails->hotel_code, $roomDetails->hotel_name, $roomDetails->room_code,$roomDetails->city_code, $this->cin, $this->cout, $Booking_Date, $roomDetails->city, $roomDetails->room_type, $roomDetails->mealName, $roomDetails->classification, $address, $roomDetails->room_count, $roomDetails->cancel_policy, $this->adt_cnt, $this->chd_cnt,$this->inf_cnt, $roomDetails->description, $roomDetails->phone, $roomDetails->fax, $roomDetails->images, $this->nights, 'fitruums',$roomDetails->fitruums_notes, $this->childage_str,$roomDetails->latitude,$roomDetails->longitude,$this->nationality); 
        $passenger_info = $this->session->userdata('passenger_info');       
        $mobile = $passenger_info['user_mobile'];
        $country = $this->fitruums_model->getCountryName($this->nationality);
        $passaddress=$country;
        $this->load->module('b2c/zoho');
        $this->zoho->insertRecordsIntoZohoBooking($id,$user_no,$Booking_Done_By,$refNo,'fitruums',$bookingnumber, $roomDetails->hotel_name,$Booking_Date,$this->cin, $this->cout,$roomDetails->total_cost,$booking_status, $roomDetails->room_count,$this->adt_cnt,$this->chd_cnt,$this->childage_str,$this->inf_cnt, $roomDetails->city, $roomDetails->room_type, $roomDetails->mealName,$roomDetails->phone, $roomDetails->classification, $address, $mobile, $passaddress,$country);           
         redirect('hotels/voucher?voucherId=' . $refNo . '&hotelRefId=' . $bookingnumber, 'refresh');
     }
  



   
 

    function bookingRQ($roomId,$mealId,$currency,$preBookCode)
    {     
        $pass_info = $this->session->userdata('passenger_info');
        $customerEmail=$pass_info['user_email'];
        $adultsFname=array();
        $adultsLname=array();
        $childsFname=array();
        $childsLname=array();
        $adultsFname=$pass_info['adults_fname'];
        $adultsLname=$pass_info['adults_lname'];
        $childsFname=isset($pass_info['childs_fname'])?$pass_info['childs_fname']:array();
        $childsLname=isset($pass_info['childs_lname'])?$pass_info['childs_lname']:array();
        $adultNameStr='';
        $childNameAgeStr='';
        $childAgeArr=array();
        $childAgeArr=explode(',', $this->childage_str);
        for($i=0;$i<9;$i++)
        {
            $adultsFname[$i]=isset($adultsFname[$i])?$adultsFname[$i]:'';
            $adultsLname[$i]=isset($adultsLname[$i])?$adultsLname[$i]:'';
            $childsFname[$i]=isset($childsFname[$i])?$childsFname[$i]:'';
            $childsLname[$i]=isset($childsLname[$i])?$childsLname[$i]:'';
            $childAgeArr[$i]=isset($childAgeArr[$i])?$childAgeArr[$i]:'';           
            $adultNameStr.="&adultGuest".($i+1)."FirstName=".$adultsFname[$i]."&adultGuest".($i+1)."LastName=".$adultsLname[$i];
            $childNameAgeStr.="&childrenGuest".($i+1)."FirstName=".$childsFname[$i]."&childrenGuest".($i+1)."LastName=".$childsLname[$i]."&childrenGuestAge".($i+1)."=".$childAgeArr[$i];
           
        }       
        $url="http://book.fitruums.com/1/PostGet/Booking.asmx/Book?userName=".$this->username."&password=".$this->password."&currency=".$currency."&language=".$this->language."&email=ashish@travelpd.com&checkInDate=".$this->cin."&checkOutDate=".$this->cout."&roomId=".$roomId."&rooms=".$this->rooms."&adults=".$this->adt_cnt."&children=".$this->chd_cnt."&infant=".$this->inf_cnt."&yourRef=".$this->uniqueRefNo."&specialrequest=&mealId=".$mealId.$adultNameStr.$childNameAgeStr."&customerEmail=".$customerEmail."&paymentMethodId=1&creditCardType=&creditCardNumber=&creditCardHolder=&creditCardCVV2=&creditCardExpYear=&creditCardExpMonth=&customerEmail=&invoiceRef=&CustomerCountry=".$this->nationality."&B2C=1&commissionAmountInHotelCurrency=&PreBookCode=".$preBookCode; 
        file_put_contents(FCPATH . 'dump/fitruums/hotelBookingRequest.txt', $url);

        $response=$this->curl_request($url);
        file_put_contents(FCPATH . 'dump/fitruums/hotelBookingResponse.xml', $response);
        return $response;

   }


    function getBookingInformationRQ($refNo)
    {     
      $url="http://book.fitruums.com/1/PostGet/Booking.asmx/GetBookingInformation?userName=".$this->username."&password=".$this->password."&language=".$this->language."&bookingID=&reference=".$refNo."&createdDateFrom=&createdDateTo=&arrivalDateFrom=&arrivalDateTo=";        
     
        file_put_contents(FCPATH . 'dump/fitruums/hotelBookingInformationRequest.txt', $url);

        $response=$this->curl_request($url);
        file_put_contents(FCPATH . 'dump/fitruums/hotelBookingInformationResponse.xml', $response);
        return $response;
  }



    public function deposit_check($roomDetails) {
        $deposit_check_status = 1;



        if ($this->session->userdata('agent_logged_in')) {
            $agent_no = $this->session->userdata('agent_no');
            $agent_type = $this->session->userdata('agent_type');
            $available_balance = $this->fitruums_model->get_agent_available_balance($agent_no, $agent_type);

            $total_cost = $roomDetails->total_cost;
            if ($agent_type == 1) {
                $agent_markup = $roomDetails->di_markup;
            } elseif ($agent_type == 2 && $this->session->userdata('agent_parent') != 0) {
                $agent_markup = $roomDetails->di_agent_markup;
            } elseif ($agent_type == 2 && $this->session->userdata('agent_parent') == 0) {
                $agent_markup = $roomDetails->admin_agent_markup;
            } elseif ($agent_type == 3) {
                $agent_markup = $roomDetails->sub_agent_markup;
            }
            $withdraw_amount = $total_cost - $agent_markup;
            if ($available_balance < $withdraw_amount) {
                $deposit_check_status = 1;
            } else {
                $deposit_check_status = 0;
            }
        }
        return $deposit_check_status;
    }

    function AddBookingRQ($roomDetails) {
        $pass_info = $this->session->userdata('passenger_info');
        //  echo '<pre/>';print_r($pass_info);exit;	

        $adt_cnt = 0;
        $chd_cnt = 0;
        $inf_cnt = 0;
        $total_pax = 0;
        $ad = 0;
        $cd = 0;

        $PaxNames = '';
        $PaxId = 1;
        $RmPaxId = 1;
        $rooms_data = '';
        for ($i = 0; $i < $this->rooms; $i++) {
            //$cpax = $PaxId;
            $adt_cnt += $this->adults[$i];
            $adults_num = $this->adults[$i];
            $childs_num = 0;
            $infants_num = 0;
            if ($this->childs[$i] != 0) {
                $ages = explode(',', $this->childs_ages[$i]);
                for ($a = 0; $a < count($ages); $a++) {
                    if ($ages[$a] <= 2) {
                        $inf_cnt += 1;
                        $infants_num += 1;
                    } else if ($ages[$a] > 2) {
                        $chd_cnt += 1;
                        $childs_num += 1;
                    }
                }
            }

            $total_pax += $adt_cnt + $chd_cnt + $inf_cnt;

            $room_types = $this->fitruums_model->get_room_types($adults_num, $childs_num, $infants_num);
            //echo '<pre/>';print_r($room_types);exit;

            for ($a = 0; $a < $this->adults[$i]; $a++) {
                $PaxNames .= '<PaxName PaxId = "' . $PaxId . '" PaxType = "adult">' . $pass_info['adults_title'][$ad] . ' ' . $pass_info['adults_fname'][$ad] . ' ' . $pass_info['adults_lname'][$ad] . '</PaxName>';

                $PaxId++;
                $ad++;
            }

            //child
            if ($this->childs[$i] != 0) {
                $ages = explode(',', $this->childs_ages[$i]);
                for ($c = 0; $c < $this->childs[$i]; $c++) {
                    if ($ages[$c] > 2) {
                        $PaxNames .= '<PaxName PaxId = "' . $PaxId . '" PaxType = "child" ChildAge = "' . $ages[$c] . '">' . $pass_info['childs_title'][$cd] . ' ' . $pass_info['childs_fname'][$cd] . ' ' . $pass_info['childs_lname'][$cd] . '</PaxName>';

                        $PaxId++;
                    }
                    $cd++;
                }
            }

//            $cots_info = 'NumberOfCots = "0"';
//            if ($room_types->cots != 0) {
//                $cots_info = 'NumberOfCots = "' . $room_types->cots . '"';
//            }
//
//            $extrabeds_info = '';
//            if ($room_types->extrabeds != 0) {
//                $extrabeds_info = 'ExtraBed = "true" NumberOfExtraBeds = "' . $room_types->extrabeds . '"';
//            }
//
//            $rm_code = $room_types->room_code;
            $rm_code = explode(',', $room_types->room_code);
            $quantity = explode(',', $room_types->quantity);
            $extrabeds = explode(',', $room_types->extrabeds);
            $cots = explode(',', $room_types->cots);
            for ($rm = 0; $rm < count($rm_code); $rm++) {
                $cots_info = 'NumberOfCots = "0"';
                if (isset($cots[$rm]) && $cots[$rm] != 0) {
                    $cots_info = 'NumberOfCots = "' . $cots[$rm] . '"';
                }

                $extrabeds_info = '';
                if (isset($extrabeds[$rm]) && $extrabeds[$rm] != 0) {
                    $extrabeds_info = 'ExtraBed = "true" NumberOfExtraBeds = "' . $extrabeds[$rm] . '"';
                }
                $rooms_data .= '<HotelRoom Code = "' . $rm_code[$rm] . '" Id="' . trim($roomDetails->room_code) . '" ' . $extrabeds_info . ' ' . $cots_info . '>';
                $rooms_data .= '<PaxIds>';

                for ($p = $RmPaxId; $p < $PaxId; $p++) {
                    $rooms_data .= '<PaxId>' . $p . '</PaxId>';
                }

                $rooms_data .= '</PaxIds>';
                $rooms_data .= '</HotelRoom>';
                $RmPaxId = $p;
            }
        }

        $RefCode = 'XMTT' . substr(number_format(time() * rand(), 0, '', ''), 0, 10);

        $requestData = '<?xml version="1.0" encoding="UTF-8"?>
			<Request xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="cbsapi.xsd">
				<Source>
					<RequestorID Client="' . $this->client_id . '" EMailAddress="' . $this->username . '" Password="' . $this->password . '" />
					<RequestorPreferences Language="' . $this->language . '" Currency="' . $this->base_currency . '" Country="' . $this->nationality . '">
						<RequestMode>' . $this->request_mode . '</RequestMode>
					</RequestorPreferences>
				</Source>
				<RequestDetails>
					<AddBookingRequest>
						<BookingReference>' . $RefCode . '</BookingReference>
						<PaxNames>
							' . $PaxNames . '
						</PaxNames>
					<BookingItems>
						<BookingItem ItemType="hotel">
							<ItemReference>1</ItemReference>
							<ItemCity Code="' . $roomDetails->fitruums_city_code . '" />
							<Item Code="' . $roomDetails->hotel_code . '" />
							<HotelItem>
								<PeriodOfStay>
									<CheckInDate>' . $this->cin . '</CheckInDate>
									<CheckOutDate>' . $this->cout . '</CheckOutDate>
								</PeriodOfStay>
								<HotelRooms>
									' . $rooms_data . '
								</HotelRooms>
							</HotelItem>
						</BookingItem>
					</BookingItems>
				</AddBookingRequest>
			</RequestDetails>
		</Request>';

        //   echo $requestData;
//exit;
        $responseDoc = $this->executeRequest($requestData);
        $this->db->set('confirm_book_request', " CONCAT_WS('',confirm_book_request,'" . mysql_real_escape_string(base64_encode($requestData)) . "')", FALSE);
        $this->db->set('confirm_book_response', " CONCAT_WS('',confirm_book_response,'" . mysql_real_escape_string(base64_encode($responseDoc)) . "')", FALSE);
        $this->Logger->append_by_ref('hotels_api_logs_fitruums', $this->uniqueRefNo, 'fitruums', array());
        file_put_contents(FCPATH . 'dump/fitruums/bookingrequest.xml', $requestData); //CREATING LOGS
        file_put_contents(FCPATH . 'dump/fitruums/bookingresponse.xml', $responseDoc); //CREATING LOGS

        return $responseDoc;
    }

    function cancel_voucher($unique_ref, $bookref) {
//echo $unique_ref;
//echo $bookref;
        $case = 'prepare';
        if ($this->session->userdata('agent_logged_in')) {

            $book_details = $this->fitruums_model->get_b2b_hotel_booking_details($unique_ref);
        } elseif ($this->session->userdata('user_logged_in')) {

            $book_details = $this->fitruums_model->get_b2c_hotel_booking_details($unique_ref);
            // echo '<pre>';print_r($book_details);exit;
        } else {

            $book_details = $this->fitruums_model->get_guest_hotel_booking_details($unique_ref);
            // echo '<pre>';print_r($book_details);exit;
        }
        //     echo $this->db->last_query();
        //   echo '<pre>';print_r($book_details);exit;
        // echo '<pre>';        print_r($case); exit;
        $data['api'] = $api = $book_details->api;
        $data['sys_refno'] = $sys_refno = $book_details->uniqueRefNo;
        $data['boookingno'] = $book_details->Booking_RefNo;

        $this->fitruums_hotel_cancellation($book_details, $case);
    }

    public function cancel_voucher_confirm($unique_ref) {
//echo 'wdsdd';exit;
        $case = 'confirm';

        //exit;
        if ($this->session->userdata('agent_logged_in')) {

            $book_details = $this->fitruums_model->get_b2b_hotel_booking_details($unique_ref);
        } elseif ($this->session->userdata('user_logged_in')) {

            $book_details = $this->fitruums_model->get_b2c_hotel_booking_details($unique_ref);
            // echo '<pre>';print_r($book_details);exit;
        } else {

            $book_details = $this->fitruums_model->get_guest_hotel_booking_details($unique_ref);
            // echo '<pre>';print_r($book_details);exit;
        }
        // echo '<pre>';print_r($book_details);exit;
        $data['api'] = $api = $book_details->api;
        //echo'gv';exit;
        $this->fitruums_hotel_cancellation($book_details, $case);
    }

    function fitruums_hotel_cancellation($book_details, $case) {
        $this->set_variables();
        $api = $book_details->api;
        //$authDetails = $this->B2b_Model->get_client_id($api);
        //$url = ($authDetails->mode == 0 ? $authDetails->demo_url : $authDetails->live_url);
        $data = array();

        if ($case == 'prepare') {
            $rm_id = explode(',', $book_details->room_type_code);
            $rooms = '';
            for ($i = 0; $i < count($rm_id); $i++) {
                $room_types = $this->fitruums_model->get_fitruums_room_types($rm_id[$i]);
                //            $rm_code = $room_types->room_code;
                $rm_code = explode(',', $room_types->room_code);
                $quantity = explode(',', $room_types->quantity);
                $extrabeds = explode(',', $room_types->extrabeds);
                $cots = explode(',', $room_types->cots);

                for ($rm = 0; $rm < count($rm_code); $rm++) {
                    $cots_info = 'NumberOfCots = "0"';
                    if (isset($cots[$rm]) && $cots[$rm] != 0) {
                        $cots_info = 'NumberOfCots = "' . $cots[$rm] . '"';
                    }

                    $extrabeds_info = '';
                    if (isset($extrabeds[$rm]) && $extrabeds[$rm] != 0) {
                        $extrabeds_info = 'ExtraBed = "true" NumberOfExtraBeds = "' . $extrabeds[$rm] . '"';
                    }
                    $rooms .= '<Room Code="' . $rm_code[$rm] . '" Id="' . $book_details->room_code . '"   ' . $extrabeds_info . ' ' . $cots_info . '></Room>';
                }
            }
            $cancel_create = '<?xml version="1.0" encoding="UTF-8" ?>
						<Request>
						<Source>
							<RequestorID Client="' . $this->client_id . '" EMailAddress="' . $this->username . '" Password="' . $this->password . '" />
								<RequestorPreferences Country="'.$book_details->country.'" Language="en" Currency="'.$this->base_currency.'">
									<RequestMode>SYNCHRONOUS</RequestMode>
								</RequestorPreferences>
						</Source>
						<RequestDetails>
							<SearchChargeConditionsRequest>
								<DateFormatResponse/>
								<ChargeConditionsHotel>
									<City>' . $book_details->city_code . '</City>
									<Item>' . $book_details->hotel_code . '</Item>
									<PeriodOfStay>
										<CheckInDate>' . $book_details->check_in . '</CheckInDate>
										<Duration>' . $book_details->nights . '</Duration>
									</PeriodOfStay>
									<Rooms>' . $rooms . '</Rooms>
								</ChargeConditionsHotel>
							</SearchChargeConditionsRequest>
						</RequestDetails>
						</Request>';
            $CancelRS = $this->executeRequest($cancel_create);
            $this->db->set('cancel_detrequest', " CONCAT_WS('',cancel_detrequest,'" . mysql_real_escape_string(base64_encode($cancel_create)) . "')", FALSE);
            $this->db->set('cancel_detresponse', " CONCAT_WS('',cancel_detresponse,'" . mysql_real_escape_string(base64_encode($CancelRS)) . "')", FALSE);
            $this->Logger->append_by_ref('hotels_api_logs_fitruums', $book_details->uniqueRefNo, 'fitruums', array());
            file_put_contents(FCPATH . 'dump/fitruums/cancel_req.xml', $cancel_create); //CREATING LOGS
            file_put_contents(FCPATH . 'dump/fitruums/cancel_resp.xml', $CancelRS); //CREATING LOGS
            //     print_r($cancel_resp);
            //     exit;

            $data['api'] = 'fitruums';
            $data['bookdetails'] = $book_details;
            if ($CancelRS != '') {
                $responseDoc = new DOMDocument();
                $responseDoc->loadXML($CancelRS);

                $responseElement = $responseDoc->documentElement;
                $xpath = new DOMXPath($responseDoc);

                $errorsElements = $xpath->query('ResponseDetails/SearchChargeConditionsResponse/Errors', $responseElement);
                if ($errorsElements->length > 0) {
                    $data['error'] = 'Charge details is not Available. Please try after some time';
                    $this->load->view('b2b/booking_cancel_details', $data);
                } else {
                    $ChargeCondition = $responseDoc->getElementsByTagName("ChargeCondition");
                    $k = 0;
                    foreach ($ChargeCondition as $can) {
                        $Type = $ChargeCondition->item($k)->getAttribute("Type");
                        if ($Type == 'cancellation') {
                            $l = 0;
                            $Condition = $can->getElementsByTagName("Condition");
                            $ChargeAmount1 = '';
                            $FromDate = '';
                            $ToDate = '';
                            $Currency = '';
                            $FromDate1 = 0;

                            foreach ($Condition as $cc) {
                                $Charge = $Condition->item($l)->getAttribute("Charge");
                                if ($Charge == 'true') {
                                    $ChargeAmount1.=$Condition->item($l)->getAttribute("ChargeAmount") . '|';
                                    $FromDate1 = $Condition->item($l)->getAttribute("FromDate");

                                    if ($FromDate1 == 0) {
                                        $FromDate = 'Non';
                                    } else {
                                        $FromDate.=$FromDate1;
                                        if ($Condition->item($l)->getAttribute("ToDate")) {
                                            $FromDate.='|';
                                            $ToDate.=$Condition->item($l)->getAttribute("ToDate") . '|';
                                        } else {
                                            if ($FromDate1 == $book_details->check_in) {
                                                $FromDate = 'Non';
                                            }
                                        }
                                    }

                                    $Currency.=$Condition->item($l)->getAttribute("Currency") . '|';
                                }

                                $l++;
                            }
                        }

                        $k++;
                    }
                    $amountv1 = $book_details->Booking_Amount;

                    $c_val = 1;
                    $org_amt = $book_details->Booking_Amount;

                    $amountv = $book_details->Booking_Amount;

                    $ChargeAmount = $ChargeAmount1;

                    $cancelExAmount = explode('|', $ChargeAmount);
                    $cancelCount = count($cancelExAmount) - 1;
                    $can_pal = '';
                    $cancel_till_date = '';
                    $cancel_amount = '';
                    $toExDate = explode('|', $ToDate);
                    $fromExDate = explode('|', $FromDate);
                    $refund_amount = $book_details->Booking_Amount;
                    for ($g = 0; $g < $cancelCount; $g++) {
                        if ($fromExDate[$g] == 'Non') {
                            $can_pal .= 'Non-Refundable';

                            $cancel_till_date .= '';
                            $cancel_amount .= round(($ChargeAmount1), 2) . '|';
                            $refund_amount = 0;
                        } else {
                            if ($toExDate[$g] != '') {
                                if ((strtotime($toExDate[$g]) <= strtotime('today')) && (strtotime($fromExDate[$g]) >= strtotime('today'))) {
                                    $refund_amount = $amountv1 - $cancelExAmount[$g];
                                }
                                $can_pal .= "From " . $toExDate[$g] . " To " . $fromExDate[$g] . " Charge will be  ".$Currency.' '. round($cancelExAmount[$g], 2) . '|';
                                $cancel_till_date .= date('Y-m-d', strtotime('-1 day', strtotime($toExDate[$g]))) . '|';
                            } else {
                                if (strtotime($fromExDate[$g]) <= strtotime('today')) {
                                    $refund_amount = $amountv1 - $cancelExAmount[$g];
                                }
                                $can_pal .= "From " . $fromExDate[$g] . " Charge will be   ".$Currency.' '. round($cancelExAmount[$g], 2) . '.';

                                $cancel_till_date .= '';
                            }
                            $cancel_amount .= round(($ChargeAmount), 2) . '|';
                        }
                    }

//                    $data['cancelpolicy'] = $can_pal;
                 $data['cancelpolicy']=$book_details->cancel_policy;
                    $data['refund_amount'] = $refund_amount;
                    if ($this->session->userdata('agent_logged_in')) {
                        //echo '1';exit;
                        $this->load->view('home/hotel/booking_cancel_details', $data);
                    } else {
                        //echo '2';exit;
                        $this->load->view('home/hotel/booking_cancel_details', $data);
                    }
                }
            } else {
                $data['error'] = 'Charge details is not Available. Please try after some time';
                if ($this->session->userdata('agent_logged_in')) {
                    //echo '1';exit;
                    $this->load->view('home/hotel/booking_cancel_details', $data);
                } else {
                    //echo '2';exit;
                    $this->load->view('home/hotel/booking_cancel_details', $data);
                }
            }
        } else if ($case == 'confirm') {
            $rm_id = explode(',', $book_details->room_type_code);
            $rooms = '';
            for ($i = 0; $i < count($rm_id); $i++) {
                $room_types = $this->fitruums_model->get_fitruums_room_types($rm_id[$i]);
                //            $rm_code = $room_types->room_code;
                $rm_code = explode(',', $room_types->room_code);
                $quantity = explode(',', $room_types->quantity);
                $extrabeds = explode(',', $room_types->extrabeds);
                $cots = explode(',', $room_types->cots);

                for ($rm = 0; $rm < count($rm_code); $rm++) {
                    $cots_info = 'NumberOfCots = "0"';
                    if (isset($cots[$rm]) && $cots[$rm] != 0) {
                        $cots_info = 'NumberOfCots = "' . $cots[$rm] . '"';
                    }

                    $extrabeds_info = '';
                    if (isset($extrabeds[$rm]) && $extrabeds[$rm] != 0) {
                        $extrabeds_info = 'ExtraBed = "true" NumberOfExtraBeds = "' . $extrabeds[$rm] . '"';
                    }
                    $rooms .= '<Room Code="' . $rm_code[$rm] . '" Id="' . $book_details->room_code . '"   ' . $extrabeds_info . ' ' . $cots_info . '></Room>';
                }
            }
            $cancel_create = '<?xml version="1.0" encoding="UTF-8" ?>
						<Request>
						<Source>
							<RequestorID Client="' . $this->client_id . '" EMailAddress="' . $this->username . '" Password="' . $this->password . '" />
								<RequestorPreferences Country="'.$book_details->country.'" Language="en" Currency="'.$this->base_currency.'">
									<RequestMode>SYNCHRONOUS</RequestMode>
								</RequestorPreferences>
						</Source>
						<RequestDetails>
							<SearchChargeConditionsRequest>
								<DateFormatResponse/>
								<ChargeConditionsHotel>
									<City>' . $book_details->city_code . '</City>
									<Item>' . $book_details->hotel_code . '</Item>
									<PeriodOfStay>
										<CheckInDate>' . $book_details->check_in . '</CheckInDate>
										<Duration>' . $book_details->nights . '</Duration>
									</PeriodOfStay>
									<Rooms>' . $rooms . '</Rooms>
								</ChargeConditionsHotel>
							</SearchChargeConditionsRequest>
						</RequestDetails>
						</Request>';
            $CancelRS = $this->executeRequest($cancel_create);
//            $this->db->where('AL_Refno', $book_details->uniqueRefNo);
//            $this->db->where('api', 'fitruums');
//            $this->db->where('session_id', $this->sess_id);
//            $this->db->set('cancel_request', " CONCAT_WS('---------',cancel_request,'" . mysql_real_escape_string(base64_encode($cancel_create)) . "')", FALSE);
//            $this->db->set('cancel_response', " CONCAT_WS('---------',cancel_response,'" . mysql_real_escape_string(base64_encode($CancelRS)) . "')", FALSE);
//            $this->Logger->append('hotels_api_logs', $this->sess_id, array());
            file_put_contents(FCPATH . 'dump/fitruums/cancel_req2.xml', $cancel_create); //CREATING LOGS
            file_put_contents(FCPATH . 'dump/fitruums/cancel_resp2.xml', $CancelRS); //CREATING LOGS
            //     print_r($cancel_resp);
            //     exit;

            $data['api'] = 'fitruums';
            $data['bookdetails'] = $book_details;
            if ($CancelRS != '') {
                $responseDoc = new DOMDocument();
                $responseDoc->loadXML($CancelRS);

                $responseElement = $responseDoc->documentElement;
                $xpath = new DOMXPath($responseDoc);

                $errorsElements = $xpath->query('ResponseDetails/SearchChargeConditionsResponse/Errors', $responseElement);
                if ($errorsElements->length > 0) {
                    $error = 'Charge details is not Available. Please try after some time';
                    // $this->load->view('b2b/booking_cancel_confirm', $data);
                    redirect('hotels/error_page/' . base64_encode($error));
                } else {
                    $ChargeCondition = $responseDoc->getElementsByTagName("ChargeCondition");
                    $k = 0;
                    $Currency = 'USD';
                    foreach ($ChargeCondition as $can) {
                        $Type = $ChargeCondition->item($k)->getAttribute("Type");
                        if ($Type == 'cancellation') {
                            $l = 0;
                            $Condition = $can->getElementsByTagName("Condition");
                            $ChargeAmount1 = '';
                            $FromDate = '';
                            $ToDate = '';
                            $Currency = '';
                            $FromDate1 = 0;
                            $Currency = $Condition->item(0)->getAttribute("Currency");
                            foreach ($Condition as $cc) {
                                $Charge = $Condition->item($l)->getAttribute("Charge");
                                if ($Charge == 'true') {
                                    $ChargeAmount1.=$Condition->item($l)->getAttribute("ChargeAmount") . '|';
                                    $FromDate1 = $Condition->item($l)->getAttribute("FromDate");

                                    if ($FromDate1 == 0) {
                                        $FromDate = 'Non';
                                    } else {
                                        $FromDate.=$FromDate1;
                                        if ($Condition->item($l)->getAttribute("ToDate")) {
                                            $FromDate.='|';
                                            $ToDate.=$Condition->item($l)->getAttribute("ToDate") . '|';
                                        } else {
                                            if ($FromDate1 == $book_details->check_in) {
                                                $FromDate = 'Non';
                                            }
                                        }
                                    }

                                    $Currency = $Condition->item($l)->getAttribute("Currency");
                                }

                                $l++;
                            }
                        }

                        $k++;
                    }
                    $amountv1 = $book_details->Booking_Amount;

                    $c_val = 1;
                    $org_amt = $book_details->Booking_Amount;

                    $amountv = $book_details->Booking_Amount;

                    $ChargeAmount = $ChargeAmount1;

                    $cancelExAmount = explode('|', $ChargeAmount);
                    $cancelCount = count($cancelExAmount) - 1;
                    $cancel_till_date = '';
                    $toExDate = explode('|', $ToDate);
                    $fromExDate = explode('|', $FromDate);
                    $refund_amount = $book_details->Booking_Amount;
                    $cancel_amount = 0;
                    $canceldate = date('Y-m-d', strtotime('today'));
                    for ($g = 0; $g < $cancelCount; $g++) {
                        if ($fromExDate[$g] == 'Non') {

                            $refund_amount = 0;
                            $cancel_amount = $book_details->Booking_Amount;
                        } else {
                            if ($toExDate[$g] != '') {
                                if ((strtotime($toExDate[$g]) <= strtotime('today')) && (strtotime($fromExDate[$g]) >= strtotime('today'))) {
                                    $refund_amount = $amountv1 - $cancelExAmount[$g];
                                    $cancel_amount = $cancelExAmount[$g];
                                    $canceldate = $toExDate[$g];
                                }
                            } else {
                                if (strtotime($fromExDate[$g]) <= strtotime('today')) {
                                    $refund_amount = $amountv1 - $cancelExAmount[$g];
                                    $cancel_amount = $cancelExAmount[$g];
                                    $canceldate = $fromExDate[$g];
                                }
                            }
                        }
                    }

                    $data['refund_amount'] = $refund_amount;
                    $data['cancel_amount'] = $cancel_amount;
                    $data['canceldate'] = $canceldate;
                    //if ($refund_amount > 0) {
                    $cancel_create = '<?xml version="1.0" encoding="UTF-8" ?>
									<Request>
									<Source>
										<RequestorID Client="' . $this->client_id . '" EMailAddress="' . $this->username . '" Password="' . $this->password . '" />
											<RequestorPreferences Country="'.$book_details->country.'" Language="en" Currency="'.$this->base_currency.'">
												<RequestMode>SYNCHRONOUS</RequestMode>
											</RequestorPreferences>
									</Source>
									<RequestDetails>
										<CancelBookingRequest>
											<BookingReference ReferenceSource="client">' . $book_details->Booking_RefNo . '</BookingReference>
										</CancelBookingRequest>
									</RequestDetails>
									</Request>';
                    $CancelRS = $this->executeRequest($cancel_create);
                    $this->db->set('cancel_request', " CONCAT_WS('',cancel_request,'" . mysql_real_escape_string($cancel_create) . "')", FALSE);
                    $this->db->set('cancel_response', " CONCAT_WS('',cancel_response,'" . mysql_real_escape_string($CancelRS) . "')", FALSE);
                    $this->Logger->append_by_ref('hotels_api_logs_fitruums', $book_details->uniqueRefNo, 'fitruums', array());
                    file_put_contents(FCPATH . 'dump/fitruums/cancel_req1.xml', $cancel_create); //CREATING LOGS
                    file_put_contents(FCPATH . 'dump/fitruums/cancel_resp1.xml', $CancelRS); //CREATING LOGS					
                    if ($CancelRS != '') {
                        $responseDoc = new DOMDocument();
                        $responseDoc->loadXML($CancelRS);
                        $responseElement = $responseDoc->documentElement;
                        $xpath = new DOMXPath($responseDoc);

                        $errorsElements = $xpath->query('ResponseDetails/BookingResponse/Errors', $responseElement);
                        if ($errorsElements->length > 0) {
                            $error = 'Cancellation Error. Please try after some time';
                            if ($this->session->userdata('agent_logged_in')) {
                                //  $this->load->view('b2b/booking_cancel_confirm', $data);
                                redirect('hotels/error_page/' . base64_encode($error));
                            } else if ($this->session->userdata('user_logged_in')) {
                                //$this->load->view('b2c/booking_cancel_confirm', $data);
                                redirect('hotels/error_page/' . base64_encode($error));
                            }
                        } else {
                            $ref_no = $responseDoc->getElementsByTagName("BookingReference");
                            $book_noval = $ref_no->item(0)->nodeValue;
                            $bookingstatus = $responseDoc->getElementsByTagName("BookingStatus");
                            $statusval = $bookingstatus->item(0)->nodeValue;
                            if ($statusval == 'Cancelled') {
                                if ($this->session->userdata('agent_logged_in')) {
                                    $this->fitruums_model->update_hotel_booking_cancellation($book_details->Booking_RefNo, $refund_amount, $book_noval);
                                    //$this->refund_cancelled_hotel($book_details->Booking_RefNo, $book_details->Booking_Date, 'Cancelled', $book_details->email);
//                                    if ($book_details->payment_type == 'ocbc') {
//                                        $cancel_ticket = array(
//                                            'book_ref' => $book_details->Booking_RefNo,
//                                            'booking_date' => $book_details->Booking_Date,
//                                            'status' => 'Cancelled',
//                                            'booking_email' => $email
//                                        );
//                                        $this->load->module('home/email');
//                                        $this->email->refund_cancelled_email($cancel_ticket);
//                                    } elseif ($book_details->payment_type == 'deposit') {
//                                        $agent_no = $this->session->userdata('agent_no');
//                                        $agent_available_balance = $this->fitruums_model->get_agent_balance($agent_no);
//                                        //   $refund_amount = $book_details->total_cost - $cancelamount;
//                                        $available_balance = $agent_available_balance->available_balance;
//                                        $agent_id = $agent_available_balance->agent_id;
//                                        //echo '<pre>';print_r($agent_id);exit;
//                                        $closing_balance = $available_balance + $refund_amount;
//                                        $email = $book_details->email;
//                                        $this->fitruums_model->insert_b2b_cancel_refund_amt($agent_id, $agent_no, $refund_amount, $closing_balance, $book_details->Booking_RefNo);
//                                        //$this->refund_cancelled_hotel($book_details->Booking_RefNo, $book_details->Booking_Date, 'Cancelled', $book_details->email);
//                                        $cancel_ticket = array(
//                                            'book_ref' => $book_details->Booking_RefNo,
//                                            'booking_date' => $book_details->Booking_Date,
//                                            'status' => 'Cancelled',
//                                            'booking_email' => $email
//                                        );
//                                        $this->load->module('home/email');
//                                        $this->email->refund_cancelled_email($cancel_ticket);
//                                    }
                                    $cancel_ticket = array(
                                        'cancelof'=>'Hotel Booking Cancel :: '.$book_details->uniqueRefNo,
                                        'Ref_No' => $book_details->uniqueRefNo,
                                       'status' => $statusval,
                                        'email' => $email,
                                    );
                                    $this->load->module('home/email');
                                    $this->email->refund_cancelled_email($cancel_ticket);
                                } else {
                                    $email = $book_details->email;
                                    $this->fitruums_model->update_hotel_booking_cancellation($book_details->Booking_RefNo, $refund_amount, $book_noval);
                                    $cancel_ticket = array(
                                   'cancelof'=>'Hotel Booking Cancel :: '.$book_details->uniqueRefNo,
                                        'Ref_No' => $book_details->uniqueRefNo,
                                       'status' => $statusval,
                                        'email' => $email,
                                    );
                                    $this->load->module('home/email');
                                    $this->email->refund_cancelled_email($cancel_ticket);
                                }
                            } else {
                                $data['error'] = 'Cancellation was not success. Please try after some time';
                            }
                        }
                    } else {
                        $data['error'] = 'Cancellation Failed. Please try after some time';
                    }
                    //  }
                    $data['currency'] = $Currency;
                    //if ($this->session->userdata('agent_logged_in')) {
                      //  $this->load->view('b2b/booking_cancel_confirm', $data);
                   // } else {
                        //echo '22222222222222';
                        $this->load->view('home/hotel/booking_cancel_confirm', $data);
                    //}
                }
            } else {
                $data['error'] = 'Charge details is not Available. Please try after some time';
                if ($this->session->userdata('agent_logged')) {
                    $this->load->view('b2b/booking_cancel_confirm', $data);
                } else {
//echo '33333333333333';
                    $this->load->view('home/hotel/booking_cancel_confirm', $data);
                }
            }
        }
    }

    public function executeRequest($request) {
        // Configure headers, etc for request
        $httpHeader = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
            "Accept-Encoding: gzip,deflate"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

        // Execute request, store response and HTTP response code
        $response = curl_exec($ch);
        $errno = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }

  function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'AI' . $randomString;
    }

    function deposit_withdraw($total_price, $agent_markup, $bookingRefNo) {

        $agent_id = $this->session->userdata('agent_id');
        $agent_no = $this->session->userdata('agent_no');

        $agent_type = $this->session->userdata('agent_type');
        $agent_parent = $this->session->userdata('agent_parent');


        $available_balance = $this->fitruums_model->get_agent_available_balance($agent_no, $agent_type);
        $available_balance = empty($available_balance) ? 0 : $available_balance;
        $withdraw_amount = $total_price - $agent_markup;
        if ($available_balance < $withdraw_amount) {
            $error = 'Your balance is too low for booking this hotel';
            redirect('hotels/error_page/' . base64_encode($error));
        } else {
            $closing_balance = $available_balance - $withdraw_amount;
            $this->fitruums_model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance, $bookingRefNo, $agent_type);
        }
    }


    public function nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city) {
        $nearby_hotels = $this->fitruums_model->get_nearby_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
        //echo '<pre/>';print_r($nearby_hotels);exit;       
        $showHotels = '';
        if (!empty($nearby_hotels)) {
            for ($t = 0; $t < count($nearby_hotels); $t++) {
                $review = rand(100, 500);
                $rating = rand(1, 5);
                $showHotels .='<div class="col-md-12 htl-type">';
                if (!empty($nearby_hotels[$t]->image) && isset($nearby_hotels[$t]->image)) {

                    $gttd = explode(',', $nearby_hotels[$t]->image);

                    $showHotels .='<img src="' . $gttd[0] . '" width="100" height="100" alt="' . $nearby_hotels[$t]->room_type . '" title="' . $nearby_hotels[$t]->room_type . '" border="0" />';
                } else {
                    $showHotels .='<img src="' . base_url() . 'public/img/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />';
                }

                $showHotels .='<div class="htl-type-dtls">
                <div class="row">
                  <div class="col-md-12 htlDetailsCntr">
                        <div class="htlname">' . $nearby_hotels[$t]->hotel_name . '</div>
                        
                          <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: ' . $nearby_hotels[$t]->location . ', ' . $nearby_hotels[$t]->city . ' </div>
                                    <form name="frmHotelDetails" method="post" action="' . site_url() . 'hotels/details">
                                            <input type="hidden" name="callBackId" value="' . base64_encode('fitruums') . '" />
                                            <input type="hidden" name="hotelCode" value="' . $nearby_hotels[$t]->hotel_code . '" />
                                            <input type="hidden" name="searchId" value="' . $nearby_hotels[$t]->search_id . '" />
                                            <div class="row"><button class="btn btn-primary modify-search-btn">VIEW DETAILS </button></div>
                                        </form>  
                                                        </div>                          
                          </div>
                        </div>
                      </div>';
            }
        }

        $related_hotels = $this->fitruums_model->get_related_hotels($session_id, $hotelCode, $latitude, $longitude, $city);
        //echo '<pre/>';print_r($related_hotels);exit;  
        $showRelatedHotels = '';
        if (!empty($related_hotels)) {
            for ($t = 0; $t < count($related_hotels); $t++) {
                $review = rand(100, 500);
                $rating = rand(1, 5);
                $showRelatedHotels .='<div class="col-md-12 htl-type">';
                if (!empty($related_hotels[$t]->image) && isset($related_hotels[$t]->image)) {

                    $gttd = explode(',', $related_hotels[$t]->image);

                    $showRelatedHotels .='<img src="' . $gttd[0] . '" width="100" height="100" alt="' . $related_hotels[$t]->room_type . '" title="' . $related_hotels[$t]->room_type . '" border="0" />';
                } else {
                    $showRelatedHotels .='<img src="' . base_url() . 'public/img/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />';
                }

                $showRelatedHotels .='<div class="htl-type-dtls">
                <div class="row">
                  <div class="col-md-12 htlDetailsCntr">
                        <div class="htlname">' . $related_hotels[$t]->hotel_name . '</div>
                         
                          <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: ' . $related_hotels[$t]->location . ', ' . $related_hotels[$t]->city . ' </div>
                            <form name="frmHotelDetails" method="post" action="' . site_url() . 'hotels/details">
                                            <input type="hidden" name="callBackId" value="' . base64_encode('fitruums') . '" />
                                            <input type="hidden" name="hotelCode" value="' . $related_hotels[$t]->hotel_code . '" />
                                            <input type="hidden" name="searchId" value="' . $related_hotels[$t]->search_id . '" />
                                            <div class="row"><button class="btn btn-primary modify-search-btn">VIEW DETAILS </button></div>
                                        </form> 
                                                        </div>                          
                          </div>
                        </div>
                      </div>';
            }
        }

        //return $showHotels;
        echo json_encode(array(
            'nearby_hotels' => $showHotels,
            'related_hotels' => $showRelatedHotels
        ));
    }

}
