<html>
<head>
    <title>BUS SERVICE LIST</title>
    <link rel="stylesheet" href="docsupport/style.css">
  <link rel="stylesheet" href="docsupport/prism.css">
  <link rel="stylesheet" href="chosen.css">
   <link rel="stylesheet" href="css/popup.css" />
   <style type="text/css">
   div.T_button
   {
 position:absolute;
top:55px;
left:750px;
   }
   

   </style>
        <link href="css/BusServiceList.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript">
  function showText(show)
{
    document.getElementById(show).className = "show";
}

function hideText(hide)
{
      document.getElementById(hide).className = "hide";

}
</script>
<script type="text/javascript">
function submitForm(action)
{
      document.getElementById('form2').action = action;
      document.getElementById('form2').submit();
}

</script>
  </head>
  <body>
<form name='form2' id='form2' method='get' action='SeatLayout.php'>
    <?php
       // echo "<form method='GET' action='SeatLayout.php' name='form2' onSubmit=''  >";

include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


   // $key = "J5KideU1ZfCWlyIljMKIVwjtMwLiZq"; 
   // $secret = "4H7s1ExFgQLV7SqTGzN2NCoO4CyrSG";
   // $base_url = "http://api.seatseller.travel/";

$sourceid=$_GET['sourceList'];
$destid=$_GET['destinationList'];
$date=$_GET['datepicker'];

if (isset($_GET['Travel']))

{
//var_dump($_GET['Travel']);
$num_chosenTravels =count($_GET['Travel']);
//echo count($_GET['Travel']);
}

session_start(); 
//$_SESSION['sourceid']=$sourceid;

 global $result;
 $result =getAvailableTrips($sourceid,$destid,$date); 
$_SESSION['listoftrips'] = $result;

$result2=json_decode($result);

$columns= array();
$columns[0]='Service Number';
$i=1;
$j=0;
$l=0;
$ArrTime=array();
$AvailSeats=array();
$bType=array();
$departTime=array();
$Fare=array();
$rowbusid=array();
$busID=array();
$travelsList = array();
$TRAVELS = array();
$columnName=array();
$flagTravels= array();

if (isset($_GET['Travel']))

{
//var_dump($_GET['Travel']);
$num_chosenTravels =count($_GET['Travel']);
//echo count($_GET['Travel']);

for ($p=0; $p < $num_chosenTravels ; $p++) { 
  $flagTravels[$p]=0;

}
}


foreach ($result2 as $key => $values) {

    if(is_array($values))
    {   
        foreach ($values as $k => $v) {
 
            foreach ($v as $k1 => $v1) 
            {
           if(!strcmp($k1,'travels'))
           {
                $travelsList[$j++]=$v1;
           }
           if(!strcmp($k1, 'id'))
           {
           // $BusID[$l++]=$v1;
           }
            }

}
}
}

$travelsListnew=array_unique($travelsList);

echo "<div id='container'>";
echo "<div id='content'";
echo "<div class='side-by-side clearfix' > <div>";

