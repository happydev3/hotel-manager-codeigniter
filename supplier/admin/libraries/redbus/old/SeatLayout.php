
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <title>SEAT LAYOUT</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <script src="js/jquery-1.8.3.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/seatlayout.css" />

        <script language="javascript" type="text/javascript">
            imgseaterArr=new Array(); 
            imgladiesseaterArr=new Array();
            imgvsleeperArr=new Array();
            imgladiesvsleeperArr=new Array();
            imghsleeperArr=new Array();
            imgladieshsleeperArr=new Array();

            for(var i=0;i<100;i++)
            {
                imgseaterArr[i]=new Array('images/ac_semi_sleeper_vacant.jpg','images/ac_sleeper_selected.jpg'); 
                imgladiesseaterArr[i]=new Array('images/non_ac_seater_ladies.jpg','images/ac_sleeper_selected.jpg'); 

                imgvsleeperArr[i]=new Array('images/volvo_sleeper_vertical_vacant.jpg','images/volvo_sleeper_vertical_selected.jpg');
                imgladiesvsleeperArr[i]=new Array('images/non_ac_vertical_sleeper_ladies.jpg','images/volvo_sleeper_vertical_selected.jpg');

                imghsleeperArr[i]=new Array('images/volvo_sleeper_vacant.jpg','images/volvo_sleeper_selected.jpg');
                imgladieshsleeperArr[i]=new Array('images/non_sleeper_ac_ladies.jpg','images/volvo_sleeper_selected.jpg');

            }

            function swapseater(chk,ind){ 
                img=document.images['img'+ind]; 
                if(chk){ 
                    img.src=imgseaterArr[ind][1]; 
                    img.alt=imgseaterArr[ind][1]; 
                } 
                else{ 
                    img.src=imgseaterArr[ind][0]; 
                    img.alt=imgseaterArr[ind][0]; 
                } 
            }

            function swapladiesseater(chk,ind){ 
                img=document.images['img'+ind]; 
                if(chk){ 
                    img.src=imgladiesseaterArr[ind][1]; 
                    img.alt=imgladiesseaterArr[ind][1]; 
                } 
                else{ 
                    img.src=imgladiesseaterArr[ind][0]; 
                    img.alt=imgladiesseaterArr[ind][0]; 
                } 
            }

            function swapvsleeper(chk,ind){ 
                img=document.images['vsleep'+ind]; 
                if(chk){ 
                    img.src=imgvsleeperArr[ind][1]; 
                    img.alt=imgvsleeperArr[ind][1]; 
                } 
                else{ 
                    img.src=imgvsleeperArr[ind][0]; 
                    img.alt=imgvsleeperArr[ind][0]; 
                } 
            }
            function swapladiesvsleeper(chk,ind){ 
                img=document.images['vsleep'+ind]; 
                if(chk){ 
                    img.src=imgladiesvsleeperArr[ind][1]; 
                    img.alt=imgladiesvsleeperArr[ind][1]; 
                } 
                else{ 
                    img.src=imgladiesvsleeperArr[ind][0]; 
                    img.alt=imgladiesvsleeperArr[ind][0]; 
                } 
            }

            function swaphsleeper(chk,ind){ 
                img=document.images['hsleep'+ind]; 
                if(chk){ 
                    img.src=imghsleeperArr[ind][1]; 
                    img.alt=imghsleeperArr[ind][1]; 
                } 
                else{ 
                    img.src=imghsleeperArr[ind][0]; 
                    img.alt=imghsleeperArr[ind][0]; 
                } 
            }


            function swapladieshsleeper(chk,ind){ 
                img=document.images['hsleep'+ind]; 
                if(chk){ 
                    img.src=imgladieshsleeperArr[ind][1]; 
                    img.alt=imgladieshsleeperArr[ind][1]; 
                } 
                else{ 
                    img.src=imgladieshsleeperArr[ind][0]; 
                    img.alt=imgladieshsleeperArr[ind][0]; 
                } 
            }
            function getXMLHTTP() { 
                var xmlhttp=false;  
                try{
                    xmlhttp=new XMLHttpRequest();
                }
                catch(e)    {       
                    try{            
                        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch(e){
                        try{
                            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                        }
                        catch(e1){
                            xmlhttp=false;
                        }
                    }
                }
            
                return xmlhttp;
            }

            function BoardingPoint(chosenboardingpoint){
                var strURL="BoardingPoint.php?boardingpointsList="+chosenboardingpoint;
                var req = getXMLHTTP();
                if(req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                    
                            if (req.status == 200) {
                                document.getElementById('selection').innerHTML=req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }               
                    }   
                    req.open("GET",strURL,true);
                    req.send(null);

                }

            }
        </script>
    </head>
    <body>

        <?php
        include_once "library/OAuthStore.php";
        include_once "library/OAuthRequester.php";
        include_once "SSAPICaller.php";


        //$key = "J5KideU1ZfCWlyIljMKIVwjtMwLiZq"; 
        //$secret = "4H7s1ExFgQLV7SqTGzN2NCoO4CyrSG";
        $base_url = "http://api.seatseller.travel/";

        echo "<form method='GET' action='generateForm.php' name='form3' onSubmit=''>";

        $image_seater_vacant = "images/ac_semi_sleeper_vacant.jpg";
        $image_seater_selected = "images/ac_sleeper_selected.jpg";
        $image_seater_unavailable = "images/ac_semi_sleeper_unavailable.jpg";
        $image_seater_ladies = "images/non_ac_seater_ladies.jpg";
        $image_sleeper_vacant = "images/volvo_sleeper_vacant.jpg";
        $image_sleeper_unavailable = "images/volvo_sleeper_unavailable.jpg";
        $image_sleeper_ladies = "images/non_sleeper_ac_ladies.jpg";
        $image_vertical_sleeper_vacant = "images/volvo_sleeper_vertical_vacant.jpg";
        $image_vertical_sleeper_unavailable = "images/volvo_sleeper_vertical_unavailable.jpg";
        $image_vertical_sleeper_ladies = "images/non_ac_vertical_sleeper_ladies.jpg";

        $image_empty_row = "images/no_seat.jpg";
        echo "<h3>SEAT LAYOUT</h3>";

        $flag = 0;  // for flaging if sleeper or seater bus
        $flag2 = 0; //  for flaging if completely vertical sleepers
        $flagseatsleep1 = 0; // for seaters in lower
        $flagseatsleep2 = 0; // for upper sleepers

        $flaglsleep = 0;  // flag if lower has sleepers
        $flaglseat = 0;  // flag if lower has seats   
        $rowvalue = 1;

        /*
          session_start();
          global $result1;
          $result1 = $_SESSION['listoftrips'];

         */
        if (isset($_GET['chosentwo'])) {

            $chosenbusid = $_GET['chosentwo'];
            //echo "The chosen bus id on second page is".$chosenbusid;
        } else {
            $chosenbusid = $_GET['chosenone'];
            // echo "The chosen bus id on main page is".$chosenbusid;
        }

        $sourceid = $_GET['sourceList'];
        $destinationid = $_GET['destinationList'];
        $date = $_GET['datepicker'];


        $result1 = getAvailableTrips($sourceid, $destinationid, $date);
        //$result1=json_decode($result);
        // echo "The source is ".$sourceid."and destination".$destinationid;
        // echo nl2br(" The chosen bus id is".$chosenbusid."\n");


        $tripdetails = getTripDetails($chosenbusid);
        // echo $tripdetails;
        // var_dump($tripdetails);

        $tripdetails2 = json_decode($tripdetails);

        $seats = $tripdetails2->seats;

        //var_dump($seats);
        /*
          foreach ($seats as $key => $value) {

          var_dump($value);
          echo "<br><br>";
          }
         */


        function my_sortrow($a, $b) {
            if (isset($a->row) && isset($b->row)) {
                if ($a->row < $b->row) {
                    return -1;
                } elseif ($a->row > $b->row) {
                    return 1;
                } else {
                    return 0;
                }
            }
        }

        foreach ($tripdetails2 as $key => $value) {
            if (is_array($value)) {

                $s = array(array());
                $sleeper = array(array(array()));
                $seatsleep = array(array(array()));

                usort($value, 'my_sortrow');

                foreach ($value as $k => $v) {

                    foreach ($v as $k1 => $v1) { //checking first for seater and sleeper bus
                        if (isset($v->zIndex) && isset($v->length) && isset($v->width)) {

                            if ($v->zIndex == 0) { // checks lower berths
                                if (($v->length == 2 && $v->width == 1 ) || ($v->length == 1 && $v->width == 2 )) { // sleepers in lower berth
                                    //  $flagseatsleep1=0;
                                    $flaglsleep = 1;
                                    $seatsleep[$v->zIndex][$v->row][$v->column] = $v;
                                } else if ($v->length == 1 && $v->width == 1) {

                                    $flagseatsleep1 = 1;
                                    $flaglseat = 1;
                                    $seatsleep[$v->zIndex][$v->row][$v->column] = $v;
                                }
                            } elseif ($v->zIndex == 1) { // only sleepers in  upper berths
                                $seatsleep[$v->zIndex][$v->row][$v->column] = $v;
                                $flagseatsleep2 = 1;
                            }
                        }
                    }
                }

                if (($flagseatsleep1 == 1) && ($flagseatsleep2 == 1)) { // if it is a seater+sleeper
//echo "THIS IS SEATER+ SLEEPER";


                    /*
                      $seatsleep[0]  // this is seats/sleepers lower level;

                      $seatsleep[1]   // these are sleepers upper level

                     */
                    $rowcountseater = count($seatsleep[0]);

                    $max = 0;
                    $mini = array(); // holds the number of seats in every row


                    for ($i = 0; $i <= $rowcountseater; $i++) {

                        if (isset($seatsleep[0][$i])) {
                            $mini[$i] = count($seatsleep[0][$i]);
                        }
                    }

                    /*
                      echo "<br><br> This is the minivalue";
                      var_dump($mini);
                      echo "<br>";
                     */  // $min will now hold the maximum number of seats in all the rows

                    $min = max($mini);

//$min=count($seatsleep[0][0]);
//echo "The value of min =".$min;




                    $posi = array();
                    $countter = 0;

                    for ($j = 0; $j <= $rowcountseater; $j++) {
                        $countter = 0;

                        $i = 0;
                        do {
                            if (!empty($seatsleep[0][$j])) {
                                if (empty($seatsleep[0][$j][$i])) {

                                    if (empty($seatsleep[0][$j][$i + 1])) {


                                        if (isset($mini[$j])) {
                                            if ($countter == $mini[$j]) {

                                                $posi[$j] = $i;

                                                break;
                                            }
                                        }
                                    }
                                } else {
                                    $countter++;
                                    $pos = $i;
                                }
                            }

                            $i++;
                        } while (($i < $min * 2));
                    }

                    $actual = max($posi);
//var_dump($posi);

                    /*
                      echo "THe sizzze is ".$actual;
                      echo "<br><br>The last position is......".$pos;

                      echo "<br>";
                      echo "KEYYY = ".$key;
                      echo "<br>";

                     */

                    for ($i = 0; $i <= $rowcountseater; $i++) {

                        if (!empty($seatsleep[0][$i])) {

//echo "the row count".count($seatsleep[0][$i]);

                            if (count($seatsleep[0][$i]) > $max) {
                                $max = count($seatsleep[0][$i]);
                            }
                            if (count($seatsleep[0][$i]) < $min) {
                                $min = count($seatsleep[0][$i]);
                            }
                        }
                    }


                    for ($i = 0; $i <= $rowcountseater; $i++) {

                        if (!empty($seatsleep[0][$i])) {
                            $flagS = 0;
                            $flagSL = 0;

                            $seatcount = count($seatsleep[0][$i]);

                            if (!empty($seatsleep[0][$i][0])) {

                                if (($seatsleep[0][$i][0]->length == 2 && $seatsleep[0][$i][0]->width == 1) || ($seatsleep[0][$i][0]->length == 1 && $seatsleep[0][$i][0]->width == 2)) {
                                    $flagSL = 1;
                                } else {
                                    $flagS = 1;
                                }


                                for ($j = 1; $j < $seatcount; $j++) {

                                    if (!empty($seatsleep[0][$i][$j])) {
                                        if ($flagS == 1 && (($seatsleep[0][$i][$j]->length == 2 && $seatsleep[0][$i][$j]->width == 1) || ($seatsleep[0][$i][$j]->length == 1 && $seatsleep[0][$i][$j]->width == 2))) {

                                            $flagSL = 1;
                                            break;
                                        } elseif ($flagSL == 1 && ($seatsleep[0][$i][$j]->length == 1 && $seatsleep[0][$i][$j]->width == 1)) {

                                            $flagS = 1;
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        if ($flagS == 1 && $flagSL == 1) {
                            break;
                        }
                    }



                    if ($flagS == 1 && $flagSL == 1) {
                        $seatperrowcount = $min * 2;
                    } else {
                        $seatperrowcount = $max;
                    }


//echo "The number of seats per count chosen is ".$seatperrowcount;
                    $rowcountsleeper = count($seatsleep[1]);
                    $sleeperperrowcount = count($seatsleep[1][0]);

//echo "These are the values".$rowcountseater."and".$seatperrowcount;
// sleepers ----- upper berth
//var_dump($seatsleep[0][0]);

                    echo "<caption><br>UPPER BERTHS</caption> ";
                    echo "<table frame='box'><tbody>";

                    $i = 1;
                    $x = 0;
                    $y = 0;

                    for ($j = 0; $j <= $rowcountsleeper; $j++) {

                        echo "<tr>";

                        for ($k = 0; $k <= $sleeperperrowcount * 2 + 1; $k++) {

                            if (!empty($seatsleep[$i][$j][$k])) {
                                if ($seatsleep[$i][$j][$k]->length == 2 && $seatsleep[$i][$j][$k]->width == 1) {

                                    if (!strcmp($seatsleep[$i][$j][$k]->available, 'true')) {
                                        if (!strcmp($seatsleep[$i][$j][$k]->ladiesSeat, 'true')) {
                                            echo "<td><div id='c_b' class='container'><label for='hsleep" . $i . $j . $k . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_ladies . "'title='Seat Number:" . $seatsleep[$i][$j][$k]->name . " | Fare: " . $seatsleep[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $i . $j . $k . "' value='" . $seatsleep[$i][$j][$k]->name . "' onclick='swapladieshsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        } else {
                                            echo "<td><div id='c_b' class='container'><label for='hsleep" . $i . $j . $k . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_vacant . "' title='Seat Number:" . $seatsleep[$i][$j][$k]->name . " | Fare: " . $seatsleep[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $i . $j . $k . "' value='" . $seatsleep[$i][$j][$k]->name . "'onclick='swaphsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        }
                                    } else {
                                        echo "<td><div class='container_un'><img src='" . $image_sleeper_unavailable . "'/></div></td>";
                                    }
                                } elseif ($seatsleep[$i][$j][$k]->length == 1 && $seatsleep[$i][$j][$k]->width == 2) {

                                    if (!strcmp($seatsleep[$i][$j][$k]->available, 'true')) {
                                        if (!strcmp($seatsleep[$i][$j][$k]->ladiesSeat, 'true')) {
                                            echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_ladies . "' title='Seat Number:" . $seatsleep[$i][$j][$k]->name . " | Fare: " . $seatsleep[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $seatsleep[$i][$j][$k]->name . "' onclick='swapvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        } else {
                                            echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_vacant . "' title='Seat Number:" . $seatsleep[$i][$j][$k]->name . " | Fare: " . $seatsleep[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $seatsleep[$i][$j][$k]->name . "'onclick='swapvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        }
                                    } else {
                                        echo "<td><div class='container_vert_un'><img src='" . $image_vertical_sleeper_unavailable . "'/></div></td>";
                                    }
                                }
                            }

                            if (empty($seatsleep[$i][$j][$k])) {

                                if (empty($seatsleep[$i][$j])) {
                                    echo "<td><img src='" . $image_empty_row . "'/></td>";
                                } elseif (!empty($seatsleep[$i][$j])) {
                                    echo "<td></td>";
                                }
                            }
                        }

                        echo "</tr>";
                    }

                    echo "</tbody></table>";


// if seats and sleepers lower berths

                    if ($flaglseat == 1 && $flaglsleep == 1) {

//echo "There are both sleepers and seaters in lower berth";
//echo "seatperrowcount value is ".$seatperrowcount;

                        echo "<br><caption>LOWER SEATS</caption> ";

                        echo "<table frame='box'><tbody>";
                        $k = 0;


                        for ($i = 0; $i <= $rowcountseater; $i++) {
                            echo "<tr>";

//$seatperrowcount=count($seatsleep[0][$i]);
//echo "The number of seats per row is".$seatperrowcount;

                            for ($j = 0; $j <= $actual; $j++) {




                                if (empty($seatsleep[0][$i][$j])) {

                                    if (empty($seatsleep[0][$i])) {
                                        echo "<td><img src='" . $image_empty_row . "'/></td>";
                                    } elseif (!empty($seatsleep[0][$i])) {
                                        echo "<td></td>";
                                    }
                                } elseif (!empty($seatsleep[0][$i][$j])) {
                                    if ($seatsleep[0][$i][$j]->length == 2 && $seatsleep[0][$i][$j]->width == 1) {
                                        if (!strcmp($seatsleep[0][$i][$j]->available, 'true')) {
                                            if (!strcmp($seatsleep[0][$i][$j]->ladiesSeat, 'true')) {
                                                echo "<td><div id='c_b' class='container'><label for='hsleep" . $k . $i . $j . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_ladies . "'title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $k . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapladieshsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                            } else {
                                                echo "<td><div id='c_b' class='container'><label for='hsleep" . $k . $i . $j . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_vacant . "' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $k . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "'onclick='swaphsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                            }
                                        } else {
                                            echo "<td><div class='container_un'><img src='" . $image_sleeper_unavailable . "'/></div></td>";
                                        }
                                    } elseif ($seatsleep[0][$i][$j]->length == 1 && $seatsleep[0][$i][$j]->width == 2) {

                                        if (!strcmp($seatsleep[0][$i][$j]->available, 'true')) {

                                            if (!strcmp($seatsleep[0][$i][$j]->ladiesSeat, 'true')) {
                                                echo "<td><div id='c_b' class='container'><label for='vsleep" . $k . $i . $j . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_ladies . "'title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='vsleep" . $k . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapladiesvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                            } else {
                                                echo "<td><div id='c_b' class='container'><label for='vsleep" . $k . $i . $j . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_vacant . "' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='vsleep" . $k . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "'onclick='swapvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                            }
                                        } else {
                                            echo "<td><div class='container_un'><img src='" . $image_vertical_sleeper_unavailable . "'/></div></td>";
                                        }
                                    } else {
                                        if (!empty($seatsleep[0][$i][$j])) {
                                            $storeseatname = $seatsleep[0][$i][$j]->name;
                                            if (!strcmp($seatsleep[0][$i][$j]->available, 'true')) {
                                                if (!strcmp($seatsleep[0][$i][$j]->ladiesSeat, 'true')) {
                                                    echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' id='" . $j . $i . "' src='" . $image_seater_ladies . "' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapladiesseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                                                } else {

                                                    echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' id='" . $j . $i . "'src='images/ac_semi_sleeper_vacant.jpg' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                                                }
                                            } else {
                                                echo "<td><div class='container_un'><img src='" . $image_seater_unavailable . "'/></div></td>";
                                            }
                                        }
                                    }
                                }
                            }
                            echo "</tr>";
                        }

                        echo "</tbody></table>";
                    }

// if only seats ---- lower berth
                    elseif ($flaglseat == 1 && $flaglsleep == 0) {

                        echo "<caption>LOWER SEATS</caption> ";
                        echo "<table frame='box'><tbody>";
                        $k = 0;
                        for ($i = 0; $i <= $rowcountseater; $i++) {
                            echo "<tr>";

                            for ($j = 0; $j <= $seatperrowcount; $j++) {

                                if (!empty($seatsleep[0][$i][$j])) {
                                    $storeseatname = $seatsleep[0][$i][$j]->name;
                                    if (!strcmp($seatsleep[0][$i][$j]->available, 'true')) {
                                        if (!strcmp($seatsleep[0][$i][$j]->ladiesSeat, 'true')) {
                                            echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' src='" . $image_seater_ladies . "' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapladiesseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                                        } else {

                                            echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' id='" . $j . $i . "'src='images/ac_semi_sleeper_vacant.jpg' title='Seat Number:" . $seatsleep[0][$i][$j]->name . " | Fare: " . $seatsleep[0][$i][$j]->fare . "' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $seatsleep[0][$i][$j]->name . "' onclick='swapseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                                        }
                                    } else {
                                        echo "<td><div class='container_un'><img src='" . $image_seater_unavailable . "'/></div></td>";
                                    }
                                }


                                if (empty($seatsleep[0][$i][$j])) {

                                    if (empty($seatsleep[0][$i])) {
                                        echo "<td><img src='" . $image_empty_row . "'/></td>";
                                    } elseif (!empty($seatsleep[0][$i])) {
                                        echo "<td></td>";
                                    }
                                }
                            }

                            echo "</tr>";
                        }
                        echo "</tbody></table><br>";
                    }
                }// end the condition of if SEATER+SLEEPER
// condition that it's not seater and sleeper

                if ((($flagseatsleep1 == 0) && ($flagseatsleep2 == 0)) || (($flagseatsleep1 == 1) && ($flagseatsleep2 == 0)) || (($flagseatsleep1 == 0) && ($flagseatsleep2 == 1))) {

                    foreach ($value as $k => $v) {


                        foreach ($v as $k1 => $v1) {

                            if (isset($v->length) && isset($v->width)) {

                                if ($v->length == 1 && $v->width == 1) { // condition for seater or semi-sleeper
                                    if (!strcmp($k1, 'row')) {
                                        $s[$v1][$v->column] = $v;
                                    }
                                } else if (($v->length == 2 && $v->width == 1) || ($v->length == 1 && $v->width == 2)) { // condition for horizontal sleeper
                                    $flag = 1;

                                    if ($v->length == 2 && $v->width == 1) {
                                        $flag2 = 1;
                                    }

                                    if (!strcmp($k1, 'row')) {
                                        if ($v1 >= $rowvalue) {
                                            $rowvalue = $v1;
                                        }


                                        $sleeper[$v->zIndex][$v1][$v->column] = $v;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

//echo count($s);
//echo " This is the row value".$rowvalue;    
//$rowvalue holds the highest row value where the berths are held
// $rowcountsleeper holds the value of the actual number of rows


        $rowcountseater = count($s);
        $seatperrowcount = count($s[0]);
//$rowcountsleeper= count($sleeper[0]);
        $c = 0;
        for ($i = 0; $i <= $rowvalue; $i++) {

            if (!empty($sleeper[0][$i])) {
                $c++;
            }
        }
        $rowcountsleeper = $c;

//echo "The number of rows ".$rowcountsleeper ;
//------> if sleeper 
        if ($flag == 1) {
            $sleeperperrowcount = count($sleeper[0][$rowvalue]);
//echo "No. of rows in sleeper".$rowcountsleeper;
//echo "No. of beds per row".$sleeperperrowcount;
            $x = 0;
            $y = 0;
            for ($i = 1; $i >= 0; $i--) {

                echo "<table frame='box'><tbody>";

                if ($i == 1) {
                    echo "<caption>UPPER BERTHS</caption> ";
                } elseif ($i == 0) {
                    echo "<caption>LOWER BERTHS</caption> ";
                }
                for ($j = 0; $j <= $rowvalue; $j++) { // Change was made here , from $rowcountsleeper to $rowvalue
                    // echo "<tr> This is row ".$j;
                    if ($flag2 == 1) {

                        for ($k = 0; $k <= $sleeperperrowcount * 2 + 1; $k++) {

                            if (!empty($sleeper[$i][$j][$k])) {
                                if ($sleeper[$i][$j][$k]->length == 2 && $sleeper[$i][$j][$k]->width == 1) {

                                    if (!strcmp($sleeper[$i][$j][$k]->available, 'true')) {
                                        if (!strcmp($sleeper[$i][$j][$k]->ladiesSeat, 'true')) {
                                            echo "<td><div id='c_b' class='container'><label for='hsleep" . $i . $j . $k . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_ladies . "'title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "' onclick='swapladieshsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        } else {
                                            echo "<td><div id='c_b' class='container'><label for='hsleep" . $i . $j . $k . "'><img name='hsleep" . $y . "'src='" . $image_sleeper_vacant . "' title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "'onclick='swaphsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        }
                                    } else {
                                        echo "<td><div class='container_un'><img src='" . $image_sleeper_unavailable . "'/></div></td>";
                                    }
                                } elseif ($sleeper[$i][$j][$k]->length == 1 && $sleeper[$i][$j][$k]->width == 2) {

                                    if (!strcmp($sleeper[$i][$j][$k]->available, 'true')) {
                                        if (!strcmp($sleeper[$i][$j][$k]->ladiesSeat, 'true')) {
                                            echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_ladies . "' title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "' onclick='swapvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        } else {
                                            echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $y . "'src='" . $image_vertical_sleeper_vacant . "' title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "'onclick='swapvsleeper(this.checked," . $y++ . ")' style='visibility:hidden'/></label></div></td>";
                                        }
                                    } else {
                                        echo "<td><div class='container_vert_un'><img src='" . $image_vertical_sleeper_unavailable . "'/></div></td>";
                                    }
                                }
                            }

                            if (empty($sleeper[$i][$j][$k])) {

                                if (empty($sleeper[$i][$j])) {
                                    echo "<td><img src='" . $image_empty_row . "'/></td>";
                                } elseif (!empty($sleeper[$i][$j])) {
                                    echo "<td></td>";
                                }
                            }
                        }
                    }
// condition if sleepers are all vertical
                    else {


                        // echo "This loop is entered-----all sleepers VERTICAL";
                        for ($k = 0; $k <= $sleeperperrowcount + 1; $k++) {


                            if (!empty($sleeper[$i][$j][$k])) {

                                if ($i == 0 && $j == 0) {
//echo "Lower berths seat";
                                }

                                if (!strcmp($sleeper[$i][$j][$k]->available, 'true')) {
                                    if (!strcmp($sleeper[$i][$j][$k]->ladiesSeat, 'true')) {
                                        echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $x . "' src='" . $image_vertical_sleeper_ladies . "' title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "'onclick='swapvsleeper(this.checked," . $x++ . ")' style='visibility:hidden'/></label></div></td>";
                                    } else {
                                        echo "<td><div id='c_b' class='container_vert'><label for='vsleep" . $i . $j . $k . "'><img name='vsleep" . $x . "' id='" . $i . $j . $k . "'src='" . $image_vertical_sleeper_vacant . "' title='Seat Number:" . $sleeper[$i][$j][$k]->name . " | Fare: " . $sleeper[$i][$j][$k]->fare . "'class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep" . $i . $j . $k . "' value='" . $sleeper[$i][$j][$k]->name . "' onclick='swapvsleeper(this.checked," . $x++ . ")' style='visibility:hidden'/></label></div></td>";
                                    }
                                } else {
                                    echo "<td><div class='container_vert_un'><img src='" . $image_vertical_sleeper_unavailable . "'/></div></td>";
                                }
                            }
                        }
                    }



                    echo "</tr>";
                }

                echo "</tbody></table>";
            }
        } else if ($flag == 0) {
//------> if seater  
            echo "<table frame='box'><tbody>";
            $k = 0;
            for ($i = 0; $i <= $rowcountseater; $i++) {
                echo "<tr>";

                for ($j = 0; $j <= $seatperrowcount; $j++) {

                    if (!empty($s[$i][$j])) {
                        $storeseatname = $s[$i][$j]->name;
                        if (!strcmp($s[$i][$j]->available, 'true')) {
                            if (!strcmp($s[$i][$j]->ladiesSeat, 'true')) {
                                echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' id='" . $j . $i . "' src='" . $image_seater_ladies . "' title='Seat Number:" . $s[$i][$j]->name . " | Fare: " . $s[$i][$j]->fare . "' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $s[$i][$j]->name . "' onclick='swapladiesseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                            } else {

                                echo "<td><div id='c_b'class='container'><label for='seat" . $i . $j . "'><img name='img" . $k . "' id='" . $j . $i . "' src='images/ac_semi_sleeper_vacant.jpg' title='Seat Number:" . $s[$i][$j]->name . " | Fare: " . $s[$i][$j]->fare . "' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat" . $i . $j . "' value='" . $s[$i][$j]->name . "' onclick='swapseater(this.checked," . $k++ . ")' style='visibility:hidden'/></label></div></td>";
                            }
                        } else {
                            echo "<td><div class='container_un'><img src='" . $image_seater_unavailable . "'/></div></td>";
                        }
                    }


                    if (empty($s[$i][$j])) {

                        if (empty($s[$i])) {
                            echo "<td><img src='" . $image_empty_row . "'/></td>";
                        } elseif (!empty($s[$i])) {
                            echo "<td></td>";
                        }
                    }
                }

                echo "</tr>";
            }
            echo "</table><br>";
        }


        echo "<div>Seats</div>";
        echo "<textarea id='t' name='seatnames' class='input'>Seats:</textarea><br><br>";

        echo "<div style='bold'> BOARDING POINTS</div>";
        $result2 = json_decode($result1);
        foreach ($result2 as $key => $values) {

            if (is_array($values)) {
                foreach ($values as $k => $v) {

                    foreach ($v as $k1 => $v1) {

                        if ($v->id == $chosenbusid) {
                            $v2 = listofboardingpoints($v->boardingTimes);
                            echo $v2;

                            break;
                        }
                    }
                }
            } else {

                foreach ($values as $k1 => $v1) {

                    if ($values->id == $chosenbusid) {
                        $v2 = listofboardingpoints($values->boardingTimes);
                        echo $v2;

                        break;
                    }
                }
            }
        }

        function listofboardingpoints($v1) {

            $listout = "<select onChange='BoardingPoint(this.value)' id='boardingpointsList' name='boardingpointsList' class='input'>";

            if (is_array($v1)) {
                foreach ($v1 as $v1) {
                    $timehold = $v1->time;
                    $timehold2 = getTime($timehold);
                    $listout = $listout . "<option value=" . $v1->bpId . "> LOCATION:" . $v1->location . " TIME: " . $timehold2 . "</option>";
                }
                $listout = $listout . "</select>";
            } else {
                $timehold = $v1->time;
                $timehold2 = getTime($timehold);
                $listout = $listout . "<option value=" . $v1->bpId . "> LOCATION:" . $v1->location . " TIME: " . $timehold2 . "</option>";
                $listout = $listout . "</select>";
            }

            return $listout;
        }

        function getTime($totMin) {

            $timestring = "";

            $oneDay = 24 * 60;
            $noOfDays = floor($totMin / $oneDay);
            $time = $totMin % $oneDay;

            $hours = floor($time / 60);
            $minutes = floor($time % 60);


            if ($minutes < 10) {
                $minutes = '0' . $minutes;
            }

            if ($hours % 12 == 0) {
                $timestring.="00";
            } else {
                $timestring.=$hours % 12;
            }
            $timestring.=":";
            $timestring.=$minutes;

            if ($hours < 12) {
                $timestring.=" AM";
            } else {
                $timestring.=" PM";
            }

            return $timestring;
        }
        ?>
        <script type="text/javascript">

            function swapImage(id,primary,secondary) {
                src=document.getElementById(id).src;
                if (src.match(primary)) {
                    document.getElementById(id).src=secondary;
                } else {
                    document.getElementById(id).src=primary;
                }
            }

            function updateTextArea() {
         
                var allVals = [];
                $('#c_b :checked').each(function() {
                    allVals.push($(this).val());
                });
                $('#t').val(allVals)
            }
            $(function() {
                $('#c_b input').click(updateTextArea);
                updateTextArea();
            });

        </script>
        <div id="selection"></div>
<?php
echo "<input type='hidden' name='chosensource' class='btnclass' value='" . $sourceid . "'/>";
echo "<input type='hidden' name='chosendestination' class='btnclass' value='" . $destinationid . "'/>";
echo "<input type='hidden' name='chosenbus' class='btnclass' value='" . $chosenbusid . "' /></td>";

echo "<input type='submit' value='Continue' class='submit'>";
?>

    </body>
</html>