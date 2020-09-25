<html lang='en'>
    <head>
        <meta charset="utf-8" />
        <title>SSAPI PHP Demo</title>
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <script src="js/jquery-1.8.3.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/HomePage.css" />
        <style>
            p.pos_fixed
            {
                position:fixed;
                top:10px;
                left:100px;
            }
            p.input_date
            {
                position:fixed;
                top:80px;
                left:100px;
            }
            p.submit_button
            {
                position:fixed;
                top:120px;
                left:140px;
            }
            div.destination
            {
                position:fixed;
                top:60px;
                left:110px;
            }
        </style>

        <script>
            $(function() {
                $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"},{minDate: '0'});
            });
        </script>
        <script language="javascript" type="text/javascript">

            function getXMLHTTP() { 
                var xmlhttp=false;	
                try{
                    xmlhttp=new XMLHttpRequest();
                }
                catch(e)	{		
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
	

            function getDestination(chosensource){

                var strURL="destinationList.php?sourceList="+chosensource;
                var req = getXMLHTTP();

                if(req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
					
                            if (req.status == 200) {
                                document.getElementById('destdiv').innerHTML=req.responseText;
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
        echo "<form method='get' action='BusServiceList.php' name='form1' onSubmit=''  >";

        include_once "library/OAuthStore.php";
        include_once "library/OAuthRequester.php";
        include_once "SSAPICaller.php";


        echo "";

        $sourceList = getSourcesAsDropDownList();
        echo "<p class='pos_fixed'>From:" . $sourceList . "</p>";
        ?>

        <table >
            <tr>
                <td></td>
                <td><div id="destdiv" class='destination'>
                    </div></td>
            </tr>

            <tr>
                <td></td>
                <td><div id="servdiv">
                    </div></td>
            </tr>	

            <tr>	
                <td></td>
                <td><div id="listdiv">
                    </div></td>
            </tr>

        </table>




<?php

function getSourcesAsDropDownList() {
    global $scr, $sourceId, $sourcename;

    $scr = getAllSources();
    $json_o = json_decode($scr);

    $cities = $json_o->cities;

    function my_sort($a, $b) {


        if (strcasecmp($a->name, $b->name) < 0) {
            return 1;
        } elseif (strcasecmp($a->name, $b->name) > 0) {
            return -1;
        } else {
            return 0;
        }
    }

    usort($cities, 'my_sort');

    $selectControlForSources = "<select onChange='getDestination(this.value)' id='sourceList' name='sourceList' class='input'> ";

    if (is_array($cities)) {
        foreach ($cities as $cities) {
            $selectControlForSources = $selectControlForSources . "<option value=" . $cities->id . " selected='selected'>"
                    . $cities->name . "</option>";
        }
        $selectControlForSources = $selectControlForSources . "</select>";
    }
    return $selectControlForSources;
}
?>

        <p class='input_date'>Date: <input type="text" id="datepicker" name="datepicker"  class="input" value="YYYY-MM-DD" /></p>
        <p class='submit_button'><input type="submit" value="Search Buses" class="submit"/></p>
    </form>
</body>
</html>