$dropdownTravels = "<select data-placeholder='Choose a travels' multiple='multiple' class='chosen-select' style='width:400px;' id='Travel[]' name='Travel[]'>";
for ($t=0; $t <$j ; $t++) { 

   if(!empty($travelsListnew[$t]))

{
 //echo "<br>".$travelsListnew[$t];
 $p=0;
if (isset($_GET['Travel']))
{
 
foreach($_GET['Travel'] as $chosen)
  {  

 if( strpos($travelsListnew[$t], $chosen ) !== false)
{
  $flagTravels[$p++]=1;
 // echo "The travels".$chosen."is found";
  // $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t]." selected >" .$travelsListnew[$t]."</option>";

}
else
 {//$dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t].">" .$travelsListnew[$t]."</option>";
  $flagTravels[$p++]=0;

}
}
//var_dump($flagTravels);
$flagTT=0;
for ($q=0; $q <$p ; $q++) { 
  if($flagTravels[$q]==1)
{
$flagTT=1;
// $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t]." selected >" .$travelsListnew[$t]."</option>";
break;
}
}

if($flagTT==1)
{
  $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t]." selected >" .$travelsListnew[$t]."</option>";
 
}
else
{
    $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t].">" .$travelsListnew[$t]."</option>";

}
/*
elseif ($flagTravels[$q]==0 && $q=$p-1) {
  $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t].">" .$travelsListnew[$t]."</option>";
}
*/




}
else
 $dropdownTravels =$dropdownTravels."<option value=".$travelsListnew[$t].">" .$travelsListnew[$t]."</option>";




}
}
$dropdownTravels=$dropdownTravels."</select>";
echo "<h4 style='font-family:verdana;color:#914FCB;' >Travels</h4>";
echo $dropdownTravels;
echo "</div></div>";
//echo "<input type='submit' value='Travels'>";
?>
<div class='T_button'><input type='button' onclick="submitForm('BusServiceList.php')" value='Filter by Travels'></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</div>
</div>
<style type="text/css">
table, td, th
{
border:1px solid green;
}
th
{
background-color:green;
color:white;
}
</style>
<table frame='box' border="20" cellpadding="10" align="center" width="100%">
<?php
//echo "<form method='GET' action='sampleoutput.php' name='form2' onSubmit=''  >";
if (isset($_GET['Travel'])) {
  
//var_dump($_GET['Travel']);

  foreach($_GET['Travel'] as $chosen)
  { 

    echo "<tbody>";
  foreach ($result2 as $key => $values) {
$i=0;

    if(is_array($values))
    {   
        foreach ($values as $k => $v) {
 $j=0;
            foreach ($v as $k1 => $v1) 
            {
           if(!strcmp($k1,'arrivalTime')||!strcmp($k1,'availableSeats')||!strcmp($k1,'busType')||!strcmp($k1,'departureTime')||!strcmp($k1,'fares')||!strcmp($k1,'id')||!strcmp($k1, 'travels'))
           { 
          if (!strcmp($k1,'arrivalTime')) {
           $hold1=getTime($v1);
           $ArrTime[$i]=$hold1;
           
           $columnName[0]=$k1;
          }
          if(!strcmp($k1,'availableSeats')){
            $AvailSeats[$i]=$v1;
           $columnName[1]=$k1;

          }
          if(!strcmp($k1,'busType')){
            $bType[$i]=$v1;
           $columnName[2]=$k1;

          }

          if(!strcmp($k1,'departureTime')){
             
             $hold2=getTime($v1); 
              $departTime[$i]=$hold2;
                         $columnName[3]=$k1;

          }

          if(!strcmp($k1,'fares')){
            if(is_array($v1))
                {
                   $num=count($v1);
                    $fares='';
                for ($l=0; $l <$num ; $l++) { 
                    $fares=$fares." <br>".$v1[$l];
                                  }
                $Fare[$i]=$fares;}
                else
                {
                  $Fare[$i]=$v1;
                }
           $columnName[4]=$k1;

          }
          if(!strcmp($k1,'id')){
             $busID[$i]=$v1;

             

          }

          if (!strcmp($k1,'travels')) {
           $TRAVELS[$i]=$v1;
                      $columnName[5]=$k1;

          }


            if(!strcmp($k1,'travels'))
           { 

            if( strpos($v1, $chosen ) !== false)
            {
            echo "<tr>";
           echo "<td style='text-align:center;font-weight:bold'>".$ArrTime[$i]."</td>";
           echo "<td style='text-align:center;color:#F40F0F;font-weight:bold'>".$AvailSeats[$i]."</td>";
           echo "<td style='text-align:center;font-weight:bold'>".$bType[$i]."</td>";
           echo "<td style='text-align:center;font-weight:bold'>".$departTime[$i]."</td>";
           echo"<td style='text-align:center;color:#1A9F13;font-weight:bold'>Rs.".$Fare[$i]."</td>";
           echo"<td style='text-align:center;color:#28139F;font-weight:bold'>".$TRAVELS[$i]."</td>"; 

          echo "<td style='text-align:center'><button type='submit' name='chosentwo' class='btnclass' value='".$busID[$i]."'/><img src='images/view_seats2.jpg' class='imagehover'/></button></td>";
                   // echo "<td style='text-align:center'><button type='submit' name='chosentwo' class='btnclass' value='".$valu."'/><img src='images/view_seats2.jpg' class='imagehover'/></button></td>";
            echo"<td width='20%' style='text-align:center'><a onclick=\"showText('".$i."')\" href=\"javascript:void(0)\">More Information</a>";
          echo"<div id='".$i."' class='hide'>AC: ".$v->AC."<br>";
          echo"id Proof Required: ".$v->idProofRequired. "<br>";
          echo"mTicket enabled: ".$v->mTicketEnabled."<br><br>";
           echo"<br>";

echo"<a class='hide' onclick=\"hideText('".$i."')\" href=\"javascript:void(0)\">Close</a><br></div></td>";

                       echo "</tr>";
            
            }
          }
         


            }

}
$i++;
}
}



}


}

echo "<thead><tr>";

    echo "<th>arrivalTime</th>";
    echo "<th>availableSeats</th>";
    echo "<th>busType</th>";
    echo "<th>departureTime</th>";
    echo "<th>fares</th>";
    echo "<th>travels</th>";
    echo "<th>Seat Layout</th>";
    echo "<th>More Information</th>";

echo "</tr></thead>";

 echo "<input type='hidden' name='sourceList' class='btnclass' value='".$sourceid."'/>";
             echo "<input type='hidden' name='destinationList' class='btnclass' value='".$destid."'/>";  
             echo "<input type='hidden' name='datepicker' class='btnclass' value='".$date."'/>"; 

}

