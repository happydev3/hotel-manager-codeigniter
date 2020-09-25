<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 *
 * @download from  http://www.joelsays.com/downloads/jquery-pagination.zip
 */
class roomsxml_api{


	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	function CI_Pagination($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);		
		}
		
		log_message('debug', "Pagination Class Initialized");
	}
	
	 public function set_credentials() {
        $authDetails = $this->Roomsxml_Model->getApiAuthDetails($this->api);
		
        if ($authDetails != '') {
            $this->api_flag = true;
            $this->post_url = ($authDetails->mode == 0 ? $authDetails->demo_url : $authDetails->live_url);
            $this->client_id = $authDetails->client_id;
            $this->username = $authDetails->username;
            $this->password = $authDetails->password;
            $this->version = "1.25";
        } else {
            $this->api_flag = false;
        }
    }

    public function set_variables() {
        $session_data = $this->session->userdata('hotel_search_data');

        $this->city_name = $session_data['cityName'];
        //$this->city_code = $session_data['cityCode'];
        $this->cin = $session_data['checkIn'];
        $this->cout = $session_data['checkOut'];
        $this->uniqueRefNo = $session_data['uniqueRefNo'];
        $this->rooms = $session_data['rooms'];
        $this->nights = $session_data['nights'];

        //city_id
        $this->city_id = $session_data['cityCode'];
        //city_id ends here

        $this->adults = $session_data['adults'];
        $this->childs = $session_data['childs'];
        $this->childs_ages = $session_data['childs_ages'];
        $this->adults_count = $session_data['adults_count'];
        $this->childs_count = $session_data['childs_count'];

        $this->nationality = 'IN';
        $this->base_currency = 'USD';

        $code = $this->Roomsxml_Model->get_city_code($session_data['cityCode']);
        if ($code == '') {
            $this->city_code = '';
        } else {
            $this->city_code = $code;
        }
    }

	
	function cancel_booking($booking_ref, $uniqueRefNo, $case,$book_details){
	
	 
$this->set_variables();
echo $this->city_name;exit;
        $cancel_RS = $this->cancel_RQ($booking_ref, $case);
        $dom2 = new DOMDocument();
        $dom2->loadXML($cancel_RS);
        if (!$dom2->getElementsByTagName('Error')->length) {
            $Currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
            $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

            $Booking = $dom2->getElementsByTagName('Booking');
            $amnt = array();
            foreach ($Booking as $val) {
                $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
                $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $HotelBooking = $val->getElementsByTagName('HotelBooking');
                $Id = '';
                foreach ($HotelBooking as $val1) {

                    $Id.= $val1->getElementsByTagName('Id')->item(0)->nodeValue . ',';
                    $canceldata['HotelId'] = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
//                $canceldata['HotelName'] = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                    $canceldata['CreationDate'] = $val1->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                    $canceldata['ArrivalDate'] = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                    $canceldata['Nights'] = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;
                    $canceldata['TotalSellingPrice'] = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->nodeValue;
                    $canceldata['Status'] = $val1->getElementsByTagName('Status')->item(0)->nodeValue;

                    $Room = $val1->getElementsByTagName('Room');
                    foreach ($Room as $val2) {
                        $CanxFees = $val2->getElementsByTagName('CanxFees');
                        foreach ($CanxFees as $val3) {

                            $Fee = $val3->getElementsByTagName('Fee');
                            foreach ($Fee as $val4) {
                                $fromdate = $val4->getAttribute('from');
                                if (isset($amnt[$fromdate])) {
                                    $amnt[$fromdate]+= $val4->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                                } else {
                                    $amnt[$fromdate] = $val4->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                                }
                            }
                        }
                    }
                }
            }
            $cancelpolicy = '';
            foreach ($amnt as $key => $value) {
                $cancelpolicy.='The Cancellation done after ' . $key . ', the charge would be ' . $value . '<br>';

                if (strtotime(date("Y-m-d")) < strtotime($key)) {
                    $cancelamount = $value;
                    $canceldate = $key;
                }
                break;
            }

            $data['cancelcompute'] = $amnt;
            $data['canceldate'] = $canceldate;
            $data['cancelcharge'] = $cancelamount;
            $data['cancelpolicy'] = $cancelpolicy;
            $data['api'] = 'roomsxml';
            $data['currency'] = $Currency;
            $data['bookdetails'] = $book_details;
            $data['booking_status'] = $canceldata['Status'];

            if ($case == 'prepare') {

                $this->load->view('home/hotel/booking_cancel_details', $data);
            } else if ($case == 'confirm') {
                $this->Roomsxml_Model->update_booking_status($booking_ref, $uniqueRefNo);
                $this->load->view('home/hotel/booking_cancel_confirm', $data);

            }
        } else {
            $data['api'] = 'roomsxml';
            $data['error'] = $dom2->getElementsByTagName('Description')->item(0)->nodeValue;

            $this->load->view('home/hotel/booking_cancel_confirm', $data);
        }
	
	
	
	}
	
	    public function cancel_RQ($booking_ref, $case) {
        $this->set_variables();
        $cancel_create = '
<BookingCancel>
    <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
        <Org>' . $this->client_id . '</Org>
        <User>' . $this->username . '</User> 
        <Password>' . $this->password . '</Password> 
        <Currency>' . $this->base_currency . '</Currency> 
        <Version>' . $this->version . '</Version>
    </Authority>
    <BookingId>' . $booking_ref . '</BookingId>
    <CommitLevel>' . $case . '</CommitLevel>
</BookingCancel>
';
//        echo '<pre>';
        //     echo $cancel_create; //exit;
        $cancel_resp = $this->executeRequest($cancel_create);
        file_put_contents(FCPATH . 'dump/roomsxml/cancel_req.xml', $cancel_create); //CREATING LOGS
        file_put_contents(FCPATH . 'dump/roomsxml/cancel_resp.xml', $cancel_resp); //CREATING LOGS
        //   echo '<pre>';print_r($cancel_resp);exit;
        return $cancel_resp;
    }

	 public function executeRequest($request) {
        $httpHeader = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
            "Accept-Encoding: gzip,deflate"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Adding HttpHeader
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

        $response = curl_exec($ch);
        $errors = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }

}
// END Pagination Class
?>