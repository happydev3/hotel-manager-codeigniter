<html>
<head>
</head>
<body>
<form action='' method='POST' >
<?php
    include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


 

    $storeboardingpointId=$_GET['boardingpointsList'];
    
    $result=getBoardingPoint($storeboardingpointId);
    $result2 = json_decode($result);
    echo "<table frame='box' border='2'><tbody >";
    foreach ($result2 as $key => $value) {
        echo "<tr><td style='font-weight:bold; color:green;'>".$key."</td><td>".$value."</td></tr>";
    }
    echo "</tbody></table>";
    ?>

    </form>
</body>
</html>