else {

?>
</div>
</table>
    <div class="CSSTableGenerator">
      <table border="2" cellpadding="10" align="center" width="100%">
<?php
echo "<tbody>";

foreach ($result2 as $key => $values) {

    if(is_array($values))
    {   $countrows=0;
        foreach ($values as $k => $v) {
           
            echo "<tr>";
            $countrows++;
            echo "<td style='text-align:center'>".$countrows."</td>";
           $countkeys=0;
            foreach ($v as $k1 => $v1) 
            {


                if(!strcmp($k1,'arrivalTime')||!strcmp($k1,'availableSeats')||!strcmp($k1,'busType')||!strcmp($k1,'departureTime')||!strcmp($k1, 'travels'))
                {
                     $countkeys++;

                     if (!strcmp($k1,'departureTime')) {
                   $timtim = getTime($v1);
                    echo "<td style='text-align:center'>".$timtim."</td>";

                     }
                     elseif (!strcmp($k1,'arrivalTime')) {
                    $timtim2 = getTime($v1);
              echo "<td style='text-align:center'>".$timtim2."</td>";

                     }

                     elseif(!strcmp($k1,'travels'))

                     {
                        echo "<td style='text-align:center;color:#28139F;font-weight:bold'>".$v1."</td>";
                     }
                     elseif (!strcmp($k1,'availableSeats')) {
                      echo "<td style='text-align:center;color:#F40F0F;font-weight:bold'>".$v1."</td>";
                     }
                     else
                   { echo "<td style='text-align:center'>".$v1."</td>";}
            
                     $columns[$i++]=$k1;

                }

                elseif(!strcmp($k1,'fares'))
            {
                $countkeys++;
                  $columns[$i++]=$k1;
               
               if( is_array($v1))
            {
                $num=count($v1);
                    $fares='';
                for ($l=0; $l <$num ; $l++) { 
                    $fares=$fares." <br>".$v1[$l];
                }
                echo "<td style='text-align:center; color:#1A9F13; font-size:18px;' class='fares'>".$fares."</td>";
            }
            else
            {
                echo "<td style='text-align:center;color:#1A9F13; font-size:18px;'>Rs.".$v1."</td>";
            }
            
            }
            if(!strcmp($k1,'id'))
            {    $rowbusid[$countrows]=$v1;
                $storebusid=$v1;
            }



}   
            echo "<input type='hidden' name='sourceList' class='btnclass' value='".$sourceid."'/>";
             echo "<input type='hidden' name='destinationList' class='btnclass' value='".$destid."'/>";  
             echo "<input type='hidden' name='datepicker' class='btnclass' value='".$date."'/>";  

            echo "<td style='text-align:center'><button type='submit' name='chosenone' class='btnclass' value='".$storebusid."'/><img src='images/view_seats2.jpg' class='imagehover'/></button></td>";

  echo"<td width='20%'><a onclick=\"showText('".$countrows."')\" href=\"javascript:void(0)\">More Information</a>";
echo"<div id='".$countrows."' class='hide'>AC: ".$v->AC."<br>";
echo"id Proof Required: ".$v->idProofRequired. "<br>";
echo"mTicket enabled: ".$v->mTicketEnabled."<br><br>";


/*

foreach ($v as $k1 => $v1) 
{
  if(!strcmp($k1,'boardingTimes'))
  {
    $v2=listofboardingpoints($v1);
    
    echo "BOARDING TIMES: ".$v2."<br>";
  }
  /*if(!strcmp($k1,'droppingTimes'))
  {
    $v2=listofboardingpoints($v1);
    echo "DROPPING TIMES: ".$v2;
  }*/
//}
 echo"<br>";

echo"<a class='hide' onclick=\"hideText('".$countrows."')\" href=\"javascript:void(0)\">Close</a><br></div></td>";



    echo "</tr>";

}
}
else
{
  //echo "ITs not an array";

 // echo "The value is ". isset($values);

  if(!isset($values))
  {

    echo"No services for this particular route";
  }

  else // if only one service for the particular route
  {


  
$countkeys=0;
$countrows=1;
echo "<td style='text-align:center'>".$countrows."</td>";
foreach ($values as $k1 => $v1)
{


if(!strcmp($k1,'arrivalTime')||!strcmp($k1,'availableSeats')||!strcmp($k1,'busType')||!strcmp($k1,'departureTime')||!strcmp($k1,'id')||!strcmp($k1, 'travels'))

{

 $countkeys++;

                     if (!strcmp($k1,'departureTime')) {
                   $timtim = getTime($v1);
                    echo "<td style='text-align:center'>".$timtim."</td>";

                     }
                     elseif (!strcmp($k1,'arrivalTime')) {
                    $timtim2 = getTime($v1);
              echo "<td style='text-align:center'>".$timtim2."</td>";

                     }

                     elseif(!strcmp($k1,'travels'))

                     {
                        echo "<td style='text-align:center;color:#28139F;font-weight:bold'>".$v1."</td>";
                     }
                     elseif (!strcmp($k1,'availableSeats')) {
                      echo "<td style='text-align:center;color:#F40F0F;font-weight:bold'>".$v1."</td>";
                     }
                     else
                   { echo "<td style='text-align:center'>".$v1."</td>";}
            
                     $columns[$i++]=$k1;



}


  elseif(!strcmp($k1,'fares'))
            {
                $countkeys++;
                  $columns[$i++]=$k1;
               
               if( is_array($v1))
            {
                $num=count($v1);
                    $fares='';
                for ($l=0; $l <$num ; $l++) { 
                    $fares=$fares." <br>".$v1[$l];
                }
                echo "<td style='text-align:center; color:#1A9F13; font-size:18px;' class='fares'>".$fares."</td>";
            }
            else
            {
                echo "<td style='text-align:center;color:#1A9F13; font-size:18px;'>Rs.".$v1."</td>";
            }
            
            }
            if(!strcmp($k1,'id'))
            {    $rowbusid[$countrows]=$v1;
                $storebusid=$v1;
            }




}

 echo "<input type='hidden' name='sourceList' class='btnclass' value='".$sourceid."'/>";
             echo "<input type='hidden' name='destinationList' class='btnclass' value='".$destid."'/>";  
             echo "<input type='hidden' name='datepicker' class='btnclass' value='".$date."'/>";  

 echo "<td style='text-align:center'><button type='submit' name='chosenone' class='btnclass' value='".$storebusid."'/><img src='images/view_seats2.jpg' class='imagehover'/></button></td>";

  echo"<td width='20%'><a onclick=\"showText('".$countrows."')\" href=\"javascript:void(0)\">More Information</a>";


}


}







}

echo "</tbody>";

$columns[$countkeys+1]='SEAT LAYOUT';

echo "<thead><tr>";

for ($i=0; $i <=$countkeys+1 ; $i++) { 
    echo "<th>$columns[$i]</th>";
}

echo "</tr></thead>";

}
?>

