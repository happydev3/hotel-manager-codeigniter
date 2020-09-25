
<html>
<head>
	 <link rel="stylesheet" href="css/Homepage.css" />
</head>
<body>
<form action='serviceList.php' method='post' >
<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
	include_once "SSAPICaller.php";


	



	$storesource = $_GET['sourceList'];

	//echo nl2br(" The selected source id is ".$storesource);

	//echo nl2br("\n \n now getting destinations for ".$storesource."...\n");	

	echo "&nbsp;&nbsp;To:";

	$scr = getAllDestinations($storesource);
	$json_o=json_decode($scr);

	$destcities=$json_o->cities;

	//var_dump($destcities);

	

	function my_sort($a,$b)
		{


			if (strcasecmp($a->name , $b->name)<0)
			{ return -1;
			}
			elseif (strcasecmp($a->name, $b->name)>0){
				return 1;

			}
			else {
				return 0;
			}
		}


		usort($destcities, 'my_sort');

	$selectControlForDestination = "<select onChange='validateForm($storesource,this.value)' id='destinationList' name='destinationList' class='input'>";

	if(is_array($destcities))
	{
			foreach ($destcities as $destcities) 

			{
	$selectControlForDestination = $selectControlForDestination."<option value=". $destcities->id.">"
									. $destcities->name."</option>";

	
	}
	$selectControlForDestination = $selectControlForDestination."</select>";

	}
	$destinationList = $selectControlForDestination;

	echo $destinationList;


	if(isset($_POST['destinationList']))

	{	
		$chosendestination=$_POST['destinationList'];



		echo nl2br("The chosen destination is ".$chosendestination );

	}


?>
<br>
</br>
</form>
 </body>
 </html>