<?php

include_once "redbus/library/OAuthStore.php";
include_once "redbus/library/OAuthRequester.php";

class Redbus_Api {
	private $key;
	private $secret;
	private $base_url = "http://api.seatseller.travel/";
	function set_credentials($key,$secret){
		$this->key =  $key;
		$this->secret =  $secret;
	}	
    function invokeGetRequest($requestUrl) {

        //  global $key, $secret, $base_url, $source, $destination, $doj, $tripId, $boarding;
        $url = $this->base_url . $requestUrl;
        $curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, CURLOPT_CONNECTTIMEOUT => 0);
        $options = array('consumer_key' => $this->key, 'consumer_secret' => $this->secret);
        //echo '<pre>';print_r($options);exit;
        OAuthStore::instance("2Leg", $options);
        $method = "GET";
        $params = null;
        try {
            $request = new OAuthRequester($url, $method, $params);
            $result = $request->doRequest();
            $response = $result['body'];
            return $response;
        } catch (OAuthException2 $e) {
            echo "Exception happened" . $e . "<hr></br>";
        } catch (Exception $e1) {
            echo "generic exception" . $e1 . "<hr></br>";
        }
    }

    function invokePostRequest($requestUrl, $blockRequest) {

        /* $key = "UxTyjFaUAjC1Y2WWMVpNnHG5SurSlk";
        $secret = "hfSaNcPY7qhIqgKncwjCkGj2Kcvb6R";
        $base_url = "http://api.seatseller.travel/"; */

        //  global $key, $secret, $base_url;
        $url = $this->base_url . $requestUrl;
        $curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, CURLOPT_CONNECTTIMEOUT => 0);
        $options = array('consumer_key' => $this->key, 'consumer_secret' => $this->secret);
        OAuthStore::instance("2Leg", $options);
        $method = "POST";
        $params = null;
        try {
            $request = new OAuthRequester($url, $method, $params, $blockRequest);
//echo "Timeout is: ".$curl_options[CURLOPT_TIMEOUT]."<hr></br>";
//echo "Connection timeout is: ".$curl_options[CURLOPT_CONNECTTIMEOUT ]."<hr></br>";
            $result = $request->doRequest(0, $curl_options);
            $response = $result['body']; //echo $response;
            return $response;
        } catch (OAuthException2 $e) {
            echo "Exception happened" . $e . "<hr></br>";
        } catch (Exception $e1) {
            echo "generic exception" . $e1 . "<hr></br>";
        }
    }

    function getAllSources() {
        return $this->invokeGetRequest("sources");
    }

    function getAllDestinations($sourceId) {
        return $this->invokeGetRequest("destinations?source=" . $sourceId);
    }

    function getAvailableTrips($sourceId, $destinationId, $date) {
        return $this->invokeGetRequest("availabletrips?source=" . $sourceId . "&destination=" . $destinationId . "&doj=" . $date);
    }

    function getBoardingPoint($boarding) {
        return $this->invokeGetRequest("boardingPoint?id=" . $boarding);
    }

    function getTripDetails($tripId) {
        return $this->invokeGetRequest("tripdetails?id=" . $tripId);
    }

    function blockTicket($blockRequest) {
        /* foreach($blockRequest->inventoryItems as $inventory)
          {
          echo "</hr></br>Seat Name:".$inventory->name;
          echo "</hr></br>Fare:".$inventory->fare;
          echo "</hr></br>Gender:".$inventory->ladiesSeat."</hr></br>";
          }
         */ return $this->invokePostRequest("blockTicket", $blockRequest);
    }

    function confirmTicket($blockKey) {
        return $this->invokePostRequest("bookticket?blockKey=" . $blockKey, "");
    }

    function getTicket($ticketId) {

        return $this->invokeGetRequest("ticket?tin=" . $ticketId);
    }

    function getCancellationData($cancellationId) {
        return $this->invokeGetRequest("cancellationdata?tin=" . $cancellationId);
        echo " <hr>The ticket details are:" . $cancellationId . "<hr/>";
    }

    function cancelTicket($cancelRequest) {
        return $this->invokePostRequest("cancelticket", $cancelRequest);
    }

}

?>