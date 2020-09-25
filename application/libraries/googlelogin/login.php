<?php
if(!session_id()) {
    session_start();
}
include_once 'Google_Client.php';
include_once 'contrib/Google_Oauth2Service.php';
$clientId = '1026328181283-gv34ibm9qk5t6galfhr16rc42tikmjq4.apps.googleusercontent.com'; 
$clientSecret = 'Muvw4RMvZl7tx2KK0Z3DZDse'; 
$redirectURL = 'http://www.tpdtechnosoft.com/TPD_Projects/airooms/Glogin/login/'; 
$gClient = new Google_Client();
$gClient->setApplicationName('AIROOMS');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);
$google_oauthV2 = new Google_Oauth2Service($gClient);
$authUrl = $gClient->createAuthUrl();
?>
