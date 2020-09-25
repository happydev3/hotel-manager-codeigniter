<html>
<head>

    <link rel="stylesheet" href="css/generateForm.css" />

</head>
<body>

<?php
    include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";
     
echo "<form method='GET' action='block_req.php' name='form4' onSubmit=''>";
echo "<h3>CUSTOMER INFORMATION</h3>";    
    $chosenbusid=$_GET['chosenbus'];
$sourceid=$_GET['chosensource'];
$destinationid=$_GET['chosendestination'];
$boardingpointid=$_GET['boardingpointsList'];
$checkbox_no=sizeof($_GET['chkchk']);
$boardingpointid=$_GET['boardingpointsList'];
$seatschosen=$_GET['seatnames'];



for ($i=0; $i <$checkbox_no ; $i++) { 
	echo "Title:<select name='Title".$i."' class='input2' >
                    <option value='-1'>-- select --</option>
                    <option value='Mr'>Mr.</option>
                    <option value='Mrs'>Mrs.</option>
                    <option value='Ms'>Ms.</option>
                </select>&nbsp&nbsp";
	echo " Name".($i+1).":<input type='text' name='fname".$i."' class='input2'>&nbsp&nbsp&nbsp&nbsp<tab align=right>Gender".($i+1).":<input type='radio' name='sex".$i."' class='input2' value='male'>Male<input type='radio' name='sex".$i."' value='female'>Female &nbsp&nbsp&nbsp&nbsp ";
	echo "&nbsp&nbsp&nbsp&nbspAge".($i+1).":<input type='text' name='age".$i."' class='input2'><br>";

}
    
echo "<hr>";    
 
echo "<h4 align='left'>Contact Details</h4>";
echo "<label for='mobile'>Mobile No.:</label><input type='text' name='mobile'class='input2'><br>";

echo "<label for='email_id'>Email id:</label><input type=text' name='email_id' class='input2'><br>";
echo "<label for='address'>Address:</label><textarea name='address' class='input2'></textarea><br>";
echo "<label for='id_no'>Id-no.:</label><input type='text' name='id_no' class='input2'><br>";
echo "<label for='id_proof'>ID Proof Type:</label><select name='id_proof' class='input2'>
                    <option value='-1'>-- select --</option>
                    <option value='Pan Card'>Pan Card</option>
                    <option value='Driving Licence'>Driving Licence</option>
                    <option value='Voting Card'>Voting Card</option>
                    <option value='Aadhar Card'>Aadhar Card</option>
                </select><br>";

echo "<input type='hidden' name='chosensource' class='btnclass' value='".$sourceid."'/>";
echo "<input type='hidden' name='chosendestination' class='btnclass' value='".$destinationid."'/>";      
echo "<input type='hidden' name='chosenbus' class='btnclass' value='".$chosenbusid."' /></td>";
echo "<input type='hidden' name='boardingpointsList' class='btnclass' value='".$boardingpointid."' /></td>";
echo "<input type='hidden' name='chkchk' class='btnclass' value='".$checkbox_no."' /></td>";
echo "<input type='hidden' name='seatnames' class='btnclass' value='".$seatschosen."' /></td>";


echo "<label>&nbsp;</label><input type='submit' value='SUBMIT' class='submit'>";

    ?>

 </body>
 </html>