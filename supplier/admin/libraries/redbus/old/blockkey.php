<html>
<head>
</head>
<body>
	<?php

	 include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


   
    $base_url = "http://api.seatseller.travel/";
      echo "<form method='GET' action='' name='form5' onSubmit=''>";

//echo "Final Page REached";
//$json=$_GET['jsonobject'];
session_start();
$json=$_SESSION['jsonobject'] ;
$json_2=json_encode($json); 
// echo "This is the json output".json_encode($json); 
$key= blockTicket($json_2);
echo $key;
//$key2=var_dump($key);
//$con=confirmTicket($key);
//echo $con;

      ?>
	</body>
</html>