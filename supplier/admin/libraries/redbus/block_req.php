<html>
<head>
</head>
<body>
	<?php

	 include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


   
	    echo "<form method='GET' action='blockkey.php' name='form4' onSubmit=''>";
$json=array();
$user_name=array();
$user_gender=array();
$user_age=array();
$user_primary=array();
$user_title=array();
 $inventoryItems= array(array());
 $passenger = array(array());

$chosenbusid=$_GET['chosenbus'];
$sourceid=$_GET['chosensource'];
$destinationid=$_GET['chosendestination'];
$boardingpointid=$_GET['boardingpointsList'];
$checkbox_no=$_GET['chkchk'];

for ($i=0; $i <$checkbox_no ; $i++) { 

$user_name[$i]=$_GET['fname'.$i.''];
$user_gender[$i]=$_GET['sex'.$i.''];
$user_age[$i]=$_GET['age'.$i.''];
$user_title[$i]=$_GET['Title'.$i.''];
}

$user_mobile=$_GET['mobile'];
$user_email=$_GET['email_id'];
$user_address=$_GET['address'];
$user_id_no=$_GET['id_no'];
$user_idproof_type=$_GET['id_proof'];


for ($i=0; $i <$checkbox_no ; $i++) { 
  if ($i==0) {
    $user_primary[$i]='true';
 }
  else
    { $user_primary[$i]='false';
     
}
  }




$tripdetails = getTripDetails($chosenbusid);
 $tripdetails2 = json_decode($tripdetails);

$seatschosen=$_GET['seatnames'];

$seats=explode(",", $seatschosen);

for ($i=0; $i <$checkbox_no ; $i++) { 
	
foreach ($tripdetails2 as $key => $value) {
  	 if(is_array($value))
  	 {
  	 	foreach ($value as $k => $v) { 
               
                foreach ($v as $k1 => $v1) {
  	 	if(isset($v->name))
      {

  	 	if(!strcmp($v->name, $seats[$i]))
  	 	{
        $passenger[$i]['age']=$user_age[$i];
        $passenger[$i]['gender']=$user_gender[$i];
        $passenger[$i]['name']=$user_name[$i];
        $passenger[$i]['primary']=$user_primary[$i];
        $passenger[$i]['title']=$user_title[$i];

        if ($i==0) {
          $passenger[$i]['address']=$user_address;
              $passenger[$i]['email']=$user_email;
              $passenger[$i]['idNumber']=$user_id_no;
              $passenger[$i]['idType']=$user_idproof_type;
               $passenger[$i]['mobile']=$user_mobile;
        }
  	 		$inventoryItems[$i]['fare']=$v->fare;
  	 		$inventoryItems[$i]['ladiesSeat']=$v->ladiesSeat;
  	 		$inventoryItems[$i]['passenger']=$passenger[$i];
  	 		$inventoryItems[$i]['seatName']=$v->name;
        

  	 	}

  	 }
    }
  	}
  }


}
	
}

  
 	 $json['availableTripId']=$chosenbusid;
     $json['boardingPointId']=$boardingpointid;
     $json['destination']=$destinationid;
     $json['inventoryItems']=$inventoryItems;
     $json['source']=$sourceid;
     
 echo "This is the json output".json_encode($json); 
	
  session_start();
$_SESSION['jsonobject']= $json;

  echo "<input type='submit'value='Submit'";


  
	?>
	</body>
</html>