</table>
</div>
<?php
function getTime($totMin){

  $timestring="";

   $oneDay=24*60;
   $noOfDays = floor($totMin / $oneDay);
   $time = $totMin % $oneDay;

   $hours = floor($time/60);
   $minutes = floor($time%60);


   if($minutes<10)
   {
    $minutes='0'.$minutes;
   }

if($hours%12==0)
{
  $timestring.="00";
}
else
 { $timestring.=$hours%12;}
  $timestring.=":";
  $timestring.=$minutes;

  if($hours<12)
  {
    $timestring.=" AM";
  }
  else{
    $timestring.=" PM";
  }

  return $timestring;
}



function listofboardingpoints($v1)
{
    
    $listout="<select id='boardingpointsList' name='boardingpointsList'>";

        if(is_array($v1))

                {foreach ($v1 as $v1)  {
         $listout =$listout."<option value=".$v1->bpId."selected='selected'> LOCATION:".$v1->location." TIME:".$v1->time."</option>";  
      }
      $listout=$listout."</select>";
}
else
{
         $listout =$listout."<option value=".$v1->bpId."selected='selected'> LOCATION:".$v1->location." TIME:".$v1->time."</option>";  
               $listout=$listout."</select>";

}

return $listout;
}

function listofdroppingpoints($v1)
{
    
    $listout="<select id='droppingpointsList' name='droppingpointsList'>";

        if(is_array($v1))

                {
                    foreach ($v1 as $v1)  {
         $listout =$listout."<option value=".$v1->bpId."selected='selected'>LOCATION:".$v1->location." TIME:".$v1->time."</option>";  
      }
      $listout=$listout."</select>";
}

else
{
         $listout =$listout."<option value=".$v1->bpId."selected='selected'> LOCATION:".$v1->location." TIME:".$v1->time."</option>";  
               $listout=$listout."</select>";

}

return $listout;
}

$_SESSION['busrowid']= $rowbusid;

?>
</body>
</html>